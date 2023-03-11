@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
      	<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        	<div class="card">
          		<div class="card-body p-3">
           	 		<div class="row">
						<div class="col-8">
							<div class="numbers">
							<p class="text-sm mb-0 text-capitalize font-weight-bold">Customer</p>
							<h5 class="font-weight-bolder mb-0">
								{{General::konversiNilai($total_customer)}}
								<span class="text-success text-sm font-weight-bolder">{{General::konversiNilaiString($total_customer)}}</span>
							</h5>
							</div>
						</div>
						<div class="col-4 text-end">
							<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
							<i class="ni ni-user-run text-lg opacity-10" aria-hidden="true"></i>
							</div>
						</div>
           			</div>
          		</div>
        	</div>
      	</div>
      	<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
			<div class="card">
			  	<div class="card-body p-3">
			    	<div class="row">
			      		<div class="col-8">
							<div class="numbers">
							<p class="text-sm mb-0 text-capitalize font-weight-bold">Supplier</p>
							<h5 class="font-weight-bolder mb-0">
								{{General::konversiNilai($total_supplier)}}
								<span class="text-success text-sm font-weight-bolder">{{General::konversiNilaiString($total_supplier)}}</span>
							</h5>
							</div>
			      		</div>
						<div class="col-4 text-end">
							<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
								<i class="ni ni-user-run text-lg opacity-10" aria-hidden="true"></i>
							</div>
						</div>
			    	</div>
			  	</div>
			</div>
      	</div>
      	<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
					<div class="col-8">
						<div class="numbers">
						<p class="text-sm mb-0 text-capitalize font-weight-bold">Penjualan</p>
						<h5 class="font-weight-bolder mb-0">
                            @if(!empty($total_penjualan))
                                @php($ambil_total_penjualan = $total_penjualan->total_penjualan)
                            @else
                                @php($ambil_total_penjualan = 0)
                            @endif
							{{General::konversiNilai($ambil_total_penjualan)}}
							<span class="text-danger text-sm font-weight-bolder">{{General::konversiNilaiString($ambil_total_penjualan)}}</span>
						</h5>
						</div>
					</div>
					<div class="col-4 text-end">
						<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
						<i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
						</div>
					</div>
					</div>
				</div>
			</div>
      	</div>
		<div class="col-xl-3 col-sm-6">
			<div class="card">
			<div class="card-body p-3">
				<div class="row">
				<div class="col-8">
					<div class="numbers">
					<p class="text-sm mb-0 text-capitalize font-weight-bold">Pembelian</p>
					<h5 class="font-weight-bolder mb-0">
                        @if(!empty($total_pembelian))
                            @php($ambil_total_pembelian = $total_pembelian->total_pembelian)
                        @else
                            @php($ambil_total_pembelian = 0)
                        @endif
						{{General::konversiNilai($ambil_total_pembelian)}}
						<span class="text-success text-sm font-weight-bolder">{{General::konversiNilaiString($ambil_total_pembelian)}}</span>
					</h5>
					</div>
				</div>
				<div class="col-4 text-end">
					<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
					<i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
					</div>
				</div>
				</div>
			</div>
			</div>
		</div>
	</div>

	<div class="row mt-4 mb-4">
		<div class="col-lg-12 mb-lg-0 mb-4">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="d-flex flex-column h-100">
								<p class="mb-1 pt-2 text-bold">Halo,</p>
								<h5 class="font-weight-bolder">{{Auth::user()->name}}</h5>
								<p class="mb-5">Selamat Datang Dihalaman Dashboard Administrator {{$lihat_konfigurasi_aplikasi->nama_konfigurasi_aplikasis}}.</p>
							</div>
						</div>
						<div class="col-lg-6 ms-auto text-center mt-6 mt-lg-0">
							<div class="border-radius-lg h-100">
								<img src="{{URL::asset('template/back/img/shapes/waves-white.svg')}}" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
								<div class="position-relative d-flex align-items-center justify-content-center h-100">
									<img class="w-100 position-relative z-index-2 pt-4" style="width:300px !important;" src="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasi->logo_text_konfigurasi_aplikasis)}}" alt="{{$lihat_konfigurasi_aplikasi->nama_konfigurasi_aplikasis}}">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="row mt-4 mb-4">
        <div class="card bg-transparent shadow-xl">
            <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('{{URL::asset('template/back/img/curved-images/curved14.jpg')}}');">
                <span class="mask bg-gradient-dark"></span>
                <div class="card-body position-relative z-index-1 p-3">
                    <i class="fas fa-money text-white p-2" aria-hidden="true"></i>
                    <h5 class="text-white mt-4 mb-5 pb-2 center-align">Untuk mengakses halaman kasir silahkan klik <b>Ke Halaman Kasir</b>dibawah ujung kanan, atau klik <b>Kasir</b> pada menu sidebar</h5>
                    <div class="d-flex">
                        <div class="d-flex">&nbsp;</div>
                        <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                            <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{URL('dashboard/kasir')}}">
                                Ke Halaman Kasir
                                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection