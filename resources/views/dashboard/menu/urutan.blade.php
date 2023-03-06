@extends('dashboard.layouts.app')
@section('content')

	<div class="container-fluid">
       	<div class="animated fadeIn">
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">
							<strong>Urutan Menu</strong>
						</div>
						<div class="card-body">
							<ul class="handles list sortable" id="urutan_halaman" style="cursor:pointer;">
		                        @foreach($lihat_urutans as $urutans)
		                            @php(printf('<li id="menu_%s" class="btn btn-primary btn-block"><span>:: '.$urutans->nama_menus.'</li></span>', $urutans->id_menus, $urutans->nama_menus))
		                        @endforeach
		                    </ul>
						</div>
						<div class="card-footer right-align">
						  	@if(request()->session()->get('halaman2') != '')
				           		@php($ambil_kembali = request()->session()->get('halaman2'))
			               	@else
			               		@if(request()->session()->get('halaman') != '')
			               			@php($ambil_kembali = request()->session()->get('halaman'))
			               		@else
			               			@php($ambil_kembali = URL('dashboard/menu'))
			               		@endif
			               	@endif
							{{General::kembali($ambil_kembali)}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection