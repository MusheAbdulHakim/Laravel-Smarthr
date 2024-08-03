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
        Schema::create('employee_salary_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_detail_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('basis')->nullable();
            $table->double('base_salary')->nullable();
            $table->string('payment_method')->nullable();
            $table->boolean('pf_contribution')->nullable()->default(false);
            $table->string('pf_number')->nullable();
            $table->double('additional_pf')->nullable();
            $table->double('total_pf_rate')->nullable();
            $table->boolean('esi_contribution')->nullable()->default(false);
            $table->string('esi_number')->nullable();
            $table->double('additional_esi_rate')->nullable();
            $table->double('total_additional_esi_rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salary_details');
    }
};
