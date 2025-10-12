<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CommentController;
use App\Http\Middleware\VerifyCsrfToken;
use Filament\Http\Controllers\Auth\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Public API Routes
 */
Route::prefix('v1')->withoutMiddleware([VerifyCsrfToken::class])->group(function () {
    Route::prefix('comments')->group(function () {
        Route::get('/', [CommentController::class, 'paginated']);
    });
    Route::prefix('auth')->group(function () {
        Route::post('/registration', [AuthController::class, 'register']);
    });
});

/**
 * Prive API Routes
 */
Route::middleware('auth.session')->prefix('v1')->group(function () {
    Route::prefix('comments')->group(function () {
        Route::post('/', [CommentController::class, 'create']);
    });
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [LogoutController::class, '__invoke'])->name('logout');
    });
});
