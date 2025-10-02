<?php

use Dcplibrary\PAPIAccount\App\Http\Controllers\PAPIAccountController;
use Dcplibrary\PAPIAccount\App\Http\Controllers\PatronLogoutController;
    use Dcplibrary\PAPIAccount\App\Livewire\{PatronDashboard, PatronLocationTest, PatronLogin, PatronNotificationsTest};
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
        Route::get('notifications-test', PatronNotificationsTest::class);
        Route::get('location-test', PatronLocationTest::class);

        // Helper routes for testing session values
        Route::get('set-delivery-option/{id}', function ($id) {
            session(['DeliveryOptionID' => (int)$id]);
            return redirect('notifications-test')->with('message', "Delivery option set to ID: {$id}");
        });
        
        Route::get('clear-delivery-option', function () {
            session()->forget('DeliveryOptionID');
            return redirect('notifications-test')->with('message', 'Session cleared - will use default (8)');
        });
    });
});
