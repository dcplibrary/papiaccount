<?php

use Dcplibrary\PAPIAccount\App\Http\Controllers\PAPIAccountController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PAPIAccount Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'prefix'     => 'papiaccount',
    'middleware' => ['web'],
], function () {
    Route::get('/index', [PAPIAccountController::class, 'index'])->name('papiaccount.index');
});
