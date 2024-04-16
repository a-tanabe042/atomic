<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;

class GoogleClientStoreService
{

    public function execute(string $redirectURL): Google_Client
    {
        $client = new Google_Client();
        $client->setApplicationName(config('app.name'));
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri($redirectURL);
        $client->setScopes([Google_Service_Calendar::CALENDAR_EVENTS]);
        $client->setAccessType('offline');
        $client->setPrompt('force');

        return $client;
    }
}
