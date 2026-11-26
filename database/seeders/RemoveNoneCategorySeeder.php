<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Database\Seeder;
use RuntimeException;

class RemoveNoneCategorySeeder extends Seeder
{
    public function run()
    {
        foreach (Kategori::where('slug', 'none')->get() as $kategoriNone) {
            if (Buku::where('kategori_id', $kategoriNone->id)->exists()) {
                throw new RuntimeException('Pindahkan buku dari kategori None sebelum menghapus kategori tersebut.');
            }

            $rakNone = Rak::where('kategori_id', $kategoriNone->id)->get();
            foreach ($rakNone as $rak) {
                if (Buku::where('rak_id', $rak->id)->exists()) {
                    throw new RuntimeException('Pindahkan buku dari rak kategori None sebelum menghapus kategori tersebut.');
                }

                $rak->delete();
            }

            $kategoriNone->delete();
        }
    }
}
