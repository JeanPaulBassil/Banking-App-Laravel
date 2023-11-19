<?php

use App\Http\Controllers\AccountController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route for the user dashboard
Route::get('/', [UserController::class, 'showDashboard'])->name('dashboard')->middleware('auth');

// Routes for account creation and management
Route::get('account/create', [AccountController::class, 'showCreateAccount'])->name('account.create')->Middleware('auth');
Route::post('account/create', [AccountController::class, 'createAccount'])->name('account.create')->middleware('auth');