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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // User aur Car ka Link (Critical for Dashboard)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            
            // Customer ki info (Backup ke liye)
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            
            // Booking ki Dates (DateTime use kar rahe hain taake exact time bhi save ho)
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            
            // Bill aur Din
            $table->integer('total_days');
            $table->integer('total_price');
            
            // Status Logic
            $table->enum('status', ['Pending', 'Approved', 'Completed', 'Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};