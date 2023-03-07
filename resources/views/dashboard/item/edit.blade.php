@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 col-cen">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/item/prosesedit/'.$edit_items->id_items) }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Edit Item</strong>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-col-form-label" for="nama_items">Nama <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('nama_items')) }}" id="nama_items" type="text" name="nama_items" value="{{Request::old('nama_items') == '' ? $edit_items->nama_items : Request::old('nama_items')}}">
							{{General::pesanErrorForm($errors->first('nama_items'))}}
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