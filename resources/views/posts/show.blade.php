
@extends('layouts.app')

@section('content')

<div class="container mt-4">
<div class='btn-toolbar' role="toolbar">
@if($post->user_id === Auth::id())
<form action="{{ route('board.edit', ['id' => $post->id]) }}" method="GET" >
@csrf
<div class="mb-4 mr-2">
<button class="btn btn-primary">編集</button>
</div>
</form>

<form action="{{ route('board.destroy', ['id' => $post->id]) }}" method="POST" >
@csrf
<div class="mb-4">
<button class="btn btn-danger">削除</button>
</div>
</form>
@endif
</div>
<div class="card mb-4">
                <div class="card-header">
                    タイトル: {{ $post->title }}&ensp;
                    カテゴリ: {{$post->category->name}}

                </div>
                <div class="card-body">
                <p class="card-text">
                        {!! nl2br(e($post->body)) !!}
                        <!-- 文字数表示制限 -->
                    </p>
                    <span class="mr-2">
                    投稿日時 {{ $post->created_at->format('Y.m.d H:i') }}
                    </span>
</div>
<div class="card-footer">

                    <section>
                    <form class="mb-4" method="POST" action="{{ route('comment.store') }}">
    @csrf

    <input
        name="post_id"
        type="hidden"
        value="{{ $post->id }}"
    >

    <div class="form-group">
        <label for="body">
            {{$post->title}}にコメント
        </label>

        <textarea
            id="body"
            name="body"
            class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
            rows="4"
        >{{ old('body') }}</textarea>
        @if ($errors->has('body'))
            <div class="invalid-feedback">
                {{ $errors->first('body') }}
            </div>
        @endif
    </div>

    <div class="mt-4 text-left" >
        <button type="submit" class="btn btn-primary">
            コメント
        </button>
    </div>
</form>

<form action="{{ route('comment.destroy', ['id' => $post->id]) }}" method="POST" >
@csrf

<div class="mt-4 text-right">
<button class="btn btn-danger">全削除</button>
</div>
</form>

                <h2 class="h5 mt-2 mb-2">
                    コメント
                </h2>


                @forelse($post->comments as $comment)
                    <div class="border-top p-4">
                        <time class="text-secondary">
                            {{ $comment->created_at->format('Y.m.d H:i') }}
                        </time>
                        <p class="mt-2">
                            {!! nl2br(e($comment->body)) !!}
                        </p>
                    </div>

                @empty
                    <p>コメントはまだありません。</p>

                @endforelse
            </section>

</div>
</div>

</div>
@endsection
