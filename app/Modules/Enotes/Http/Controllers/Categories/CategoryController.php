<?php

namespace App\Modules\Enotes\Http\Controllers\Categories;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ApiRequest;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\Actions\Categories\Create;
use App\Modules\Enotes\Actions\Categories\Delete;
use App\Modules\Enotes\Actions\Categories\Update;
use App\Modules\Enotes\DTO\Categories\CreateCategoryDTO;
use App\Modules\Enotes\DTO\Categories\UpdateCategoryDTO;
use App\Modules\Enotes\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CategoryController extends ApiController
{
    /**
     * @throws ValidationException
     */
    public function store(ApiRequest $request, Workspace $workspace, Create $action): JsonResponse
    {
        $action->execute($workspace, CreateCategoryDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function update(ApiRequest $request, Section $section, Update $action): JsonResponse
    {
        $action->execute($section, UpdateCategoryDTO::fromRequest($request));

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
