<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeMemo;
use Illuminate\Http\Request;

class MemoDetailController extends Controller
{
    public function memoDetail()
    {
        return view('livewire.memo-detail');
    }
}
