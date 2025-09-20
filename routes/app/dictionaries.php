<?php

use App\Http\Controllers\Dictionaries\DictionaryController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'dictionaries',
], function () {
    Route::get('/', [DictionaryController::class, 'index'])
        ->name('dictionaries.index');
});


