<?php

namespace Tests\Feature\Peminjam;

use App\Http\Livewire\Peminjam\Buku as KatalogBuku;
use App\Http\Livewire\Petugas\Buku as PetugasBuku;
use App\Models\Buku;
use App\Models\Kategori;
use Database\Seeders\BukuSeeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\PenerbitSeeder;
use Database\Seeders\RakSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class KatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            KategoriSeeder::class,
            RakSeeder::class,
            PenerbitSeeder::class,
            BukuSeeder::class,
        ]);
    }

    public function test_tc12_borrower_can_filter_books_by_category()
    {
        $kategoriNovel = Kategori::where('slug', 'novel')->firstOrFail();

        Livewire::test(KatalogBuku::class)
            ->call('pilihKategori', $kategoriNovel->id)
            ->assertSee('Bintang')
            ->assertDontSee('Gusdur');
    }

    public function test_tc14_admin_book_list_displays_each_book_cover()
    {
        $buku = Buku::query()->firstOrFail();

        Livewire::test(PetugasBuku::class)
            ->assertSeeHtml('src="/storage/'.$buku->sampul.'"');
    }
}
