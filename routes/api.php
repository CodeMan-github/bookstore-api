<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Api\BooksController;

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

Route::post('/auth/register', [AuthenticationController::class, 'register']);
Route::post('/auth/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::get('/books/borrowed', [BooksController::class, 'getBorrowed']);
    Route::post('/books/borrow', [BooksController::class, 'borrow']);
    Route::apiResource('/books', BooksController::class);
});
