<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Booking;

class BookingStatusUpdated extends Notification
{
    use Queueable;

    public $booking;

    // Booking ka data receive karne ke liye
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // VIP Email View ko call kar rahe hain
        return (new MailMessage)
            ->subject('Reservation ' . strtoupper($this->booking->status) . ' | DriveElite')
            ->view('emails.booking_status', [
                'booking' => $this->booking, 
                'user' => $notifiable
            ]);
    }
}