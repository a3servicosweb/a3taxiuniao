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
        Schema::create('driver_licenses', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('license_number', 20)->nullable()->unique(); // Número da habilitação
            $table->string('license_category', 5)->nullable(); // Categoria da habilitação (A, B, etc.)
            $table->date('issue_date')->nullable(); // Data de emissão
            $table->date('expiration_date')->nullable(); // Data de validade
            $table->date('first_license_date')->nullable(); // Data da primeira habilitação
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_licenses');
    }
};
