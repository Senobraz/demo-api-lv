<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Конфигурация поиска scout.index-settings
    |--------------------------------------------------------------------------
    |
    */

    \App\Modules\Enotes\Models\Note::class => [
        'filterableAttributes' => ['workspace_id', 'section_id', 'color_id'],
        'sortableAttributes' => ['updated_content_at', 'created_at'],
    ],
];
