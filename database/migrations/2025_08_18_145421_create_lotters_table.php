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
    Schema::create('lotters', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable();
        $table->decimal('price')->nullable();
        $table->text('description')->nullable();
        $table->string('photo')->nullable();
        $table->decimal('first_prize')->nullable();
        $table->decimal('second_prize')->nullable();
        $table->decimal('third_prize')->nullable();
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->date('draw_date')->nullable();

        // 🔥 Updated Win Type Options
        $table->enum('win_type', [
            'daily',
            '7days',
            '15days',
            '1month',
            '3months',
            '6months',
            '1year'
        ])->default('daily');

        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotters');
    }
};
