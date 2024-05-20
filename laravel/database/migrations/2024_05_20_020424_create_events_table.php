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
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('title');
            $table->text('place');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->text('description');
            // $table->text('location');
            // $table->text('video');
            $table->timestamps();
        });

        //
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('transaction_id')->primary();
            $table->foreignId('user_id')->index();
            $table->foreignId('event_id')->index();
            $table->string('name');
            $table->string('email');
            $table->string('no_telp');
            $table->integer('amount');
            // $table->integer('price');
            $table->integer('total');
            $table->boolean ('confirmed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('transactions');
    }
};
