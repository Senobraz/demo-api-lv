<?php

namespace App\Modules\Enotes\Tests\Feature;

use App\Models\Module\Module;
use App\Modules\Enotes\Models\Section;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class N_1_CategoryTest extends TestCase
{
    public function test_create_category()
    {
        $this->authorize();

        $workspace = $this->getWorkspaceOfFirst();

        $link = URL::route('enotes.categories.store', [
            'workspace' => $workspace,
        ]);

        $response = $this->post($link, [
            'name' => 'New Category...',
        ]);

        $response->assertStatus(200);
    }

    public function test_update_category()
    {
        $this->authorize();

        $workspace = $this->getWorkspaceOfFirst();

        $category = Section::factory()->create([
            'workspace_id' => $workspace->getId(),
            'type' => Section::TYPE_CATEGORY,
        ]);

        $link = URL::route('enotes.categories.update', [
            'section' => $category,
        ]);

        $response = $this->put($link, [
            'name' => '[updated] Category...',
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_category()
    {
        $this->authorize();

        $workspace = $this->getWorkspaceOfFirst();

        $category = Section::factory()->create([
            'workspace_id' => $workspace->getId(),
            'type' => Section::TYPE_CATEGORY,
        ]);

        $link = URL::route('enotes.categories.destroy', [
            'section' => $category,
        ]);

        $response = $this->delete($link);

        $response->assertStatus(200);
    }

    protected function getWorkspaceOfFirst(): ?\App\Models\Workspace\Workspace
    {
        $user = $this->user();

        $moduleId = Module::where('code', Module::MODULE_ENOTE)->first()->getId();

        return $user->workspaces->where('module_id', $moduleId)->first();
    }
}
