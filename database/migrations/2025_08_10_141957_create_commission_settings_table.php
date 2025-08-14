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
    Schema::create('commission_settings', function (Blueprint $table) {
        $table->id();

        // Commission percentages
        $table->decimal('refer_commission', 5, 2)->default(10.00);         // 10%
        $table->decimal('generation_commission', 5, 2)->default(10.00);    // 10%

        // Generation level commissions
        $table->decimal('generation_level_1', 5, 2)->default(2.00); // 2%
        $table->decimal('generation_level_2', 5, 2)->default(2.00);
        $table->decimal('generation_level_3', 5, 2)->default(2.00);
        $table->decimal('generation_level_4', 5, 2)->default(2.00);
        $table->decimal('generation_level_5', 5, 2)->default(2.00);

        // Weekly team commission
        $table->decimal('weekly_team_commission', 5, 2)->default(4.00); // 4%

        // Status (1 = active, 0 = inactive)
        $table->boolean('status')->default(1);

        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission_settings');
    }
};
