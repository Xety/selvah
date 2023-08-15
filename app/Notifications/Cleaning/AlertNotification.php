<?php

namespace Selvah\Notifications\Cleaning;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Selvah\Models\Material;

class AlertNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Material $material)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Check if the Email Alert is enabled.
        if ($this->material->cleaning_alert_email) {
            return [
                'database',
                //'mail'
            ];
        }

        return ['database'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->line(new HtmlString('Vous recevez cet email à la suite d\'une <strong>alerte critique</strong> de stock sur la pièce suivante:'))
            ->line(new HtmlString('<p class="light-layer">' . $this->part->name . '</p>'))
            ->line(new HtmlString('Il reste actuellement <strong>' . $this->part->stock_total . '</strong> pièce(s) en stock pour une alerte critique à <strong>' . $this->part->number_critical_minimum . '</strong> pièce(s).'))
            ->action('Voir la pièce détachée', $this->part->show_url)
            ->level('primary')
            ->subject('Alert de Stock - ' . config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param object $notifiable
     *
     * @return array
     */
    public function toDatabase(object $notifiable): array
    {
        $days = config('selvah.cleaning.multipliers.' . $this->material->cleaning_alert_frequency_type) * $this->material->cleaning_alert_frequency_repeatedly;

        $message = $this->material->last_cleaning_at === null ? '.' : ' or le dernier nettoyage a été fait le <strong>%s</strong>.';

        return [
            'message' => 'Alerte de nettoyage sur le matériel <strong>%s</strong> ! Le prochain nettoyage devait être le <strong>%s</strong>' . $message,
            'message_key' => [$this->material->name, $this->material->last_cleaning_at->addDays($days)->format('d-m-Y H:i'), $this->material->last_cleaning_at->format('d-m-Y H:i')],
            'url' => $this->material->show_url,
            'type' => 'alert'
        ];
    }
}
