<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest; 
use App\Services\GoogleCalendarService; 
use App\Services\AppointmentService;
use Illuminate\Support\Facades\DB;
use App\Notifications\AppointmentCreatedNotification;
use App\Notifications\AppointmentChangedNotification;
use App\Models\Admin;
use App\Notifications\AppointmentCreatedNotificationToAdmin;
use App\Notifications\AppointmentChangedNotificationToAdmin;  
use App\Notifications\AppointmentDeletedNotificationToAdmin; 


class AppointmentController extends Controller
{
    private $googleCalendarService; 
    private $appointmentService;    
    public function __construct(GoogleCalendarService $googleCalendarService,
    AppointmentService $appointmentService)    
    {
        $this->googleCalendarService = $googleCalendarService;
        $this->appointmentService = $appointmentService;    
    }

    /**
     * 予約の作成
     *
     * @return void
     */ 
    public function appointment(StoreAppointmentRequest $request)   
    {


        DB::beginTransaction(); 
    
        try {
            $appointmentIntoCalender = $this->googleCalendarService->createAppointment($request);
        
            $appointmentIntoCalenderId = $appointmentIntoCalender->getId();
    
            $appointment = $this->appointmentService->createAppointment($request, $appointmentIntoCalenderId);
    
            if ($appointment->email) {
                $appointment->notify(new AppointmentCreatedNotification($appointment));
            }

            $admins = Admin::all(); 
            foreach ($admins as $admin) {
                $admin->notify(new AppointmentCreatedNotificationToAdmin($appointment));
            }
    
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => '予約が完了しました',
                'eventId' => $appointmentIntoCalenderId
            ], 201);
    
        } catch (\Google_Service_Exception $e) {
            DB::rollBack();  
            return response()->json([
                'error' => 'GoogleカレンダーAPIでエラーが発生しました: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            DB::rollBack(); 
            return response()->json([
                'success' => false,
                'error' => '予約作成に失敗しました: ' . $e->getMessage() . '。もう一度お試しください。'
            ], 500);
        }
    }

    

    /**
     * 予約の変更
     *
     * @return void
     */ 
    public function changeAppointment(string $eventId, StoreAppointmentRequest $request)
    {
        DB::beginTransaction();
        try {
            $appointmentIntoCalender = $this->googleCalendarService->changeAppointment($request, $eventId); 

            $appointment = $this->appointmentService->changeAppointment($request, $eventId); 

            if ($appointment->email) {
                $appointment->notify(new AppointmentChangedNotification($appointment));
            }


            $admins = Admin::all(); 
            foreach ($admins as $admin) {
                $admin->notify(new AppointmentChangedNotificationToAdmin($appointment));
            }

            DB::commit();

            return response()->json([
                'message' => '予約が変更されました',
                'eventId' => $appointmentIntoCalender->getId()
            ], 201);

        } catch (\Google_Service_Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'GoogleカレンダーAPIでエラーが発生しました: ' . $e->getMessage()
            ], 500);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => '予約の変更に失敗しました: ' . $e->getMessage() . '。もう一度お試しください。'
            ], 500);
        }
    }


    /**
     * 予約の削除
     *
     * @return void
     */ 
    public function deleteAppointment(string $eventId)
    {
        DB::beginTransaction();
        try {
            $this->googleCalendarService->deleteAppointment($eventId);  

            $appointment = $this->appointmentService->deleteAppointment($eventId);

            $admins = Admin::all(); 
            foreach ($admins as $admin) {
                $admin->notify(new AppointmentDeletedNotificationToAdmin($appointment));
            }

            DB::commit();



            return response()->json([
                'message' => '予約が削除されました',
            ], 200);

        } catch (\Google_Service_Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'GoogleカレンダーAPIでエラーが発生しました: ' . $e->getMessage()
            ], 500);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => '予約の削除に失敗しました: ' . $e->getMessage() . '。もう一度お試しください。'
            ], 500);
        }
    }

}
