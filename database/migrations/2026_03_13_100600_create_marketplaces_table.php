<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marketplaces', function (Blueprint $table): void {
            $table->id();

            // Usuário proprietário do cardápio/marketplace
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Empresa vinculada (obrigatória — marketplace só existe para empresas com CNPJ)
            $table->foreignId('company_id')
                ->constrained('companies')
                ->onDelete('cascade');

            // Dados do cardápio/vitrine virtual
            $table->string('nome')->nullable();           // Nome da loja/cardápio
            $table->string('slug')->unique()->nullable();  // URL amigável
            $table->text('descricao')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('banner_path')->nullable();
            $table->string('categoria')->nullable();       // Ex: restaurante, moda, eletrônicos
            $table->string('whatsapp', 20)->nullable();
            $table->boolean('ativo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marketplaces');
    }
};
