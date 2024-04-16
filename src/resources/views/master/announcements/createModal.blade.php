<section id="create_modal" class="modal" role="dialog" data-keyboard="true">
    <div class="modal-content announcement-create-modal">
        <div class="modal-header bg-color-brown">
            <h4 class="text-white mb-0">お知らせ 新規登録</h4>
        </div>
        <form method="POST" action="{{ route('announcements.store') }}">
            @csrf
            <div class="modal-body filter-modal-body">
                <div class="bg-white m-2">
                    <div>
                        <label for="announcementInputDate" class="form-label mb-0">お知らせ日</label>
                        <h3 class="p-2 pb-3 border-bottom border-dark flex-grow-1">
                            <input type="date" name="announcement_date" id="announcementInputDate" required>
                        </h3>
                    </div>
                    <div class="my-3">
                        <label for="announcementTextarea" class="form-label">お知らせ内容</label>
                        <textarea class="form-control" name="announcement_text" id="announcementTextarea" rows="7" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button type="submit" class="btn text-white bg-color-light-blue menu_keep_button">作成</button>
            </div>
        </form>
    </div>
</section>
