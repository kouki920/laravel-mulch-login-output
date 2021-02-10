@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">新規投稿</div>

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


                    <form action="{{route('board.store')}}" method="POST">
                        @csrf
                        本日の活動報告<br>
                        <input class="form-control" type="text" name="title">
                        <br>
                        <div class="form-group">
                            <label for="subject">
                                業界
                            </label>
                            <select id="category_id" name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" value="{{ old('category_id') }}">
                                @foreach($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('category_id') }}
                            </div>
                            @endif
                        </div>
                        活動内容<br>
                        <textarea class="form-control" name="body" cols="30" rows="5"></textarea>

                        <br>
                        <input type="hidden" name="user_id" value="{{ $posts }}">
                        <input class="btn btn-info" type="submit" value="投稿">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection