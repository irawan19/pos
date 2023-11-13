<table>
	<tr>
		<td colspan="7" style="font-weight: bold; text-align: center">Laporan Penjualan Detail</td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
	</tr>
	<tr>
		<td colspan="7" style="font-weight: bold; text-align: center">{{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai)}}</td>
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
			<th>Tanggal</th>
			<th>No</th>
			<th>Toko</th>
			<th>Admin</th>
			<th>Item</th>
			<th>Qty</th>
			<th>Customer</th>
			<th>Pembayaran</th>
			<th>Harga</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		@php($total_penjualans = 0)
		@if(!$lihat_laporan_penjualan_details->isEmpty())
			@foreach($lihat_laporan_penjualan_details as $laporan_penjualan_details)
				<tr>
                    <td >{{General::ubahDBKeTanggalwaktu($laporan_penjualan_details->tanggal_penjualans)}}</td>
				    <td >{{$laporan_penjualan_details->no_penjualans}}</td>
				    <td >{{$laporan_penjualan_details->nama_tokos}}</td>
				    <td >{{$laporan_penjualan_details->name}}</td>
				    <td >{{$laporan_penjualan_details->nama_items}}</td>
				    <td align="right">{{$laporan_penjualan_details->jumlah_penjualan_details}}</td>
				    <td >{{$laporan_penjualan_details->nama_customers}}</td>
				    <td >{{$laporan_penjualan_details->nama_pembayarans}}</td>
				    <td align="right">{{General::ubahDBKeHarga($laporan_penjualan_details->harga_items)}}</td>
					<td align="right">{{General::ubahDBKeHarga($laporan_penjualan_details->total_penjualan_details)}}</td>
				</tr>
				@php($total_penjualans += $laporan_penjualan_details->total_penjualan_details)
			@endforeach
		@else
			<tr>
				<td colspan="10" align="center">Tidak ada data ditampilkan</td>
				<td style="display:none"></td>
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
			<th colspan="9" align="center">Total Penjualan {{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai)}}</th>
			<th align="right">{{General::ubahDBKeHarga($total_penjualans)}}</th>
		</tr>
	</tfoot>
</table>