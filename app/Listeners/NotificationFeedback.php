<?php

namespace App\Listeners;

use App\Events\FeedbackCreated;
use App\Helpers\LogHelper;
use App\Models\User\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class NotificationFeedback
{
    public function __construct()
    {

    }

    public function handle(FeedbackCreated $event): void
    {
        $feedback = $event->feedback;

        /** @var User $user */
        $user = $feedback->user;

        $message = 'Обратная связь: от ' . LogHelper::getUserName($user) . PHP_EOL . PHP_EOL;
        $message .= 'Тема: ' . $feedback->getSubject() . PHP_EOL . PHP_EOL;
        $message .= 'Сообщение:' . PHP_EOL;
        $message .= $feedback->getMessage();

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
