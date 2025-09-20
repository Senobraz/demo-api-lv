<?php

namespace App\Listeners;

use App\Events\AccountCreated;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class NotificationNewAccount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * prepare the event.
     * @throws ValidationException
     */
    public function handle(AccountCreated $event): void
    {
        $user = $event->user;

        $message = 'Новый Аккаунт: Пользователь - ' . $user->getUserName() . ' | ' . $user->getEmail() . ' | ' . $user->getCreatedAt();

        if (!App::isProduction()) {
            Log::info($message);

            return;
        }

        try {
            Log::channel('discord')->info($message);
        } catch (\Throwable $e) {
            Log::info($message);
        }
    }
}
