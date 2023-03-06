@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/menu/prosesedit/'.$edit_menus->id_menus) }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Edit Menu</strong>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-col-form-label" for="icon_menus">Icon <b style="color:red">*</b></label>
					        <select class="form-control select2" id="icon_menus" name="icon_menus">
					        	@foreach($lihat_icons as $icons)
					        		@php($selected = '')
			                        @if(Request::old('icon_menus') == '')
			                        	@if($icons == $edit_menus->icon_menus)
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
							<input class="form-control {{ General::validForm($errors->first('nama_menus')) }}" id="nama_menus" type="text" name="nama_menus" value="{{Request::old('nama_menus') == '' ? $edit_menus->nama_menus : Request::old('nama_menus')}}">
							{{General::pesanErrorForm($errors->first('nama_menus'))}}
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::perbarui()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/menu'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

@endsection