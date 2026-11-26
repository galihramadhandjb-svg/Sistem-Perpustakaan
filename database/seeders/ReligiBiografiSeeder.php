<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Rak;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReligiBiografiSeeder extends Seeder
{
    public function run()
    {
        $penerbitId = Penerbit::where('slug', '!=', 'none')->firstOrFail()->id;

        foreach ([
            [
                'judul' => 'Maaf Tuhan, Aku Hampir Menyerah',
                'penulis' => 'Alfi Al Ghazi',
                'kategori' => 'religi',
                'nomor_rak' => 4,
                'sampul' => 'buku/maaf-tuhan-aku-hampir-menyerah.png',
                'slug_sebelumnya' => ['panduan-ibadah-sehari-hari'],
            ],
            [
                'judul' => 'Dunia Batin Buya Hamka: Kisah dan Catatan-Catatan dari Balik Penjara',
                'penulis' => 'Muhammad Ghanoe',
                'kategori' => 'biografi',
                'nomor_rak' => 5,
                'sampul' => 'buku/dunia-batin-buya-hamka.png',
                'slug_sebelumnya' => ['kisah-tokoh-inspiratif'],
            ],
        ] as $data) {
            $kategori = Kategori::where('slug', $data['kategori'])->firstOrFail();

            for ($baris = 1; $baris <= 5; $baris++) {
                Rak::updateOrCreate(
                    ['slug' => $data['nomor_rak'].'-'.$baris],
                    [
                        'rak' => $data['nomor_rak'],
                        'baris' => $baris,
                        'kategori_id' => $kategori->id,
                    ]
                );
            }

            $rak = Rak::where('kategori_id', $kategori->id)->firstOrFail();
            $slug = Str::slug($data['judul']);
            $attributes = [
                'judul' => $data['judul'],
                'sampul' => $data['sampul'],
                'penulis' => $data['penulis'],
                'penerbit_id' => $penerbitId,
                'kategori_id' => $kategori->id,
                'rak_id' => $rak->id,
            ];
            $slugs = array_merge([$slug], $data['slug_sebelumnya'] ?? []);
            $buku = Buku::whereIn('slug', $slugs)->first();

            if ($buku) {
                $buku->update(array_merge($attributes, ['slug' => $slug]));
            } else {
                Buku::create(array_merge($attributes, ['slug' => $slug, 'stok' => 10]));
            }
        }
    }
}
