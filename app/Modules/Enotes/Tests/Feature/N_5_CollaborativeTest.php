<?php

namespace App\Modules\Enotes\Tests\Feature;

use App\Modules\Enotes\Models\NoteCollaborative;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class N_5_CollaborativeTest extends TestCase
{
    public function test_fetch_note_public()
    {
        $note = $this->getFirstNote();

        $link = URL::route('enotes.collaborative.public.show', [
            'key' => $note->getPublicKey(),
            'code' => $note->getPublicCode(),
        ]);

        $response = $this->get($link);

        $response->assertStatus(200);
    }

    protected function getFirstNote(): ?NoteCollaborative
    {
        return NoteCollaborative::find(1);
    }
}
