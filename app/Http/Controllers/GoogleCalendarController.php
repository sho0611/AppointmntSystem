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

        $client->setAuthConfig(env('GOOGLE_CALENDAR_API_KEY'));
        


        $client->addScope(Calendar::CALENDAR);

        $service = new Calendar($client);

        $event = new Google_Service_Calendar_Event([
            'summary' => 'テストイベント',
            'location' => '東京都',
            'description' => 'このイベントはテストです。',
            'start' => [
                'dateTime' => '2024-11-25T10:00:00', 
                'timeZone' => 'Asia/Tokyo',
            ],
            'end' => [
                'dateTime' => '2024-11-25T12:00:00',
                'timeZone' => 'Asia/Tokyo',
            ],
        ]);

        $calendarId = env('GOOGLE_CALENDAR_ID');
        
        try {
            $event = $service->events->insert($calendarId, $event);
            
            return response()->json([
                'message' => 'イベントが作成されました。',
                'eventId' => $event->getId()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'イベント作成に失敗しました: ' . $e->getMessage()
            ], 500);
        }
    }
}

