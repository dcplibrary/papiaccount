<?php

use Dcplibrary\PAPIAccount\App\Http\Controllers\PAPIAccountController;
use Dcplibrary\PAPIAccount\App\Livewire\PatronDashboard;
use Dcplibrary\PAPIAccount\App\Livewire\PatronInformation;
use Dcplibrary\PAPIAccount\App\Livewire\PatronRenew;
    use Dcplibrary\PAPIAccount\App\Livewire\Test;
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

Route::get('/test', function () {
    return view('papiaccount::test');
});

Route::get('dashboard', PatronDashboard::class);
Route::get('information', PatronInformation::class);
Route::get('renew', PatronRenew::class);
Route::get('dashboard/{view}', PatronDashboard::class);
