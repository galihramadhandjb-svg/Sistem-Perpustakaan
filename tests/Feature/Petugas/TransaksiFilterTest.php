<?php

namespace Tests\Feature\Petugas;

use App\Http\Livewire\Petugas\Transaksi;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TransaksiFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_status_filter_buttons_show_only_matching_transactions()
    {
        $petugas = User::factory()->create();
        $this->createTransaction($petugas, 1, 'PENDING-001');
        $this->createTransaction($petugas, 2, 'BORROWED-001');
        $this->createTransaction($petugas, 3, 'RETURNED-001');

        Livewire::actingAs($petugas)
            ->test(Transaksi::class)
            ->assertSee('PENDING-001')
            ->assertSee('BORROWED-001')
            ->assertSee('RETURNED-001')
            ->call('belumDipinjam')
            ->assertSee('PENDING-001')
            ->assertDontSee('BORROWED-001')
            ->assertDontSee('RETURNED-001')
            ->call('sedangDipinjam')
            ->assertDontSee('PENDING-001')
            ->assertSee('BORROWED-001')
            ->assertDontSee('RETURNED-001')
            ->call('selesaiDipinjam')
            ->assertDontSee('PENDING-001')
            ->assertDontSee('BORROWED-001')
            ->assertSee('RETURNED-001')
            ->call('format')
            ->assertSee('PENDING-001')
            ->assertSee('BORROWED-001')
            ->assertSee('RETURNED-001');
    }

    public function test_changing_status_filter_resets_the_transaction_page()
    {
        $petugas = User::factory()->create();
        for ($index = 1; $index <= 6; $index++) {
            $this->createTransaction($petugas, 1, 'PENDING-'.$index);
        }
        $this->createTransaction($petugas, 2, 'BORROWED-PAGE-ONE');

        Livewire::actingAs($petugas)
            ->test(Transaksi::class)
            ->call('gotoPage', 2)
            ->assertDontSee('PENDING-1')
            ->call('sedangDipinjam')
            ->assertSet('paginators.page', 1)
            ->assertSee('BORROWED-PAGE-ONE');
    }

    private function createTransaction(User $peminjam, int $status, string $kode): Peminjaman
    {
        return Peminjaman::create([
            'kode_pinjam' => $kode,
            'peminjam_id' => $peminjam->id,
            'status' => $status,
            'tanggal_pinjam' => today()->toDateString(),
            'tanggal_kembali' => today()->addDays(10)->toDateString(),
        ]);
    }
}
