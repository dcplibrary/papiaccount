<?php

use Illuminate\Support\Facades\Route;
use Dcplibrary\PAPIAccount\App\Http\Controllers\PAPIAccountController;

/*
|--------------------------------------------------------------------------
| PAPIAccount Routes  
|--------------------------------------------------------------------------
*/

Route::group([
    'prefix' => 'papiaccount',
    'middleware' => ['web'],
], function () {
    Route::get('/index', [PAPIAccountController::class, 'index'])->name('papiaccount.index');
});
