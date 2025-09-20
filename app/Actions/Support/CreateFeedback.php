<?php

namespace App\Actions\Support;

use App\Actions\ApiAction;
use App\DTO\Support\FeedbackDTO;
use App\Events\FeedbackCreated;
use App\Http\Resources\Support\FeedbackResource;
use App\Models\Support\Feedback;
use App\Supports\UserSupport;
use Illuminate\Validation\ValidationException;

class CreateFeedback extends ApiAction
{
    protected bool $notify = true;

    /**
     * @throws ValidationException
     */
    public function execute(FeedbackDTO $dto): void
    {
        $this->validate([]);

        $feedback = Feedback::create([
            'subject' => $dto->getSubject(),
            'message' => $dto->getMessage(),
            'type' => Feedback::TYPE_DEFAULT,
            'smile' => $dto->getSmile(),
            'user_id' => UserSupport::getId(),
            'account_id' => UserSupport::getAccountId(),
        ]);

        event(new FeedbackCreated($feedback));
    }

    protected function summary(): string
    {
        return __('alert.support.feedback_success');
    }

    protected function resource(): FeedbackResource
    {
        return new FeedbackResource([]);
    }
}
