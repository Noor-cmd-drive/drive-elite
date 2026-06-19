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
        // 🌟 'create' ki jagah 'table' use kar rahe hain taake existing table ke sath clash na ho
        // Aur future-proofing ke liye hum columns check kar ke add karenge
        Schema::table('bookings', function (Blueprint $table) {
            
            // Agar payment_method nahi hai toh add karo
            if (!Schema::hasColumn('bookings', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('id');
            }
            
            // Agar payment_status nahi hai toh add karo
            if (!Schema::hasColumn('bookings', 'payment_status')) {
                $table->string('payment_status')->default('unpaid')->after('payment_method');
            }

            // Agar transaction_id nahi hai toh add karo
            if (!Schema::hasColumn('bookings', 'transaction_id')) {
                $table->string('transaction_id')->nullable()->after('payment_status');
            }

            // Agar payment_proof nahi hai toh add karo
            if (!Schema::hasColumn('bookings', 'payment_proof')) {
                $table->string('payment_proof')->nullable()->after('transaction_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 🌟 Down method mein sirf wo columns drop karenge jo humne add kiye hain
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_status', 'transaction_id', 'payment_proof']);
        });
    }
};