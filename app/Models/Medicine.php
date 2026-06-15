<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'generic_name',
        'category',
        'supplier',
        'quantity',
        'reorder_level',
        'buying_price',
        'selling_price',
        'expiry_date',
        'batch_number',
        'description',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function isLowStock(): bool
    {
        return $this->quantity <= $this->reorder_level;
    }

    public function isExpired(): bool
    {
        return $this->expiry_date->isPast();
    }

    public function isExpiringSoon(): bool
    {
        return $this->expiry_date->diffInDays(now()) <= 30 && !$this->isExpired();
    }
}