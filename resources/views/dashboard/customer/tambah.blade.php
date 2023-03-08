@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 col-center">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/customer/prosestambah') }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Tambah Customer</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan.alert') == 'sukses')
					    	{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
					    @endif
						<div class="form-group">
							<label class="form-col-form-label" for="nama_customers">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_customers')) }}" id="nama_customers" type="text" name="nama_customers" value="{{Request::old('nama_customers')}}">
							{{General::pesanErrorForm($errors->first('nama_customers'))}}
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::simpan()}}
						{{General::simpankembali()}}
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