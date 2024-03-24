<?php

use App\Http\Livewire\PublicMemo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KnowledgeMemoController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\PlayQuizController;
use App\Http\Controllers\MemoDetailController;

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
})->name('top');

Route::get('/dashboard', '\App\Http\Controllers\KnowledgeMemoController@index')->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('/memos/destroy', [KnowledgeMemoController::class, 'destroy'])->name('memos.destroy');
Route::post('/memos/create', [KnowledgeMemoController::class, 'create'])->name('memos.create');
Route::post('/memos/{knowledgeMemo}/update-title', [KnowledgeMemoController::class, 'updateTitle'])->name('memos.updateTitle');
Route::post('/memos/{knowledgeMemo}/update-content', [KnowledgeMemoController::class, 'updateContent'])->name('memos.updateContent');

//Route::get('/memos/{knowledgeMemo}', [KnowledgeMemoController::class, 'show'])->name('memos.show');
// ->middleware(['auth'])->middleware(['user.check']) 一旦外す

Route::get('/memo-detail/{knowledgeMemo}', App\Http\Livewire\MemoDetail::class)->name('memo.detail');

Route::resource('quizzes', QuizController::class);

Route::get('/play-quiz/home', [PlayQuizController::class, 'index'])->name('playQuiz.home');
Route::get('/play-quiz/game/{quizCategory}', [PlayQuizController::class, 'show'])->name('playQuiz.game');
Route::post('play-quiz/game-answer', [PlayQuizController::class, 'check'])->name('check.answer');

Route::get('/public-memo', PublicMemo::class)->name('publicMemo.home');
//Route::get('/public-memo/{publicMemo}')->name('publicMemo.detail');
