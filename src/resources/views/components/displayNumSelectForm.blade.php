<form class="d-inline" action="{{ route($route) }}" method="get">
    <span class="mr-1 font-weight-bold">表示件数</span>
    <select name="display_select" class="display-select menu_keep_button" onchange="submit(this.form)">
        <option value="10" {{ isset($displayNum) ? ($displayNum == 10 ? 'selected' : '') : 'selected' }}>
            10件
        </option>
        <option value="25" {{ isset($displayNum) && $displayNum == 25 ? 'selected' : '' }}>
            25件
        </option>
        <option value="50" {{ isset($displayNum) && $displayNum == 50 ? 'selected' : '' }}>
            50件
        </option>
        <option value="100" {{ isset($displayNum) && $displayNum == 100 ? 'selected' : '' }}>
            100件
        </option>
    </select>
    @include('filterUserModal')
</form>
