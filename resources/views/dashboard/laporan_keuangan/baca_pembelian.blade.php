@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<strong>Baca Laporan Keuangan</strong>
				</div>
				<div class="card-body">
                    <table class="table table-responsive-sm table-striped table-sm">
						<tr>
							<th width="150px">Toko</th>
							<th width="1px">:</th>
							<td>{{$baca_laporan_pembelians->nama_tokos}}</td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<th>:</th>
							<td>{{General::ubahDBKeTanggalwaktu($baca_laporan_pembelians->tanggal_pembelians)}}</td>
						</tr>
						<tr>
							<th>No</th>
							<th>:</th>
							<td>{{$baca_laporan_pembelians->no_pembelians}}</td>
						</tr>
						<tr>
							<th>Supplier</th>
							<th>:</th>
							<td>{{$baca_laporan_pembelians->nama_suppliers}}</td>
						</tr>
						<tr>
							<th>Admin</th>
							<th>:</th>
							<td>{{$baca_laporan_pembelians->name}}</td>
						</tr>
						<tr>
							<th>Pembayaran</th>
							<th>:</th>
							<td>{{$baca_laporan_pembelians->nama_pembayarans}}</td>
						</tr>
						<tr>
							<th>Keterangan</th>
							<th>:</th>
							<td>{!! $baca_laporan_pembelians->keterangan_pembelians !!}</td>
						</tr>
					</table>
                    <table id="tablesort" class="table table-responsive-sm table-bordered table-striped table-sm">
				    	<thead>
				    		<tr>
				    			<th class="nowrap">No</th>
				    			<th class="nowrap">Kategori</th>
				    			<th class="nowrap">Item</th>
				    			<th class="nowrap">Satuan</th>
				    			<th class="nowrap">Jumlah</th>
				    			<th class="nowrap">Harga</th>
				    			<th class="nowrap">Total</th>
				    		</tr>
				    	</thead>
				    	<tbody>
                            @php($sub_total_pembelians = 0)
				    		@if(!$baca_laporan_pembelian_details->isEmpty())
								@php($no = 1)
		            			@foreach($baca_laporan_pembelian_details as $laporan_pembelian_details)
							    	<tr>
							    		<td class="nowrap">{{$no}}</td>
							    		<td class="nowrap">{{$laporan_pembelian_details->nama_kategori_items}}</td>
							    		<td class="nowrap">{{$laporan_pembelian_details->nama_items}}</td>
							    		<td class="nowrap">{{$laporan_pembelian_details->nama_satuans}}</td>
							    		<td class="nowrap">{{$laporan_pembelian_details->jumlah_pembelian_details}}</td>
							    		<td class="nowrap right-align">{{General::ubahDBKeHarga($laporan_pembelian_details->harga_pembelian_details)}}</td>
							    		<td class="nowrap right-align">{{General::ubahDBKeHarga($laporan_pembelian_details->total_pembelian_details)}}</td>
							    	</tr>
                                    @php($sub_total_pembelians += $laporan_pembelian_details->total_pembelian_details)
									@php($no++)
							    @endforeach
							@else
								<tr>
									<td colspan="7" class="center-align">Tidak ada data ditampilkan</td>
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
                                <th colspan="6" class="right-align">Sub Total</th>
                                <th class="right-align">{{General::ubahDBKeHarga($sub_total_pembelians)}}</th>
                            </tr>
                            <tr>
                                <th colspan="6" class="right-align">Pajak</th>
                                <th class="right-align">{{General::ubahDBKeHarga($baca_laporan_pembelians->pajak_pembelians)}}</th>
                            </tr>
                            <tr>
                                <th colspan="6" class="right-align">Diskon</th>
                                <th class="right-align">{{General::ubahDBKeHarga($baca_laporan_pembelians->diskon_pembelians)}}</th>
                            </tr>
                            <tr>
                                <th colspan="6" class="right-align">Total</th>
                                <th class="right-align">{{General::ubahDBKeHarga($baca_laporan_pembelians->total_pembelians)}}</th>
                            </tr>
                        </tfoot>
				    </table>
				</div>
				<div class="card-footer right-align">
				  	@if(request()->session()->get('halaman') != '')
		           		@php($ambil_kembali = request()->session()->get('halaman'))
	               	@else
	               		@php($ambil_kembali = URL('dashboard/laporan_keuangan'))
	               	@endif
					{{General::kembali($ambil_kembali)}}
				</div>
			</div>
		</div>
	</div>

@endsection