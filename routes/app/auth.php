<?php

use App\Http\Controllers\Auth\GetUserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth',
], function () {
    Route::get('/check', function (Request $request) {
        return 'ok';
    });

    Route::get('/user', GetUserController::class)
        ->name('auth.user');
});


