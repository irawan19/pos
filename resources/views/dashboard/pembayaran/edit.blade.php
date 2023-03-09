@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 col-center mb-4">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/pembayaran/prosesedit/'.$edit_pembayarans->id_pembayarans) }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Edit Pembayaran</strong>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-col-form-label" for="nama_pembayarans">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_pembayarans')) }}" id="nama_pembayarans" type="text" name="nama_pembayarans" value="{{Request::old('nama_pembayarans') == '' ? $edit_pembayarans->nama_pembayarans : Request::old('nama_pembayarans')}}">
							{{General::pesanErrorForm($errors->first('nama_pembayarans'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="akun_pembayarans">Akun </label>
							<input class="form-control {{ General::validForm($errors->first('akun_pembayarans')) }}" id="akun_pembayarans" type="text" name="akun_pembayarans" value="{{Request::old('akun_pembayarans') == '' ? $edit_pembayarans->akun_pembayarans : Request::old('akun_pembayarans')}}">
							{{General::pesanErrorForm($errors->first('akun_pembayarans'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="no_rekening_pembayarans">No Rekening </label>
							<input class="form-control {{ General::validForm($errors->first('no_rekening_pembayarans')) }}" id="no_rekening_pembayarans" type="text" name="no_rekening_pembayarans" value="{{Request::old('no_rekening_pembayarans') == '' ? $edit_pembayarans->no_rekening_pembayarans : Request::old('no_rekening_pembayarans')}}">
							{{General::pesanErrorForm($errors->first('no_rekening_pembayarans'))}}
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::perbarui()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/pembayaran'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

@endsection