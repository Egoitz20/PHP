<?php

use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return view('home');
})->name('home');

// Se pone historioa.historioa por que pertenece a una subcarpeta
Route::get('/historioa', function () {
    return view('historioa.historioa');
})->name('historioa');

Route::get('/kokapena', function () {
    return view('kokapena.kokapena');
})->name('kokapena');

Route::get('/ordutegia-eta-kontaktua', function () {
    return view('ordutegia-eta-kontaktua.ordutegia-eta-kontaktua');
})->name('ordutegia-eta-kontaktua');
