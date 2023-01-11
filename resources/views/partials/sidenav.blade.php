
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Menu</div>
                    <a class="nav-link {{ ($active == 'penjualan') ? 'active' : '' }}" href="/">
                        <div class="sb-nav-link-icon active"><i class="bi bi-grid-3x3-gap-fill"></i></div>
                        Penjualan
                    </a>
                    @if(Auth::user()->id_akses==1)
                    <a class="nav-link {{ ($active == 'operator') ? 'active' : '' }}" href="/operator">
                        <div class="sb-nav-link-icon"><i class="bi bi-people-fill"></i></div>
                        Operator
                    </a>
                    <a class="nav-link {{ ($active == 'laporan') ? 'active' : '' }}" href="/laporan">
                        <div class="sb-nav-link-icon"><i class="bi bi-clipboard-data-fill"></i></div>
                        Laporan
                        <div class="sb-sidenav-collapse-arrow"></div>
                    </a>
                    @endif
                    
                    {{-- <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ ($active2 == 'semua') ? 'active' : '' }}" href="/laporan/semua">Semua</a>
                            <a class="nav-link {{ ($active2 == 'harian') ? 'active' : '' }}" href="/laporan/harian">Harian</a>
                            <a class="nav-link" href="">Mingguan</a>
                            <a class="nav-link" href="">Bulanan</a>
                            <a class="nav-link" href="">Tahunan</a>
                        </nav>
                    </div> --}}
                    <div class="sb-sidenav-menu-heading">Data Penjualan</div>
                    <a class="nav-link {{ ($active == 'makanan') ? 'active' : '' }}" href="/makanan">
                        <div class="sb-nav-link-icon"><i class="bi bi-basket2-fill"></i></div>
                        Makanan
                    </a>
                    <a class="nav-link {{ ($active == 'category') ? 'active' : '' }}" href="/category">
                        <div class="sb-nav-link-icon"><i class="bi bi-bookmarks-fill"></i></div>
                        Kategori
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as :
                    @if (Auth::user()->id_akses==1)
                    Admin
                    @else
                    Kasir
                    @endif
                </div>
            </div>
        </nav>
    </div>