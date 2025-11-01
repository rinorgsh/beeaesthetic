<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'download_token',
        'download_count',
        'token_expires_at'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'token_expires_at' => 'datetime',

    ];
    protected $appends = [];

    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($orderItem) {
            // Génère un token unique pour chaque item
            if (empty($orderItem->download_token)) {
                $orderItem->download_token = Str::random(64);
            }
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}