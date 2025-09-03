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
        // Users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Reset token
            $table->string('reset_token')->nullable();
            $table->timestamp('reset_token_expires_at')->nullable();

            // Referral system
            $table->unsignedBigInteger('referred_by')->nullable()->comment('User ID who referred this user');
            $table->unsignedBigInteger('ref_id')->nullable()->comment('Alternate referral user ID');
            $table->string('ref_code')->unique()->nullable();

            // Wallet & commission
            $table->decimal('balance', 12, 2)->default(0.00)->comment('User wallet balance');
            $table->decimal('refer_income', 12, 2)->default(0.00)->comment('Direct referral commission earned');
            $table->decimal('generation_income', 12, 2)->default(0.00)->comment('Generation level commission earned');

            // Basic info
            $table->string('name');
            $table->string('walate_address')->default('default_address');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('username')->nullable()->unique();

            // Role & status
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->enum('status', ['active', 'inactive'])->default('active');

            // Profile image
            $table->string('image')->nullable();

            // Authentication & timestamps
            $table->rememberToken();
            $table->timestamps();
        });

        // Adding foreign keys after table creation to avoid migration refresh issues
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('referred_by')
                  ->references('id')->on('users')
                  ->nullOnDelete();
            $table->foreign('ref_id')
                  ->references('id')->on('users')
                  ->nullOnDelete();
        });

        // Password reset tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys first to avoid constraint errors
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['referred_by']);
            $table->dropForeign(['ref_id']);
        });

        // Drop tables
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
