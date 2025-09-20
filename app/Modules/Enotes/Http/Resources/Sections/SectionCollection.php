<?php

namespace App\Modules\Enotes\Http\Resources\Sections;

use App\Http\Resources\LengthAwareCollection;

class SectionCollection extends LengthAwareCollection
{
    public $collects = SectionResource::class;
}
