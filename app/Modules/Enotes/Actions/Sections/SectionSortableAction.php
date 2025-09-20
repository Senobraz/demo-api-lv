<?php

namespace App\Modules\Enotes\Actions\Sections;

use App\Actions\ApiAction;
use App\Helpers\SortHelper;
use App\Modules\Enotes\Contracts\SortableItemsContract;
use App\Modules\Enotes\Models\Section;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

abstract class SectionSortableAction extends ApiAction
{
    protected Section|null $section = null;

    protected array|Collection $sections = [];

    /**
     * @throws ValidationException
     */
    protected function updateSortableValues(SortableItemsContract $dto): void
    {
        $sections = Section
            ::ofWorkspace($this->section->workspace->getId())
            ->whereIn('ulid', [
                $dto->getBeforeUlid(),
                $dto->getAfterUlid(),
            ])
            ->get(['ulid', 'sort', 'parent_id'])
            ->toArray();

        $sortValuesByUlid = array_column($sections, 'sort', 'ulid');

        $parentSectionIds = array_unique(array_column($sections, 'parent_id'));

        $beforeSortValue = $sortValuesByUlid[$dto->getBeforeUlid()] ?? null;

        $afterSortValue = $sortValuesByUlid[$dto->getAfterUlid()] ?? null;

        $newSortValue = SortHelper::calcSortValue($beforeSortValue, $afterSortValue);

        if (
            $newSortValue === $beforeSortValue ||
            $newSortValue === $afterSortValue
        ) {
            $this->sections = $this->refreshSortValuesByParents($parentSectionIds);
        } else {
            $this->section->sort = $newSortValue;

            $this->sections[] = $this->section;
        }

        if ($this->section->isDirty()) {
            $this->section->save();
        }
    }

    protected function refreshSortValuesByParents(array $parentSectionIds): ?Collection
    {
        $query = Section::query();

        $query
            ->ofWorkspace($this->section->workspace->getId())
            ->where('type', $this->section->getType())
            ->orderByDesc('sort');

        if (in_array(null, $parentSectionIds)) {
            $query->where(function ($query) use ($parentSectionIds) {
                $query->whereIn('parent_id', array_filter($parentSectionIds))
                    ->orWhereNull('parent_id');
            });
        } else {
            $query->whereIn('parent_id', $parentSectionIds);
        }

        $sections = $query->get();

        foreach ($sections as $index => $section) {
            $sortValue = SortHelper::getSortValue() - (SortHelper::SORT_DEFAULT_VALUE * $index);

            $section->sort = $sortValue;

            $section->save();
        }

        return $sections->fresh();
    }
}
