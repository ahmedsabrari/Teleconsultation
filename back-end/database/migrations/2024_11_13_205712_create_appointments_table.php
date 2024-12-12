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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->dateTime('appointment_date')->index(); // Index for faster queries
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->string('appointment_type', 20)->default('telemedicine');
            $table->integer('duration')->nullable();
            $table->text('notes')->nullable();
            $table->string('video_link')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
