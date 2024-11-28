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
        Schema::create('property_images', function (Blueprint $table) {
            $table->id('image_id');

            $table->foreignId('property_id') 
            ->references('property_id')
            ->on('properties')
            ->onDelete('cascade');
            
            $table->string('image_path');
            $table->string('caption')->nullable(); 
            $table->boolean('is_primary')->default(false); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_images');
    }
};
