@extends('layout.main')

@section('mainkonten')
<div class="container-fluid px-4 mt-4">
	<h1 class="">Operator</h1>
		<ol class="breadcrumb mb-2 ">
   	<li class="breadcrumb-item"><a href="/operator">Operator</a></li>
				<li class="breadcrumb-item active">Tambah Operator</li>
		</ol>
		<hr>
	<div class="row justify-content-center">
		<div class="col-10">
			<div class="card">
				<div class="card-header">
					<h5 class="text-center">Tambah Operator</h5>
				</div>
				<div class="card-body">
					<form action="/operator" method="post">
						@csrf
						<div class="mb-3">		
							<label for="name">Nama Operator</label>
							<input type="text"   autocomplete='off' class="form-control @error ('name') is-invalid @enderror" id="name" name="name" placeholder="name" min="5" value="{{ old('name') }}" >
									@error('name')
										<div class="invalid-feedback" id="name">
											{{ $message }}
										</div>
									@enderror
						</div>			  
						<div class="mb-3">
							<label for="username">Username</label>
							<input type="text"  autocomplete='off' class="form-control @error ('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ old('username') }}" >
									@error('username')
										<div class="invalid-feedback" id="username">
											{{ $message }}
										</div>
									@enderror
	
						</div>
						<div class="mb-3">
								<label for="email">Email</label>
							<input type="email" autocomplete='off' class="form-control  @error ('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
								@error('email')
									<div class="invalid-feedback" id="email">
											{{ $message }} 
									</div>
								@enderror
									
						</div>
						<div class="mb-3">
								<label for="id_akses">Akses</label>
								<select class="form-select @error ('id_akses') is-invalid @enderror" id="id_akses" name="id_akses" value="{{ old('id_akses') }}" required>
									<option value="" selected>Pilih Akses</option>
									@foreach ($akses as $item)
										@if (old('id_akses')==$item->id)
											<option value="{{ $item->id }}" selected>{{ $item->nama_akses }} {{ $item->deskripsi_akses }}</option>
										@else
											<option value="{{ $item->id }}">{{ $item->nama_akses }} {{ $item->deskripsi_akses }}</option>	 
										@endif
									@endforeach
								 </select>
								@error('id_akses')
									<div class="invalid-feedback" id="id_akses">
											{{ "The Akses field is required." }} 
									</div>
								@enderror
									
						</div>
							<div class="mb-3">
								<label for="password">Password</label>  
								<input type="password" autocomplete='off' class="form-control @error ('password') is-invalid @enderror" id="password" name="password" placeholder="Password"> 
									@error('password')  
										<div class="invalid-feedback" id="password">  
											{{ $message }} 
										</div>  
									@enderror 
						</div>
						<div class="d-flex justify-content-center">
							<div class="col-3 text-center">
								<button class="btn btn-primary" type="submit">Tambah</button>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection