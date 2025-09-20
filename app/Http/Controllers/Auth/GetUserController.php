<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;

class GetUserController extends ApiController
{
    public function __invoke(Request $request)
    {
        return response()->json(
            new UserResource($request->user())
        );
    }
}
