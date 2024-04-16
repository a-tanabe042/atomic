@extends('layouts.template')

@section('title', '未承認・レビュー未完了一覧')
@include('layouts.head')

@section('content')
    <div class="list">
        <div class="d-flex justify-content-between">
            <h4 class="text-color-light-blue font-weight-bold">
                未承認・レビュー未完了<br>レジュメ一覧
            </h4>
            <a href="{{ route('list') }}" class="link-back menu_keep_button">レビュー一覧画面へ戻る</a>
        </div>

        <div class="list-body shadow-sm rounded py-2 px-5 bg-white">

            @if (session('flash_message'))
                <div class="flash_message alert-danger">
                    {{ session('flash_message') }}
                </div>
            @endif
            @if (session('success_message'))
                <div class="flash_message alert-success">
                    {{ session('success_message') }}
                </div>
            @endif

            <x-listDisplayCount :query="$query"/>

            <table id="user-list-table" class="table table-list table-hover align-middle">
                <thead>
                    <tr>
                        <th class="list-no">No.</th>
                        <th class="list-department">所属部署</th>
                        <th class="list-name">氏名</th>
                        <th class="list-detail">
                            <x-pagination :query="$query" :filter-engineer-flg="request()->input('filter_engineer_flg')" :display-select="request()->input('display_select')" class="pagination-sm"/>
                        </th>
                    </tr>
                </thead>

                @foreach ($query as $row)
                    <tr>
                        <td class="list-no align-middle">
                            {{ $loop->iteration + ($query->currentPage() - 1) * $query->perPage() }}</td>
                        <td class="list-department align-middle">{{ $row->belongs_name }}</td>
                        <td class="list-name align-middle">{{ $row->last_name }} {{ $row->first_name }}</td>
                        <td class="list-detail align-middle">
                            <div class="d-flex">
                                <?php $URL = "resume_detail_$row->user_id"; ?>
                                <form
                                    action="{{ route('detail.user', ['user_id' => Crypt::encryptString($row->user_id), 'token' => session()->get('token')]) }}">
                                    @csrf
                                    <button class="m-1 btn btn-hover menu_keep_button"
                                        onclick="location.href='<?php echo $URL; ?>'"
                                        {{ $row->auth_name === 'sales' || $row->auth_name === 'recruitment' || $row->auth_name === 'admin' ? 'disabled' : '' }}>詳細</button>
                                </form>
                                @if (session()->get('auth_name') === 'admin')
                                    <form action="{{ route('get.user', ['user_id' => $row->user_id]) }}" method="GET">
                                        <button type="submit"
                                            class="m-1 update-btn btn btn-hover menu_keep_button">編集</button>
                                    </form>

                                    <form id="del-user"
                                        action="{{ route('delete.user', ['user_id' => $row->user_id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="m-1 delete-btn btn btn-hover"
                                            onClick="return delete_alert(event);">削除</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            <x-pagination :query="$query" :filter-engineer-flg="request()->input('filter_engineer_flg')" :display-select="request()->input('display_select')" />
        </div>
        <x-loading />
    </div>
@endsection
