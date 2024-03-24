<div>
    @if(session()->has('messages'))
    <div class="text-red-800">
        {{session('messages')}}
    </div>
    @endif
    <form wire:submit.prevent="create">
        <label>
            <input type="text" wire:model.lazy="title">
        </label>
        <button class="bg-gray-300 text-gray-700 rounded p-2 mb-5">追加する</button>
        @error('title')<span style="color: red">{{$message}}</span> @enderror
    </form>
</div>
