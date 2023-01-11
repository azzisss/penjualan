@extends('layout.main')

@section('mainkonten')
<div class="container-fluid px-4 mt-4">
	<h1 class="">Makanan</h1>
		<ol class="breadcrumb mb-2 ">
			<li class="breadcrumb-item active">Makanan</li>
		</ol>
		<hr>
	@if( session()->has('berhasil'))
	<div class="alert alert-success alert-dismissible fade show text-capitalize text-center fw-semibold fs-6 mt-2" role="alert">
		{{ session('berhasil') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@elseif(session()->has('hapus'))
	<div class="alert alert-danger alert-dismissible fade show text-capitalize text-center fw-semibold fs-6 mt-2" role="alert">
		{{ session('hapus') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@elseif(session()->has('update'))
	<div class="alert alert-warning alert-dismissible fade show text-capitalize text-center fw-semibold fs-6 mt-2" role="alert">
		{{ session('update') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif 
	<div class="card my-4">
		<div class="fs-6">
			<div class="card-header text-center">
				<h5>Data Makanan</h5>
			</div>
			<div class="card-body">
				<div class="row justify-content-start">
					<div class="col-sm-3">
						<a href="/makanan/create" class="btn btn-success mb-2"> Tambah Data Makanan </a>
					</div>
					<div class="col-sm-3">
						<form action="/makanan" method="get">	
							<div class="input-group mb-3">
								<select class="form-select" id="category" name="category">
									<option value="" selected> Semua Kategori</option>
										@foreach ($categories as $category)
											<option value="{{ $category->nama_category }}"> {{ $category->nama_category }}</option>
										@endforeach
								</select>
									<button class="btn btn-outline-primary border" type="submit">Pilih</button>
								</div>
							</form>
					</div>
					<div class="col-sm-3">
						<div class="mb-3">
							<form action="/makanan" method="get">			
										<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}" >
								<button class="btn btn-outline-primary border" type="submit">Search</button>
										</div>
								</form>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table id='example' class="table table-bordered" >
						<thead>
							<tr>
								<th scope="col" class="no text-center">
									No
								</th>
								<th scope="col" class="text-center">Gambar</th>
							<th scope="col" >
								Nama Makanan						
							</th>
							<th scope="col" class="text-center">Keterangan</th>
							<th scope="col" class="text-center">Harga</th>
							<th scope="col" class="text-center">Kategori</th>
							<th scope="col" class="text-center">Action</th>
								</tr>
						</thead>
						<tbody class="table-group-divider">
							@foreach ($makanans as $makanan)
							<tr>
										<th scope="row" class="no text-center">{{ $loop->iteration }}</th>
										<td class="text-center">
											@if ($makanan->gambar)
											<img src="{{ asset('storage/'. $makanan->gambar) }}" alt="" style="cursor: pointer;" data-bs-toggle="modal" href="#exampleModalToggle{{ $col++ }}" class="img-fluid" height="40" width="50">
											<div class="modal fade" id="exampleModalToggle{{ $col2++ }}" aria-hidden="true"  tabindex="-1">
												<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
																<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalToggleLabel">{{ $makanan->nama_makanan }}</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<div class="modal-body">
																	<img src="{{ asset('storage/'. $makanan->gambar) }}" class="img-fluid" >
																</div>
																<div class="modal-footer">
																</div>
														</div>
												</div>
											</div>
											@else
											@endif
										</td>
										<td >{{ $makanan->nama_makanan }}</td>
										<td >{{ $makanan->keterangan_makanan }}</td>
										<td > Rp. {{ $makanan->harga_makanan }}</td>
								@foreach ($categories as $category)
									@if ($makanan->category_id==$category->id) 
										<td >{{ $category->nama_category }}</td>
									@endif 
								@endforeach
									<td class="text-center">
									<a href="/makanan/{{ $makanan->id }}/edit" class="btn btn-warning btn-sm mx-1 my-0.5">
										<i class="bi bi-pencil-square fs-6"></i>
									</a>
									<form action="/makanan/{{ $makanan->id }}" method="post" class="d-inline">
									@method('delete')
									@csrf
									<button class="btn btn-danger btn-sm mx-1 my-0.5 border-0" onclick="return confirm('Yakin Akan di Hapus?')" >
										<i class="bi bi-trash-fill fs-6" ></i>
									</button>
								</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function () {
					$('#example').DataTable({
						searching: false,
					});
	});
	</script>
@endsection



