<?php

namespace App\Services; 


use Google\Client;
use Google\Service\Calendar\Event as Google_Service_Calendar_Event;
use Google\Service\Calendar as Calendar;           
use Carbon\Carbon;
use Google\Service\Exception;
use Illuminate\Support\Facades\DB;

class GoogleCalendarService
{
    private $service;    

    public function __construct()
    {
        $client = new Client();

        $client->setAuthConfig(env('GOOGLE_CALENDAR_API_KEY'));

        $client->addScope(Calendar::CALENDAR);

        $this->service = new Calendar($client);
    }
    
    public function createAppointment($request): Google_Service_Calendar_Event
    {
        DB::beginTransaction();
        $appointmentDetail = $this->createAppointmentDetail($request); 

        try {
            $calendarId = env('GOOGLE_CALENDAR_ID');
            $createdEvent = $this->service->events->insert($calendarId, $appointmentDetail);

            DB::commit(); 
            return $createdEvent;   

        } catch(Exception $e) {
            DB::rollBack();
            throw new \Exception('Google Calendar イベントの作成に失敗しました: ' . $e->getMessage());
        }
    }

    public function changeAppointment($request, $eventId): Google_Service_Calendar_Event
    {

        DB::beginTransaction();
        try {
            
            $appointmentDetail = $this->createAppointmentDetail($request);
            $calendarId = env('GOOGLE_CALENDAR_ID');
            $updatedEvent = $this->service->events->update($calendarId, $eventId, $appointmentDetail);
            
            DB::commit(); 
            return $updatedEvent;    
        } catch (Exception $e) {
            DB::rollBack(); 
            throw new \Exception('Google Calendar イベントの更新に失敗しました: ' . $e->getMessage());
        }
    }


    public function deleteAppointment(string $eventId)
    {
        DB::beginTransaction();
        try {
            $calendarId = env('GOOGLE_CALENDAR_ID');
            DB::commit(); 
            return $this->service->events->delete($calendarId, $eventId);

        } catch(Exception $e) {
            DB::rollBack();
            throw new \Exception('Google Calendar イベントの削除に失敗しました: ' . $e->getMessage());
        }
    }   

    private function createAppointmentDetail($request)
    {
        $startTime = Carbon::parse($request->appointmntDate . ' ' . $request->appointmntTime,  'Asia/Tokyo'); 
        $endTime = $startTime->copy()->addMinutes(60);  

        $appointmentDetail = [
            'summary' => $request->customerName,  
            'start' => [
                'dateTime' => $startTime->format('Y-m-d\TH:i:s'),
                'timeZone' => 'Asia/Tokyo',
            ],
            'end' => [
                'dateTime' => $endTime->format('Y-m-d\TH:i:s'), 
                'timeZone' => 'Asia/Tokyo',
            ],
            'description' => $request->detail, 
            'number' => $request->phoneNumber, 
        ];

        return  new Google_Service_Calendar_Event($appointmentDetail);
    }
}
