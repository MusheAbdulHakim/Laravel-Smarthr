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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('username')->nullable();
            $table->string('type');
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('dial_code')->nullable();
            $table->integer('created_by')->nullable();
            $table->boolean('is_active')->nullable()->default(false);
            $table->string('lang')->nullable();
            $table->string('layout')->nullable();
            $table->string('color_scheme')->nullable();
            $table->string('layout_width')->nullable();
            $table->string('layout_position')->nullable();
            $table->string('topbar_color')->nullable();
            $table->string('sidebar_size')->nullable();
            $table->string('sidebar_view')->nullable();
            $table->string('sidebar_color')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
