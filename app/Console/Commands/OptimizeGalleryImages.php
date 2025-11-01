<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImageOptimizationService;

class OptimizeGalleryImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gallery:optimize {--clean : Nettoyer les images optimisées existantes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimise les images de la galerie (thumbnails + WebP)';

    /**
     * Execute the console command.
     */
    public function handle(ImageOptimizationService $service)
    {
        // Si l'option --clean est utilisée
        if ($this->option('clean')) {
            $this->info('🧹 Nettoyage des images optimisées...');
            $service->cleanOptimizedImages();
            $this->info('✅ Nettoyage terminé !');
            return 0;
        }
        
        $this->info('🚀 Optimisation des images de la galerie...');
        $this->newLine();
        
        // Vérifier que la librairie GD est disponible
        if (!extension_loaded('gd')) {
            $this->error('❌ Erreur : La librairie GD n\'est pas installée !');
            $this->info('Installez-la avec : sudo apt-get install php-gd');
            return 1;
        }
        
        // Vérifier que GD supporte WebP
        if (!function_exists('imagewebp')) {
            $this->warn('⚠️  Attention : GD ne supporte pas le format WebP');
            $this->warn('Seuls les thumbnails JPEG seront créés');
        }
        
        // Créer une barre de progression
        $bar = $this->output->createProgressBar();
        $bar->start();
        
        try {
            $result = $service->optimizeGalleryImages();
            $bar->finish();
            
            $this->newLine(2);
            $this->info('✅ Optimisation terminée !');
            $this->newLine();
            
            // Afficher les statistiques
            $this->table(
                ['Statistique', 'Valeur'],
                [
                    ['Images totales', $result['total']],
                    ['Images optimisées', $result['optimized']],
                    ['Échecs', $result['failed']],
                ]
            );
            
            // Conseils
            $this->newLine();
            $this->info('📁 Fichiers générés dans :');
            $this->line('  • public/Images/thumbnails/ (thumbnails JPEG et WebP)');
            $this->line('  • public/Images/*.webp (versions WebP originales)');
            
            $this->newLine();
            $this->info('🔧 Prochaines étapes :');
            $this->line('  1. Mettez à jour le composant GallerieSection.vue');
            $this->line('  2. Testez le chargement de la galerie');
            $this->line('  3. Comparez les performances (F12 > Network)');
            
            return 0;
            
        } catch (\Exception $e) {
            $bar->finish();
            $this->newLine(2);
            $this->error('❌ Erreur lors de l\'optimisation : ' . $e->getMessage());
            return 1;
        }
    }
}