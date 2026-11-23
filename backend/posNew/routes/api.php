<?php

use App\Http\Controllers\Productscontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// produk
Route::get('/produk', [Productscontroller::class, 'index']);
Route::post('/produk', [Productscontroller::class, 'store']);
Route::put('/produk/{id}', [Productscontroller::class, 'update']);
