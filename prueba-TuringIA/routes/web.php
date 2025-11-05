<?php

use Illuminate\Support\Facades\Route;

#Logins
Route::get('/', function () { return view('/Login/loginUsers'); })->name('home');
Route::get('/Login/loginAdmins', function () { return view('/Login/loginAdmins'); })->name('v_loginAdmins');
