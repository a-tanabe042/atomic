@extends('layouts.template')

@section('title', 'スキル（言語）一覧')
@include('layouts.head')

@section('content')
    <div class="list">
        <h4 class="text-color-light-blue font-weight-bold">
            言語一覧
        </h4>

        <div class="skill-add">
            <form action="{{ route('add.language') }}" method="post" id="skillAdd" class="checkform skill-add">
                @csrf
                <button id="add" type="button" class="btn btn--orange skill-add-btn">＋</button>
                <div class="addskill">

                </div>
                <div class="save-btn">
                    <input id="saveBtn" type="submit" class="btn btn--orange menu_keep_button" name="send"
                        value="保存">
                </div>
            </form>
        </div>

        <div class="skill">
            @if (session('success_message'))
                <div class="flash_message alert-success skill-list">
                    {{ session('success_message') }}
                </div>
            @endif
            @if (session('flash_message'))
                <div class="flash_message alert-danger skill-list">
                    {{ session('flash_message') }}
                </div>
            @endif

            <table class="skill-list" border="1">
                <tbody>
                    <tr class="skill-title">
                        <td class="skill-no">No.</td>
                        <td class="skill-name">言語</td>
                        <td class="skill-no"></td>
                        <td class="skill-no"></td>
                    </tr>
                    @foreach ($languageList as $language)
                        <form class="update" action="{{ route('update.skill', ['skill_id' => $language->skill_id]) }}"
                            method="post" class="checkform">
                            @csrf
                            <tr id="skillAdd" style="display:none" class="color1 tr-add-{{ $loop->iteration }}">
                                <td class="skill-no">{{ $loop->iteration }}</td>
                                <td class="skill-name">
                                    <input type="text" class="form-input" name="skill_name"
                                        placeholder="{{ $language->skill_name }}">
                                </td>
                                <td class="skill-update"><button type="button" class="btn cancel-{{ $loop->iteration }}"
                                        id="cancel" onClick="updatecancel(this)">キャンセル</button></td>
                                <td class="skill-update"><button type="submit" class="btn btn-warning menu_keep_button"
                                        value="">更新</button></td>
                            </tr>
                        </form>
                        <tr id="skillList" style="" class="color1 tr-list-{{ $loop->iteration }}">
                            <td class="skill-no">{{ $loop->iteration }}</td>
                            <td class="skill-name">{{ $language->skill_name }}</td>
                            <td class="skill-update"><button type="button" class="btn update-{{ $loop->iteration }}"
                                    id="update" onClick="update(this)">編集</button></td>
                            <td class="skill-update">
                                <form id="del-skill"
                                    action="{{ route('skill.destroy', ['skill_id' => $language->skill_id]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn menu_keep_button"
                                        onClick="return delete_alert(event);">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-loading />
    </div>
    <script type="text/javascript">
        document.getElementById("saveBtn").style.display = "none";

        $(function() {

            $('button#add').click(function() {
                var tr_form = '' +
                    '<tr>' +
                    '<td><input type="text" name="skill_name[]"></td>' +
                    '</tr>';

                $(tr_form).appendTo($('.addskill'));

                document.getElementById("saveBtn").style.display = "";

            });
        });
    </script>
@endsection
