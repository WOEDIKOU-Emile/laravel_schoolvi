<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'nom' => 'Test',
            'prenom' => 'User',
            'email' => 'test@example.com',
        ]);

        // Matières
        \App\Models\Matiere::insert([
            ['nomMatiere' => 'Mathématiques'],
            ['nomMatiere' => 'Physique'],
            ['nomMatiere' => 'Histoire'],
            ['nomMatiere' => 'Français'],
        ]);

        // Niveaux
        \App\Models\Niveau::insert([
            ['nomNiveau' => 'Sixième'],
            ['nomNiveau' => 'Troisième'],
            ['nomNiveau' => 'Seconde'],
            ['nomNiveau' => 'Terminale'],
        ]);

        // Admin de test
        \App\Models\User::create([
            'nom'        => 'Admin',
            'prenom'     => 'Super',
            'email'      => 'admin@docmanager.com',
            'password'   => \Illuminate\Support\Facades\Hash::make('admin123'),
            'isAdmin'    => true,
        ]);
    }
}
