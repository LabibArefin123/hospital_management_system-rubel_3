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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('speciality')->nullable();
            $table->string('image')->nullable();
            $table->integer('success_rate')->nullable(); // 90
            $table->integer('experience_years')->nullable(); // 7
            $table->string('total_patients')->nullable(); // "2K+"
            $table->string('qualification')->nullable();
            $table->string('location')->nullable();
            $table->decimal('consultation_fee', 8, 2)->default(0);
            $table->enum('availability', ['Available', 'Not Available'])->default('Available');
            $table->text('about')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
