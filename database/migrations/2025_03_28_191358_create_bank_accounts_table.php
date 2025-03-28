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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('bank_name')->nullable(); // Nome do banco
            $table->string('agency_number')->nullable(); // Número da agência
            $table->string('account_number')->nullable(); // Número da conta
            $table->enum('account_type', ['Corrente', 'Poupança'])->nullable(); // Tipo da conta (ex: corrente, poupança)
            $table->string('pix')->nullable(); // Chave PIX
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
