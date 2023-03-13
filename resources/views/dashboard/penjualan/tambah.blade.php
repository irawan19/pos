@extends('dashboard.layouts.app')
@section('content')

	<form class="form-horizontal m-t-40" action="{{ URL('dashboard/penjualan/prosestambah') }}" method="POST">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-sm-4 mb-4">
				<div class="card">
					<div class="card-header">
						<strong>Nota Penjualan</strong>
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
							<label class="form-col-form-label" for="tanggal_penjualans">Tanggal <b style="color:red">*</b></label>
							<input readonly class="form-control {{ General::validForm($errors->first('tanggal_penjualans')) }} getDateTime" id="tanggal_penjualans" type="text" name="tanggal_penjualans" value="{{Request::old('tanggal_penjualans') == '' ? General::ubahDBKeTanggalwaktu(date('Y-m-d H:i:s')) : Request::old('tanggal_penjualans') }}">
							{{General::pesanErrorForm($errors->first('tanggal_penjualans'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="customers_id">Customer</label>
							<select class="form-control select2creation" id="customers_id" name="customers_id">
								<option value="">-</option>
								@foreach($tambah_customers as $customers)
									<option value="{{$customers->id_customers}}" {{ Request::old('customers_id') == $customers->id_customers ? $select='selected' : $select='' }}>{{$customers->nama_customers}}</option>
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
							<label class="form-col-form-label" for="diskon_penjualans">Diskon %</label>
							<input class="form-control {{ General::validForm($errors->first('diskon_penjualans')) }} right-align" id="diskon_penjualans" type="number" name="diskon_penjualans" value="{{Request::old('diskon_penjualans') == '' ? 0 : Request::old('diskon_penjualans') }}">
							{{General::pesanErrorForm($errors->first('diskon_penjualans'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="pajak_penjualans">Pajak %</label>
							<input class="form-control {{ General::validForm($errors->first('pajak_penjualans')) }} right-align" id="pajak_penjualans" type="number" name="pajak_penjualans" value="{{Request::old('pajak_penjualans') == '' ? 0 : Request::old('pajak_penjualans') }}">
							{{General::pesanErrorForm($errors->first('pajak_penjualans'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="keterangan_penjualans">Keterangan </label>
							<textarea class="form-control {{ General::validForm($errors->first('keterangan_penjualans')) }}" id="keterangan_penjualans" name="keterangan_penjualans" rows="5">{{Request::old('keterangan_penjualans')}}</textarea>
							{{General::pesanErrorForm($errors->first('keterangan_penjualans'))}}
						</div>
					</div>
				</div>
			</div>
        
			<div class="col-sm-8 mb-4">
				<div class="card">
					<div class="card-header">
						<strong>Detail Penjualan</strong>
					</div>
					<div class="card-body">
						<div class="listitem"></div>
					</div>
			        <div class="card-footer right-align">
						{{General::simpan()}}
						{{General::simpankembali()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/penjualan'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</div>
			</div>
		</div>
	</form>

	<script type="text/javascript">
		idtoko = $('#tokos_id :selected').val();
		$('.listitem').load('{{URL("/dashboard/penjualan/listitem")}}/'+idtoko+'/0');

		$('.tokos_id').on('change', async function() {
			idtoko = $('#tokos_id :selected').val();
			$('.listitem').load('{{URL("/dashboard/penjualan/listitem")}}/'+idtoko+'/0');
		});
	</script>

@endsection