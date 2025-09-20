<?php

use App\Modules\Enotes\Http\Controllers\Share\NoteShareController;
use App\Modules\Enotes\Http\Controllers\Notes\NoteController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'notes',
], function () {
    Route::get('/{workspace:ulid}/notes', [NoteController::class, 'index'])
        ->name('enotes.notes.index');

    Route::post('/{workspace:ulid}/notes/search', [NoteController::class, 'search'])
        ->name('enotes.notes.search');

    Route::get('/{note:ulid}/show', [NoteController::class, 'show'])
        ->name('enotes.notes.show');

    Route::get('/{note:ulid}/show/content', [NoteController::class, 'showContent'])
        ->name('enotes.notes.show-content');

    Route::middleware('throttle:30,1')->post('/{workspace:ulid}', [NoteController::class, 'store'])
        ->name('enotes.notes.store');

    Route::middleware('throttle:30,1')->put('/{note:ulid}', [NoteController::class, 'update'])
        ->name('enotes.notes.update');

    Route::put('/{note:ulid}/section', [NoteController::class, 'updateSection'])
        ->name('enotes.notes.update-section');

    Route::put('/{note:ulid}/color', [NoteController::class, 'updateColor'])
        ->name('enotes.notes.update-color');

    Route::delete('/{note:ulid}', [NoteController::class, 'destroy'])
        ->name('enotes.notes.destroy');

    Route::get('/{note:ulid}/share/show', [NoteShareController::class, 'show'])
        ->name('enotes.notes.share.show');

    Route::post('/{note:ulid}/share/public/enable', [NoteShareController::class, 'publicEnable'])
        ->name('enotes.notes.share.public.enable');

    Route::post('/{note:ulid}/share/public/disable', [NoteShareController::class, 'publicDisable'])
        ->name('enotes.notes.share.public.disable');
});
