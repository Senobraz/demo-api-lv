<?php

namespace App\Modules\Enotes\Tests\Feature;

use App\Models\Module\Module;
use App\Modules\Enotes\Models\Note;
use App\Modules\Enotes\Models\Section;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class N_3_NoteTest extends TestCase
{
    public function test_create_note()
    {
        $this->authorize();

        $link = URL::route('enotes.notes.store', [
            'workspace' => $this->getWorkspaceOfFirst(),
        ]);

        $response = $this->post($link, [
            'title' => 'test note',
            'heading' => $this->getHeadingPreset(),
            'content' => $this->getContentPreset(),
            'color_ulid' => '01haajpv7f62dt6twbbjd5djy1',
        ]);

        $response->assertStatus(200);
    }

    public function test_create_note_with_section()
    {
        $this->authorize();

        $workspace = $this->getWorkspaceOfFirst();

        $section = Section::factory()->create([
            'workspace_id' => $workspace->getId(),
        ]);

        $link = URL::route('enotes.notes.store', [
            'workspace' => $this->getWorkspaceOfFirst(),
        ]);

        $response = $this->post($link, [
            'title' => 'test note',
            'heading' => $this->getHeadingPreset(),
            'content' => $this->getContentPreset(),
            'color_ulid' => '01haajpv82mrv963m7mb479s37',
            'section_ulid' => $section->getUlid(),
        ]);

        $response->assertStatus(200);
    }

    public function test_update_note()
    {
        $this->authorize();

        $link = URL::route('enotes.notes.update', [
            'note' => $this->getFirstNote(),
        ]);

        $response = $this->put($link, [
            'title' => 'test note updating ...',
            'heading' => $this->getHeadingPreset(),
            'content' => $this->getContentPreset(),
            'color_ulid' => '01haajpv82mrv963m7mb479s37',
        ]);

        $response->assertStatus(200);
    }

    public function test_update_color_note()
    {
        $this->authorize();

        $link = URL::route('enotes.notes.update-color', [
            'note' => $this->getFirstNote(),
        ]);

        $response = $this->put($link, [
            'color_ulid' => '01haajpv74cf78vk7wghknzcqd',
        ]);

        $response->assertStatus(200);
    }

    public function test_update_section_note()
    {
        $this->authorize();

        $note = $this->getFirstNote();

        $section = Section::factory()->create([
            'workspace_id' => $note->getWorkspaceId(),
        ]);

        $link = URL::route('enotes.notes.update-section', [
            'note' => $note,
        ]);

        $response = $this->put($link, [
            'section_ulid' => $section->getUlid(),
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_note()
    {
        $this->authorize();

        $note = $this->getFirstNote();

        $link = URL::route('enotes.notes.destroy', [
            'note' => $note,
        ]);

        $response = $this->delete($link);

        $response->assertStatus(200);
    }

    public function test_fetch_notes()
    {
        $this->authorize();

        $workspace = $this->getWorkspaceOfFirst();

        $link = URL::route('enotes.notes.index', [
            'workspace' => $workspace,
        ]);

        $response = $this->get($link);

        $response->assertStatus(200);
    }

    public function test_fetch_one_note()
    {
        $this->authorize();

        $note = $this->getFirstNote();

        $link = URL::route('enotes.notes.show', [
            'note' => $note,
        ]);

        $response = $this->get($link);

        $response->assertStatus(200);
    }

    public function test_fetch_content_note()
    {
        $this->authorize();

        $note = $this->getFirstNote();

        $link = URL::route('enotes.notes.show-content', [
            'note' => $note,
        ]);

        $response = $this->get($link);

        $response->assertStatus(200);
    }

    protected function getWorkspaceOfFirst(): ?\App\Models\Workspace\Workspace
    {
        $user = $this->user();

        $moduleId = Module::where('code', Module::MODULE_ENOTE)->first()->getId();

        return $user->workspaces->where('module_id', $moduleId)->first();
    }

    protected function getFirstNote(): ?Note
    {
        $workspace = $this->getWorkspaceOfFirst();

        return Note::where('workspace_id', $workspace->getId())->first();
    }

    protected function getHeadingPreset(): array
    {
        return [
            'type' => 'doc',
            'content' => [
                [
                    "type" => 'text',
                    'text' => 'test note heading...'
                ]
            ]
        ];
    }

    protected function getContentPreset(): array
    {
        return [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'codeBlock',
                    'attrs' => [
                        'language' => null,
                    ],
                    'content' => [
                        [
                            "type" => 'text',
                            'text' => 'test note content in codeblock ....'
                        ]
                    ]
                ],
                [
                    "type" => 'text',
                    'text' => 'test note text ...'
                ]
            ]
        ];
    }
}
