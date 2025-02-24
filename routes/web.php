<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionLineController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
    Route::get('/readers/search', [ReaderController::class, 'search'])->name('readers.search');
    Route::put('/transaction/update', [TransactionController::class, 'updatee'])->name('transactions.updatee');
});


Route::resource('books', BookController::class)->middleware('auth');
Route::resource('readers', ReaderController::class)->middleware('auth');
Route::resource('transactions', TransactionController::class)->middleware('auth');

require __DIR__ . '/auth.php';
