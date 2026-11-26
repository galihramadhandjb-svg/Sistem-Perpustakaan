<?php

namespace Tests\Feature\Petugas;

use App\Http\Livewire\Petugas\Chart;
use App\Http\Livewire\Petugas\Transaksi;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Database\Seeders\BukuSeeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\PenerbitSeeder;
use Database\Seeders\RakSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

class TransaksiTest extends TestCase
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

    public function test_tc09_petugas_processes_a_loan_and_reduces_stock_once()
    {
        $petugas = User::factory()->create();
        $buku = Buku::query()->firstOrFail();
        $peminjaman = $this->createPeminjaman($petugas, 1, today()->addDays(10)->toDateString());
        $this->addBookToLoan($peminjaman, $buku);
        $stokAwal = $buku->stok;

        Livewire::actingAs($petugas)
            ->test(Transaksi::class)
            ->call('pinjam', $peminjaman->id)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('peminjaman', [
            'id' => $peminjaman->id,
            'status' => 2,
            'petugas_pinjam' => $petugas->id,
        ]);
        $this->assertSame($stokAwal - 1, $buku->fresh()->stok);

        Livewire::actingAs($petugas)
            ->test(Transaksi::class)
            ->call('pinjam', $peminjaman->id);

        $this->assertSame($stokAwal - 1, $buku->fresh()->stok);
    }

    public function test_tc09_processing_is_rejected_when_stock_is_unavailable()
    {
        $petugas = User::factory()->create();
        $buku = Buku::query()->firstOrFail();
        $buku->update(['stok' => 0]);
        $peminjaman = $this->createPeminjaman($petugas, 1, today()->addDays(10)->toDateString());
        $this->addBookToLoan($peminjaman, $buku);

        Livewire::actingAs($petugas)
            ->test(Transaksi::class)
            ->call('pinjam', $peminjaman->id);

        $this->assertDatabaseHas('peminjaman', [
            'id' => $peminjaman->id,
            'status' => 1,
        ]);
        $this->assertSame(0, $buku->fresh()->stok);
    }

    public function test_tc09_processing_rejects_duplicate_book_lines_that_exceed_stock()
    {
        $petugas = User::factory()->create();
        $buku = Buku::query()->firstOrFail();
        $buku->update(['stok' => 1]);
        $peminjaman = $this->createPeminjaman($petugas, 1, today()->addDays(10)->toDateString());
        $this->addBookToLoan($peminjaman, $buku);
        $this->addBookToLoan($peminjaman, $buku);

        Livewire::actingAs($petugas)
            ->test(Transaksi::class)
            ->call('pinjam', $peminjaman->id);

        $this->assertDatabaseHas('peminjaman', [
            'id' => $peminjaman->id,
            'status' => 1,
        ]);
        $this->assertSame(1, $buku->fresh()->stok);
    }

    public function test_tc10_returning_on_time_restores_stock_and_sets_zero_fine()
    {
        $petugas = User::factory()->create();
        $buku = Buku::query()->firstOrFail();
        $stokAwal = $buku->stok;
        $peminjaman = $this->createPeminjaman($petugas, 2, today()->toDateString());
        $this->addBookToLoan($peminjaman, $buku);

        Livewire::actingAs($petugas)
            ->test(Transaksi::class)
            ->call('kembali', $peminjaman->id)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('peminjaman', [
            'id' => $peminjaman->id,
            'status' => 3,
            'tanggal_pengembalian' => today()->toDateString(),
            'denda' => 0,
            'petugas_kembali' => $petugas->id,
        ]);
        $this->assertSame($stokAwal + 1, $buku->fresh()->stok);
    }

    public function test_tc11_monthly_chart_emits_daily_return_counts_for_selected_month()
    {
        $peminjam = User::factory()->create();
        $this->createPeminjaman($peminjam, 3, '2026-03-01', '2026-03-10');
        $this->createPeminjaman($peminjam, 3, '2026-03-01', '2026-03-10');
        $this->createPeminjaman($peminjam, 3, '2026-03-01', '2026-03-20');
        $this->createPeminjaman($peminjam, 3, '2026-04-01', '2026-04-10');

        $expectedCounts = array_fill(0, 31, 0);
        $expectedCounts[9] = 2;
        $expectedCounts[19] = 1;

        Livewire::test(Chart::class)
            ->set('bulan_tahun', '2026-03')
            ->assertEmitted('ubahBulanTahun', $expectedCounts, range(1, 31));
    }

    private function createPeminjaman(User $peminjam, int $status, string $tanggalKembali, ?string $tanggalPengembalian = null): Peminjaman
    {
        return Peminjaman::create([
            'kode_pinjam' => (string) random_int(100000000, 999999999),
            'peminjam_id' => $peminjam->id,
            'status' => $status,
            'tanggal_pinjam' => today()->toDateString(),
            'tanggal_kembali' => $tanggalKembali,
            'tanggal_pengembalian' => $tanggalPengembalian,
        ]);
    }

    private function addBookToLoan(Peminjaman $peminjaman, Buku $buku): void
    {
        DB::table('detail_peminjaman')->insert([
            'peminjaman_id' => $peminjaman->id,
            'buku_id' => $buku->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
