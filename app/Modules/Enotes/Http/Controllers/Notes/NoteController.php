<?php

namespace App\Modules\Enotes\Http\Controllers\Notes;

use App\DTO\FetchListDTO;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ApiRequest;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\Actions\Notes\Create;
use App\Modules\Enotes\Actions\Notes\Delete;
use App\Modules\Enotes\Actions\Notes\FetchAll;
use App\Modules\Enotes\Actions\Notes\Get;
use App\Modules\Enotes\Actions\Notes\GetContent;
use App\Modules\Enotes\Actions\Notes\Search;
use App\Modules\Enotes\Actions\Notes\Update;
use App\Modules\Enotes\Actions\Notes\UpdateColor;
use App\Modules\Enotes\Actions\Notes\UpdateSection;
use App\Modules\Enotes\DTO\Notes\CreateNoteDTO;
use App\Modules\Enotes\DTO\Notes\FetchNotesDTO;
use App\Modules\Enotes\DTO\Notes\UpdateColorDTO;
use App\Modules\Enotes\DTO\Notes\UpdateNoteDTO;
use App\Modules\Enotes\DTO\Notes\UpdateSectionDTO;
use App\Modules\Enotes\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class NoteController extends ApiController
{
    /**
     * @throws ValidationException
     */
    public function index(ApiRequest $request, Workspace $workspace, FetchAll $action): JsonResponse
    {
        $action->execute($workspace, FetchListDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function search(ApiRequest $request, Workspace $workspace, Search $action): JsonResponse
    {
        $action->execute($workspace, FetchNotesDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function store(ApiRequest $request, Workspace $workspace, Create $action): JsonResponse
    {
        $action->execute($workspace, CreateNoteDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function update(ApiRequest $request, Note $note, Update $action): JsonResponse
    {
        $action->execute($note, UpdateNoteDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function updateSection(ApiRequest $request, Note $note, UpdateSection $action): JsonResponse
    {
        $action->execute($note, UpdateSectionDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function updateColor(ApiRequest $request, Note $note, UpdateColor $action): JsonResponse
    {
        $action->execute($note, UpdateColorDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

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
    public function showContent(ApiRequest $request, Note $note, GetContent $action): JsonResponse
    {
        $action->execute($note);

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function destroy(ApiRequest $request, Note $note, Delete $action): JsonResponse
    {
        $action->execute($note);

        return response()->json($action->getResponse());
    }
}
