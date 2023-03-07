@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Item</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::tambah($link_item,'dashboard/item/tambah') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/item/cari') }}">
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
				    				@if(General::totalHakAkses($link_item) != 0)
						    			<th width="5px"></th>
						    		@endif
				    				<th class="nowrap">Kategori</th>
				    				<th class="nowrap">Nama</th>
				    				<th class="nowrap" width="50px">Foto</th>
				    				<th class="nowrap">Harga</th>
				    				<th class="nowrap">Stock</th>
				    				<th class="nowrap" width="50px">Barcode</th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			@if(!$lihat_items->isEmpty())
		            				@foreach($lihat_items as $items)
								    	<tr>
								    		@if(General::totalHakAkses($link_item) != 0)
								    			<td class="nowrap">
											      	<div class="dropdown">
														<button class="btn btn-sm bg-gradient-success mb-0 dropdown-toggle" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
										            	<div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
										            		{{General::baca($link_item,'dashboard/item/baca/'.$items->id_items)}}
										            		<div class="dropdown-divider"></div>
										            		{{General::edit($link_item,'dashboard/item/edit/'.$items->id_items)}}
										            		<div class="dropdown-divider"></div>
										            		{{General::hapus($link_item,'dashboard/item/hapus/'.$items->id_items, $items->id_items.' - '.$items->nama_items)}}
										            	</div>
										            </div>
											    </td>
								    		@endif
								    		<td class="nowrap">{{$items->nama_kategori_items}}</td>
								    		<td class="nowrap">{{$items->nama_items}}</td>
								    		<td class="nowrap">
                                                <a data-fancybox="gallery" href="{{URL::asset('storage/'.$items->foto_items)}}">
                                                    <img src="{{ URL::asset('storage/'.$items->foto_items) }}" width="32px">
                                                </a>
                                            </td>
								    		<td class="nowrap right-align">{{General::ubahDBKeHarga($items->harga_items)}}</td>
								    		<td class="nowrap right-align">{{$items->stock_items}}</td>
								    		<td class="nowrap center-align">
												<a data-fancybox="gallery" href="data:image/png;base64,{{DNS2D::getBarcodePNG($items->id_items.'-'.$items->nama_items.'-'.$items->harga_items, 'QRCODE')}}">
													<img src="data:image/png;base64,{{DNS2D::getBarcodePNG($items->id_items.'-'.$items->nama_items.'-'.$items->harga_items, 'QRCODE')}}" alt="barcode" width="32px">
												</a>
												{{General::cetakBarcode($link_item,'dashboard/item/cetakbarcode/'.$items->id_items)}}
								    		</td>
								    	</tr>
								    @endforeach
								@else
									<tr>
										@if(General::totalHakAkses($link_item) != 0)
											<td colspan="6" class="center-align">Tidak ada data ditampilkan</td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
										@else
											<td colspan="5" class="center-align">Tidak ada data ditampilkan</td>
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
				   	{{ $lihat_items->appends(Request::except('page'))->links('vendor.pagination.custom') }}
				</div>
			</div>
		</div>
	</div>

@endsection