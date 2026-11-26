<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = ['novel', 'sejarah', 'religi', 'biografi', 'komik'];

        foreach ($kategori as $value) {
            Kategori::firstOrCreate(
                ['slug' => Str::slug($value)],
                ['nama' => $value]
            );
        }
    }
}
