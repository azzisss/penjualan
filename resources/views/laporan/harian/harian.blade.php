@extends('layout.main')

@section('mainkonten')
<div class="container-fluid px-4">
	<h1 class="mt-4">Laporan Harian</h1>
	<ol class="breadcrumb mb-4">
		 <li class="breadcrumb-item"><a href="/laporan">Laporan</a> </li>
		 <li class="breadcrumb-item active" aria-current="page">Laporan Harian</li>
	</ol>
	<div class="row mb-3 justify-content-center">
		<div class=" col-sm-3">
			<div class="card border-secondary mb-2" style="height: 6.5em">
				<div class="card-header bg-secondary text-white">
					Hari / Tanggal
				</div>
				<div class="card-body">
					<h6 class="text-center">{{ $hariini }}</h6>
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
					<h5 >Laporan Harian</h5>
				</div>
				<div class="card-body">
					@php
						use App\Models\Checkout;
						// Set your timezone
						date_default_timezone_set('Asia/Jakarta');

						// Get prev & next month
						if (isset($_GET['ym'])) {
								$ym = $_GET['ym'];
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
						$today = date('Y-m-j', time());

						// For H3 title
						$month = date('F - Y', $timestamp);

      // Untuk link
      $m = date('Y-m',$timestamp);
						
						// You can also use strtotime!
						$prev = date('Y-m', strtotime('-1 month', $timestamp));
						$next = date('Y-m', strtotime('+1 month', $timestamp));

						// Number of days in the month
						$day_count = date('t', $timestamp);
						
						// 0:Sun 1:Mon 2:Tue ...
						$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
						//$str = date('w', $timestamp);

      
						// Create Calendar!!
						$weeks = array();
						$week = '';

						// Add empty cell
						$week .= str_repeat('<td></td>', $str);

						for ( $day = 1; $day <= $day_count; $day++, $str++) {
								
								$date = $ym . '-' . $day;
								
								if ($today == $date) {
         $week .=
         "<td id='hri' class=' bg-danger fs-6 bg-opacity-25'>"."<a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;' href='harian?day=$m-$day'>". $day. 
          '<br> <b>' . 'Rp ' . number_format(Checkout::whereDate('created_at', $date )->get()->sum('total_bayar'),0,",",".")."</a>";
								} else {
										$week .= 
          "<td id='hri' style='cursor:pointer; '>"."<a class='text-black' style='font-weight:500; cursor:pointer; text-decoration:none;' href='harian?day=$m-$day'>". $day . 
           '<br> <b>' . 'Rp ' . number_format(Checkout::whereDate('created_at', $date )->get()->sum('total_bayar'),0,",",".").
            "</a>";
								}
								$week .= '</td>';
								// "<form action='/laporan/harian' method='get'>".
        //    "<input name='day' type='hidden' value='$m-$day'>".
        //    "<button  type='show more'> submit </button>".
        //    "</form>"
								// End of the week OR End of the month
								if ($str % 7 == 6 || $day == $day_count) {

										if ($day == $day_count) {
												// Add empty cell
												$week .= str_repeat('<td></td>', 6 - ($str % 7));
										}

										$weeks[] = '<tr>' . $week . '</tr>';

										// Prepare for new week
										$week = '';
								}

						}		
					@endphp
					<div class="text-center">
						<div class="d-flex justify-content-evenly">
							<h3><a class="btn btn-primary" href="?ym={{ $prev }}"><<</a></h3>
							<h3>{{ $month }}</h3>
							<h3><a class="btn btn-primary" href="?ym={{ $next }}">>></a></h3>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-success">
							<thead>
								<th>Ahad</th>
								<th>Senin</th>
								<th>Selasa</th>
								<th>Rabu</th>
								<th>Kamis</th>
								<th>Jumat</th>
								<th>Sabtu</th>
							</thead>
							<tbody class="text-center">
								@php
									foreach ($weeks as $week) {
										echo $week;
									}
								@endphp
							</tbody>
						</table>
      <i>*klik tanggal tertentu untuk memilih hari</i>
      
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-3 justify-content-center">
		<div class="col-sm-10">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title text-center" >Laporan Penjualan {{ $hariini }}</h5>
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
					<h5 class="card-title text-center" >Makanan Terjual {{ $hariini }}</h5>
				</div>
				<div class="card-body">
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
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
	$(document).ready(function () {
    $('#example2').DataTable();
});
}
</script>

@endsection