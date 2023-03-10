<table>
	<tr>
		<td colspan="6" style="font-weight: bold; text-align: center">Laporan Stok</td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
	</tr>
	<tr>
		<td colspan="6" style="font-weight: bold; text-align: center">{{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai)}}</td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
		<td style="display:none"></td>
	</tr>
</table>
<table border="1px">
	<tr>
		<th width="100px">Toko</th>
		<th width="1px">:</th>
		<td>{{$baca_items->nama_tokos}}</td>
	</tr>
	<tr>
		<th>Kategori</th>
		<th>:</th>
		<td>{{$baca_items->nama_kategori_items}}</td>
	</tr>
	<tr>
		<th>Produk</th>
		<th>:</th>
		<td>{{$baca_items->nama_items}}</td>
	</tr>
	<tr>
		<th>Satuan</th>
		<th>:</th>
		<td>{{$baca_items->nama_satuans}}</td>
	</tr>
</table>
<table border="1px">
	<thead>
		<tr>
            <th>Tanggal</th>
            <th>No</th>
            <th>Admin</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Sub Total</th>
		</tr>
	</thead>
	<tbody>
    @php($sub_total 		= 0)
	@php($total_stok_masuk 	= 0)
	@php($total_stok_keluar = 0)
	@php($total 			= 0)
	@if(!$baca_laporan_stoks->isEmpty())
		@foreach($baca_laporan_stoks as $laporan_stoks)
	    	<tr>
	    		<td>{{General::ubahDBKeTanggalwaktu($laporan_stoks->tanggal_transaksi)}}</td>
	    		<td>{{$laporan_stoks->no_transaksis}}</td>
	    		<td>{{$laporan_stoks->nama_admin}}</td>
	    		<td align="right">
					@if($laporan_stoks->jenis_transaksi == 'masuk')
						@php($jumlah_stok_masuk = $laporan_stoks->total_transaksi)
					@else
						@php($jumlah_stok_masuk = 0)
					@endif
					{{$jumlah_stok_masuk}}
				</td>
	    		<td align="right">
					@if($laporan_stoks->jenis_transaksi == 'keluar')
						@php($jumlah_stok_keluar = $laporan_stoks->total_transaksi)
					@else
						@php($jumlah_stok_keluar = 0)
					@endif
					{{$jumlah_stok_keluar}}
				</td>
				<td align="right">
					@php($sub_total += $jumlah_stok_masuk - $jumlah_stok_keluar)
					{{$sub_total}}
				</td>
	    	</tr>
	    	@php($total_stok_masuk 	+= $jumlah_stok_masuk)
	    	@php($total_stok_keluar += $jumlah_stok_keluar)
	    	@php($total 			= $sub_total)
	    @endforeach
	@else
		<tr>
			<td colspan="6" align="center">Tidak ada data ditampilkan</td>
			<td style="display:none"></td>
			<td style="display:none"></td>
			<td style="display:none"></td>
			<td style="display:none"></td>
			<td style="display:none"></td>
		</tr>
	@endif
	</tbody>
</table>