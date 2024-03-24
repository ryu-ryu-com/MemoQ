<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use App\Models\KnowledgeMemo;

class Memo extends Component
{
    protected $listeners = ['RefreshMemos' => '$refresh'];
    public $showDeleteModal = false;

    public function render()
    {
        // ユーザーに紐づいてるやつに変える
        $memos = KnowledgeMemo::where('user_id', Auth::user()->id)->get();
        return view('livewire.memo', compact('memos'));
    }

    public function deleteMemo(KnowledgeMemo $memo): void
    {
        // 複数タブで開いて削除した場合など。$memoが存在しない場合に404エラーを返す(バインドによって)
        $memo->delete();
        $this->emitSelf('RefreshMemos');
    }


}
