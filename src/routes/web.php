<?php

use Dcplibrary\PAPIAccount\App\Http\Controllers\PAPIAccountController;
use Dcplibrary\PAPIAccount\App\Livewire\PatronDashboard;
use Dcplibrary\PAPIAccount\App\Livewire\PatronLogin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PAPIAccount Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => ['web'],
], function () {
    Route::get('/index', [PAPIAccountController::class, 'index'])->name('index');
});

Route::get('dashboard', PatronDashboard::class);
Route::get('dashboard/{view}', PatronDashboard::class);
Route::get('login', PatronLogin::class);
