<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Services\CalendarService;

class CalendarController extends Controller
{

    public function __construct(private CalendarService $service){}

    /**
    * カレンダー 取得
    * @return View|Factory
    */
    public function getCalendarList(Request $request):View|Factory
    {
        $data = new Calendar();
        $query = $data->getCalendarList($request);
        $member = $data->getMemberList();
        $invited = $data->getInviteMemberList();

        return view('calendar', [
            'query' => $query,
            'member' => $member,
            'invited' => $invited
        ]);
    }

    /**
    * カレンダー 登録
    * @param Request $request
    * @return RedirectResponse
    */    
    public function sendCalendar(Request $request):RedirectResponse
    {
        $data = new Calendar();
        $data->saveCalendar($request);
        $this->service->getEventList($request);

        return back();
    }
}
