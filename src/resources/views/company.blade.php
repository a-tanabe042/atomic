@extends('layouts.template')

@section('title', '企業情報登録')
@include('layouts.head')

@section('content')

<div class="list">
    <h4 class="text-color-light-blue font-weight-bold">
        企業情報登録
    </h4>

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

    <div class="mt-5">
        <form action="{{ route('send.company') }}" method="post" class="checkform">
        @csrf
        <div class="text-right">
            <button type="submit" class="btn btn--orange btn-hover menu_keep_button">登録</button>
        </div>
            <table class="basic_info_skill w-100 mt-1 calendar mb-5">
                <tbody>
                    <tr>
                        <th class="required">企業名</th>
                        <td>
                            <span class="alertarea"></span>
                            <input name="company_name" type="text" class="w-100 require">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>  
    </div>

    <div>
        <div class="company d-flex w-100">
            <div class="company-no career-no-title">No.</div>
            <div class="company-name career-no-title">企業名</div>
            <div class="company-date career-no-title">更新日</div>
        </div>
        @foreach($companyList as $company)
            <div class="d-flex w-100 company-list">
                <div class="company-no career-no-title">{{$loop->iteration}}</div>
                <div class="company-name career-no-title">{{$company->company_name}}</div>
                <div class="company-date career-no-title">{{substr($company->create_date, 0, 10)}}</div>
            </div>
        @endforeach
    </div>
</div>

@endsection