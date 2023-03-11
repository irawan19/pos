<table>
	<tr>
		<td colspan="7" style="font-weight: bold; text-align: center">Laporan Keuangan</td>
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
	    	<th>Toko</th>
	    	<th>No</th>
	    	<th>Admin</th>
	    	<th>Masuk</th>
	    	<th>Keluar</th>
	    	<th>Total</th>
	    </tr>
	</thead>
	<tbody>
		@php($total_keuangan_masuk 	= 0)
		@php($total_keuangan_keluar = 0)
		@php($total                 = 0)
		@if(!$lihat_laporan_keuangans->isEmpty())
		    @php($sub_total 			   = 0)
			@foreach($lihat_laporan_keuangans as $laporan_keuangans)
		    	<tr>
		    		<td>{{General::ubahDBKeTanggalwaktu($laporan_keuangans->tanggal_transaksi)}}</td>
		    		<td>{{$laporan_keuangans->nama_tokos}}</td>
		    		<td>{{$laporan_keuangans->no_transaksi}}</td>
		    		<td>{{$laporan_keuangans->nama_admin}}</td>
					@if($laporan_keuangans->jenis_transaksi == 'masuk')
						@php($keuangan_masuk = $laporan_keuangans->total_transaksi)
					@else
						@php($keuangan_masuk = 0)
					@endif
		    		<td align="right-align">
						{{General::ubahDBkeHarga($keuangan_masuk)}}
					</td>
					@if($laporan_keuangans->jenis_transaksi == 'keluar')
						@php($keuangan_keluar = $laporan_keuangans->total_transaksi)
					@else
						@php($keuangan_keluar = 0)
					@endif
		    		<td align="right-align">
						{{General::ubahDBkeHarga($keuangan_keluar)}}
					</td>
					<td align="right-align">
						@php($sub_total += $keuangan_masuk - $keuangan_keluar)
						{{General::ubahDBkeHarga($sub_total)}}
					</td>
		    	</tr>
		    	@php($total_keuangan_masuk 	+= $keuangan_masuk)
		    	@php($total_keuangan_keluar += $keuangan_keluar)
		    	@php($total 			    = $sub_total)
		    @endforeach
		@else
			<tr>
				<td colspan="7" align="right-align">Tidak ada data ditampilkan</td>
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
            <th colspan="4" class="right-align">Total</th>
            <th class="right-align">{{General::ubahDBkeHarga($total_keuangan_masuk)}}</th>
            <th class="right-align">{{General::ubahDBkeHarga($total_keuangan_keluar)}}</th>
            <th class="right-align">{{General::ubahDBkeHarga($total)}}</th>
        </tr>
    </tfoot>
</table>