<?php

namespace App\Services;

use Google_Client;
use Carbon\Carbon;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventAttendee;
use App\Services\GoogleClientStoreService;
use App\Models\T_User;

class CalendarService
{
    public function __construct(private Google_Client $client){}

    /**
     * イベントのリストの取得
     * @param GoogleUser $user
     * @return array
     */
    public function getEventList($request)
    {
        // googleInfoにtokenの内容をupdateOrCreateする。暗号化してDBに入れた方が良いと思うが略
        $client = (new GoogleClientStoreService())->execute(route('get.calendar.list'));

        $user  = T_User::where('user_id', session()->get('user_id'))->first();
        $token = $this->setAccessToken($user, $client);

        $client->setAccessToken($token);


        $service = new Google_Service_Calendar($client);

        $event = $this->createCalendarEvent($request);
        //$event->setSource($this->createEventSource($request));
        $event->setDescription($request->calendar_text);

        //メンバーの数だけfor文回す
        $count = count($request->invited_member);
        for ($i = 0; $i < $count; $i++) {
            //メンバーIDからアドレスを取得
            $user = T_User::where('user_id', $request->invited_member[$i])->get();
            $attendeeNew = new Google_Service_Calendar_EventAttendee();

            $attendeeNew->setEmail($user[0]->mail_address);
            $attendees = $event->getAttendees();
            array_push($attendees, $attendeeNew);
            $event->setAttendees($attendees);
        }

        $event = $service->events->insert('primary', $event);
        //parse_str(parse_url($event->htmlLink, PHP_URL_QUERY), $eventId); // eventIdの取得

    }


    private function createCalendarEvent($request): Google_Service_Calendar_Event
    {
        $data = $request->calendar_date . ' ' . $request->calendar_time;
        $end_data = $request->calendar_date . ' ' . $request->calendar_time;
        $date = Carbon::parse($data)->format(DATE_RFC3339);
        $end_data = Carbon::parse($end_data)->addHour()->format(DATE_RFC3339);
        return new Google_Service_Calendar_Event([
            'summary' => $request->calendar_title,
            'start' => [
                'dateTime' => $date,
                'timeZone' => config('app.timezone'),
            ],
            'end' => [
                'dateTime' => $end_data,
                'timeZone' => config('app.timezone'),
            ],
            'guestsCanInviteOthers' => false,

        ]);
    }


    /**
     * アクセストークンのセット
     * @param $user
     * @return void
     */
    private function setAccessToken($user, $client)
    {
        if (Carbon::now()->toDateTimeString() >= Carbon::parse($user->guest_limit)->addHour()->toDateTimeString()) {
            $token = $client->fetchAccessTokenWithRefreshToken($user->google_reflesh_token);
            $token = $token['access_token'];
        } else {
            $token = $user->google_access_token;
        }

        return $token;
    }
}
