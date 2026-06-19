<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade'); // Konsi gari hai?
            $table->string('service_type'); // Oil Change, Tuning, Wash, Repair etc.
            $table->decimal('cost', 10, 2); // Kitna kharcha hua?
            $table->date('service_date'); // Kis din service hui?
            $table->date('next_service_date')->nullable(); // Agli service kab honi hai?
            $table->text('notes')->nullable(); // Mechanic ki koi hidayat ya details
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};