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
		<th width="150px">Toko</th>
		<th width="1px">:</th>
		<td>{{$baca_items->nama_tokos}}</td>
	</tr>
	<tr>
		<th>Kategori</th>
		<th>:</th>
		<td>{{$baca_items->nama_kategori_items}}</td>
	</tr>
	<tr>
		<th>Item</th>
		<th>:</th>
		<td>{{$baca_items->nama_items}}</td>
	</tr>
	<tr>
		<th>Satuan</th>
		<th>:</th>
		<td>{{$baca_items->nama_satuans}}</td>
	</tr>
	<tr>
		<th>Keuntungan Bersih</th>
		<th>:</th>
		<td>
			@if(!empty($total_pembelians))
				@php($total_all_pembelians = $total_pembelians->total_all_pembelians)
			@else
				@php($total_all_pembelians = 0)
			@endif

			@if(!empty($total_penjualans))
				@php($total_all_penjualans = $total_penjualans->total_all_penjualans)
			@else
				@php($total_all_penjualans = 0)
			@endif

			{{General::ubahDBKeHarga($total_all_penjualans - $total_all_pembelians)}}
		</td>
	</tr>
</table>
<!-- Pembelian -->
<hr style="border:2px solid #202739"/>
<h5>Pembelian</h5>
<hr style="border:2px solid #202739"/>
<table border="1px">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>No</th>
			<th>Admin</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Sub Total</th>
			<th>Diskon</th>
			<th>Pajak</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		@php($kalkulasi_total_pembelians = 0)
		@if(!$transaksi_pembelian->isEmpty())
			@foreach($transaksi_pembelian as $pembelian)
				@php($sub_total_pembelian_details 	= $pembelian->total_pembelian_details)
				@php($pajak_pembelian_details 		= ($sub_total_pembelian_details * $pembelian->pajak_pembelians/100))
				@php($diskon_pembelian_details 		= ($sub_total_pembelian_details * $pembelian->diskon_pembelians/100))
				@php($total_pembelian_details 		= $sub_total_pembelian_details + $pajak_pembelian_details - $diskon_pembelian_details)
				<tr>
					<td>{{General::ubahDBKeTanggalwaktu($pembelian->tanggal_pembelians)}}</td>
					<td>{{$pembelian->no_pembelians}}</td>
					<td>{{$pembelian->name}}</td>
					<td class="right-align">{{$pembelian->jumlah_pembelian_details}}</td>
					<td class="right-align">{{General::ubahDBKeHarga($pembelian->harga_pembelian_details)}}</td>
					<td class="right-align">{{General::ubahDBKeHarga($sub_total_pembelian_details)}}</td>
					<td class="right-align">{{General::ubahDBKeHarga($diskon_pembelian_details)}} ({{$pembelian->diskon_pembelians}}%)</td>
					<td class="right-align">{{General::ubahDBKeHarga($pajak_pembelian_details)}} ({{$pembelian->pajak_pembelians}}%)</td>
					<td class="right-align">{{General::ubahDBKeHarga($total_pembelian_details)}}</td>
				</tr>
				@php($kalkulasi_total_pembelians += $total_pembelian_details)
			@endforeach
		@else
			<tr>
				<td colspan="9" class="center-align">Tidak ada data ditampilkan</td>
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
			<th colspan="8" class="center-align">Total Pembelian {{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_mulai)}}</th>
			<th class="right-align">
				{{General::ubahDBKeHarga($kalkulasi_total_pembelians)}}
			</th>
		</tr>
	</tfoot>
</table>
<!-- Penjualan -->
<hr style="border:2px solid #202739"/>
<h5>Penjualan</h5>
<hr style="border:2px solid #202739"/>
<table border="1px">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>No</th>
			<th>Admin</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Sub Total</th>
			<th>Diskon</th>
			<th>Pajak</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		@php($kalkulasi_total_penjualans = 0)
		@if(!$transaksi_penjualan->isEmpty())
			@foreach($transaksi_penjualan as $penjualan)
				@php($sub_total_penjualan_details 	= $penjualan->total_penjualan_details)
				@php($pajak_penjualan_details 		= ($sub_total_penjualan_details * $penjualan->pajak_penjualans/100))
				@php($diskon_penjualan_details 		= ($sub_total_penjualan_details * $penjualan->diskon_penjualans/100))
				@php($total_penjualan_details 		= $sub_total_penjualan_details + $pajak_penjualan_details - $diskon_penjualan_details)
				<tr>
					<td>{{General::ubahDBkeTanggalwaktu($penjualan->tanggal_penjualans)}}</td>
					<td>{{$penjualan->no_penjualans}}</td>
					<td>{{$penjualan->name}}</td>
					<td class="right-align">{{$penjualan->jumlah_penjualan_details}}</td>
					<td class="right-align">{{General::ubahDBKeHarga($penjualan->harga_penjualan_details)}}</td>
					<td class="right-align">{{General::ubahDBKeHarga($sub_total_penjualan_details)}}</td>
					<td class="right-align">{{General::ubahDBKeHarga($diskon_penjualan_details)}} ({{$penjualan->diskon_penjualans}}%)</td>
					<td class="right-align">{{General::ubahDBKeHarga($pajak_penjualan_details)}} ({{$penjualan->pajak_penjualans}}%)</td>
					<td class="right-align">{{General::ubahDBKeHarga($total_penjualan_details)}}</td>
				</tr>
				@php($kalkulasi_total_penjualans += $total_penjualan_details)
			@endforeach
		@else
			<tr>
				<td colspan="9" class="center-align">Tidak ada data ditampilkan</td>
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
			<th colspan="8" class="center-align">Total Penjualan {{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_mulai)}}</th>
			<th class="right-align">
				{{General::ubahDBKeHarga($kalkulasi_total_penjualans)}}
			</th>
		</tr>
	</tfoot>
</table>