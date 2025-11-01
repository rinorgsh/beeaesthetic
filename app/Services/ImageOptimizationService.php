<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class ImageOptimizationService
{
    /**
     * Optimise toutes les images de la galerie
     * Crée des thumbnails et des versions WebP
     */
    public function optimizeGalleryImages()
    {
        $imagesPath = public_path('Images');
        $images = glob($imagesPath . '/image*.jpeg');
        
        // Créer le dossier thumbnails s'il n'existe pas
        $thumbnailsPath = $imagesPath . '/thumbnails';
        if (!file_exists($thumbnailsPath)) {
            mkdir($thumbnailsPath, 0755, true);
        }
        
        $optimized = 0;
        $total = count($images);
        
        foreach ($images as $imagePath) {
            try {
                $filename = basename($imagePath);
                
                // 1. Créer thumbnail JPEG (400x400)
                $this->createThumbnail(
                    $imagePath, 
                    400, 
                    "thumbnails/thumb_{$filename}", 
                    'jpeg'
                );
                
                // ✅ Forcer le garbage collector après chaque thumbnail
                gc_collect_cycles();
                
                // 2. Créer version WebP originale (redimensionnée max 1920px)
                $this->convertToWebP(
                    $imagePath, 
                    str_replace('.jpeg', '.webp', $filename)
                );
                
                // ✅ Forcer le garbage collector
                gc_collect_cycles();
                
                // 3. Créer thumbnail WebP (400x400)
                $this->createThumbnail(
                    $imagePath, 
                    400, 
                    "thumbnails/thumb_" . str_replace('.jpeg', '.webp', $filename),
                    'webp'
                );
                
                // ✅ Forcer le garbage collector
                gc_collect_cycles();
                
                $optimized++;
                
            } catch (\Exception $e) {
                // Log l'erreur mais continue
                \Log::error("Erreur optimisation image {$filename}: " . $e->getMessage());
            }
        }
        
        return [
            'total' => $total,
            'optimized' => $optimized,
            'failed' => $total - $optimized
        ];
    }
    
    /**
     * Crée une miniature d'une image
     *
     * @param string $sourcePath Chemin de l'image source
     * @param int $size Taille de la miniature (largeur/hauteur)
     * @param string $destination Chemin relatif de destination
     * @param string $format Format de sortie ('jpeg' ou 'webp')
     */
    private function createThumbnail($sourcePath, $size, $destination, $format = 'jpeg')
    {
        // Vérifier que la librairie GD est disponible
        if (!extension_loaded('gd')) {
            throw new \Exception('La librairie GD n\'est pas installée');
        }
        
        // Charger l'image source
        $img = imagecreatefromjpeg($sourcePath);
        
        if (!$img) {
            throw new \Exception("Impossible de charger l'image : {$sourcePath}");
        }
        
        // Obtenir les dimensions originales
        $originalWidth = imagesx($img);
        $originalHeight = imagesy($img);
        
        // Calculer les nouvelles dimensions en conservant le ratio
        if ($originalWidth > $originalHeight) {
            $newWidth = $size;
            $newHeight = intval(($originalHeight / $originalWidth) * $size);
        } else {
            $newHeight = $size;
            $newWidth = intval(($originalWidth / $originalHeight) * $size);
        }
        
        // Créer la miniature
        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        
        // Conserver la transparence pour WebP
        if ($format === 'webp') {
            imagealphablending($thumb, false);
            imagesavealpha($thumb, true);
        }
        
        // Redimensionner avec une haute qualité
        imagecopyresampled(
            $thumb, $img,
            0, 0, 0, 0,
            $newWidth, $newHeight,
            $originalWidth, $originalHeight
        );
        
        // Construire le chemin de destination complet
        $destPath = public_path("Images/{$destination}");
        $destDir = dirname($destPath);
        
        // Créer le répertoire si nécessaire
        if (!file_exists($destDir)) {
            mkdir($destDir, 0755, true);
        }
        
        // Sauvegarder selon le format
        if ($format === 'webp') {
            imagewebp($thumb, $destPath, 80); // Qualité 80%
        } else {
            imagejpeg($thumb, $destPath, 85); // Qualité 85%
        }
        
        // Libérer la mémoire
        imagedestroy($img);
        imagedestroy($thumb);
        
        return $destPath;
    }
    
    /**
     * Convertit une image JPEG en WebP
     * OPTIMISÉ : Redimensionne d'abord si l'image est trop grande
     *
     * @param string $sourcePath Chemin de l'image source
     * @param string $destination Nom du fichier de destination
     */
    private function convertToWebP($sourcePath, $destination)
    {
        // Vérifier que la librairie GD supporte WebP
        if (!function_exists('imagewebp')) {
            throw new \Exception('La librairie GD ne supporte pas le format WebP');
        }
        
        // Charger l'image source
        $img = imagecreatefromjpeg($sourcePath);
        
        if (!$img) {
            throw new \Exception("Impossible de charger l'image : {$sourcePath}");
        }
        
        // Obtenir les dimensions
        $width = imagesx($img);
        $height = imagesy($img);
        
        // ✅ OPTIMISATION : Redimensionner si trop grande (max 1920px)
        $maxSize = 1920;
        if ($width > $maxSize || $height > $maxSize) {
            if ($width > $height) {
                $newWidth = $maxSize;
                $newHeight = intval(($height / $width) * $maxSize);
            } else {
                $newHeight = $maxSize;
                $newWidth = intval(($width / $height) * $maxSize);
            }
            
            // Créer l'image redimensionnée
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resized, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            
            // Libérer l'originale et utiliser la redimensionnée
            imagedestroy($img);
            $img = $resized;
        }
        
        // Construire le chemin de destination
        $destPath = public_path("Images/{$destination}");
        
        // Conserver la transparence
        imagealphablending($img, false);
        imagesavealpha($img, true);
        
        // Convertir en WebP avec qualité 80%
        imagewebp($img, $destPath, 80);
        
        // Libérer la mémoire
        imagedestroy($img);
        
        // Forcer le garbage collector
        gc_collect_cycles();
        
        return $destPath;
    }
    
    /**
     * Nettoie les thumbnails et fichiers WebP générés
     */
    public function cleanOptimizedImages()
    {
        $thumbnailsPath = public_path('Images/thumbnails');
        $imagesPath = public_path('Images');
        
        // Supprimer tous les thumbnails
        if (file_exists($thumbnailsPath)) {
            File::deleteDirectory($thumbnailsPath);
        }
        
        // Supprimer tous les fichiers WebP
        $webpFiles = glob($imagesPath . '/*.webp');
        foreach ($webpFiles as $file) {
            unlink($file);
        }
        
        return true;
    }
}