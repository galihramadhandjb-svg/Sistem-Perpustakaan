<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Transaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $belum_dipinjam, $sedang_dipinjam, $selesai_dipinjam, $search;

    public function belumDipinjam()
    {
        $this->format();
        $this->belum_dipinjam = true;
    }

    public function sedangDipinjam()
    {
        $this->format();
        $this->sedang_dipinjam = true;
    }

    public function selesaiDipinjam()
    {
        $this->format();
        $this->selesai_dipinjam = true;
    }

    public function pinjam(Peminjaman $peminjaman)
    {
        $berhasil = DB::transaction(function () use ($peminjaman) {
            $peminjaman = Peminjaman::whereKey($peminjaman->id)->lockForUpdate()->firstOrFail();

            if ($peminjaman->status !== 1) {
                return false;
            }

            $detailPeminjaman = $peminjaman->detail_peminjaman;
            if ($detailPeminjaman->isEmpty()) {
                return false;
            }

            $jumlahPerBuku = $detailPeminjaman
                ->groupBy('buku_id')
                ->map(function ($detail) {
                    return $detail->count();
                })
                ->sortKeys();

            foreach ($jumlahPerBuku as $bukuId => $jumlah) {
                $buku = Buku::whereKey($bukuId)->lockForUpdate()->firstOrFail();
                if ($buku->stok < $jumlah) {
                    return false;
                }
            }

            foreach ($jumlahPerBuku as $bukuId => $jumlah) {
                Buku::whereKey($bukuId)->decrement('stok', $jumlah);
            }

            $peminjaman->update([
                'petugas_pinjam' => auth()->id(),
                'status' => 2
            ]);

            return true;
        });

        if ($berhasil) {
            session()->flash('sukses', 'Buku berhasil dipinjam.');
        } else {
            session()->flash('gagal', 'Peminjaman sudah diproses atau stok buku tidak tersedia.');
        }
    }

    public function kembali(Peminjaman $peminjaman)
    {
        $berhasil = DB::transaction(function () use ($peminjaman) {
            $peminjaman = Peminjaman::whereKey($peminjaman->id)->lockForUpdate()->firstOrFail();
            if ($peminjaman->status !== 2) {
                return false;
            }

            foreach ($peminjaman->detail_peminjaman as $detail_peminjaman) {
                $detail_peminjaman->buku()->lockForUpdate()->firstOrFail()->increment('stok');
            }

            $tanggalKembali = Carbon::parse($peminjaman->getAttributes()['tanggal_kembali']);
            $tanggalPengembalian = today();
            $denda = $tanggalKembali->lt($tanggalPengembalian)
                ? $tanggalKembali->diffInDays($tanggalPengembalian) * 1000
                : 0;

            $peminjaman->update([
                'status' => 3,
                'petugas_kembali' => auth()->id(),
                'tanggal_pengembalian' => $tanggalPengembalian->toDateString(),
                'denda' => $denda
            ]);

            return true;
        });

        if ($berhasil) {
            session()->flash('sukses', 'Buku berhasil dikembalikan.');
        } else {
            session()->flash('gagal', 'Peminjaman ini tidak sedang berlangsung.');
        }
    }

    public function render()
    {
        if ($this->search) {
            if ($this->belum_dipinjam) {
                $transaksi = Peminjaman::latest()->where('kode_pinjam', 'like', '%'. $this->search .'%')->where('status', 1)->paginate(5);
            } elseif ($this->sedang_dipinjam) {
                $transaksi = Peminjaman::latest()->where('kode_pinjam', 'like', '%'. $this->search .'%')->where('status', 2)->paginate(5);
            } elseif ($this->selesai_dipinjam) {
                $transaksi = Peminjaman::latest()->where('kode_pinjam', 'like', '%'. $this->search .'%')->where('status', 3)->paginate(5);
            } else {
                $transaksi = Peminjaman::latest()->where('kode_pinjam', 'like', '%'. $this->search .'%')->where('status', '!=', 0)->paginate(5);
            }
        } else {
            if ($this->belum_dipinjam) {
                $transaksi = Peminjaman::latest()->where('status', 1)->paginate(5);
            } elseif ($this->sedang_dipinjam) {
                $transaksi = Peminjaman::latest()->where('status', 2)->paginate(5);
            } elseif ($this->selesai_dipinjam) {
                $transaksi = Peminjaman::latest()->where('status', 3)->paginate(5);
            } else {
                $transaksi = Peminjaman::latest()->where('status', '!=', 0)->paginate(5);
            }
        }
    
        return view('livewire.petugas.transaksi', [
            'transaksi' => $transaksi
        ]);
    }

    public function format()
    {
        $this->sedang_dipinjam = false;
        $this->belum_dipinjam = false;
        $this->selesai_dipinjam = false;
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
