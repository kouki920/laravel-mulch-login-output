@extends('layouts.app')

@section('content')

<div class="container mt-4 text-center">
<form action="{{ route('user.edit',$auth->id) }}" method="GET" >
@csrf
<div class="mb-4 text-right">
<button class="btn btn-primary">編集</button>
</div>
</form>
<div class="card mb-4 ">
氏名:{{$auth->name}}
</div>

<div class="card-body">
<p class="card-text">
自己紹介
<br>
{!! nl2br(e($auth->introduction)) !!}
</p>
</div>

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
<div class="mt-2 center-block">
{{$posts->links()}}
</div>
</div>
@endsection
