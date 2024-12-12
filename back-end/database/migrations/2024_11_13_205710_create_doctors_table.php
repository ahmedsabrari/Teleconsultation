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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('specialty', 100);
            $table->string('phone', 20);
            $table->json('availability')->nullable();
            $table->string('profile_picture')->nullable();
            $table->enum('status', ['available', 'on_leave', 'unavailable'])->default('available');
            $table->string('hospital_affiliation')->nullable();
            $table->integer('years_of_experience')->nullable();
            // Add the created_by column
            $table->unsignedBigInteger('created_by')->nullable();
            // Define the foreign key relationship
            $table->foreign('created_by')->references('id')->on('administrators')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
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
