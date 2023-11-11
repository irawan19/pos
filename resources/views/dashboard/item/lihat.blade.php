@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Item</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::tambah($link_item,'dashboard/item/tambah') }}
								{{ General::cetak($link_item,'dashboard/item/cetak') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/item/cari') }}">
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
									<select class="form-control select2" id="cari_kategori_item" name="cari_kategori_item">
										<option value="" selected>Semua Kategori Item</option>
										@foreach($lihat_kategori_items as $kategori_items)
											@php($selected = '')
											@if(!empty($hasil_kategori_item))
												@if($kategori_items->id_kategori_items == $hasil_kategori_item)
													@php($selected = 'selected')
												@endif
											@else
												@if($kategori_items->id_kategori_items == Request::old('cari_kategori_item'))
													@php($selected = 'selected')
												@endif
											@endif
											<option value="{{$kategori_items->id_kategori_items}}" {{ $selected }}>{{$kategori_items->nama_kategori_items}}</option>
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
				    				@if(General::totalHakAkses($link_item) != 0)
						    			<th width="5px"></th>
						    		@endif
				    				<th class="nowrap" width="50px">No</th>
				    				<th class="nowrap">Toko</th>
				    				<th class="nowrap">Kategori</th>
				    				<th class="nowrap">Kode</th>
				    				<th class="nowrap">Nama</th>
				    				<th class="nowrap" width="50px">Foto</th>
				    				<th class="nowrap">Harga</th>
				    				<th class="nowrap">Stok</th>
				    				<th class="nowrap" width="50px">Barcode</th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			@if(!$lihat_items->isEmpty())
									@php($no = 1)
		            				@foreach($lihat_items as $key =>  $items)
										@php($no = $lihat_items->firstItem() + $key) 
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
										            		{{General::hapus($link_item,'dashboard/item/hapus/'.$items->id_items, $items->nama_items)}}
										            	</div>
										            </div>
											    </td>
								    		@endif
								    		<td class="nowrap">{{$no}}</td>
								    		<td class="nowrap">{{$items->nama_tokos}}</td>
								    		<td class="nowrap">{{$items->nama_kategori_items}}</td>
								    		<td class="nowrap">{{$items->kode_items}}</td>
								    		<td class="nowrap">{{$items->nama_items}}</td>
								    		<td class="nowrap">
												@if(!empty($items->foto_items))
													<a data-fancybox="gallery" href="{{URL::asset('storage/'.$items->foto_items)}}">
														<img src="{{ URL::asset('storage/'.$items->foto_items) }}" width="32px">
													</a>
												@else
													<a data-fancybox="gallery" href="{{URL::asset('template/default.png')}}">
														<img src="{{ URL::asset('template/default.png') }}" width="32px">
													</a>
												@endif
                                            </td>
								    		<td class="nowrap right-align">{{General::ubahDBKeHarga($items->harga_items)}}</td>
								    		<td class="nowrap right-align">{{$items->stok_items}}</td>
								    		<td class="nowrap center-align">
												<a data-fancybox="gallery" href="data:image/jpg;base64,{{DNS2D::getBarcodePNG($items->id_items.'-'.$items->nama_items.'-'.$items->harga_items, 'QRCODE', 10, 10)}}" style="background-color:white">
													<img src="data:image/jpg;base64,{{DNS2D::getBarcodePNG($items->id_items.'-'.$items->nama_items.'-'.$items->harga_items, 'QRCODE')}}" alt="barcode" width="32px">
												</a>
												{{General::cetakBarcode($link_item,'dashboard/item/cetakbarcode/'.$items->id_items)}}
								    		</td>
								    	</tr>
										@php($no++)
								    @endforeach
								@else
									<tr>
										@if(General::totalHakAkses($link_item) != 0)
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
										@else
											<td colspan="9" class="center-align">Tidak ada data ditampilkan</td>
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
				    	</table>
				    </div>
					<br/>
				   	{{ $lihat_items->appends(Request::except('page'))->links('vendor.pagination.custom') }}
				</div>
			</div>
		</div>
	</div>

@endsection