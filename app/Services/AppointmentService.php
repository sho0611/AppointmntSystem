<?php

namespace App\Services; 

use App\Models\Appointment; 
use Illuminate\Support\Facades\DB;

class AppointmentService
{
    public function createAppointment($request, $appointmentIntoCalenderId): ?Appointment
    {
        DB::beginTransaction(); 
        try {
            $appointmentData = $this->buildAppointmentArray($request, $appointmentIntoCalenderId);
            $appointment = Appointment::create($appointmentData);
        
        DB::commit(); 
        return $appointment;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('データベースの保存に失敗しました: ' . $e->getMessage());
        }
    }  
    
    public function changeAppointment($request, $eventId): ?Appointment
    {
        DB::beginTransaction(); 
        try {
            $appointmentData = $this->buildAppointmentArray($request);
            $appointment = Appointment::where('google_event_id', $eventId)->first();
    
            if (!$appointment) {
                throw new \Exception('指定された Event ID の予約が見つかりません。Event ID: ' . $eventId);
            }

            $appointment->update($appointmentData);
            $updatedAppointment = Appointment::where('google_event_id', $eventId)->first();
    
            DB::commit();
            
            return $updatedAppointment;    
    
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('データベースの更新に失敗しました: ' . $e->getMessage() . ' Event ID: ' . $eventId);
        }
    }
    

    public function deleteAppointment(string $eventId): ?Appointment
    {
        DB::beginTransaction(); 
        try {
            $appointment = Appointment::where('google_event_id', $eventId)->first();

            if ($appointment) {
                $appointment->delete();
            }

            DB::commit(); 
            return $appointment; 

        } catch (\Exception $e) {
            DB::rollBack(); 
            throw new \Exception('データベースの削除に失敗しました: ' . $e->getMessage());
        }
    }


    private function buildAppointmentArray($request, $appointmentIntoCalenderId = null)      
    {
        $data = [
            'customerName' => $request->customerName,
            'appointmntDate' => $request->appointmntDate,
            'appointmntTime' => $request->appointmntTime,
            'phoneNumber' => $request->phoneNumber,
            'detail' => $request->detail,
            'email' => $request->email, 
        ];

        if ($appointmentIntoCalenderId !== null) {
            $data['google_event_id'] = $appointmentIntoCalenderId;
        }
        
        return $data;
    }
}