<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DownloadController extends Controller
{
    /**
     * Générer un lien de téléchargement temporaire sécurisé
     */
    public function download(Request $request, Product $product)
    {
        $user = auth()->user();

        // ✅ 1. Vérifier l'authentification
        if (!$user) {
            return response()->json([
                'error' => 'Vous devez être connecté pour télécharger ce produit.'
            ], 401);
        }

        // ✅ 2. Vérifier que l'utilisateur a acheté le produit
        $purchase = Purchase::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if (!$purchase) {
            return response()->json([
                'error' => 'Vous devez acheter ce produit pour le télécharger.'
            ], 403);
        }

        // ✅ 3. Vérifier les droits de téléchargement
        if (!$purchase->canDownload()) {
            $reason = $purchase->download_count >= $purchase->max_downloads
                ? 'Vous avez atteint la limite de téléchargements pour ce produit.'
                : 'Votre accès à ce produit a expiré.';

            return response()->json([
                'error' => $reason
            ], 403);
        }

        // ✅ 4. Vérifier que le fichier existe
        if (!$product->hasDownloadableFile()) {
            return response()->json([
                'error' => 'Ce produit n\'a pas de fichier téléchargeable.'
            ], 404);
        }

        // ✅ 5. Générer l'URL temporaire (valide 1 heure par défaut)
        $expirationMinutes = config('filesystems.download_expiration', 60);
        
        try {
            $temporaryUrl = Storage::disk('s3')->temporaryUrl(
                $product->file_path,
                now()->addMinutes($expirationMinutes)
            );
        } catch (\Exception $e) {
            Log::error('Failed to generate download URL', [
                'product_id' => $product->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'error' => 'Impossible de générer le lien de téléchargement.'
            ], 500);
        }

        // ✅ 6. Incrémenter le compteur de téléchargements
        $purchase->incrementDownloadCount();

        // ✅ 7. Logger l'activité
        Log::info('Product downloaded', [
            'user_id' => $user->id,
            'user_email' => $user->email,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'download_count' => $purchase->download_count,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        // ✅ 8. Retourner l'URL temporaire
        return response()->json([
            'success' => true,
            'download_url' => $temporaryUrl,
            'expires_at' => now()->addMinutes($expirationMinutes)->toIso8601String(),
            'downloads_remaining' => $purchase->downloadsRemaining(),
            'product_name' => $product->name,
            'message' => 'Lien de téléchargement généré avec succès. Il expire dans ' . $expirationMinutes . ' minutes.'
        ]);
    }
}