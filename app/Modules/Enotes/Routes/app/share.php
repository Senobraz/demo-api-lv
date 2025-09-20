<?php

use Illuminate\Support\Facades\Route;

Route::get('/share/n/{key}/{code}')
    ->name('enotes.share.public');

