<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    protected $fillable = [
        'asset_type_id',
        'name',
        'symbol',
        'api_id',
        'current_price',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'current_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function assetType(): BelongsTo
    {
        return $this->belongsTo(AssetType::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}