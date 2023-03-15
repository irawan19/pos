@extends('dashboard.layouts.app')
@section('content')

    <form class="form-horizontal m-t-40" action="{{ URL('dashboard/penjualan/prosesedit/'.$edit_penjualans->id_penjualans) }}" method="POST">
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
                                @foreach($edit_tokos as $tokos)
				                    @php($selected = '')
					                @if(Request::old('tokos_id') == '')
					                	@if($tokos->id_tokos == $edit_penjualans->tokos_id)
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
                            <label class="form-col-form-label" for="tanggal_penjualans">Tanggal <b style="color:red">*</b></label>
                            <input readonly class="form-control {{ General::validForm($errors->first('tanggal_penjualans')) }} getDateTime" id="tanggal_penjualans" type="text" name="tanggal_penjualans" value="{{Request::old('tanggal_penjualans') == '' ? General::ubahDBKeTanggalwaktu($edit_penjualans->tanggal_penjualans) : Request::old('tanggal_penjualans') }}">
                            {{General::pesanErrorForm($errors->first('tanggal_penjualans'))}}
                        </div>
                        <div class="form-group">
                            <label class="form-col-form-label" for="customers_id">Customer</label>
                            <select class="form-control select2creation" id="customers_id" name="customers_id">
                                <option value="">-</option>
                                @if(Request::old('customers_id') != NULL)
                            	    <option value="{{Request::old('customers_id')}}" selected>
                            	        @php($ambil_customers = \App\Models\Master_customer::where('id_customers',intval(Request::old('customers_id')))
                            	                                                				->first())
                            	        {{$ambil_customers->nama_customers}}
                            	    </option>
                            	@else
                                    @foreach($edit_customers as $customers)
                                        @php($selected = '')
                                        @if(Request::old('customers_id') == '')
                                            @if($customers->id_customers == $edit_penjualans->customers_id)
                                                @php($selected = 'selected')
                                            @endif
                                        @else
                                            @if($customers->id_customers == Request::old('customers_id'))
                                                @php($selected = 'selected')
                                            @endif
                                        @endif
                                        <option value="{{$customers->id_customers}}" {{ $selected }}>{{$customers->nama_customers}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
						<div class="form-group">
							<label class="form-col-form-label" for="telepon_customers">Telepon</label>
							<input class="form-control {{ General::validForm($errors->first('telepon_customers')) }}" id="telepon_customers" type="number" name="telepon_customers" value="{{Request::old('telepon_customers')}}">
							{{General::pesanErrorForm($errors->first('telepon_customers'))}}
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
                            	@else
                                    @foreach($edit_pembayarans as $pembayarans)
                                        @php($selected = '')
                                        @if(Request::old('pembayarans_id') == '')
                                            @if($pembayarans->id_pembayarans == $edit_penjualans->pembayarans_id)
                                                @php($selected = 'selected')
                                            @endif
                                        @else
                                            @if($pembayarans->id_pembayarans == Request::old('pembayarans_id'))
                                                @php($selected = 'selected')
                                            @endif
                                        @endif
                                        <option value="{{$pembayarans->id_pembayarans}}" {{ $selected }}>{{$pembayarans->nama_pembayarans}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-col-form-label" for="diskon_penjualans">Diskon %</label>
                            <input class="form-control {{ General::validForm($errors->first('diskon_penjualans')) }} right-align" id="diskon_penjualans" type="number" name="diskon_penjualans" value="{{Request::old('diskon_penjualans') == '' ? $edit_penjualans->diskon_penjualans : Request::old('diskon_penjualans') }}">
                            {{General::pesanErrorForm($errors->first('diskon_penjualans'))}}
                        </div>
                        <div class="form-group">
                            <label class="form-col-form-label" for="pajak_penjualans">Pajak %</label>
                            <input class="form-control {{ General::validForm($errors->first('pajak_penjualans')) }} right-align" id="pajak_penjualans" type="number" name="pajak_penjualans" value="{{Request::old('pajak_penjualans') == '' ? $edit_penjualans->pajak_penjualans : Request::old('pajak_penjualans') }}">
                            {{General::pesanErrorForm($errors->first('pajak_penjualans'))}}
                        </div>
                        <div class="form-group">
                            <label class="form-col-form-label" for="keterangan_penjualans">Keterangan </label>
                            <textarea class="form-control {{ General::validForm($errors->first('keterangan_penjualans')) }}" id="keterangan_penjualans" name="keterangan_penjualans" rows="5">{{Request::old('keterangan_penjualans') == '' ? $edit_penjualans->keterangan_penjualans : Request::old('keterangan_penjualans')}}</textarea>
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
						@if (Session::get('setelah_simpan.alert') == 'error')
							{{ General::pesanFlashErrorForm(Session::get('setelah_simpan.text')) }}
						@endif
						<br/>
                        <div class="listitem"></div>
                    </div>
                    <div class="card-footer right-align">
                        {{General::perbarui()}}
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
        jQuery(document).ready(function() {
        idtoko = $('#tokos_id :selected').val();
            $('.listitem').load('{{URL("/dashboard/penjualan/listitem")}}/'+idtoko+'/{{$edit_penjualans->id_penjualans}}');

            $('#customers_id').select2({
                width: '100%',
                placeholder: 'Pilih Customer',
                tags: true,
                ajax: {
                    url: '{{URL("dashboard/penjualan/listcustomer")}}/'+idtoko,
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
                                    text: item.nama_customers,
                                    id: item.id_customers,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            idcustomer = $('#customers_id :selected').val();
			if(idcustomer != '')
			{
				$.ajax({
						url: '{{URL("dashboard/penjualan/teleponcustomer")}}/'+idcustomer,
						type: "GET",
						dataType: 'JSON',
						success: function(data)
						{
							$('#telepon_customers').val(data.telepon_customers);
						},
						error: function(data) {
						}
				});
			}
            $('#customers_id').on('change', function() {
                idcustomer = $('#customers_id :selected').val();
				$('#telepon_customers').attr("placeholder", "Masukkan telepon customer");
                if(idcustomer != '')
                {
                    $.ajax({
                            url: '{{URL("dashboard/penjualan/teleponcustomer")}}/'+idcustomer,
                            type: "GET",
                            dataType: 'JSON',
                            success: function(data)
                            {
                                $('#telepon_customers').val(data.telepon_customers);
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
                    url: '{{URL("dashboard/penjualan/listpembayaran")}}/'+idtoko,
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
                $('#customers_id').val('').trigger('change');
                $('#pembayarans_id').val('').trigger('change');
                $('#telepon_customers').val('');
                $('.listitem').load('{{URL("/dashboard/penjualan/listitem")}}/'+idtoko+'/{{$edit_penjualans->id_penjualans}}');

                $('#customers_id').select2({
                    width: '100%',
                    placeholder: 'Pilih Customer',
                    tags: true,
                    ajax: {
                        url: '{{URL("dashboard/penjualan/listcustomer")}}/'+idtoko,
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
                                        text: item.nama_customers,
                                        id: item.id_customers,
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });

                $('#telepon_customers').val('');

                $('#pembayarans_id').select2({
                    width: '100%',
                    placeholder: 'Pilih Pembayaran',
                    tags: true,
                    ajax: {
                        url: '{{URL("dashboard/penjualan/listpembayaran")}}/'+idtoko,
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