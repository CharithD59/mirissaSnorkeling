<?php

namespace App\Mail;

use App\Models\ContactInquiry;
use App\Models\ContactReply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;
    public $reply;

    public function __construct(ContactInquiry $inquiry, ContactReply $reply)
    {
        $this->inquiry = $inquiry;
        $this->reply = $reply;
    }

    public function build()
    {
        $mail = $this->subject($this->reply->subject)
            ->view('emails.inquiry_reply');

        if ($replyTo = setting('contact.notify_email')) {
            $mail->replyTo($replyTo, config('mail.from.name'));
        }

        return $mail;
    }
}
