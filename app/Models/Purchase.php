<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'amount',
        'download_count',
        'max_downloads',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Vérifier si le client peut encore télécharger
     */
    public function canDownload(): bool
    {
        // Vérifier la limite de téléchargements
        if ($this->download_count >= $this->max_downloads) {
            return false;
        }

        // Vérifier l'expiration (si définie)
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Incrémenter le compteur de téléchargements
     */
    public function incrementDownloadCount(): void
    {
        $this->increment('download_count');
    }

    /**
     * Nombre de téléchargements restants
     */
    public function downloadsRemaining(): int
    {
        return max(0, $this->max_downloads - $this->download_count);
    }
}