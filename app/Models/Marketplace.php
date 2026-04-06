<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Marketplace extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'nome',
        'slug',
        'descricao',
        'logo_path',
        'banner_path',
        'categoria',
        'whatsapp',
        'ativo',
    ];

    protected function casts(): array
    {
        return [
            'ativo' => 'boolean',
        ];
    }

    // Usuário proprietário
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Empresa (CNPJ) vinculada
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
