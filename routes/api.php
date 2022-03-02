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
    Route::get('author', [AuthorController::class, 'index']);
    Route::post('author', [AuthorController::class, 'store']);
    Route::put('author/{id}', [AuthorController::class, 'update']);
    Route::delete('author/{id}', [AuthorController::class, 'delete']);

    Route::resource('book', BookController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('user', UserController::class);

    // Chat


    Route::get('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
