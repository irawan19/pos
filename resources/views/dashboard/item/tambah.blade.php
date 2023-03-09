@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mt-4">
			<div class="card">
				<form class="form-horizontal m-t-40" enctype="multipart/form-data" action="{{ URL('dashboard/item/prosestambah') }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Tambah Item</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan.alert') == 'sukses')
					    	{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
					    @endif
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-col-form-label" for="userfile_foto_item">Foto (256 x 256px)</label>
									<br/>
									<input id="userfile_foto_item" type="file" name="userfile_foto_item">
									{{General::pesanErrorForm($errors->first('userfile_foto_item'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="kategori_items_id">Kategori Item <b style="color:red">*</b></label>
									<select class="form-control select2" id="kategori_items_id" name="kategori_items_id">
										@foreach($tambah_kategori_items as $kategori_items)
											<option value="{{$kategori_items->id_kategori_items}}" {{ Request::old('kategori_items_id') == $kategori_items->id_kategori_items ? $select='selected' : $select='' }}>{{$kategori_items->nama_kategori_items}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="kode_items">Kode <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('kode_items')) }}" id="kode_items" type="text" name="kode_items" value="{{Request::old('kode_items')}}">
									{{General::pesanErrorForm($errors->first('kode_items'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="nama_items">Nama <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('nama_items')) }}" id="nama_items" type="text" name="nama_items" value="{{Request::old('nama_items')}}">
									{{General::pesanErrorForm($errors->first('nama_items'))}}
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-col-form-label" for="tokos_id">Toko <b style="color:red">*</b></label>
									<select class="form-control select2" id="tokos_id" name="tokos_id">
										@foreach($tambah_tokos as $tokos)
											<option value="{{$tokos->id_tokos}}" {{ Request::old('tokos_id') == $tokos->id_tokos ? $select='selected' : $select='' }}>{{$tokos->nama_tokos}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="satuans_id">Satuan <b style="color:red">*</b></label>
									<select class="form-control select2" id="satuans_id" name="satuans_id">
										@foreach($tambah_satuans as $satuans)
											<option value="{{$satuans->id_satuans}}" {{ Request::old('satuans_id') == $satuans->id_satuans ? $select='selected' : $select='' }}>{{$satuans->nama_satuans}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="harga_items">Harga <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('harga_items')) }} price-format right-align" id="harga_items" type="text" name="harga_items" value="{{Request::old('harga_items') == '' ? General::ubahDBKeHarga(0) : Request::old('harga_items')}}">
									{{General::pesanErrorForm($errors->first('harga_items'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="stok_items">Stok <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('stok_items')) }} right-align" id="stok_items" type="numeric" name="stok_items" value="{{Request::old('stok_items') == '' ? 0 : Request::old('stok_items')}}">
									{{General::pesanErrorForm($errors->first('stok_items'))}}
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-col-form-label" for="deskrispi_items">Deskripsi </label>
									<textarea class="form-control {{ General::validForm($errors->first('deskrispi_items')) }}" id="deskrispi_items" name="deskrispi_items" rows="5">{{Request::old('deskrispi_items')}}</textarea>
									{{General::pesanErrorForm($errors->first('deskrispi_items'))}}
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
	                    	@php($ambil_kembali = URL('dashboard/item'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

@endsection