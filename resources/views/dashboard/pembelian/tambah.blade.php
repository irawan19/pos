@extends('dashboard.layouts.app')
@section('content')

	<form class="form-horizontal m-t-40" action="{{ URL('dashboard/pembelian/prosestambah') }}" method="POST">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-sm-4 mb-4">
				<div class="card">
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
							<label class="form-col-form-label" for="tanggal_pembelians">Tanggal <b style="color:red">*</b></label>
							<input readonly class="form-control {{ General::validForm($errors->first('tanggal_pembelians')) }} getDateTime" id="tanggal_pembelians" type="text" name="tanggal_pembelians" value="{{Request::old('tanggal_pembelians') == '' ? General::ubahDBKeTanggalwaktu(date('Y-m-d H:i:s')) : Request::old('tanggal_pembelians') }}">
							{{General::pesanErrorForm($errors->first('tanggal_pembelians'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="referensi_no_nota_pembelians">Referensi No Nota </label>
							<input class="form-control {{ General::validForm($errors->first('referensi_no_nota_pembelians')) }}" id="referensi_no_nota_pembelians" type="text" name="referensi_no_nota_pembelians" value="{{Request::old('referensi_no_nota_pembelians')}}">
							{{General::pesanErrorForm($errors->first('referensi_no_nota_pembelians'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="suppliers_id">Supplier</label>
							<select class="form-control select2creation" id="suppliers_id" name="suppliers_id">
								@if(Request::old('suppliers_id') != NULL)
                            	    <option value="{{Request::old('suppliers_id')}}">
                            	        @php($ambil_suppliers = \App\Models\Master_supplier::where('id_suppliers',intval(Request::old('suppliers_id')))
                            	                                                				->first())
                            	        {{$ambil_suppliers->nama_suppliers}}
                            	    </option>
                            	@endif
							</select>
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="telepon_suppliers">Telepon</label>
							<input class="form-control {{ General::validForm($errors->first('telepon_suppliers')) }}" id="telepon_suppliers" type="number" name="telepon_suppliers" value="{{Request::old('telepon_suppliers')}}">
							{{General::pesanErrorForm($errors->first('telepon_suppliers'))}}
						</div>
						<div class="form-group">
							<label class="form-col-form-label" for="pembayarans_id">Pembayaran <b style="color:red">*</b></label>
							<select class="form-control select2" id="pembayarans_id" name="pembayarans_id">
								@if(Request::old('pembayarans_id') != NULL)
                            	    <option value="{{Request::old('pembayarans_id')}}" selected>
                            	        @php($ambil_pembayarans = \App\Models\Master_pembayaran::where('id_pembayarans',intval(Request::old('pembayarans_id')))
                            	                                                				->first())
                            	        {{$ambil_pembayarans->nama_pembayarans}}
                            	    </option>
                            	@endif
							</select>
							{{General::pesanErrorForm($errors->first('pembayarans_id'))}}
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
				</div>
			</div>
        
			<div class="col-sm-8 mb-4">
				<div class="card">
					<div class="card-header">
						<strong>Detail Pembelian</strong>
					</div>
					<div class="card-body">
						@if (Session::get('setelah_simpan.alert') == 'error')
							{{ General::pesanFlashErrorForm(Session::get('setelah_simpan.text')) }}
						@endif
						<br/>
						<div class="listitem"></div>
					</div>
			        <div class="card-footer right-align">
						{{General::simpan()}}
						{{General::simpankembali()}}
			          	@if(request()->session()->get('halaman') != '')
		            		@php($ambil_kembali = request()->session()->get('halaman'))
	                    @else
	                    	@php($ambil_kembali = URL('dashboard/pembelian'))
	                    @endif
						{{General::batal($ambil_kembali)}}
			        </div>
				</div>
			</div>
		</div>
	</form>

	<script type="text/javascript">
		jQuery(document).ready(function() {
		idtoko = $('#tokos_id :selected').val();
			$('.listitem').load('{{URL("/dashboard/pembelian/listitem")}}/'+idtoko+'/0');

			$('#suppliers_id').select2({
				width: '100%',
				placeholder: 'Pilih Supplier',
				tags: true,
				ajax: {
					url: '{{URL("dashboard/pembelian/listsupplier")}}/'+idtoko,
					dataType: 'json',
					delay: 250,
					type: "GET",
					data: function (params) {
						var queryParameters = {
							term: params.term
						}
						return queryParameters;
					},
					processResults: function (data) {
						return {
							results:  $.map(data, function (item) {
								return {
									text: item.nama_suppliers,
									id: item.id_suppliers,
								}
							})
						};
					},
					cache: true
				}
			});

			idsupplier = $('#suppliers_id :selected').val();
			if(idsupplier != '')
			{
				$.ajax({
						url: '{{URL("dashboard/pembelian/teleponsupplier")}}/'+idsupplier,
						type: "GET",
						dataType: 'JSON',
						success: function(data)
						{
							$('#telepon_suppliers').val(data.telepon_suppliers);
						},
						error: function(data) {
						}
				});
			}
			$('#suppliers_id').on('change', function() {
				idsupplier = $('#suppliers_id :selected').val();
				$('#telepon_suppliers').attr("placeholder", "Masukkan telepon supplier");
				if(idsupplier != '')
				{
					$.ajax({
						url: '{{URL("dashboard/pembelian/teleponsupplier")}}/'+idsupplier,
						type: "GET",
						dataType: 'JSON',
						success: function(data)
						{
							$('#telepon_suppliers').val(data.telepon_suppliers);
						},
                        error: function(data) {
                        }
                	});
				}
			});

			$('#pembayarans_id').select2({
				width: '100%',
				placeholder: 'Pilih Pembayaran',
				tags: true,
				ajax: {
					url: '{{URL("dashboard/pembelian/listpembayaran")}}/'+idtoko,
					dataType: 'json',
					delay: 250,
					type: "GET",
					data: function (params) {
						var queryParameters = {
							term: params.term
						}
						return queryParameters;
					},
					processResults: function (data) {
						return {
							results:  $.map(data, function (item) {
								return {
									text: item.nama_pembayarans,
									id: item.id_pembayarans,
								}
							})
						};
					},
					cache: true
				}
			});

			$('#tokos_id').on('change', function() {
				idtoko = $('#tokos_id :selected').val();
				$('#suppliers_id').val('').trigger('change');
				$('#pembayarans_id').val('').trigger('change');
				$('#telepon_suppliers').val('');
				$('.listitem').load('{{URL("/dashboard/pembelian/listitem")}}/'+idtoko+'/0');

				$('#suppliers_id').select2({
					width: '100%',
					placeholder: 'Pilih Supplier',
					tags: true,
					ajax: {
						url: '{{URL("dashboard/pembelian/listsupplier")}}/'+idtoko,
						dataType: 'json',
						delay: 250,
						type: "GET",
						data: function (params) {
							var queryParameters = {
								term: params.term
							}
							return queryParameters;
						},
						processResults: function (data) {
							return {
								results:  $.map(data, function (item) {
									return {
										text: item.nama_suppliers,
										id: item.id_suppliers,
									}
								})
							};
						},
						cache: true
					}
				});

				$('#telepon_suppliers').val('');

				$('#pembayarans_id').select2({
					width: '100%',
					placeholder: 'Pilih Pembayaran',
					tags: true,
					ajax: {
						url: '{{URL("dashboard/pembelian/listpembayaran")}}/'+idtoko,
						dataType: 'json',
						delay: 250,
						type: "GET",
						data: function (params) {
							var queryParameters = {
								term: params.term
							}
							return queryParameters;
						},
						processResults: function (data) {
							return {
								results:  $.map(data, function (item) {
									return {
										text: item.nama_pembayarans,
										id: item.id_pembayarans,
									}
								})
							};
						},
						cache: true
					}
				});
			});
		});
	</script>

@endsection