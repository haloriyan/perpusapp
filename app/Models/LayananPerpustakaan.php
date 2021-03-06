<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananPerpustakaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','stemmed_name','description'
    ];
}
