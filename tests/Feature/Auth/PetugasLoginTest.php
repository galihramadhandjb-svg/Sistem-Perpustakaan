<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetugasLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_petugas_can_log_in_and_reach_the_dashboard()
    {
        $this->seed(RoleSeeder::class);
        $petugas = User::factory()->create([
            'email' => 'petugas@example.test',
            'password' => bcrypt('password123'),
        ]);
        $petugas->assignRole('petugas');

        $this->post('/login', [
            'email' => 'petugas@example.test',
            'password' => 'password123',
        ])->assertRedirect('/cek-role');

        $this->get('/cek-role')->assertRedirect('/dashboard');
        $this->get('/dashboard')->assertOk();
    }
}
