<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainCotroller;

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

// index
Route::get('/', [MainCotroller::class, 'home'])
    ->name('home');
Route::get('/movies', [MainCotroller::class, 'movies'])
    ->name('movies');

