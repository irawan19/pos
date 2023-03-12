@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-4 mb-4">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/pembelian/prosestambah') }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Nota Pembelian</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan.alert') == 'sukses')
					    	{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
					    @endif
						<div class="form-group">
							<label class="form-col-form-label" for="tokos_id">Toko <b style="color:red">*</b></label>
							<select class="form-control select2" id="tokos_id" name="tokos_id">
								@foreach($tambah_tokos as $tokos)
									<option value="{{$tokos->id_tokos}}" {{ Request::old('tokos_id') == $tokos->id_tokos ? $select='selected' : $select='' }}>{{$tokos->nama_tokos}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="created_at">Tanggal <b style="color:red">*</b></label>
							<input readonly class="form-control {{ General::validForm($errors->first('created_at')) }} getDateTime" id="created_at" type="text" name="created_at" value="{{Request::old('created_at') == '' ? General::ubahDBKeTanggalwaktu(date('Y-m-d H:i:s')) : Request::old('created_at') }}">
							{{General::pesanErrorForm($errors->first('referensi_no_nota_pembelians'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="referensi_no_nota_pembelians">Referensi No Nota <b style="color:red">*</b></label>
							<input class="form-control {{ General::validForm($errors->first('referensi_no_nota_pembelians')) }}" id="referensi_no_nota_pembelians" type="text" name="referensi_no_nota_pembelians" value="{{Request::old('referensi_no_nota_pembelians')}}">
							{{General::pesanErrorForm($errors->first('referensi_no_nota_pembelians'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="suppliers_id">Supplier</label>
							<select class="form-control select2creation" id="suppliers_id" name="suppliers_id">
								<option value="">-</option>
								@foreach($tambah_suppliers as $suppliers)
									<option value="{{$suppliers->id_suppliers}}" {{ Request::old('suppliers_id') == $suppliers->id_suppliers ? $select='selected' : $select='' }}>{{$suppliers->nama_suppliers}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="pembayarans_id">Pembayaran <b style="color:red">*</b></label>
							<select class="form-control select2" id="pembayarans_id" name="pembayarans_id">
								@foreach($tambah_pembayarans as $pembayarans)
									<option value="{{$pembayarans->id_pembayarans}}" {{ Request::old('pembayarans_id') == $pembayarans->id_pembayarans ? $select='selected' : $select='' }}>{{$pembayarans->nama_pembayarans}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="diskon_pembelians">Diskon %</label>
							<input class="form-control {{ General::validForm($errors->first('diskon_pembelians')) }} right-align" id="diskon_pembelians" type="number" name="diskon_pembelians" value="{{Request::old('diskon_pembelians') == '' ? 0 : Request::old('diskon_pembelians') }}">
							{{General::pesanErrorForm($errors->first('diskon_pembelians'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="pajak_pembelians">Pajak %</label>
							<input class="form-control {{ General::validForm($errors->first('pajak_pembelians')) }} right-align" id="pajak_pembelians" type="number" name="pajak_pembelians" value="{{Request::old('pajak_pembelians') == '' ? 0 : Request::old('pajak_pembelians') }}">
							{{General::pesanErrorForm($errors->first('pajak_pembelians'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="keterangan_pembelians">Keterangan </label>
							<textarea class="form-control {{ General::validForm($errors->first('keterangan_pembelians')) }}" id="keterangan_pembelians" name="keterangan_pembelians" rows="5">{{Request::old('keterangan_pembelians')}}</textarea>
							{{General::pesanErrorForm($errors->first('keterangan_pembelians'))}}
						</div>
					</div>
				</form>
			</div>
		</div>
        
		<div class="col-sm-8 mb-4">
			<div class="card">
				<form class="form-horizontal m-t-40" action="{{ URL('dashboard/pembelian/prosestambah') }}" method="POST">
					{{ csrf_field() }}
					<div class="card-header">
						<strong>Detail Pembelian</strong>
					</div>
					<div class="card-body">
						<div class="listitem"></div>
					</div>
			        <div class="card-footer right-align">
						{{General::simpan()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/pembelian'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		idtoko = $('#tokos_id :selected').val();
		$('.listitem').load('{{URL("/dashboard/pembelian/listitem")}}/'+idtoko);

		$('.tokos_id').on('change', async function() {
			idtoko = $('#tokos_id :selected').val();
			$('.listitem').load('{{URL("/dashboard/pembelian/listitem")}}/'+idtoko);
        });
	</script>

@endsection