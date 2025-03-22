<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BankUserController;
use Illuminate\Support\Facades\Route;

// Welcome page route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Dashboard route (authenticated and verified users only)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Bank user routes (with authentication and verified users)
Route::prefix('bank')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [BankUserController::class, 'index'])->name('bank.index');
    Route::get('/create', [BankUserController::class, 'create'])->name('bank.create');
    Route::post('/', [BankUserController::class, 'store'])->name('bank.store');
    Route::get('/{id}/edit', [BankUserController::class, 'edit'])->name('bank.edit');
    Route::put('/{id}', [BankUserController::class, 'update'])->name('bank.update');
    Route::delete('/{id}', [BankUserController::class, 'destroy'])->name('bank.destroy');
    Route::post('/{id}/withdraw', [BankUserController::class, 'withdraw'])->name('bank.withdraw');
    Route::post('/{id}/deposit', [BankUserController::class, 'deposit'])->name('bank.deposit');
    Route::post('/{id}/transfer', [BankUserController::class, 'transfer'])->name('bank.transfer');
    Route::get('/{id}/transactions', [BankUserController::class, 'transactions'])->name('bank.transactions');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
