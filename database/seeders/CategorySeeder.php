<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Undangan',
            'description' => 'Kategori untuk surat undangan'
        ]);

        Category::create([
            'name' => 'Pengumuman',
            'description' => 'Kategori untuk surat pengumuman'
        ]);

        Category::create([
            'name' => 'Pemberitahuan',
            'description' => 'Kategori untuk surat pemberitahuan'
        ]);

        Category::create([
            'name' => 'Nota Dinas',
            'description' => 'Surat nota dinas resmi'
        ]);
    }
}
