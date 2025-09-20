<?php

namespace App\Modules\Enotes\Http\Controllers\Sections;

use App\DTO\FetchListDTO;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ApiRequest;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\Actions\Sections\Create;
use App\Modules\Enotes\Actions\Sections\Delete;
use App\Modules\Enotes\Actions\Sections\Fetch;
use App\Modules\Enotes\Actions\Sections\FetchNotes;
use App\Modules\Enotes\Actions\Sections\Update;
use App\Modules\Enotes\Actions\Sections\UpdateMove;
use App\Modules\Enotes\Actions\Sections\UpdateOrder;
use App\Modules\Enotes\DTO\Sections\CreateSectionDTO;
use App\Modules\Enotes\DTO\Sections\UpdateMoveDTO;
use App\Modules\Enotes\DTO\Sections\UpdateOrderDTO;
use App\Modules\Enotes\DTO\Sections\UpdateSectionDTO;
use App\Modules\Enotes\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class SectionController extends ApiController
{
    /**
     * @throws ValidationException
     */
    public function index(ApiRequest $request, Workspace $workspace, Fetch $action): JsonResponse
    {
        $action->execute($workspace);

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function store(ApiRequest $request, Workspace $workspace, Create $action): JsonResponse
    {
        $action->execute($workspace, CreateSectionDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function notes(ApiRequest $request, Section $section, FetchNotes $action): JsonResponse
    {
        $action->execute($section, FetchListDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function update(ApiRequest $request, Section $section, Update $action): JsonResponse
    {
        $action->execute($section, UpdateSectionDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function order(ApiRequest $request, Section $section, UpdateOrder $action): JsonResponse
    {
        $action->execute($section, UpdateOrderDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function move(ApiRequest $request, Section $section, UpdateMove $action): JsonResponse
    {
        $action->execute($section, UpdateMoveDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function destroy(ApiRequest $request, Section $section, Delete $action): JsonResponse
    {
        $action->execute($section);

        return response()->json($action->getResponse());
    }
}
