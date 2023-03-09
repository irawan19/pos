@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/level_sistem/prosesedit/'.$edit_level_sistems->id_level_sistems) }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Edit Level Sistem</strong>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-col-form-label" for="nama_level_sistems">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_level_sistems')) }}" id="nama_level_sistems" type="text" name="nama_level_sistems" value="{{Request::old('nama_level_sistems') == '' ? $edit_level_sistems->nama_level_sistems : Request::old('nama_level_sistems')}}">
							{{General::pesanErrorForm($errors->first('nama_level_sistems'))}}
						</div>
						<hr/>
						<table class="table table-responsive-sm table-bordered table-striped table-sm">
							<thead>
								<tr>
									<th class="center-align" width="40%" rowspan="3" scope="col">Menu</th>
									<th class="center-align" colspan="6" scope="col">Hak Akses</th>
								</tr>
								<tr>
									<th class="center-align" width="10%">Lihat</th>
									<th class="center-align" width="10%">Baca</th>
									<th class="center-align" width="10%">Tambah</th>
									<th class="center-align" width="10%">Edit</th>
									<th class="center-align" width="10%">Hapus</th>
									<th class="center-align" width="10%">Cetak</th>
								</tr>
								<tr>
									<th class="center-align">
										<label>
	                                     	<input type="checkbox" name="checkbox_all_lihat[]" class="chk-all-lihat" id="fiturs_all_lihat" value="">
										</label>
									</th>
									<th class="center-align">
										<label>
	                                     	<input type="checkbox" name="checkbox_all_baca[]" class="chk-all-baca" id="fiturs_all_baca" value="" {{ Request::old('checkbox_all_baca') != '' ? $checked='checked' : $checked='' }}>
										</label>
									</th>
									<th class="center-align">
										<label>
	                                     	<input type="checkbox" name="checkbox_all_tambah[]" class="chk-all-tambah" id="fiturs_all_tambah" value="" {{ Request::old('checkbox_all_tambah') != '' ? $checked='checked' : $checked='' }}>
										</label>
									</th>
									<th class="center-align">
										<label>
	                                     	<input type="checkbox" name="checkbox_all_edit[]" class="chk-all-edit" id="fiturs_all_edit" value="" {{ Request::old('checkbox_all_edit') != '' ? $checked='checked' : $checked='' }}>
										</label>
									</th>
									<th class="center-align">
										<label>
	                                     	<input type="checkbox" name="checkbox_all_hapus[]" class="chk-all-hapus" id="fiturs_all_hapus" value="" {{ Request::old('checkbox_all_hapus') != '' ? $checked='checked' : $checked='' }}>
										</label>
									</th>
									<th class="center-align">
										<label>
	                                     	<input type="checkbox" name="checkbox_all_cetak[]" class="chk-all-cetak" id="fiturs_all_cetak" value="" {{ Request::old('checkbox_all_cetak') != '' ? $checked='checked' : $checked='' }}>
										</label>
									</th>
								</tr>
							</thead>
							@php($id_level_sistems = $edit_level_sistems->id_level_sistems)
							@php($no_checkbox = 1)
							@foreach($edit_menus as $menus)
							<tbody>
								<tr>
									<td align="left" colspan="7"><b style="color:#3300ff;text-transform: uppercase;">{{ $menus->nama_menus }}</b></td>
								</tr>
								@php($id_menus = $menus->id_menus)
								@php($get_sub_menus = \App\Models\Master_menu::where('menus_id',$id_menus)
																		->orderBy('order_menus')
																		->get())
								@foreach($get_sub_menus as $sub_menus)
									@php($id_sub_menus = $sub_menus->id_menus)
									@php($tambah_fiturs = \App\Models\Master_fitur::where('menus_id',$id_sub_menus)->get())
									<tr>
										<td>
											<b style="color:#cc0000">
												<svg class="c-sidebar-nav-icon" style="width:20px; height:20px">
										          	<use xlink:href="{{URL::asset('template/back/assets/icons/coreui/free.svg#'.$sub_menus->icon_menus)}}"></use>
										        </svg>&nbsp; {{ $sub_menus->nama_menus }}
										    </b>
										</td>
										<td class="center-align">
											@foreach($tambah_fiturs as $fiturs_lihat)
												@php($check_fiturs = $fiturs_lihat->nama_fiturs)
												@if($check_fiturs == 'lihat')
													@php($id_fiturs = $fiturs_lihat->id_fiturs)
													@php($edit_akses = \App\Models\Master_akses::where('level_sistems_id',$id_level_sistems)->where('fiturs_id',$id_fiturs)->first())
													@php($check_fiturs = 0)
													@if($edit_akses != null)
														@php($check_fiturs = $edit_akses->fiturs_id)
													@endif

													@php($checked = '')
													@if($id_fiturs == $check_fiturs)
														@php($checked = 'checked')
													@endif

													<label>
			                                        	<input type="checkbox" name="fiturs_id[]" id="fitur_lihat{{$no_checkbox}}" class="chk-lihat" value="{{ $fiturs_lihat->id_fiturs }}" {{ $checked }}>
			                                        	<span></span>
													</label>
												@endif
											@endforeach
										</td>
										<td class="center-align">
											@foreach($tambah_fiturs as $fiturs_baca)
												@php($check_fiturs = $fiturs_baca->nama_fiturs)
												@if($check_fiturs == 'baca')
													@php($id_fiturs = $fiturs_baca->id_fiturs)
													@php($edit_akses = \App\Models\Master_akses::where('level_sistems_id',$id_level_sistems)->where('fiturs_id',$id_fiturs)->first())
													@php($check_fiturs = 0)
													@if($edit_akses != null)
														@php($check_fiturs = $edit_akses->fiturs_id)
													@endif

													@php($checked = '')
													@if($id_fiturs == $check_fiturs)
														@php($checked = 'checked')
													@endif

													<label>
			                                        	<input type="checkbox" name="fiturs_id[]" id="fitur_baca{{$no_checkbox}}" class="chk-baca" value="{{ $fiturs_baca->id_fiturs }}" {{ $checked }}>
			                                        	<span></span>
													</label>
												@endif
											@endforeach
										</td>
										<td class="center-align">
											@foreach($tambah_fiturs as $fiturs_tambah)
												@php($check_fiturs = $fiturs_tambah->nama_fiturs)
												@if($check_fiturs == 'tambah')
													@php($id_fiturs = $fiturs_tambah->id_fiturs)
													@php($tambah_akses = \App\Models\Master_akses::where('level_sistems_id',$id_level_sistems)->where('fiturs_id',$id_fiturs)->first())
													@php($check_fiturs = 0)
													@if($tambah_akses != null)
														@php($check_fiturs = $tambah_akses->fiturs_id)
													@endif

													@php($checked = '')
													@if($id_fiturs == $check_fiturs)
														@php($checked = 'checked')
													@endif

													<label>
			                                        	<input type="checkbox" name="fiturs_id[]" id="fitur_tambah{{$no_checkbox}}" class="chk-tambah" value="{{ $fiturs_tambah->id_fiturs }}" {{ $checked }}>
			                                        	<span></span>
													</label>
												@endif
											@endforeach
										</td>
										<td class="center-align">
											@foreach($tambah_fiturs as $fiturs_edit)
												@php($check_fiturs = $fiturs_edit->nama_fiturs)
												@if($check_fiturs == 'edit')
													@php($id_fiturs = $fiturs_edit->id_fiturs)
													@php($edit_akses = \App\Models\Master_akses::where('level_sistems_id',$id_level_sistems)->where('fiturs_id',$id_fiturs)->first())
													@php($check_fiturs = 0)
													@if($edit_akses != null)
														@php($check_fiturs = $edit_akses->fiturs_id)
													@endif

													@php($checked = '')
													@if($id_fiturs == $check_fiturs)
														@php($checked = 'checked')
													@endif

													@php($disabled = '')
													@if($sub_menus->link_menus == 'admin')
														@php($checked = 'checked')
														@php($disabled = 'disabled')
													@endif
													
													<label>
														@if($sub_menus->link_menus == 'admin')
															<input type="hidden" name="fiturs_id[]" id="fiturs_edit_user" class="chk-edit" value="{{ $fiturs_edit->id_fiturs }}" {{$checked}}>
														@endif

			                                        	<input type="checkbox" name="fiturs_id[]" id="fitur_edit{{$no_checkbox}}" class="chk-edit" value="{{ $fiturs_edit->id_fiturs }}" {{ $checked }} {{ $disabled }}>
			                                        	<span></span>
													</label>
												@endif
											@endforeach
										</td>
										<td class="center-align">
											@foreach($tambah_fiturs as $fiturs_hapus)
												@php($check_fiturs = $fiturs_hapus->nama_fiturs)
												@if($check_fiturs == 'hapus')
													@php($id_fiturs = $fiturs_hapus->id_fiturs)
													@php($hapus_akses = \App\Models\Master_akses::where('level_sistems_id',$id_level_sistems)->where('fiturs_id',$id_fiturs)->first())
													@php($check_fiturs = 0)
													@if($hapus_akses != null)
														@php($check_fiturs = $hapus_akses->fiturs_id)
													@endif

													@php($checked = '')
													@if($id_fiturs == $check_fiturs)
														@php($checked = 'checked')
													@endif

													<label>
			                                        	<input type="checkbox" name="fiturs_id[]" id="fitur_hapus{{$no_checkbox}}" class="chk-hapus" value="{{ $fiturs_hapus->id_fiturs }}" {{ $checked }}>
			                                        	<span></span>
													</label>
												@endif
											@endforeach
										</td>
										<td class="center-align">
											@foreach($tambah_fiturs as $fiturs_cetak)
												@php($check_fiturs = $fiturs_cetak->nama_fiturs)
												@if($check_fiturs == 'cetak')
													@php($id_fiturs = $fiturs_cetak->id_fiturs)
													@php($cetak_akses = \App\Models\Master_akses::where('level_sistems_id',$id_level_sistems)->where('fiturs_id',$id_fiturs)->first())
													@php($check_fiturs = 0)
													@if($cetak_akses != null)
														@php($check_fiturs = $cetak_akses->fiturs_id)
													@endif

													@php($checked = '')
													@if($id_fiturs == $check_fiturs)
														@php($checked = 'checked')
													@endif

													<label>
			                                        	<input type="checkbox" name="fiturs_id[]" id="fitur_cetak{{$no_checkbox}}" class="chk-cetak" value="{{ $fiturs_cetak->id_fiturs }}" {{ $checked }}>
			                                        	<span></span>
													</label>
												@endif
											@endforeach
										</td>
									</tr>
								@php($no_checkbox++)
								@endforeach
							@endforeach
							</tbody>
						</table>
					</div>
			        <div class="card-footer right-align">
						{{General::perbarui()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/level_sistem'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

@endsection