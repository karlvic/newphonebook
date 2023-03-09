<?php

use App\Http\Controllers\PhoneController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Route;

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

//Show list
Route::get('/', [PhoneController::class, 'index']);


//Save users info
Route::post('/formRoute', [PhoneController::class, 'saveUsers'])->name('saveUsers');
//Save user provider info
Route::post('/formProvidersRoute', [PhoneController::class, 'saveProviders'])->name('saveProviders');


//Route for search and render the result
Route::get('/subscribers/search', [SearchController::class, 'search'])->name('subscribers.search');
