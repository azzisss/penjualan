<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Makanan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // cek apa sudah ada data makanan sama dicart bila ada maka tambah qty
        $cart=Cart::all()->where('makanan_id',$request->input('makanan_id'))
                         ->where('user_id',Auth::id())->first();

        if ($cart){
            $qtyplus        = 1;
            $id             = $cart->id;
            $user_id        = $cart->user_id;
            $makanan_id     = $cart->makanan_id;
            $nama_makanan   = $cart->nama_makanan;
            $harga_makanan  = $cart->harga_makanan;
            $qty            = $cart->qty + $qtyplus;
            $subtotal       = ($harga_makanan * $qty);

            $data = [
                "id"            => $id,
                "user_id"       => $user_id,
                "makanan_id"    => $makanan_id,
                "nama_makanan"  => $nama_makanan,
                "harga_makanan" => $harga_makanan,
                "qty"           => $qty,
                "subtotal"      => $subtotal
            ]; 

            $cart->update($data);
            
        }else{
            
            $makanan_id     = $request->input('makanan_id');
            $nama_makanan   = $request->input('nama_makanan');
            $user_id        = Auth::id();
            $harga_makanan  = $request->input('harga_makanan');
            $qty            = $request->input('qty');
            $subtotal       = ($harga_makanan * $qty);
            
            $data = [
                "makanan_id"    => $makanan_id,
                "user_id"       => $user_id,
                "nama_makanan"  => $nama_makanan,
                "harga_makanan" => $harga_makanan,
                "qty"           => $qty,
                "subtotal"      => $subtotal
            ];
    
            Cart::create($data);

        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $itemdetail = Cart::findOrFail($id);
        $param = $request->param;
        $enterqty = $request->qty;
        
        if ($param == 'tambah') {
            
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, $qty, $itemdetail->harga_makanan );

            return back();
        }
        if ($param == 'kurang') {
            $qty = -1;
            $itemdetail->updatedetail($itemdetail, $qty, $itemdetail->harga_makanan);
            if ($enterqty <= 1 OR $enterqty == 0 OR $enterqty == -1) {

                Cart::cart()->where('id', $itemdetail->id)->delete();
            }
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }

    public function updateqty(Request $request, $id){
        $itemdetail = Cart::findOrFail($id);
        $enterqty = $request->qty;

        if ($enterqty > 0){
            $qty = $enterqty;
            $itemdetail->updatenter($itemdetail, $qty, $itemdetail->harga_makanan );

            return back();
        }

        if ($enterqty == 0) {
            Cart::cart()->where('id', $itemdetail->id)->delete();
            
            return back();
        }
    }


    public function deletecart(){
        Cart::cart()->delete();

        return back();
    }

    public function deletelist($id){
        Cart::where('id',$id)->delete();
        return back();
    }
}
