	@extends('layout.main')
	@section('mainkonten')
	<div class="container-fluid px-4 mt-4">
		<h1 class="">Kategori Makanan</h1>
			<ol class="breadcrumb mb-2 ">
				<li class="breadcrumb-item"> <a href="/category">Kategori</a></li>
				<li class="breadcrumb-item active">Edit</li>
			</ol>
			<hr>
		<div class="row">
			<div
				class="d-flex justify-content-evenly flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 ">
				<h1 style="text-transform:capitalize" class="h2">Edit Kategori</h1>
			</div>
			<div class="d-flex justify-content-center">
				<div class="col-lg-8">

					<form method="post" action="/category/{{ $category->id }}">
					@method('put')
					@csrf
					<label for="nama_category" class="form-label ms-3">Nama Kategori</label>
					<div class="input-group mb-3 ms-3">
						<input type="text" class="form-control @error('nama_category') is-invalid @enderror"
							id="nama_category" name="nama_category" required
							value="{{ old('nama_category', $category->nama_category) }}">
						<button type="submit" id="button-addon2" class="btn btn-primary">Update Kategori</button>

						@error('nama_category')
							<div class="invalid-feedback" id="nama_category">
								{{ $message }}
							</div>
						@enderror
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- <script>
		const title = document.querySelector('#title');
		const slug = document.querySelector('#slug');

		title.addEventListener('change', function() {
			fetch('/dashboard/posts/checkSlug?title=' + title.value)
				.then(response => response.json())
				.then(data => slug.value = data.slug)
		});

		document.addEventListener('trix-file-accept', function(e) {
			e.preventDefault();
		})
	</script> --}}
	@endsection
