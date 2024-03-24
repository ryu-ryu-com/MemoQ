<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <livewire:memo></livewire:memo>
    <div style="padding: 40px;"><a href="{{ route('playQuiz.home') }}">クイズをプレイする</a></div>
    <div style="padding: 0 40px"><a href="{{ route('publicMemo.home') }}">みんなのメモを見る</a></div>
</x-app-layout>
