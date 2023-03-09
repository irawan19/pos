@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Laporan Penjualan</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::cetakexcel($link_laporan_penjualan,'dashboard/laporan_penjualan/cetakexcel') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/laporan_penjualan/cari') }}">
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
				    				@if(General::totalHakAkses($link_laporan_penjualan) != 0)
						    			<th width="5px"></th>
						    		@endif
				    				<th class="nowrap">Tanggal</th>
				    				<th class="nowrap">No</th>
				    				<th class="nowrap">Toko</th>
				    				<th class="nowrap">Admin</th>
				    				<th class="nowrap">Customer</th>
				    				<th class="nowrap">Pembayaran</th>
				    				<th class="nowrap">Total</th>
				    			</tr>
				    		</thead>
				    		<tbody>
                                @php($total_penjualans = 0)
				    			@if(!$lihat_laporan_penjualans->isEmpty())
		            				@foreach($lihat_laporan_penjualans as $laporan_penjualans)
								    	<tr>
								    		@if(General::totalHakAkses($link_laporan_penjualan) != 0)
								    			<td class="nowrap">
                                                    {{General::bacaButton($link_laporan_penjualan,'dashboard/laporan_penjualan/baca/'.$laporan_penjualans->id_penjualans)}}
											    </td>
								    		@endif
								    		<td class="nowrap">{{General::ubahDBKeTanggalwaktu($laporan_penjualans->tanggal_penjualans)}}</td>
								    		<td class="nowrap">{{$laporan_penjualans->no_penjualans}}</td>
								    		<td class="nowrap">{{$laporan_penjualans->nama_tokos}}</td>
								    		<td class="nowrap">{{$laporan_penjualans->name}}</td>
								    		<td class="nowrap">{{$laporan_penjualans->nama_customers}}</td>
								    		<td class="nowrap">{{$laporan_penjualans->nama_pembayarans}}</td>
								    		<td class="nowrap right-align">{{General::ubahDBKeHarga($laporan_penjualans->total_penjualans)}}</td>
								    	</tr>
                                        @php($total_penjualans += $laporan_penjualans->total_penjualans)
								    @endforeach
								@else
									<tr>
										@if(General::totalHakAkses($link_laporan_penjualan) != 0)
											<td colspan="8" class="center-align">Tidak ada data ditampilkan</td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
										@else
											<td colspan="7" class="center-align">Tidak ada data ditampilkan</td>
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
                                    <th colspan="7" class="center-align">Total Penjualan {{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai)}}</th>
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