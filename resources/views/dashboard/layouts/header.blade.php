@php($tanggal_sekarang				= date('Y-m-d'))
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  	<div class="container-fluid py-1 px-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
				<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="#">Halaman</a></li>
				@if(Request::segment(2) == '' || Request::segment(2) == 'dashboard')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
				@elseif(Request::segment(2) == 'konfigurasi_akun')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Konfigurasi Akun</li>
				@elseif(Request::segment(2) == 'regional')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Regional</li>
				@elseif(Request::segment(2) == 'kategori_menu')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Kategori Menu</li>
				@elseif(Request::segment(2) == 'satuan')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Satuan</li>
				@elseif(Request::segment(2) == 'tipe_pembayaran')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tipe Pembayaran</li>
				@elseif(Request::segment(2) == 'kategori_pembayaran')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Kategori Pembayaran</li>
				@elseif(Request::segment(2) == 'pembayaran')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Pembayaran</li>
				@elseif(Request::segment(2) == 'verifikasi_mitra')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Verifikasi Mitra</li>
				@elseif(Request::segment(2) == 'mitra')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Mitra</li>
				@elseif(Request::segment(2) == 'customer')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Customer</li>
				@elseif(Request::segment(2) == 'promo')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Promo</li>
				@elseif(Request::segment(2) == 'laporan_penjualan')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Laporan Penjualan</li>
				@elseif(Request::segment(2) == 'push_notifikasi')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Push Notifikasi</li>
				@elseif(Request::segment(2) == 'admin')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Admin</li>
				@elseif(Request::segment(2) == 'konfigurasi_aplikasi')
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Konfigurasi Aplikasi</li>
				@else
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
				@endif
			</ol>
			@if(Request::segment(2) == '' || Request::segment(2) == 'dashboard')
				<h6 class="font-weight-bolder mb-0">Dashboard</h6>
			@elseif(Request::segment(2) == 'konfigurasi_akun')
				<h6 class="font-weight-bolder mb-0">Konfigurasi Akun</h6>
			@elseif(Request::segment(2) == 'regional')
				<h6 class="font-weight-bolder mb-0">Regional</h6>
			@elseif(Request::segment(2) == 'kategori_menu')
				<h6 class="font-weight-bolder mb-0">Kategori Menu</h6>
			@elseif(Request::segment(2) == 'satuan')
				<h6 class="font-weight-bolder mb-0">Satuan</h6>
			@elseif(Request::segment(2) == 'tipe_pembayaran')
				<h6 class="font-weight-bolder mb-0">Tipe Pembayaran</h6>
			@elseif(Request::segment(2) == 'kategori_pembayaran')
				<h6 class="font-weight-bolder mb-0">Kategori Pembayaran</h6>
			@elseif(Request::segment(2) == 'pembayaran')
				<h6 class="font-weight-bolder mb-0">Pembayaran</h6>
			@elseif(Request::segment(2) == 'verifikasi_mitra')
				<h6 class="font-weight-bolder mb-0">Verifikasi Mitra</h6>
			@elseif(Request::segment(2) == 'mitra')
				<h6 class="font-weight-bolder mb-0">Mitra</h6>
			@elseif(Request::segment(2) == 'customer')
				<h6 class="font-weight-bolder mb-0">Customer</h6>
			@elseif(Request::segment(2) == 'promo')
				<h6 class="font-weight-bolder mb-0">Promo</h6>
			@elseif(Request::segment(2) == 'laporan_penjualan')
				<h6 class="font-weight-bolder mb-0">Laporan Penjualan</h6>
			@elseif(Request::segment(2) == 'push_notifikasi')
				<h6 class="font-weight-bolder mb-0">Push Notifikasi</h6>
			@elseif(Request::segment(2) == 'admin')
				<h6 class="font-weight-bolder mb-0">Admin</h6>
			@elseif(Request::segment(2) == 'konfigurasi_aplikasi')
				<h6 class="font-weight-bolder mb-0">Konfigurasi Aplikasi</h6>
			@else
				<h6 class="font-weight-bolder mb-0"></h6>
			@endif
		</nav>
		<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
			<div class="ms-md-auto pe-md-3 d-flex align-items-center">
				<b class="jam">{{General::ubahDBKeTanggal($tanggal_sekarang)}}, <onload="timeJavascript()" id="output"></b>
			</div>
			<ul class="navbar-nav  justify-content-end">
				<li class="nav-item d-flex align-items-center px-3 dropdown">
					<a href="javascript:;" id="dropdownMenuButton" class="nav-link text-body font-weight-bold px-0" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-user me-sm-1"></i>
						<span class="d-sm-inline d-none"></span>
					</a>
					
					<ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
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
				<li class="nav-item dropdown pe-2 d-flex align-items-center">
					@php($total_notifikasi 							= 0)
					<a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-bell cursor-pointer"></i> <span>{{$total_notifikasi}}</span>
					</a>
					<ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
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
					</ul>
				</li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
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