@extends('layouts.app')

@section('content')



<div class="container mt-4">

    <div class="mb-4">
        <a href="{{route('board.create')}}" class="btn btn-primary">投稿</a>
    </div>
    <!--
<div>
<a href="{{ route('board.logout') }}">ログアウト</a>
</div> -->

    <!-- 検索フォーム -->
    <div class="mt-4 mb-4">
        <form class="form-inline" method="GET" action="{{ route('board.index') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="searchword" value="{{$searchword}}" class="form-control" placeholder="ワード検索">
            </div>
            <input type="submit" value="検索" class="btn btn-info ml-2">
        </form>
    </div>

    <div class="mt-4 mb-4">
        <p>{{ $posts->total() }}件です。</p>
    </div>
    <!-- タグ別のリンク -->
    <div class="mt-4 mb-4">
        タグ:
        @foreach($categories as $id => $name)
        <span class="btn"><a class="text-decoration-none" href="{{ route('board.index', ['category_id'=>$id]) }}" title="{{ $name }}">#{{ $name }}</a></span>
        @endforeach
        <br>
        顧客:
        @foreach($clients as $id => $type)
        <span class="btn"><a class="text-decoration-none" href="{{ route('board.index', ['client_id'=>$id]) }}" title="{{ $type }}">#{{ $type }}</a></span>
        @endforeach
        <br>
        売上獲得方法:
        @foreach($approaches as $id => $method)
        <span class="btn"><a class="text-decoration-none" href="{{ route('board.index', ['approach_id'=>$id]) }}" title="{{ $method }}">#{{ $method }}</a></span>
        @endforeach
    </div>

    <!-- 一覧 -->

    @foreach($posts as $post)


    <div class="card mb-4">
        <div class="card-header">
            {{$post->user->name}}
            <br>
            タイトル: {{ $post->title }}&ensp;
            #{{ $post->category->name }}&ensp;
            顧客:{{$post->client->type}}

        </div>
        <div class="card-body">
            <p class="card-text">
                売上獲得方法:&ensp;{{$post->approach->method}}
                <br>
                <hr>
                {!! nl2br(e(Str::limit($post->body, 140))) !!}
                <!-- 文字数表示制限 -->
            </p>
        </div>
        <div class="card-footer">
            <span class="mr-2">
                投稿日時 {{ $post->created_at }}
            </span>
            @if ($post->comments->count())
            <span class="badge badge-primary">
                コメント {{ $post->comments->count() }}件
            </span>
            @endif
        </div>
        <div class="mb-1">
            <a href="{{route('board.show',['id' => $post->id])}}" class="btn btn-primary">詳細へ</a>
        </div>
    </div>
    @endforeach
    {{$posts->appends(['category_id' => $category_id,'client_id' => $client_id,'approach_id' => $approach_id,'searchword' => $searchword])->links()}}
</div>
@endsection