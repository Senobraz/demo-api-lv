<?php

use App\Http\Controllers\Support\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'support',
], function () {
    Route::middleware('throttle:5,10')->post('/feedback', [FeedbackController::class, '__invoke'])
        ->name('support.feedback');
});


