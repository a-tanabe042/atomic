<div class="list-pagi menu_keep_button @if(isset($class)){{ $class }}@endif">
    @if (isset($filterEngineerFlg) && isset($filterEngineerFlg))
        {{ $query->appends(['filter_engineer_flg' => $filterEngineerFlg])->appends(['display_select' => $displaySelect])->links('pagination::bootstrap-4') }}
    @elseif(isset($displaySelect))
        {{ $query->appends(['display_select' => $displaySelect])->links('pagination::bootstrap-4') }}
    @elseif(isset($filterEngineerFlg))
        {{ $query->appends(['filter_engineer_flg' => $filterEngineerFlg])->links('pagination::bootstrap-4') }}
    @else
        {{ $query->links('pagination::bootstrap-4') }}
    @endif
</div>