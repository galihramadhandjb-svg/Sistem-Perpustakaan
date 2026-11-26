<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Rak;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penerbit = [
            'gramedia' => Penerbit::where('slug', 'gramedia')->firstOrFail()->id,
            'erlangga' => Penerbit::where('slug', 'erlangga')->firstOrFail()->id,
        ];

        $books = [
            ['judul' => 'Bintang', 'penulis' => 'Tere Liye', 'sampul' => 'buku/Sampul_novel_Bintang.jpeg', 'penerbit' => 'gramedia', 'kategori' => 'novel', 'baris' => 1],
            ['judul' => 'Matahari', 'penulis' => 'Tere Liye', 'sampul' => 'buku/Sampul_novel_Matahari.jpeg', 'penerbit' => 'erlangga', 'kategori' => 'novel', 'baris' => 2],
            ['judul' => 'Tentang Kamu', 'penulis' => 'Tere Liye', 'sampul' => 'buku/Tentang_Kamu_sampul.jpeg', 'penerbit' => 'gramedia', 'kategori' => 'novel', 'baris' => 3],
            ['judul' => 'Gusdur', 'penulis' => 'Greg Borton', 'sampul' => 'buku/gusdur.jpg', 'penerbit' => 'gramedia', 'kategori' => 'biografi', 'baris' => 1],
            ['judul' => 'Habibie', 'penulis' => 'Raden Toto Sugiharto', 'sampul' => 'buku/habibie.jpg', 'penerbit' => 'gramedia', 'kategori' => 'biografi', 'baris' => 2],
            ['judul' => 'Naruto Volume 58', 'penulis' => 'Masashi Kishimoto', 'sampul' => 'buku/naruto-58.jpg', 'penerbit' => 'erlangga', 'kategori' => 'komik', 'baris' => 1],
            ['judul' => 'Naruto Volume 71', 'penulis' => 'Masashi Kishimoto', 'sampul' => 'buku/naruto-71.jpg', 'penerbit' => 'erlangga', 'kategori' => 'komik', 'baris' => 2],
        ];

        foreach ($books as $data) {
            $kategori = Kategori::where('slug', $data['kategori'])->firstOrFail();
            $rak = Rak::where('kategori_id', $kategori->id)
                ->where('baris', $data['baris'])
                ->firstOrFail();

            $book = Buku::firstOrNew(['slug' => Str::slug($data['judul'])]);
            $book->fill([
                'judul' => $data['judul'],
                'penulis' => $data['penulis'],
                'sampul' => $data['sampul'],
                'penerbit_id' => $penerbit[$data['penerbit']],
                'kategori_id' => $kategori->id,
                'rak_id' => $rak->id,
            ]);

            if (!$book->exists) {
                $book->stok = 10;
            }

            $book->save();
        }
    }
}
