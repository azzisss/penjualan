@extends('layout.main')

@section('mainkonten')
 <div class="container-fluid px-4 py-4 ">
   <div class="row justify-content-center">
     <div class="col-8">
       <div class="card">
         <h5 class="card-header">Bukti Pembayaran</h5>
         <div class="text-center">
           <img src="{{ asset('/img/logo.png') }}" class="rounded my-1" style="height: 8em; width:10em;" alt="...">
         </div>
         <p class="text-center"><strong>Rumah Makan Jago Sore</strong><br>Jl. Nasional 16 RT 1/3 Bangak Bantan Banyudono Boyolali Jawa Tengah 57373</p>
         <hr>
         <div class="card-body">
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
				 <div class="text-center">
					<div class="d-grid gap-2">
						<a class="btn btn-success" href="javascript:history.go(-1)">
							<span style="width: 24px; height: 24px;" ><i class="bi bi-arrow-90deg-left"></i></span> Back
						</a>
					</div>
				 </div>
				</div>
			</div>
		</div>
   </div>
 </div>

@endsection