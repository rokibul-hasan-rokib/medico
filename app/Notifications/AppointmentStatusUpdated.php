<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;

class AppointmentStatusUpdated extends Notification
{
    use Queueable;
    protected $appointment;

    /**
     * Create a new notification instance.
     */

     public function __construct($appointment)
     {
         $this->appointment = $appointment;
     }
 
     public function via($notifiable)
     {
         return ['mail'];
     }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your Appointment is Active')
                    ->greeting('Hello, ' . $notifiable->name)
                    ->line('Your appointment has been confirmed and is now active.')
                    ->line('Appointment Date: ' . $this->appointment->date)
                    ->line('Doctor: ' . $this->appointment->doctor)
                    ->action('View Appointment', url('/appointments/' . $this->appointment->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
            return [
                'appointment_id' => $this->appointment->id,
                'status' => $this->appointment->status,     
        ];
    }
}