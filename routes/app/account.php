<?php

use App\Http\Controllers\Accounts\AccountController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'account',
], function () {
    Route::get('/show', [AccountController::class, 'show'])
        ->name('account.show');

    Route::group([
        'prefix' => 'settings',
    ], function () {
        Route::put('/basic', [AccountController::class, 'updateBasicSettings'])
            ->name('account.update-basic-settings');

        Route::put('/appearance', [AccountController::class, 'updateAppearanceSettings'])
            ->name('account.update-appearance-settings');
    });
});


