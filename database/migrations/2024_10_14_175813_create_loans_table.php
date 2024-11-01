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
        Schema::create('loans', function (Blueprint $table) {
            $table->id('LoanID');
            $table->unsignedBigInteger('BorrowerID');
            $table->decimal('LoanAmount', 10, 2);
            $table->decimal('InterestRate', 5, 2);
            $table->integer('LoanTerm');
            $table->date('StartDate');
            $table->date('EndDate');
            $table->string('PaymentType', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
