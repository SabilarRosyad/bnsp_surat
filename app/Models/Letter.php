<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $table = 'letter';

    protected $fillable = [
        'title',
        'description',
        'date',
        'file_path',
        'nomor_surat',
        'kategori',
    ];
}
