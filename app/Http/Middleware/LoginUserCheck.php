<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KnowledgeMemo;

class LoginUserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $selectedMemoId = $request->memoId;
        $selectedMemo = KnowledgeMemo::find($selectedMemoId);
        $selectedMemoUser = $selectedMemo->user_id;
        $userId = Auth::id();
        if($selectedMemoUser !== $userId) {
            return redirect()->route('top');
        }
        return $next($request);
    }
}
