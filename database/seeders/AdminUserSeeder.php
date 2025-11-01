<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifier si l'admin existe déjà
        $adminExists = User::where('email', 'admin@beeaesthetic.com')->exists();

        if (!$adminExists) {
            User::create([
                'name' => 'Admin Bee Aesthetic',
                'email' => 'admin@beeaesthetic.com',
                'password' => Hash::make('BeeAdmin2024!'), // 🔐 Changez ce mot de passe !
                'email_verified_at' => now(),
            ]);

            $this->command->info('✅ Compte admin créé avec succès !');
            $this->command->info('📧 Email: admin@beeaesthetic.com');
            $this->command->info('🔑 Mot de passe: BeeAdmin2024!');
        } else {
            $this->command->warn('⚠️  Un compte admin existe déjà.');
        }
    }
}