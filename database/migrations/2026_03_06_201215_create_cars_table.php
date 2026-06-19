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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            // Category ke sath connection (Foreign Key)
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            $table->string('brand'); // Jaise: Toyota, Honda
            $table->string('model_name'); // Jaise: Corolla, Civic
            $table->string('year'); // Jaise: 2023
            $table->decimal('daily_rent', 8, 2); // Ek din ka kiraya
            $table->boolean('is_available')->default(true); // Gari available hai ya nahi
            $table->integer('seats'); // Kitni seats hain
            $table->string('transmission'); // Auto ya Manual
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Gari ki tasveer ka link
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
