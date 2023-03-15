<table id="tablesearch" class="table table-responsive-sm table-bordered table-striped table-sm">
	<thead>
		<tr>
			<th class="nowrap" width="50px">Kode</th>
			<th class="nowrap" width="50px">Nama</th>
			<th class="nowrap" width="50px">Stok</th>
			<th class="nowrap">Jumlah</th>
			<th class="nowrap">Harga</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@if(!$lihat_items->isEmpty())
			@php($no = 1)
			@foreach($lihat_items as $items)
				@php($stok_items 				= $items->stok_items)
				@php($jumlah_penjualan_details 	= 0)
				@php($harga_penjualan_details 	= 0)
				@if($id_penjualans != 0)
					@php($ambil_penjualan_details = \App\Models\Transaksi_penjualan_detail::where('penjualans_id',$id_penjualans)
																							->where('items_id',$items->id_items)
																							->first())
					@if(!empty($ambil_penjualan_details))
						@php($stok_items 				= $items->stok_items + $ambil_penjualan_details->jumlah_penjualan_details)
						@php($jumlah_penjualan_details 	= $ambil_penjualan_details->jumlah_penjualan_details)
						@php($harga_penjualan_details 	= $ambil_penjualan_details->harga_penjualan_details)
					@endif
				@endif
		    	<tr>
		    		<td>
						<input type="hidden" name="id_items[]" value="{{$items->id_items}}">
						{{$items->kode_items}}
					</td>
		    		<td>{{$items->nama_items}}</td>
		    		<td class="right-align">{{$stok_items}}</td>
		    		<td class="nowrap right-align">
						<div class="form-group">
							<input class="form-control {{ General::validForm($errors->first('jumlah_penjualan_details')) }} right-align" id="jumlah_penjualan_details{{$items->id_items}}" type="number" name="jumlah_penjualan_details[]" value="{{Request::old('jumlah_penjualan_details') == '' ? $jumlah_penjualan_details : Request::old('jumlah_penjualan_details') }}">
							{{General::pesanErrorForm($errors->first('jumlah_penjualan_details'))}}
							
						</div>
					</td>
		    		<td class="nowrap right-align">
						<div class="form-group">
							<input class="form-control {{ General::validForm($errors->first('harga_penjualan_details')) }} right-align price-format" id="harga_penjualan_details{{$items->id_items}}" type="text" name="harga_penjualan_details[]" value="{{Request::old('harga_penjualan_details') == '' ? General::ubahDBKeHarga($harga_penjualan_details) : Request::old('harga_penjualan_details') }}">
							{{General::pesanErrorForm($errors->first('harga_penjualan_details'))}}
						</div>
					</td>
					<td class="center-align">
						<button type="button" class="btn-sm bg-gradient-danger mb-0 buttonreset" style="color:white" id="buttonreset{{$items->id_items}}" data-iditem="{{$items->id_items}}">
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

<script type="text/javascript">
	$('.buttonreset').on('click', async function() {
		iditem = $(this).data('iditem');
		$('#jumlah_penjualan_details'+iditem).val('0');
		$('#harga_penjualan_details'+iditem).val('0.00');
	});
</script>