<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Controllers\Controller;

class ViewAppointmentContoller extends Controller
{
    public function appointmentById($eventId)
    {
        $appointment = Appointment::where('google_event_id', $eventId)->first();   
        if (!$appointment) {
            return response()->json([
                'error' => '指定された物件が見つかりません。',
            ], 404);
        }
        return response()->json([
            'appointment' => $appointment,
        ]); 
        
    }   
}

