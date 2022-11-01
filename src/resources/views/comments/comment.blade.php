@extends('layout')


@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">

@endsection

@section('content')


  <div class="container">

    <div class="panel panel-default">
        <div class="panel-heading">タスク</div>
        <div class="panel-body">
            <h3 class="text-center">{{ old('title', $task->title) }}</h3>
            {{-- <h3 class="text-center">{{ old('title', ['task_id'=> $task->id]) }}</h3> --}}



        </div>
    </div>



    {{-- コメント一覧、編集、削除 --}}

    <div class="panel panel-default">
        <div class="panel-heading">コメント一覧</div>
        <div class="panel-body">


            <div class="text-right">
                <a href=
                "{{ route('comments.create', ['folder' => $task->folder_id, 'task' => $task->id]) }}"
                 class="btn btn-default btn-block">
                  コメントを追加する
                </a>
            </div>

        </div>
        <table class="table">
            <thead>
            <tr>
            <th style="width: 60%">コメント</th>
            <th class="text-center" style="width: 10%">編集</th>
            <th class="text-center" style="width: 10%">削除</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
            <tr>
                <td style="width: 80%">
                    {{ $comment->text }}
                </td>

                {{-- 編集ボタン --}}
                <td style="width: 10%" align="center">
                    <a href="{{ route('comments.edit', ['folder' => $task->folder_id, 'task' => $task->id, 'comment' => $comment->id]) }}" class="btn btn-success"><i class="far fa-edit"></i></a>
                </td>

                {{-- 削除ボタン --}}
                <td style="width: 10%" align="center">
                    <form method="post" action="{{ route('comments.comment', ['folder' => $task->folder_id, 'task' => $task->id, 'comment'=>$comment->id, 'id'=>$comment->id]) }}" >
                      @csrf
                      <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
                {{-- <td style="width: 10%" align="center">
                    <form method="post" action="{{ route('comments.destroy', ['folder' => $task->folder_id, 'task' => $task->id, 'id'=>$comment->comment_id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                    </form>
                </td> --}}
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    {{-- ホームに戻る --}}
        <form
        action="{{ route('tasks.index', ['folder' => $task->folder_id, 'task' => $task->id]) }}"
        method="get"
        >
        <div class="text-right">
            <button type="submit" class="btn btn-primary text-right ">タスク一覧に戻る</button>
        </div>
        </form>






          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  {{-- <script>
    flatpickr(document.getElementById('due_date'), {
      locale: 'ja',
      dateFormat: "Y/m/d",
      minDate: new Date()
    });
  </script> --}}
@endsection
