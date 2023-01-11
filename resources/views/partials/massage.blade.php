@if( session()->has('berhasil'))
	<div class="alert alert-success alert-dismissible fade show text-capitalize text-center fw-semibold fs-6 mt-2" role="alert">
				{{ session('berhasil') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
@elseif(session()->has('hapus'))
	<div class="alert alert-danger alert-dismissible fade show text-capitalize text-center fw-semibold fs-6 mt-2" role="alert">
		{{ session('hapus') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
@elseif(session()->has('update'))
	<div class="alert alert-warning alert-dismissible fade show text-capitalize text-center fw-semibold fs-6 mt-2" role="alert">
		{{ session('update') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
@endif 