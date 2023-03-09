@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 col-center mt-4">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/satuan/prosestambah') }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Tambah Satuan</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan.alert') == 'sukses')
					    	{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
					    @endif
						<div class="form-group">
							<label class="form-col-form-label" for="nama_satuans">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_satuans')) }}" id="nama_satuans" type="text" name="nama_satuans" value="{{Request::old('nama_satuans')}}">
							{{General::pesanErrorForm($errors->first('nama_satuans'))}}
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::simpan()}}
						{{General::simpankembali()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/satuan'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

@endsection