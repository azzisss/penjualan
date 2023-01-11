<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Checkout;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkout       = Checkout::where('user_id', Auth::id())->get()->last();
        $checkout_id    = $checkout->id;
        $itemorder      = Penjualan::get()->where('checkout_id', $checkout_id)
            ->where('user_id', Auth::id());
        $created_at     = $checkout->created_at;
        $created_at     = $created_at->translatedFormat('d-m-Y h:i:s');

        return view('checkout.index', [
            "title"         => 'Penjualan',
            "active"        => 'penjualan',
            "active2"       => 'penjualan',
            "itemorder"     => $itemorder,
            "nama_user"     => $checkout->user,
            "no_meja"       => $checkout->no_meja,
            "no_pesanan"    => $checkout->no_pesanan,
            "total_harga"   => $checkout->total_harga,
            "diskon"        => $checkout->diskon,
            "tunai"         => $checkout->tunai,
            "kembali"       => $checkout->kembali,
            "tgl"           => $created_at
        ]);
    }

    public function makeCheckout(Request $request)
    {
        // Buat data Checkout
        // buat dl no pesanan
        $allcheck   = Checkout::count() + 1;
        $bulan      = date('m');
        $tahun      = date('Y');
        $dateb      = Checkout::whereMonth('created_at', $bulan)->count() + 1;
        $datey      = Checkout::whereYear('created_at', $tahun)->count() + 1;
        $no_pesanan = 'JGS' . date('m/y') . '/' . $dateb . '/' . $datey . '/' . $allcheck;

        // validasi  checkout 
        $valdataCheckout = $request->validate([
            "no_meja"       => 'nullable',
            "total_harga"   => 'required',
            "diskon"        => 'nullable',
            "total_bayar"   => 'required',
            "tunai"         => 'required',
            "kembali"       => 'required|integer|min:0',
        ]);
        $valdataCheckout['no_pesanan']  = $no_pesanan;
        $valdataCheckout['user']     = auth()->user()->name;
        $valdataCheckout['user_id']  = Auth::id();

        Checkout::create($valdataCheckout);

        // DB::table('checkouts')->truncate();
        // DB::table('penjualans')->truncate();

        // Ambil data checkout terbaru untuk update ke carts
        $checkout       = Checkout::get()->last();
        $checkout_id    = $checkout->id;
        $c              = Cart::all();
        foreach ($c as $check_id) {
            Cart::cartup()
                ->where('id', $check_id->id)
                ->where('user_id', auth()->user()->id)
                ->update(['checkout_id' => $checkout_id]);
        }
        // Move data dari carts ke penjualan sebagai data laporan
        Cart::query()->where('user_id', Auth::id())->each(function ($old) {
            $new = $old->replicate();
            $new->setTable('penjualans');
            $new->save();
            $old->delete();
        });
    }
}
