<?php

namespace App\Modules\Enotes\Http\Resources\Notes;

use App\Http\Resources\LengthAwareCollection;

class NoteCollection extends LengthAwareCollection
{
    public $collects = NoteResource::class;
}
