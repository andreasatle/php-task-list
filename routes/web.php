<?php

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

// Route to the root of the application
Route::get('/', function () {
    return 'Main page';
});

// Route to the hello page
Route::get('/hello', function () {
    return 'Hello';
})->name('route-hello');

// Route to the hello page with a name
Route::get('/greet/{name}', function ($name) {
    return 'Hello ' . $name . '!';
});

// Route redirecting to the hello page
Route::get('/hallo', function () {
    //return redirect('/hello');
    return redirect()->route('route-hello');
});

Route::fallback(function () {
    return 'Page not found';
});