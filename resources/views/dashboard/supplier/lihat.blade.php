@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Supplier</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::tambah($link_supplier,'dashboard/supplier/tambah') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/supplier/cari') }}">
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
				    				@if(General::totalHakAkses($link_supplier) != 0)
						    			<th width="5px"></th>
						    		@endif
				    				<th class="nowrap" width="50px">No</th>
				    				<th class="nowrap">Toko</th>
				    				<th class="nowrap">Nama</th>
				    				<th class="nowrap">Telepon</th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			@if(!$lihat_suppliers->isEmpty())
									@php($no = 1)
		            				@foreach($lihat_suppliers as $key => $suppliers)
										@php($no = $lihat_suppliers->firstItem() + $key) 
								    	<tr>
								    		@if(General::totalHakAkses($link_supplier) != 0)
								    			<td class="nowrap">
											      	<div class="dropdown">
														<button class="btn btn-sm bg-gradient-success mb-0 dropdown-toggle" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
										            	<div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
										            		{{General::edit($link_supplier,'dashboard/supplier/edit/'.$suppliers->id_suppliers)}}
										            		<div class="dropdown-divider"></div>
										            		{{General::hapus($link_supplier,'dashboard/supplier/hapus/'.$suppliers->id_suppliers, $suppliers->nama_suppliers)}}
										            	</div>
										            </div>
											    </td>
								    		@endif
								    		<td class="nowrap">{{$no}}</td>
								    		<td class="nowrap">{{$suppliers->nama_tokos}}</td>
								    		<td class="nowrap">{{$suppliers->nama_suppliers}}</td>
								    		<td class="nowrap">{{$suppliers->telepon_suppliers}}</td>
								    	</tr>
										@php($no++)
								    @endforeach
								@else
									<tr>
										@if(General::totalHakAkses($link_supplier) != 0)
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
					<br/>
				   	{{ $lihat_suppliers->appends(Request::except('page'))->links('vendor.pagination.custom') }}
				</div>
			</div>
		</div>
	</div>

@endsection