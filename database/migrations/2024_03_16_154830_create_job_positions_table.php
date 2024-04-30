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
        Schema::create('job_positions', function (Blueprint $table) {
            $table->id();
            $table->char('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->char('department');
            $table->char('salary_range')->nullable();
            $table->longText('description')->nullable();
            $table->char('job_type');
            $table->char('job_place')->nullable();
            $table->char('expected_experience');
            $table->enum('is_need_candidate', ['Y', 'N']);
            $table->timestamps();

            $table->foreign('parent_id', 'fk-job_positions-parent_id')
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
        Schema::dropIfExists('job_positions');
    }
};
