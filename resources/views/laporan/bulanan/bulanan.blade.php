@extends('layout.main')

@section('mainkonten')
<div class="container-fluid px-4">
	<h1 class="mt-4">Laporan Bulanan</h1>
	<ol class="breadcrumb mb-4">
		 <li class="breadcrumb-item"><a href="/laporan">Laporan</a> </li>
		 <li class="breadcrumb-item active" aria-current="page">Laporan Bulanan</li>
	</ol>
	<div class="row mb-3 justify-content-center">
		<div class=" col-sm-3">
			<div class="card border-secondary mb-2" style="height: 6.5em">
				<div class="card-header bg-secondary text-white">
					Bulan / Tahun
				</div>
				<div class="card-body">
					<h5 class="text-center">{{ $bulanth }}</h5>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card border-primary mb-2" style="height: 6.5em">
				<div class="card-header bg-primary text-white">
					Makanan Terjual
				</div>
				<div class="card-body">
					<h5 class="card-title text-center" >{{ $mkntrjl }} Makanan</h5>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card border-success mb-2" style="height: 6.5em">
				<div class="card-header bg-success text-white">
					Pendapatan
				</div>
				<div class="card-body">
					<h5 class="card-title text-center">Rp. {{ number_format($pendapatan,2,",",".") }}</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-3 justify-content-center">
		{{-- <div class="col-sm-3">
			<div class="card">
				<div class="card-header">Filter Hari</div>
				<div class="card-body">
					<form action="/pilihbulan" method="post">
						@csrf									
						<div class="input-group mb-3">
							<input type="month" name="month" id="month" class="form-control" value="{{ $valmonth }}">
							<button class="btn btn-primary" type="submit" >Pilih</button>
						</div>
						<div class="justify-content-center">
							@foreach ($hari as $item)
									<a href="/pilihhari"><input type="" class="btn btn-outline-primary mx-1 my-1 {{ ($dayactive == $item AND date('Y-m') == $valmonth) ? 'active' : '' }}" style="height: 38px; width:43px;" value="{{ $item }}"></a>
							@endforeach
						</div>
					</form>
				</div>
			</div>
		</div> --}}
		<div class="col-sm-10">
			<div class="card">
				<div class="card-header text-center">
					<h5 >Laporan Bulanan</h5>
				</div>
				<div class="card-body">
					@php
						use App\Models\Checkout;
						// Set your timezone
						date_default_timezone_set('Asia/Jakarta');

						// Get prev & next month
						if (isset($_GET['month'])) {
								$ym = $_GET['month'];
						} else {
								// This month
								$ym = date('Y-m');
						}

						// Check format
						$timestamp = strtotime($ym . '-01');
						if ($timestamp === false) {
								$ym = date('Y-m');
								$timestamp = strtotime($ym . '-01');
						}

						// Today
						$thismonth = date('m-Y', time());

						// For H3 title
						$month = date('F - Y', $timestamp);

      $year = date('Y', $timestamp);

      // Untuk link
      $m = date('m',$timestamp);
						
						// You can also use strtotime!
						$prev = date('Y', strtotime('-1 year', $timestamp));
						$next = date('Y', strtotime('+1 year', $timestamp));

						// Number of days in the month

						
					@endphp
					<div class="text-center">
						<div class="d-flex justify-content-evenly">
							<h3><a class="btn btn-primary" href="?month={{ $prev }}"><<</a></h3>
							<h3>{{ $year }}</h3>
							<h3><a class="btn btn-primary" href="?month={{ $next }}">>></a></h3>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-success">
							<thead>
							</thead>
							<tbody class="text-center">
        <tr>
         <td id="bln" style="font-weight: 500" class=" @php if( '1-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} @endphp">
          <a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-1">Januari
           <br>Rp {{ number_format(Checkout::whereMonth('created_at', '1' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".")}}
          </a>
         </td>
         <td id="bln" style="font-weight: 500" class=" @php if( '2-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} @endphp">
          <a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-2"> Februari
           <br> Rp {{ number_format(Checkout::whereMonth('created_at', '2' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".");}}
          </a>
         </td>
         <td id="bln" style="font-weight: 500" class=" @php if('3-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} 
         @endphp">
         <a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-3"> Maret <br>Rp {{ number_format(Checkout::whereMonth('created_at', '3' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".");}}</a></td>
         <td id="bln" style="font-weight: 500" class=" @php if('4-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} @endphp"><a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-4">April <br> Rp {{ number_format(Checkout::whereMonth('created_at', '4' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".");}}</a></td>
        </tr>
        <tr>
         <td id="bln" style="font-weight: 500" class=" @php if('5-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} @endphp">
          <a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-5">Mei <br>Rp {{ number_format(Checkout::whereMonth('created_at', '5' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".");}}</a></td>
         <td id="bln" style="font-weight: 500" class=" @php if('6-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} @endphp">
          <a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-6">Juni Rp <br>{{ number_format(Checkout::whereMonth('created_at', '6' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".");}}</a></td>
         <td id="bln" style="font-weight: 500" class=" @php if('7-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} @endphp">
          <a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-7">Juli Rp <br>{{ number_format(Checkout::whereMonth('created_at', '7' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".");}}</a></td>
         <td id="bln" style="font-weight: 500" class=" @php if('8-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} @endphp">
          <a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-8">Agustus <br> Rp {{ number_format(Checkout::whereMonth('created_at', '8' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".");}}</a></td>
        </tr>
         <tr>
         <td id="bln" style="font-weight: 500" class=" @php if('9-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} @endphp">
          <a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-9">September <br>Rp {{ number_format(Checkout::whereMonth('created_at', '9' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".");}}</a></td>
         <td id="bln" style="font-weight: 500" class=" @php if( '10-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} @endphp">
          <a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-10">Oktober <br>Rp {{ number_format(Checkout::whereMonth('created_at', '10' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".");}}</a></td>
         <td id="bln" style="font-weight: 500" class=" @php if( '11-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} @endphp">
          <a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-11">November <br>Rp {{ number_format(Checkout::whereMonth('created_at', '11' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".");}}</a></td>
         <td id="bln" style="font-weight: 500" class=" @php if( '12-'.$year == $thismonth  ){echo "bg-danger fs-6 bg-opacity-25";} @endphp">
          <a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;'href="bulanan?month={{ $year }}-12">Desember <br>Rp {{ number_format(Checkout::whereMonth('created_at', '12' )->whereYear('created_at', $year)->get()->sum('total_bayar'),0,",",".");}}</a></td>
        </tr>
							</tbody>
						</table>
      <i>*klik bulan tertentu untuk memilih bulan</i>
      
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-3 justify-content-center">
		<div class="col-sm-10">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title text-center" >Laporan Penjualan Bulan {{ $bulanth }}</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-hover" style="width:100%">
							<thead>
								<tr>
										<th>No</th>
										<th>No Pesanan</th>
										<th>User</th>
										<th>Total Harga</th>
										<th>Diskon</th>
										<th>Total Bayar</th>
										<th>Tunai</th>
										<th>Kembali</th>
										<th>Waktu</th>
										<th>Detail</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($tabelC as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $item->no_pesanan }}</td>
									<td>{{ $item->user }}</td>
									<td>Rp. {{ number_format($item->total_harga) }}</td>
									<td>{{ $item->diskon }} %</td>
									<td>Rp. {{ number_format($item->total_bayar) }}</td>
									<td>Rp. {{ number_format($item->tunai)}}</td>
									<td>Rp. {{ number_format($item->kembali) }}</td>
									<td>{{ $item->created_at }}</td>
									<td>
										<a href="/show/{{ $item->id }}" class="badge bg-info mx-1 my-0.5">
											<i class="bi bi-eye fs-6"></i>
									</a></td>
								</tr>
								@endforeach
							</tbody>
							
						</table>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-3 justify-content-center">
		<div class="col-sm-10">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title text-center">Makanan Terjual Bulan {{ $bulanth }}</h5>
				</div>
				<div class="card-body ">
					<div class="table-responsive">
						<table id="example2" class="table table-hover" style="width:100%">
							<thead>
									<tr>
											<th>No</th>
											<th>Nama Makanan</th>
											<th>Terjual</th>
									</tr>
							</thead>
							<tbody>
								@foreach ($tabelMT as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $item->nama_makanan }}</td>
									<td>{{ $item->sum }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	
$(document).ready(function() {
    table1();
				table2();
} );
function table1() {
	var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf','print' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
}
function table2() {
	$('#example2').DataTable();
}
</script>

@endsection