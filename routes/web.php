<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;

// Default Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route (Protected with auth & verified)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Protect User & Account Routes with Authentication
Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('accounts', AccountController::class);
    // Route::resource('transactions', TransactionController::class);
    Route::get('/accounts/{account}/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create/{account}', [TransactionController::class, 'create'])->name('transactions.create');

    Route::resource('transactions', TransactionController::class)->except(['index','create']);

});

require __DIR__.'/auth.php';


// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
