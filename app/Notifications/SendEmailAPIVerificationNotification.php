<?php

namespace App\Notifications;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class SendEmailAPIVerificationNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;
    protected $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token=null){
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable){
        $verificationUrl = $this->verificationUrl($notifiable);
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }
        return (new MailMessage)
            ->subject(Lang::get(config('atemun.app_name_short').' - Verificar dirección de correo'))
            ->line(Lang::get('Por favor, haz click en el botón de verificación de correo.'))
            ->action(Lang::get('Verificar dirección de correo'), $verificationUrl)
            ->line(Lang::get('Si no creaste esta cuenta, no se requiere ninguna acción.'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable){
        return [
            //
        ];
    }

}
