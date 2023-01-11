@extends('layout.main')
@section('mainkonten')


<div class="container-fluid px-4 mt-4">
	<h1 class="">Operator</h1>
		<ol class="breadcrumb mb-2 ">
   <li class="breadcrumb-item"><a href="/operator">Operator</a></li>
		  <li class="breadcrumb-item"><a href="/operator/{{ $operator->id }}/edit">Edit</a> </li>
		  <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
		</ol>
		<hr>
	<div class="row">
		<div class="d-flex justify-content-evenly flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
			<h3 style="text-transform:capitalize" class="h4">Ubah Password</h3>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-lg-8">
				<form action="/change/{{ $operator->id }}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="mb-3">
						<label for="name" class="form-label">Nama Operator</label>
						<input type="text" readonly class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name',$operator->name) }}">
	
						@error('name')
						<div class="invalid-feedback" id="name">
							{{ $message }}
						</div>
						@enderror
	
					</div>	  
					<label for="password">Ubah Password</label>
					<div class="input-group mb-3">
						<input type="password"  autocomplete='off' class="form-control @error ('password') is-invalid @enderror" id="password" name="password" placeholder="password"> 
						<button class="btn btn-secondary btn-sm" type="button" id="eyebutton" onclick="change()">
							<i class="bi bi-eye"></i></button>
							@error('password')
								<div class="invalid-feedback" id="password">
									{{ $message }}
								</div>
							@enderror

					</div>
					<div class="mb-3">
							<label for="password">Konfirmasi Password</label>
						<input type="password" autocomplete='off' class="form-control  @error ('password') is-invalid @enderror" id="password2" name="password_confirmation" placeholder="password" >
							@error('password')
								<div class="invalid-feedback" id="password">
										{{ $message }} 
								</div>
							@enderror
								
					</div>
					<div class="d-flex justify-content-center">
						<div class="col-3 text-center">
							<button class="btn btn-primary" type="submit">Ubah Password</button>
						</div>

					</div>
				</form>
			
	
			</div>
		</div>
	</div>
</div>

@endsection

<script>
	function change(){
		var x = document.getElementById("password").type;
		
		if (x == "password"){
			//ubah text
			document.getElementById('password').type = 'text';
			//ubah icon mata tutup
			document.getElementById('eyebutton').innerHTML = '<i class="bi bi-eye-slash"></i>'
		}else if(x == "text"){
			
				//ubah password
				document.getElementById('password').type = 'password';
				//ubah icon mata buka
				document.getElementById('eyebutton').innerHTML = '<i class="bi bi-eye"></i>';
		}
	}
</script>