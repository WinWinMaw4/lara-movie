<?php

use App\Http\Controllers\ActorsController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\TvController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/fetch',[MovieController::class,'fetch'])->name('fetch');
Route::resource('/movie',MovieController::class);
Route::get('/movie/{section}/all/page/{page?}',[MovieController::class,'seeAll'])->name('movie.seeAll');
Route::resource('/actor',ActorsController::class);
Route::view('/actors/show','actors.show');
Route::get('/actor/page/{page?}',[ActorsController::class,'index']);
Route::resource('/tv',TvController::class);
Route::get('/tv/{section}/all/page/{page?}',[TvController::class,'seeAll'])->name('tv.seeAll');
Route::get('/tv/{tvId}/season',[SeasonController::class,'index'])->name('season.index');
Route::get('/tv/{tvId}/season/{season_number}',[SeasonController::class,'show'])->name('season.show');

//    Route::view('/tv/show','tv.show');


