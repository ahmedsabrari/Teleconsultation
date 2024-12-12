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
    Schema::create('patients', function (Blueprint $table) {
        $table->id();
        $table->string('first_name', 50);
        $table->string('last_name', 50);
        $table->string('email')->unique();
        $table->string('password');
        $table->string('phone', 20);
        $table->string('address')->nullable();
        $table->date('date_of_birth')->nullable();
        $table->boolean('phone_verified')->default(false);
        $table->string('profile_picture')->nullable();
        $table->enum('status', ['active', 'inactive', 'deactivated'])->default('active');
        $table->unsignedBigInteger('created_by')->nullable();
        $table->foreign('created_by')->references('id')->on('administrators')->onDelete('set null');
        $table->timestamps();
        $table->softDeletes(); // Enables soft delete functionality
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
