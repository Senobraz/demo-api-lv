<?php

namespace App\Modules\Enotes\Actions\Notes;

use App\Actions\ApiAction;
use App\Modules\Enotes\Http\Resources\Notes\GetContentResource;
use App\Modules\Enotes\Models\Note;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class GetContent extends ApiAction
{
    protected Note|null $note = null;

    /**
     * @throws ValidationException
     */
    public function execute(Note $note)
    {
        $this->note = $note;

        $this->validate([]);
    }

    public function validate(array $data): bool
    {
        if (!Gate::check('view', $this->note)) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        return parent::validate($data);
    }

    protected function resource(): GetContentResource
    {
        return new GetContentResource($this->note);
    }
}
