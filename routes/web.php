<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductCommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Public Jehem Meadolan site. Shop owners and admins manage data from the
| Filament panel at /admin (see App\Providers\Filament\AdminPanelProvider).
|
*/

Route::get('/', HomeController::class)->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/detail-product/{id}', [ProductController::class, 'show'])->whereNumber('id')->name('products.show');
Route::post('/detail-product/{id}/comments', [ProductCommentController::class, 'store'])
    ->whereNumber('id')
    ->middleware(['auth', 'throttle:10,1'])
    ->name('products.comments.store');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('throttle:5,1')->name('register.store');
});
