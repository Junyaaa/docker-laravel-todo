@extends('layout')

@section('content')

<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">
            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
              フォルダを追加する
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
              <a
                  href="{{ route('tasks.index', ['folder' => $folder->id]) }}"
                  class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}"
              >
                {{ $folder->title }}
              </a>
            @endforeach
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">タスク</div>
          <div class="panel-body">
            <div class="text-right">
              <a href="{{ route('tasks.create', ['folder' => $current_folder_id]) }}" class="btn btn-default btn-block">
                タスクを追加する
              </a>
            </div>
          </div>
            <table class="table">
                <thead>
                <tr>
                  <th style="width: 60%">タイトル</th>
                  <th style="width: 10%" class="text-center">状態</th>
                  <th style="width: 10%" class="text-center">期限</th>
                  <th style="width: 10%" class="text-center">編集</th>
                  <th style="width: 10%" class="text-center">コメント</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                  <tr>
                    <td style="width: 60%">{{ $task->title }}</td>
                    <td style="width: 10%" align="center">
                      <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                    </td>
                    <td style="width: 10%" align="center">{{ $task->formatted_due_date }}</td>

                    <td style="width: 10%" align="center"><a href="{{ route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id]) }}"><i class="far fa-edit"></i></a></td>

                    {{-- コメント機能ボタン --}}
                    <td style="width: 10%" align="center">
                        <a href="{{ route('comments.comment', ['folder' => $task->folder_id, 'task' => $task->id]) }}">
                            <i class="far fa-comments"></i>
                        </a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
            </table>

        </div>
      </div>
    </div>
  </div>
@endsection
