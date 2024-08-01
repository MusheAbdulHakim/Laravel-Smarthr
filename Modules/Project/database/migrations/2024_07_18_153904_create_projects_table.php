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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('client_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->double('rate')->nullable();
            $table->string('rateType')->nullable();
            $table->string('priority')->nullable();
            $table->foreignId('leader_id')->nullable()->constrained('users')->onDelete('SET NULL');
            $table->text('short_desc')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
