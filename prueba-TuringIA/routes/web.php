<?php

use Illuminate\Support\Facades\Route;

#Logins
Route::get('/', function () { return view('/Login/loginUsers'); })->name('home');
Route::get('/Login/loginAdmins', function () { return view('/Login/loginAdmins'); })->name('v_loginAdmins');

#sign up
Route::get('/Login/sign-up', function () { return view('/Login/sign-up'); })->name('v_sign-up');
