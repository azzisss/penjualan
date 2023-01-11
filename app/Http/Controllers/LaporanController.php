<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Checkout;
use App\Models\Penjualan;
use Illuminate\Http\Request;


class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index', [
            "title"         => 'Laporan',
            "active"        => 'laporan',
            //day
            "trjlhari"      => Laporan::terjualharian(),
            "pndptnhari"    => Laporan::pendapatanharian(),
            //month
            "trjlbulan"      => Laporan::terjualbulanan(),
            "pndptnbulan"    => Laporan::pendapatanbulanan(),
            //year
            "trjltahun"      => Laporan::terjualtahunan(),
            "pndptntahun"    => Laporan::pendapatantahunan(),
        ]);
    }


    public function show(Checkout $checkout)
    {

        $itemorder      = Penjualan::get()->where('checkout_id', $checkout->id);
        return view('laporan.showdetail', [
            "title"     => 'Laporan',
            "active"    => 'laporan',
            "itemorder"     => $itemorder,
            "nama_user"     => $checkout->user,
            "no_pesanan"    => $checkout->no_pesanan,
            "total_harga"   => $checkout->total_harga,
            "diskon"        => $checkout->diskon,
            "tunai"         => $checkout->total_bayar,
            "kembali"       => $checkout->kembali,
            "tgl"           => $checkout->created_at->format('d-m-Y h:i:s'),
            "no_meja"       => $checkout->no_meja,
        ]);
    }
    // DAY REPORT ==================================================

    public function day(Request $request)
    {
        if ($request->get('day')) {
            $waktu = date($request->get('day'));
        } else {
            $waktu      = date('Y-m-d');
        }
        $day = date('l', strtotime($waktu));
        switch ($day) {
            case 'Sunday':
                $day = 'Minggu';
                break;
            case 'Monday':
                $day = 'Senin';
                break;
            case 'Tuesday':
                $day = 'Selasa';
                break;
            case 'Wednesday':
                $day = 'Rabu';
                break;
            case 'Thursday':
                $day = 'Kamis';
                break;
            case 'Friday':
                $day = "Jum'at";
                break;
            case 'Saturday':
                $day = 'Sabtu';
                break;
            default:
                $day = 'Tidak ada';
                break;
        }
        $thisday = date('d F Y', strtotime($waktu));
        return view('laporan.harian.harian', [
            "title"         => 'Laporan Hari ' . $day . ", " . $thisday,
            "active"        => 'laporan',
            "hariini"       => $day . ", " . $thisday,
            "mkntrjl"       => Penjualan::whereDate('created_at', $waktu)->get()->sum('qty'),
            "pendapatan"    => Checkout::whereDate('created_at', $waktu)->get()->sum('total_bayar'),
            "tabelC"        => Checkout::whereDate('created_at', $waktu)->get(),
            "tabelMT"       => Penjualan::groupby('makanan_id')
                ->whereDate('created_at', $waktu)
                ->selectRaw('nama_makanan, sum(qty) as sum')
                ->get(),
        ]);
    }
    public function month(Request $request)
    {
        if ($request->get('month')) {
            $waktu = date($request->get('month'));
        } else {
            $waktu = date('Y-m');
        }
        $m = date('m', strtotime($waktu));
        $y = date('Y', strtotime($waktu));
        $month = date('M', strtotime($waktu));
        switch ($month) {
            case 'Jan':
                $month = 'Januari';
                break;
            case 'Feb':
                $month = 'Februari';
                break;
            case 'Mar':
                $month = 'Maret';
                break;
            case 'Apr':
                $month = 'April';
                break;
            case 'May':
                $month = 'Mei';
                break;
            case 'Jun':
                $month = "Juni";
                break;
            case 'Jul':
                $month = 'Juli';
                break;
            case 'Aug':
                $month = 'Agustus';
                break;
            case 'Sep':
                $month = 'September';
                break;
            case 'Oct':
                $month = 'Oktober';
                break;
            case 'Nov':
                $month = 'November';
                break;
            case 'Dec':
                $month = 'Desember';
                break;
            default:
                $month = 'Tidak Ada';
                break;
        }
        return view('laporan.bulanan.bulanan', [
            "title"         => 'Laporan Bulan ' . $month . "-" . $y,
            "active"        => 'laporan',
            "bulanth"       => $month . " - " . $y,
            "mkntrjl"       => Penjualan::whereMonth('created_at', $m)->whereYear('created_at', $y)->get()->sum('qty'),
            "pendapatan"    => Checkout::whereMonth('created_at', $m)->whereYear('created_at', $y)->get()->sum('total_bayar'),
            "tabelC"        => Checkout::whereMonth('created_at', $m)->whereYear('created_at', $y)->get(),
            "tabelMT"       => Penjualan::groupby('makanan_id')
                ->whereMonth('created_at', $m)->whereYear('created_at', $y)
                ->selectRaw('nama_makanan, sum(qty) as sum')
                ->get(),
        ]);
    }
    public function year(Request $request)
    {
        if ($request->get('year')) {
            $waktu = date($request->get('year'));
        } else {
            $waktu = date('Y');
        }
        return view('laporan.tahunan.tahunan', [
            "title"         => 'Laporan Tahun ' . $waktu,
            "active"        => 'laporan',
            "tahun"         => $waktu,
            "mkntrjl"       => Penjualan::whereYear('created_at', $waktu)->get()->sum('qty'),
            "pendapatan"    => Checkout::whereYear('created_at', $waktu)->get()->sum('total_bayar'),
            "tabelC"        => Checkout::whereYear('created_at', $waktu)->get(),
            "tabelMT"       => Penjualan::groupby('makanan_id')
                ->whereYear('created_at', $waktu)
                ->selectRaw('nama_makanan, sum(qty) as sum')
                ->get(),
        ]);
    }
    public function semua(Request $request)
    {
        $waktu_awal     = "";
        $waktu_akhir    = "";
        $start          = "All Time";
        $end            = "";
        $makanan        = "";
        $tableC = Checkout::get();
        $tableMT = Penjualan::groupby('makanan_id')
            ->selectRaw('nama_makanan, sum(qty) as qty, harga_makanan, sum(harga_makanan) as subtotal')
            ->get();
        $totableMT = $tableMT->sum('subtotal');
        $mkntrjl =  Penjualan::get()->sum('qty');
        $pendapatan = Checkout::get()->sum('total_bayar');
        // GET for time
        if ($request->get('waktu_awal') && $request->get('waktu_akhir')) {
            $waktu_awal = $request->get('waktu_awal');
            $waktu_akhir = $request->get('waktu_akhir');
            $start = date('d/m/Y', strtotime($waktu_awal));
            $end = date('d/m/Y', strtotime($waktu_akhir));
            $tableC = Checkout::whereBetween('created_at', [$waktu_awal, $waktu_akhir])->get();
            $pendapatan = Checkout::whereBetween('created_at', [$waktu_awal, $waktu_akhir])->get()->sum('total_bayar');
            $mkntrjl = Penjualan::whereBetween('created_at', [$waktu_awal, $waktu_akhir])->get()->sum('qty');
            $tableMT = Penjualan::whereBetween('created_at', [$waktu_awal, $waktu_akhir])
                ->groupby('makanan_id')
                ->selectRaw('nama_makanan, sum(qty) as qty, harga_makanan, sum(harga_makanan) as subtotal')
                ->get();
            $totableMT = $tableMT->sum('subtotal');
            $makanan = "Semua";
        }
        if ($request->get('waktu_awal') && $request->get('waktu_akhir') == null) {
            $waktu_awal = $request->get('waktu_awal');
            $start = date('d/m/Y', strtotime($waktu_awal));
            $tableC = Checkout::whereDate('created_at', $waktu_awal)->get();
            $pendapatan = Checkout::whereDate('created_at', $waktu_awal)->get()->sum('total_bayar');
            $mkntrjl = Penjualan::whereDate('created_at', $waktu_awal)->get()->sum('qty');
            $tableMT = Penjualan::whereDate('created_at', $waktu_awal)
                ->groupby('makanan_id')
                ->selectRaw('nama_makanan, sum(qty) as qty, harga_makanan, sum(harga_makanan) as subtotal')
                ->get();
            $totableMT = $tableMT->sum('subtotal');
            $makanan = "Semua";
        }
        if ($request->get('waktu_akhir') && $request->get('waktu_awal') == null) {
            $waktu_akhir = $request->get('waktu_akhir');
            $end = date('d/m/Y', strtotime($waktu_akhir));
            $tableC = Checkout::whereDate('created_at', $waktu_akhir)->get();
            $pendapatan = Checkout::whereDate('created_at', $waktu_akhir)->get()->sum('total_bayar');
            $mkntrjl = Penjualan::whereDate('created_at', $waktu_akhir)->get()->sum('qty');
            $tableMT = Penjualan::whereDate('created_at', $waktu_akhir)
                ->groupby('makanan_id')
                ->selectRaw('nama_makanan, sum(qty) as qty, harga_makanan, sum(harga_makanan) as subtotal')
                ->get();
            $totableMT = $tableMT->sum('subtotal');
            $makanan = "Semua";
        }
        // GET for makanan & time
        if ($request->get('makanan') && $request->get('waktu_akhir') == null && $request->get('waktu_awal') == null) {
            $makanan = $request->get('makanan');
            $tableMT = Penjualan::where('nama_makanan', $makanan)
                ->groupby('makanan_id')
                ->selectRaw('nama_makanan, sum(qty) as qty, harga_makanan, sum(harga_makanan) as subtotal')
                ->get();
            $totableMT = $tableMT->sum('subtotal');
        }
        if ($request->get('makanan') && $request->get('waktu_akhir') && $request->get('waktu_awal') == null) {
            $makanan = $request->get('makanan');
            $tableMT = Penjualan::where('nama_makanan', $makanan)
                ->whereDate('created_at', $request->get('waktu_akhir'))
                ->groupby('makanan_id')
                ->selectRaw('nama_makanan, sum(qty) as qty, harga_makanan, sum(harga_makanan) as subtotal')
                ->get();
            $totableMT = $tableMT->sum('subtotal');
        }
        if ($request->get('makanan') && $request->get('waktu_akhir') == null && $request->get('waktu_awal')) {
            $makanan = $request->get('makanan');
            $tableMT = Penjualan::where('nama_makanan', $makanan)
                ->whereDate('created_at', $request->get('waktu_awal'))
                ->groupby('makanan_id')
                ->selectRaw('nama_makanan, sum(qty) as qty, harga_makanan, sum(harga_makanan) as subtotal')
                ->get();
            $totableMT = $tableMT->sum('subtotal');
        }
        if ($request->get('makanan') && $request->get('waktu_akhir') && $request->get('waktu_awal')) {
            $makanan = $request->get('makanan');
            $tableMT = Penjualan::where('nama_makanan', $makanan)
                ->whereBetween('created_at', [$waktu_awal, $waktu_akhir])
                ->groupby('makanan_id')
                ->selectRaw('nama_makanan, sum(qty) as qty, harga_makanan, sum(harga_makanan) as subtotal')
                ->get();
            $totableMT = $tableMT->sum('subtotal');
        }
        // $penjualan = DB::table('penjualans')
        //     ->join('checkouts', 'penjualans.checkout_id', '=', 'checkouts.id')
        //     ->select('checkouts.no_pesanan', 'checkouts.user', 'penjualans.nama_makanan', 'penjualans.qty');

        return view('laporan.semua', [
            "title"         => 'Laporan',
            "active"        => 'laporan',
            "tabelC"        => $tableC,
            "pendapatan"    => $pendapatan,
            "mkntrjl"       => $mkntrjl,
            "tabelMT"       => $tableMT,
            "totableMT"     => $totableMT,
            "start"         => $start,
            "end"           => $end,
            "mkn"       => $makanan
        ]);
    }
}
// $penjualan->groupby('makanan_id')
//                 ->whereBetween('penjualans.created_at', [$waktu_awal, $waktu_akhir])
//                 ->where('penjualans.nama_makanan', $makanan)
//                 ->selectRaw('nama_makanan, sum(qty) as qty, sum(harga_makanan) as harga_makanan, harga_makanan*qty as subtotal')
//                 ->get(),