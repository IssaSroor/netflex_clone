<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WatchlistController;
use Illuminate\Support\Facades\Route;

Route::get('home', [MovieController::class, 'index'])->name('home');
Route::get('/',function(){
    return view('auth/register');
});

Route::get('/watchlist', [WatchlistController::class, 'index'])
    ->middleware('auth')
    ->name('watchlist.index');
    Route::post('/watchlist/add', [WatchlistController::class, 'add'])
    ->middleware('auth')
    ->name('watchlist.add');
    Route::delete('/watchlist/remove/{movie_id}', [WatchlistController::class, 'remove'])->name('watchlist.remove');
    Route::get('/watchlist/details/{movie_id}', [WatchlistController::class, 'show'])->name('watchlist.details');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
