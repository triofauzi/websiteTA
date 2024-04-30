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
        Schema::create('biodata', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->char('identity_number')->nullable();
            $table->char('salutation')->nullable();
            $table->char('first_name')->nullable();
            $table->char('middle_name')->nullable();
            $table->char('last_name')->nullable();
            $table->char('gender')->nullable();
            $table->char('phone_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->char('place_of_birth')->nullable();
            $table->char('personal_email')->nullable();
            $table->longText('address')->nullable();
            $table->timestamps();

            $table->foreign('user_id', 'fk-biodata-user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodatas');
    }
};
