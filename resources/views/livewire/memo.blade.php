<div>
    <h2>メモ一覧</h2>
    <table>
        <tr><th>メモタイトル</th><th>更新日時</th><th>操作</th></tr>
        @foreach($memos as $memo)
            <tr>
                <td>
                    <a href="{{ route('memo.detail', ['knowledgeMemo' => $memo]) }}">
                        {{ $memo->title === '' ? '(NoTitle)' : $memo->title }}
                    </a>
                </td>
                <td>
                    {{ $memo->updated_at }}
                </td>
                <td>
                    <button wire:click="$emit('openDeleteModal', {{ $memo->id }})">削除</button>
                </td>
            </tr>
        @endforeach
        @livewire('delete-modal')
    </table>
    <div>
        <livewire:memo-input/>
    </div>
</div>
