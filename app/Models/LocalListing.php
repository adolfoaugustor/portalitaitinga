<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocalListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'category',
        'logo_path',
        'phone',
        'phone_whatsapp',
        'address',
        'neighborhood',
        'city',
        'sector',
        'services',
        'cnpj',
        'show_cnpj',
        'responsible',
        'contact_link',
        'description',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'show_cnpj' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
