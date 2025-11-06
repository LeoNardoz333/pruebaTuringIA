<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuarios;
use App\Http\Controllers\ApiCategorias;
use App\Http\Controllers\ApiPlatillos;
use App\Http\Controllers\ApiVentas;

#Logins
Route::get('/', function () { return view('/Login/loginUsers'); })->name('home');
Route::get('/Login/loginAdmins', function () { return view('/Login/loginAdmins'); })->name('v_loginAdmins');

Route::post('/Login/loginUsers', [Usuarios::class, 'validarLogin'])->name('login.validate');

#sign up
Route::get('/Login/sign-up', function () { return view('/Login/sign-up'); })->name('v_sign-up');
Route::post('/Login/sign-up', [Usuarios::class, 'store'])->name('user.store');

#home menus
Route::get('/Menus/menu-admins', function () { return view('/Menus/menu-admins'); })->name('v_menu-admins');
Route::get('/Menus/menu-usuarios', function () { return view('/Menus/menu-usuarios'); })->name('v_menu-usuarios');

#CRUD Categorias
Route::get('/CRUDS/agregarCategoria', [App\Http\Controllers\Api\ApiCategorias::class, 'index'])
->name('categoria.index');
Route::post('/CRUDS/agregarCategoria', [App\Http\Controllers\Api\ApiCategorias::class, 'store'])
->name('categoria.store');
Route::get('/CRUDS/agregarCategoria/{id}', [App\Http\Controllers\Api\ApiCategorias::class, 'show'])
->name('categoria.edit');
Route::patch('/CRUDS/agregarCategoria/{id}', [App\Http\Controllers\Api\ApiCategorias::class, 'update'])
->name('categoria.update');
Route::patch('/CRUDS/agregarCategoria/{id}', [App\Http\Controllers\Api\ApiCategorias::class, 'destroy'])
->name('categoria.destroy');

#CRUD Platillos
Route::get('/CRUDS/agregarPlatillo', [App\Http\Controllers\Api\ApiPlatillos::class, 'index'])
    ->name('platillo.index');
Route::post('/CRUDS/agregarPlatillo', [App\Http\Controllers\Api\ApiPlatillos::class, 'store'])
    ->name('platillo.store');
Route::get('/CRUDS/agregarPlatillo/{id}', [App\Http\Controllers\Api\ApiPlatillos::class, 'show'])
    ->name('platillo.edit');
Route::patch('/CRUDS/agregarPlatillo/{id}', [App\Http\Controllers\Api\ApiPlatillos::class, 'update'])
    ->name('platillo.update');
Route::delete('/CRUDS/agregarPlatillo/{id}', [App\Http\Controllers\Api\ApiPlatillos::class, 'destroy'])
    ->name('platillo.destroy');

#CRUD Ventas
Route::get('/CRUDS/agregarVenta', [App\Http\Controllers\Api\ApiVentas::class, 'index'])
    ->name('venta.index');
Route::post('/CRUDS/agregarVenta', [App\Http\Controllers\Api\ApiVentas::class, 'store'])
    ->name('venta.store');
Route::get('/CRUDS/agregarVenta/{id}', [App\Http\Controllers\Api\ApiVentas::class, 'show'])
    ->name('venta.edit');
Route::patch('/CRUDS/agregarVenta/{id}', [App\Http\Controllers\Api\ApiVentas::class, 'update'])
    ->name('venta.update');
Route::delete('/CRUDS/agregarVenta/{id}', [App\Http\Controllers\Api\ApiVentas::class, 'destroy'])
    ->name('venta.destroy');

#CRUD Usuarios
Route::get('/CRUDS/agregarUsuario', [Usuarios::class, 'index'])
    ->name('usuario.index');
Route::post('/CRUDS/agregarUsuario', [Usuarios::class, 'store'])
    ->name('usuario.store');
Route::get('/CRUDS/agregarUsuario/{id}', [Usuarios::class, 'show'])
    ->name('usuario.edit');
Route::patch('/CRUDS/agregarUsuario/{id}', [Usuarios::class, 'update'])
    ->name('usuario.update');
Route::delete('/CRUDS/agregarUsuario/{id}', [Usuarios::class, 'destroy'])
    ->name('usuario.destroy');