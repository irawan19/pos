@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Pembayaran</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::tambah($link_pembayaran,'dashboard/pembayaran/tambah') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/pembayaran/cari') }}">
						@csrf
                        <div class="row">
							<div class="col-sm-6">
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
				    				@if(General::totalHakAkses($link_pembayaran) != 0)
						    			<th width="5px"></th>
						    		@endif
				    				<th class="nowrap" width="50px">No</th>
				    				<th class="nowrap">Toko</th>
				    				<th class="nowrap">Nama</th>
				    				<th class="nowrap">Akun</th>
				    				<th class="nowrap">No Rekening</th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			@if(!$lihat_pembayarans->isEmpty())
									@php($no = 1)
		            				@foreach($lihat_pembayarans as $key => $pembayarans)
										@php($no = $lihat_pembayarans->firstItem() + $key) 
								    	<tr>
								    		@if(General::totalHakAkses($link_pembayaran) != 0)
								    			<td class="nowrap">
													@if($pembayarans->id_pembayarans != 1)
														<div class="dropdown">
															<button class="btn btn-sm bg-gradient-success mb-0 dropdown-toggle" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
															<div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
																{{General::edit($link_pembayaran,'dashboard/pembayaran/edit/'.$pembayarans->id_pembayarans)}}
																<div class="dropdown-divider"></div>
																{{General::hapus($link_pembayaran,'dashboard/pembayaran/hapus/'.$pembayarans->id_pembayarans, $pembayarans->nama_pembayarans)}}
															</div>
														</div>
													@endif
											    </td>
								    		@endif
								    		<td class="nowrap">{{$no}}</td>
								    		<td class="nowrap">
												@if($pembayarans->tokos_id != null)
													{{$pembayarans->nama_tokos}}
												@else
													Semua Toko
												@endif
											</td>
								    		<td class="nowrap">{{$pembayarans->nama_pembayarans}}</td>
								    		<td class="nowrap">{{$pembayarans->akun_pembayarans}}</td>
								    		<td class="nowrap">{{$pembayarans->no_rekening_pembayarans}}</td>
								    	</tr>
										@php($no++)
								    @endforeach
								@else
									<tr>
										@if(General::totalHakAkses($link_pembayaran) != 0)
											<td colspan="6" class="center-align">Tidak ada data ditampilkan</td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
										@else
											<td colspan="4" class="center-align">Tidak ada data ditampilkan</td>
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
				   	{{ $lihat_pembayarans->appends(Request::except('page'))->links('vendor.pagination.custom') }}
				</div>
			</div>
		</div>
	</div>

@endsection