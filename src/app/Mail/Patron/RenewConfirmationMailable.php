<?php

namespace Dcplibrary\PAPIAccount\App\Mail\Patron;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Attachment,Content,Envelope};
use Illuminate\Queue\SerializesModels;

class RenewConfirmationMailable extends Mailable
{
    use Queueable;
    use SerializesModels;


    /**
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'We have received your request'
        );
    }


    /**
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'papiaccount::mail.patron.renew-confirmation',
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [

        ];
    }
}
