@extends('dashboard.layouts.app')
@section('content')

    <form class="form-horizontal m-t-40" action="{{ URL('dashboard/pembelian/prosesedit/'.$edit_pembelians->id_pembelians) }}" method="POST">
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
                                @foreach($edit_tokos as $tokos)
				                    @php($selected = '')
					                @if(Request::old('tokos_id') == '')
					                	@if($tokos->id_tokos == $edit_pembelians->tokos_id)
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
                            <label class="form-col-form-label" for="tanggal_pembelians">Tanggal <b style="color:red">*</b></label>
                            <input readonly class="form-control {{ General::validForm($errors->first('tanggal_pembelians')) }} getDateTime" id="tanggal_pembelians" type="text" name="tanggal_pembelians" value="{{Request::old('tanggal_pembelians') == '' ? General::ubahDBKeTanggalwaktu($edit_pembelians->tanggal_pembelians) : Request::old('tanggal_pembelians') }}">
                            {{General::pesanErrorForm($errors->first('tanggal_pembelians'))}}
                        </div>
                        <div class="form-group">
                            <label class="form-col-form-label" for="referensi_no_nota_pembelians">Referensi No Nota </label>
                            <input class="form-control {{ General::validForm($errors->first('referensi_no_nota_pembelians')) }}" id="referensi_no_nota_pembelians" type="text" name="referensi_no_nota_pembelians" value="{{Request::old('referensi_no_nota_pembelians') == '' ? $edit_pembelians->referensi_no_nota_pembelians : Request::old('referensi_no_nota_pembelians')}}">
                            {{General::pesanErrorForm($errors->first('referensi_no_nota_pembelians'))}}
                        </div>
                        <div class="form-group">
                            <label class="form-col-form-label" for="suppliers_id">Supplier</label>
                            <select class="form-control select2creation" id="suppliers_id" name="suppliers_id">
                                <option value="">-</option>
                                @foreach($edit_suppliers as $suppliers)
				                    @php($selected = '')
					                @if(Request::old('suppliers_id') == '')
					                	@if($suppliers->id_suppliers == $edit_pembelians->suppliers_id)
					                		@php($selected = 'selected')
					                	@endif
					                @else
					                	@if($suppliers->id_suppliers == Request::old('suppliers_id'))
					                		@php($selected = 'selected')
					                	@endif
					                @endif
                                    <option value="{{$suppliers->id_suppliers}}" {{ $selected }}>{{$suppliers->nama_suppliers}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-col-form-label" for="pembayarans_id">Pembayaran <b style="color:red">*</b></label>
                            <select class="form-control select2" id="pembayarans_id" name="pembayarans_id">
                                @foreach($edit_pembayarans as $pembayarans)
				                    @php($selected = '')
					                @if(Request::old('pembayarans_id') == '')
					                	@if($pembayarans->id_pembayarans == $edit_pembelians->pembayarans_id)
					                		@php($selected = 'selected')
					                	@endif
					                @else
					                	@if($pembayarans->id_pembayarans == Request::old('pembayarans_id'))
					                		@php($selected = 'selected')
					                	@endif
					                @endif
                                    <option value="{{$pembayarans->id_pembayarans}}" {{ $selected }}>{{$pembayarans->nama_pembayarans}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-col-form-label" for="diskon_pembelians">Diskon %</label>
                            <input class="form-control {{ General::validForm($errors->first('diskon_pembelians')) }} right-align" id="diskon_pembelians" type="number" name="diskon_pembelians" value="{{Request::old('diskon_pembelians') == '' ? $edit_pembelians->diskon_pembelians : Request::old('diskon_pembelians') }}">
                            {{General::pesanErrorForm($errors->first('diskon_pembelians'))}}
                        </div>
                        <div class="form-group">
                            <label class="form-col-form-label" for="pajak_pembelians">Pajak %</label>
                            <input class="form-control {{ General::validForm($errors->first('pajak_pembelians')) }} right-align" id="pajak_pembelians" type="number" name="pajak_pembelians" value="{{Request::old('pajak_pembelians') == '' ? $edit_pembelians->pajak_pembelians : Request::old('pajak_pembelians') }}">
                            {{General::pesanErrorForm($errors->first('pajak_pembelians'))}}
                        </div>
                        <div class="form-group">
                            <label class="form-col-form-label" for="keterangan_pembelians">Keterangan </label>
                            <textarea class="form-control {{ General::validForm($errors->first('keterangan_pembelians')) }}" id="keterangan_pembelians" name="keterangan_pembelians" rows="5">{{Request::old('keterangan_pembelians') == '' ? $edit_pembelians->keterangan_pembelians : Request::old('keterangan_pembelians')}}</textarea>
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
                        <div class="listitem"></div>
                    </div>
                    <div class="card-footer right-align">
                        {{General::perbarui()}}
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
        idtoko = $('#tokos_id :selected').val();
        $('.listitem').load('{{URL("/dashboard/pembelian/listitem")}}/'+idtoko+'/{{$edit_pembelians->id_pembelians}}');

        $('.tokos_id').on('change', async function() {
            idtoko = $('#tokos_id :selected').val();
            $('.listitem').load('{{URL("/dashboard/pembelian/listitem")}}/'+idtoko+'/{{$edit_pembelians->id_pembelians}}');
        });
    </script>

@endsection