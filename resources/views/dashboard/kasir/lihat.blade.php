@extends('dashboard.layouts.app')
@section('content')

    <script src="{{ URL::asset('template/back/vendors/scanner/instascan.min.js') }}"></script>
	<div class="row">
		<div class="col-xl-9 col-md-6 col-sm-6 mb-4">
			<div class="row">
				@foreach($lihat_items as $items)
					<div class="col-xl-2 col-md-6 col-sm-6 mb-4">
						<div class="card">
							<div class="card-header mx-4 p-3 text-center">
								<div class="shadow text-center border-radius-lg">
									<img src="{{URL::asset('storage/'.$items->foto_items)}}" width="100%">
								</div>
							</div>
							<div class="card-body pt-0 p-3 text-center">
								<h6 class="text-center text-xs mb-0">{{$items->nama_items}}</h6>
								<span class="text-xs">Stok {{$items->stok_items}}</span>
								<hr class="horizontal dark my-3">
								<h5 class="mb-0 text-xs">Rp. {{General::ubahDBKeHarga($items->harga_items)}}</h5>
							</div>
						</div>
					</div>
				@endforeach
			</div>
        </div>
		<div class="col-xl-3 col-md-6 col-sm-6 mb-4">
			<div class="card">
				<div class="card-body">
                    @if (Session::get('setelah_simpan.alert') == 'sukses')
						{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
					@endif
					@if(Auth::user()->tokos_id == null)
						<div class="center-align mb-4">
							<a data-fancybox="gallery" href="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasi->logo_text_konfigurasi_aplikasis)}}">
								<img src="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasi->logo_text_konfigurasi_aplikasis)}}" style="width:100%; max-width:256px">
							</a>
						</div>
						<div class="form-group">
							<select class="form-control select2" id="tokos_id" name="tokos_id">
								@foreach($tambah_tokos as $tokos)
									<option value="{{$tokos->id_tokos}}" {{ Request::old('tokos_id') == $tokos->id_tokos ? $select='selected' : $select='' }}>{{$tokos->nama_tokos}}</option>
								@endforeach
							</select>
						</div>
					@else
						<div class="center-align mb-4">
							<a data-fancybox="gallery" href="{{URL::asset('storage/'.$lihat_tokos->logo_tokos)}}">
								<img src="{{URL::asset('storage/'.$lihat_tokos->logo_tokos)}}" width="256">
							</a>
						</div>
					@endif
					<div class="form-group">
						<select class="form-control select2creation" id="customers_id" name="customers_id">
							
						</select>
					</div>
					<div class="form-group">
						<select class="form-control select2" id="pembayarans_id" name="pembayarans_id">
							
						</select>
					</div>
					<div class="center-align mt-4">
						<strong>Detail Pemesanan</strong>
					</div>
					<hr style="border:2px solid #202739">
					<div class="row">
						<div class="col-sm-3">
							<p style="text-align: right; font-weight: bold; font-size: 14px; margin-top: 5px">		
								Sub Total
							</p>
						</div>
						<div class="col-sm-9">
							<div class="form-group">
								<input readonly class="form-control {{ General::validForm($errors->first('sub_total_penjualans')) }} right-align" id="sub_total_penjualans" type="text" name="sub_total_penjualans" value="{{Request::old('sub_total_penjualans') == '' ? General::ubahDBKeHarga(0) : Request::old('sub_total_penjualans') }}">
								{{General::pesanErrorForm($errors->first('sub_total_penjualans'))}}
							</div>
						</div>
						<div class="col-sm-3">
							<p style="text-align: right; font-weight: bold; font-size: 14px; margin-top: 5px">		
								Pajak
							</p>
						</div>
						<div class="col-sm-9">
							<div class="form-group">
								<input class="form-control {{ General::validForm($errors->first('pajak_penjualans')) }} right-align" id="pajak_penjualans" type="number" name="pajak_penjualans" value="{{Request::old('pajak_penjualans') == '' ? 0 : Request::old('pajak_penjualans') }}">
								{{General::pesanErrorForm($errors->first('pajak_penjualans'))}}
							</div>
						</div>
						<div class="col-sm-3">
							<p style="text-align: right; font-weight: bold; font-size: 14px; margin-top: 5px">		
								Diskon
							</p>
						</div>
						<div class="col-sm-9">
							<div class="form-group">
								<input class="form-control {{ General::validForm($errors->first('diskon_penjualans')) }} right-align" id="diskon_penjualans" type="number" name="diskon_penjualans" value="{{Request::old('diskon_penjualans') == '' ? 0 : Request::old('diskon_penjualans') }}">
								{{General::pesanErrorForm($errors->first('diskon_penjualans'))}}
							</div>
						</div>
					</div>
					<hr style="border:2px solid #202739">
					<div class="row">
						<div class="col-md-3">
							<p style="text-align: right; font-weight: bold; font-size: 14px; margin-top: 5px">		
								Total
							</p>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<input readonly class="form-control {{ General::validForm($errors->first('total_penjualans')) }} right-align" id="total_penjualans" type="text" name="total_penjualans" value="{{Request::old('total_penjualans') == '' ? General::ubahDBKeHarga(0) : Request::old('total_penjualans') }}">
								{{General::pesanErrorForm($errors->first('total_penjualans'))}}
							</div>
						</div>
						<div class="col-md-3">
							<p style="text-align: right; font-weight: bold; font-size: 14px; margin-top: 5px">		
								Bayar
							</p>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<input class="form-control {{ General::validForm($errors->first('total_pembayarans')) }} right-align" id="total_pembayarans" type="text" name="total_pembayarans" value="{{Request::old('total_pembayarans') == '' ? General::ubahDBKeHarga(0) : Request::old('total_pembayarans') }}">
								{{General::pesanErrorForm($errors->first('total_pembayarans'))}}
							</div>
						</div>
						<div class="col-md-3">
							<p style="text-align: right; font-weight: bold; font-size: 14px; margin-top: 5px">		
								Kembali
							</p>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<input readonly class="form-control {{ General::validForm($errors->first('total_kembalians')) }} right-align" id="total_kembalians" type="text" name="total_kembalians" value="{{Request::old('total_kembalians') == '' ? General::ubahDBKeHarga(0) : Request::old('total_kembalians') }}">
								{{General::pesanErrorForm($errors->first('total_kembalians'))}}
							</div>
						</div>
					</div>
					<div class="form-group">
						<textarea class="form-control {{ General::validForm($errors->first('keterangan_penjualans')) }}" id="keterangan_penjualans" name="keterangan_penjualans" rows="5" placeholder="Masukkan catatan">{{Request::old('keterangan_penjualans')}}</textarea>
						{{General::pesanErrorForm($errors->first('keterangan_penjualans'))}}
					</div>
                </div>
            </div>
        </div>
    </div>

@endsection