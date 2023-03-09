@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 col-center mb-4">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/supplier/prosesedit/'.$edit_suppliers->id_suppliers) }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Edit Supplier</strong>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-col-form-label" for="nama_suppliers">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_suppliers')) }}" id="nama_suppliers" type="text" name="nama_suppliers" value="{{Request::old('nama_suppliers') == '' ? $edit_suppliers->nama_suppliers : Request::old('nama_suppliers')}}">
							{{General::pesanErrorForm($errors->first('nama_suppliers'))}}
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::perbarui()}}
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