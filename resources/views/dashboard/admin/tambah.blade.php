@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<form class="form-horizontal m-t-40" enctype="multipart/form-data" action="{{ URL('dashboard/admin/prosestambah') }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Tambah Admin</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan.alert') == 'sukses')
					    	{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
					    @endif
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="form-col-form-label" for="userfile_foto_user">Foto</label>
									<br/>
			                        <input id="userfile_foto_user" type="file" name="userfile_foto_user">
			                    </div>
								<div class="form-group">
									<label class="form-col-form-label" for="name">Nama <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('name')) }}" id="name" type="text" name="name" value="{{Request::old('name')}}">
									{{General::pesanErorForm($errors->first('name'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="username">Username <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('username')) }}" id="username" type="text" name="username" value="{{Request::old('username')}}">
									{{General::pesanErorForm($errors->first('username'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="level_sistems_id">Level Sistem <b style="color:red">*</b></label>
				                    <select class="form-control select2" id="level_sistems_id" name="level_sistems_id">
				                    	@foreach($tambah_level_sistems as $level_sistems)
										    <option value="{{$level_sistems->id_level_sistems}}" {{ Request::old('level_sistems_id') == $level_sistems->id_level_sistems ? $select='selected' : $select='' }}>{{$level_sistems->nama_level_sistems}}</option>
				                    	@endforeach
				                    </select>
		                      	</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="form-col-form-label" for="email">Email <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('email')) }}" id="email" type="email" name="email" value="{{Request::old('email')}}">
									{{General::pesanErorForm($errors->first('email'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="password">Password <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('password')) }}" id="password" type="password" name="password" value="{{Request::old('password')}}">
									{{General::pesanErorForm($errors->first('password'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="password_confirmation">Konfirmasi Password <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('password_confirmation')) }}" id="password_confirmation" type="password" name="password_confirmation" value="{{Request::old('password_confirmation')}}">
									{{General::pesanErorForm($errors->first('password_confirmation'))}}
								</div>
								<div class="form-group">
									<label>
	                                	<input type="checkbox" ame="lihat_password" id="lihat_password" value="1" {{ Request::old('lihat_password') == 1 ? $checked='checked' : $checked='' }}> Lihat Password
			                    	</label>
								</div>
							</div>
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::simpan()}}
						{{General::simpankembali()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/admin'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
        $(document).ready(function(){
        	var isChecked = $('#lihat_password').prop('checked');
            if (isChecked)
            {
                $('#password').attr('type','text');
                $('#password_confirmation').attr('type','text');
            }
            else
            {
                $('#password').attr('type','Password');
                $('#password_confirmation').attr('type','Password');
            }
            $('#lihat_password').on('change',function(){
                var isChecked = $(this).prop('checked');
                if (isChecked)
                {
                    $('#password').attr('type','text');
                    $('#password_confirmation').attr('type','text');
                }
                else
                {
                    $('#password').attr('type','Password');
                    $('#password_confirmation').attr('type','Password');
                }
            });
        });
    </script>

@endsection