
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
    @foreach($categories as $id => $name)
    <span class="btn"><a href="{{ route('board.index', ['category_id'=>$id]) }}" title="{{ $name }}">{{ $name }}</a></span>
    @endforeach
</div>

<!-- 一覧 -->

@foreach($posts as $post)


<div class="card mb-4">
                <div class="card-header">
                タイトル: {{ $post->title }}&ensp;
                カテゴリ: {{ $post->category->name }}

                </div>
                <div class="card-body">
                <p class="card-text">
                        1コメ: {!! nl2br(e(Str::limit($post->body, 140))) !!}
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
{{$posts->appends(['category_id' => $category_id,'searchword' => $searchword])->links()}}
</div>
@endsection
