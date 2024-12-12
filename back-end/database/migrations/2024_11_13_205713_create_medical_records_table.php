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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->text('medical_history')->nullable();
            $table->text('allergies')->nullable();
            $table->text('current_treatments')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamp('last_updated')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('updated_by')->references('id')->on('administrators')->onDelete('set null');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
