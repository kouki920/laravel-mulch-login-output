@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">編集</div>

<form action="{{route('user.update',$auth->id)}}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{Auth::user()->id}}">

                    <div class="card-body">
                    氏名:<br>
                    <input class="form-control" type="text" name="name" value="{{$auth->name}}">
                    </div>

                    <!-- <div class="card-body">
                    メールアドレス:<br>
                    <input class="form-control" type="text" name="email" value="{{$auth->email}}">
                    </div> -->

                    <div class="card-body">
                    自己紹介:
                    <br>
                    <textarea class="form-control" name="introduction" id="" cols="30" rows="5">{{$auth->introduction}}</textarea>
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
