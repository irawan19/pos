@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mt-4">
			<div class="card">
				<form class="form-horizontal m-t-40" enctype="multipart/form-data" action="{{ URL('dashboard/item/prosesedit/'.$edit_items->id_items) }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Edit Item</strong>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group center-align">
									<a data-fancybox="gallery" href="{{URL::asset('storage/'.$edit_items->foto_items)}}">
										<img src="{{URL::asset('storage/'.$edit_items->foto_items)}}" width="108">
									</a>
								</div>
							</div>
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
										@foreach($edit_kategori_items as $kategori_items)
				                    		@php($selected = '')
					                        @if(Request::old('kategori_items_id') == '')
					                        	@if($kategori_items->id_kategori_items == $edit_items->kategori_items_id)
					                        		@php($selected = 'selected')
					                        	@endif
					                        @else
					                        	@if($kategori_items->id_kategori_items == Request::old('kategori_items_id'))
					                        		@php($selected = 'selected')
					                        	@endif
					                        @endif
											<option value="{{$kategori_items->id_kategori_items}}" {{ $selected }}>{{$kategori_items->nama_kategori_items}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="kode_items">Kode <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('kode_items')) }}" id="kode_items" type="text" name="kode_items" value="{{Request::old('kode_items') == '' ? $edit_items->kode_items : Request::old('kode_items') }}">
									{{General::pesanErrorForm($errors->first('kode_items'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="nama_items">Nama <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('nama_items')) }}" id="nama_items" type="text" name="nama_items" value="{{Request::old('nama_items') == '' ? $edit_items->nama_items : Request::old('nama_items') }}">
									{{General::pesanErrorForm($errors->first('nama_items'))}}
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-col-form-label" for="tokos_id">Toko <b style="color:red">*</b></label>
									<select class="form-control select2" id="tokos_id" name="tokos_id">
										@foreach($edit_tokos as $tokos)
				                    		@php($selected = '')
					                        @if(Request::old('tokos_id') == '')
					                        	@if($tokos->id_tokos == $edit_items->tokos_id)
					                        		@php($selected = 'selected')
					                        	@endif
					                        @else
					                        	@if($tokos->id_tokos == Request::old('tokos_id'))
					                        		@php($selected = 'selected')
					                        	@endif
					                        @endif
											<option value="{{$tokos->id_tokos}}" {{ $selected }}>{{$tokos->nama_tokos}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="satuans_id">Satuan <b style="color:red">*</b></label>
									<select class="form-control select2" id="satuans_id" name="satuans_id">
										@foreach($edit_satuans as $satuans)
				                    		@php($selected = '')
					                        @if(Request::old('satuans_id') == '')
					                        	@if($satuans->id_satuans == $edit_items->satuans_id)
					                        		@php($selected = 'selected')
					                        	@endif
					                        @else
					                        	@if($satuans->id_satuans == Request::old('satuans_id'))
					                        		@php($selected = 'selected')
					                        	@endif
					                        @endif
											<option value="{{$satuans->id_satuans}}" {{ $selected }}>{{$satuans->nama_satuans}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="harga_items">Harga <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('harga_items')) }} price-format right-align" id="harga_items" type="text" name="harga_items" value="{{Request::old('harga_items') == '' ? General::ubahDBKeHarga($edit_items->harga_items) : Request::old('harga_items')}}">
									{{General::pesanErrorForm($errors->first('harga_items'))}}
								</div>
								<div class="form-group">
									<label class="form-col-form-label" for="stok_items">Stok <b style="color:red">*</b></label>
									<input class="form-control {{ General::validForm($errors->first('stok_items')) }} right-align" id="stok_items" type="numeric" name="stok_items" value="{{Request::old('stok_items') == '' ? $edit_items->stok_items : Request::old('stok_items')}}">
									{{General::pesanErrorForm($errors->first('stok_items'))}}
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-col-form-label" for="deskrispi_items">Deskripsi </label>
									<textarea class="form-control {{ General::validForm($errors->first('deskrispi_items')) }}" id="deskrispi_items" name="deskrispi_items" rows="5">{{Request::old('deskrispi_items') == '' ? $edit_items->deskripsi_items : Request::old('deskripsi_items') }}</textarea>
									{{General::pesanErrorForm($errors->first('deskrispi_items'))}}
								</div>
							</div>
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::perbarui()}}
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