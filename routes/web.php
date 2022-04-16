<?php

use App\Http\Controllers\CountriesController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/countries-list', [CountriesController::class, 'index'])->name('countries.list');
Route::post('/add-countries', [CountriesController::class, 'addCountry'])->name('add.countries');
Route::get('/getCountryList', [CountriesController::class, 'getCountryList'])->name('get.countries.list');