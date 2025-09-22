<?php

use Dcplibrary\PAPIAccount\App\Http\Controllers\PAPIAccountController;
<<<<<<< HEAD
use Dcplibrary\PAPIAccount\App\Livewire\{PatronDashboard,PatronLogin};
=======
use Dcplibrary\PAPIAccount\App\Livewire\PatronDashboard;
use Dcplibrary\PAPIAccount\App\Livewire\PatronLogin;
>>>>>>> 981a538d2b1fb2a35bf33724c384ffcb9b0f8289
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

