<?php

namespace App\Modules\Enotes\Http\Controllers\Share;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ApiRequest;
use App\Modules\Enotes\Actions\Share\Notes\Get;
use App\Modules\Enotes\Actions\Share\Notes\PublicDisable;
use App\Modules\Enotes\Actions\Share\Notes\PublicEnable;
use App\Modules\Enotes\DTO\Share\NotePublicEnableDTO;
use App\Modules\Enotes\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class NoteShareController extends ApiController
{

    /**
     * @throws ValidationException
     */
    public function show(ApiRequest $request, Note $note, Get $action): JsonResponse
    {
        $action->execute($note);

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function publicEnable(ApiRequest $request, Note $note, PublicEnable $action): JsonResponse
    {
        $action->execute($note, NotePublicEnableDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function publicDisable(ApiRequest $request, Note $note, PublicDisable $action): JsonResponse
    {
        $action->execute($note);

        return response()->json($action->getResponse());
    }
}
