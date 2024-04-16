<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal" id="selectUserModal" role="dialog">
        <div class="modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-color-brown">
                    <h4 class="modal-title text-white" id="myModalLabel">招待メンバー選択</h4></h4>
                </div>
                <div class="modal-body">
                    <div class="pb-3">
                        <button type="btn" class="btn btn--orange btn-hover" id="invite-sales-btn" style="width: fit-content">営業部</button>
                        <button type="btn" class="btn btn--orange btn-hover" id="invite-develop-btn" style="width: fit-content">システム開発部</button>
                        <button type="btn" class="btn btn--orange btn-hover" id="invite-infra-btn" style="width: fit-content">インフラ部</button>
                    </div>
                    <form id="memberSelect">
                    <div class="invited-color" id="invite-sales">
                        <?php $i=0; ?>
                        <div class="d-flex">
                        @foreach($member as $members)
                            @if($members->engineer_flg===2)
                            <?php $i++; ?>
                            <div class="modal-invite">
                                <label class="label--checkbox"><input class="invite_member checkbox" id="invite_member" name="{{$members->user_id}}" type="checkbox" value="{{$members->last_name}} {{$members->first_name}}"><span class="invite_member">{{$members->last_name}} {{$members->first_name}}</span></label>
                            </div>
                                @if($i%5==0)
                                </div>
                                <div class="d-flex">
                                @endif
                            @endif
                        @endforeach
                        </div>
                    </div>
                    <div class="invited-color" id="invite-develop">
                        <?php $i=0; ?>
                        <div class="d-flex">
                        @foreach($member as $members)
                            @if($members->engineer_flg===0)
                            <?php $i++; ?>
                            <div class="modal-invite">
                                <label class="label--checkbox"><input class="invite_member checkbox" id="invite_member" name="{{$members->user_id}}" type="checkbox" value="{{$members->last_name}} {{$members->first_name}}"><span class="invite_member">{{$members->last_name}} {{$members->first_name}}</span></label>
                            </div>
                                @if($i%5==0)
                                </div>
                                <div class="d-flex">
                                @endif
                            @endif
                        @endforeach
                        </div>
                    </div>
                    <div class="invited-color" id="invite-infra">
                        <?php $i=0; ?>
                        <div class="d-flex">
                        @foreach($member as $members)
                            @if($members->engineer_flg===1)
                            <?php $i++; ?>
                            <div class="modal-invite">
                                <label class="label--checkbox"><input class="invite_member checkbox" id="invite_member" name="{{$members->user_id}}" type="checkbox" value="{{$members->last_name}} {{$members->first_name}}"><span class="invite_member">{{$members->last_name}} {{$members->first_name}}</span></label>
                            </div>
                                @if($i%5==0)
                                </div>
                                <div class="d-flex">
                                @endif
                            @endif
                        @endforeach
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-hover" data-dismiss="modal" id="memberReset" onclick="formReset(this.id)" >キャンセル</button>
                            <button type="submit" class="btn btn-danger btn-hover" data-dismiss="modal" id="invite-member" value="">登録</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>