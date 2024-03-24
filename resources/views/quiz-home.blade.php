<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <h2>クイズジャンル選択</h2>
    @foreach($quizCategories as $category)
    <div style="padding-top: 10px; padding-bottom: 10px;"><a href="{{ route('playQuiz.game', ['quizCategory' => $category->id]) }}" style="font-size: 20px;">{{ $category->name }}</a> {{ $category->description }}</div>
    @endforeach
    <div class="exitQuiz" style="padding: 20px 0px 20px 0px;"><a href="/dashboard">クイズをやめる<a></div>
</x-app-layout>
