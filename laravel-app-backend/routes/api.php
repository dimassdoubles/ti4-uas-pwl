<?php

use App\Http\Controllers\DetailTransactionController;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products', ProductController::class);

Route::post('user/login', [UserController::class, 'login']);
Route::post('user/daftar', [UserController::class, 'store']);
Route::post('transaction', [TransactionController::class, 'store']);
Route::post('detail-transaction', [DetailTransactionController::class, 'store']);
// Route::get('transaction/{transaction}/detail', [TransactionController::class, 'showDetailTransaction']);
Route::get('transaction/{transaction}', [TransactionController::class, 'showDetailTransaction']);

// playground
