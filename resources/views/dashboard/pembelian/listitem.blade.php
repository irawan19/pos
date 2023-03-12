<table id="tablesearch" class="table table-responsive-sm table-bordered table-striped table-sm">
	<thead>
		<tr>
			<th class="nowrap" width="50px">Kode</th>
			<th class="nowrap" width="50px">Nama</th>
			<th class="nowrap">Jumlah</th>
			<th class="nowrap">Harga</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@if(!$lihat_items->isEmpty())
			@php($no = 1)
			@foreach($lihat_items as $items)
		    	<tr>
		    		<td>{{$items->kode_items}}</td>
		    		<td>{{$items->nama_items}}</td>
		    		<td class="nowrap right-align">
						<div class="form-group">
							<input class="form-control {{ General::validForm($errors->first('jumlah_penjualan_details')) }} right-align" id="jumlah_penjualan_details" type="number" name="jumlah_penjualan_details" value="{{Request::old('jumlah_penjualan_details') == '' ? 0 : Request::old('jumlah_penjualan_details') }}">
							{{General::pesanErrorForm($errors->first('jumlah_penjualan_details'))}}
						</div>
					</td>
		    		<td class="nowrap right-align">
						<div class="form-group">
							<input class="form-control {{ General::validForm($errors->first('harga_penjualan_details')) }} right-align price-format" id="harga_penjualan_details" type="text" name="harga_penjualan_details" value="{{Request::old('harga_penjualan_details') == '' ? General::ubahDBKeHarga(0) : Request::old('harga_penjualan_details') }}">
							{{General::pesanErrorForm($errors->first('harga_penjualan_details'))}}
						</div>
					</td>
					<td class="center-align">
						<button type="button" class="btn-sm bg-gradient-danger mb-0" style="color:white" id="buttonreset">
							<i class="fas fa-trash" aria-hidden="true"></i>
						</button>
					</td>
		    	</tr>
				@php($no++)
		    @endforeach
		@else
			<tr>
				<td colspan="5" class="center-align">Tidak ada data ditampilkan</td>
				<td style="display:none"></td>
				<td style="display:none"></td>
				<td style="display:none"></td>
				<td style="display:none"></td>
			</tr>
		@endif
	</tbody>
</table>