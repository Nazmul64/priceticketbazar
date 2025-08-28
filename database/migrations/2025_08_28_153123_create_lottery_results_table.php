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
        Schema::create('lottery_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_package_buy_id')->constrained('userpackagebuys')->cascadeOnDelete();
            $table->enum('win_status', ['won', 'lost'])->default('lost');
            $table->decimal('win_amount', 10, 2)->default(0);
            $table->timestamp('draw_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery_results');
    }
};
