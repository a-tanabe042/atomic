@extends('layouts.template')

@section('title', '部署一覧')
@include('layouts.head')

@section('content')

<div class="list">
    <h4 class="text-color-light-blue font-weight-bold">
        部署一覧
    </h4>

    <div class="skill-add">
        <form action="{{ route('add.belongs') }}" method="post" id="skillAdd" class="checkform skill-add">
            @csrf
            <button id="add" type="button" class="btn btn--orange skill-add-btn">＋</button>
            <div class="addskill">

            </div>
            <div class="save-btn">
                <input id="saveBtn" type="submit" class="btn btn--orange menu_keep_button" name="send" value="保存">
            </div>
        </form>
    </div>

    <div class="belongs">
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
                        <td class="skill-no"></td>
                    </tr>
                    @foreach($belongs_list as $belongs)
                        <tr class="color1">
                            <td class="skill-no">{{$loop->iteration}}</td>
                            <td class="skill-name">{{$belongs->belongs_name}}</td>
                            <td class="skill-update">
                            <form id="del-belong" action="{{ route('belongs.delete', ['belongs_id'=>$belongs->belongs_id]) }}" method="POST">
                            @csrf
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
 
  $('button#add').click(function(){
  var tr_form = '' +
  '<tr>' +
    '<td><input type="text" name="belongs_name[]" placeholder="所属名"></td>' +
    '<td><select name="belongs[]"> '+
        '<?php $i=0; ?>' +
        '@foreach($belongs_list as $belongs)'+
        '<?php $i++; ?>'+
        '<option value="{{ $belongs->belongs_id }}">{{$belongs->belongs_name}}</option>'+
        '@endforeach'+
        '</select></td>' +
  '</tr>';
 
  $(tr_form).appendTo($('.addskill'));

  document.getElementById("saveBtn").style.display ="";
 
    });
});
</script>

@endsection