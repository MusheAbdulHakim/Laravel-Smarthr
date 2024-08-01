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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->string('est_id')->nullable();
            $table->foreignId('client_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('taxe_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('client_address')->nullable();
            $table->string('billing_address')->nullable();
            $table->date('startDate')->nullable();
            $table->date('expiryDate')->nullable();
            $table->double('tax_amount')->nullable();
            $table->double('discount')->nullable();
            $table->double('subtotal')->nullable();
            $table->double('grand_total')->nullable();
            $table->longText('note')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};
