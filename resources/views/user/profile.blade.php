@extends('layouts.app')

@section('content')

<div class="container mt-4 text-center">
<div class="card mb-4">
氏名:{{Auth::user()->name}}
</div>

<div class="card-body">
<p class="card-text">
自己紹介
<br>
{{Auth::user()->email}}
</p>
</div>
</div>

@endsection
