<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Barang;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjang';
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
