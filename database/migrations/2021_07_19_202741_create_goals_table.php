<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goal_type_id')->nullable()->contrained()->onDelete('cascade');
            $table->string('subject');
            $table->string('target');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->string('status')->default('active');
            $table->integer('progress');
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
        Schema::dropIfExists('goals');
    }
}
