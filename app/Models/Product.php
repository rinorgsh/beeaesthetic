<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'image',
        'file_path',
        'type',
        'is_active',
        'stock'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    protected $appends = ['image_url', 'formatted_price'];

    /**
     * URL publique de l'image (depuis storage local)
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // ✅ URL locale au lieu de S3
        return asset('storage/' . $this->image);
    }

    /**
     * Prix formaté
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2, ',', ' ') . ' €';
    }

    /**
     * Vérifier si le fichier existe sur S3
     */
    public function hasDownloadableFile(): bool
    {
        return $this->file_path && Storage::disk('s3')->exists($this->file_path);
    }

    /**
     * Relations
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}