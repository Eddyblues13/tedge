<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminActionNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The action type (e.g., Deposit, Withdrawal, Plan Purchase, Copy Trade).
     */
    public $actionType;

    /**
     * The user's name who performed the action.
     */
    public $userName;

    /**
     * The user's email.
     */
    public $userEmail;

    /**
     * The amount involved.
     */
    public $amount;

    /**
     * Additional details about the action.
     */
    public $details;

    /**
     * The date/time the action occurred.
     */
    public $date;

    /**
     * Create a new message instance.
     */
    public function __construct(string $actionType, ?string $userName, ?string $userEmail, $amount, array $details = [])
    {
        $this->actionType = $actionType;
        $this->userName = $userName ?? 'Unknown User';
        $this->userEmail = $userEmail ?? 'N/A';
        $this->amount = $amount;
        $this->details = $details;
        $this->date = now()->format('M d, Y h:i A');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "New {$this->actionType} - Tradedgepip Alert",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_action_notification',
            with: [
                'actionType' => $this->actionType,
                'userName' => $this->userName,
                'userEmail' => $this->userEmail,
                'amount' => $this->amount,
                'details' => $this->details,
                'date' => $this->date,
            ]
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
