<?php

namespace App\Http\Livewire\Peminjam;

use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Keranjang extends Component
{
    public $tanggal_pinjam;

    protected $rules = [
        'tanggal_pinjam' => 'required|date|after_or_equal:today',
    ];

    public function hapus(Peminjaman $peminjaman, DetailPeminjaman $detail_peminjaman)
    {
        abort_unless($peminjaman->peminjam_id === auth()->id(), 403);
        abort_unless($peminjaman->status === 0, 403);
        abort_unless($detail_peminjaman->peminjaman_id === $peminjaman->id, 404);

        if ($peminjaman->detail_peminjaman->count() == 1) {
            $detail_peminjaman->delete();
            $peminjaman->delete();
            session()->flash('sukses', 'Data berhasil dihapus');
            redirect('/');
        } else {
            $detail_peminjaman->delete();
            session()->flash('sukses', 'Data berhasil dihapus');
            $this->emit('kurangiKeranjang');
        }  
    }

    public function hapusMasal()
    {
        $keranjang = Peminjaman::latest()
            ->where('peminjam_id', auth()->id())
            ->where('status', 0)
            ->first();

        if (!$keranjang) {
            session()->flash('gagal', 'Keranjang yang dapat dihapus tidak ditemukan.');
            return;
        }

        foreach ($keranjang->detail_peminjaman as $detail_peminjaman) {
            $detail_peminjaman->delete();
        }
        $keranjang->delete();
        session()->flash('sukses', 'Data berhasil dihapus');
        redirect('/');
    }

    public function pinjam(Peminjaman $keranjang)
    {
        abort_unless($keranjang->peminjam_id === auth()->id(), 403);

        if ($keranjang->status !== 0) {
            session()->flash('gagal', 'Keranjang ini sudah diajukan dan tidak dapat diajukan kembali.');
            return;
        }

        $this->validate();

        $keranjang->update([
            'status' => 1,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => Carbon::create($this->tanggal_pinjam)->addDays(10)
        ]);

        session()->flash('sukses', 'Buku berhasil dipinjam');
    }

    public function batalkan(Peminjaman $peminjaman)
    {
        abort_unless($peminjaman->peminjam_id === auth()->id(), 403);

        if ($peminjaman->status !== 1) {
            session()->flash('gagal', 'Hanya pengajuan yang belum diproses petugas yang dapat dibatalkan.');
            return;
        }

        DB::transaction(function () use ($peminjaman) {
            $peminjaman->detail_peminjaman()->delete();
            $peminjaman->delete();
        });

        session()->flash('sukses', 'Pengajuan peminjaman berhasil dibatalkan.');
        return redirect('/');
    }

    public function render()
    {
        $keranjang = Peminjaman::latest()
            ->where('peminjam_id', auth()->id())
            ->where('status', '!=', 3)
            ->first();
        if (!$keranjang) {
            redirect('/');
        }
        return view('livewire.peminjam.keranjang', [
            'keranjang' => $keranjang
        ]);
    }
}
