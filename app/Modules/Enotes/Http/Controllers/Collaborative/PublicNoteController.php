<?php

namespace App\Modules\Enotes\Http\Controllers\Collaborative;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ApiRequest;
use App\Modules\Enotes\Actions\Collaborative\Notes\Get;
use App\Modules\Enotes\Actions\Collaborative\Notes\Report;
use App\Modules\Enotes\DTO\Collaborative\PublicNoteDTO;
use App\Modules\Enotes\DTO\Collaborative\ReportNoteDTO;
use App\Modules\Enotes\Models\Note;
use App\Modules\Enotes\Models\NoteCollaborative;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class PublicNoteController extends ApiController
{
    /**
     * @throws ValidationException
     */
    public function show(ApiRequest $request, Note $note, $key, $code, Get $action): JsonResponse
    {
        $action->execute($note, new PublicNoteDTO([
            'key' => $key,
            'code' => $code,
            'ip' => $request->ip(),
        ]));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function report(ApiRequest $request, NoteCollaborative $noteCollaborative, Report $action): JsonResponse
    {
        $action->execute($noteCollaborative, ReportNoteDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }
}
