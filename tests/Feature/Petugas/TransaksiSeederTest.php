<?php

namespace Tests\Feature\Petugas;

use App\Http\Livewire\Petugas\Transaksi;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Database\Seeders\BukuSeeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\PenerbitSeeder;
use Database\Seeders\RakSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\TransaksiSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TransaksiSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_transactions_cover_all_status_filters_and_seed_idempotently()
    {
        $this->seed([
            RoleSeeder::class,
            UserSeeder::class,
            KategoriSeeder::class,
            RakSeeder::class,
            PenerbitSeeder::class,
            BukuSeeder::class,
        ]);

        $this->seed(TransaksiSeeder::class);
        $this->seed(TransaksiSeeder::class);

        $this->assertSame(3, Peminjaman::where('kode_pinjam', 'like', 'DEMO-%')->count());
        $this->assertSame(1, Peminjaman::where('kode_pinjam', 'DEMO-PENDING-001')->where('status', 1)->count());
        $this->assertSame(1, Peminjaman::where('kode_pinjam', 'DEMO-ACTIVE-001')->where('status', 2)->count());
        $this->assertSame(1, Peminjaman::where('kode_pinjam', 'DEMO-RETURNED-001')->where('status', 3)->count());
        $this->assertSame(9, Buku::where('slug', 'gusdur')->value('stok'));

        $petugas = User::role('petugas')->firstOrFail();
        Livewire::actingAs($petugas)
            ->test(Transaksi::class)
            ->assertSee('DEMO-PENDING-001')
            ->assertSee('DEMO-ACTIVE-001')
            ->assertSee('DEMO-RETURNED-001')
            ->call('belumDipinjam')
            ->assertSee('DEMO-PENDING-001')
            ->assertDontSee('DEMO-ACTIVE-001')
            ->call('sedangDipinjam')
            ->assertSee('DEMO-ACTIVE-001')
            ->assertDontSee('DEMO-PENDING-001')
            ->call('selesaiDipinjam')
            ->assertSee('DEMO-RETURNED-001')
            ->assertDontSee('DEMO-ACTIVE-001');
    }
}
