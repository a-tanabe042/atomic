@extends('layouts.template')

@section('title', 'お知らせ管理')
@include('layouts.head')

@section('content')
<section class="list">
    <h4 class="text-color-light-blue font-weight-bold">
        お知らせ管理ページ
    </h4>
    <div class="d-flex justify-content-end">
        <div class="mr-3">
            <div class="form-check">
                <input class="form-check-input cursor-pointer" type="radio" name="flexRadioDefault" id="flexRadioDefault1" onclick="loadingFunc();location.href='announcements?sort=desc'" @if($sort === config('resumeApp.ORDER_BY.DESC')) checked @endif>
                <label class="form-check-label" for="flexRadioDefault1">
                    降順
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input cursor-pointer" type="radio" name="flexRadioDefault" id="flexRadioDefault2" onclick="loadingFunc();location.href='announcements?sort=asc'" @if($sort === config('resumeApp.ORDER_BY.ASC')) checked @endif>
                <label class="form-check-label" for="flexRadioDefault2">
                    昇順
                </label>
            </div>
        </div>
        <button class="btn btn--orange" data-toggle="modal" data-target="#create_modal">新規登録</button>
    </div>
    @include('announcements.createModal')
    @foreach ($announcements as $announcement)
    <article class="bg-white p-3 mt-3 mb-5 shadow-sm rounded">
        <div class="d-flex justify-content-between">
            <h4 class="mr-3 p-2 border-bottom border-dark flex-grow-1">{{ $announcement->announcement_date }} ({{ $weekday_array[$announcement->announcement_weekday] }})</h4>
            <form id="del-user" method="post" action="{{ route('announcements.destroy', $announcement->announcement_id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="m-1 delete-btn btn menu_keep_button" onClick="return delete_alert(event);">削除</button>
            </form>
        </div>
        <span>
            {!! nl2br(htmlspecialchars($announcement->announcement_text)) !!}
        </span>
    </article>
    @endforeach
    <x-loading />
</section>
@endsection
