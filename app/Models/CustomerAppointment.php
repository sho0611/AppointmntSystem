<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAppointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';   
    protected $primaryKey = 'appointment_id';   

    protected $fillable = [
        'google_event_id',
        'appointmntCustomerName',
        'appointmntDate',
        'appointmntTime',
        'appointmntCustomerPhoneNumber',    
        'appointmntDetail',
    ];  
}


