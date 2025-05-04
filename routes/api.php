<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\PeminjamanAPIController;
use App\Http\Controllers\API\BukuAPIController;
use App\Http\Controllers\API\UserAPIController;

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

// Public routes
Route::post('/register', [AuthAPIController::class, 'register']);
Route::post('/login', [AuthAPIController::class, 'login']);

// Books public routesphp artisan route:list --path=api
Route::get('/books', [BukuAPIController::class, 'getAllBooks']);
Route::get('/books/{id}', [BukuAPIController::class, 'getBookDetail']);
Route::get('/categories', [BukuAPIController::class, 'getCategories']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthAPIController::class, 'logout']);

    // User profile
    Route::get('/user/profile', [UserAPIController::class, 'profile']);
    Route::put('/user/profile', [UserAPIController::class, 'updateProfile']);
    Route::post('/user/avatar', [UserAPIController::class, 'updateAvatar']);

    // Borrowed books
    Route::get('/peminjaman', [PeminjamanAPIController::class, 'getPeminjaman']);
    Route::post('/peminjaman', [PeminjamanAPIController::class, 'pinjamBuku']);
    Route::put('/peminjaman/{id}/return', [PeminjamanAPIController::class, 'kembalikanBuku']);
});
