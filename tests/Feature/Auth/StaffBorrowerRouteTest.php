<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StaffBorrowerRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_petugas_visiting_the_borrower_cart_is_redirected_to_dashboard()
    {
        $this->seed(RoleSeeder::class);
        $petugas = User::factory()->create();
        $petugas->assignRole('petugas');

        $this->actingAs($petugas)
            ->get('/keranjang')
            ->assertRedirect('/dashboard');
    }

    public function test_borrower_can_open_the_cart_route()
    {
        $this->seed(RoleSeeder::class);
        $peminjam = User::factory()->create();
        $peminjam->assignRole('peminjam');

        $this->actingAs($peminjam)
            ->get('/keranjang')
            ->assertOk();
    }
}
