<div class="modal" id="addUserModal" role="dialog">
        <div class="modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-color-brown">
                    <h4 class="modal-title text-white" id="myModalLabel">社員情報追加</h4></h4>
                </div>
                <div class="modal-body">
                <form action="{{ route('create.user') }}" method="post" id="userAdd" class="checkform">
                @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <p>氏名</p>
                        </div>
                        <div class="col-md-2">
                            <p style="text-align:right; color:red">[必須]</p>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-input require" name="lastname" placeholder="山田">
                            <span class="alertarea"></span>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-input require" name="firstname" placeholder="太郎">
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
                            <input type="text" class="form-input kana" name="lastname_kana" placeholder="ヤマダ">
                            <span class="alertarea"></span>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-input kana" name="firstname_kana" placeholder="タロウ">
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
                            <input type="text" class="form-input mail" id="mail" name="mail" placeholder="xxx@salto.link">
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
                            <input type="text" class="form-input initial" name="initial" placeholder="T.Y">
                            <span class="alertarea"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>Slack メンバーID</p>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-input member_id" name="member_id">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>権限</p>
                        </div>
                        <div class="col-md-2">
                            <select name="authority">
                                <option value="sales">営業</option>
                                <option value="recruitment">採用</option>
                                <option value="manager">技術（役職あり）</option>
                                <option value="member">技術（役職なし）</option>
                                <option value="admin">管理者</option>
                            </select>
                        </div>
                        <div class="tooltip1">
                            <img src="{{ asset('img/Question.png') }}" class="user-posQ">
                            <div class="user-description">権限の選択例<br>　※営業： 営業部<br>　※採用： 採用部<br>　※技術（役職あり）： 部長・課長・主任<br>　※技術（役職なし）： 役職なし<br>　※管理者： 当システム運用者
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>役職</p>
                        </div>
                        <div class="col-md-8">
                            <select name="position">
                                @foreach($position_list as $row)
                                    <option value="{{ $row->position_id }}">{{$row->position_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>所属部署</p>
                        </div>
                        <div class="col-md-8">
                            <select name="belongs">
                                @foreach($belongs_list as $row)
                                    <option value="{{ $row->belongs_id }}">{{$row->belongs_name}}</option>
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
                                <option value="0">開発</option>
                                <option value="1">インフラ</option>
                                <option value="2">営業</option>
                                <option value="3">その他</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>ゲストフラグ</p>
                        </div>
                        <div class="col-md-8">
                            <label>
                                <input class="invite_member" type="checkbox" id="Checkbox1" name="guest" onchange="myfunc(this.value)">
                                <a class="invite_member col-md-3">ゲスト</a>
                                <a class="col-md-4">※入社前所属部署はゲスト設定&チェックをお願いいたします。</a>
                            </label>
                        </div>
                    </div>
                    <div class="row" id="hidden1" style="display:none">
                        <div class="col-md-4">
                            <p>パスワード</p>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-input userpassword clickme_btn" id='password' name="password" value="" placeholder="半角英数字8～16文字" readonly>
                            <span class="alertarea" id="password-alert"></span>
                        </div>
                        <div>
                            <button type='button' class='btn btn-default ml-1 btn-hover' id="password-gen" onclick="gen()">自動生成</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <input type="reset" value="キャンセル" class="btn btn-default btn-hover" data-dismiss="modal" id="userAdd" onclick="formReset(this.id)">
                            <button type="submit" class="btn btn-danger btn-hover" value="">登録</button>
                    </div>
                    <x-loading />
                </form>
                </div>
            </div>
        </div>
    </div>