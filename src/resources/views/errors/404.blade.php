@extends('layouts.template')

@section('title', '404 Not Found')
@include('layouts.head')

@section('content')
    <div id="error_main">
        <div class="fof">
            <h1>Error 404</h1>
            <br>
            <a>お探しのページは存在しません。</a>
            <br><br>
            @if (is_null(session('user_id')))
                <button class="btn btn-hover" onclick="location.href='/'">ログインはこちら</button>
            @endif
        </div>
    </div>
@endsection
