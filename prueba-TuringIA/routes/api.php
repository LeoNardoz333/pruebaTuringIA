<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



#CRUD Categorias
Route::get('/categoria', [App\Http\Controllers\Api\ApiCategorias::class, 'index']);
Route::post('/categoria', [App\Http\Controllers\Api\ApiCategorias::class, 'store']);
Route::delete('/categoria/{id}', [App\Http\Controllers\Api\ApiCategorias::class, 'destroy']);

#CRUD Platillos
Route::get('/platillos', [App\Http\Controllers\Api\ApiPlatillos::class, 'index']); 
Route::post('platillos', [App\Http\Controllers\Api\ApiPlatillos::class, 'store']);
Route::get('platillos/{id}', [App\Http\Controllers\Api\ApiPlatillos::class, 'show']);
Route::patch('/platillos/{id}', [App\Http\Controllers\Api\ApiPlatillos::class, 'update']);
Route::delete('/platillos/{id}', [App\Http\Controllers\Api\ApiPlatillos::class, 'destroy']);

#CRUD Ventas
Route::get('/ventas', [App\Http\Controllers\Api\ApiVentas::class, 'index']);
Route::post('/ventas', [App\Http\Controllers\Api\ApiVentas::class, 'store']);
Route::get('/ventas/{id}', [App\Http\Controllers\Api\ApiVentas::class, 'show']);
Route::patch('/ventas/{id}', [App\Http\Controllers\Api\ApiVentas::class, 'update']);
Route::delete('/ventas/{id}', [App\Http\Controllers\Api\ApiVentas::class, 'destroy']);