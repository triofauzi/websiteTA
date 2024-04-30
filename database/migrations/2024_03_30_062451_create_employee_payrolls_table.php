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
        Schema::create('employee_payroll', function (Blueprint $table) {
            $table->id();
            $table->char('salary')->nullable();
            $table->unsignedBigInteger('employee_bank_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('employee_bank_id', 'fk-employee_payroll-employee_bank_id')
                ->references('id')
                ->on('employee_bank')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id', 'fk-employee_payroll-user_id')
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
        Schema::dropIfExists('employee_payrolls');
    }
};
