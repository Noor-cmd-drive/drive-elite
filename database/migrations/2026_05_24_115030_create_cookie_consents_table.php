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
        Schema::create('cookie_consents', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // Agar user logged in hai toh ID save hogi
            $table->string('consent_status'); // accept_all, reject_all, customized
            $table->json('preferences')->nullable(); // Isme analytics, marketing wagera ki true/false setting aayegi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cookie_consents');
    }
};
