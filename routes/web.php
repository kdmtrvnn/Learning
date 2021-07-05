<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;

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

Route::get('/feedbacks/{city}', [CityController::class, 'take'])
                ->middleware('auth');

Route::get('/cities', [CityController::class, 'get'])
                ->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
