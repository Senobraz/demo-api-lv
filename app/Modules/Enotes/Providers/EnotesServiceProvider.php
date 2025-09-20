<?php

namespace App\Modules\Enotes\Providers;

use App\Providers\ModuleServiceProvider;

class EnotesServiceProvider extends ModuleServiceProvider
{
    protected ?string $configAlias = 'enotes';

    protected array $policies = [
        \App\Modules\Enotes\Models\Section::class => \App\Modules\Enotes\Policies\SectionPolicy::class,
        \App\Modules\Enotes\Models\Note::class => \App\Modules\Enotes\Policies\NotePolicy::class,
        \App\Modules\Enotes\Models\NoteCollaborative::class => \App\Modules\Enotes\Policies\NoteCollaborativePolicy::class
    ];

    protected array $listens = [
        \App\Events\AccountCreated::class => [
            \App\Modules\Enotes\Listeners\CreateWorkspace::class,
            \App\Listeners\NotificationNewAccount::class
        ],
        \App\Events\WorkspaceCreated::class => [
            \App\Modules\Enotes\Listeners\CreateDemoForWorkspace::class,
        ],
        \App\Events\FeedbackCreated::class => [
            \App\Listeners\NotificationFeedback::class
        ]
    ];

    protected array $routes = [
        'app',
    ];
}
