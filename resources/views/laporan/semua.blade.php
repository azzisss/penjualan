@extends('layout.main')

@section('mainkonten')
<div class="container-fluid px-4">
	<h1 class="mt-4">Laporan Acak</h1>
	<ol class="breadcrumb mb-4">
		 <li class="breadcrumb-item"><a href="/laporan">Laporan</a> </li>
		 <li class="breadcrumb-item active" aria-current="page">Laporan Acak</li>
	</ol>
	<div class="row mb-2 justify-content-center">
		<div class="col-sm-3">
			<div class="card border-secondary my-2" style="height: 6.5em">
				<div class="card-header bg-secondary text-white">
					Waktu
				</div>
				<div class="card-body">
					@isset($_GET['waktu_awal'],$_GET['waktu_akhir'])
						<h6 class='text-center'>{{ $start.' - '.$end }}</h6>
					@endisset
					<?php if(isset($_GET['waktu_awal'],$_GET['waktu_akhir'])): null ?>

					<?php endif; ?>
					<?php if(!isset($_GET['waktu_awal'],$_GET['waktu_akhir'])): ?>

					<h6 class='text-center'> All Time </h6>

					<?php endif; ?>
					
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card border-primary my-2" style="height: 6.5em">
				<div class="card-header bg-primary text-white">
					Makanan Terjual
				</div>
				<div class="card-body">
					<h5 class="card-title text-center" >{{ $mkntrjl }} Makanan</h5>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card border-success my-2" style="height: 6.5em">
				<div class="card-header bg-success text-white">
					Pendapatan Penjualan
				</div>
				<div class="card-body">
					<h5 class="card-title text-center">Rp. {{ number_format($pendapatan,2,",",".") }}</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-2 justify-content-start md-lg-xl-ms-5">
		<div class="col-sm-6">
			<span class="badge bg-secondary rounded-0"><h4 class="mb-0" >Filter</h4></span>
			<div class="card my-2">
				<div class="card-body">
					<form action="/laporan/semua" method="get">
						<div class="input-group mb-3">
							<span class="input-group-text">Waktu </span>
								<input type="date" name="waktu_awal" id="waktu_awal" value="{{ request('waktu_awal') }}" class="form-control"  >
							<span class="input-group-text">-</span>
								<input type="date" name="waktu_akhir" id="waktu_akhir" value="{{ request('waktu_akhir') }}" class="form-control" >
						</div>
						<div class="input-group mb-3">
							@php
											use App\Models\Makanan;
											$makanan = Makanan::get();
							@endphp
							<span class="input-group-text">Makanan</span>
							<select class="form-select" aria-label="Default select example" name="makanan" id="makanan" value="{{ request('makanan') }}">
									<option value="">Semua</option>
								@foreach ($makanan as $makanan)
									@if(request('makanan')==$makanan->nama_makanan)
									<option value="{{ $makanan->nama_makanan}}" selected> {{ $makanan->nama_makanan }}</option>
									@else
									<option value="{{ $makanan->nama_makanan }}"> {{ $makanan->nama_makanan }}</option>
									@endif
							@endforeach
							</select>
						</div>
						<div class="text-end">
							<button type="button" class="btn btn-danger" onclick="ClearFilter();">Clear</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row justify-content-start md-lg-xl-mx-5">
		<div class="col-sm-12">
			<span class="badge rounded-0" style="background-color: #fd7e14 "><h4 class="mb-0" >Laporan Penjualan @php
				if($start && $end){
					echo $start.' - '.$end;
				}
				if(! $end){
					echo $start;
				}
				if(! $start){
					echo $end;
				}
			@endphp</h4></span>
			
			<div class="card my-2">
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped" style="width:100%">
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
	<div class="row justify-content-start md-lg-xl-mx-5">
		<div class="col-sm-12">
			<span class="badge rounded-0" style="background-color: #fd7e14"><h4 class="mb-0">Laporan {{ $mkn }} Makanan Terjual @php
				if($start && $end){
					echo $start.' - '.$end;
				}
				if(! $end){
					echo $start;
				}
				if(! $start){
					echo $end;
				}
			@endphp</h4></span>
			<div class="card my-2">
				<div class="card-body">
					<div class="table-responsive">
						<table id="example2" class="table table-hover" style="width:100%">
							<thead>
									<tr>
											<th>No</th>
											<th>Nama Makanan</th>
											<th>Harga</th>
											<th>Terjual</th>
											<th>Total</th>
									</tr>
							</thead>
							<tbody>
								@foreach ($tabelMT as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $item->nama_makanan }}</td>
									<td>{{ $item->harga_makanan }}</td>
									<td>{{ $item->qty }}</td>
									<td>{{ $item->subtotal }}</td>
								</tr>
								@endforeach
								{{-- <tr>
									<td></td>
									<td></td>
									<td></td>
									<th>Total : {{ $totableMT }}</th>
								</tr> --}}
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function () {
    tabel1();
				tabel2();
});
function tabel1() {
	$('#example').DataTable();
}
function tabel2() {
	$('#example2').DataTable();
}
function ClearFilter() {
	$('#waktu_awal').val("");
	$('#waktu_akhir').val("");
}
</script>
@endsection