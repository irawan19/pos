<table>
	<tr>
		<td colspan="8" style="font-weight: bold; text-align: center">Laporan Keuntungan Bersih</td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
	</tr>
	<tr>
		<td colspan="8" style="font-weight: bold; text-align: center">{{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai)}}</td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
	</tr>
</table>
<table border="1px">
	<thead>
		<tr>
			<th width="50px">No</th>
			<th>Toko</th>
			<th>Kategori</th>
			<th>Kode</th>
			<th>Nama</th>
			<th>Jual</th>
			<th>Beli</th>
			<th>Keuntungan</th>
		</tr>
	</thead>
	<tbody>
		@php($total_all_penjualans = 0)
		@php($total_all_pembelians = 0)
		@php($total_all_keuntungans = 0)
        @php($no = 1)
		@if(!$lihat_laporan_keuntungan_bersihs->isEmpty())
			@foreach($lihat_laporan_keuntungan_bersihs as $laporan_keuntungan_bersihs)
				<tr>
					<td>{{$no}}</td>
					<td>{{$laporan_keuntungan_bersihs->nama_tokos}}</td>
					<td>{{$laporan_keuntungan_bersihs->nama_kategori_items}}</td>
					<td>{{$laporan_keuntungan_bersihs->kode_items}}</td>
					<td>{{$laporan_keuntungan_bersihs->nama_items}}</td>
					@php($ambil_penjualan = \App\Models\Transaksi_penjualan_detail::selectRaw('SUM(total_penjualan_details) AS total_penjualan_details')
																					->join('transaksi_penjualans','penjualans_id','=','transaksi_penjualans.id_penjualans')
																					->where('transaksi_penjualans.tokos_id',$laporan_keuntungan_bersihs->id_tokos)
																					->where('transaksi_penjualan_details.items_id',$laporan_keuntungan_bersihs->id_items)
																					->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
																					->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
																					->first())
					@if(!empty($ambil_penjualan))
						@php($total_penjualan = $ambil_penjualan->total_penjualan_details)
					@else
						@php($total_penjualan = 0)
					@endif
					<td class="right-align">{{General::ubahDBKeHarga($total_penjualan)}}</td>
					@php($ambil_pembelian = \App\Models\Transaksi_pembelian_detail::selectRaw('SUM(total_pembelian_details) AS total_pembelian_details')
																					->join('transaksi_pembelians','pembelians_id','=','transaksi_pembelians.id_pembelians')
																					->where('transaksi_pembelians.tokos_id',$laporan_keuntungan_bersihs->id_tokos)
																					->where('transaksi_pembelian_details.items_id',$laporan_keuntungan_bersihs->id_items)
																					->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
																					->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
																					->first())
					@if(!empty($ambil_pembelian))
						@php($total_pembelian = $ambil_pembelian->total_pembelian_details)
					@else
						@php($total_pembelian = 0)
					@endif
					<td class="right-align">{{General::ubahDBKeHarga($total_pembelian)}}</td>
					@php($total_keuntungan = $total_penjualan - $total_pembelian)
					<td class="right-align">{{General::ubahDBKeHarga($total_keuntungan)}}</td>
				</tr>
				@php($total_all_penjualans += $total_penjualan)
				@php($total_all_penjualans += $total_pembelian)
				@php($total_all_keuntungans += $total_keuntungan)
                @php($no++)
			@endforeach
		@else
			<tr>
				<td colspan="8" align="center">Tidak ada data ditampilkan</td>
				<td style="display:none"></td>
				<td style="display:none"></td>
				<td style="display:none"></td>
				<td style="display:none"></td>
				<td style="display:none"></td>
				<td style="display:none"></td>
				<td style="display:none"></td>
				<td style="display:none"></td>
			</tr>
		@endif
	</tbody>
  	<tfoot>
  	    <tr>
  	        <th colspan="5" class="center-align">Total {{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai)}}</th>
  	        <th class="right-align">{{General::ubahDBKeHarga($total_all_penjualans)}}</th>
  	        <th class="right-align">{{General::ubahDBKeHarga($total_all_pembelians)}}</th>
  	        <th class="right-align">{{General::ubahDBKeHarga($total_all_keuntungans)}}</th>
  	    </tr>
  	</tfoot>
</table>