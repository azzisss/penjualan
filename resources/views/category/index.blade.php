	@extends('layout.main')

	@section('mainkonten')
	<div class="container-fluid px-4">
		<h1 class="mt-4">Kategori Makanan</h1>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item active">Kategori</li>
			</ol>
      <hr>
		@if (session()->has('berhasil'))
			<div class="alert alert-success alert-dismissible fade show text-capitalize text-center fw-semibold fs-6 mt-2"
				role="alert">
				{{ session('berhasil') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		<div class="card my-4">
			<div class="fs-6">
				<div class="card-header text-center">
					<h5>Data Kategori Makanan</h5>
				</div>
				<div class="card-body">
					<div class="row justify-content-start">
					<div class="col-sm-7">
						<a href="/category/create" class="btn btn-success mb-2"> Tambah Data Kategori </a>
					</div>
					<div class="col-sm-3">
						<div class="mb-sm-3">
							<form action="/category" method="get">
								<div class="input-group mb-3">
									<input type="text" class="form-control" placeholder="Search.." name="search"
									value="{{ request('search') }}">
									<button class="btn btn-outline-primary border" type="submit">Search</button>
								</div>
							</form>
						</div>
					</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered" id="example">
							<thead>
								<tr>
									<th scope="col" class="no text-center">
										No
									</th>
									<th scope="col">
										Nama Kategori
									</th>
									<th scope="col" class="text-center">Action</th>
								</tr>
							</thead>
							<tbody class="table-group-divider">
								@foreach ($categories as $item)
									<tr>
										<th scope="row" class="no text-center">{{ $loop->iteration }}</th>
										<td>{{ $item->nama_category }}</td>
										<td class="text-center">
											<a href="/category/{{ $item->id }}/edit" class="btn btn-warning btn-sm  mx-1 my-0.5">
											<i class="bi bi-pencil-square fs-6"></i>
											</a>
											<form action="/category/{{ $item->id }}" method="post" class="d-inline">
											@method('delete')
											@csrf
											<button class="btn btn-danger  btn-sm mx-1 my-0.5 border-0"
												onclick="return confirm('Yakin Akan di Hapus?')">
												<i class="bi bi-trash-fill fs-6"></i>
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
