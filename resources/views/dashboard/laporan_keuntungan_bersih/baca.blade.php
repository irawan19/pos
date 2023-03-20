@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Baca Laporan Keuntungan Bersih</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::cetakexcel($link_laporan_keuntungan_bersih,'dashboard/laporan_keuntungan_bersih/baca/'.$baca_items->id_items.'/cetakexcel') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
                    <table class="table table-responsive-sm table-striped table-sm">
						<tr>
							<th width="150px">Toko</th>
							<th width="1px">:</th>
							<td>{{$baca_items->nama_tokos}}</td>
						</tr>
						<tr>
							<th>Kategori</th>
							<th>:</th>
							<td>{{$baca_items->nama_kategori_items}}</td>
						</tr>
						<tr>
							<th>Item</th>
							<th>:</th>
							<td>{{$baca_items->nama_items}}</td>
						</tr>
						<tr>
							<th>Satuan</th>
							<th>:</th>
							<td>{{$baca_items->nama_satuans}}</td>
						</tr>
					</table>
                    
                    <table id="tablesort" class="table table-responsive-sm table-bordered table-striped table-sm">
				    	<thead>
				    		<tr>
				    			<th class="nowrap">Tanggal</th>
				    			<th class="nowrap">No</th>
				    			<th class="nowrap">Admin</th>
				    			<th class="nowrap">Masuk</th>
				    			<th class="nowrap">Keluar</th>
				    			<th class="nowrap">Sub Total</th>
				    		</tr>
				    	</thead>
				    	<tbody>
				    	</tbody>
				    </table>
				</div>
				<div class="card-footer right-align">
				  	@if(request()->session()->get('halaman') != '')
		           		@php($ambil_kembali = request()->session()->get('halaman'))
	               	@else
	               		@php($ambil_kembali = URL('dashboard/laporan_keuntungan_bersih'))
	               	@endif
					{{General::kembali($ambil_kembali)}}
				</div>
			</div>
		</div>
	</div>

@endsection