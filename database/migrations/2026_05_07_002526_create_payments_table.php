<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->foreignId('appointment_id')->nullable()->index();
            $table->string('payment_method')->default('Card'); // Card / bKash / Nagad later
            $table->string('transaction_id')->nullable();
            $table->decimal('amount', 10, 2); 
            $table->string('card_number')->nullable();
            $table->string('expiry')->nullable();
            $table->string('cvv')->nullable();
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
