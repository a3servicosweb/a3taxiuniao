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
        Schema::create('user_comorbidities', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->string('name', 100)->unique(); // Nome da comorbidade (ex.: Diabetes, Hipertensão)
            $table->text('description')->nullable(); // Descrição opcional
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_comorbidities');
    }
};
