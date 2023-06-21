<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orders;

    /**
     * Create a new message instance.
     */
    public function __construct($orders)
    {
        
        $this->orders = $orders;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Purchased Product',
            from: 'hnewbu1@gmail.com'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
       // return $this->from("hnewbu1@gmail.com")->subject('Purchased Product')->view('mail.invoice')->with('orders', $this->orders);
        return new Content(
            view: 'mail.invoice',
            with: ['orders', $this->orders],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
