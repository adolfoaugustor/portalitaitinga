<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'organization_type',
        'is_super_admin',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_super_admin' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function culturalEvents(): HasMany
    {
        return $this->hasMany(CulturalEvent::class);
    }

    public function localListings(): HasMany
    {
        return $this->hasMany(LocalListing::class);
    }

    public function localListing(): HasOne
    {
        return $this->hasOne(LocalListing::class);
    }

    public function jobVacancies(): HasMany
    {
        return $this->hasMany(JobVacancy::class);
    }

    public function classifiedItems(): HasMany
    {
        return $this->hasMany(ClassifiedItem::class);
    }

    // Empresa vinculada ao usuário via CNPJ
    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    // Cardápio/vitrine do marketplace (disponível após cadastro de CNPJ)
    public function marketplace(): HasOne
    {
        return $this->hasOne(Marketplace::class);
    }

    public function isCompany(): bool
    {
        return $this->company()->exists();
    }

    public function organizationName(): string
    {
        return match ($this->organization_type) {
            'company' => 'Empresa',
            'informal_seller' => 'Vendedor Informal',
            'service_provider' => 'Prestador de Servico',
            default => 'Organizacao',
        };
    }
}
