@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    編集
                    @if (Auth::id() == 22)
                    <p class="text-danger">※ゲストユーザーは、編集できません。</p>
                    @endif
                </div>

                <form action="{{route('user.update',$auth->id)}}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{$auth->id}}">

                    <div class="card-body">
                        <label for="name">ユーザー名</label>
                        @if (Auth::id() == 22)
                        <input class="form-control" type="text" id="name" name="name" value="{{$auth->name}}" readonly>
                        @else
                        <input class="form-control" type="text" id="name" name="name" value="{{$auth->name ?? old('name') }}">
                        @endif
                    </div>

                    <div class="card-body">
                        <label for="email">メールアドレス</label>
                        @if (Auth::id() == 22)
                        <input class="form-control" type="text" id="email" name="email" value="{{$auth->email}}" readonly>
                        @else
                        <input class="form-control" type="text" id="email" name="email" value="{{$auth->email ?? old('email')}}">
                        @endif
                    </div>

                    <div class="card-body">
                        <label for="introduction">自己紹介</label>
                        @if (Auth::id() == 22)
                        <textarea class="form-control" name="introduction" id="introduction" cols="30" rows="5" readonly>{{$auth->introduction}}</textarea>
                        @else
                        <textarea class="form-control" name="introduction" id="introduction" cols="30" rows="5">
                        {{$auth->introduction}}</textarea>
                        @endif
                    </div>

                    <div class="card-body">
                        <input class="btn btn-info" type="submit" value="更新">
                    </div>
                    <div class="card-body">
                        <a class="btn btn-secondary" href="{{route('user.index')}}">戻る</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection