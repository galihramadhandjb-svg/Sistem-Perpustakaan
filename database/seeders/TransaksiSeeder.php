<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        $peminjam = User::role('peminjam')->orderBy('id')->take(3)->get();
        if ($peminjam->count() < 3) {
            throw new RuntimeException('Seeder transaksi memerlukan tiga akun peminjam.');
        }

        $petugas = User::role('petugas')->orderBy('id')->firstOrFail();

        $transaksiContoh = [
            [
                'kode_pinjam' => 'DEMO-PENDING-001',
                'peminjam_id' => $peminjam[0]->id,
                'status' => 1,
                'tanggal_pinjam' => today()->toDateString(),
                'tanggal_kembali' => today()->addDays(10)->toDateString(),
                'petugas_pinjam' => null,
                'petugas_kembali' => null,
                'tanggal_pengembalian' => null,
                'denda' => 0,
                'buku' => 'bintang',
            ],
            [
                'kode_pinjam' => 'DEMO-ACTIVE-001',
                'peminjam_id' => $peminjam[1]->id,
                'status' => 2,
                'tanggal_pinjam' => today()->subDays(2)->toDateString(),
                'tanggal_kembali' => today()->addDays(8)->toDateString(),
                'petugas_pinjam' => $petugas->id,
                'petugas_kembali' => null,
                'tanggal_pengembalian' => null,
                'denda' => 0,
                'buku' => 'gusdur',
            ],
            [
                'kode_pinjam' => 'DEMO-RETURNED-001',
                'peminjam_id' => $peminjam[2]->id,
                'status' => 3,
                'tanggal_pinjam' => today()->subDays(12)->toDateString(),
                'tanggal_kembali' => today()->subDays(2)->toDateString(),
                'petugas_pinjam' => $petugas->id,
                'petugas_kembali' => $petugas->id,
                'tanggal_pengembalian' => today()->subDay()->toDateString(),
                'denda' => 0,
                'buku' => 'naruto-volume-58',
            ],
        ];

        foreach ($transaksiContoh as $data) {
            $buku = Buku::where('slug', $data['buku'])->firstOrFail();
            $peminjaman = Peminjaman::firstOrCreate(
                ['kode_pinjam' => $data['kode_pinjam']],
                [
                    'peminjam_id' => $data['peminjam_id'],
                    'status' => $data['status'],
                    'tanggal_pinjam' => $data['tanggal_pinjam'],
                    'tanggal_kembali' => $data['tanggal_kembali'],
                    'petugas_pinjam' => $data['petugas_pinjam'],
                    'petugas_kembali' => $data['petugas_kembali'],
                    'tanggal_pengembalian' => $data['tanggal_pengembalian'],
                    'denda' => $data['denda'],
                ]
            );

            DetailPeminjaman::firstOrCreate([
                'peminjaman_id' => $peminjaman->id,
                'buku_id' => $buku->id,
            ]);

            if ($peminjaman->wasRecentlyCreated && $data['status'] === 2) {
                $buku->decrement('stok');
            }
        }
    }
}
