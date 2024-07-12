<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\Customermiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('dashboard', [AuthController::class, 'showDashboard'])->middleware('auth')->name('dashboard');
Route::get('admin/dashboard', [AuthController::class, 'showAdminDashboard'])->middleware('auth')->name('admin.dashboard');
Route::get('user/dashboard', [AuthController::class, 'showUserDashboard'])->middleware('auth')->name('user.dashboard');

Route::resource('authors', AuthorController::class);
Route::resource('books', BookController::class);
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Update User Route
Route::put('user/{id}', [AuthController::class, 'update'])->middleware('auth')->name('user.update');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::resource('admin', UserController::class);
});

Route::middleware(['auth', Customermiddleware::class])->group(function () {
    Route::resource('customer', UserController::class);
});

