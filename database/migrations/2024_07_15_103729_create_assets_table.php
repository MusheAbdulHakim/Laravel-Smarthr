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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('ast_id');
            $table->string('name');
            $table->date('purchase_date');
            $table->string('purchase_from');
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('supplier')->nullable();
            $table->string('ast_condition')->nullable();
            $table->string('warranty')->nullable();
            $table->string('warranty_end')->nullable();
            $table->string('brand')->nullable();
            $table->string('cost');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('SET NULL');
            $table->text('description')->nullable();
            $table->string('status')->nullable()->default('approved');
            $table->jsonb('files')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
