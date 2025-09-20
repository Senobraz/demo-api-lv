<?php

namespace App\Modules\Enotes\Tests\Feature;

use App\Models\Module\Module;
use App\Modules\Enotes\Models\Section;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class N_2_SectionTest extends TestCase
{
    public function test_create_section()
    {
        $this->authorize();

        $link = URL::route('enotes.sections.store', [
            'workspace' => $this->getWorkspaceOfFirst(),
        ]);

        $response = $this->post($link, [
            'name' => 'Create section ...',
            'icon_ulid' => '01hkf0hmkg5k6dt8s7hk5v249g',
        ]);

        $response->assertStatus(200);
    }

    public function test_create_section_with_new_category()
    {
        $this->authorize();

        $link = URL::route('enotes.sections.store', [
            'workspace' => $this->getWorkspaceOfFirst(),
        ]);

        $response = $this->post($link, [
            'name' => 'Create section with new category ...',
            'category' => 'New category for section ...',
            'icon_ulid' => '01hkf0hmkg5k6dt8s7hk5v249g',
        ]);

        $response->assertStatus(200);
    }

    public function test_create_section_with_exists_category()
    {
        $this->authorize();

        $workspace = $this->getWorkspaceOfFirst();

        $link = URL::route('enotes.sections.store', [
            'workspace' => $workspace,
        ]);

        $category = Section::factory()->create([
            'workspace_id' => $workspace->getId(),
            'type' => Section::TYPE_CATEGORY,
        ]);

        $response = $this->post($link, [
            'name' => 'Create section with exists category ...',
            'category' => $category->getUlid(),
            'icon_ulid' => '01hkf0hmkg5k6dt8s7hk5v249g',
        ]);

        $response->assertStatus(200);
    }

    public function test_update_section_with_new_category()
    {
        $this->authorize();

        $section = $this->getSectionOfFirst();

        $link = URL::route('enotes.sections.update', [
            'section' => $section,
        ]);

        $response = $this->put($link, [
            'name' => '[updated] ' . $section->getName(),
            'description' => $section->getDescription() . ', updated with new category....',
            'category' => 'New category on section updated ....',
            'icon_ulid' => '01hkf0hmkg5k6dt8s7hk5v249g',
        ]);

        $response->assertStatus(200);
    }

    public function test_update_section_with_exists_category()
    {
        $this->authorize();

        $section = $this->getSectionOfFirst();

        $category = Section::factory()->create([
            'workspace_id' => $section->getWorkspaceId(),
            'type' => Section::TYPE_CATEGORY,
        ]);

        $link = URL::route('enotes.sections.update', [
            'section' => $section,
        ]);

        $response = $this->put($link, [
            'name' => '[updated] ' . $section->getName(),
            'description' => $section->getDescription() . ' updated with exists category',
            'category' => $category->getUlid(),
            'icon_ulid' => '01hkf0hmkg5k6dt8s7hk5v249g',
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_section()
    {
        $this->authorize();

        $workspace = $this->getWorkspaceOfFirst();

        $section = Section::factory()->create([
            'workspace_id' => $workspace->getId(),
            'type' => Section::TYPE_DEFAULT,
        ]);

        $link = URL::route('enotes.sections.destroy', [
            'section' => $section,
        ]);

        $response = $this->delete($link);

        $response->assertStatus(200);
    }

    public function test_fetch_sections()
    {
        $this->authorize();

        $link = URL::route('enotes.sections.index', [
            'workspace' => $this->getWorkspaceOfFirst(),
        ]);

        $response = $this->get($link);

        $response->assertStatus(200);
    }

    public function test_fetch_section_notes()
    {
        $this->authorize();

        $section = $this->getSectionOfFirst();

        $link = URL::route('enotes.sections.notes', [
            'section' => $section,
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

    protected function getSectionOfFirst(): ?\App\Modules\Enotes\Models\Section
    {
        $workspace = $this->getWorkspaceOfFirst();

        return Section::where('workspace_id', $workspace->getId())->where('type', Section::TYPE_DEFAULT)->first();
    }
}
