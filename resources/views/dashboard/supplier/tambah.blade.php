@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 col-center mb-4">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/supplier/prosestambah') }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Tambah Supplier</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan.alert') == 'sukses')
					    	{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
					    @endif
						<div class="form-group">
							<label class="form-col-form-label" for="tokos_id">Toko <b style="color:red">*</b></label>
							<select class="form-control select2" id="tokos_id" name="tokos_id">
								@foreach($tambah_tokos as $tokos)
									<option value="{{$tokos->id_tokos}}" {{ Request::old('tokos_id') == $tokos->id_tokos ? $select='selected' : $select='' }}>{{$tokos->nama_tokos}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="nama_suppliers">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_suppliers')) }}" id="nama_suppliers" type="text" name="nama_suppliers" value="{{Request::old('nama_suppliers')}}">
							{{General::pesanErrorForm($errors->first('nama_suppliers'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="telepon_suppliers">Telepon <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('telepon_suppliers')) }}" id="telepon_suppliers" type="number" name="telepon_suppliers" value="{{Request::old('telepon_suppliers')}}">
							{{General::pesanErrorForm($errors->first('telepon_suppliers'))}}
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::simpan()}}
						{{General::simpankembali()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/supplier'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

@endsection