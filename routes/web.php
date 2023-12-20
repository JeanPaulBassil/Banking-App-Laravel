<?php

use App\Http\Controllers\AccountController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AgentController;
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
Route::get('account/create', [AccountController::class, 'showCreateAccount'])->name('account.create')->middleware(['auth', 'client']);
Route::post('account/create', [AccountController::class, 'createAccount'])->name('account.create')->middleware(['auth', 'client']);
Route::delete('account/{account}', [AccountController::class,'destroy'])->name('account.destroy')->middleware(['auth', 'client']);
Route::get('account/{account}/transfer', [TransactionController::class, 'showTransferForm'])->name('fund.transfer')->middleware(['auth', 'client']);
Route::get('account/transactions', [AccountController::class, 'showTransactionHistory'])->name('account.transactions')->middleware(['auth', 'client']);


// Routes for Transactions and transfers
Route::post('transaction/execute', [TransactionController::class, 'executeTransfer'])->name('transaction.execute')->middleware(['auth', 'client']);

// Routes for the Agent dashboard
Route::get('agent/dashboard', [AgentController::class, 'showDashboard'])->name('agent.dashboard')->middleware(['auth', 'agent']);
Route::get('agent/operations', [AgentController::class, 'showClientOperations']) ->name('agent.operations')->middleware(['auth', 'agent']);
Route::get('agent/accounts', [AgentController::class, 'showClientAccounts']) ->name('agent.accounts')->middleware(['auth', 'agent']);
Route::get('agent/pending', [AgentController::class, 'showPendingAccounts'])->name('agent.pending')->middleware(['auth', 'agent']);
Route::post('agent/accept/{account}', [AgentController::class, 'acceptAccount'])->name('agent.accept')->middleware(['auth', 'agent']);
Route::delete('agent/delete/{account}', [AgentController::class, 'deleteAccount'])->name('agent.delete')->middleware(['auth', 'agent']);
Route::post('agent/disable/{account}', [AgentController::class, 'disableAccount'])->name('agent.disable')->middleware(['auth', 'agent']);
Route::post('agent/enable/{account}', [AgentController::class, 'enableAccount'])->name('agent.enable')->middleware(['auth', 'agent']);
Route::get('agent/transaction/{account}', [AgentController::class, 'showTransactionForm'])->name('agent.transaction')->middleware(['auth', 'agent']);
Route::post('agent/transaction/{account}', [AgentController::class, 'performTransaction'])->name('agent.performTransaction')->middleware(['auth', 'agent']);
Route::get('agent/transactions', [AgentController::class, 'showTransactions'])->name('agent.transactions')->middleware(['auth', 'agent']);