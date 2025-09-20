<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'app/v1',
    'middleware' => ['locale'],
], function () {
    require __DIR__ . '/app/site.php';
    require __DIR__ . '/app/localizations.php';
});

Route::group([
    'prefix' => 'app/v1',
    'middleware' => ['auth:sanctum', 'locale'],
], function () {
    require __DIR__ . '/app/auth.php';
    require __DIR__ . '/app/account.php';
    require __DIR__ . '/app/profile.php';
    require __DIR__ . '/app/dictionaries.php';
    require __DIR__ . '/app/support.php';
});
