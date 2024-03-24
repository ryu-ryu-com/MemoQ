<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>MemoQ</title>
        @include('layouts.navigation')

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <script>
            $(function() {
                $(document).on('click', '.delete_button', function() {
                    // 2重送信防止
                    $(this).prop('disabled', true).addClass('disabled');

                    var memoId = $(this).data('memo-id');
                    var deleteConfirm = confirm('本当に削除しますか？');

                    if(deleteConfirm == true){
                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: "{{ route('memos.destroy') }}",
                            type: 'POST',
                            data: {'memoId': memoId}
                        })
                        .done(function(data) {
                            $('#memo'+memoId).remove();
                            $('#delete_message').show();
                            setTimeout(function(){
                                $('#delete_message').hide();
                            }, 3000);
                        })
                        .fail(function(response) {
                            console.log(response);
                            alert(response.responseJSON);
                        });
                    }
                    setTimeout(function() {
                        $('.delete_button').prop('disabled', false).removeClass('disabled');
                    }, 3000);
                });
            });
            $(function() {
                $('.create_memo').click(function() {
                    let memoTitle = $('input[name="memo_title"]').val();
                    if(memoTitle === ''){
                        memoTitle = '(NoTitle)';
                    }
                    const inputElement = document.getElementById('create_memo');
                    inputElement.value = '';
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        method: 'POST',
                        url: "{{ route('memos.create') }}",
                        data: {'memoTitle': memoTitle},
                    })
                    .done(function(response) {
                        //テーブルを取ってきてそこから列に入れる準備
                        const table = document.getElementById('memoTable');
                        const newRow = table.insertRow();
                        newRow.setAttribute('id', 'memo'+response.memo_id);

                        //aタグを作成してセルに挿入
                        const newATag = document.createElement('a');
                        newATag.setAttribute("href", "");
                        const newATagText = document.createTextNode(response.title);
                        newATag.appendChild(newATagText);
                        let newCell = newRow.insertCell();
                        newCell.appendChild(newATag);

                        //最終更新日時を挿入
                        newCell = newRow.insertCell();
                        newText = document.createTextNode(response.updated_at);
                        newCell.appendChild(newText);

                        //削除ボタンを作成して挿入
                        const newButtonTag = document.createElement('button');
                        newButtonTag.setAttribute("type", "button");
                        newButtonTag.setAttribute("class", "delete_button");
                        newButtonTag.setAttribute("data-memo-id", response.memo_id);
                        const newButtonTagText = document.createTextNode('削除');
                        newButtonTag.appendChild(newButtonTagText);
                        newCell = newRow.insertCell();
                        newCell.appendChild(newButtonTag);

                        // 長いので後で別のjsファイルに分ける
                    })
                    .fail(function(){
                        alert('メモの作成に失敗しました');
                    });
                });
            });
            $(function() {
                $('#editMemoTitle').each(function(){
                    var backupTitle = $(this).text();
                    $(this).data('backupTitle', backupTitle)
                        .click(function(){
                        if(!$(this).hasClass('on')){
                            $(this).addClass('on');
                            var title = $(this).text();
                            $(this).html('<input type="text" value="'+title+'">');
                            $('h3 > input').focus().blur(function(){
                                var inputValue = $(this).val();
                                if(inputValue === ''){
                                    inputValue = this.defaultValue;
                                }
                                var memoId = $(this).parent().attr('class');
                                $.ajax({
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                url: "/memos/" + memoId + "/update-title",
                                type: 'POST',
                                data: {'memoTitle': inputValue},
                                })
                                .done(function() {
                                })
                                .fail(function() {
                                    alert('変更に失敗しました。');
                                });
                                $(this).parent().removeClass('on').text(inputValue);
                            });
                        }
                    });
                });
                $('#editMemoContent').each(function(){
                    var backupContent = $(this).text();
                    $(this).data('backupContent', backupContent)
                        .click(function(){
                        if(!$(this).hasClass('on')){
                            $(this).addClass('on');
                            var content = $(this).text();
                            $(this).html('<textarea type="text" rows="30" cols="50">'+content+'</textarea>');
                            $('h4 > textarea').focus().blur(function(){
                                var textValue = $(this).val();
                                if(textValue === ''){
                                    textValue = this.defaultValue;
                                }
                                var memoId = $(this).parent().attr('class');
                                $.ajax({
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                url: "/memos/" + memoId + "/update-content",
                                type: 'POST',
                                data: {'memoContent': textValue},
                                })
                                .done(function() {
                                })
                                .fail(function() {
                                    alert('変更に失敗しました。');
                                });
                                $(this).parent().removeClass('on').text(textValue);
                            });
                        }
                    });
                });
                $('#resetMemoForm').click(function(){
                    $('#editMemoTitle').each(function(){
                        var backupTitle = $(this).data('backupTitle');
                        var memoId = $(this).attr('class');
                        $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "/memos/" + memoId + "/update-title",
                        type: 'POST',
                        data: {'memoTitle': backupTitle},
                        })
                        .done(function() {
                        })
                        .fail(function() {
                            alert('変更に失敗しました。');
                        });
                        $(this).text(backupTitle);
                    });
                    $('#editMemoContent').each(function(){
                        var backupContent = $(this).data('backupContent');
                        var memoId = $(this).attr('class');
                        $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "/memos/" + memoId + "/update-content",
                        type: 'POST',
                        data: {'memoContent': backupContent},
                        })
                        .done(function() {
                        })
                        .fail(function() {
                            alert('変更に失敗しました。');
                        });
                        $(this).text(backupContent);
                    });
                });
            });
            $(function() {
                $('#sendAnswer').click(function() {
                    const displayedQuiz = document.getElementById('quizId').value;
                    const userAnswer = document.getElementById('quizAnswer').value;
                    //コントローラーで正答か誤答か確認するよ
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{{ route('check.answer') }}",
                        type: 'POST',
                        data: {'displayedQuiz': displayedQuiz, 'userAnswer': userAnswer},
                        })
                        .done(function(response) {
                            //回答が正解だったらメッセージで祝うよ
                            if(response.resultQuiz === 'correct'){
                                const correctMessage = document.createElement("div");
                                const correctMessageText = document.createTextNode('正解！おめでとう！');
                                const newDiv = correctMessage.appendChild(correctMessageText);
                                const resultDiv = document.getElementById('quizResult');
                                if(resultDiv.childNodes.length !== 0){
                                    const targetDiv = resultDiv.childNodes[0];
                                    resultDiv.removeChild(targetDiv);
                                }
                                resultDiv.appendChild(newDiv);
                            }
                            //回答が間違いなら答え教えるよ
                            if(response.resultQuiz === 'incorrect'){
                                const incorrectMessage = document.createElement("div");
                                const incorrectMessageText = document.createTextNode('残念！正答は：'+response.quizAnswer);
                                const newDiv = incorrectMessage.appendChild(incorrectMessageText);
                                const resultDiv = document.getElementById('quizResult');
                                if(resultDiv.childNodes.length !== 0){
                                    const targetDiv = resultDiv.childNodes[0];
                                    resultDiv.removeChild(targetDiv);
                                }
                                resultDiv.appendChild(newDiv);
                            }

                            const infoDiv = document.getElementById('quizInfo');
                            if(infoDiv.childNodes.length === 0){
                            //復習用に知識メモに飛べるaタグを作るよ
                            const knowledgeMemo = document.createElement('a');
                            knowledgeMemo.setAttribute('href', '/memo-detail/' +response.knowledgeMemoId);
                            knowledgeMemo.setAttribute('style', 'margin-right: 20px;');
                            const knowledgeMemoText = document.createTextNode('メモで復習する');
                            knowledgeMemo.appendChild(knowledgeMemoText);
                            infoDiv.appendChild(knowledgeMemo);
                            //次の問題に飛べるaタグを作るよ
                            const nextQuiz = document.createElement('a');
                            nextQuiz.setAttribute('href', "");
                            const nextQuizText = document.createTextNode('次の問題へ');
                            nextQuiz.appendChild(nextQuizText);
                            infoDiv.appendChild(nextQuiz);
                            }
                        })
                        .fail(function() {
                            alert('送信に失敗しました。');
                        });
                });
            });

        </script>
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
{{--            <header class="bg-white shadow">--}}
{{--                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                    {{ $header }}--}}
{{--                </div>--}}
{{--            </header>--}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
