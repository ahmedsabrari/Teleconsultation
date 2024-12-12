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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipient_id')->constrained('patients')->onDelete('cascade');
            $table->enum('type', ['reminder', 'confirmation', 'alert']);
            $table->text('message');
            $table->timestamp('read_at')->nullable();
            $table->dateTime('sent_date')->index(); // Index for faster queries
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
