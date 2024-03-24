<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\QuizCategory;
use App\Models\Quiz;
use App\Models\User;

class PlayQuizController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $quizCategories = QuizCategory::all();
        return view('quiz-home', compact('quizCategories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|null
     */
    public function show(Request $request)
    {
        $quizCategory = $request->quizCategory;
        $quiz = Quiz::where([['quiz_category_id', '=', $quizCategory], ['user_id', '=', Auth::id()]])->inRandomOrder()->first();
        return view('quiz-game', compact('quiz', 'quizCategory'));
    }


    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request)
    {
        $displayedQuizId = $request->displayedQuiz;
        $userAnswer = $request->userAnswer;
        $quiz = Quiz::where('id', '=', $displayedQuizId)->first();
        $quizAnswer = $quiz->answer;
        $knowledgeMemoId = $quiz->knowledge_memo_id;

        if($userAnswer !== $quizAnswer){
            return response()->json(['resultQuiz' => 'incorrect', 'quizAnswer' => $quizAnswer, 'knowledgeMemoId' => $knowledgeMemoId]);//誤答
        }
        return response()->json(['resultQuiz' => 'correct', 'quizAnswer' => $quizAnswer, 'knowledgeMemoId' => $knowledgeMemoId]);//正答
    }
}
