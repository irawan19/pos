@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 row-center">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/konfigurasi_akun/prosesedit') }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Konfigurasi Akun</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan.alert') == 'sukses')
				        	{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
				        @endif
						<div class="form-group">
							<label class="form-col-form-label" for="email">Email <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('email')) }}" id="email" type="email" name="email" value="{{Request::old('email') == '' ? Auth::user()->email : Request::old('email')}}">
							{{General::pesanErrorForm($errors->first('email'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="username">Username <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('username')) }}" id="username" type="text" name="username" value="{{Request::old('username') == '' ? Auth::user()->username : Request::old('username')}}">
							{{General::pesanErrorForm($errors->first('username'))}}
						</div>
						<div class="center-align">
							<label style="color:#2a1ab9; font-weight: bold">Kosongi password jika tidak ingin mengubah password.</label>
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="password">Password</label>
							<input class="form-control {{ General::validForm($errors->first('password')) }}" id="password" type="password" name="password" value="{{Request::old('password')}}">
							{{General::pesanErrorForm($errors->first('password'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="password_confirmation">Konfirmasi Password</label>
							<input class="form-control {{ General::validForm($errors->first('password_confirmation')) }}" id="password_confirmation" type="password" name="password_confirmation" value="{{Request::old('password_confirmation')}}">
							{{General::pesanErrorForm($errors->first('password_confirmation'))}}
						</div>
					</div>
				    <div class="card-footer right-align">
						{{General::perbarui()}}
				    </div>
				</form>
			</div>
		</div>
	</div>

@endsection