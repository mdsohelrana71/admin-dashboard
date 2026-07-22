<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductBrandController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes (Breeze) 
require __DIR__.'/auth.php';

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/search', [AdminController::class, 'searchUsers'])->name('users.search');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/admins', [AdminController::class, 'admins'])->name('admins');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');
    Route::get('/charts', [AdminController::class, 'charts'])->name('charts');
    Route::get('/data-tables', [AdminController::class, 'dataTables'])->name('datatables');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::get('/security', [AdminController::class, 'security'])->name('security');
    Route::post('/security', [AdminController::class, 'updatePassword'])->name('security.update');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile/photo', [AdminController::class, 'updatePhoto'])->name('profile.photo');

    Route::resource('product-brands', ProductBrandController::class);
});

// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/user/update-profile', [UserController::class, 'updateProfile'])->name('user.update.profile');
    Route::post('/user/update-password', [UserController::class, 'updatePassword'])->name('user.update.password');
});