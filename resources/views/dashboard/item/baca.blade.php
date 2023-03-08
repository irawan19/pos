@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 col-center">
			<div class="card">
				<div class="card-header">
					<strong>Baca Item</strong>
				</div>
				<div class="card-body">
                    <div class="center-align">
                        <a data-fancybox="gallery" href="{{URL::asset('storage/'.$baca_items->foto_items)}}">
                            <img src="{{URL::asset('storage/'.$baca_items->foto_items)}}" width="108">
                        </a>
						<a data-fancybox="gallery" href="data:image/png;base64,{{DNS2D::getBarcodePNG($baca_items->id_items.'-'.$baca_items->nama_items.'-'.$baca_items->harga_items, 'QRCODE')}}">
							<img src="data:image/png;base64,{{DNS2D::getBarcodePNG($baca_items->id_items.'-'.$baca_items->nama_items.'-'.$baca_items->harga_items, 'QRCODE')}}" alt="barcode" width="108px">
						</a>
					</div>
					<hr/>
					<table class="table table-responsive-sm table-striped table-sm">
						<tr>
							<th width="150px">Kode</th>
							<th width="1px">:</th>
							<td>{{$baca_items->kode_items}}</td>
						</tr>
						<tr>
							<th>Toko</th>
							<th>:</th>
							<td>{{$baca_items->nama_tokos}}</td>
						</tr>
						<tr>
							<th>Kategori</th>
							<th>:</th>
							<td>{{$baca_items->nama_kategori_items}}</td>
						</tr>
						<tr>
							<th>Satuan</th>
							<th>:</th>
							<td>{{$baca_items->nama_satuans}}</td>
						</tr>
						<tr>
							<th>Harga</th>
							<th>:</th>
							<td>{{General::ubahDBKeHarga($baca_items->harga_items)}}</td>
						</tr>
						<tr>
							<th>Stok</th>
							<th>:</th>
							<td>{{$baca_items->stok_items}}</td>
						</tr>
						<tr>
							<th>Deskripsi</th>
							<th>:</th>
							<td>{!! nl2br($baca_items->deskripsi_items) !!}</td>
						</tr>
					</table>
				</div>
				<div class="card-footer right-align">
				  	@if(request()->session()->get('halaman') != '')
		           		@php($ambil_kembali = request()->session()->get('halaman'))
	               	@else
	               		@php($ambil_kembali = URL('dashboard/item'))
	               	@endif
					{{General::kembali($ambil_kembali)}}
				</div>
			</div>
		</div>
	</div>

@endsection