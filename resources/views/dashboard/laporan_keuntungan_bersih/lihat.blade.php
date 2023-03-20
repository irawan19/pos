@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Laporan Keuntungan Bersih</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::cetakexcel($link_laporan_keuntungan_bersih,'dashboard/laporan_keuntungan_bersih/cetakexcel') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/laporan_keuntungan_bersih/cari') }}">
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
				    				@if(General::totalHakAkses($link_laporan_keuntungan_bersih) != 0)
						    			<th width="5px"></th>
						    		@endif
				    				<th class="nowrap" width="50px">No</th>
				    				<th class="nowrap">Toko</th>
				    				<th class="nowrap">Kategori</th>
				    				<th class="nowrap">Kode</th>
				    				<th class="nowrap">Nama</th>
				    				<th class="nowrap">Jual</th>
				    				<th class="nowrap">Beli</th>
				    				<th class="nowrap">Keuntungan</th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			@if(!$lihat_laporan_keuntungan_bersihs->isEmpty())
									@php($no = 1)
		            				@foreach($lihat_laporan_keuntungan_bersihs as $laporan_keuntungan_bersihs)
								    	<tr>
								    		@if(General::totalHakAkses($link_laporan_keuntungan_bersih) != 0)
								    			<td class="nowrap">
													{{General::bacaButton($link_laporan_keuntungan_bersih,'dashboard/laporan_keuntungan_bersih/baca/'.$laporan_keuntungan_bersihs->id_items)}}
											    </td>
								    		@endif
								    		<td class="nowrap">{{$no}}</td>
								    		<td class="nowrap">{{$laporan_keuntungan_bersihs->nama_tokos}}</td>
								    		<td class="nowrap">{{$laporan_keuntungan_bersihs->nama_kategori_items}}</td>
								    		<td class="nowrap">{{$laporan_keuntungan_bersihs->kode_items}}</td>
								    		<td class="nowrap">{{$laporan_keuntungan_bersihs->nama_items}}</td>
								    		<td class="nowrap"></td>
								    		<td class="nowrap"></td>
								    		<td class="nowrap right-align"></td>
								    	</tr>
										@php($no++)
								    @endforeach
								@else
									<tr>
										@if(General::totalHakAkses($link_laporan_keuntungan_bersih) != 0)
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
				</div>
			</div>
		</div>
	</div>

@endsection