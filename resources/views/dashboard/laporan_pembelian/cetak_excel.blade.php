<table>
	<tr>
		<td colspan="7" style="font-weight: bold; text-align: center">Laporan Pembelian</td>
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
			<th>Supplier</th>
			<th>Pembayaran</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		@php($total_pembelians = 0)
		@if(!$lihat_laporan_pembelians->isEmpty())
			@foreach($lihat_laporan_pembelians as $laporan_pembelians)
				<tr>
					<td>{{General::ubahDBKeTanggalwaktu($laporan_pembelians->tanggal_pembelians)}}</td>
					<td>{{$laporan_pembelians->no_pembelians}}</td>
					<td>{{$laporan_pembelians->nama_tokos}}</td>
					<td>{{$laporan_pembelians->name}}</td>
					<td>{{$laporan_pembelians->nama_suppliers}}</td>
					<td>{{$laporan_pembelians->nama_pembayarans}}</td>
					<td align="right">{{General::ubahDBKeHarga($laporan_pembelians->total_pembelians)}}</td>
				</tr>
				@php($total_pembelians += $laporan_pembelians->total_pembelians)
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
			<th colspan="6" align="center">Total Pembelian {{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai)}}</th>
			<th align="right">{{General::ubahDBKeHarga($total_pembelians)}}</th>
		</tr>
	</tfoot>
</table>