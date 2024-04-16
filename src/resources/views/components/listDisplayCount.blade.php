@if (count($query) > 0)
    <div class="list-display-count">
        <span>全<span class="total-count-span">{{ $query->total() }}</span>件</span>
        <span class="ml-2 small">{{ ($query->currentPage() - 1) * $query->perPage() + 1 }} -
            {{ ($query->currentPage() - 1) * $query->perPage() + 1 + (count($query) - 1) }}件のデータが表示されています。</span>
    </div>
@else
    <p>データがありません。</p>
@endif