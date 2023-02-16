<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainCotroller;
use App\Http\Controllers\Api\ApiController;

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

// delete
Route::get('/delete/movie/{movie}', [MainCotroller::class, 'delete'])
    ->name('delete.movie');

// create
Route::get('/create/movie', [MainCotroller::class, 'create'])
    ->name('create.movie');
    Route::post('/store/movie', [MainCotroller::class, 'store'])
    ->name('store.movie');

// edit
Route::get('/edit/movie/{movie}', [MainCotroller::class, 'edit'])
    ->name('edit.movie');
Route::post('/update/movie/{movie}', [MainCotroller::class, 'update'])
    ->name('update.movie');


// route api
Route::get('/api/v1/test', [ApiController::class, 'test']);
