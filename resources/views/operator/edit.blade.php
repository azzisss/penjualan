@extends('layout.main')

@section('mainkonten')
<div class="container-fluid px-4 mt-4">
	<h1 class="">Operator</h1>
		<ol class="breadcrumb mb-2 ">
            <li class="breadcrumb-item"><a href="/operator">Operator</a></li>
			<li class="breadcrumb-item active">Edit</li>
		</ol>
		<hr>
        <div class="row justify-content-center">
            <div class="col-sm-7">
                @if (session()->has('changepass'))
                    <div class="alert alert-success alert-dismissible fade show text-capitalize text-center fw-semibold fs-6 mt-2"
                        role="alert">
                        {{ session('changepass') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-evenly flex-wrap flex-md-nowrap text-center pt-3 pb-2 mb-3 ">
                <h3 style="text-transform:capitalize" class="h4">Edit Operator</h3>
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-lg-8">
                    <form action="/operator/{{ $operator->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Operator</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" required value="{{ old('name', $operator->name) }}">

                            @error('name')
                                <div class="invalid-feedback" id="name">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" autocomplete='off'
                                class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                                placeholder="Username" value="{{ old('username', $operator->username) }}">
                            @error('username')
                                <div class="invalid-feedback" id="username">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" autocomplete='off'
                                class="form-control  @error('email') is-invalid @enderror" id="email" name="email"
                                placeholder="name@example.com" value="{{ old('email', $operator->email) }}">
                            @error('email')
                                <div class="invalid-feedback" id="email">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="id_akses">Akses</label>
                            <select class="form-select @error('id_akses') is-invalid @enderror" id="id_akses"
                                name="id_akses" value="{{ old('id_akses') }}" required>
                                <option value="" selected>Pilih Akses</option>
                                @foreach ($akses as $item)
                                    @if (old('id_akses', $operator->id_akses) == $item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->nama_akses }}
                                            {{ $item->deskripsi_akses }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->nama_akses }}
                                            {{ $item->deskripsi_akses }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_akses')
                                <div class="invalid-feedback" id="id_akses">
                                    {{ 'The Akses field is required.' }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <a href="/changepass/{{ $operator->id }}" class="btn-sm btn-secondary">Change Password</a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="col-3 text-center">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
