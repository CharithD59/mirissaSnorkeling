<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $note;

    public function __construct(Booking $booking, $note = null)
    {
        $this->booking = $booking;
        $this->note = $note;
    }

    public function build()
    {
        $mail = $this->subject('Your booking ' . $this->booking->reference . ' is ' . strtolower($this->booking->status_label))
            ->view('emails.booking_status');

        if ($replyTo = setting('contact.notify_email')) {
            $mail->replyTo($replyTo, config('mail.from.name'));
        }

        return $mail;
    }
}
