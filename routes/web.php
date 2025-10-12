<?php

use App\Filament\Pages\AboutPage;
use App\Filament\Pages\ContactPage;
use App\Filament\Pages\DetailPage;
use App\Filament\Pages\HomePage;
use App\Filament\Pages\RegisterPage;
use Illuminate\Support\Facades\Route;

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

// jehem meadolan
Route::get('/', HomePage::class)->name('home');
Route::get('/about', AboutPage::class)->name('about');
Route::get('/contact', ContactPage::class)->name('contact');
Route::get('/detail-product/{id}', DetailPage::class)->name('detail');
Route::get('/register', RegisterPage::class)->name('register');
