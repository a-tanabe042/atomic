@extends('layouts.template')

@section('title', 'カレンダー招待')
@include('layouts.head')

@section('content')

<div class="list">
    <h4 class="text-color-light-blue font-weight-bold">
        カレンダー招待
    </h4>
    <div class="mb-2">
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
    </div>

    @include('calendarModal')


    <div class="mt-5">
        <form action="{{ route('send.calendar') }}" method="post" id="invite" class="checkform">
        @csrf
        <div class="text-right invite-q">
            <div class="tooltip2">
                <div class="description2">面談日や入場案内のカレンダー招待が行えます。</div>
                <img src="{{ asset('img/Question.png') }}" class="posQ">
            </div>
            <button type="submit" class="btn btn--orange btn-hover menu_keep_button" onClick="return invite_alert(event);">招待</button>
        </div>
            <table class="basic_info_skill w-100 mt-1 calendar">
                <tbody>
                    <tr class="contract-tr">
                        <th class="required">タイトル</th>
                        <td>
                            <span class="alertarea"></span>
                            <input name="calendar_title" type="text" class="w-100 require">
                        </td>
                    </tr>
                    <tr class="contract-tr">
                        <th class="required">招待日時</th>
                        <td>
                            <span class="alertarea"></span>
                            <input class="mr-2 require" name="calendar_date" type="date"><input class="require" name="calendar_time" type="time">
                        </td>
                    </tr>
                    <tr class="contract-tr">
                        <th class="required">詳細</th>
                        <td>
                            <span class="alertarea"></span>
                            <textarea name="calendar_text" class="w-100 calendar-text require"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th class="required">招待メンバー</th>
                        <td class="d-flex" id="invited-member">
                            <span class="alertarea member-alert"></span>
                            <input class="mr-2 require d-none remove-input" name="" type="text" >
                            <button type="button" class="btn btn-hover invite-btn require" data-toggle="modal" data-target="#selectUserModal" id="invite-btn">選択</button>
                    
                        </td>
                    </tr>

                </tbody>
            </table>
        </form>  
    </div>

    <div class="text-right"><span>※招待日時の近い順で表示されます。過去の予定は表示されません。</span></div>
    <div>
        <?php $i=0; ?>
        @foreach($query as $row)
        <?php $j=0; ?>
            <table class="basic_info_skill w-100 mt-1 mb-3 calendar">
                <tbody>
                    <tr class="contract-tr">
                        <th>タイトル</th>
                        <td>{{$row->calendar_title}}</td>
                    </tr>
                    <tr class="contract-tr">
                        <th>招待日時</th>
                        <td>{{$row->calendar_date}}</td>
                    </tr>
                    <tr class="contract-tr">
                        <th>詳細</th>
                        <td>{{$row->calendar_text}}</td>
                    </tr>
                    <tr>
                        <th>招待メンバー</th>
                        <td>
                            @foreach($invited as $mem)
                                @if($i===$j)
                                    {{$mem}}
                                @endif
                            <?php $j++; ?>
                            @endforeach
                        </td>
                    </tr>

                </tbody>
            </table>
            
        <?php $i++; ?>
        @endforeach
    </div>
</div>

@endsection