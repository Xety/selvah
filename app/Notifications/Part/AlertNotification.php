<?php

namespace Selvah\Notifications\Part;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Selvah\Models\Part;

class AlertNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Part $part, private bool $critical)
    {
        //dd($part);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        if ($this->critical === true) {
            return ['mail'];
        }

        return ['database'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->line('If you did not request a password reset, no further action is required.')
            ->action('Reset Password', url(config('app.url') . route('users.auth.password.reset', $this->token, false)))
            ->level('primary')
            ->subject('Reset Password - ' . config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'Alerte de stock sur la pièce détachée <strong>%s</strong> !',
            'message_key' => $this->part->name,
            'stock_total' => $this->part->stock_total,
            'number_warning_minimum' => [$this->part->number_warning_minimum],
            'type' => 'alert'
        ];
    }
}
