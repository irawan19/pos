@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Admin</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::tambah($link_admin,'dashboard/admin/tambah') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/admin/cari') }}">
						@csrf
	                	<div class="input-group">
	                		<input class="form-control" id="input2-group2" type="text" name="cari_kata" placeholder="Cari" value="{{$hasil_kata}}">
	                		<button class="btn btn-primary" type="submit"> Cari</button>
	                	</div>
	                </form>
	            	<br/>
	            	<div class="scrolltable">
				    	<table id="tablesort" class="table table-responsive-sm table-bordered table-striped table-sm">
				    		<thead>
				    			<tr>
				    				@if(General::totalHakAkses($link_admin) != 0)
					    				<th class="nowrap" width="5px"></th>
					    			@endif
				    				<th class="nowrap" width="50px">No</th>
				    				<th class="nowrap">Toko</th>
				    				<th class="nowrap">Level Sistem</th>
				    				<th class="nowrap">Nama</th>
				    				<th class="nowrap">Username</th>
				    				<th class="nowrap">Email</th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			@if(!$lihat_admins->isEmpty())
					    			@php($no = 1)
		            				@foreach($lihat_admins as $admins)
								    	<tr>
					    					@if(General::totalHakAkses($link_admin) != 0)
					    						<td class="nowrap">
													<div class="dropdown">
														<button class="btn btn-sm bg-gradient-success mb-0 dropdown-toggle" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
															{{General::baca($link_admin,'dashboard/admin/baca/'.$admins->id)}}
															<div class="dropdown-divider"></div>
															{{General::edit($link_admin,'dashboard/admin/edit/'.$admins->id)}}
															<div class="dropdown-divider"></div>
															{{General::hapus($link_admin,'dashboard/admin/hapus/'.$admins->id, $admins->name)}}
														</div>
													</div>
											    </td>
									    	@endif
								    		<td class="nowrap">{{$no}}</td>
								    		<td class="nowrap">
												@if($admins->tokos_id != null)
													{{$admins->nama_tokos}}
												@else
													Semua Toko
												@endif
											</td>
								    		<td class="nowrap">{{$admins->nama_level_sistems}}</td>
								    		<td class="nowrap">{{$admins->name}}</td>
								    		<td class="nowrap">{{$admins->username}}</td>
								    		<td class="nowrap">
								    			<a href="mailto:{{$admins->email}}">
								    				{{$admins->email}}
								    			</a>
								    		</td>
								    	</tr>
								    	@php($no++)
								    @endforeach
								@else
									<tr>
										@if(General::totalHakAkses($link_admin) != 0)
											<td colspan="7" class="center-align">Tidak ada data ditampilkan</td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
										@else
											<td colspan="6" class="center-align">Tidak ada data ditampilkan</td>
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
				   	{{ $lihat_admins->appends(Request::except('page'))->links('vendor.pagination.custom') }}
				</div>
			</div>
		</div>
	</div>

@endsection