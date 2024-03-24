<div>
    @if ($editTitle)
        <label>
            <input wire:model="title" wire:blur="stopEditing('title')" type="text" >
        </label>
    @else
        <h3 wire:click="startEditing('title')">{{ $knowledgeMemo->title }}</h3>
    @endif

    @if ($editContent)
        <label>
            <textarea wire:model="content" wire:blur="stopEditing('content')" rows="20" cols="40"></textarea>
        </label>
    @else
        <label>
            <p wire:click="startEditing('content')" style="height:250px">{{ $knowledgeMemo->content }}</p>
        </label>
    @endif

        <br/>
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" wire:model="isPublish" class="custom-control-input" id="publicMemo">
                <label class="custom-control-label" for="publicMemo">メモを公開する</label>
            </div>
        </div>
{{--    クイズ編集機能は後で作る--}}
    <br/>
{{--    クイズは10文字以上省略とかにしないとURLが長くなるかも--}}
    @foreach($knowledgeMemo->quizzes as $quiz)
        <a href="">{{ $quiz->question }}</a><br/>
    @endforeach

    <br/>
    <h3>クイズの追加</h3>
    <form action="{{ route('quizzes.create') }}">
        <label for="quizQuestion">問題</label><br/>
        <textarea rows="3" id="quizQuestion" name="quizQuestion"></textarea><br/>
        <label for="quizAnswer">答え</label><br/>
        <input id="quizAnswer" name="quizAnswer"><br/>
        <label for="quizCategory">カテゴリー</label><br/>
        <select id="quizCategory" name="quizCategory">
            @foreach($quizCategories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <input type="hidden" value="{{ $knowledgeMemo->id }}" name="memoId">
        <br/><br/><button>送信</button>
    </form>
</div>
