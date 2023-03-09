<table>
	<tr>
		<td colspan="7" style="font-weight: bold; text-align: center">Laporan Penjualan</td>
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
			<th>Customer</th>
			<th>Pembayaran</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		@php($total_penjualans = 0)
		@if(!$lihat_laporan_penjualans->isEmpty())
			@foreach($lihat_laporan_penjualans as $laporan_penjualans)
				<tr>
					<td>{{General::ubahDBKeTanggalwaktu($laporan_penjualans->tanggal_penjualans)}}</td>
					<td>{{$laporan_penjualans->no_penjualans}}</td>
					<td>{{$laporan_penjualans->nama_tokos}}</td>
					<td>{{$laporan_penjualans->name}}</td>
					<td>{{$laporan_penjualans->nama_customers}}</td>
					<td>{{$laporan_penjualans->nama_pembayarans}}</td>
					<td align="right">{{General::ubahDBKeHarga($laporan_penjualans->total_penjualans)}}</td>
				</tr>
				@php($total_penjualans += $laporan_penjualans->total_penjualans)
			@endforeach
		@else
			<tr>
				<td colspan="7" align="center">Tidak ada data ditampilkan</td>
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
			<th colspan="6" align="center">Total Penjualan {{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai)}}</th>
			<th align="right">{{General::ubahDBKeHarga($total_penjualans)}}</th>
		</tr>
	</tfoot>
</table>