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
            $table->id()->primary();
            $table->string('title');
            $table->text('place');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->text('description');
            $table->text('location');
            // $table->text('video');
            $table->timestamps();
        });

        /*
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('event_id')->references('id')->on('events');
            $table->string('name');
            $table->string('email');
            $table->string('no_telp');
            $table->integer('amount');
            // $table->integer('price');
            $table->integer('total');
            $table->boolean ('confirmed');
            $table->timestamps();
        });
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        //Schema::dropIfExists('transactions');
    }
};
