<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Accounts\Create;
use App\DTO\Accounts\CreateAccountDTO;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends ApiController
{
    /**
     * @param Request $request
     * @param Create $action
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request, Create $action)
    {
        $action->execute(CreateAccountDTO::fromRequest($request));

        return response()->noContent();
    }
}
