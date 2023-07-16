<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/error', function () {
    return Response::make([
        "success" => false,
        "message" => "Please login first with your account."
    ]);
})->name('login');

Route::get('/', function () {
    return view('welcome');
});
