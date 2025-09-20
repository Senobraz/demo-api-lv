<?php

namespace App\Http\Controllers\Accounts;

use App\Actions\Accounts\Get;
use App\Actions\Users\UpdateAppearance;
use App\Actions\Users\UpdateSettings;
use App\DTO\Users\UpdateAppearanceDTO;
use App\DTO\Users\UpdateSettingsDTO;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ApiRequest;
use Illuminate\Validation\ValidationException;

class AccountController extends ApiController
{
    public function show(ApiRequest $request, Get $action)
    {
        $action->execute($request->user());

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function updateBasicSettings(ApiRequest $request, UpdateSettings $action): \Illuminate\Http\JsonResponse
    {
        $request->attempt(100);

        $action->execute($request->user(), UpdateSettingsDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function updateAppearanceSettings(ApiRequest $request, UpdateAppearance $action): \Illuminate\Http\JsonResponse
    {
        $request->attempt(100);

        $action->execute($request->user(), UpdateAppearanceDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }
}
