<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Cloudinary\Cloudinary;

class TestCloudinary extends Command
{
    protected $signature = 'cloudinary:test';
    protected $description = 'Test direct de l\'API Cloudinary';

    public function handle()
    {
        $this->info('🧪 Test direct de l\'API Cloudinary...');
        $this->newLine();
        
        // Afficher la configuration
        $cloudName = config('cloudinary.cloud_name');
        $apiKey = config('cloudinary.api_key');
        $apiSecret = config('cloudinary.api_secret');
        
        $this->info('Configuration :');
        $this->line("  Cloud Name: {$cloudName}");
        $this->line("  API Key: " . substr($apiKey, 0, 4) . '***');
        $this->line("  API Secret: " . (strlen($apiSecret) > 0 ? 'Défini (' . strlen($apiSecret) . ' caractères)' : 'NON DÉFINI'));
        $this->newLine();
        
        // Créer une instance Cloudinary directement
        try {
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
            
            $this->info('✅ Instance Cloudinary créée');
            $this->newLine();
            
            // Test upload d'une image
            $testImage = public_path('Images/image00001.jpeg');
            
            if (!file_exists($testImage)) {
                $this->error('❌ Image de test non trouvée : ' . $testImage);
                return 1;
            }
            
            $this->info('📤 Upload de l\'image de test...');
            $this->line("  Fichier : {$testImage}");
            $this->line("  Taille : " . round(filesize($testImage) / 1024, 2) . ' KB');
            $this->newLine();
            
            // Upload avec l'API directe
            $result = $cloudinary->uploadApi()->upload($testImage, [
                'folder' => 'gallery',
                'public_id' => 'image00001_test',
                'overwrite' => true,
            ]);
            
            $this->info('✅ Upload réussi !');
            $this->newLine();
            
            $this->info('Résultat :');
            $this->line("  Public ID: " . ($result['public_id'] ?? 'N/A'));
            $this->line("  URL: " . ($result['secure_url'] ?? 'N/A'));
            $this->line("  Format: " . ($result['format'] ?? 'N/A'));
            $this->line("  Width: " . ($result['width'] ?? 'N/A'));
            $this->line("  Height: " . ($result['height'] ?? 'N/A'));
            $this->line("  Size: " . round(($result['bytes'] ?? 0) / 1024, 2) . ' KB');
            $this->newLine();
            
            // Nettoyer l'image de test
            $this->info('🧹 Suppression de l\'image de test...');
            try {
                $cloudinary->uploadApi()->destroy('gallery/image00001_test');
                $this->info('✅ Nettoyé');
            } catch (\Exception $e) {
                $this->warn('⚠️  Impossible de supprimer l\'image de test (ce n\'est pas grave)');
            }
            
            $this->newLine();
            $this->info('🎉 TOUT FONCTIONNE !');
            $this->newLine();
            $this->info('Vous pouvez maintenant uploader toutes les images :');
            $this->line('  php artisan gallery:upload-cloudinary');
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error('❌ ERREUR :');
            $this->line($e->getMessage());
            $this->newLine();
            
            // Diagnostic détaillé
            $this->warn('📋 Diagnostic :');
            
            if (strpos($e->getMessage(), 'Invalid') !== false) {
                $this->line('  → Vos credentials sont incorrects');
                $this->line('  → Vérifiez sur https://cloudinary.com/console');
            } elseif (strpos($e->getMessage(), 'Unauthorized') !== false) {
                $this->line('  → API Key ou Secret incorrect');
            } elseif (strpos($e->getMessage(), 'connect') !== false) {
                $this->line('  → Problème de connexion internet');
            } else {
                $this->line('  → Erreur inconnue');
                $this->line('  → Message complet : ' . $e->getMessage());
            }
            
            return 1;
        }
    }
}