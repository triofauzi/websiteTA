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
        Schema::create('career_transition_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_position_from_id');
            $table->unsignedBigInteger('job_position_to_id');
            $table->char('letter_path');
            $table->timestamps();

            $table->foreign('user_id', 'fk-career_transition_histories-user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('job_position_from_id', 'fk-career_transition_history-job_position_from_id')
                ->references('id')
                ->on('job_positions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreign('job_position_to_id', 'fk-career_transition_history-job_position_to_id')
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
        Schema::dropIfExists('career_transition_histories');
    }
};
