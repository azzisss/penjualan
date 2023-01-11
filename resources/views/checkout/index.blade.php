@extends('layout.main')

@section('mainkonten')
<div class="container-fluid px-4  py-4 ">
  <div class="row justify-content-center">
    <div class="col-sm-8">
      <div class="card">
          <div id="print1">
            <h5 class="card-header text-center">Bukti Pembayaran</h5>
          </div>
          <div class="text-center">
            <img src="{{ asset('/img/logo.png') }}" class="rounded my-1" style="height: 8em; width:10em;" alt="...">
          </div>
          <div id="print2">

          <p class="text-center"><strong>Rumah Makan Jago Sore</strong><br>Jl. Nasional 16 RT 1/3 Bangak Bantan Banyudono Boyolali Jawa Tengah 57373</p>
          <hr>
          <div class="card-body">
            {{-- <h5 class="card-title">Special title treatment</h5> --}}
            <div class="row">
              <div class="col-sm-8">
                <table class="card-text fw-normal fs-6">
                  <tr>
                    <td>Tanggal Transaksi</td>
                    <td class="px-sm-3">:</td>
                    <td class="pe-sm-5">{{ $tgl }}</td>
                  </tr>
                  <tr>
                    <td>Nomer Transaksi</td>
                    <td class="px-sm-3">:</td>
                    <td>{{ $no_pesanan }}</td>
                  </tr>
                  <tr>
                    <td>Operator</td>
                    <td class="px-sm-3">:</td>
                    <td>{{ $nama_user }}</td>
                  </tr>
                </table>
              </div>
              <div class="col-sm-4 justify-content-center">
                Nomer Meja  :
                <div class="text-center fs-3 fw-normal" style="border: 1px solid black; max-width: 60px;">{{ $no_meja }}</div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-condensed">
                <thead>
                    <tr class="table-active">
                        <th class="text-center" style="width: 50%; border-bottom: 2px solid rgba(221, 221, 221, 0.719);">Nama makanan</th>
                        <th class="text-center" style="width: 12%; border-bottom: 2px solid #ddd;">Jumlah</th>
                        <th class="text-center" style="width: 24%; border-bottom: 2px solid #ddd;">Harga</th>
                        <th class="text-center" style="width: 26%; border-bottom: 2px solid #ddd;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemorder as $item)
                    <tr>
                        <td>{{ $item->nama_makanan }}</td>
                        <td style="text-align:center;">{{ $item->qty }}</td>
                        <td class="text-center">Rp.{{ $item->harga_makanan }}</td>
                        <td class="text-right">Rp.{{ $item->subtotal }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                  <tr>
                      <th colspan="2">Total</th>
                      <th colspan="2" class="text-right">Rp.{{ number_format($total_harga) }} </th>
                  </tr>
                  <tr>
                      <th colspan="2">Diskon</th>
                      <th colspan="2" class="text-right">{{ $diskon }}%</th>
                  </tr>
                  <tr>
                      <th colspan="2">Tunai</th>
                      <th colspan="2" class="text-right">Rp.{{ number_format($tunai) }} </th>
                  </tr>
                  <tr>
                      <th colspan="2">Kembali</th>
                      <th colspan="2" class="text-right">Rp.{{ number_format($kembali) }} </th>
                  </tr>
                </tfoot>
            </table>
            </div>
          </div>
        </div>
      </div>
      <div id="buttonprint" class="btn d-flex justify-content-center mb-2">
        <a href="/" class="btn btn-primary me-2">Kembali</a>
        <button onclick="print();" class="btn btn-warning text-white me-2">Print Bukti Pembayaran</button>
        <button onclick="invoicetab()" class="btn btn-success text-white">Tampilkan di Tab Baru</button>
        {{-- <form action="/print" method="get">
          <button class="btn btn-warning text-white">Print Bukti Pembayaran</button>
        </form> --}}
      </div>
    </div>
  </div>
</div>
<div id="head">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    {{-- Data tables --}}
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap5.min.css">
    
    
    {{-- end datatables --}}
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
  </head>
</div>

<script>
  function print() {
  var mywindow = window.open('actual');

  mywindow.document.write("<head><style> h1,p { text-align:center; } </style><head>");
  mywindow.document.write("<h1>Bukti Pembayaran</h1>\
  <p><strong>Rumah Makan Jago Sore</strong><br>Jl. Nasional 16 RT 1/3 Bangak Bantan Banyudono Boyolali Jawa Tengah 57373</p>\
                <table>\
                  <tr>\
                    <td>Tanggal Transaksi</td>\
                    <td >:</td>\
                    <td >{{ $tgl }}</td>\
                  </tr>\
                  <tr>\
                    <td>Nomer Transaksi</td>\
                    <td >:</td>\
                    <td>{{ $no_pesanan }}</td>\
                  </tr>\
                  <tr>\
                    <td>Operator</td>\
                    <td >:</td>\
                    <td>{{ $nama_user }}</td>\
                  </tr>\
                    <td>Nomer Meja</td>\
                    <td >:</td>\
                    <td>{{ $no_meja }}</td>\
                  </tr>\
                    </table>\
                  <table>\
                    <thead>\
                      <tr>\
                        <th style='width: 50%; border-bottom: 2px solid rgba(221, 221, 221, 0.719);'>Nama makanan</th>\
                        <th style='width: 12%; border-bottom: 2px solid #ddd;'>Jumlah</th>\
                        <th style='width: 24%; border-bottom: 2px solid #ddd;'>Harga</th>\
                        <th style='width: 26%; border-bottom: 2px solid #ddd;'>Subtotal</th>\
                      </tr>\
                    </thead>\
                    <tbody>\
                    @foreach ($itemorder as $item)\
                    <tr>\
                        <td>{{ $item->nama_makanan }}</td>\
                        <td >{{ $item->qty }}</td>\
                        <td >Rp.{{ $item->harga_makanan }}</td>\
                        <td >Rp.{{ $item->subtotal }}</td>\
                    </tr>\
                    @endforeach\
                </tbody>\
                <tfoot>\
                  <tr>\
                      <th></th>\
                      <th colspan='2'style='text-align:left;'>Total</th>\
                      <th tyle='text-align:left;'>Rp.{{ number_format($total_harga) }} </th>\
                  </tr>\
                  <tr>\
                      <th></th>\
                      <th colspan='2'style='text-align:left;'>Diskon</th>\
                      <th style='text-align:left;'>{{ $diskon }}%</th>\
                  </tr>\
                  <tr>\
                      <th></th>\
                      <th colspan='2'style='text-align:left;'>Tunai</th>\
                      <th style='text-align:left;'>Rp.{{ number_format($tunai) }} </th>\
                  </tr>\
                  <tr>\
                      <th></th>\
                      <th colspan='2'style='text-align:left;'>Kembali</th>\
                      <th style='text-align:left;'>Rp.{{ number_format($kembali) }} </th>\
                  </tr>\
                </tfoot>\
                  </table>\
                  <h1>Terimakasih</h1>");
  mywindow.focus();
  mywindow.print();
  mywindow.close(); 

}
function invoicetab(){
  var mywindow = window.open('actual');

  mywindow.document.write($('#head').html());
  mywindow.document.write("<div class='container-fluid px-4  py-4 '><div class='row justify-content-center'><div class='col-sm-8'>");
  mywindow.document.write($('#print1').html());
  mywindow.document.write($('#print2').html());
  mywindow.document.write("</div></div></div>");
  mywindow.document.close(); // necessary for IE >= 10
  mywindow.document.focus(); // necessary for IE >= 10*/

}
</script>
@endsection