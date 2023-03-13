@php($tanggal_sekarang		= date('Y-m-d'))
@php($ambil_sub_menus 		= \App\Models\Master_menu::where('link_menus',Request::segment(2))->first())
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  	<div class="container-fluid py-1 px-3">
		<nav aria-label="breadcrumb">
			@if(Request::segment(2) != 'kasir')
				<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
					<li class="breadcrumb-item text-sm opacity-5 text-dark">
						Halaman
					</li>
					@if(!empty($ambil_sub_menus))
						@php($ambil_menus = \App\Models\Master_menu::where('id_menus',$ambil_sub_menus->menus_id)
																	->first())
						@if(!empty($ambil_menus))
							<li class="breadcrumb-item text-sm opacity-5 text-dark">
								{{$ambil_menus->nama_menus}}
							</li>
						@endif
					@endif
					@if(Request::segment(2) == '' || Request::segment(2) == 'dashboard')
						<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
					@elseif(Request::segment(2) == 'konfigurasi_akun')
						<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Konfigurasi Akun</li>
					@elseif(Request::segment(2) == 'konfigurasi_profil')
						<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Konfigurasi Profil</li>
					@elseif(Request::segment(2) == 'pesan')
						<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Pesan</li>
					@else
						<li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{$ambil_sub_menus->nama_menus}}</li>
					@endif
				</ol>

				@if(Request::segment(2) == '' || Request::segment(2) == 'dashboard')
					<h6 class="font-weight-bolder mb-0">Dashboard</h6>
				@elseif(Request::segment(2) == 'konfigurasi_akun')
					<h6 class="font-weight-bolder mb-0">Konfigurasi Akun</h6>
				@elseif(Request::segment(2) == 'konfigurasi_profil')
					<h6 class="font-weight-bolder mb-0">Konfigurasi Profil</h6>
				@elseif(Request::segment(2) == 'pesan')
					<h6 class="font-weight-bolder mb-0">Pesan</h6>
				@else
					<h6 class="font-weight-bolder mb-0">{{$ambil_sub_menus->nama_menus}}</h6>
				@endif
			@else
				<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
					<li class="breadcrumb-item text-sm opacity-5 text-dark" style="margin-right:20px;">
						<a style="color:#000 !important" class="text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{URL('dashboard')}}">
                            <i class="fas fa-arrow-left text-sm ms-1" aria-hidden="true" style="color:#202739"></i>
                            &nbsp; Kembali Ke Dashboard
                        </a>
					</li>
					<li class="text-sm opacity-5 text-dark listheadercustomer" style="margin-right:20px;">
						<a style="color:#000 !important" class="text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{URL('dashboard/customer')}}">
                            <i class="fas fa-user text-sm ms-1" aria-hidden="true" style="color:#202739"></i>
                            &nbsp; Customer
                        </a>
					</li>
					<li class="text-sm opacity-5 text-dark listheadercustomer" style="margin-right:20px;">
						<a style="color:#000 !important" class="text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{URL('dashboard/supplier')}}">
							<i class="fas fa-user text-sm ms-1" aria-hidden="true" style="color:#202739"></i>
							&nbsp; Supplier
                        </a>
					</li>
					<li class="text-sm opacity-5 text-dark listheadercustomer" style="margin-right:20px;">
						<a style="color:#000 !important" class="text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{URL('dashboard/penjualan')}}">
							<i class="fas fa-money text-sm ms-1" aria-hidden="true" style="color:#202739"></i>
							&nbsp; Penjualan
                        </a>
					</li>
					<li class="text-sm opacity-5 text-dark listheadercustomer" style="margin-right:20px;">
						<a style="color:#000 !important" class="text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{URL('dashboard/pembelian')}}">
							<i class="fas fa-shopping-cart text-sm ms-1" aria-hidden="true" style="color:#202739"></i>
							&nbsp; Pembelian
                        </a>
					</li>
				</ol>
			@endif
		</nav>
		<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
			<div class="ms-md-auto pe-md-3 d-flex align-items-center">
				<b class="jam">{{General::ubahDBKeTanggal($tanggal_sekarang)}}, <onload="timeJavascript()" id="output"></b>
			</div>
			<ul class="navbar-nav  justify-content-end">
				<li class="nav-item dropdown pe-2 d-flex align-items-center">
					@if(Auth::user()->level_sistems_id == 1)
						@php($notifikasi_pesan_baru 				= \App\Models\Master_pesan::where('status_baca_pesans',0)->count())
					@else
						@php($notifikasi_pesan_baru 				= 0)
					@endif
					@if(Auth::user()->tokos_id == null)
						@php($total_notifikasi_stok 				= \App\Models\Master_item::where('stok_items',0)->count())
					@else
						@php($total_notifikasi_stok 				= \App\Models\Master_item::where('stok_items',0)->where('tokos_id',Auth::user()->tokos_id)->count())
					@endif
					@php($total_notifikasi 							= $notifikasi_pesan_baru + $total_notifikasi_stok)
					<a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
						@if($total_notifikasi == 0)
							<i class="fa fa-bell cursor-pointer"></i>
						@else
							<i class="fa fa-bell cursor-pointer" style="color:#ff3d5e"></i>
						@endif
						<span>{{$total_notifikasi}}</span>
					</a>
					<ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
						@if($total_notifikasi != 0)
							@if(Auth::user()->level_sistems_id == 1)
								@if($notifikasi_pesan_baru != 0)
									@php($ambil_notifikasi_pesan_baru = \App\Models\Master_pesan::where('status_baca_pesans',0)->orderBy('created_at','desc')->get())
									@foreach($ambil_notifikasi_pesan_baru as $notifikasi_pesan_baru)
										<li class="mb-2">
											<a class="dropdown-item border-radius-md" href="{{URL('dashboard/pesan')}}">
												<div class="d-flex py-1">
													<div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
														<svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
															<title>customer-support</title>
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
																<g transform="translate(1716.000000, 291.000000)">
																<g transform="translate(1.000000, 0.000000)">
																	<path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
																	<path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
																	<path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
																</g>
																</g>
															</g>
															</g>
														</svg>
													</div>
													<div class="d-flex flex-column justify-content-center">
														<h6 class="text-sm font-weight-normal mb-1">
															<span class="font-weight-bold">{{$notifikasi_pesan_baru->nama_pesans}}</span>
														</h6>
														<p class="text-xs text-secondary mb-0 ">
															<i class="fa fa-clock me-1"></i>
															{{General::timeElapsedString($notifikasi_pesan_baru->created_at)}}
														</p>
													</div>
												</div>
											</a>
										</li>
									@endforeach
								@endif
							@endif

							@if($total_notifikasi_stok != 0)
								@if(Auth::user()->tokos_id == null)
									@php($ambil_notifikasi_stok = \App\Models\Master_item::join('master_tokos','tokos_id','=','master_tokos.id_tokos')->where('stok_items',0)->orderBy('nama_items','asc')->get())
								@else
									@php($ambil_notifikasi_stok = \App\Models\Master_item::join('master_tokos','tokos_id','=','master_tokos.id_tokos')->where('stok_items',0)->where('id_tokos',Auth::user()->tokos_id)->orderBy('nama_items','asc')->get())
								@endif
							
								@foreach($ambil_notifikasi_stok as $notifikasi_stok)
									<li class="mb-2">
										<a class="dropdown-item border-radius-md" href="{{URL('dashboard/item')}}">
											<div class="d-flex py-1">
												<div class="my-auto">
													<img src="{{URL::asset('storage/'.$notifikasi_stok->foto_items)}}" class="avatar avatar-sm  me-3 ">
												</div>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="text-sm font-weight-normal mb-1">
														<span class="font-weight-bold">{{$notifikasi_stok->kode_items.' - '.$notifikasi_stok->nama_items}}</span>
													</h6>
													<p class="text-xs text-secondary mb-0 ">
														<i class="fa fa-home"></i>
														{{$notifikasi_stok->nama_tokos}}
													</p>
													<p class="text-xs text-secondary mt-2 ">
														<i class="fa fa-file"></i>
														Stok 0
													</p>
												</div>
											</div>
										</a>
									</li>
								@endforeach
							@endif
						@else
							<li class="mb-2">
								<a class="dropdown-item border-radius-md" href="javascript:;">
									<div class="d-flex py-1">
										<div class="d-flex flex-column justify-content-center">
											<h6 class="text-sm font-weight-normal mb-1">
												Tidak Ada Notifikasi Baru
											</h6>
										</div>
									</div>
								</a>
							</li>
						@endif
					</ul>
				</li>
				<li class="nav-item d-flex align-items-center px-3 dropdown">
					<a href="javascript:;" id="dropdownMenuButton" class="nav-link text-body font-weight-bold px-0" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-user me-sm-1"></i>
						<span class="d-sm-inline d-none"></span>
					</a>
					
					<ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
						<li class="mb-2">
							<a class="dropdown-item border-radius-md" href="{{URL('/dashboard/konfigurasi_profil')}}">
								<div class="d-flex py-1">
									<div class="avatar avatar-sm bg-gradient-primary  me-3  my-auto">
										<svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
											<title>customer-support</title>
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
												<g transform="translate(1716.000000, 291.000000)">
												<g transform="translate(1.000000, 0.000000)">
													<path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
													<path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
													<path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
												</g>
												</g>
											</g>
											</g>
										</svg>
									</div>
									<div class="d-flex flex-column justify-content-center">
										<h6 class="text-sm font-weight-normal mb-1">
											<span class="font-weight-bold">Konfigurasi Profil
										</h6>
										<p class="text-xs text-secondary mb-0 ">
											<i class="fa fa-wrench me-1"></i>
											Mengganti data diri
										</p>
									</div>
								</div>
							</a>
						</li>
						<li class="mb-2">
							<a class="dropdown-item border-radius-md" href="{{URL('dashboard/konfigurasi_akun')}}">
								<div class="d-flex py-1">
									<div class="avatar avatar-sm bg-gradient-success  me-3  my-auto">
									<svg width="16px" height="16px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
											<g transform="translate(1716.000000, 291.000000)">
												<g transform="translate(603.000000, 0.000000)">
												<path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
												</path>
												<path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
												<path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
												</g>
											</g>
											</g>
										</g>
										</svg>
									</div>
									<div class="d-flex flex-column justify-content-center">
										<h6 class="text-sm font-weight-normal mb-1">
											<span class="font-weight-bold">Konfigurasi Akun
										</h6>
										<p class="text-xs text-secondary mb-0 ">
											<i class="fa fa-wrench me-1"></i>
											Mengganti akun login
										</p>
									</div>
								</div>
							</a>
						</li>
						<li class="mb-2">
							<a class="dropdown-item border-radius-md" href="{{URL('dashboard/logout')}}">
								<div class="d-flex py-1">
									<div class="avatar avatar-sm bg-gradient-danger  me-3  my-auto">
									<svg width="16px" height="16px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<title>settings</title>
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
										<g transform="translate(1716.000000, 291.000000)">
											<g transform="translate(304.000000, 151.000000)">
											<polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
											</polygon>
											<path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
											<path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
											</path>
											</g>
										</g>
										</g>
									</g>
									</svg>
									</div>
									<div class="d-flex flex-column justify-content-center">
										<h6 class="text-sm font-weight-normal mb-1">
											<span class="font-weight-bold">Logout
										</h6>
										<p class="text-xs text-secondary mb-0 ">
											<i class="fa fa-wrench me-1"></i>
											Keluar dari dashboard
										</p>
									</div>
								</div>
							</a>
						</li>
					</ul>
				</li>
				@if(Request::segment(2) != 'kasir')
					<li class="nav-item d-xl-none ps-3 d-flex align-items-center">
						<a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
							<div class="sidenav-toggler-inner">
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
							</div>
						</a>
					</li>
				@endif
			</ul>
		</div>
  	</div>
</nav>
<script type="text/javascript">
	window.setTimeout("timeJavascript()",1000);
    function timeJavascript()
	{     
        var dateNow = new Date().toLocaleTimeString("en-US",{timeZone: "Asia/Jakarta", hour12: false});
        setTimeout("timeJavascript()",1000);
        document.getElementById("output").innerHTML = dateNow;
	}
</script>