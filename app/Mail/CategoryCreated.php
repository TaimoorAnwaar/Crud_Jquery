<?php

namespace App\Mail;

use App\Models\Category;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CategoryCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $category;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(Category $category , User $user)
    {
        // Get the authenticated user
        $this->category = $category;
        $this->user = $user;   
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Category Created'
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Category Created')
                    ->view('emails.category-created')
                    ->with([
                        'category' => $this->category,
                        'user' => $this->user 
                    ]);
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
