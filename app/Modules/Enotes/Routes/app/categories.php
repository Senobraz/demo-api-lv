<?php

use App\Modules\Enotes\Http\Controllers\Categories\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'categories',
], function () {
    Route::post('/{workspace:ulid}', [CategoryController::class, 'store'])
        ->name('enotes.categories.store');

    Route::put('/{section:ulid}', [CategoryController::class, 'update'])
        ->name('enotes.categories.update');

    Route::delete('/{section:ulid}', [CategoryController::class, 'destroy'])
        ->name('enotes.categories.destroy');
});


