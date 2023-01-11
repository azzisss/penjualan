<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Makanan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Echo_;

class HomeController extends Controller
{
    public function index()
    {

        return view('penjualan', [
            "categories"    => Category::all(),
            "makanans"      => Makanan::latest()->filter(request(['search']))->get(),
            "cartitem"      => Cart::where('user_id', Auth::id())->get(),
            "del"           => Cart::where('user_id', Auth::id()),
            "total"         => Cart::where('user_id', Auth::id())->sum('subtotal'),
            "col"           => '1',
            "col2"          => '1',
            "sc"            => '1',
            "sc2"           => '1',
            "mod"           => '1',
            "mod2"          => '1',
            "cart"          => '1',
            "title"         => 'Penjualan',
            "fitur2"        => 'Daftar Makanan',
            "active"        => 'penjualan',
            "active2"       => 'penjualan',
        ]);
    }
    public function cartview()
    {
        $data = Cart::where('user_id', Auth::id())->get();
        return response()->json($data);
    }
    public function total()
    {
        $data = Cart::where('user_id', Auth::id())->sum('subtotal');
        echo "
        <td colspan='2' class='fs-5'><b>Total</b></td>
        <td colspan='2' class='fs-5'><b> Rp " . number_format($data, 0, ',', '.') . " </b></td>
        ";
    }

    public function updateqty(Request $request)
    {
        $cart = Cart::where('id', $request->id)->get()->where('user_id', Auth::id())->first();
        $harga_makanan  = $cart->harga_makanan;
        $qty            = $request->qty;
        $subtotal       = ($harga_makanan * $qty);

        $data = [
            "harga_makanan" => $harga_makanan,
            "qty"           => $qty,
            "subtotal"      => $subtotal
        ];

        $cart->update($data);
        // if ($qty == 0) {
        //     $cart->delete();
        // }
        // return response()->json('delete');

    }

    public function itemdel(Request $request)
    {
        $cart = Cart::where('id', $request->id)->get()->where('user_id', Auth::id())->first();
        $cart->delete();
    }

    public function cartplus(Request $request)
    {
        $cart = Cart::where('makanan_id', $request->makanan_id)
            ->where('user_id', Auth::id())->first();

        if ($cart) {
            $qtyplus        = 1;
            $harga_makanan  = $cart->harga_makanan;
            $qty            = $cart->qty + $qtyplus;
            $subtotal       = ($harga_makanan * $qty);

            $data = [
                "harga_makanan" => $harga_makanan,
                "qty"           => $qty,
                "subtotal"      => $subtotal
            ];

            $cart->update($data);
        } else {
            $data = [
                "makanan_id"    => $request->makanan_id,
                "user_id"       => Auth::id(),
                "nama_makanan"  => $request->nama_makanan,
                "harga_makanan" => $request->harga_makanan,
                "qty"           => $request->qty,
                "subtotal"      => $request->subtotal
            ];
            Cart::create($data);
        }
    }
    //modal checkout
    public function cartitem()
    {

        $number = 1;
        $cart   = Cart::where('user_id', Auth::id())->get();
        foreach ($cart as $item) {
            echo
            "<tr>
                <th class='text-center'>" . $number++ . "
                <input type='hidden' name='makanan_id' id=''
                    value=" . $item->id . ">
                </th>
                <td class='fw-semibold'> $item->nama_makanan
                <input type='hidden' name='nama_makanan' id=''
                    value='$item->nama_makanan'>
                </td>
                <td class='text-center '>Rp. 
                    " . number_format($item->harga_makanan, 0, ',', '.') .
                "<input type='hidden' name='harga_makanan' id=''
                        value='$item->harga_makanan'>
                </td>
                <td class='text-center '> $item->qty 
                    <input type='hidden' name='qty' id=''
                        value=' $item->qty '>
                </td>
                <td class='text-center '>Rp. " .
                number_format($item->subtotal, 0, ',', '.') . "
                <input type='hidden' name='subtotal' id=''
                    value=' $item->subtotal '>
                </td>
            </tr>";
        }
        $total  = Cart::where('user_id', Auth::id())->sum('subtotal');

        echo
        "
        <tr>
            <td colspan='2' class='text-start'
                style='border-inline-end-color: white'>
                <h6 class='mt-2 ms-2'>Total Harga </h6>
            </td>
            <td colspan='3' class='text-center '>
                <input type='hidden' name='total_harga' id='total_harga'
                    value=' $total'>
                <h5 class='mt-2 ms-2'>Rp " . number_format($total, 0, ',', '.') . "
                </h5>

            </td>
        </tr>
        <tr class=''>
            <td colspan='2' class='text-start '
                style='border-inline-end-color: white'>
                <h6 class='mt-2 ms-2'>Nomer Meja </h6>
            </td>
            <td colspan='3' class='fs-5 text-end'>
                <div class='input-group mb-0 text-center'>
                    <input class='form-control border bg-white border text-center'
                        min='0' max='8' value='0' onkeyup='mejachange()' oninput='this.value = Math.abs(this.value)' placeholder='Nomer Meja'
                        type='number' name='no_meja' id='no_meja'
                        style='max-width: 10rem'>

                </div>
            </td>
        </tr>
        <tr class=''>
            <td colspan='2' class='text-start '
                style='border-inline-end-color: white'>
                <h6 class='mt-2 ms-2'>Diskon </h6>
            </td>
            <td colspan='3' class='fs-5 text-end'>
                <div class='input-group mb-0 text-center'>
                    <input class='form-control border bg-white border text-center'
                        min='0' max='100' value='0' onkeyup='diskonchange()' oninput='this.value = Math.abs(this.value)' placeholder='Diskon'
                        type='number' name='diskon' id='diskon'
                        onfocus='mulaiHitung()' onblur='stopHitung()'
                        style='max-width: 50rem'>
                    <span class='input-group-text '>%</span>

                </div>
            </td>
        </tr>
        <tr>
            <td colspan='2' class='text-start fs-5'
                style='border-inline-end-color: white'>
                <h6 class='mt-2 ms-2'>Total Bayar </h6>
            </td>
            <td colspan='3' class='fs-5'>
                <div class='input-group mb-0 text-center'>
                    <span class='input-group-text'> <strong> Rp.</strong> </span>
                    <input class='form-control border text-center fs-bolder' readonly
                        placeholder='Total Bayar' min='0' type='number'
                        name='total_bayar' id='total_bayar' onfocus='mulaiHitung()'
                        onblur='stopHitung()' required>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan='2' class='text-start fs-5'
                style='border-inline-end-color: white'>
                <h6 class='mt-2 ms-2'>Tunai </h6>
            </td>
            <td colspan='3' class='fs-5'>
                <div class='input-group'>
                    <span class='input-group-text'> <strong>Rp.</strong> </span>
                    <input type='number' placeholder='Pembayaran' name='tunai'
                        class='form-control border text-center' id='tunai'
                        onfocus='mulaiHitung()' onblur='stopHitung()' required=''
                        min='0'>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan='2' class='text-start'
                style='border-inline-end-color: white'>
                <h6 class='mt-2 ms-2'>Kembali </h6>
            </td>
            <td colspan='3' class='fs-5'>
                <div class='input-group text-center'>
                    <span class='input-group-text'> <strong>Rp.</strong> </span>
                    <input type='number' readonly placeholder='Kembali'
                        name='kembali'
                        class='form-control bg-white border text-center'
                        id='kembalian' onfocus='mulaiHitung()' onblur='stopHitung()'
                        required='' min='0'>
                </div>
            </td>
        </tr>";
    }
    // public function checkkasir()
    // {
    // }
}
