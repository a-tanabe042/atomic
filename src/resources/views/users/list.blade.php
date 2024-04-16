@extends('layouts.template')

@section('title', '一覧')
@include('layouts.head')

@section('content')

    <section class="list">
        <h4 class="text-color-light-blue font-weight-bold">
            レジュメ一覧
        </h4>
        <div class="list-body shadow-sm rounded py-2 px-5 bg-white">
            @if (session()->get('auth_name') == 'admin' ||
                    session()->get('auth_name') == 'sales' ||
                    session()->get('auth_name') == 'manager')
                <div class="text-right">
                    <x-displayNumSelectForm route="list" :display-num="$display_num" />

                    @if (session()->get('auth_name') == 'admin' || session()->get('auth_name') == 'sales')
                        @if (isset($_GET['filter_engineer_flg']))
                            <button type="button" class="filter_button filter_on btn btn--orange my-3" data-toggle="modal"
                                data-target="#filter_modal"><span class="mr-1">✔</span>絞り込み</button>
                        @else
                            <button type="button" class="filter_button btn btn--orange my-3" data-toggle="modal"
                                data-target="#filter_modal">絞り込み</button>
                        @endif
                    @endif
                    @if (session()->get('auth_name') == 'admin')
                        <a href="" class="btn btn--orange add_user_modal" data-toggle="modal"
                            data-target="#addUserModal">追加</a>
                    @endif
                </div>
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
            @endif

            @include('users.userModal')

            @if ($reviewer->reviewer_flg == 1 || $reviewer->guest_reviewer_flg == 1)
                <div class="wf-block">
                    <a href="{{ route('unapproved.list') }}"
                        class="wf-link menu_keep_button">未承認またはレビュー未完了のレジュメがあります</a>
                </div>
            @endif

            <x-listDisplayCount :query="$query"/>

            <table id="user-list-table" class="table table-list table-hover align-middle">
                <thead>
                    <tr>
                        <th class="list-no">No.</th>
                        <th class="list-department">所属部署</th>
                        <th class="list-position">役職</th>
                        <th class="list-name">氏名</th>
                        <th class="list-last-modify-date">最終更新日</th>
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
                        <td class="list-position align-middle">{{ $row->position_name }}</td>
                        <td class="list-name align-middle">{{ $row->last_name }} {{ $row->first_name }}</td>
                        <td class="list-last-modify-date align-middle">{{ $row->modify_date }}</td>
                        <td class="list-detail align-middle">
                            <div class="d-flex">
                                <form
                                    action="{{ route('detail.user', ['user_id' => Crypt::encryptString($row->user_id), 'token' => session()->get('token')]) }}">
                                    @csrf
                                    @if($row->auth_name === 'admin' || $row->auth_name === 'sales')
                                        <button class="m-1 btn menu_keep_button list_url_set" disabled>
                                            詳細
                                        </button>
                                    @else
                                        <button class="m-1 btn detail-btn menu_keep_button list_url_set">
                                            詳細
                                        </button>
                                    @endif
                                </form>
                                @if (session()->get('auth_name') === 'admin')
                                    <form action="{{ route('get.user', ['user_id' => $row->user_id]) }}"
                                        method="GET">
                                        <button type="submit"
                                            class="m-1 update-btn btn menu_keep_button">編集</button>
                                    </form>
                                    <form id="del-user"
                                        action="{{ route('delete.user', ['user_id' => $row->user_id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="m-1 delete-btn btn menu_keep_button"
                                            onClick="return delete_alert(event);">削除</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            <x-pagination :query="$query" :filter-engineer-flg="request()->input('filter_engineer_flg')" :display-select="request()->input('display_select')"/>
            <x-loading />
        </div>
    </section>

@endsection
