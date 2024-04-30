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
        Schema::create('employee_bank', function (Blueprint $table) {
            $table->id();
            $table->char('account_name');
            $table->char('account_number');
            $table->char('currency');
            $table->char('bank_name');
            $table->char('bank_branch');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id', 'fk-employee_bank-user_id')
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
        Schema::dropIfExists('employee_banks');
    }
};
