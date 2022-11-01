@extends('layout')

@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
  <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">コメントをする</div>
        <div class="panel-body">
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
            <form
            action="{{ route('comments.create', ['folder' => $folder->id, 'task' => $task->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="text" id="text"
                        value="{{ old('text') }}" />
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">投稿</button>
                </div>

            </form>
        </div>

    </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>

@endsection

