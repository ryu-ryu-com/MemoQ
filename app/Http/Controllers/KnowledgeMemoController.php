<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeMemo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\DeleteMemoService;
use Illuminate\Http\Response;
use \Illuminate\Contracts\View\View;
use App\Exceptions\NotFoundException;
use App\Models\Quiz;
use App\Models\QuizCategory;

class KnowledgeMemoController extends Controller
{

    private DeleteMemoService $deleteMemo;

    /**
     * @param DeleteMemoService $deleteMemoService
     */
    public function __construct(DeleteMemoService $deleteMemoService)
    {
        $this->deleteMemo = $deleteMemoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $knowledgeMemos = KnowledgeMemo::where('user_id', Auth::id())->get();
        return view('dashboard', compact('knowledgeMemos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request \Illuminate\Http\Request $memo_title
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $knowledgeMemo= Auth::user()->knowledgeMemos()->create(['title' => $request->memoTitle,]);
        return response()->json(['memo_id' => $knowledgeMemo->id, 'title' => $knowledgeMemo->title, 'updated_at' => $knowledgeMemo->updated_at->format("Y-m-d H:i:s")]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KnowledgeMemo $knowledgeMemo
     * @return \Illuminate\Http\Response
     */
    public function show(KnowledgeMemo $knowledgeMemo)
    {
        $quizCategories = QuizCategory::all();
        return view('memo-detail', compact('knowledgeMemo', 'quizCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KnowledgeMemo  $knowledgeMemo
     * @return \Illuminate\Http\Response
     */
    public function edit(KnowledgeMemo $knowledgeMemo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\KnowledgeMemo $knowledgeMemo
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function updateTitle(Request $request, KnowledgeMemo $knowledgeMemo)
    {
            $knowledgeMemo->title = $request->memoTitle;
            $knowledgeMemo->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KnowledgeMemo $knowledgeMemo
     * @return void
     */
    public function updateContent(Request $request, KnowledgeMemo $knowledgeMemo)
    {
            $knowledgeMemo->content = $request->memoContent;
            $knowledgeMemo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request \Illuminate\Http\Request  $memo_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $memoDelete = $this->deleteMemo->deleteMemo($request->memoId);

        if(!$memoDelete)
        {
            return response()->json($this->deleteMemo->getDeleteMessage(),
                \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($this->deleteMemo->getDeleteMessage(),
            \Illuminate\Http\Response::HTTP_OK);
    }
}
