@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Baca Laporan Keuntungan Bersih</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::cetakexcel($link_laporan_keuntungan_bersih,'dashboard/laporan_keuntungan_bersih/baca/'.$baca_items->id_items.'/cetakexcel') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="center-align">
						<strong>{{$hasil_tanggal}}</strong>
					</div>
					<br/>
                    <table class="table table-responsive-sm table-striped table-sm">
						<tr>
							<th width="150px">Toko</th>
							<th width="1px">:</th>
							<td>
								@if($hasil_toko != '')
									{{$baca_items->nama_tokos}}
								@else
									Semua Toko
								@endif
							</td>
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
                    <table id="tablesort" class="table table-responsive-sm table-bordered table-striped table-sm">
				    	<thead>
				    		<tr>
				    			<th class="nowrap">Tanggal</th>
				    			<th class="nowrap">No</th>
				    			<th class="nowrap">Admin</th>
				    			<th class="nowrap">Jumlah</th>
				    			<th class="nowrap">Harga</th>
				    			<th class="nowrap">Sub Total</th>
				    			<th class="nowrap">Diskon</th>
				    			<th class="nowrap">Pajak</th>
				    			<th class="nowrap">Total</th>
				    		</tr>
				    	</thead>
				    	<tbody>
							@php($kalkulasi_total_pembelians = 0)
							@if(!$transaksi_pembelian->isEmpty())
								@foreach($transaksi_pembelian as $pembelian)
									@php($sub_total_pembelian_details 	= $pembelian->total_pembelian_details)
									@php($pajak_pembelian_details 		= ($sub_total_pembelian_details * $pembelian->pajak_pembelians/100))
									@php($diskon_pembelian_details 		= ($sub_total_pembelian_details * $pembelian->diskon_pembelians/100))
									@php($total_pembelian_details 		= ($sub_total_pembelian_details + $pajak_pembelian_details) - $diskon_pembelian_details)
									<tr>
										<td class="nowrap">{{General::ubahDBKeTanggalwaktu($pembelian->tanggal_pembelians)}}</td>
										<td class="nowrap">{{$pembelian->no_pembelians}}</td>
										<td class="nowrap">{{$pembelian->name}}</td>
										<td class="nowrap right-align">{{$pembelian->jumlah_pembelian_details}}</td>
										<td class="nowrap right-align">{{General::ubahDBKeHarga($pembelian->harga_pembelian_details)}}</td>
										<td class="nowrap right-align">{{General::ubahDBKeHarga($sub_total_pembelian_details)}}</td>
										<td class="nowrap right-align">{{General::ubahDBKeHarga($diskon_pembelian_details)}} ({{$pembelian->diskon_pembelians}}%)</td>
										<td class="nowrap right-align">{{General::ubahDBKeHarga($pajak_pembelian_details)}} ({{$pembelian->pajak_pembelians}}%)</td>
										<td class="nowrap right-align">{{General::ubahDBKeHarga($total_pembelian_details)}}</td>
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
                    <table id="tablesort1" class="table table-responsive-sm table-bordered table-striped table-sm">
				    	<thead>
				    		<tr>
				    			<th class="nowrap">Tanggal</th>
				    			<th class="nowrap">No</th>
				    			<th class="nowrap">Admin</th>
				    			<th class="nowrap">Jumlah</th>
				    			<th class="nowrap">Harga</th>
				    			<th class="nowrap">Sub Total</th>
				    			<th class="nowrap">Diskon</th>
				    			<th class="nowrap">Pajak</th>
				    			<th class="nowrap">Total</th>
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
										<td class="nowrap">{{General::ubahDBKeTanggalwaktu($penjualan->tanggal_penjualans)}}</td>
										<td class="nowrap">{{$penjualan->no_penjualans}}</td>
										<td class="nowrap">{{$penjualan->name}}</td>
										<td class="nowrap right-align">{{$penjualan->jumlah_penjualan_details}}</td>
										<td class="nowrap right-align">{{General::ubahDBKeHarga($penjualan->harga_penjualan_details)}}</td>
										<td class="nowrap right-align">{{General::ubahDBKeHarga($sub_total_penjualan_details)}}</td>
										<td class="nowrap right-align">{{General::ubahDBKeHarga($diskon_penjualan_details)}} ({{$penjualan->diskon_penjualans}}%)</td>
										<td class="nowrap right-align">{{General::ubahDBKeHarga($pajak_penjualan_details)}} ({{$penjualan->pajak_penjualans}}%)</td>
										<td class="nowrap right-align">{{General::ubahDBKeHarga($total_penjualan_details)}}</td>
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
				</div>
				<div class="card-footer right-align">
				  	@if(request()->session()->get('halaman') != '')
		           		@php($ambil_kembali = request()->session()->get('halaman'))
	               	@else
	               		@php($ambil_kembali = URL('dashboard/laporan_keuntungan_bersih'))
	               	@endif
					{{General::kembali($ambil_kembali)}}
				</div>
			</div>
		</div>
	</div>

@endsection