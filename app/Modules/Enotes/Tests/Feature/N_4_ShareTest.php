<?php

namespace App\Modules\Enotes\Tests\Feature;

use App\Models\Module\Module;
use App\Modules\Enotes\Models\Note;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class N_4_ShareTest extends TestCase
{
    public function test_share_note_public_enable()
    {
        $this->authorize();

        $link = URL::route('enotes.notes.share.public.enable', [
            'note' => $this->getFirstNote(),
        ]);

        $response = $this->post($link, []);

        $response->assertStatus(200);
    }

    public function test_share_note_public_disable()
    {
        $this->authorize();

        $link = URL::route('enotes.notes.share.public.disable', [
            'note' => $this->getFirstNote(),
        ]);

        $response = $this->post($link, []);

        $response->assertStatus(200);
    }

    public function test_share_note_public_enable_again()
    {
        $this->authorize();

        $link = URL::route('enotes.notes.share.public.enable', [
            'note' => $this->getFirstNote(),
        ]);

        $response = $this->post($link, []);

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
}
