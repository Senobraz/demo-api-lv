<?php

namespace App\Http\Controllers\Support;

use App\Actions\Support\CreateFeedback;
use App\DTO\Support\FeedbackDTO;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ApiRequest;
use Illuminate\Validation\ValidationException;

class FeedbackController extends ApiController
{
    /**
     * @throws ValidationException
     */
    public function __invoke(ApiRequest $request, CreateFeedback $action): \Illuminate\Http\JsonResponse
    {
        $action->execute(FeedbackDTO::fromRequest($request));

        return response()->json($action->getResponse());
    }
}
