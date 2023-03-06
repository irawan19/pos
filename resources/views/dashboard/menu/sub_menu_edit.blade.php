@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/menu/prosesedit_submenu/'.$edit_sub_menus->id_menus) }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Edit Sub Menu {{$lihat_menus->nama_menus}}</strong>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-col-form-label" for="icon_menus">Icon <b style="color:red">*</b></label>
					        <select class="form-control select2" id="icon_menus" name="icon_menus">
					        	@foreach($lihat_icons as $icons)
					        		@php($selected = '')
			                        @if(Request::old('icon_menus') == '')
			                        	@if($icons == $edit_sub_menus->icon_menus)
			                        		@php($selected = 'selected')
			                        	@endif
			                        @else
			                        	@if($icons == Request::old('icon_menus'))
			                        		@php($selected = 'selected')
			                        	@endif
			                        @endif
									<option value="{{$icons}}" {{ $selected }}>{{$icons}}</option>
								@endforeach
					        </select>
			            </div>
						<div class="form-group">
							<label class="form-col-form-label" for="nama_menus">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_menus')) }}" id="nama_menus" type="text" name="nama_menus" value="{{Request::old('nama_menus') == '' ? $edit_sub_menus->nama_menus : Request::old('nama_menus')}}">
							{{General::pesanErrorForm($errors->first('nama_menus'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="link_menus">Link <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('link_menus')) }}" id="link_menus" type="text" name="link_menus" value="{{Request::old('link_menus') == '' ? $edit_sub_menus->link_menus : Request::old('link_menus')}}">
							{{General::pesanErrorForm($errors->first('link_menus'))}}
						</div>
						<table class="table table-responsive-sm table-bordered table-striped table-sm">
							<tr>
								<th width="10%" class="center-align">Lihat <i style="color:red">*</i></th>
								<th width="10%" class="center-align">Tambah</th>
								<th width="10%" class="center-align">Baca</th>
								<th width="10%" class="center-align">Edit</th>
								<th width="10%" class="center-align">Hapus</th>
								<th width="10%" class="center-align">Cetak</th>
							</tr>
							<tr>
								@php($id_sub_menus = $edit_sub_menus->id_menus)
								@php($get_fitur_lihat = \App\Models\Master_fitur::where('menus_id',$id_sub_menus)->where('nama_fiturs','lihat')->count())
								@php($checked_fitur_lihat = '')
								@if($get_fitur_lihat != 0)
									@php($checked_fitur_lihat = 'checked')
								@endif

								@php($get_fitur_tambah = \App\Models\Master_fitur::where('menus_id',$id_sub_menus)->where('nama_fiturs','tambah')->count())
								@php($checked_fitur_tambah = '')
								@if($get_fitur_tambah != 0)
									@php($checked_fitur_tambah = 'checked')
								@endif

								@php($get_fitur_baca = \App\Models\Master_fitur::where('menus_id',$id_sub_menus)->where('nama_fiturs','baca')->count())
								@php($checked_fitur_baca = '')
								@if($get_fitur_baca != 0)
									@php($checked_fitur_baca = 'checked')
								@endif

								@php($get_fitur_edit = \App\Models\Master_fitur::where('menus_id',$id_sub_menus)->where('nama_fiturs','edit')->count())
								@php($checked_fitur_edit = '')
								@if($get_fitur_edit != 0)
									@php($checked_fitur_edit = 'checked')
								@endif

								@php($get_fitur_hapus = \App\Models\Master_fitur::where('menus_id',$id_sub_menus)->where('nama_fiturs','hapus')->count())
								@php($checked_fitur_hapus = '')
								@if($get_fitur_hapus != 0)
									@php($checked_fitur_hapus = 'checked')
								@endif

								@php($get_fitur_cetak = \App\Models\Master_fitur::where('menus_id',$id_sub_menus)->where('nama_fiturs','cetak')->count())
								@php($checked_fitur_cetak = '')
								@if($get_fitur_cetak != 0)
									@php($checked_fitur_cetak = 'checked')
								@endif
								<td class="center-align">
									<label>
	                                	<input type="checkbox" name="nama_fiturs[]" id="fitur_lihat" value="lihat" {{$checked_fitur_lihat}}>
									</label>
								</td>
								<td class="center-align">
									<label>
	                                	<input type="checkbox" name="nama_fiturs[]" id="fitur_tambah" value="tambah" {{$checked_fitur_tambah}}>
									</label>
								</td>
								<td class="center-align">
									<label>
	                                	<input type="checkbox" name="nama_fiturs[]" id="fitur_baca" value="baca" {{$checked_fitur_baca}}>
									</label>
								</td>
								<td class="center-align">
									<label>
	                                	<input type="checkbox" name="nama_fiturs[]" id="fitur_edit" value="edit" {{$checked_fitur_edit}}>
									</label>
								</td>
								<td class="center-align">
									<label>
	                                	<input type="checkbox" name="nama_fiturs[]" id="fitur_hapus" value="hapus" {{$checked_fitur_hapus}}>
									</label>
								</td>
								<td class="center-align">
									<label>
	                                	<input type="checkbox" name="nama_fiturs[]" id="fitur_cetak" value="cetak" {{$checked_fitur_cetak}}>
									</label>
								</td>
							</tr>
						</table>
	                    {{ General::pesanErrorForm($errors->first('nama_fiturs')) }}
					</div>
			        <div class="card-footer right-align">
						{{General::perbarui()}}
			          	@if(request()->session()->get('halaman2') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman2'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/menu/submenu/'.$lihat_menus->id_menus))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

@endsection