<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log; 
use Illuminate\Validation\ValidationException; 

class BookingController extends Controller
{
    /**
     * 🌟 SECURE BOOKING STORE ENGINE (Payment Updated)
     */
    public function store(Request $request)
    {
        try {
            // 1. Strict Validation (Ab payment fields bhi validate honge)
            $request->validate([
                'car_id'         => 'required|exists:cars,id',
                'start_date'     => 'required|date',
                'end_date'       => 'required|date|after:start_date',
                'total_days'     => 'required|integer|min:1',
                'total_price'    => 'required|numeric|min:0',
                'payment_method' => 'required|string',
                'transaction_id' => 'nullable|string|max:100',
                'payment_proof'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB Image
            ], [
                'end_date.after' => 'End date must be after the start date.',
                'payment_proof.max' => 'The screenshot size must be less than 2MB.',
            ]);

            // 2. Handle Payment Proof Upload (If any)
            $proofPath = null;
            if ($request->hasFile('payment_proof')) {
                // Public disk mein payments folder mein save hoga
                $proofPath = $request->file('payment_proof')->store('payments', 'public');
            }

            // 3. Set Payment Status
            // Agar Cash on Pickup hai toh 'unpaid', warna 'pending_verification'
            $paymentStatus = ($request->payment_method === 'pickup') ? 'unpaid' : 'pending_verification';

            // 4. Secure Booking Creation
            Booking::create([
                'user_id'        => Auth::id(),
                'car_id'         => $request->car_id,
                'start_date'     => $request->start_date,
                'end_date'       => $request->end_date,
                'total_days'     => $request->total_days,
                'total_price'    => $request->total_price,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'transaction_id' => $request->transaction_id,
                'payment_proof'  => $proofPath,
                'status'         => 'Pending',
            ]);

            // 🌟 5. VIP Success Redirect
            return redirect()->route('dashboard')
                ->with('success', 'Your elite reservation and payment details have been received for executive review.');

        } catch (ValidationException $e) {
            return back()->withInput()->with('error', $e->validator->errors()->first());

        } catch (\Exception $e) {
            Log::error('Drive Elite Booking Crash: ' . $e->getMessage());
            return back()->with('error', 'A system error occurred. Error: ' . $e->getMessage());
        }
    }

    /**
     * 📄 VIP INVOICE DOWNLOAD ENGINE
     */
    public function downloadInvoice(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'Approved' && $booking->status !== 'Completed') {
            return back()->with('error', 'Invoice generation is locked. Please wait for executive approval.');
        }

        $booking->load(['user', 'car']);
        $settings = Setting::pluck('value', 'key')->toArray();

        $pdf = Pdf::loadView('admin.bookings.invoice', compact('booking', 'settings'));
        
        return $pdf->download('Drive-Elite-Receipt-'.$booking->id.'.pdf');
    }
}