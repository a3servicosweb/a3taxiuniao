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
        Schema::create('user_vaccine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Chave estrangeira para usuário
            $table->foreignId('vaccine_id')->constrained('vaccines')->onDelete('cascade'); // Chave estrangeira para vacina
            $table->string('dose')->nullable(); // Ex.: "Primeira Dose", "Segunda Dose", etc.
            $table->date('vaccination_date'); // Data em que a vacina foi aplicada
            $table->date('next_dose_due')->nullable(); // Data prevista para a próxima dose
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_vaccine');
    }
};
