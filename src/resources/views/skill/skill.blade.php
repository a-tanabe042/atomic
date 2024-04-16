@extends('layouts.template')

@section('title', 'スキル一覧')
@include('layouts.head')

@section('content')
<div class="list">
    <h4 class="text-color-light-blue font-weight-bold">
        スキル一覧
    </h4>

    <form method="GET">
        <div class="p-5">
            <button type="submit" class="my-2 py-2 btn w-100 font-weight-bold menu_keep_button" formaction="/skill/language">言語</button></br>
            <button type="submit" class="my-2 py-2 btn w-100 font-weight-bold menu_keep_button" formaction="/skill/db">DB</button></br>
            <button type="submit" class="my-2 py-2 btn w-100 font-weight-bold menu_keep_button" formaction="/skill/os">OS</button></br>
            <button type="submit" class="my-2 py-2 btn w-100 font-weight-bold menu_keep_button" formaction="/skill/middleware">ミドルウェア</button></br>
            <button type="submit" class="my-2 py-2 btn w-100 font-weight-bold menu_keep_button" formaction="/skill/platform">プラットフォーム</button></br>
            <button type="submit" class="my-2 py-2 btn w-100 font-weight-bold menu_keep_button" formaction="/skill/framework">Framework</button></br>
            <button type="submit" class="my-2 py-2 btn w-100 font-weight-bold menu_keep_button" formaction="/skill/others">その他</button></br>
        </div>
    </form>
</div>



@endsection