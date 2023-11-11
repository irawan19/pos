@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Laporan Penjualan Detail</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::cetakexcel($link_laporan_penjualan_detail,'dashboard/laporan_penjualan_detail/cetakexcel') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/laporan_penjualan_detail/cari') }}">
						@csrf
                        <div class="row">
							<div class="col-sm-3">
								<div class="form-group">
									<select class="form-control select2" id="cari_toko" name="cari_toko">
										@if(Auth::user()->tokos_id == null)
											<option value="" selected>Semua Toko</option>
										@endif
										@foreach($lihat_tokos as $tokos)
											@php($selected = '')
											@if(!empty($hasil_toko))
												@if($tokos->id_tokos == $hasil_toko)
													@php($selected = 'selected')
												@endif
											@else
												@if($tokos->id_tokos == Request::old('cari_toko'))
													@php($selected = 'selected')
												@endif
											@endif
											<option value="{{$tokos->id_tokos}}" {{ $selected }}>{{$tokos->nama_tokos}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-3">
                                <div class="form-group">
                                    <input class="form-control getStartEndDateRange" readonly id="input2-group2" type="text" name="cari_tanggal" placeholder="Cari" value="{{$hasil_tanggal}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input class="form-control" id="input2-group2" type="text" name="cari_kata" placeholder="Cari" value="{{$hasil_kata}}">
                                    <button class="btn btn-primary" type="submit"> Cari</button>
                                </div>
                            </div>
                        </div>
	                </form>
	            	<br/>
	            	<div class="scrolltable">
                        <table id="tablesort" class="table table-responsive-sm table-bordered table-striped table-sm">
				    		<thead>
				    			<tr>
				    				@if(General::totalHakAkses($link_laporan_penjualan_detail) != 0)
						    			<th width="5px"></th>
						    		@endif
				    				<th class="nowrap">Tanggal</th>
				    				<th class="nowrap">No</th>
				    				<th class="nowrap">Toko</th>
				    				<th class="nowrap">Admin</th>
				    				<th class="nowrap">Item</th>
				    				<th class="nowrap">Qty</th>
				    				<th class="nowrap">Customer</th>
				    				<th class="nowrap">Pembayaran</th>
				    				<th class="nowrap">Harga</th>
				    				<th class="nowrap">Total</th>
				    			</tr>
				    		</thead>
				    		<tbody>
                                @php($total_penjualans = 0)
				    			@if(!$lihat_laporan_penjualan_details->isEmpty())
		            				@foreach($lihat_laporan_penjualan_details as $laporan_penjualan_details)
								    	<tr>
								    		@if(General::totalHakAkses($link_laporan_penjualan_detail) != 0)
								    			<td class="nowrap">
                                                    {{General::bacaButton($link_laporan_penjualan_detail,'dashboard/laporan_penjualan_detail/baca/'.$laporan_penjualan_details->id_penjualans)}}
											    </td>
								    		@endif
								    		<td class="nowrap">{{General::ubahDBKeTanggalwaktu($laporan_penjualan_details->tanggal_penjualans)}}</td>
								    		<td class="nowrap">{{$laporan_penjualan_details->no_penjualans}}</td>
								    		<td class="nowrap">{{$laporan_penjualan_details->nama_tokos}}</td>
								    		<td class="nowrap">{{$laporan_penjualan_details->name}}</td>
								    		<td class="nowrap">{{$laporan_penjualan_details->nama_items}}</td>
								    		<td class="nowrap right-align">{{$laporan_penjualan_details->jumlah_penjualan_details}}</td>
								    		<td class="nowrap">{{$laporan_penjualan_details->nama_customers}}</td>
								    		<td class="nowrap">{{$laporan_penjualan_details->nama_pembayarans}}</td>
								    		<td class="nowrap right-align">{{General::ubahDBKeHarga($laporan_penjualan_details->harga_items)}}</td>
								    		<td class="nowrap right-align">{{General::ubahDBKeHarga($laporan_penjualan_details->total_penjualan_details)}}</td>
								    	</tr>
                                        @php($total_penjualans += $laporan_penjualan_details->total_penjualan_details)
								    @endforeach
								@else
									<tr>
										@if(General::totalHakAkses($link_laporan_penjualan_detail) != 0)
											<td colspan="11" class="center-align">Tidak ada data ditampilkan</td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
										@else
											<td colspan="10" class="center-align">Tidak ada data ditampilkan</td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
										@endif
									</tr>
								@endif
				    		</tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="10" class="center-align">Total Penjualan {{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai)}}</th>
                                    <th class="right-align">{{General::ubahDBKeHarga($total_penjualans)}}</th>
                                </tr>
                            </tfoot>
				    	</table>
				    </div>
				</div>
			</div>
		</div>
	</div>

@endsection