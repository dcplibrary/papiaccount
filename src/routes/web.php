<?php

use Dcplibrary\PAPIAccount\App\Http\Controllers\PAPIAccountController;
use Dcplibrary\PAPIAccount\App\Http\Controllers\PatronLogoutController;
use Dcplibrary\PAPIAccount\App\Livewire\{PatronDashboard,PatronLogin};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PAPIAccount Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['web'])->group(function () {

    // Public routes
    Route::get('/index', [PAPIAccountController::class, 'index'])->name('index');
    Route::get('login', PatronLogin::class);
    Route::get('logout', PatronLogoutController::class);

    // Protected routes for authenticated patrons
    Route::middleware(['access.secret'])->group(function () {
        Route::get('dashboard/{view?}', PatronDashboard::class);
    });

});
