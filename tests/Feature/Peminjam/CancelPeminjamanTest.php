<?php

namespace Tests\Feature\Peminjam;

use App\Http\Livewire\Peminjam\Keranjang;
use App\Models\Buku;
use Database\Seeders\BukuSeeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\PenerbitSeeder;
use Database\Seeders\RakSeeder;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

class CancelPeminjamanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            KategoriSeeder::class,
            RakSeeder::class,
            PenerbitSeeder::class,
            BukuSeeder::class,
        ]);
    }

    public function test_borrower_can_cancel_a_pending_request()
    {
        $peminjam = User::factory()->create();
        $peminjaman = $this->createPeminjaman($peminjam, 1);
        $this->createDetail($peminjaman);

        $this->actingAs($peminjam);

        Livewire::test(Keranjang::class)
            ->call('batalkan', $peminjaman->id)
            ->assertRedirect('/');

        $this->assertDatabaseMissing('peminjaman', ['id' => $peminjaman->id]);
        $this->assertDatabaseMissing('detail_peminjaman', ['peminjaman_id' => $peminjaman->id]);
    }

    public function test_borrower_cannot_cancel_a_request_already_being_borrowed()
    {
        $peminjam = User::factory()->create();
        $peminjaman = $this->createPeminjaman($peminjam, 2);
        $this->createDetail($peminjaman);

        $this->actingAs($peminjam);

        Livewire::test(Keranjang::class)
            ->call('batalkan', $peminjaman->id);

        $this->assertDatabaseHas('peminjaman', ['id' => $peminjaman->id, 'status' => 2]);
        $this->assertDatabaseHas('detail_peminjaman', ['peminjaman_id' => $peminjaman->id]);
    }

    private function createPeminjaman(User $peminjam, int $status): Peminjaman
    {
        return Peminjaman::create([
            'kode_pinjam' => (string) random_int(100000000, 999999999),
            'peminjam_id' => $peminjam->id,
            'status' => $status,
            'tanggal_pinjam' => today(),
            'tanggal_kembali' => today()->addDays(10),
        ]);
    }

    private function createDetail(Peminjaman $peminjaman): void
    {
        DB::table('detail_peminjaman')->insert([
            'peminjaman_id' => $peminjaman->id,
            'buku_id' => Buku::query()->value('id'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
