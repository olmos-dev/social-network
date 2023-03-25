<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Mensajes extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    //en el contructor se inyectan los datos para hacer una notificacion más detallada
    public function __construct($nombre,$slug,$texto)
    {
        $this->nombre = $nombre;
        $this->slug = $slug;
        $this->texto = $texto;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //se configuro las notificaciones para almacenarlas en la BD
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
          //aqui se almacena los datos que hemos recibido del constructor en el campo data de las notificaciones en la BD
        return [
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'texto' => $this->texto
        ];
    }
}
