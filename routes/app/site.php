<?php

use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'site',
], function () {
    Route::get('/show', [SiteController::class, 'show'])
        ->name('site.show');
});


