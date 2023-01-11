@extends('layout.main')
@section('mainkonten')


<div class="container-fluid px-4 mt-4">
	<h1 class="">Makanan</h1>
					<ol class="breadcrumb mb-2 ">
									<li class="breadcrumb-item"> <a href="/makanan">Makanan</a></li>
									<li class="breadcrumb-item active">Edit</li>
					</ol>
	<hr>
	<div class="row">
		<div class="d-flex justify-content-evenly flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
			<h3 style="text-transform:capitalize" class="h4">Edit Makanan</h3>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-lg-8">
	
				<form method="post" action="/makanan/{{ $makanan->id }} " enctype="multipart/form-data">
					@method('put')
					@csrf
					<div class="mb-3">
						<label for="nama_makanan" class="form-label">Nama Makanan</label>
						<input type="text" class="form-control @error('nama_makanan') is-invalid @enderror" id="nama_makanan" name="nama_makanan" required value="{{ old('nama_makanan',$makanan->nama_makanan) }}">
	
						@error('nama_makanan')
						<div class="invalid-feedback" id="nama_makanan">
							{{ $message }}
						</div>
						@enderror
	
					</div>
					<div class="mb-3">
						<label for="keterangan_makanan" class="form-label">Keterangan Makanan</label>
						<input type="text" class="form-control @error('keterangan_makanan') is-invalid @enderror" id="keterangan_makanan" name="keterangan_makanan"  value="{{ old('keterangan_makanan',$makanan->keterangan_makanan) }}">
	
						@error('keterangan_makanan')
						<div class="invalid-feedback" id="keterangan_makanan">
							{{ $message }}
						</div>
						@enderror
	
					</div>
	
					<div class="mb-3">
						<label for="category_id" class="form-label" aria-label="Default select example">Kategori Makanan</label>
						<select class="form-select" id="category_id" name="category_id">
							@foreach ($categories as $category)
							@if(old('category_id',$makanan->category_id)==$category->id)
							<option value="{{ $category->id}}" selected> {{ $category->nama_category }}</option>
							@else
							<option value="{{ $category->id }}"> {{ $category->nama_category }}</option>
							@endif
							@endforeach
	
						</select>
					</div>
	
					<label for="harga_makanan" class="form-label">Harga Makanan</label>
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">Rp.</span>
						<input type="number" min="0" oninput="this.value = Math.abs(this.value)" class="form-control @error('harga_makanan') is-invalid @enderror" id="harga_makanan" name="harga_makanan" required value="{{ old('harga_makanan',$makanan->harga_makanan) }}">
	
						@error('harga_makanan')
						<div class="invalid-feedback" id="harga_makanan">
							{{ $message }}
						</div>
						@enderror
	
					</div>
	
					<div class="mb-3">
						<label for="gambar" class="form-label @error('gambar') is-invalid @enderror">Gambar Makanan</label>
						<input type="hidden" name="gambarlama" value="{{ $makanan->gambar }}">
						@if ($makanan->gambar)
						<img src="{{ asset('storage/'. $makanan->gambar) }}" class="img-preview img-fluid col-sm-5 mb-3 d-block">
						@else
						<img class="img-preview img-fluid col-sm-5 mb-3">
						@endif
						<input class="form-control" type="file" id="gambar" name="gambar" onchange="previewImage()">

						@error('gambar')
						<div class="invalid-feedback" id="gambar">
							{{ $message }}
						</div>
						@enderror
					</div>
	
					<button type="submit" class="btn btn-primary">Update Makanan</button>
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