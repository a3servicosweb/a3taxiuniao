<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_social_security_numbers', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete(); // Chave estrangeira para a tabela de usuários
            $table->string('pis_pasep', 15)->nullable()->unique(); // PIS/PASEP opcional e único
            $table->string('nit', 15)->nullable()->unique(); // NIT opcional e único
            $table->string('nis', 15)->nullable()->unique(); // NIS opcional e único
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public
    function down(): void
    {
        Schema::dropIfExists('user_social_security_numbers');
    }
};
