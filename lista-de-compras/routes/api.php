<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ShoppingListController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/items', [ItemController::class, 'index']);
Route::get('items/{shopping_list_id}', [ItemController::class, 'filterByShoppingList']);
Route::prefix('/item')->group(function () {
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
});

Route::get('/shopping-lists', [ShoppingListController::class, 'index']);
Route::prefix('/shopping-list')->group(function () {
    Route::post('/store', [ShoppingListController::class, 'store']);
    Route::put('/{id}', [ShoppingListController::class, 'update']);
    Route::delete('/{id}', [ShoppingListController::class, 'destroy']);
});