
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">編集</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                    </ul>
                    </div>
                    @endif


                    <form action="{{route('comment.update',['id' => $post->id])}}" method="POST">
                    @csrf
                    <div class="card-body">
                    タイトル:<br>
                    <input type="text" name="title" value="{{$post->post_id}}">
                    <br>

                    1コメ:<br>
                    <textarea name="body" cols="30" rows="5">{{$post->comments()->body}}</textarea>



                    <br>
                    <input class="btn btn-info" type="submit" value="更新">
                    <div class="mt-2">
                        <a class="btn btn-secondary" href="{{ route('board.show', ['id' => $post->id]) }}">
                            キャンセル
                        </a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
