<?php


namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Calendar\Event as Google_Service_Calendar_Event; 
use Google\Service\Calendar as Calendar;    

class GoogleCalendarController extends Controller
{
    public function createEvent()
    {
        $client = new Client();

            
        $client->setAuthConfig('/Users/suzukiakirasatoru/Desktop/project/my-project-test01-442106-6d76e61a96db.json');


        $client->addScope(Calendar::CALENDAR);

        $service = new Calendar($client);

        // イベントの詳細を設定
        $event = new Google_Service_Calendar_Event([
            'summary' => 'テストイベント',
            'location' => '東京都',
            'description' => 'このイベントはテストです。',
            'start' => [
                'dateTime' => '2024-11-21T10:00:00', 
                'timeZone' => 'Asia/Tokyo',
            ],
            'end' => [
                'dateTime' => '2024-11-21T12:00:00',
                'timeZone' => 'Asia/Tokyo',
            ],
        ]);

        $calendarId = '8edcf9f3bbc896f3c516d6a785924d99f3570e7453067cde66b35c870b0902be@group.calendar.google.com';
        $event = $service->events->insert($calendarId, $event);

        // 作成したイベントの詳細を表示
        return response()->json([
            'message' => 'イベントが作成されました。',
            'eventId' => $event
        ]);
    }
}
