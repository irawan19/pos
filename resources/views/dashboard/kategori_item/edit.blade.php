@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 col-center mb-4">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/kategori_item/prosesedit/'.$edit_kategori_items->id_kategori_items) }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Edit Kategori Item</strong>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-col-form-label" for="nama_kategori_items">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_kategori_items')) }}" id="nama_kategori_items" type="text" name="nama_kategori_items" value="{{Request::old('nama_kategori_items') == '' ? $edit_kategori_items->nama_kategori_items : Request::old('nama_kategori_items')}}">
							{{General::pesanErrorForm($errors->first('nama_kategori_items'))}}
						</div>
					</div>
			        <div class="card-footer right-align">
						{{General::perbarui()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/kategori_item'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

@endsection