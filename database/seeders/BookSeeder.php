<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KoleksiBuku;
use App\Models\CategoryBook;
use DateTime;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = CategoryBook::pluck('id', 'nama_kategori');

        $books = [
            [
                'kode_buku' => 'BK001',
                'judul' => 'Hujan',
                'pengarang' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => new DateTime('2016-01-01'),
                'deskripsi' => 'Novel tentang perjuangan hidup dan cinta di tengah bencana.',
                'cover' => '',
                'kategori_id' => $categories['Romance'] ?? $categories->first(),
                'stok_buku' => 1,
            ],
            [
                'kode_buku' => 'BK002',
                'judul' => 'Bumi',
                'pengarang' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => new DateTime('2014-01-01'),
                'deskripsi' => 'Petualangan fantasi di dunia paralel.',
                'cover' => '',
                'kategori_id' => $categories['Fantasy'] ?? $categories->first(),
                'stok_buku' => 1,
            ],
            [
                'kode_buku' => 'BK003',
                'judul' => 'Rindu',
                'pengarang' => 'Tere Liye',
                'penerbit' => 'Republika',
                'tahun_terbit' => new DateTime('2014-01-01'),
                'deskripsi' => 'Kisah perjalanan haji dan pencarian makna hidup.',
                'cover' => '',
                'kategori_id' => $categories['Biography'] ?? $categories->first(),
                'stok_buku' => 1,
            ],
            [
                'kode_buku' => 'BK004',
                'judul' => 'Pulang',
                'pengarang' => 'Tere Liye',
                'penerbit' => 'Republika',
                'tahun_terbit' => new DateTime('2015-01-01'),
                'deskripsi' => 'Kisah keluarga dan perjalanan hidup penuh liku.',
                'cover' => '',
                'kategori_id' => $categories['Self-Help'] ?? $categories->first(),
                'stok_buku' => 1,
            ],
            [
                'kode_buku' => 'BK005',
                'judul' => 'Negeri Para Bedebah',
                'pengarang' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => new DateTime('2012-01-01'),
                'deskripsi' => 'Novel thriller ekonomi dan politik.',
                'cover' => '',
                'kategori_id' => $categories['Thriller'] ?? $categories->first(),
                'stok_buku' => 1,
            ],
        ];

        KoleksiBuku::query()->delete();
        foreach ($books as $book) {
            KoleksiBuku::create($book);
        }
    }
}
