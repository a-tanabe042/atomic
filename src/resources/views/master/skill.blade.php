@extends('layouts.template')

@section('title', 'スキル一覧')
@include('layouts.head')

@section('content')
<div class="list">
    <h4 class="text-color-light-blue font-weight-bold">
        スキル一覧
    </h4>
    <div class="p-5">
        <form method="GET">
            @foreach($skills as $skill)
                <button type="submit" class="my-2 py-2 btn w-100 font-weight-bold menu_keep_button" formaction="/master/skill/list" name="category" value="{{ $loop->iteration }}">{{ $skill['category'] }}</button></br>
            @endforeach
        </form>
    </div>
</div>
@endsection