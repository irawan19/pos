@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Penjualan</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::tambah($link_penjualan,'dashboard/penjualan/tambah') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/penjualan/cari') }}">
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
				    				@if(General::totalHakAkses($link_penjualan) != 0)
						    			<th width="5px"></th>
						    		@endif
				    				<th class="nowrap" width="50px">Tanggal</th>
				    				<th class="nowrap" width="50px">Toko</th>
				    				<th class="nowrap">No Penjualan</th>
				    				<th class="nowrap">Referensi Nota</th>
				    				<th class="nowrap">Customer</th>
				    				<th class="nowrap">Admin</th>
				    				<th class="nowrap">Total</th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			@if(!$lihat_penjualans->isEmpty())
		            				@foreach($lihat_penjualans as $penjualans)
								    	<tr>
								    		@if(General::totalHakAkses($link_penjualan) != 0)
								    			<td class="nowrap">
											      	<div class="dropdown">
														<button class="btn btn-sm bg-gradient-success mb-0 dropdown-toggle" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
										            	<div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
										            		{{General::baca($link_penjualan,'dashboard/penjualan/baca/'.$penjualans->id_penjualans)}}
										            		<div class="dropdown-divider"></div>
										            		{{General::edit($link_penjualan,'dashboard/penjualan/edit/'.$penjualans->id_penjualans)}}
										            		<div class="dropdown-divider"></div>
										            		{{General::hapus($link_penjualan,'dashboard/penjualan/hapus/'.$penjualans->id_penjualans, $penjualans->no_penjualans)}}
										            	</div>
										            </div>
											    </td>
								    		@endif
								    		<td class="nowrap">{{General::ubahDBKeTanggalwaktu($penjualans->tanggal_penjualans)}}</td>
								    		<td class="nowrap">{{$penjualans->nama_tokos}}</td>
								    		<td class="nowrap">{{$penjualans->no_penjualans}}</td>
								    		<td class="nowrap">{{$penjualans->no_referensi_nota_penjualans}}</td>
								    		<td class="nowrap">{{$penjualans->nama_customers}}</td>
								    		<td class="nowrap">{{$penjualans->name}}</td>
								    		<td class="nowrap right-align">{{General::ubahDBKeHarga($penjualans->total_penjualans)}}</td>
								    	</tr>
								    @endforeach
								@else
									<tr>
										@if(General::totalHakAkses($link_penjualan) != 0)
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
				    	</table>
				    </div>
					<br/>
				   	{{ $lihat_penjualans->appends(Request::except('page'))->links('vendor.pagination.custom') }}
				</div>
			</div>
		</div>
	</div>

@endsection