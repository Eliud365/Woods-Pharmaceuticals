<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'user_id',
        'reference_number',
        'total_amount',
        'status',
        'order_date',
        'expected_date',
        'received_date',
        'notes',
    ];

    protected $casts = [
        'order_date'    => 'date',
        'expected_date' => 'date',
        'received_date' => 'date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public static function generateReferenceNumber(): string
    {
        $last = self::latest()->first();
        $number = $last ? intval(substr($last->reference_number, 4)) + 1 : 1;
        return 'PO-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}