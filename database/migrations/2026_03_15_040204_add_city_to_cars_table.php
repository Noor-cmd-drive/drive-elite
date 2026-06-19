<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 🌟 DATABASE UPGRADE: Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Hum city ka column add kar rahe hain. 
            // Default 'Global' rakh rahe hain taake purani gariyon par error na aaye.
            $table->string('city')->default('Global')->after('model_name'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('city');
        });
    }
};