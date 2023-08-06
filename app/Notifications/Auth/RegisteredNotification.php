<?php

namespace Selvah\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Selvah\Models\User;

class RegisteredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected User $user)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [
            //'database',
            'mail'
        ];
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
            ->greeting(new HtmlString('<strong>Bienvenue à la Coopérative Bourgogne du Sud !</strong>'))
            ->line(new HtmlString('Votre compte viens d\'être créé sur le site de la Coopérative Bourgogne du Sud.'))
            ->line(new HtmlString('Vous pouvez dès à présent vous connectez avec votre compte sur le site interne Bourgogne du Sud et lire toutes les informations utiles pour que votre arrivé au sein de l\'entreprise ce passe du mieux possible.'))
            ->line(new HtmlString('Durant votre contrat saisonnier, votre responsable sera : <br>M Christophe Gateau<br> Tel : 06.12.34.56.78'))
            ->action('Acceder au site', route('dashboard.index'))
            ->level('primary')
            ->subject('Bienvenue à Bourgogne du Sud, ' . $this->user->full_name . ' !');
    }
}
