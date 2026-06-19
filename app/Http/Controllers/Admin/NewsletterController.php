<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    // List dikhane ke liye
    public function index()
    {
        $subscribers = Newsletter::latest()->paginate(20);
        return view('admin.newsletters.index', compact('subscribers'));
    }

    // Delete karne ke liye
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return back()->with('success', 'Subscriber removed successfully.');
    }
    public function export()
{
    $subscribers = Newsletter::all();
    $csvFileName = 'subscribers_' . date('Y-m-d') . '.csv';

    // Headers ko mazeed clear kar diya hai
    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=\"$csvFileName\"", // Quotes add kiye hain
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    $columns = ['ID', 'Email Address', 'Subscription Date'];

    $callback = function() use($subscribers, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($subscribers as $subscriber) {
            fputcsv($file, [
                $subscriber->id, 
                $subscriber->email, 
                $subscriber->created_at->format('Y-m-d H:i:s')
            ]);
        }

        fclose($file);
    };

    // stream function se pehle headers ko enforce karna
    return response()->stream($callback, 200, $headers);
}
}