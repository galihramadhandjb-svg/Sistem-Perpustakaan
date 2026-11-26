<?php

namespace App\Http\Livewire\Petugas;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartScript extends Component
{
    public $bulan_tahun;

    protected $listeners = ['ubahBulanTahun'];

    public function mount()
    {
        $this->bulan_tahun = date('Y-m');
    }

    public function ubahBulanTahun()
    {
        // 
    }

    public function render()
    {
        $mulai = Carbon::createFromFormat('Y-m', $this->bulan_tahun)->startOfMonth();
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

        return view('livewire.petugas.chart-script', [
            'count' => array_values($countPerHari),
            'tanggal_pengembalian' => range(1, $jumlahHari)
        ]);
    }
}
