<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_klasifikasi','judul','penulis','penerbit','tahun_terbit','subyek',
        'deskripsi_fisik','lokasi','foto'
    ];
}
