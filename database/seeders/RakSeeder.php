<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Database\Seeder;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rak::where('slug', '0')
            ->whereNotIn('id', function ($query) {
                $query->select('rak_id')->from('buku');
            })
            ->delete();

        foreach ([
            'novel' => 1,
            'sejarah' => 2,
            'komik' => 3,
            'religi' => 4,
            'biografi' => 5,
        ] as $kategoriSlug => $nomorRak) {
            $kategori = Kategori::where('slug', $kategoriSlug)->firstOrFail();

            for ($baris = 1; $baris <= 5; $baris++) {
                Rak::updateOrCreate(
                    ['slug' => $nomorRak.'-'.$baris],
                    [
                        'rak' => $nomorRak,
                        'baris' => $baris,
                        'kategori_id' => $kategori->id,
                    ]
                );
            }
        }
    }
}
