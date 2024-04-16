<div id="filter_modal" class="modal w-100 h-100" role="dialog" data-keyboard="true" >
    <div class="modal-content flter-modal-content">
        <div class="modal-header bg-color-brown">
            <h4 class="text-white mb-0">絞り込み検索</h4>
        </div>
        <div class="modal-body filter-modal-body">
            <div class="filter-modal-container d-flex flex-wrap justify-content-center">
                <div class="filter_check_area d-flex justify-content-center m-2">
                    {{-- Cookieパターン --}}
                    {{-- <input type="checkbox" id="dev_flg" class="filter_check filter_enginer_flg mr-4" name="filter_engineer_flg[]" value="0" {{ isset($_COOKIE["filter_engineer_flg"]) && in_array("0", json_decode($_COOKIE["filter_engineer_flg"])) ? "checked" : "" }}> --}}
                    <input type="checkbox" id="dev_flg" class="filter_check filter_enginer_flg mr-4" name="filter_engineer_flg[]" value="0" {{ isset($_GET["filter_engineer_flg"]) &&  in_array("0", $_GET["filter_engineer_flg"]) ? "checked" : "" }}>
                    <label for="dev_flg" class="add_filter_button add_dev mb-0"><span class="check_mark mr-1">✔</span>開発部</label>
                </div>  
                <div class="filter_check_area d-flex justify-content-center m-2">
                    {{-- Cookieパターン --}}
                    {{-- <input type="checkbox" id="infra_flg" class="filter_check filter_enginer_flg mr-4" name="filter_engineer_flg[]" value="1" {{ isset($_COOKIE["filter_engineer_flg"]) && in_array("1", json_decode($_COOKIE["filter_engineer_flg"])) ? "checked" : "" }}> --}}
                    <input type="checkbox" id="infra_flg" class="filter_check filter_enginer_flg mr-4" name="filter_engineer_flg[]" value="1" {{ isset($_GET["filter_engineer_flg"]) &&  in_array("1", $_GET["filter_engineer_flg"]) ? "checked" : "" }}>
                    <label for="infra_flg" class="add_filter_button add_infra mb-0"><span class="check_mark mr-1">✔</span>インフラ部</label>
                </div>
                {{-- 下記 -- 所属までの絞り込み --}}
                {{-- @foreach($belongs_list as $belongs)
                        <div class="filter_check_area d-flex m-2">
                            <input type="checkbox" class="filter_check mr-4" name="filter_belongs_name[]" value={{ $belongs->belongs_name }}>{{ $belongs->belongs_name }}
                        </div>
                    @endif
                @endforeach --}}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-warning menu_keep_button">絞り込む</button>
            <button type="button" class="btn" data-dismiss="modal">閉じる</button>
        </div>
    </div>
</div>
