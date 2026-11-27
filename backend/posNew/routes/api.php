<?php

use App\Http\Controllers\Notacontroller;
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
Route::delete('/produk/{id}', [ProductsController::class, 'destroy']);


// kirim
Route::get('/kirim', [Notacontroller::class, 'index']);

// excel import
Route::post('/produk/import', [Productscontroller::class, 'importExcel']);

// export excel
Route::get('/produk/export', [Productscontroller::class, 'exportExcel']);
