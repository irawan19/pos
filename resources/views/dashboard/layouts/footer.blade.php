@php($ambil_konfigurasi_aplikasi = \App\Models\Master_konfigurasi_aplikasi::where("id_konfigurasi_aplikasis",1)->first())
<footer class="footer pt-3">
	<div class="container-fluid">
		<div class="row align-items-center justify-content-lg-between">
			<div class="col-lg-6 mb-lg-0 mb-4">
				<div class="copyright text-center text-sm text-muted text-lg-start">
					© <script>
					  	document.write(new Date().getFullYear())
					</script>,
					<a href="{{URL('/')}}" class="font-weight-bold" target="_blank">{{$ambil_konfigurasi_aplikasi->nama_konfigurasi_aplikasis}}</a>
				</div>
			</div>
			<div class="col-lg-6">
			  <ul class="nav nav-footer justify-content-center justify-content-lg-end">
			    <li class="nav-item">
			      	<a href="{{URL('/')}}" class="nav-link text-muted" target="_blank">{{$ambil_konfigurasi_aplikasi->nama_konfigurasi_aplikasis}}</a>
			    </li>
			    <li class="nav-item">
			      	<a href="{{URL('/')}}" class="nav-link text-muted">Dashboard</a>
			    </li>
			  </ul>
			</div>
		</div>
	</div>
</footer>