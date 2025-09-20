<?php

use App\Http\Controllers\Localizations\LocalizationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'localizations',
], function () {
    Route::get('/', [LocalizationController::class, 'index'])
        ->name('localizations.index');
});


