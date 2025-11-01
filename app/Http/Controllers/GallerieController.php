<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

/**
 * OPTIONNEL : Contrôleur pour gérer la galerie dynamiquement
 * 
 * ⚠️ ATTENTION : Cela n'accélérera PAS le chargement des images !
 * Le vrai gain est dans l'optimisation des images (thumbnails + WebP)
 * 
 * Avantages de passer par le contrôleur :
 * ✅ Gestion dynamique (ajout/suppression sans toucher au code)
 * ✅ Métadonnées (titre, description, catégories, tags)
 * ✅ Ordre personnalisé / Tri / Filtrage
 * ✅ Base de données (si vous voulez stocker des infos)
 * 
 * Inconvénients :
 * ❌ Plus complexe
 * ❌ Ne change RIEN à la vitesse de téléchargement des images
 */
class GallerieController extends Controller
{
    /**
     * Affiche la page de la galerie
     * Méthode 1 : Lecture directe du dossier
     */
    public function index()
    {
        $images = $this->getGalleryImagesFromFolder();
        
        return Inertia::render('Gallerie', [
            'images' => $images
        ]);
    }
    
    /**
     * Récupère les images depuis le dossier public/Images
     * SIMPLE et EFFICACE pour des galeries statiques
     */
    private function getGalleryImagesFromFolder()
    {
        $images = [];
        
        // Récupérer tous les fichiers image*.jpeg
        $files = glob(public_path('Images/image*.jpeg'));
        
        // Trier par nom de fichier
        sort($files);
        
        foreach ($files as $file) {
            $filename = basename($file);
            
            // Extraire le numéro de l'image
            preg_match('/image(\d+)\.jpeg/', $filename, $matches);
            $number = isset($matches[1]) ? intval($matches[1]) : 0;
            
            $images[] = [
                'id' => $number,
                'src' => "/Images/{$filename}",
                'thumbnail' => "/Images/thumbnails/thumb_{$filename}",
                'webp' => "/Images/" . str_replace('.jpeg', '.webp', $filename),
                'webp_thumbnail' => "/Images/thumbnails/thumb_" . str_replace('.jpeg', '.webp', $filename),
                'alt' => "Image {$number}",
                'title' => "Image {$number}",
                'filename' => $filename,
            ];
        }
        
        return $images;
    }
    
    /**
     * Méthode alternative : Avec métadonnées stockées
     * UTILE si vous voulez ajouter des titres, descriptions, etc.
     */
    private function getGalleryImagesWithMetadata()
    {
        // Vous pourriez stocker ces infos dans une base de données
        // ou dans un fichier JSON
        
        $metadata = [
            1 => ['title' => 'French Manucure', 'category' => 'classique'],
            2 => ['title' => 'Nail Art Floral', 'category' => 'artistique'],
            3 => ['title' => 'Ongles en Gel', 'category' => 'gel'],
            // ... etc
        ];
        
        $images = [];
        $files = glob(public_path('Images/image*.jpeg'));
        sort($files);
        
        foreach ($files as $file) {
            $filename = basename($file);
            preg_match('/image(\d+)\.jpeg/', $filename, $matches);
            $number = isset($matches[1]) ? intval($matches[1]) : 0;
            
            $images[] = [
                'id' => $number,
                'src' => "/Images/{$filename}",
                'thumbnail' => "/Images/thumbnails/thumb_{$filename}",
                'webp' => "/Images/" . str_replace('.jpeg', '.webp', $filename),
                'webp_thumbnail' => "/Images/thumbnails/thumb_" . str_replace('.jpeg', '.webp', $filename),
                'alt' => $metadata[$number]['title'] ?? "Image {$number}",
                'title' => $metadata[$number]['title'] ?? "Image {$number}",
                'category' => $metadata[$number]['category'] ?? 'general',
                'filename' => $filename,
            ];
        }
        
        return $images;
    }
    
    /**
     * Méthode avancée : Filtrage et pagination côté serveur
     * UTILE pour de TRÈS grandes galeries (100+ images)
     */
    public function indexWithPagination(Request $request)
    {
        $perPage = $request->input('per_page', 8);
        $page = $request->input('page', 1);
        $category = $request->input('category', null);
        
        // Récupérer toutes les images
        $allImages = $this->getGalleryImagesWithMetadata();
        
        // Filtrer par catégorie si demandé
        if ($category) {
            $allImages = array_filter($allImages, function($image) use ($category) {
                return $image['category'] === $category;
            });
        }
        
        // Calculer la pagination
        $total = count($allImages);
        $offset = ($page - 1) * $perPage;
        $images = array_slice($allImages, $offset, $perPage);
        
        return Inertia::render('Gallerie', [
            'images' => array_values($images), // Réindexer
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'last_page' => ceil($total / $perPage),
                'has_more' => ($page * $perPage) < $total,
            ]
        ]);
    }
}