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
        Schema::create('loan_schedules', function (Blueprint $table) {
            $table->id('ScheduleID');
            $table->unsignedBigInteger('LoanID');
            $table->date('PaymentDate');
            $table->decimal('PaymentAmount', 10, 2);
            $table->decimal('PrincipalPaid', 10, 2);
            $table->decimal('InterestPaid', 10, 2);
            $table->decimal('Balance', 10, 2);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('LoanID')->references('LoanID')->on('loans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_schedule');
    }
};
