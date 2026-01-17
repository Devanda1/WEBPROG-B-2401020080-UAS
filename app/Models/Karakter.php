<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karakter extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'game',
        'jenis',
        'foto',
        'background',
        'warna',
        'deskripsi',
    ];
}