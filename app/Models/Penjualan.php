<?php

namespace App\Models;

use App\Models\Laporan;
use App\Models\Makanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $guarded=['id'];


    public function makanan(){
        return $this->hasMany(Makanan::class);
    }
    public function laporan(){
        return $this->hasMany(Laporan::class);
    }

}
