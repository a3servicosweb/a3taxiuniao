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
        Schema::create('user_driver_licenses', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('license_number', 20)->unique(); // Número da habilitação
            $table->string('license_category', 5); // Categoria da habilitação (A, B, etc.)
            $table->date('issue_date'); // Data de emissão
            $table->date('expiration_date'); // Data de validade
            $table->date('first_license_date'); // Data da primeira habilitação
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_driver_licenses');
    }
};
