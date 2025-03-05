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
        Schema::create('user_military_reserve_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('reserve_card_number')->unique()->nullable();
            $table->string('series_number')->nullable();
            $table->date('issue_date')->nullable();
            $table->timestamps();
        });
    }

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
        ];
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_military_reserve_cards');
    }
};
