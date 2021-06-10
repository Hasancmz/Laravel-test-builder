<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StatuController;
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
Route::get('/quizzes/{slug}', [MainController::class, 'category'])->name('quizzes.category');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// User route
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/myquizzes', [MainController::class, 'myquizzes'])->name('user.myquizzes');
    Route::get('/{slug}/questions', [MainController::class, 'questions'])->name('user.questions');
    Route::post('/{slug}/result', [MainController::class, 'result'])->name('user.result');
    Route::get('/quiz/{slug}/active', [MainController::class, 'quizActive'])->name('quiz.active');
    Route::resource('/quiz', QuizController::class);
    Route::resource('/quiz/{slug}/questions', QuestionController::class);
});

// Admin route
Route::group(['middleware' => ['auth', 'adminChecker'], 'prefix' => 'admin'], function () {
    Route::get('/quizzes/active', [StatuController::class, 'active'])->name('quizzes.active');
    Route::get('/quizzes/draft', [StatuController::class, 'draft'])->name('quizzes.draft');
    Route::get('/quizzes/passive', [StatuController::class, 'passive'])->name('quizzes.passive');
    Route::resource('/quizzes', AdminController::class);
});
