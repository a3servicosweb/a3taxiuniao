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
        Schema::create('mandatory_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome do documento (ex.: "Certidão de Antecedentes Criminais")
            $table->string('description')->nullable(); // Descrição do documento
            $table->boolean('is_mandatory')->default(true); // Indica se é obrigatório
            $table->boolean('requires_file')->default(true); // Indica se precisa de upload de arquivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mandatory_documents');
    }
};
