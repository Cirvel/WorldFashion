<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('ticket_id')->references('id')->on('tickets');
            $table->string('name');
            $table->string('email');
            $table->string('no_telp');
            $table->integer('amount');
            $table->integer('total');
            $table->string('order_id');
            $table->string('snap_token');
            $table->enum('transaction_status', ['success', 'pending', 'expired'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
