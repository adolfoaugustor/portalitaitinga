<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends SpatieRole
{
    /**
     * O Filament Shield exige que este relacionamento exista quando o Tenancy está ativo.
     * Como as tuas Roles são GLOBAIS, vamos retornar uma relação vazia 
     * para o sistema não dar erro de "Relationship not found".
     */
    public function company(): BelongsToMany
    {
        // Retornamos um relacionamento que nunca encontrará nada, 
        // mas que satisfaz o requisito técnico do Filament.
        return $this->belongsToMany(Company::class, 'company_user', 'user_id', 'company_id')->whereRaw('1 = 0');
    }
}