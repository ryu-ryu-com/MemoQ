<?php

namespace App\Http\Livewire;

use App\Models\KnowledgeMemo;
use Livewire\Component;

class DeleteModal extends Component
{
    public $showDeleteModal = false;
    public $memo;

    protected $listeners = ['openDeleteModal' => 'openDeleteModal'];

    public function render()
    {
        return view('livewire.delete-modal');
    }

    public function openDeleteModal(KnowledgeMemo $value): void
    {
//        dd($value);//とりあえずddまで動いた
        $this->memo = $value;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
    }

    public function deleteMemo(): void
    {
        $this->memo->delete();
        $this->showDeleteModal = false;
        $this->emitUp('RefreshMemos');
    }
}
