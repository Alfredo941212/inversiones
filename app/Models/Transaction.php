<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'asset_id',
        'type',
        'quantity',
        'unit_price',
        'total',
        'operation_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:8',
            'unit_price' => 'decimal:2',
            'total' => 'decimal:2',
            'operation_date' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}