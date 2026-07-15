<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes (Breeze) 
require __DIR__.'/auth.php';

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/search', [AdminController::class, 'searchUsers'])->name('admin.users.search');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admins', [AdminController::class, 'admins'])->name('admin.admins');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');
    Route::get('/charts', [AdminController::class, 'charts'])->name('admin.charts');
    Route::get('/data-tables', [AdminController::class, 'dataTables'])->name('admin.datatables');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::get('/security', [AdminController::class, 'security'])->name('admin.security');
    Route::post('/security', [AdminController::class, 'updatePassword'])->name('admin.security.update');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile/photo', [AdminController::class, 'updatePhoto'])->name('admin.profile.photo');
});

// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/user/update-profile', [UserController::class, 'updateProfile'])->name('user.update.profile');
    Route::post('/user/update-password', [UserController::class, 'updatePassword'])->name('user.update.password');
});