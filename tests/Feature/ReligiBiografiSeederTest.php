<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Kategori;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\PenerbitSeeder;
use Database\Seeders\RakSeeder;
use Database\Seeders\ReligiBiografiSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReligiBiografiSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_religi_and_biografi_categories_have_books_and_racks()
    {
        $this->seed(KategoriSeeder::class);
        $this->seed(RakSeeder::class);
        $this->seed(PenerbitSeeder::class);
        $this->seed(ReligiBiografiSeeder::class);

        foreach (['religi', 'biografi'] as $slug) {
            $kategori = Kategori::where('slug', $slug)->firstOrFail();

            $this->assertGreaterThan(0, Buku::where('kategori_id', $kategori->id)->count());
            $this->assertDatabaseHas('rak', ['kategori_id' => $kategori->id]);
        }

        $this->seed(ReligiBiografiSeeder::class);

        foreach ([
            'maaf-tuhan-aku-hampir-menyerah',
            'dunia-batin-buya-hamka-kisah-dan-catatan-catatan-dari-balik-penjara',
        ] as $slug) {
            $this->assertSame(1, Buku::where('slug', $slug)->count());
        }
    }
}
