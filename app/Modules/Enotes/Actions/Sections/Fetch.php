<?php

namespace App\Modules\Enotes\Actions\Sections;

use App\Actions\ApiAction;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\Http\Resources\Sections\SectionCollection;
use App\Modules\Enotes\Models\Section;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class Fetch extends ApiAction
{
    protected Workspace|null $workspace;

    protected mixed $sections;

    /**
     * @throws ValidationException
     */
    public function execute(Workspace $workspace)
    {
        $this->workspace = $workspace;

        $this->validate([]);

        $this->sections = Section
            ::ofWorkspace($this->workspace->getId())
            ->orderByDesc('sort')
            ->orderBy('id')
            ->get();

        $this->sections->load('workspace', 'icon', 'color', 'parent');
    }

    public function validate(array $data): bool
    {
        if (!Gate::check('viewAny', [Section::class, $this->workspace])) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        return parent::validate($data);
    }

    protected function resource(): ResourceCollection|array|null
    {
        return new SectionCollection($this->sections);
    }
}
