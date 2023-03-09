@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Menu</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::tambah($link_menu,'dashboard/menu/tambah') }} {{ General::urutan($link_menu,'dashboard/menu/urutan') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/menu/cari') }}">
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
				    				@if(General::totalHakAkses($link_menu) != 0)
					    				<th class="nowrap" width="5px"></th>
					    			@endif
				    				<th class="nowrap" width="50px">No</th>
				    				<th class="nowrap" width="5px">Icon</th>
				    				<th class="nowrap">Nama</th>
				    				<th class="nowrap">Sub Menu</th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			@if(!$lihat_menus->isEmpty())
					    			@php($no = 1)
		            				@foreach($lihat_menus as $menus)
								    	<tr>
					    					@if(General::totalHakAkses($link_menu) != 0)
					    						<td class="nowrap">
													<div class="dropdown">
														<button class="btn btn-sm bg-gradient-success mb-0 dropdown-toggle" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
										            	<div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
										            		{{General::subMenu($link_menu,'dashboard/menu/submenu/'.$menus->id_menus)}}
										            		<div class="dropdown-divider"></div>
										            		{{General::baca($link_menu,'dashboard/menu/baca/'.$menus->id_menus)}}
										            		<div class="dropdown-divider"></div>
										            		{{General::edit($link_menu,'dashboard/menu/edit/'.$menus->id_menus)}}
										            		<div class="dropdown-divider"></div>
										            		{{General::hapus($link_menu,'dashboard/menu/hapus/'.$menus->id_menus, $menus->nama_menus)}}
										            	</div>
										            </div>
											    </td>
									    	@endif
								    		<td class="nowrap">{{$no}}</td>
								    		<td style="text-align:center">
								    			<svg class="c-sidebar-nav-icon" style="width:20px; height:20px;">
										          	<use xlink:href="{{URL::asset('template/back/assets/icons/coreui/free.svg#'.$menus->icon_menus)}}"></use>
										        </svg>
								    		</td>
								    		<td>{{$menus->nama_menus}}</td>
								    		<td>
												@php($ambil_total_sub_menu = \App\Models\Master_menu::where('menus_id',$menus->id_menus)
																									->count())
												{{$ambil_total_sub_menu}}
											</td>
								    	</tr>
								    	@php($no++)
								    @endforeach
								@else
									<tr>
										@if(General::totalHakAkses($link_menu) != 0)
											<td colspan="5" class="center-align">Tidak ada data ditampilkan</td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
										@else
											<td colspan="4" class="center-align">Tidak ada data ditampilkan</td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
										@endif
									</tr>
								@endif
				    		</tbody>
				    	</table>
				    </div>
				</div>
			</div>
		</div>
	</div>

@endsection