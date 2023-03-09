<table>
	<tr>
		<td colspan="7" style="font-weight: bold; text-align: center">Laporan Stok</td>
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
			<th>No</th>
			<th>Toko</th>
			<th>Kategori</th>
			<th>Kode</th>
			<th>Nama</th>
			<th>Satuan</th>
			<th>Stok</th>
		</tr>
	</thead>
	<tbody>
        @php($no = 1)
		@if(!$lihat_laporan_stoks->isEmpty())
			@foreach($lihat_laporan_stoks as $laporan_stoks)
				<tr>
					<td>{{$no}}</td>
					<td>{{$laporan_stoks->nama_tokos}}</td>
					<td>{{$laporan_stoks->nama_kategori_items}}</td>
					<td>{{$laporan_stoks->kode_items}}</td>
					<td>{{$laporan_stoks->nama_items}}</td>
					<td>{{$laporan_stoks->nama_satuans}}</td>
					<td align="right">{{$laporan_stoks->stok_items}}</td>
				</tr>
                @php($no++)
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
</table>