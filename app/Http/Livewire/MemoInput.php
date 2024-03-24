<?php

namespace App\Http\Livewire;

use App\Models\KnowledgeMemo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MemoInput extends Component
{
    public $title;

    protected $rules = [
        'title' => 'required',
    ];

    protected $validationAttributes = [
        'title' => 'タイトル',
    ];

    protected $messages = [
        'required' => ':attributeは必ず指定してください。',
    ];

    public function create(): void
    {
        // バリデーション発動
        $this->validate();

        // ユーザーとくっついたメモを作成
        Auth::user()->knowledgeMemos()->create([
            'title' => $this->title,
        ]);

        // 親コンポーネントを更新
        $this->emitUp('RefreshMemos');

        // フォームに入力したタイトルをリセット
        $this->reset('title');

        // 今のところでないけど保存完了のメッセージ
        session()->flash('message', '保存しました');
    }

    // 更新される度にレンダリング
    public function render()
    {
        return view('livewire.memo-input');
    }
}
