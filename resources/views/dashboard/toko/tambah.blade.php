@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6">
			<div class="card">
				<form class="form-horizontal m-t-40" enctype="multipart/form-data" action="{{ URL('dashboard/toko/prosestambah') }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Tambah Toko</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan.alert') == 'sukses')
					    	{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
					    @endif
						<div class="form-group">
							<label class="form-col-form-label" for="userfile_logo_toko">Logo <b style="color:red">*</b></label>
							<br/>
							<input id="userfile_logo_toko" type="file" name="userfile_logo_toko">
							{{General::pesanErorForm($errors->first('userfile_logo_toko'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="nama_tokos">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_tokos')) }}" id="nama_tokos" type="text" name="nama_tokos" value="{{Request::old('nama_tokos')}}">
							{{General::pesanErorForm($errors->first('nama_tokos'))}}
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::simpan()}}
						{{General::simpankembali()}}
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