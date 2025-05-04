<?php

namespace Database\Seeders;

use App\Models\CategoryBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'History',
            'Fantasy',
            'Romance',
            'Horror',
            'Science Fiction',
            'Mystery',
            'Thriller',
            'Biography',
            'Self-Help',
        ];

        foreach ($categories as $category) {
            CategoryBook::create([
                'nama_kategori' => $category,
            ]);
        }

    }
}
