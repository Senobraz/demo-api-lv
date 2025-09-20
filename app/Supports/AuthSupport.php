<?php

namespace App\Supports;

use App\Helpers\StrHelper;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthSupport
{
    static public function bootVerifyEmail(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {

            $frontendUrl = str_replace(config('app.url'), config('app.frontend_url'), $url);

            return (new MailMessage)
                ->greeting(__('email.greeting'))
                ->subject(__('email.verify.subject'))
                ->line(__('email.verify.text_before'))
                ->action(__('email.verify.action'), $frontendUrl )
                ->line(__('email.verify.text_after'));
        });
    }

    static public function bootResetPasswordEmail(): void
    {
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = StrHelper::getFrontendUrl('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]);

            return (new MailMessage)
                ->greeting(__('email.greeting'))
                ->subject(__('email.reset_password.subject'))
                ->line(__('email.reset_password.text_before'))
                ->action(__('email.reset_password.action'), $url)
                ->line(__('email.reset_password.text_after', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
                ->line(__('email.reset_password.text_after_2'));
        });
    }
}
