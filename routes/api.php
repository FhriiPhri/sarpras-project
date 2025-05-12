<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Kategori;
use App\Http\Controllers\AuthController;

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

Route::get('/users', function () {
    return response()->json(User::all());
});

Route::get('/kategori', function () {
    return response()->json(Kategori::all());
});


Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/barangs', [App\Http\Controllers\API\BarangController::class,'index']);
    Route::post('/pinjem', [App\Http\Controllers\PeminjamanController::class, 'store']);
});