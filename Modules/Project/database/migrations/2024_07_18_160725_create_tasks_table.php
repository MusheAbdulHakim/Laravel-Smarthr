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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('project_task_board_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('priority')->nullable();
            $table->dateTime('startDate')->nullable();
            $table->dateTime('endDate')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('SET NULL');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
