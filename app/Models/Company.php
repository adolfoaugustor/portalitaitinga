<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'telefone',
        'whatsapp',
        'email',
        'website',
    ];

    // Usuário responsável (quem cadastrou o CNPJ)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Cardápio/vitrine vinculada a esta empresa
    public function marketplace(): HasOne
    {
        return $this->hasOne(Marketplace::class);
    }
}
