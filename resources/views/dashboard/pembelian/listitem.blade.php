<table id="tablesort" class="table table-responsive-sm table-bordered table-striped table-sm">
	<thead>
		<tr>
			<th class="nowrap" width="50px">Kode</th>
			<th class="nowrap" width="50px">Nama</th>
			<th class="nowrap">Jumlah</th>
			<th class="nowrap">Harga</th>
			<th class="nowrap">Sub Total</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@if(!$lihat_items->isEmpty())
			@php($no = 1)
			@foreach($lihat_items as $items)
		    	<tr>
		    		<td class="nowrap">{{$items->kode_items}}</td>
		    		<td class="nowrap">{{$items->nama_items}}</td>
		    		<td class="nowrap">{{General::ubahDBKeHarga(0)}}</td>
		    		<td class="nowrap right-align">{{General::ubahDBKeHarga(0)}}</td>
		    		<td class="nowrap right-align">{{General::ubahDBKeHarga(0)}}</td>
					<td></td>
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