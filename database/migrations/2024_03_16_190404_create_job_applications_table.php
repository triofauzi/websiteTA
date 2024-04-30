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
        Schema::create('job_application', function (Blueprint $table) {
            $table->id();
            $table->char('full_name');
            $table->char('residence_address');
            $table->char('gender');
            $table->char('phone_number');
            $table->char('email');
            $table->date('date_of_birth');
            $table->char('place_of_birth');
            $table->string('curriculum_vitae');
            $table->unsignedBigInteger('job_position_id');
            $table->char('application_status')->default('submitted');
            $table->string('letter_path')->nullable();
            $table->timestamps();

            $table->foreign('job_position_id', 'fk-job_application-job_position_id')
                ->references('id')
                ->on('job_positions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
