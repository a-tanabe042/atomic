@extends('layouts.template')

@section('title', '詳細')
@include('layouts.head')

@section('content')
    <div class="px-2">
        @if (session('flash_message'))
            <div class="flash_message">
                {{ session('flash_message') }}
            </div>
        @endif
        <div class="text-right my-2">
            <form method="POST" action="{{ route('export', ['user_id' => $basic_info_items[0]->user_id]) }}">
                @csrf
                <button type="submit" class="btn btn--orange menu_keep_button">出力</button>
                <button type="button" class="btn btn--orange" id="request-button"
                    value="{{ $basic_info_items[0]->last_name }},{{ $basic_info_items[0]->first_name }},{{ $basic_info_items[0]->user_id }},{{ session()->get('user_id') }},{{ session()->get('engineer_flg') }},{{ session()->get('guest_flg') }}">通知</button>
                @if ($reviewee->reviewee_flg == 1 && ($reviewer->reviewer_flg == 1 || $reviewer->guest_reviewer_flg == 1))
                    <button type="button" id="review-button"
                        value="{{ $basic_info_items[0]->last_name }},{{ $basic_info_items[0]->first_name }},{{ $basic_info_items[0]->user_id }},{{ session()->get('user_id') }}"><label
                            id="review-label" class="my-0">レビュー</label></button>
                @endif
                <x-loading />
            </form>
        </div>
        <div class="text-right my-4 d-flex justify-content-between">
            <div class="text-left">
                <button class="btn btn--orange d-flex menu_keep_button list_url_get">
                    <div class="arrow arrow-left"></div>
                    <span class="mb-0 pl-1">戻る</span>
                </button>
            </div>
            <div class="review-state-area d-flex justify-content-end text-center w-75">
                <div class="review-state-key py-1 d-flex justify-content-center align-items-center">レジュメ状態</div>
                @if ($reviewee->reviewee_flg == 0)
                    <div class="review-state-value-common py-1 d-flex justify-content-center align-items-center">通常
                    </div>
                @elseif($reviewee->reviewee_flg == 1)
                    <div class="review-state-value-wait py-1 d-flex justify-content-center align-items-center">レビュー待ち
                    </div>
                @elseif($reviewee->reviewee_flg == 2)
                    <div class="review-state-value-back py-1 d-flex justify-content-center align-items-center">差し戻し
                    </div>
                @endif
            </div>
        </div>
        <div id="review-container" class="review-container mt-3 mb-5" style="display: none;">
            <div class="review-color-box py-3">
                <div class="review-box d-flex justify-content-end">
                    <div class="review-area d-flex">
                        <div class="d-flex">
                            <input type="radio" id="approved-radio" class="d-none radiobutton" name="judge"
                                value="approved">
                            <label for="approved-radio">承認</label>
                        </div>
                        <div class="d-flex">
                            <input type="radio" id="send-back-radio" class="d-none radiobutton" name="judge"
                                value="send-back">
                            <label for="send-back-radio">差し戻し</label>
                        </div>
                    </div>
                    <button type="button" class="btn btn--orange ml-5 my-auto" id="judge-button"
                        value="{{ $basic_info_items[0]->last_name }},{{ $basic_info_items[0]->first_name }},{{ $basic_info_items[0]->user_id }},{{ session()->get('user_id') }},{{ session()->get('guest_flg') }},{{ $basic_info_items[0]->guest_flg }}">送信</button>
                </div>
                <div class="review-message-area text-right" style="display: none">
                    <textarea name="review-message" class="review-message mt-3" placeholder="差し戻しをする場合は、この欄に修正点を明記してください"></textarea>
                </div>
            </div>
        </div>
        @if ($reviewee->reviewee_flg == 2)
            <div class="review-back-container mt-3 mb-5 py-4">
                <div class="review-warning-area text-right">
                    @if ($basic_info_items[0]->guest_flg == 0)
                        差し戻しがありました<br>
                        下記ご確認後、再度更新・通知をお願いします
                    @else
                        修正依頼がありました<br>
                        下記ご確認後、再度更新・通知をお願いいたします
                    @endif
                </div>
                <div class="review-back-area text-right mt-2 py-3">
                    {!! nl2br(e($basic_info_items[0]->review_message)) !!}
                </div>
            </div>
        @endif
        <div class="datail_tabs m-2">
            <input id="basic_info" class="d-none" type="radio" name="tab_item"
                {{ !empty($_COOKIE['tab_flg']) ?: 'checked' }}>
            <label class="tab_item p-2 mb-0" for="basic_info">基本情報</label>
            <input id="career_list" class="d-none" type="radio" name="tab_item"
                {{ !(isset($_COOKIE['tab_flg']) && $_COOKIE['tab_flg'] == 'career') ?: 'checked' }}>
            <label class="tab_item p-2 mb-0" for="career_list">経歴一覧</label>
            <input id="career_request" class="d-none" type="radio" name="tab_item"
                {{ !(isset($_COOKIE['tab_flg']) && $_COOKIE['tab_flg'] == 'condition') ?: 'checked' }}>
            <label class="tab_item p-2 mb-0" for="career_request">案件希望</label>
            <div class="tab_content label-style" id="basic_info_content">
                <div class="tab_content_frorm">
                    <!--基本情報の個人情報部品-->
                    @include('resumeDetailParts.resumeDetailBasicInfo')
                    <!--基本情報の個人情報部品-->
                    @include('resumeDetailParts.resumeDetailBasicSkill')
                    <!--基本情報の個人情報部品-->
                    @include('resumeDetailParts.resumeDetailBasicSummary')
                </div>
            </div>
            <!--基本情報の個人情報部品-->
            @include('resumeDetailParts.resumeDetailCareer')
            <!-- 基本情報の個人情報部品 -->
            @include('resumeDetailParts.resumeDetailCareerRequest')
        </div>
    </div>
    @if (app('env') == 'local')
        <script src="{{ asset('js/resumeDetail.js') }}"></script>
        <script src="{{ asset('js/condition.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
    @endif
    @if (app('env') == 'production')
        <script src="{{ secure_asset('js/resumeDetail.js') }}"></script>
        <script src="{{ secure_asset('js/condition.js') }}"></script>
        <script src="{{ secure_asset('js/select2.min.js') }}"></script>
    @endif
@endsection