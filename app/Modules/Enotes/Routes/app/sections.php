<?php

use App\Modules\Enotes\Http\Controllers\Sections\SectionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'sections',
], function () {
    Route::post('/{workspace:ulid}', [SectionController::class, 'store'])
        ->name('enotes.sections.store');

    Route::get('/{section:ulid}/notes', [SectionController::class, 'notes'])
        ->name('enotes.sections.notes');

    Route::get('/{workspace:ulid}', [SectionController::class, 'index'])
        ->name('enotes.sections.index');

    Route::put('/{section:ulid}', [SectionController::class, 'update'])
        ->name('enotes.sections.update');

    Route::delete('/{section:ulid}', [SectionController::class, 'destroy'])
        ->name('enotes.sections.destroy');

    Route::post('/{section:ulid}/order', [SectionController::class, 'order'])
        ->name('enotes.sections.order');

    Route::post('/{section:ulid}/move', [SectionController::class, 'move'])
        ->name('enotes.sections.move');
});


