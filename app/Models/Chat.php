<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id','interested_book','interested_service','sent_by','body','processed_body'
    ];

    public function buku() {
        return $this->belongsTo('App\Models\Buku', 'interested_book');
    }
    public function service() {
        return $this->belongsTo('App\Models\LayananPerpustakaan', 'interested_service');
    }
}
