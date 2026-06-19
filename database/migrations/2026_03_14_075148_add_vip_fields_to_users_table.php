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
        Schema::table('users', function (Blueprint $table) {
            // Naye columns add kar rahe hain
            $table->string('phone')->nullable()->after('email');
            $table->string('gender')->nullable()->after('phone');
            $table->date('dob')->nullable()->after('gender');
            $table->boolean('has_driving_license')->default(false)->after('dob');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Agar migration rollback karni pare toh ye columns delete ho jayenge
            $table->dropColumn(['phone', 'gender', 'dob', 'has_driving_license']);
        });
    }
};