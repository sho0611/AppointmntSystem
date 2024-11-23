<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->string('google_event_id')->unique(); 
            $table->string('appointmntCustomerName');  
            $table->string('appointmntDate');  
            $table->string('appointmntTime'); 
            $table->string('appointmntDetail');
            $table->string('appointmntCustomerPhoneNumber');    
            $table->timestamps();  
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
