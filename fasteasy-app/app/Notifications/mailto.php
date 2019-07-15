<?php

namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class mailto extends Notification
{
    use Queueable;
    protected $reservation;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($_reserv)
    {
        $this->reservation=$_reserv;
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
    public function toMail($notifiable)
    {
        $datac=User::find($this->reservation->id_client);
        return (new MailMessage)
                    ->subject('Des informations sur le client ')
                    ->line('Login: '.$datac->login)
                  ->line ('Nom: '.$datac->name)
                  ->line ('Email: '.$datac->email)
                  ->line ('Tel: '.$datac->tel)
                  ->line('Merci pour votre confiance');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
