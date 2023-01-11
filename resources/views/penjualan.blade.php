@extends('layout.main')
@section('mainkonten')
	<div class="container-fluid px-4  rounded-2 mt-2">
		<div class="row pt-2 ">
			{{-- massage fail checkout --}}
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div id="failcheckout"></div>
				</div>
			</div>
			{{-- CartP1 --}}
			<div class="col-lg-5 col-sm-5 ">
				<div class="sticky-lg-top sticky-md-top sticky-sm-top">
					<h2 class="">Penjualan</h2>
					<ol class="breadcrumb mb-2 ">
						<li class="breadcrumb-item active"></li>
					</ol>
					<div class="card brdblue rounded-0">
						<div class="card-header border-primary ">
							<h5 class="mb-0 ">Pesanan</h5>
						</div>
						<div class="card-body scroll">
							{{-- <form action=""> --}}
							<div class="table-responsive">
								<table class="table table-responsive-sm table-responsive-md table-responsive-lg">
									<thead>
										<tr>
											<th scope="col">No</th>
											<th scope="col">Makanan</th>
											<th scope="col">Harga</th>
											<th scope="col" class="text-center">Jumlah</th>
										</tr>
									</thead>
									<tbody id="cart1">
									</tbody>
									<tr class="border" id="total">
									</tr>
								</table>
							</div>

							<div class="d-flex justify-content-end">
								<button id='btncheck' type='button' class='btn btn-danger me-3' data-bs-toggle='modal'
									href='#exampleModal1' disabled>Hapus</button>
									<button id="btnloadcheck" hidden class="btn btn-primary" type="button" disabled>
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
										Loading...
								</button>
								<button id='btncheck2' onclick="checkout()" type='button' class='btn btn-primary' data-bs-toggle='modal'
									href='#exampleModal2' disabled>Checkout</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- cartP2 --}}
			<div class="col-sm-7">
				<div class="sticky-lg-top sticky-md-top sticky-sm-top">
					<h2 class="text-white">I</h2>
					<ol class="breadcrumb mb-2 ">
						<li class="breadcrumb-item active text-white">
						<li>
					</ol>
					<div class="card rounded-0">
						<div class="card-header border-primary">
							<div class="d-flex">
								<div class="me-auto"><h5 class="mb-1">Daftar Makanan </h5></div>
								<div class="me-2"><div class="dropdown d-md-inline-block ms-auto form-inline me-0 py-0 my-md-0">
									<a class="btn btn-primary rounded-0 btn-sm dropdown-toggle fs-6" data-bs-toggle="dropdown">
										Kategori
									</a>
									<ul class="dropdown-menu">
										@foreach ($categories as $category)
											<li>
												<a class="dropdown-item fs-6"
													href="#scrollspyHeading{{ $sc++ }}">{{ $category->nama_category }}</a>
											</li>
										@endforeach
									</ul>
								</div></div>
								<div class=""><div class="d-md-inline-block form-inline ms-auto me-0 py-0 my-md-0">
									<form action="/" method="get">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Search.." name="search"
												value="{{ request('search') }} " autocomplete="off">
											<button class="btn btn-primary border" type="submit">Search</button>
										</div>
									</form>
								</div></div>
						</div>
						</div>
					</div>
				</div>

				<div class="card brdblue card-order2 brdorange rounded-0">
					<div class="card-body">
						@foreach ($categories as $category)
							<hr id="scrollspyHeading{{ $sc2++ }}">
							<div class="card border-primary">
								<div class="card-header d-flex content-start bg-primary border-primary"
									style="height: 3rem">
									<div class="col-1"></div>
									<div class="col-8">
										<p class="text-center fs-5 pb-1 pt-0 text-white">
											<b>{{ $category->nama_category }}</b>
										<p>
									</div>
									<div class="col-3">
										<i class="bi bi-caret-down-square text-white fs-5" data-bs-toggle="collapse"
											data-bs-target="#multiCollapseExample{{ $col++ }}" aria-expanded="true"
											style="cursor:pointer"></i>
									</div>
								</div>
								<div class="card-body my-0  brdorange">
									<div class="collapse.show multi-collapse" id="multiCollapseExample{{ $col2++ }}">
										<div class="table-responsive">
											<table class="table table-hover">
												<tbody>
													@foreach ($makanans as $makanan)
														@if ($makanan->category_id == $category->id)
															<tr onclick="cartplus(this)" id="tr"
																idmakanan="{{ $makanan->id }}"
																namamakanan="{{ $makanan->nama_makanan }}"
																hargamakanan="{{ $makanan->harga_makanan }}" qty="1"
																subtotal="{{ $makanan->harga_makanan }}"
																style="cursor: pointer;">
																<td>
																	<button id='btnlog' hidden class="btn btn-primary mt-2" type="button" disabled>
																		<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
																		<span class="visually-hidden">Loading...</span>
																</button>
																	<button id="btnsub" type="submit" class="btn btn-primary mt-2 ">
																		<i class="bi bi-cart-plus"></i>
																	</button>

																</td>
																<td>
																	@if ($makanan->gambar)
																		<img height="60" width="60"
																			src="{{ asset('storage/' . $makanan->gambar) }}"
																			alt="">
																	@else
																		<img height="60" width="60"
																			src="https://source.unsplash.com/600x400?{{ $makanan->nama_makanan }}"
																			alt="">
																	@endif
																</td>
																<td style="width: 9em"><b>{{ $makanan->nama_makanan }}</b></td>
																<td>{{ $makanan->keterangan_makanan }}</td>
																<td><b>Rp
																		{{ number_format($makanan->harga_makanan, 0, ',', '.') }}</b>
																</td>
															</tr>
														@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>

			{{-- modal delete --}}
			<div class="modal fade" id="exampleModal1" aria-hidden="true" tabindex="-1" data-bs-backdrop="static"
				data-bs-keyboard="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						</div>
						<div class="modal-body text-center">
							Yakin Akan Hapus Keranjang?
						</div>
						<div class="modal-footer justify-content-center">
							<form action="/deletecart" method="post">
								@csrf
								<button type="button" class="btn btn-danger" data-bs-dismiss="modal">&nbsp;&nbsp;
									Tidak<i class="bi bi-x"></i> &nbsp;&nbsp;</button>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<button type="submit" class="btn btn-success" id="myBtn">&nbsp;&nbsp; Iya<i
										class="bi bi-check2"></i> &nbsp;&nbsp;</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			{{-- modal checkout --}}
			<div class="modal fade" id="exampleModal2" data-bs-backdrop="static" data-bs-keyboard="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<img src="{{ asset('/img/logo.png') }}" class="rounded mx-auto d-block" height="100"
								width="100" alt="...">
						</div>
						<div class="modal-body">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th scope="col" class="text-center">No</th>
												<th scope="col" class="text-center">Item</th>
												<th scope="col" class="text-center">Harga</th>
												<th scope="col" class="text-center">Jumlah</th>
												<th scope="col" class="text-center">Subtotal</th>
											</tr>
										</thead>
										<tbody id="cartitem">
										</tbody>
									</table>
								</div>
								<h6 class="text-center">Pastikan Pembayaran telah dilakukan sebelum klik OK</h6>
								<div class="modal-footer justify-content-center">
									<button id="btnoutcheck" type="button" class="btn btn-danger" data-bs-dismiss="modal">&nbsp;&nbsp;
										Batal<i class="bi bi-x"></i> &nbsp;&nbsp;</button>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<button id='btnlogmakecheck' hidden style="width: 88.33px; height:38px;" class="btn btn-success" type="button" disabled>
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
										<span class="visually-hidden">Loading...</span>
								</button><button id="btnmakecheck" type="submit" onclick="makechekout()" class="btn btn-success">&nbsp;&nbsp; Ok<i
											class="bi bi-check2"></i> &nbsp;&nbsp;</button>
								</div>

						</div>
					</div>
				</div>
			</div>


		</div>
	</div>


	<script>
		var input = document.getElementById("inpcart1");
		input.addEventListener("keypress", function(event) {
			if (event.key === "Enter") {
				event.preventDefault();
				document.getElementById("myBtn").click();
			}
		});
	</script>

	<script>
		//============start fungsi penghitungan checkout==========\\
		function mulaiHitung() {
			interval = setInterval("Hitung()", 1);
		}

		function Hitung() {
			harga_awal = document.getElementById("total_harga").value;
			diskon = document.getElementById("diskon").value;
			diskon2 = (harga_awal * diskon) / 100;
			harga_total = harga_awal - diskon2;
			harga_final = document.getElementById("total_bayar").value =
				Math.round(harga_total);
			tunai = document.getElementById("tunai").value;
			kembalian = tunai - harga_final;
			document.getElementById("kembalian").value = kembalian;
			document.getElementById("total_bayar").value = harga_final;
			document.getElementById("tunai").value = tunai;
		}

		function stopHitung() {
			clearInterval(interval);
		}
		//=================== end fungsi penghitungan checkout=======\\


		$(document).ready(function() {
			cartview();
			total();

		});

		//============== START FUNGSI KERANJANG ==========\\
		
		//====> MENAMPILKAN KERANJANG
		function cartview() {
				$('#cart1').html('');
				$('#btncheckout').html('')
				$.ajax({
					type: "GET",
					url: "{{ route('cartview') }}",
					dataType: "json",
					success: function(data) {
						$.each(data, function(key, val) {
							id = data[key].id;
							id_makanan = data[key].id_makanan;
							nama_makanan = data[key].nama_makanan;
							harga_makanan = data[key].harga_makanan;
							qty = data[key].qty;
							$('#cart1').append("<tr id='tr2' idcart=" + id + ">\
											<td>" + parseInt(key + 1) + "</td>\
											<td style='width: 9em;'>" + nama_makanan + "</td>\
											<td> Rp. " + harga_makanan + "</td>\
											<td> <div class='d-flex justify-content-start'>\
												<button id='valmin' class='btn btn-primary btn-sm rounded-0' onclick='valmin(this)'>-</button>\
												<input id='inpcart1' min='1' name='qtyval' value='" + parseInt(qty) + "' type='number' style='width: 4em' class='form-control form-control-sm border-primary rounded-0' oninput='this.value = Math.abs(this.value),manualqty(this)' onkeyup='manualqty(this)'>\
												<button class='btn btn-primary btn-sm rounded-0' onclick='valplus(this)'>+</button>\
											<button id='btnlogx' hidden class='btn btn-danger btn-sm ms-2' style='height:33px; width:28.27px;' type='button' disabled>\
																<span class='spinner-border spinner-border-sm' style='margin-left:-3px;' role='status' aria-hidden='true'></span>\
																<span class='visually-hidden'>Loading...</span></button>\
															<button id='btnx' class='btn-sm btn-danger ms-2' onclick='itemdel(this)'>X</button></div></td>\
											</tr>");
						});
					},
					async: false
				});
			}
			//===> MENAMPILKAN TOTAL HARGA
		function total() {
			$('#total').html('');
			$.ajax({
				type: "get",
				url: "{{ route('total') }}",
				success: function(data) {
					$('#total').append(data);
					btncheck()
				},
				async: false
			});
		}
		function btncheck(){
			$.ajax({
				type: "get",
				url: "{{ route('cartview') }}",
				success: function (data) {
					if (data !=0) {
						$('#btncheck').removeAttr('disabled');
						$('#btncheck2').removeAttr('disabled');
					} else {
						$('#btncheck').attr('disabled', 'disabled');
						$('#btncheck2').attr('disabled', 'disabled');
					}
				},
				async:false
			});
		}

		function manualqty(el){
			let $parent = $(el).closest('#tr2');
			var idcart = $parent.attr('idcart');
			var inpcart = $parent.find('#inpcart1').val();
			var token = "{{ csrf_token() }}";
			var btnx = $parent.find('#btnx');
			var valmin = $parent.find('#valmin');
			if (inpcart >= 0) {
				$('#btncheck2').attr('disabled', 'disabled');
						}
			if(inpcart > 0){
				$.ajax({
					type: "post",
					url: "/updateqty",
					data: {
						id : idcart,
						qty : inpcart,
						_token : token,
					},beforeSend: function () {
						$('#btnloadcheck').removeAttr('hidden');
						$('#btncheck2').attr('hidden', 'hidden');
					},
					success: function (response) {
	
					},complete: function () {
						$('#btnloadcheck').attr('hidden', 'hidden');
						$('#btncheck2').removeAttr('hidden');
						total();
					},
				});
			}

		}
		function valplus(el) {
			let $parent = $(el).closest('#tr2');
			var idcart = $parent.attr('idcart');
			var cart = +$parent.find('#inpcart1').val() +1;
			var valmin = $parent.find('#valmin');
			$parent.find('#inpcart1').val(cart);
			var token = "{{ csrf_token() }}";
			$.ajax({
				type: "post",
				url: "/updateqty",
				data: {
					id : idcart,
					qty : cart,
					_token : token,
				},beforeSend: function () {
					$('#btnloadcheck').removeAttr('hidden');
					$('#btncheck2').attr('hidden', 'hidden');
				},
				success: function (response) {
					total();
				},complete: function () {
					$('#btnloadcheck').attr('hidden', 'hidden');
					$('#btncheck2').removeAttr('hidden');
				}
			});
		}

		function valmin(el) {
			let $parent = $(el).closest('#tr2');
			var idcart = $parent.attr('idcart');
			var token = "{{ csrf_token() }}";
			var btnx = $parent.find('#btnx');
			var valmin = $parent.find('#valmin');
			var cart = $parent.find('#inpcart1').val();
					if (cart >= 1) {
							var cart = +$parent.find('#inpcart1').val() -1;
							$parent.find('#inpcart1').val(cart);
						}
			$.ajax({
				type: "post",
				url: "/updateqty",
				data: {
					id : idcart,
					qty : cart,
					_token : token,
				},beforeSend: function () {
					$('#btnloadcheck').removeAttr('hidden');
					$('#btncheck2').attr('hidden', 'hidden');
				},
				success: function (response) {
					total();
				},complete: function () {
					$('#btnloadcheck').attr('hidden', 'hidden');
					$('#btncheck2').removeAttr('hidden');
					if (cart == 0){
						btnx.click();
					}
				}
			});
		}

		function cartplus(el) {

			let $parent = $(el).closest('#tr');
			var btnlog = $parent.find('#btnlog');
			var btnsub = $parent.find('#btnsub');
			var makanan_id = $parent.attr('idmakanan');
			var nama_makanan = $parent.attr('namamakanan');
			var harga_makanan = $parent.attr('hargamakanan');
			var qty = $parent.attr('qty');
			var subtotal = $parent.attr('subtotal');
			var token = "{{ csrf_token() }}";
			// ======
			$.ajax({
					type: "post",
					url: "{{ route('cartplus') }}",
					data: {
					makanan_id: makanan_id,
					nama_makanan: nama_makanan,
					harga_makanan: harga_makanan,
					qty: qty,
					subtotal: subtotal,
					_token: token,
				},
				beforeSend: function (jqXHR) {
					btnlog.removeAttr('hidden');
					btnsub.attr('hidden','hidden');
				},
				success: function (data, status, jqXhr) {
					cartview();
					total();
				},
				complete: function(){
					btnsub.removeAttr('hidden');
					btnlog.attr('hidden','hidden');
				}
			});
			};

		function itemdel(el) {
			let $parent = $(el).closest('#tr2');
			var btnlogx = $parent.find('#btnlogx');
			var btnx = $parent.find('#btnx');
			var idcart = $parent.attr('idcart');
			var token = "{{ csrf_token() }}";
			$.ajax({
				type: "post",
				url: "{{ route('itemdel') }}",
				data: {
					id: idcart,
					_token: token,
				},
				beforeSend: function (jqXHR) {
					btnlogx.removeAttr('hidden');
					btnx.attr('hidden','hidden');
				},
				success: function(data) {
					cartview();
					total();
				},
			});
		}

		//modal checkout
		function cartitem(){
			var item = $('#cartitem').html('');
			$.ajax({
				type: "get",
				url: "/cartitem",
				dataType: "text",
				success: function (response) {
					item.html(response);
				},
			});
		}
	function checkout(){
	cartitem();
	}

	function makechekout(){
		var total_harga 	= $('#total_harga').val();
		var no_meja						= $('#no_meja').val();
		var diskon 						= $('#diskon').val();
		var total_bayar 	= $('#total_bayar').val();
		var tunai 							= $('#tunai').val();
		var kembali 					= $('#kembalian').val();
		var token 							= "{{ csrf_token() }}";
		$.ajax({
			type: "post",
			url: "/checkout",
			data: {
				total_harga : total_harga,
				no_meja	: no_meja,
				diskon : diskon,
				total_bayar : total_bayar,
				tunai : tunai,
				kembali : kembali,
				_token : token,
			},
			beforeSend: function() {
				$('#btnlogmakecheck').removeAttr('hidden');
				$('#btnmakecheck').attr('hidden', 'hidden');
			},
			success: function (response) {
				window.location = '/checkresult';
				cartview();
				total();
			},
			error: function () {
				$("#failcheckout").append("<div class='alert alert-danger alert-dismissible fade show text-capitalize text-center fw-semibold fs-5 mt-2 mx-2'\
							role='alert'>\
							<i class='bi bi-x-octagon-fill'></i> Checkout gagal terdapat kesalahan dalam pembayaran\
							<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>\
						</div>")
   },
			complete: function(){
				$('#btnmakecheck').removeAttr('hidden');
				$('#btnlogmakecheck').attr('hidden', 'hidden');
				$('#btnoutcheck')[0].click(function(){}); 
			},
		});
	}

	function diskonchange() {
    if( $('#diskon').attr('max') != 'undefined' ) {
        if( !isNaN($('#diskon').val()) && (parseInt($('#diskon').val()) > $('#diskon').attr('max')) ) {
            $('#diskon').val($('#diskon').attr('max'));
        }
    }
}
function mejachange() {
    if( $('#no_meja').attr('max') != 'undefined' ) {
        if( !isNaN($('#no_meja').val()) && (parseInt($('#no_meja').val()) > $('#no_meja').attr('max')) ) {
            $('#no_meja').val($('#no_meja').attr('max'));
        }
    }
}
	</script>
@endsection
