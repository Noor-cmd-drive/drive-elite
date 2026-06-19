<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function envelope(): Envelope
    {
        // 🌟 Status ke hisaab se Subject set hoga
        $subjects = [
            'Approved' => 'Reservation Confirmed - Drive Elite',
            'Completed' => 'Journey Completed - Drive Elite',
            'Cancelled' => 'Reservation Cancelled - Drive Elite',
        ];

        return new Envelope(
            subject: $subjects[$this->booking->status] ?? 'Drive Elite Update',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_status',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}