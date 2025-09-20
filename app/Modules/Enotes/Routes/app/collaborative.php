<?php

use App\Modules\Enotes\Http\Controllers\Collaborative\PublicNoteController;
use Illuminate\Support\Facades\Route;

Route::get('/collaborative/public/{key}/{code}', [PublicNoteController::class, 'show'])
    ->name('enotes.collaborative.public.show');

Route::post('/collaborative/public/{note_collaborative:ulid}/report', [PublicNoteController::class, 'report'])
    ->name('enotes.collaborative.public.report');

