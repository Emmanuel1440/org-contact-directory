<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\DashboardController;
// Home

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard (requires auth)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Resourceful routes
Route::middleware(['auth'])->group(function () {
    Route::resource('organizations', OrganizationController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('industries', IndustryController::class);

    // Settings (Livewire Volt)
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Auth scaffolding
require __DIR__.'/auth.php';
