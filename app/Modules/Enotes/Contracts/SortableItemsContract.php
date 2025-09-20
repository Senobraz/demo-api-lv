<?php

namespace App\Modules\Enotes\Contracts;

interface SortableItemsContract
{
    public function getBeforeUlid(): ?string;

    public function getAfterUlid(): ?string;

    public function getParentUlid(): ?string;
}
