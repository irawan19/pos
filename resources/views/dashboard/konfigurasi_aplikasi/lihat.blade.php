@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-8">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/konfigurasi_aplikasi/prosesedit') }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Konfigurasi Aplikasi</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan.alert') == 'sukses')
							{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
					    @endif
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-col-form-label" for="nama_konfigurasi_aplikasis">Nama <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('nama_konfigurasi_aplikasis')) }}" id="nama_konfigurasi_aplikasis" type="text" name="nama_konfigurasi_aplikasis" value="{{Request::old('nama_konfigurasi_aplikasis') == '' ? $lihat_konfigurasi_aplikasis->nama_konfigurasi_aplikasis : Request::old('nama_konfigurasi_aplikasis')}}">
									{{General::pesanErrorForm($errors->first('nama_konfigurasi_aplikasis'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="deskripsi_konfigurasi_aplikasis">Deskripsi <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('deskripsi_konfigurasi_aplikasis')) }}" id="deskripsi_konfigurasi_aplikasis" type="text" name="deskripsi_konfigurasi_aplikasis" value="{{Request::old('deskripsi_konfigurasi_aplikasis') == '' ? $lihat_konfigurasi_aplikasis->deskripsi_konfigurasi_aplikasis : Request::old('deskripsi_konfigurasi_aplikasis')}}">
									{{General::pesanErrorForm($errors->first('deskripsi_konfigurasi_aplikasis'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="keywords_konfigurasi_aplikasis">Keywords <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('keywords_konfigurasi_aplikasis')) }}" id="keywords_konfigurasi_aplikasis" type="text" name="keywords_konfigurasi_aplikasis" value="{{Request::old('keywords_konfigurasi_aplikasis') == '' ? $lihat_konfigurasi_aplikasis->keywords_konfigurasi_aplikasis : Request::old('keywords_konfigurasi_aplikasis')}}">
									{{General::pesanErrorForm($errors->first('keywords_konfigurasi_aplikasis'))}}
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-col-form-label" for="facebook_konfigurasi_aplikasis">Facebook </label>
									<input class="form-control {{ General::validForm($errors->first('facebook_konfigurasi_aplikasis')) }}" id="facebook_konfigurasi_aplikasis" type="text" name="facebook_konfigurasi_aplikasis" value="{{Request::old('facebook_konfigurasi_aplikasis') == '' ? $lihat_konfigurasi_aplikasis->facebook_konfigurasi_aplikasis : Request::old('facebook_konfigurasi_aplikasis')}}">
									{{General::pesanErrorForm($errors->first('facebook_konfigurasi_aplikasis'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="instagram_konfigurasi_aplikasis">Instagram </label>
									<input class="form-control {{ General::validForm($errors->first('instagram_konfigurasi_aplikasis')) }}" id="instagram_konfigurasi_aplikasis" type="text" name="instagram_konfigurasi_aplikasis" value="{{Request::old('instagram_konfigurasi_aplikasis') == '' ? $lihat_konfigurasi_aplikasis->instagram_konfigurasi_aplikasis : Request::old('instagram_konfigurasi_aplikasis')}}">
									{{General::pesanErrorForm($errors->first('instagram_konfigurasi_aplikasis'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="twitter_konfigurasi_aplikasis">Twitter </label>
									<input class="form-control {{ General::validForm($errors->first('twitter_konfigurasi_aplikasis')) }}" id="twitter_konfigurasi_aplikasis" type="text" name="twitter_konfigurasi_aplikasis" value="{{Request::old('twitter_konfigurasi_aplikasis') == '' ? $lihat_konfigurasi_aplikasis->twitter_konfigurasi_aplikasis : Request::old('twitter_konfigurasi_aplikasis')}}">
									{{General::pesanErrorForm($errors->first('twitter_konfigurasi_aplikasis'))}}
								</div>
							</div>
							<hr style="border:2px solid #202739">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-col-form-label" for="email_konfigurasi_aplikasis">Email </label>
									<input class="form-control {{ General::validForm($errors->first('email_konfigurasi_aplikasis')) }}" id="email_konfigurasi_aplikasis" type="email" name="email_konfigurasi_aplikasis" value="{{Request::old('email_konfigurasi_aplikasis') == '' ? $lihat_konfigurasi_aplikasis->email_konfigurasi_aplikasis : Request::old('email_konfigurasi_aplikasis')}}">
									{{General::pesanErrorForm($errors->first('email_konfigurasi_aplikasis'))}}
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-col-form-label" for="telepon_konfigurasi_aplikasis">Telepon </label>
									<input class="form-control {{ General::validForm($errors->first('telepon_konfigurasi_aplikasis')) }}" id="telepon_konfigurasi_aplikasis" type="text" name="telepon_konfigurasi_aplikasis" value="{{Request::old('telepon_konfigurasi_aplikasis') == '' ? $lihat_konfigurasi_aplikasis->telepon_konfigurasi_aplikasis : Request::old('telepon_konfigurasi_aplikasis')}}">
									{{General::pesanErrorForm($errors->first('telepon_konfigurasi_aplikasis'))}}
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-col-form-label" for="alamat_konfigurasi_aplikasis">Alamat <b style="color:red">*</b></label>
									<textarea class="form-control {{ General::validForm($errors->first('alamat_konfigurasi_aplikasis')) }}" id="alamat_konfigurasi_aplikasis" name="alamat_konfigurasi_aplikasis" rows="5">{{Request::old('alamat_konfigurasi_aplikasis') == '' ? $lihat_konfigurasi_aplikasis->alamat_konfigurasi_aplikasis : Request::old('alamat_konfigurasi_aplikasis')}}</textarea>
									{{General::pesanErrorForm($errors->first('alamat_konfigurasi_aplikasis'))}}
								</div>
							</div>
						</div>
					</div>
	                <div class="card-footer right-align">
						{{General::perbarui()}}
	                </div>
	            </form>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/konfigurasi_aplikasi/proseseditlogo') }}" enctype="multipart/form-data" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Logo</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan_logo.alert') == 'sukses')
							{{ General::pesanSuksesForm(Session::get('setelah_simpan_logo.text')) }}
					    @endif
						<div class="form-group center-align">
							<a data-fancybox="gallery" href="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasis->logo_konfigurasi_aplikasis)}}">
								<img src="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasis->logo_konfigurasi_aplikasis)}}" width="108">
							</a>
						</div>
						<div class="form-group row">
	                        <div class="col-md-12 center-align">
	                          	<input id="userfile_logo" type="file" name="userfile_logo">
								{{General::pesanErrorFormFile($errors->first('userfile_logo'))}}
	                        </div>
	                    </div>
					</div>
	                <div class="card-footer right-align">
						{{General::perbarui()}}
	                </div>
				</form>
			</div>

			<div class="card mt-4">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/konfigurasi_aplikasi/prosesediticon') }}" enctype="multipart/form-data" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Icon (16 x 16px)</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan_icon.alert') == 'sukses')
							{{ General::pesanSuksesForm(Session::get('setelah_simpan_icon.text')) }}
					    @endif
						<div class="form-group center-align">
							<a data-fancybox="gallery" href="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasis->icon_konfigurasi_aplikasis)}}">
								<img src="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasis->icon_konfigurasi_aplikasis)}}" width="16">
							</a>
						</div>
						<div class="form-group row">
	                        <div class="col-md-12 center-align">
	                          	<input id="userfile_icon" type="file" name="userfile_icon">
								{{General::pesanErrorFormFile($errors->first('userfile_icon'))}}
	                        </div>
	                    </div>
					</div>
	                <div class="card-footer right-align">
						{{General::perbarui()}}
	                </div>
				</form>
			</div>

			<div class="card mt-4">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/konfigurasi_aplikasi/proseseditlogotext') }}" enctype="multipart/form-data" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Logo Text</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan_logo_text.alert') == 'sukses')
							{{ General::pesanSuksesForm(Session::get('setelah_simpan_logo_text.text')) }}
					    @endif
						<div class="form-group center-align">
							<a data-fancybox="gallery" href="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasis->logo_text_konfigurasi_aplikasis)}}">
								<img src="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasis->logo_text_konfigurasi_aplikasis)}}" width="108">
							</a>
						</div>
						<div class="form-group row">
	                        <div class="col-md-12 center-align">
	                          	<input id="userfile_logo_text" type="file" name="userfile_logo_text">
								{{General::pesanErrorFormFile($errors->first('userfile_logo_text'))}}
	                        </div>
	                    </div>
					</div>
	                <div class="card-footer right-align">
						{{General::perbarui()}}
	                </div>
				</form>
			</div>

			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/konfigurasi_aplikasi/proseseditbackgroundwebsite') }}" enctype="multipart/form-data" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Background Website</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan_background_website.alert') == 'sukses')
							{{ General::pesanSuksesForm(Session::get('setelah_simpan_background_website.text')) }}
					    @endif
						<div class="form-group center-align">
							<a data-fancybox="gallery" href="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasis->background_website_konfigurasi_aplikasis)}}">
								<img src="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasis->background_website_konfigurasi_aplikasis)}}" width="108">
							</a>
						</div>
						<div class="form-group row">
	                        <div class="col-md-12 center-align">
	                          	<input id="userfile_background_website" type="file" name="userfile_background_website">
								{{General::pesanErrorFormFile($errors->first('userfile_background_website'))}}
	                        </div>
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