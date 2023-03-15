@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 col-center mb-4">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/customer/prosesedit/'.$edit_customers->id_customers) }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Edit Customer</strong>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-col-form-label" for="tokos_id">Toko <b style="color:red">*</b></label>
							<select class="form-control select2" id="tokos_id" name="tokos_id">
								@foreach($edit_tokos as $tokos)
				            		@php($selected = '')
					                @if(Request::old('tokos_id') == '')
					                	@if($tokos->id_tokos == $edit_customers->tokos_id)
					                		@php($selected = 'selected')
					                	@endif
					                @else
					                	@if($tokos->id_tokos == Request::old('tokos_id'))
					                		@php($selected = 'selected')
					                	@endif
					                @endif
									<option value="{{$tokos->id_tokos}}" {{ $selected }}>{{$tokos->nama_tokos}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="nama_customers">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_customers')) }}" id="nama_customers" type="text" name="nama_customers" value="{{Request::old('nama_customers') == '' ? $edit_customers->nama_customers : Request::old('nama_customers')}}">
							{{General::pesanErrorForm($errors->first('nama_customers'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="telepon_customers">Telepon <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('telepon_customers')) }}" id="telepon_customers" type="number" name="telepon_customers" value="{{Request::old('telepon_customers') == '' ? $edit_customers->telepon_customers : Request::old('telepon_customers')}}">
							{{General::pesanErrorForm($errors->first('telepon_customers'))}}
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::perbarui()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/customer'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

@endsection