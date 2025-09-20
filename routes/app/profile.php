<?php

use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'profile',
], function () {
    Route::put('/avatar',[UserController::class, 'updateAvatar'])
        ->name('profile.update-avatar');

    Route::put('/name',[UserController::class, 'updateName'])
        ->name('profile.update-name');

    Route::put('/password',[UserController::class, 'updatePassword'])
        ->name('profile.update-password');
});


