<?php

namespace App\Modules\Enotes\Http\Resources\Sections;

use App\Http\Resources\LengthAwareCollection;

class UpdateOrderCollection extends LengthAwareCollection
{
    public $collects = UpdateOrderResource::class;
}
