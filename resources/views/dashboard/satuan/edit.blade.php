@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/toko/prosesedit/'.$edit_tokos->id_tokos) }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Edit Toko</strong>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-col-form-label" for="nama_tokos">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_tokos')) }}" id="nama_tokos" type="text" name="nama_tokos" value="{{Request::old('nama_tokos') == '' ? $edit_tokos->nama_tokos : Request::old('nama_tokos')}}">
							{{General::pesanErorForm($errors->first('nama_tokos'))}}
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::perbarui()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/toko'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

@endsection