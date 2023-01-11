<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'checkout_id');
    }

    public function makanan()
    {
        return $this->hasMany(Makanan::class, 'makanan_id');
    }

    public function updatedetail($itemdetail, $qty, $harga_makanan)
    {
        $this->attributes['qty']        = $itemdetail->qty + $qty;
        $this->attributes['subtotal']   = $itemdetail->subtotal + ($qty * $harga_makanan);
        self::save();
    }

    public function updatenter($itemdetail, $qty, $harga_makanan)
    {
        $this->attributes['qty']        = $itemdetail->qty = $qty;
        $this->attributes['subtotal']   = $itemdetail->subtotal = ($qty * $harga_makanan);
        self::save();
    }

    public function scopecart()
    {
        DB::table('carts')->delete();
    }
    protected function scopecartup()
    {
        DB::table('carts');
    }
}
