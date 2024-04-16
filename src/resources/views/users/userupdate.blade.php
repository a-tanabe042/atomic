@extends('layouts.template')

@section('title', 'ユーザー編集')
@include('layouts.head')

@section('content')

    <div class="list">
        <h4 class="text-color-light-blue font-weight-bold">
            社員情報編集
        </h4>
        <div class="px-2 py-4">
            @if (count($errors) > 0)
                <ul class="bg-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            @foreach ($query as $row)
                <form action="{{ route('update.user', ['user_id' => $row->user_id]) }}" method="post" class="checkform">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <p>氏名</p>
                        </div>
                        <div class="col-md-2">
                            <p style="text-align:right; color:red">[必須]</p>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-input require" oninput="requireCheck()" name="lastname"
                                value="{{ $row->last_name }}" require>
                            <span class="alertarea"></span>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-input require" oninput="requireCheck()" name="firstname"
                                value="{{ $row->first_name }}">
                            <span class="alertarea"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <p>カナ(氏名)</p>
                        </div>
                        <div class="col-md-2">
                            <p style="text-align:right; color:red">[必須]</p>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-input kana" oninput="kanaCheck()" name="lastname_kana"
                                value="{{ $row->last_name_kana }}">
                            <span class="alertarea"></span>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-input kana" oninput="kanaCheck()" name="firstname_kana"
                                value="{{ $row->first_name_kana }}">
                            <span class="alertarea"></span>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <p>メールアドレス</p>
                        </div>
                        <div class="col-md-2">
                            <p style="text-align:right; color:red">[必須]</p>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-input mail" oninput="mailCheck()" id="mail"
                                name="mail" value="{{ $row->mail_address }}">
                            <span class="alertarea"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <p>イニシャル</p>
                        </div>
                        <div class="col-md-2">
                            <p style="text-align:right; color:red">[必須]</p>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-input initial" oninput="initialCheck()" name="initial"
                                value="{{ $row->initial }}">
                            <span class="alertarea"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>Slack メンバーID</p>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-input member_id" name="member_id"
                                value="{{ $row->member_id }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>権限</p>
                        </div>
                        <div class="col-md-2">
                            <select name="authority">
                                <option value="sales" {{ $row->auth_name === 'sales' ? 'selected' : '' }}>営業</option>
                                <option value="recruitment" {{ $row->auth_name === 'recruitment' ? 'selected' : '' }}>採用
                                </option>
                                <option value="manager" {{ $row->auth_name === 'manager' ? 'selected' : '' }}>技術（役職あり）
                                </option>
                                <option value="member" {{ $row->auth_name === 'member' ? 'selected' : '' }}>技術（役職なし）
                                </option>
                                <option value="admin" {{ $row->auth_name === 'admin' ? 'selected' : '' }}>管理者</option>
                            </select>
                        </div>
                        <div class="tooltip1">
                            <img src="{{ asset('img/Question.png') }}">
                            <div class="description1">権限の選択例<br>　※営業： 営業部<br>　※採用： 採用部<br>　※技術（役職あり）：
                                部長・課長・主任<br>　※技術（役職なし）： 役職なし<br>　※管理者： 当システム運用者
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>役職</p>
                        </div>
                        <div class="col-md-8">
                            <select name="position">
                                @foreach ($position_list as $position)
                                    <option value="{{ $position->position_id }}"
                                        {{ $position->position_id === $row->position_id ? 'selected' : '' }}>
                                        {{ $position->position_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>所属部署</p>
                        </div>
                        <div class="col-md-8">
                            <select name="belongs" id="belongs">
                                @foreach ($belongs_list as $belongs)
                                    <option value="{{ $belongs->belongs_id }}"
                                        {{ $belongs->belongs_id === $row->belongs_id ? 'selected' : '' }}>
                                        {{ $belongs->belongs_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>職種</p>
                        </div>
                        <div class="col-md-8">
                            <select name="occupation">
                                <option value="0" {{ $row->engineer_flg === 0 ? 'selected' : '' }}>開発</option>
                                <option value="1" {{ $row->engineer_flg === 1 ? 'selected' : '' }}>インフラ</option>
                                <option value="2" {{ $row->engineer_flg === 2 ? 'selected' : '' }}>営業</option>
                                <option value="3" {{ $row->engineer_flg === 3 ? 'selected' : '' }}>その他</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>ゲストフラグ</p>
                        </div>
                        <div class="col-md-8">
                            <input type="checkbox" id="Checkbox1" onchange="myfunc(this.value)" name="guest"
                                {{ $row->guest_flg === 1 ? 'checked' : '' }}>
                            <a class="col-md-3">ゲスト</a>
                            <a class="col-md-4">※入社後所属部署設定/ゲストフラグ解除をお願いいたします。</a>
                        </div>
                    </div>
                    <div class="row" id="hidden1"
                        {{ $row->guest_flg === 1 ? 'style="display:flex"' : 'style="display:none"' }}>
                        <div class="col-md-4">
                            <p>パスワード</p>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-input userpassword clickme_btn" id='password'
                                name="password" value="" placeholder="半角英数字8～16文字" readonly>
                            <span class="alertarea"></span>
                        </div>
                        <div class="col-md-2">
                            <button type='button' class='btn btn-hover' id="password-gen"
                                onclick="gen()">自動生成</button>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-hover mr-4 menu_keep_button"
                            onclick="location.href='/resume-list'">戻る</button>
                        <button type="submit" id="submitbtn" class="btn btn-danger btn-hover menu_keep_button"
                            value="" oninput="validateCheck()">更新</button>
                    </div>
                </form>
            @endforeach
            <x-loading />
        </div>
    </div>

@endsection
