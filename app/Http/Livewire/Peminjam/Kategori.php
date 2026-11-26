<?php

namespace App\Http\Livewire\Peminjam;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Kategori extends Component
{
    protected $listeners = ['tambahKeranjang', 'kurangiKeranjang'];

    public $count;

    public function mount()
    {
        if (auth()->user()) {
            $this->count = DB::table('peminjaman')
                ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
                ->where('peminjam_id', auth()->user()->id)
                ->where('status', '!=', 3)
                ->count();
        }
    }

    public function tambahKeranjang()
    {
        $this->count += 1;
    }

    public function kurangiKeranjang()
    {
        $this->count -= 1;
    }

    public function render()
    {
        return view('livewire.peminjam.kategori', [
            'count' => $this->count
        ]);
    }
}
