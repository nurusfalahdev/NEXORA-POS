<?php

use App\Http\Controllers\Productscontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/produk', [Productscontroller::class, 'index']);

// produk
Route::put('/produk/{id}', [Productscontroller::class . 'update']);