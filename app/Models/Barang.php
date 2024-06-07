<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\Toko;
Use App\Models\Kategori;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $guarded = [];

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'id_toko');
    }

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori');
    }
}
