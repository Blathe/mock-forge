<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EndpointController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {
    //Endpoint endpoints
    Route::get('endpoints', [EndpointController::class, 'index'])
        ->name('endpoints.index');
    Route::get('endpoints/create', [EndpointController::class, 'create'])
        ->name('endpoints.create');
    Route::get('endpoints/{id}', [EndpointController::class, 'show'])
        ->name('endpoints.show');
    Route::get('endpoints/delete', [EndpointController::class, 'delete'])
        ->name('endpoints.delete');

    Route::post('endpoints/{id}/update', [EndpointController::class, 'update'])
        ->name('endpoints.update');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
