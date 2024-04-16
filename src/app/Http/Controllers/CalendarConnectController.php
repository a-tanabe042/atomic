<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CalendarConnectController extends Controller
{    
    /**
    * カレンダー 登録
    * @param Request $request
    * @return RedirectResponse
    */
    public function store(Request $request):RedirectResponse
    {
        // temporarySignedRouteのチェックがあるが略
        $classId = intval($request->input('class_id'));
        $class = Class::find($classId);

        $sessionStateToken = bin2hex(random_bytes(\GoogleConnectInfoConst::LENGTH));
        $student->googleConnectInfo()
            ->updateOrCreate([
                'class_id' => $classId
            ], [
                'session_state_token' => $sessionStateToken
            ]);

        $client = (new GoogleClientStoreService())->execute(route('student.google')); // actionでもok
        $client->setState($sessionStateToken);

        return redirect()->away($client->createAuthUrl());
    }
}
