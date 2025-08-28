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
    Schema::create('withdraw_commissions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('withdraw_commission'); // Changed to unsignedBigInteger
        $table->unsignedBigInteger('money_exchange_commission'); // optional: renamed for clarity
        $table->boolean('status')->default(1);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_commissions');
    }
};
