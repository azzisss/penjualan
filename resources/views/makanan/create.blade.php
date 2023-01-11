@extends('layout.main')

@section('mainkonten')

<div class="container-fluid px-4 mt-4">
	<h1 class="">Makanan</h1>
	{{-- @if (count($errors) > 0)
	<div class="alert alert-danger">
									@foreach ($errors->all() as $error)
													{{ $error }}
									@endforeach
	</div>
		@endif --}}
		<ol class="breadcrumb mb-2 ">
			<li class="breadcrumb-item"> <a href="/makanan">Makanan</a></li>
			<li class="breadcrumb-item active">Tambah Makanan</li>
		</ol>
		<hr>
	<div class="row">
		<div class="d-flex justify-content-evenly flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
			<h3 style="text-transform:capitalize" class="h4">Tambah Makanan Baru</h3>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-8">
				<form method="post" action="/makanan" enctype="multipart/form-data">
					@csrf
					<div class="mb-3">
						<label for="nama_makanan" class="form-label">Nama Makanan</label>
						<input type="text" class="form-control @error('nama_makanan') is-invalid @enderror" id="nama_makanan" name="nama_makanan" required value="{{ old('nama_makanan') }}" autocomplete="off">

						@error('nama_makanan')
						<div class="invalid-feedback" id="nama_makanan">
							{{ $message }}
						</div>
						@enderror

					</div>
					<div class="mb-3">
						<label for="keterangan_makanan" class="form-label">Keterangan Makanan</label>
						<input type="text" class="form-control @error('keterangan_makanan') is-invalid @enderror" id="keterangan_makanan" name="keterangan_makanan" required value="{{ old('keterangan_makanan') }}">

						@error('keterangan_makanan')
						<div class="invalid-feedback" id="keterangan_makanan">
							{{ $message }}
						</div>
						@enderror

					</div>

					<div class="mb-3">
						<label for="category_id" class="form-label" aria-label="Default select example">Kategori</label>
						<select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" >
							<option value="" selected> Pilih Kategori</option>
							@foreach ($categories as $category)
								@if(old('category_id')==$category->id)
									<option value="{{ $category->id}}" selected> {{ $category->nama_category }}</option>
								@else
									<option value="{{ $category->id }}"> {{ $category->nama_category }}</option>
								@endif
							@endforeach
						</select>
						@error('category_id')
						<div class="invalid-feedback" id="category_id">
							{{ "The Category field is required." }}
						</div>
						@enderror
					</div>
					<label for="harga_makanan" class="form-label">Harga Makanan</label>
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">Rp.</span>
						<input type="number" min="0" oninput="this.value = Math.abs(this.value)" class="form-control @error('harga_makanan') is-invalid @enderror" id="harga_makanan" name="harga_makanan" required value="{{ old('harga_makanan') }}">

						@error('harga_makanan')
						<div class="invalid-feedback" id="harga_makanan">
							{{ $message }}
						</div>
						@enderror

					</div>

					<div class="mb-3">
						<label for="gambar" class="form-label @error('gambar') is-invalid @enderror">Gambar Makanan</label>
						<img class="img-preview img-fluid col-sm-5 mb-3">
						<input class="form-control" type="file" id="gambar" name="gambar" onchange="previewImage()">

						@error('gambar')
						<div class="invalid-feedback" id="gambar">
							{{ $message }}
						</div>
						@enderror
					</div>

					<button type="submit" class="btn btn-primary mb-2">Tambah Data Makanan</button>
				</form>
			</div>
		</div>
	</div>
</div>


<script>

function previewImage(){
	
	const gambar = document.querySelector('#gambar');
	const imgPreview = document.querySelector('.img-preview');

	imgPreview.style.display = 'block'; 

	const oFReader = new FileReader();
	oFReader.readAsDataURL(gambar.files[0]);

	oFReader.onload = function(oFREvent){
		imgPreview.src = oFREvent.target.result;
	}

}


</script>

@endsection