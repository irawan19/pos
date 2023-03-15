@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<strong>Baca Penjualan</strong>
				</div>
				<div class="card-body">
                    <table class="table table-responsive-sm table-striped table-sm">
						<tr>
							<th width="150px">Toko</th>
							<th width="1px">:</th>
							<td>{{$baca_penjualans->nama_tokos}}</td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<th>:</th>
							<td>{{General::ubahDBKeTanggalwaktu($baca_penjualans->tanggal_penjualans)}}</td>
						</tr>
						<tr>
							<th>No</th>
							<th>:</th>
							<td>{{$baca_penjualans->no_penjualans}}</td>
						</tr>
						<tr>
							<th>Customer</th>
							<th>:</th>
							<td>{{$baca_penjualans->nama_customers}}</td>
						</tr>
						<tr>
							<th>Telepon Customer</th>
							<th>:</th>
							<td>{{$baca_penjualans->telepon_customers}}</td>
						</tr>
						<tr>
							<th>Admin</th>
							<th>:</th>
							<td>{{$baca_penjualans->name}}</td>
						</tr>
						<tr>
							<th>Pembayaran</th>
							<th>:</th>
							<td>{{$baca_penjualans->nama_pembayarans}}</td>
						</tr>
						<tr>
							<th>Keterangan</th>
							<th>:</th>
							<td>{!! $baca_penjualans->keterangan_penjualans !!}</td>
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
                            @php($sub_total_penjualans = 0)
				    		@if(!$baca_penjualan_details->isEmpty())
								@php($no = 1)
		            			@foreach($baca_penjualan_details as $penjualan_details)
							    	<tr>
							    		<td class="nowrap">{{$no}}</td>
							    		<td class="nowrap">{{$penjualan_details->nama_kategori_items}}</td>
							    		<td class="nowrap">{{$penjualan_details->nama_items}}</td>
							    		<td class="nowrap">{{$penjualan_details->nama_satuans}}</td>
							    		<td class="nowrap">{{$penjualan_details->jumlah_penjualan_details}}</td>
							    		<td class="nowrap right-align">{{General::ubahDBKeHarga($penjualan_details->harga_penjualan_details)}}</td>
							    		<td class="nowrap right-align">{{General::ubahDBKeHarga($penjualan_details->total_penjualan_details)}}</td>
							    	</tr>
                                    @php($sub_total_penjualans += $penjualan_details->total_penjualan_details)
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
                                <th class="right-align">{{General::ubahDBKeHarga($sub_total_penjualans)}}</th>
                            </tr>
                            <tr>
                                <th colspan="6" class="right-align">Pajak</th>
                                <th class="right-align">{{General::ubahDBKeHarga($sub_total_penjualans * $baca_penjualans->pajak_penjualans/100)}}</th>
                            </tr>
                            <tr>
                                <th colspan="6" class="right-align">Diskon</th>
                                <th class="right-align">{{General::ubahDBKeHarga($sub_total_penjualans * $baca_penjualans->diskon_penjualans/100)}}</th>
                            </tr>
                            <tr>
                                <th colspan="6" class="right-align">Total</th>
                                <th class="right-align">{{General::ubahDBKeHarga($baca_penjualans->total_penjualans)}}</th>
                            </tr>
                        </tfoot>
				    </table>
				</div>
				<div class="card-footer right-align">
				  	@if(request()->session()->get('halaman') != '')
		           		@php($ambil_kembali = request()->session()->get('halaman'))
	               	@else
	               		@php($ambil_kembali = URL('dashboard/penjualan'))
	               	@endif
					{{General::kembali($ambil_kembali)}}
				</div>
			</div>
		</div>
	</div>

@endsection