<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table): void {
            $table->id();

            // Usuário que cadastrou o CNPJ e é responsável pela empresa
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('cnpj', 18)->unique();
            $table->string('razao_social')->nullable();
            $table->string('nome_fantasia')->nullable();

            // Endereço
            $table->string('endereco')->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable()->default('Itaitinga');
            $table->string('estado', 2)->nullable()->default('CE');
            $table->string('cep', 10)->nullable();

            // Contato
            $table->string('telefone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            $table->timestamps(); // created_at = data/hora do cadastro, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
