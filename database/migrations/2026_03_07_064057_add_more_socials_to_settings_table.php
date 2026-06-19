<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // No extra columns needed due to Key-Value pair logic
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};