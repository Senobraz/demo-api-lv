<?php

namespace App\Modules\Enotes\Supports;

use App\Modules\Enotes\Models\Note;
use App\Modules\Enotes\Models\NoteCollaborative;

class CollaborativeResourceSupport
{
    static public function getPublicNoteMeta(Note $note): array
    {
        return [
            'title' => $note->getTitle(),
            'meta' => [
                [
                    'name' => 'keywords',
                    'content' => __('metadata.public_note.keywords'),
                ],
                [
                    'name' => 'description',
                    'content' => __('metadata.public_note.description'),
                ],
            ]
        ];
    }
}
