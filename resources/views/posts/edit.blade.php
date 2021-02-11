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


                    <form action="{{route('board.update',['id' => $post->id])}}" method="POST">
                        @csrf
                        <div class="card-body">
                            タイトル<br>
                            <input class="form-control" type="text" name="title" value="{{$post->title}}">
                            <br>
                            カテゴリ
                            <select id="category_id" name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                                @foreach($categories as $id => $name)
                                <option value="{{ $id }}" @if ($post->category_id == $id)
                                    selected
                                    @endif
                                    >{{ $name }}</option>
                                @endforeach
                            </select>
                            <br>
                            顧客
                            <select id="client_id" name="client_id" class="form-control {{ $errors->has('client_id') ? 'is-invalid' : '' }}">
                                @foreach($clients as $id => $type)
                                <option value="{{ $id }}" @if ($post->client_id == $id)
                                    selected
                                    @endif
                                    >{{ $type }}</option>
                                @endforeach
                            </select>

                            売上獲得方法
                            <select id="approach_id" name="approach_id" class="form-control {{ $errors->has('approach_id') ? 'is-invalid' : '' }}">
                                @foreach($approaches as $id => $method)
                                <option value="{{ $id }}" @if ($post->approach_id == $id)
                                    selected
                                    @endif
                                    >{{ $method }}</option>
                                @endforeach
                            </select>

                            メモ<br>
                            <textarea class="form-control" name="body" cols="30" rows="5">{{$post->body}}</textarea>
                            <br>
                            <input type="hidden" name="user_id" value="{{ $post->user_id }}">
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