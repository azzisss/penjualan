{{-- 
<nav class="sb-topnav navbar navbar-expand navbar-light bg-light" >
    
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 fs-4 fw-bolder" href="/">Rm. JagoSore</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

    @auth
    <!--navlink-->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-1 mb-lg-0 ms-3 me-auto">
          <li class="nav-item">
            <a class="nav-link fw-semibold fs-5" aria-current="page" href="">Penjualan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold fs-5" href="">Laporan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold fs-5" aria-current="page" href="">Operator</a>
          </li>
        </ul>
    </div>
    <!-- Navbar-->
    <ul class="navbar-nav d-flex content-end d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-capitalize" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i> Selamat datang, {{ auth()->user()->name }} </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <form method="post" action="/logout">
              @csrf
                <button class="dropdown-item">
                  <li><i class="bi bi-box-arrow-right"></i> Logout</li>
                </button>
              </form>
            </ul>
        </li>
    </ul>
    @else
  <ul class="navbar-nav d-flex content-end d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <li class="nav-item">
          <a href="/login" class="nav-link ">Login<i class="bi bi-box-arrow-in-right"></i></a>
        </li>
  </ul>
      @endauth
</nav> --}}

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark posit">
	<!-- Navbar Brand-->
	<div class="container">
		<div class="d-flex justify-content-start">

			<img height="50" width="50" src="{{ asset('/img/logo.png') }}" alt="">
			<a class="navbar-brand ps-3" href="/" style="color: rgba(255, 182, 14, 1)">Rm. JagoSore</a>
			
			@auth
			<!-- Sidebar Toggle-->
			<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
		</div>
		<div class="d-flex justify-content-end">
			<!-- Navbar Search-->
			<div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
				<ul class="navbar-nav">
					<li class="nav-item">
					  <a class="nav-link {{ ($active == 'penjualan') ? 'active' : '' }}" href="/">Penjualan</a>
					</li>
					@if(Auth::user()->id_akses==1)
					<li class="nav-item">
						<a class="nav-link {{ ($active == 'laporan') ? 'active' : '' }}" href="/laporan">Laporan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ ($active == 'operator') ? 'active' : '' }}" href="/operator">Operator</a>
					</li>
					@endif
				 </ul>
				</div>
			<!-- Navbar-->
			  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
					<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item text-capitalize">Selamat datang, {{ auth()->user()->name }} </a></li>
						<li><hr class="dropdown-divider" /></li>
						<li>
							<form method="post" action="/logout">
								@csrf
									  <button class="dropdown-item">
										 <li><i class="bi bi-box-arrow-right"></i> Logout</li>
									  </button>
								</form>
						</li>
					</ul>
				</li>
			  </ul>
			@else
		
			@endauth
		</div>
	</div>
</nav>
        
