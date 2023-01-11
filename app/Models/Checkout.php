<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Checkout extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function cart() {
        return $this->belongsTo(Cart::class, 'no_pesanan');
    }

    public function updatecheckout($item, $subtotal, $diskon) {
        $this->attributes['subtotal']   = $item->subtotal + $subtotal;
        $this->attributes['total']      = $item->total + ($subtotal - $diskon );
        self::save();
    }

    // Move data dari carts ke cart_final untuk menyimpan data laporan
    public function scopemovetopenjualan(){
        Cart::query()->where('user_id',Auth::id())->each(function ($old) {
            $new = $old->replicate();
            $new->setTable('penjualans');
            $new->save();
            $old->delete();
        });         
    }

}