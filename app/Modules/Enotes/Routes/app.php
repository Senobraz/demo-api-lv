<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api/app/v1/enotes',
    'middleware' => ['api', 'auth:sanctum', 'locale']
], function () {
    require __DIR__ . '/app/categories.php';
    require __DIR__ . '/app/sections.php';
    require __DIR__ . '/app/notes.php';
});

Route::group([
    'prefix' => 'api/app/v1/enotes',
    'middleware' => ['api', 'locale']
], function () {
    require __DIR__ . '/app/collaborative.php';
});

require __DIR__ . '/app/share.php';
