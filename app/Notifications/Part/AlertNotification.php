<?php

namespace Selvah\Notifications\Part;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
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
            ->line(new HtmlString('Vous recevez cet email à la suite d\'une <strong>alerte critique</strong> de stock sur la pièce suivante:'))
            ->line(new HtmlString('<p class="light-layer">' . $this->part->name . '</p>'))
            ->line(new HtmlString('Il reste actuellement <strong>' . $this->part->stock_total . '</strong> pièce(s) en stock pour une alerte critique à <strong>' . $this->part->number_warning_minimum . '</strong> pièce(s).'))
            ->action('Voir la pièce détachée', $this->part->show_url)
            ->level('primary')
            ->subject('Alert de Stock - ' . config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'Alerte de stock sur la pièce détachée <strong>%s</strong> ! Il reste <strong>%s</strong> pièce(s) en stock !',
            'message_key' => [$this->part->name, $this->part->stock_total],
            'stock_total' => $this->part->stock_total,
            'number_warning_minimum' => [$this->part->number_warning_minimum],
            'type' => 'alert'
        ];
    }
}
