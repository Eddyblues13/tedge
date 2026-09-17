<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminDetailUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $adminName;
    public $changeType;
    public $changedFields;
    public $changedBy;
    public $changeDate;

    /**
     * Create a new message instance.
     */
    public function __construct(string $adminName, string $changeType, array $changedFields, string $changedBy)
    {
        $this->adminName = $adminName;
        $this->changeType = $changeType;
        $this->changedFields = $changedFields;
        $this->changedBy = $changedBy;
        $this->changeDate = now()->toDateTimeString();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Account Updated - ' . $this->changeType,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_detail_updated',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
