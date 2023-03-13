<style>
    table {border-collapse: collapse;}
    @media print 
    {
        @page
        {
            size: portrait;
        }
    }
    table
    {
        border-collapse : collapse;
        font-size       : 8px;
    }
    .page {
        page-break-before: always;
    }
    .page:first-child {
        page-break-before: avoid;
    }
    .nowraptable{
		white-space: nowrap;
	}
</style>
<div class="page">
	<div style="text-align: center">
		<p style="font-size: 10px;font-weight: bold; margin-bottom: -10px">{{$cetak_penjualans->nama_tokos}}</p>
		<p style="font-size: 8px;">{!! nl2br($cetak_penjualans->alamat_tokos) !!}</p>
	</div>
	<hr/>
	<table width="100%">
		<tr>
			<th style="text-align: left" width="100px">Tanggal</th>
			<th width="1px">:</th>
			<td>{{General::ubahDBKeTanggalwaktu($cetak_penjualans->tanggal_penjualans)}}</td>
		</tr>
		<tr>
			<th style="text-align: left">No.</th>
			<th>:</th>
			<td>{{$cetak_penjualans->no_penjualans}}</td>
		</tr>
		<tr>
			<th style="text-align: left">Kasir</th>
			<th>:</th>
			<td>{{$cetak_penjualans->name}}</td>
		</tr>
	</table>
	<hr/>
	<table width="100%">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Qty</th>
			<th>Harga</th>
			<th>Jumlah</th>
		</tr>
		@php($no = 1)
		@foreach($cetak_penjualan_details as $penjualan_details)
			<tr>
				<td>{{$no}}</td>
				<td>{{$penjualan_details->nama_items}}</td>
				<td style="text-align: right">{{$penjualan_details->jumlah_penjualan_details}}</td>
				<td style="text-align: right">{{General::ubahDBKeHarga($penjualan_details->harga_penjualan_details)}}</td>
				<td style="text-align: right">{{General::ubahDBKeHarga($penjualan_details->jumlah_penjualan_details * $penjualan_details->harga_penjualan_details)}}</td>
			</tr>
			@php($no++)
		@endforeach
		<tr>
			<th style="text-align: right" colspan="4">Sub Total</th>
			<th style="text-align: right">{{General::ubahDBKeHarga($cetak_penjualans->sub_total_penjualans)}}</th>
		</tr>
		<tr>
			<th style="text-align: right" colspan="4">Pajak {{$cetak_penjualans->pajak_penjualans}}%</th>
			<th style="text-align: right">{{General::ubahDBKeHarga(($cetak_penjualans->sub_total_penjualans * $cetak_penjualans->pajak_penjualans/100))}}</th>
		</tr>
		<tr>
			<th style="text-align: right" colspan="4">Diskon {{$cetak_penjualans->diskon_penjualans}}%</th>
			<th style="text-align: right">{{General::ubahDBKeHarga(($cetak_penjualans->sub_total_penjualans * $cetak_penjualans->diskon_penjualans/100))}}</th>
		</tr>
		<tr>
			<th style="text-align: right" colspan="4">Total</th>
			<th style="text-align: right">{{General::ubahDBKeHarga($cetak_penjualans->total_penjualans)}}</th>
		</tr>
	</table>
	<hr/>
	<table width="100%">
		<tr>
			<td>Terima Kasih Atas Kunjungan Anda</td>
		</tr>
		<tr>
			<td>Periksa barang sebelum dibeli</td>
		</tr>
		<tr>
			<td>Barang yang sudah dibeli tidak bisa ditukar atau dikembalikan</td>
		</tr>
	</table>
</div>
<script type="text/javascript">window.onload=function(){window.print();setTimeout(function(){window.close(window.location = "{{URL('/dashboard/kasir')}}");}, 1);}</script>