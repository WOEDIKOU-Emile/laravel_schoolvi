<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_redirected_to_dashboard_after_registration(): void
    {
        $response = $this->post('/register', [
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'email' => 'jean.dupont@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'jean.dupont@example.com', 'nom' => 'Dupont', 'prenom' => 'Jean']);
    }

    public function test_user_is_redirected_to_dashboard_after_login(): void
    {
        $user = User::factory()->create([
            'nom' => 'Martin',
            'prenom' => 'Claire',
            'email' => 'claire.martin@example.com',
            'password' => Hash::make('password123'),
            'isAdmin' => false,
        ]);

        $response = $this->followingRedirects()->post('/login', [
            'email' => 'claire.martin@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
        $response->assertSee('Bonjour, Claire');
        $this->assertAuthenticated();
    }

    public function test_admin_is_redirected_to_admin_dashboard_after_login(): void
    {
        $admin = User::factory()->create([
            'nom' => 'Admin',
            'prenom' => 'Super',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'isAdmin' => true,
        ]);

        $response = $this->followingRedirects()->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'admin123',
        ]);

        $response->assertStatus(200);
        $response->assertSee('Tableau de bord');
        $this->assertAuthenticated();
    }
}
