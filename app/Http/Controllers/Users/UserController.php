<?php

namespace App\Http\Controllers\Users;

use App\Actions\Users\UpdateAvatar;
use App\Actions\Users\UpdateUsername;
use App\Actions\Users\UpdatePassword;
use App\DTO\Users\UpdateAvatarDTO;
use App\DTO\Users\UpdatePasswordDTO;
use App\DTO\Users\UpdateUsernameDTO;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ApiRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserController extends ApiController
{
    /**
     * @throws ValidationException
     */
    public function updateName(ApiRequest $request, UpdateUsername $action): JsonResponse
    {
        $request->attempt(5);

        $action->execute($request->user(), UpdateUsernameDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function updateAvatar(ApiRequest $request, UpdateAvatar $action): JsonResponse
    {
        $request->attempt();

        $action->execute($request->user(), UpdateAvatarDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }

    /**
     * @throws ValidationException
     */
    public function updatePassword(ApiRequest $request, UpdatePassword $action): JsonResponse
    {
        $request->attempt(5);

        $action->execute($request->user(), UpdatePasswordDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }
}
