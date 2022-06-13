<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('rate');
            $table->string('rate_type');
            $table->string('priority');
            $table->foreignId('leader')->nullable()->constrained('employees')->onDelete('cascade');
            $table->jsonb('team');
            $table->longText('description')->nullable();
            $table->jsonb('files')->nullable();
            $table->string('progress')->nullable();
            $table->boolean('status')->nullable()->default(true);
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
        Schema::dropIfExists('projects');
    }
}
