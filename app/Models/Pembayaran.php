<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Aapp\Models\Keranjang;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $guarded = [];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'id_keranjang');
    }

}
