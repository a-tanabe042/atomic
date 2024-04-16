@extends('layouts.template')

@section('title', '部署一覧')
@include('layouts.head')

@section('content')

<div class="list">
    <h4 class="text-color-light-blue font-weight-bold">
        部署一覧
    </h4>

    <div class="skill-add">
        <form action="{{ route('department.store') }}" method="post" id="skillAdd" class="checkform skill-add" novalidate>
            @csrf
            <button id="add" type="button" class="btn btn--orange skill-add-btn">＋</button>
            <div class="addskill">

            </div>
            <div class="save-btn">
                <input id="saveBtn" type="submit" class="btn btn--orange menu_keep_button" name="send" value="保存">
            </div>
        </form>
    </div>

    <div class="department">
            @foreach ($errors->all() as $error)
            <div class="alert-danger skill-list">
                {{ $error }}
            </div>
            @endforeach
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

        <table class="skill-list">
                <tbody>
                    <tr class="skill-title" >
                        <td class="skill-no">No.</td>
                        <td class="skill-name">部署</td>
                        <td class="skill-no">順序</td>
                        <td class="skill-no"></td>
                    </tr>
                    @foreach($belongs_list as $belongs)
                        <tr class="color1">
                            <td class="skill-no">{{$loop->iteration}}</td>
                            <td class="skill-name">{{$belongs->belongs_name}}</td>
                            <td>{{$belongs->sort_order}}</td>
                            <td class="skill-update">
                                <form id="del-belong" action="{{ route('department.destroy', ['department'=>$belongs->belongs_id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn menu_keep_button" onClick="return delete_alert(event);">削除</button>
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

 document.getElementById("saveBtn").style.display ="none";

$(function() {
  var count = 0;

  $('button#add').click(function(){
  var tr_form = '' +
  '<tr>' +
    '<td><input type="text" name="belongs['+ count +'][belongs_name]" placeholder="所属名"></td>' +
    '<td><select name="belongs['+ count +'][parent_id]" style="height: 1.9em;" required> '+
        '<option selected hidden>親部署を選択してください</option>'+
        '@foreach($belongs_list as $belongs)'+
        '<option value="{{ $belongs->belongs_id }}">{{$belongs->belongs_name}}</option>'+
        '@endforeach'+
        '</select></td>' +
    '<td><input type="number" name="belongs['+ count +'][sort_order]" placeholder="表示順序" min="1" max="6" style="width: 6em;"></td>' +
  '</tr>';

  $(tr_form).appendTo($('.addskill'));

  document.getElementById("saveBtn").style.display ="";
  count++;
    });
});
</script>

@endsection
