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
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->string('ps_id')->nullable();
            $table->string('title')->nullable();
            $table->foreignId('employee_detail_id')->nullable()->constrained()->onDelete('cascade');
            $table->boolean('use_allowance')->nullable()->default(true);
            $table->boolean('use_deduction')->nullable()->default(true);
            $table->date('payslip_date')->nullable();
            $table->string('type')->nullable();
            $table->string('weeks')->nullable();
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->string('total_hours')->nullable();
            $table->double('net_pay')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
