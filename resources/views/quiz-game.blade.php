<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <h2>★クイズ☆</h2>

    {{ $quiz->question }}<br>
    <div style="padding-top: 10px; padding-bottom: 10px;">
    <label for="quizAnswer">回答</label><br>
    <input id="quizAnswer">
    <input type="hidden" id="quizId" value="{{ $quiz->id }}">
    </div>
    <button type="button" id="sendAnswer">送信</button>
    <input type="hidden" id="quizCategory" value="{{ $quizCategory }}">
    <div id="quizResult" style="padding: 20px 0px 20px 0px;"></div>
    <div id="quizInfo"></div>
    <div class="exitQuiz" style="padding: 20px 0px 20px 0px;"><a href="/play-quiz/home">ジャンル選択に戻る<a></div>
</x-app-layout>
