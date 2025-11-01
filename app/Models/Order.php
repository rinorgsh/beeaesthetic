<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'amount',
        'stripe_payment_id',
        'status',
        'download_token',
        'download_count',
        'completed_at',
        'metadata',
        // ✅ Nouveaux champs
        'shipping_name',
        'shipping_address',
        'shipping_postal_code',
        'shipping_city',
        'shipping_country',
        'shipping_phone',
        'shipping_notes',
        'shipping_cost',
        'tracking_number',
        'shipped_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'completed_at' => 'datetime',
        'shipped_at' => 'datetime',
        'metadata' => 'array'
    ];
    public function hasPhysicalProducts()
{
    return $this->items()->whereHas('product', function($query) {
        $query->where('type', 'physical');
    })->exists();
}
public function hasDigitalProducts()
{
    return $this->items()->whereHas('product', function($query) {
        $query->where('type', 'digital');
    })->exists();
}

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'BEE-' . strtoupper(Str::random(10));
            }
            if (empty($order->download_token)) {
                $order->download_token = Str::random(64);
            }
        });
    }

    // ✅ Nouvelle relation
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Garde pour compatibilité (retourne le premier item)
    public function product()
    {
        return $this->hasOneThrough(
            Product::class,
            OrderItem::class,
            'order_id',
            'id',
            'id',
            'product_id'
        );
    }
}