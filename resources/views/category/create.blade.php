@extends('layout.main') @section('mainkonten')
    <div class="container-fluid px-4 mt-4">
        <h1 class="">Kategori Makanan</h1>
            <ol class="breadcrumb mb-2 ">
                <li class="breadcrumb-item"> <a href="/category">Kategori</a></li>
                <li class="breadcrumb-item active">Tambah Kategori</li>
            </ol>
        <hr>
        <div class="row">
            <div class="d-flex justify-content-evenly flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
                <h3 style="text-transform: capitalize" class="h4">
                    Tambah Kategori Baru
                </h3>
            </div>

            <div class="d-flex justify-content-center">
                <div class="col-8">
                    <form method="post" action="/category" enctype="multipart/form-data">
                        @csrf
                        <label for="title" class="form-label ms-3">Nama Kategori</label>
                        <div class="input-group mb-3 ms-3">
                            <input type="text" class="form-control @error('nama_category') is-invalid @enderror"
                                id="nama_category" name="nama_category" required value="{{ old('nama_category') }}" />
                            <button type="submit" id="button-addon2" class="btn btn-primary">
                                Buat Kategori
                            </button>
                            @error('nama_category')
                                <div class="invalid-feedback" id="nama_category">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--
<script>
	const nama_category = document.querySelector("#nama_category");
	const slug = document.querySelector("#slug");

	title.addEventListener("change", function () {
		fetch("/category/posts/checkSlug?nama_category=" + title.value)
			.then((response) => response.json())
			.then((data) => (slug.value = data.slug));
	});

	document.addEventListener("trix-file-accept", function (e) {
		e.preventDefault();
	});
</script>
--}}
@endsection
