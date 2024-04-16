<?php

namespace App\Http\Controllers\Master;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Master\Announcement;
use App\Http\Controllers\Controller;


class AnnouncementController extends Controller
{
    public function __construct(private ?Announcement $announcementModel = null){}

    /**
     * お知らせ管理ページ
     *
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function index(Request $request): RedirectResponse|View
    {

        if (session('auth_name') !== 'admin')
            return redirect('/resume-list');

        $sort = $request->sort === config('resumeApp.ORDER_BY.ASC')  ? config('resumeApp.ORDER_BY.ASC') : config('resumeApp.ORDER_BY.DESC');

        return view('announcements.index', [
            'sort'          => $sort,
            'weekday_array' => config('resumeApp.WEEKDAY_ARRAY'),
            'announcements' => $this->announcementModel->findAllAnnouncements($sort)
        ]);
    }

    /**
     * お知らせ作成
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->announcementModel->insertAnnouncement([
            'announcement_text' => $request->announcement_text,
            'announcement_date' => $request->announcement_date,
            'create_id' => session('user_id')
        ]);

        return redirect()->route('announcements.index');
    }

    /**
     * お知らせ削除
     *
     * @param integer $announcementId
     * @return RedirectResponse
     */
    public function destroy(int $announcementId): RedirectResponse
    {
        $this->announcementModel->deleteAnnouncement($announcementId);
        return redirect()->route('announcements.index');
    }
}
