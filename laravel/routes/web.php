<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MapController::class, 'index']);
Route::get('/generate-coordinates', [MapController::class, 'generateCoordinates']);