<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;  
  

class Appointment extends Model
{
    use HasFactory, Notifiable; 

    protected $table = 'appointments';   
    protected $primaryKey = 'appointment_id';   

    protected $fillable = [
        'google_event_id',
        'customerName',
        'appointmntDate',
        'appointmntTime',
        'detail',
        'phoneNumber',
        'email'
    ];  
}


