<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CulturalEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'event_date',
        'neighborhood',
        'event_type',
        'pricing_type',
        'audience_type',
        'organizer_name',
        'location',
        'description',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_published' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
