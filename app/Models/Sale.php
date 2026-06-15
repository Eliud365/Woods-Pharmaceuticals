<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'receipt_number',
        'total_amount',
        'amount_paid',
        'change_given',
        'payment_method',
        'customer_name',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public static function generateReceiptNumber(): string
    {
        $last = self::latest()->first();
        $number = $last ? intval(substr($last->receipt_number, 4)) + 1 : 1;
        return 'RCP-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}