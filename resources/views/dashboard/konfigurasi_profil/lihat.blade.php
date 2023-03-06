@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 row-center">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/konfigurasi_profil/prosesedit') }}" enctype="multipart/form-data" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Konfigurasi Profil</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan.alert') == 'sukses')
				        	{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
				        @endif
						<div class="form-group">
							<label class="form-col-form-label" for="userfile_foto_user">Foto (128 x 128px) <b style="color:red">*</b></label>
							<br/>
							<div class="form-group center-align">
								@if(Auth::user()->profile_photo_path != null)
									<a data-fancybox="gallery" href="{{URL::asset(Auth::user()->profile_photo_path)}}">
										<img src="{{URL::asset(Auth::user()->profile_photo_path)}}" width="108">
									</a>
								@else
									<a data-fancybox="gallery" href="{{Auth::user()->profile_photo_url}}">
										<img src="{{ Auth::user()->profile_photo_url }}" width="108">
									</a>
								@endif
							</div>
				            <input id="userfile_foto_user" type="file" name="userfile_foto_user">
							{{General::pesanErrorForm($errors->first('userfile_foto_user'))}}
				        </div>
						<div class="form-group">
							<label class="form-col-form-label" for="nama_level_sistems">Level Sistem</label>
							<input class="form-control {{ General::validForm($errors->first('nama_level_sistems')) }}" id="nama_level_sistems" type="text" name="nama_level_sistems" value="{{$lihat_level_sistems->nama_level_sistems}}" readonly>
							{{General::pesanErrorForm($errors->first('nama_level_sistems'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="name">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('name')) }}" id="name" type="text" name="name" value="{{Request::old('name') == '' ? Auth::user()->nama : Request::old('name')}}">
							{{General::pesanErrorForm($errors->first('name'))}}
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