<?php

namespace App\Models;

use App\Models\Makanan;
use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Laporan extends Model
{
    use HasFactory;

    protected $with = ['makanan', 'waktu_awal', 'waktu_akhir', 'kategori'];

    public function scopeFilter($query, $waktu_awal, $waktu_akhir, $makanan)
    {
        $query->when(
            $waktu_awal['waktu_awal'] ?? false,
            $waktu_akhir['waktu_akhir'] ?? false,
            $makanan['makanan'] ?? false,
            function ($query, $waktu_awal, $waktu_akhir, $makanan) {
                return  $query->where(function ($query) use ($waktu_awal, $waktu_akhir, $makanan) {
                    $query->groupby('makanan_id')
                        ->whereBetween('penjualans.created_at', [$waktu_awal, $waktu_akhir])
                        ->where('penjualans.nama_makanan', $makanan)
                        ->selectRaw('nama_makanan, sum(qty) as qty, sum(harga_makanan) as harga_makanan, harga_makanan*qty as subtotal');
                });
            }
        );
        end($query);
        $query->when(
            $filters['makanan'] ?? false,
            function ($query, $category) {
                return  $query->whereHas('category', function ($query) use ($category) {
                    $query->where('nama_category', $category);
                });
            }
        );
    }

    public function makanan()
    {
        return $this->hasMany(Makanan::class);
    }
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }

    // Function for Dayly Laporan
    //============================

    public function scopeterjualharian()
    {
        $terjual = date('y-m-d');
        $terjual = Penjualan::where('created_at', 'like', '%' . $terjual . '%')->get()->sum('qty');
        return $terjual;
    }
    protected function scopependapatanharian()
    {
        $pendapatan = date('Y-m-d');
        $pendapatan = Checkout::where('created_at', 'like', '%' . $pendapatan . '%')->get()->sum('total_bayar');
        return $pendapatan;
    }
    public function scopeterjualbulanan()
    {
        $terjual = date('Y-m');
        $terjual = Penjualan::where('created_at', 'like', '%' . $terjual . '%')->get()->sum('qty');
        return $terjual;
    }
    protected function scopependapatanbulanan()
    {
        $pendapatan = date('Y-m');
        $pendapatan = Checkout::where('created_at', 'like', '%' . $pendapatan . '%')->get()->sum('total_bayar');
        return $pendapatan;
    }
    public function scopeterjualtahunan()
    {
        $terjual = date('Y');
        $terjual = Penjualan::where('created_at', 'like', '%' . $terjual . '%')->get()->sum('qty');
        return $terjual;
    }
    protected function scopependapatantahunan()
    {
        $pendapatan = date('Y');
        $pendapatan = Checkout::where('created_at', 'like', '%' . $pendapatan . '%')->get()->sum('total_bayar');
        return $pendapatan;
    }
}
