<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentCreatedNotification extends Notification
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

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('予約が作成されました') 
        ->greeting("こんにちは、{$this->appointment->customerName}様") 
        ->line('以下の内容で予約が作成されました。')
        ->line("日付: {$this->appointment->appointmntDate}")
        ->line("時間: {$this->appointment->appointmntTime}")
        ->line("詳細: {$this->appointment->detail}")
        ->line('ご利用ありがとうございます！')
        ->line('今後ともよろしくお願いいたします！')
        ->line('予約に変更は以下から行えます')
        ->action('予約内容を変更する', url('http://127.0.0.1:8000/api/detail/'.$this->appointment->google_event_id));   
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
