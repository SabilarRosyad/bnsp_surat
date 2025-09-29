<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Letter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class LetterSeeder extends Seeder
{
    public function run(): void
    {
        // Simpan file Undangan Rapat
        $sourceUndangan = database_path('seeders/files/undangan_rapat.pdf'); // letakkan file PDF di sini
        $pathUndangan = Storage::disk('public')->putFile('letters', new File($sourceUndangan));

        Letter::create([
            'title'       => 'Undangan Rapat',
            'description' => 'Undangan rapat bulanan',
            'date'        => '2025-09-29',
            'file_path'   => $pathUndangan, // path yang valid di storage
            'nomor_surat' => '001/IX/2025',
            'kategori'    => 'Undangan',
        ]);

        // Simpan file Pengumuman Libur
        $sourceLibur = database_path('seeders/files/pengumuman_libur.pdf'); // letakkan file PDF di sini
        $pathLibur = Storage::disk('public')->putFile('letters', new File($sourceLibur));

        Letter::create([
            'title'       => 'Pengumuman Libur',
            'description' => 'Pengumuman libur nasional',
            'date'        => '2025-10-01',
            'file_path'   => $pathLibur,
            'nomor_surat' => '002/X/2025',
            'kategori'    => 'Pengumuman',
        ]);
    }
}
