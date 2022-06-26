<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('inv_id')->nullable();
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('tax_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('email')->nullable();
            $table->string('client_address')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('due_date')->nullable();
            $table->jsonb('items')->nullable();
            $table->string('note')->nullable();
            $table->string('discount')->nullable();
            $table->string('total')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
