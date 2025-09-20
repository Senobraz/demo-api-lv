<?php

namespace App\Http\Controllers\Dictionaries;

use App\Actions\Dictionaries\FetchDictionaries;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class DictionaryController extends ApiController
{
    public function index(Request $request, FetchDictionaries $action)
    {
        $action->execute($request->all());

        return response()->json($action->getResponse());
    }
}
