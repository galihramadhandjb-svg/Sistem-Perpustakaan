<?php

namespace Tests\Feature;

use App\Http\Livewire\Peminjam\Kategori as PeminjamKategori;
use App\Models\Buku;
use App\Models\Kategori;
use Database\Seeders\BukuSeeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\PenerbitSeeder;
use Database\Seeders\RakSeeder;
use Database\Seeders\ReligiBiografiSeeder;
use Database\Seeders\RemoveNoneCategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BookCategorySeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeded_books_use_their_own_categories_and_none_is_removed()
    {
        $this->seed([
            KategoriSeeder::class,
            RakSeeder::class,
            PenerbitSeeder::class,
            BukuSeeder::class,
            ReligiBiografiSeeder::class,
            RemoveNoneCategorySeeder::class,
        ]);

        $this->assertDatabaseMissing('kategori', ['slug' => 'none']);

        foreach ([
            'bintang' => 'novel',
            'matahari' => 'novel',
            'tentang-kamu' => 'novel',
            'gusdur' => 'biografi',
            'habibie' => 'biografi',
            'naruto-volume-58' => 'komik',
            'naruto-volume-71' => 'komik',
            'maaf-tuhan-aku-hampir-menyerah' => 'religi',
            'dunia-batin-buya-hamka-kisah-dan-catatan-catatan-dari-balik-penjara' => 'biografi',
        ] as $slug => $kategoriSlug) {
            $buku = Buku::where('slug', $slug)->firstOrFail();

            $this->assertSame($kategoriSlug, $buku->kategori->slug);
            $this->assertSame($buku->kategori_id, $buku->rak->kategori_id);
        }

        Livewire::test(PeminjamKategori::class)
            ->assertDontSee('None')
            ->assertSee('Novel')
            ->assertSee('Religi');
    }

    public function test_running_book_seeders_again_does_not_duplicate_books_or_reset_stock()
    {
        $this->seed([
            KategoriSeeder::class,
            RakSeeder::class,
            PenerbitSeeder::class,
            BukuSeeder::class,
            ReligiBiografiSeeder::class,
            RemoveNoneCategorySeeder::class,
        ]);

        $buku = Buku::where('slug', 'bintang')->firstOrFail();
        $buku->update(['stok' => 4]);

        $this->seed([
            KategoriSeeder::class,
            RakSeeder::class,
            BukuSeeder::class,
            ReligiBiografiSeeder::class,
            RemoveNoneCategorySeeder::class,
        ]);

        $this->assertSame(1, Buku::where('slug', 'bintang')->count());
        $this->assertSame(4, $buku->fresh()->stok);
    }

    public function test_legacy_none_category_is_removed_when_unused()
    {
        Kategori::create(['nama' => 'None', 'slug' => 'none']);
        $this->seed(RemoveNoneCategorySeeder::class);

        $this->assertDatabaseMissing('kategori', ['slug' => 'none']);
    }
}
