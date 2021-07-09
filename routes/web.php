<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FeedbackController;

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
Route::get('/author/{feedback}', [FeedbackController::class, 'author'])
                ->middleware('auth');

Route::post('/edit', [FeedbackController::class, 'edit'])
                ->middleware('auth');

Route::get('/myfeedback/{feedback}', [FeedbackController::class, 'editingPage'])
                ->middleware('auth');

Route::get('/city', [CityController::class, 'takeYes']);

Route::get('/back', [CityController::class, 'takeNo']);

Route::get('/myfeedbacks', [FeedbackController::class, 'show'])
                ->middleware('auth');

Route::post('/feedbacks-create', [FeedbackController::class, 'create'])
                ->middleware('auth');

Route::get('/feedbacks-create', [FeedbackController::class, 'store'])
                ->middleware('auth');

Route::get('/feedbacks/{city}', [CityController::class, 'take']);


Route::get('/{feedback}/img', [FeedbackController::class, 'img']);


Route::get('/cities', [CityController::class, 'get']);

Route::get('/', [CityController::class, 'welcome']);


require __DIR__.'/auth.php';
