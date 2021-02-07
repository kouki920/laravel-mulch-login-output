@extends('layouts.app')

@section('content')



<div class="container mt-4 text-center">
<form action="{{ route('user.edit',Auth::id()) }}" method="GET" >
@csrf
<div class="mb-4 text-right">
<button class="btn btn-primary">編集</button>
</div>
</form>
<div class="card mb-4">
氏名:{{Auth::user()->name}}
</div>

<div class="card-body">
<p class="card-text">
自己紹介
<br>
{!! nl2br(e(Auth::user()->introduction)) !!}
</p>
</div>
</div>

@endsection
