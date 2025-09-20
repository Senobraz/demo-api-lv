<?php

namespace App\Http\Controllers\Site;

use App\Actions\Site\Get;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class SiteController extends ApiController
{
    public function show(Request $request, Get $action)
    {
        $action->execute($request->user());

        return response()->json($action->getResponse());
    }
}
