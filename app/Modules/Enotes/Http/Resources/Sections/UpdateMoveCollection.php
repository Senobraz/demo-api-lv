<?php

namespace App\Modules\Enotes\Http\Resources\Sections;

use App\Http\Resources\LengthAwareCollection;

class UpdateMoveCollection extends LengthAwareCollection
{
    public $collects = UpdateMoveResource::class;
}
