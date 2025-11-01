<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\File;

class UploadGalleryToCloudinary extends Command
{
    protected $signature = 'gallery:upload-cloudinary 
                            {--force : Forcer le re-upload des images existantes}
                            {--folder=gallery : Nom du dossier dans Cloudinary}';

    protected $description = 'Upload toutes les images de la galerie vers Cloudinary';

    public function handle()
    {
        $this->info('🚀 Upload de la galerie vers Cloudinary...');
        $this->newLine();
        
        // Récupérer les credentials
        $cloudName = config('cloudinary.cloud_name');
        $apiKey = config('cloudinary.api_key');
        $apiSecret = config('cloudinary.api_secret');
        
        // Créer l'instance Cloudinary
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $cloudName,
                'api_key' => $apiKey,
                'api_secret' => $apiSecret,
            ],
            'url' => [
                'secure' => true
            ]
        ]);
        
        $this->info('✅ Connecté à Cloudinary');
        $this->line("   Cloud Name: {$cloudName}");
        $this->newLine();
        
        // Récupérer les options
        $force = $this->option('force');
        $folder = $this->option('folder');
        
        // Récupérer toutes les images
        $imagesPath = public_path('Images');
        $images = glob($imagesPath . '/image*.jpeg');
        
        if (empty($images)) {
            $this->error('❌ Aucune image trouvée dans public/Images/');
            return 1;
        }
        
        $this->info("📦 " . count($images) . " images trouvées");
        $this->newLine();
        
        // Créer la barre de progression
        $bar = $this->output->createProgressBar(count($images));
        $bar->start();
        
        $uploaded = 0;
        $skipped = 0;
        $failed = 0;
        $uploadedUrls = [];
        
        foreach ($images as $imagePath) {
            try {
                $filename = basename($imagePath, '.jpeg');
                $publicId = "{$folder}/{$filename}";
                
                // Upload vers Cloudinary avec l'API directe
                $result = $cloudinary->uploadApi()->upload($imagePath, [
                    'folder' => $folder,
                    'public_id' => $filename,
                    'overwrite' => $force,
                    'resource_type' => 'image',
                ]);
                
                // Vérifier que le résultat est valide
                if (isset($result['secure_url'])) {
                    $uploadedUrls[$filename] = $result['secure_url'];
                    $uploaded++;
                } else {
                    $failed++;
                }
                
            } catch (\Exception $e) {
                // Si l'erreur est "Already exists" et pas --force, compter comme skipped
                if (strpos($e->getMessage(), 'already exists') !== false && !$force) {
                    $skipped++;
                } else {
                    $failed++;
                    if ($failed <= 3) { // Afficher seulement les 3 premières erreurs
                        $this->newLine();
                        $this->error("❌ {$filename}: " . $e->getMessage());
                    }
                }
            }
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine(2);
        
        // Afficher les statistiques
        $this->info('✅ Upload terminé !');
        $this->newLine();
        
        $this->table(
            ['Statistique', 'Valeur'],
            [
                ['Images totales', count($images)],
                ['Uploadées avec succès', $uploaded],
                ['Déjà présentes (skipped)', $skipped],
                ['Échecs', $failed],
            ]
        );
        
        // Sauvegarder les URLs dans un fichier JSON
        if (!empty($uploadedUrls)) {
            $jsonPath = storage_path('app/cloudinary-gallery.json');
            File::put($jsonPath, json_encode($uploadedUrls, JSON_PRETTY_PRINT));
            
            $this->newLine();
            $this->info("📝 URLs sauvegardées dans : {$jsonPath}");
        }
        
        // Instructions suivantes
        if ($uploaded > 0) {
            $this->newLine();
            $this->info('🎯 Prochaines étapes :');
            $this->line('  1. Vérifier les images : https://cloudinary.com/console/media_library/folders/gallery');
            $this->line('  2. Mettre à jour le composant Vue avec GallerieSection-CLOUDINARY.vue');
            $this->line('  3. Recompiler : npm run dev');
            $this->line('  4. Tester : http://localhost:8000/gallerie');
            
            // Exemple d'URL
            $firstUrl = array_values($uploadedUrls)[0];
            
            $this->newLine();
            $this->info('📸 Exemples d\'URLs Cloudinary :');
            $this->line("  Original : {$firstUrl}");
            $this->line("  Thumb 600px : https://res.cloudinary.com/{$cloudName}/image/upload/w_600,f_auto,q_auto/{$folder}/image00001");
            $this->line("  Carré 300px : https://res.cloudinary.com/{$cloudName}/image/upload/w_300,h_300,c_fill,g_auto,f_auto,q_auto/{$folder}/image00001");
        }
        
        return $uploaded > 0 ? 0 : 1;
    }
}