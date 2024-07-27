<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TestimonyCreated extends Notification
{
    use Queueable;

    protected $testimoni;
    /**
     * Create a new notification instance.
     */
    public function __construct($testimoni)
    {
        $this->testimoni = $testimoni;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'testimoni_id' => $this->testimoni->id,
            'name' => $this->testimoni->name,
            'message' => $this->testimoni->message,
            'created_at' => $this->testimoni->created_at->format('d M Y H:i'),
        ];
    }
}
