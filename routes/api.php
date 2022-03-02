<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    AuthorController,
    BookController,
    CategoryController,
    ChatController,
    UserController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function()
{
    // Author routes
    Route::get('author', [AuthorController::class, 'index']);
    Route::post('author', [AuthorController::class, 'store']);
    Route::put('author/{id}', [AuthorController::class, 'update']);
    Route::delete('author/{id}', [AuthorController::class, 'destroy']);

    // Book routes
    Route::get('book', [BookController::class, 'index']);
    Route::post('book', [BookController::class, 'store']);
    Route::put('book/{id}', [BookController::class, 'update']);
    Route::delete('book/{id}', [BookController::class, 'destroy']);

    // Category routes
    Route::get('category', [CategoryController::class, 'index']);
    Route::post('category', [CategoryController::class, 'store']);
    Route::put('category/{id}', [CategoryController::class, 'update']);
    Route::delete('category/{id}', [CategoryController::class, 'destroy']);

    // User routes
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);

    // Chat routes


    Route::get('logout', [AuthController::class, 'logout']);
});
