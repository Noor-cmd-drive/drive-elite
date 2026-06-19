<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Default Petrol rakh rahe hain taake purani gariyon par error na aaye
            $table->string('fuel_type')->default('Petrol')->after('transmission'); 
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('fuel_type');
        });
    }
};