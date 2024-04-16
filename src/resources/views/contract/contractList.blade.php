@extends('layouts.template')

@section('title', '契約管理・延長情報管理')
@include('layouts.head')

@section('content')
    <div class="list">
        <h4 class="text-color-light-blue font-weight-bold">
            契約管理・延長情報管理
        </h4>
        <div class="list-body shadow-sm rounded py-2 px-5 bg-white">
            @if (session()->get('auth_name') == 'admin' || session()->get('auth_name') == 'sales')
                <div class="text-right">
                    <x-displayNumSelectForm route="get.contract.list" :display-num="$display_num" />

                    @if (isset($_GET['filter_engineer_flg']))
                        <button type="button" class="filter_button filter_on btn btn--orange my-3" data-toggle="modal"
                        data-target="#filter_modal"><span class="mr-1">✔</span>絞り込み</button>
                    @else
                        <button type="button" class="filter_button btn btn--orange my-3" data-toggle="modal"
                        data-target="#filter_modal">絞り込み</button>
                    @endif
                </div>
            @endif

            <x-listDisplayCount :query="$contract_List"/>

            <table id="user-list-table" class="table table-list table-hover">
                <thead>
                    <tr>
                        <th class="list-no">No.</th>
                        <th class="list-department">所属部署</th>
                        <th class="list-position">役職</th>
                        <th class="list-name">氏名</th>
                        <th class="list-customer text-center">お客様先</th>
                        <th class="list-month text-center">契約終了月</th>
                        <th class="list-status text-center">ステータス</th>
                        <th class="list-detail">詳細</th>
                    </tr>
                </thead>
                @foreach ($contract_List as $contract)
                    <tr>
                        <td class="list-no align-middle">
                            {{ $loop->iteration + ($contract_List->currentPage() - 1) * $contract_List->perPage() }}</td>
                        <td class="list-department align-middle">{{ $contract->belongs_name }}</td>
                        <td class="list-position align-middle">{{ $contract->position_name }}</td>
                        <td class="list-name align-middle">{{ $contract->last_name }} {{ $contract->first_name }}</td>
                        <td class="list-customer text-center align-middle">{{ $contract->contract_name }}</td>
                        <td class="list-month text-center align-middle">
                            @if ($contract->end_month != null)
                                {{ substr($contract->end_month, 0, 4) }}年{{ substr($contract->end_month, 4, 2) }}月
                            @endif
                        </td>
                        <td class="list-status text-center align-middle" value=>
                            {{ $contract->contract_status == 0 ? '継続' : '終了' }}</td>
                        <td class="list-detail align-middle">
                            <form
                                action="{{ route('get.contract.detail', ['user_id' => Crypt::encryptString($contract->user_id)]) }}">
                                @csrf
                                <button class="btn detail-btn menu_keep_button list_url_set">詳細</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            <x-pagination :query="$contract_List" :filter-engineer-flg="request()->input('filter_engineer_flg')" :display-select="request()->input('display_select')"/>
            <x-loading />
        </div>
    </div>

@endsection
