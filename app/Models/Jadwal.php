<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari','is_covid',
        'waktu_buka','waktu_tutup','waktu_buka_covid','waktu_tutup_covid'
    ];
}
