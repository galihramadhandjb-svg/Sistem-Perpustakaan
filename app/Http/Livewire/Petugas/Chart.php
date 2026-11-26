<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart extends Component
{
    public $bulan_tahun;

    public function mount()
    {
        $this->bulan_tahun = date('Y-m');
    }

    public function render()
    {
        $bulanTahun = $this->bulan_tahun ?: date('Y-m');
        $mulai = Carbon::createFromFormat('Y-m', $bulanTahun)->startOfMonth();
        $jumlahHari = $mulai->daysInMonth;
        $countPerHari = array_fill(1, $jumlahHari, 0);

        $selesaiDipinjam = DB::table('peminjaman')
            ->select('tanggal_pengembalian', DB::raw('count(*) as count'))
            ->where('status', 3)
            ->whereBetween('tanggal_pengembalian', [
                $mulai->toDateString(),
                $mulai->copy()->endOfMonth()->toDateString()
            ])
            ->groupBy('tanggal_pengembalian')
            ->get();

        foreach ($selesaiDipinjam as $item) {
            $hari = Carbon::parse($item->tanggal_pengembalian)->day;
            $countPerHari[$hari] = (int) $item->count;
        }

        $this->emit('ubahBulanTahun', array_values($countPerHari), range(1, $jumlahHari));

        return view('livewire.petugas.chart');
    }
}
