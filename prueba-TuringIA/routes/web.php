<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuarios;

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