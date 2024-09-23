<?php

use App\Http\Controllers\CompareController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/mysearches', [SearchController::class, 'index'])->name('mysearches');
    Route::delete('/searches/{id}', [SearchController::class, 'delete'])->name('searches.delete');
    Route::post('/compare', [CompareController::class, 'compare'])->name('compare');
});

Route::post('/weather', [ExternalController::class, 'getWeather'])->name('weather.get');

Route::post('/savesearch', [SearchController::class, 'saveSearch'])->name('savesearch');



