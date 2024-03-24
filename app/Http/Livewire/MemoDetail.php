<?php

namespace App\Http\Livewire;

use App\Models\KnowledgeMemo;
use App\Models\QuizCategory;
use Illuminate\Support\Collection;
use Livewire\Component;

class MemoDetail extends Component
{
    public KnowledgeMemo $knowledgeMemo;
    public string $title;
    public string $content;
    public bool $editTitle;
    public bool $editContent;
    public Collection $QuizCategories;
    public bool $isPublish;

    protected $rules = [
    ];

    public function mount(KnowledgeMemo $knowledgeMemo): void
    {
        $this->knowledgeMemo = $knowledgeMemo;
        $this->title = $knowledgeMemo->title;
        $this->content = $knowledgeMemo->content;
        $this->isPublish = $knowledgeMemo->is_publish;
        // TODO::all()はDBの状態依存で順番が決まるので、DB側で順を設定するかモデルで並べ替えをする
        $this->quizCategories = QuizCategory::all();
    }

    public function updatedIsPublish($value): void
    {
        $this->knowledgeMemo->is_publish = $value;
        $this->knowledgeMemo->save();
    }

    public function startEditing($target): void
    {
        if ($target === 'title') {
            $this->editContent = false;
            $this->editTitle = true;
        } elseif ($target === 'content') {
            $this->editTitle = false;
            $this->editContent = true;
        }
    }

    public function stopEditing($target): void
    {
        $memo = $this->knowledgeMemo;
        if ($target === 'title') {
            $memo->title = $this->title;
            $memo->save();
            $this->editTitle = false;
        } elseif ($target === 'content') {
            $memo->content = $this->content;
            $memo->save();
            $this->editContent = false;
        }
    }

    public function render()
    {
        return view('livewire.memo-detail');
    }
}
