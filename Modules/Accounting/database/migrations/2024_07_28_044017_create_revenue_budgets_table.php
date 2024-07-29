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
        Schema::create('revenue_budgets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('budget_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('budget_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->double('amount')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenue_budgets');
    }
};
