<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

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

// Public route
Route::get('/', [MainController::class, 'home'])->name('public.home');
Route::get('/quizzes', [MainController::class, 'quizzes'])->name('public.quizzes');
Route::get('/quiz/detail/{slug}', [MainController::class, 'quizDetail'])->name('quiz.detail');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// User route
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    Route::resource('/quiz', QuizController::class);
});

// Admin route
Route::group(['middleware' => ['auth', 'adminChecker'], 'prefix' => 'admin'], function () {
    Route::get('/deneme', [QuizController::class, 'index'])->name('index.deneme');
});
