<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Calendar\Event as Google_Service_Calendar_Event;
use Google\Service\Calendar as Calendar;        
use App\Models\CustomerAppointment as Appointment;   
use App\Http\Requests\StoreAppointmentRequest;  
use Carbon\Carbon;
use Google\Service\Exception;

class CustomerAppointmentController extends Controller
{
    
    /**
     * 予約の作成
     *
     * @return void
     */ 
    public function appointment(StoreAppointmentRequest $request)   
    {
        $client = new Client();

        $client->setAuthConfig(env('GOOGLE_CALENDAR_API_KEY'));

        $client->addScope(Calendar::CALENDAR);

        $service = new Calendar($client);

        $startTime = Carbon::parse($request->appointmntDate . ' ' . $request->appointmntTime,  'Asia/Tokyo'); 
        $endTime = $startTime->copy()->addMinutes(60);  

    
        $appointmentDetail = new Google_Service_Calendar_Event([
            'summary' => $request->appointmntCustomerName,  
            'start' => [
                'dateTime' => $startTime->format('Y-m-d\TH:i:s'),
                'timeZone' => 'Asia/Tokyo',
            ],
            'end' => [
                'dateTime' => $endTime->format('Y-m-d\TH:i:s'), 
                'timeZone' => 'Asia/Tokyo',
            ],
            'description' => $request->appointmntDetail, 
            'location' => $request->appointmntCustomerPhoneNumber,  
        ]);

        try {
            $calendarId = env('GOOGLE_CALENDAR_ID');
            $appointmentIntoCalender = $service->events->insert($calendarId, $appointmentDetail);

        } catch(Exception $e) {
            return response()->json([
                'error' => 'カレンダーの作成に失敗しました: ' . $e->getMessage()
            ], 500);
        }

        try {
            $appointment = new Appointment(); 

            $appointment = Appointment::create([
                'google_event_id' => $appointmentIntoCalender->getId(),
                'appointmntCustomerName' => $request->appointmntCustomerName,
                'appointmntDate' => $request->appointmntDate,
                'appointmntTime' => $request->appointmntTime,
                'appointmntCustomerPhoneNumber' => $request->appointmntCustomerPhoneNumber,
                'appointmntDetail' => $request->appointmntDetail,   
            ]);

            return response()->json([
                'message' => '予約が完了しました',  
                'eventId' => $appointmentIntoCalender->getId()
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => '予約作成に失敗しました: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * 予約の変更
     *
     * @return void
     */ 
    public function cangeAppointmnt(string $eventId, StoreAppointmentRequest $request)
    {
        $client = new Client();

        $client->setAuthConfig(env('GOOGLE_CALENDAR_API_KEY'));

        $client->addScope(Calendar::CALENDAR);

        $service = new Calendar($client);

        $startTime = Carbon::parse($request->appointmntDate . ' ' . $request->appointmntTime,  'Asia/Tokyo'); 
        $endTime = $startTime->copy()->addMinutes(60);  

        $appointmentDetail = new Google_Service_Calendar_Event([
            'summary' => $request->appointmntCustomerName,  
            'start' => [
                'dateTime' => $startTime->format('Y-m-d\TH:i:s'),
                'timeZone' => 'Asia/Tokyo',
            ],
            'end' => [
                'dateTime' => $endTime->format('Y-m-d\TH:i:s'), 
                'timeZone' => 'Asia/Tokyo',
            ],
            'description' => $request->appointmntDetail, 
            'location' => $request->appointmntCustomerPhoneNumber,  
        ]);

        try {
            $calendarId = env('GOOGLE_CALENDAR_ID');
            $appointmentIntoCalender = $service->events->update($calendarId, $eventId, $appointmentDetail);

        } catch(Exception $e) {
            return response()->json([
                'error' => 'カレンダー更新に失敗しました: ' . $e->getMessage()
            ], 500);
        }   
        
        
        try {
            $appointment = Appointment::where('google_event_id', $eventId)->first();

            if (!$appointment) {
                return response()->json([
                    'error' => '予約が見つかりませんでした'
                ], 404);
            } 
    
            $appointment->update([
                'appointmntCustomerName' => $request->appointmntCustomerName,
                'appointmntDate' => $request->appointmntDate,
                'appointmntTime' => $request->appointmntTime,
                'appointmntCustomerPhoneNumber' => $request->appointmntCustomerPhoneNumber,
                'appointmntDetail' => $request->appointmntDetail,   
            ]); 
    
            return response()->json([
                'message' => '予約が変更されました',      
                'eventId' => $appointmentIntoCalender->getId()
            ]);
            
        } catch(\Exception $e) {
            return response()->json([
                'error' => 'イベント作成に失敗しました: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * 予約の削除
     *
     * @return void
     */ 
    public function deleteAppointmnt(string $eventId)
    {
        $client = new Client();

        $client->setAuthConfig(env('GOOGLE_CALENDAR_API_KEY'));

        $client->addScope(Calendar::CALENDAR);

        $service = new Calendar($client);

        try {
            $calendarId = env('GOOGLE_CALENDAR_ID');
            $service->events->delete($calendarId, $eventId);

        } catch(Exception $e) {
            return response()->json([
                'error' => 'カレンダー削除に失敗しました: ' . $e->getMessage()
            ], 500);
        }   
        
        try {
            $appointment = Appointment::where('google_event_id', $eventId)->first();

            if (!$appointment) {
                return response()->json([
                    'error' => '予約が見つかりませんでした'
                ], 404);
            } 
    
            $appointment->delete();
    
            return response()->json([
                'message' => '予約が削除されました',      
            ]);
            
        } catch(\Exception $e) {
            return response()->json([
                'error' => '予約削除に失敗しました: ' . $e->getMessage()
            ], 500);
        }
    }
}
