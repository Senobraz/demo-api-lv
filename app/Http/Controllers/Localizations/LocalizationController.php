<?php

namespace App\Http\Controllers\Localizations;

use App\Actions\Localizations\Fetch;
use App\DTO\Localizations\FetchLocalizationsDTO;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LocalizationController extends ApiController
{
    /**
     * @throws ValidationException
     */
    public function index(Request $request, Fetch $action)
    {
        $action->execute(FetchLocalizationsDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }
}
