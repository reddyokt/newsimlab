<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail']; // Assuming you're sending this notification via email
    }

    public function toMail($notifiable)
    {
        $url = url("password/reset/{$this->token}");

        return (new MailMessage)
            ->subject('Forgot Password')
            ->greeting('Assalamualaikum')
            ->line('Berikut adalah link untuk membuat password baru akun SIMLAB anda')
            ->action('Reset Password', $url)
            ->line('Jika Anda tidak meminta pengaturan ulang kata sandi, tidak ada tindakan lebih lanjut yang diperlukan')
            ->salutation('Wassalamualaikum, Tim SIMLAB');
    }
}
