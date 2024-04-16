<section id="login-page-announcement" class="col-md-6 bg-color-brown">
    <div class="mt-3 p-3">
        <h3 class="text-white">お知らせ</h3>
        @foreach ($announcements as $announcement)
            <article class="bg-white p-3 mt-3 mb-5">
                <h4 class="mr-3 p-2 border-bottom border-dark flex-grow-1">
                    {{ $announcement->announcement_date }}
                    ({{ $weekday_array[$announcement->announcement_weekday] }})
                </h4>
                <span>
                    {!! nl2br(htmlspecialchars($announcement->announcement_text)) !!}
                </span>
            </article>
        @endforeach
    </div>
</section>
