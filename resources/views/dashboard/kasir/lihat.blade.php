@extends('dashboard.layouts.app')
@section('content')

	<style type="text/css">
		video {
			filter: grayscale(100%) brightness(100%);
		}
	</style>
    <script src="{{ URL::asset('template/back/vendors/scanner/instascan.min.js') }}"></script>
	<div class="row">
		<div class="col-xl-9 col-md-6 col-sm-6 mb-4">
			<div class="row">
				@foreach($lihat_items as $items)
					@if($items->stok_items > 0)
						<div class="col-xl-2 col-md-6 col-sm-6 mb-4">
							<div class="card" style="cursor:pointer" onclick="tambahItemList('{{$items->id_items}}','{{$items->nama_items}}','{{$items->harga_items}}')">
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
					@else
						<div class="col-xl-2 col-md-6 col-sm-6 mb-4" style="filter:grayscale(100%);">
							<div class="card" style="background-color:#202739; color:white">
								<div class="card-header mx-4 p-3 text-center" style="background-color:#202739;">
									<div class="shadow text-center border-radius-lg">
										<img src="{{URL::asset('storage/'.$items->foto_items)}}" width="100%">
									</div>
								</div>
								<div class="card-body pt-0 p-3 text-center">
									<h6 class="text-center text-xs mb-0 text-light">{{$items->nama_items}}</h6>
									<span class="text-xs text-light">Stok {{$items->stok_items}}</span>
									<hr class="horizontal light my-3">
									<h5 class="mb-0 text-xs text-light">Rp. {{General::ubahDBKeHarga($items->harga_items)}}</h5>
								</div>
							</div>
						</div>
					@endif
				@endforeach
			</div>
        </div>
		<div class="col-xl-3 col-md-6 col-sm-6 mb-4">
			<form action="{{ URL('beranda/prosestambah') }}" method="POST">
				{{ csrf_field() }}
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
							<figure>
								<video height="150" id="preview" style="width: 100%; padding-top:25px"></video>
							</figure>
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
							<figure>
								<video height="150" id="preview" style="width: 100%; padding-top:25px"></video>
							</figure>
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
							<div class="detailpemesanan">
								@if(!empty(Request::old('items_id')))
									@foreach(Request::old('items_id') as $items_id)
										@php($ambil_items = \App\Master_item::where('id_items',$items_id)->first())

										<div id="list{{$items_id}}" class="row">
											<div class="col-sm-4">
												<p style="font-weight: bold; font-size: 14px; margin-top: 5px">{{$ambil_items->nama_items}}</p>
												<input id="items_id{{$items_id}}" class="items_id" type="hidden" name="items_id[]" value="{{$items_id}}">
											</div>
											<div class="col-sm-2">
												<input id="jumlah_penjualan_details{{$items_id}}" onkeyup="kalkulasiJumlah({{$items_id}})" type="text" style="text-align: right" class="form-control jumlah_penjualan_details" name="jumlah_penjualan_details[{{$items_id}}]" value="{{Request::old('jumlah_penjualan_details.'.$items_id) == '' ? 1 : Request::old('jumlah_penjualan_details.'.$items_id)}}">
											</div>
											<div class="col-sm-4">
												<input id="harga_penjualan_details{{$items_id}}" onkeyup="kalkulasiHarga({{$items_id}})" type="text" style="text-align: right;" class="form-control harga_penjualan_details" name="harga_penjualan_details[{{$items_id}}]" value="{{Request::old('harga_penjualan_details.'.$items_id) == '' ? $ambil_items->harga_items : Request::old('harga_penjualan_details.'.$items_id)}}">
											</div>
											<div class="col-sm-2">
												<button type="button" onclick="deleteItemList({{$items_id}})" class="btn btn-sm btn-danger"><svg class="c-icon"><use xlink:href="{{URL::asset("public/template/assets/icons/coreui/free-symbol-defs.svg#cui-trash")}}"></use></svg></button>
											</div>
											<input id="sub_total_penjualan_details{{$items_id}}" type="hidden" class="form-control sub_total_penjualan_details" name="sub_total_penjualan_details[{{$items_id}}]" value="{{Request::old('sub_total_penjualan_details.'.$items_id) == '' ? $ambil_items->harga_items : Request::old('sub_total_penjualan_details.'.$items_id)}}">
										</div>
										<hr id="hrlist{{$items_id}}" style="border:2px solid #202739"/>
									@endforeach
								@endif
							</div>
						<div class="row">
							<div class="col-sm-3">
								<p style="text-align: right; font-weight: bold; font-size: 14px; margin-top: 5px">		
									Sub Total
								</p>
							</div>
							<div class="col-sm-9">
								<div class="form-group">
									<input readonly class="form-control {{ General::validForm($errors->first('sub_total_penjualans')) }} sub_total_penjualans right-align" id="sub_total_penjualans" type="text" name="sub_total_penjualans" value="{{Request::old('sub_total_penjualans') == '' ? General::ubahDBKeHarga(0) : Request::old('sub_total_penjualans') }}">
									{{General::pesanErrorForm($errors->first('sub_total_penjualans'))}}
								</div>
							</div>
							<div class="col-sm-3">
								<p style="text-align: right; font-weight: bold; font-size: 14px; margin-top: 5px">		
									Pajak %
								</p>
							</div>
							<div class="col-sm-9">
								<div class="form-group">
									<input class="form-control {{ General::validForm($errors->first('pajak_penjualans')) }} right-align pajak_penjualans" id="pajak_penjualans" type="number" name="pajak_penjualans" value="{{Request::old('pajak_penjualans') == '' ? 0 : Request::old('pajak_penjualans') }}">
									{{General::pesanErrorForm($errors->first('pajak_penjualans'))}}
								</div>
							</div>
							<div class="col-sm-3">
								<p style="text-align: right; font-weight: bold; font-size: 14px; margin-top: 5px">		
									Diskon %
								</p>
							</div>
							<div class="col-sm-9">
								<div class="form-group">
									<input class="form-control {{ General::validForm($errors->first('diskon_penjualans')) }} right-align diskon_penjualans" id="diskon_penjualans" type="number" name="diskon_penjualans" value="{{Request::old('diskon_penjualans') == '' ? 0 : Request::old('diskon_penjualans') }}">
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
									<input readonly class="form-control {{ General::validForm($errors->first('total_penjualans')) }} right-align total_penjualans" id="total_penjualans" type="text" name="total_penjualans" value="{{Request::old('total_penjualans') == '' ? General::ubahDBKeHarga(0) : Request::old('total_penjualans') }}">
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
									<input class="form-control {{ General::validForm($errors->first('pembayaran_penjualans')) }} right-align pembayaran_penjualans" id="pembayaran_penjualans" type="text" name="pembayaran_penjualans" value="{{Request::old('pembayaran_penjualans') == '' ? General::ubahDBKeHarga(0) : Request::old('pembayaran_penjualans') }}">
									{{General::pesanErrorForm($errors->first('pembayaran_penjualans'))}}
								</div>
							</div>
							<div class="col-md-3">
								<p style="text-align: right; font-weight: bold; font-size: 14px; margin-top: 5px">		
									Kembali
								</p>
							</div>
							<div class="col-md-9">
								<div class="form-group">
									<input readonly class="form-control {{ General::validForm($errors->first('kembalian_penjualans')) }} right-align kembalian_penjualans" id="kembalian_penjualans" type="text" name="kembalian_penjualans" value="{{Request::old('kembalian_penjualans') == '' ? General::ubahDBKeHarga(0) : Request::old('kembalian_penjualans') }}">
									{{General::pesanErrorForm($errors->first('kembalian_penjualans'))}}
								</div>
							</div>
						</div>
						<div class="form-group">
							<textarea class="form-control {{ General::validForm($errors->first('keterangan_penjualans')) }}" id="keterangan_penjualans" name="keterangan_penjualans" rows="5" placeholder="Masukkan catatan">{{Request::old('keterangan_penjualans')}}</textarea>
							{{General::pesanErrorForm($errors->first('keterangan_penjualans'))}}
						</div>
					</div>
					<div class="card-footer">
						<div style="bottom: 0">
							<button class="btn btn-sm btn-primary" style="width: 100%; font-weight: bold; display:none" id="cetakbutton" type="submit" name="cetak" value="cetak">
								<p style="margin: 0 auto; font-weight: bold; font-size: 16px;">Cetak</p>
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
    </div>

	<script type="text/javascript">
		let scanner = new Instascan.Scanner({
        	video: document.getElementById('preview'),
        	backgroundScan: true,
        });
        scanner.addListener('scan', function (content) {
        	iditem       = content.split('-')[0];
            namaitem     = content.split('-')[1];
            hargaitem    = content.split('-')[2];
            tambahItemList(iditem,namaitem,hargaitem);
            const rollSound = new Audio("{{URL::asset('storage/scanner/beep.mp3')}}");
            rollSound.play();
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0)
            {
                scanner.start(cameras[0]);
            } else {
                alert('Kamera tidak ditemukan.');
            }
        }).catch(function (e) {
            alert(e);
        });

		jQuery(document).ready(function () {
			$('.diskon_penjualans').on('keyup',function(){
				this.value 	= this.value.replace(/[^0-9\.]/g,'');
				sub_total 	= parseFloat($('.sub_total_penjualans').val().replace(/[^\d\.]/g,''));
				diskon 		= parseFloat($(this).val());
				pajak 		= parseFloat($('.pajak_penjualans').val());
				hitungTotal = sub_total -  diskon + pajak;
				$('.total_penjualans').val(hitungTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
				pembayaran 			= parseFloat($('.pembayaran_penjualans').val());
				hitungKembalian		= pembayaran - hitungTotal;
				$('.kembalian_penjualans').val(hitungKembalian.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
			});

			$('.pajak_penjualans').on('keyup',function(){
				this.value 			= this.value.replace(/[^0-9\.]/g,'');
				sub_total 			= parseFloat($('.sub_total_penjualans').val().replace(/[^\d\.]/g,''));
				diskon 				= parseFloat($('.diskon_penjualans').val());
				pajak 				= parseFloat($(this).val());
				hitungTotal 		= sub_total - diskon + pajak;
				$('.total_penjualans').val(hitungTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
				pembayaran 			= $('.pembayaran_penjualans').val();
				hitungKembalian		= pembayaran - hitungTotal;
				$('.kembalian_penjualans').val(hitungKembalian.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
			});

			$('.pembayaran_penjualans').on('keyup', function(){
				this.value 		= this.value.replace(/[^0-9\.]/g,'');
				total 			= parseFloat($('.total_penjualans').val().replace(/[^\d\.]/g,''));
				pembayaran 		= parseFloat($(this).val());
				hitungKembalian = pembayaran - total;
				$('.kembalian_penjualans').val(hitungKembalian.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
			});
		});

		function tambahItemList(iditem,namaitem,hargaitem)
        {
            tambahDetailPemesanan   = jQuery('<div id="list'+iditem+'" class="row">'+
												'<div class="col-sm-4">'+
													'<p style="font-weight: bold; font-size: 14px; margin-top: 5px">'+namaitem+'</p>'+
													'<input id="items_id'+iditem+'" class="items_id" type="hidden" name="items_id[]" value="'+iditem+'">'+
												'</div>'+
												'<div class="col-sm-2">'+
													'<input id="jumlah_penjualan_details'+iditem+'" onkeyup="kalkulasiJumlah(\''+iditem+'\')" type="text" style="text-align: right" class="form-control jumlah_penjualan_details" name="jumlah_penjualan_details['+iditem+']" value="1">'+
												'</div>'+
												'<div class="col-sm-4">'+
													'<input id="harga_penjualan_details'+iditem+'" onkeyup="kalkulasiHarga(\''+iditem+'\')" type="text" style="text-align: right;" class="form-control harga_penjualan_details" name="harga_penjualan_details['+iditem+']" value="'+hargaitem+'">'+
												'</div>'+
												'<div class="col-sm-2">'+
													'<button type="button" onclick="deleteItemList(\''+iditem+'\')" class="btn-sm bg-gradient-danger mb-0" style="color:white">'+
														'<i class="fas fa-trash" aria-hidden="true"></i>'+
													'</button>'+
												'</div>'+
												'<input id="sub_total_penjualan_details'+iditem+'" type="hidden" class="form-control sub_total_penjualan_details" name="sub_total_penjualan_details['+iditem+']" value="'+hargaitem+'">'+
											'</div>'+
											'<hr id="hrlist'+iditem+'"  style="border:2px solid #202739"/>');
           	tambahDetailPemesanan.find('.jumlah_penjualan_details').keyup(function() {
                this.value = this.value.replace(/[^0-9\.]/g,'');
            });
            tambahDetailPemesanan.find('.harga_penjualan_details').keyup(function() {
                this.value = this.value.replace(/[^0-9\.]/g,'');
            });
            
            if($('#items_id'+iditem).val() == undefined)
            {
	        	jQuery('.detailpemesanan').append(tambahDetailPemesanan);

	        	kalkulasiSubTotal = 0;
	            $('.sub_total_penjualan_details').each(function() {
	                var subTotal = parseFloat($(this).val().replace(/[^\d\.]/g,''));
	                kalkulasiSubTotal += subTotal;
	            });
	        	$('.sub_total_penjualans').val(kalkulasiSubTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));

	        	diskon 			= parseFloat($('.diskon_penjualans').val());
	        	pajak 			= parseFloat($('.pajak_penjualans').val());
	        	kalkulasiTotal 	= kalkulasiSubTotal - diskon + pajak;
	        	convertTotal 	= kalkulasiTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
	        	$('.total_penjualans').val(convertTotal);
	        	pembayaran 			= parseFloat($('.pembayaran_penjualans').val());
    			hitungKembalian		= pembayaran - kalkulasiTotal;
    			$('.kembalian_penjualans').val(hitungKembalian.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
	        }
	        else
	        {
	        	var kalkulasiJumlah = parseFloat($('#jumlah_penjualan_details'+iditem).val()) + 1;
                $('#jumlah_penjualan_details'+iditem).val(kalkulasiJumlah);
                var harga  = parseFloat($('#harga_penjualan_details'+iditem).val());
                var kalkulasiHarga = kalkulasiJumlah * harga;
                $('#sub_total_penjualan_details'+iditem).val(kalkulasiHarga.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));

	        	kalkulasiSubTotal = 0;
	            $('.sub_total_penjualan_details').each(function() {
	                var subTotal = parseFloat($(this).val().replace(/[^\d\.]/g,''));
	                kalkulasiSubTotal += subTotal;
	            });
	        	$('.sub_total_penjualans').val(kalkulasiSubTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));

	        	diskon 			= parseFloat($('.diskon_penjualans').val());
	        	pajak 			= parseFloat($('.pajak_penjualans').val());
	        	kalkulasiTotal 	= kalkulasiSubTotal - diskon + pajak;
	        	convertTotal 	= kalkulasiTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
	        	$('.total_penjualans').val(convertTotal);
	        	pembayaran 			= parseFloat($('.pembayaran_penjualans').val());
    			hitungKembalian		= pembayaran - kalkulasiTotal;
    			$('.kembalian_penjualans').val(hitungKembalian.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
	        }

	        $('#cetakbutton').css('display','block');
        }

		function kalkulasiJumlah(iditem)
        {
        	jumlah 			= parseFloat($('#jumlah_penjualan_details'+iditem).val());
        	harga  			= parseFloat($('#harga_penjualan_details'+iditem).val());
        	subTotalItem 	= jumlah * harga;
        	$('#sub_total_penjualan_details'+iditem).val(subTotalItem.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));

        	kalkulasiSubTotal = 0;
	        $('.sub_total_penjualan_details').each(function() {
	            var subTotal = parseFloat($(this).val().replace(/[^\d\.]/g,''));
	            kalkulasiSubTotal += subTotal;
	        });
	        $('.sub_total_penjualans').val(kalkulasiSubTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));

	        diskon 			= parseFloat($('.diskon_penjualans').val());
	        pajak 			= parseFloat($('.pajak_penjualans').val());
	        kalkulasiTotal 	= kalkulasiSubTotal - diskon + pajak;
	        convertTotal 	= kalkulasiTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
	        $('.total_penjualans').val(convertTotal);
	        pembayaran 			= parseFloat($('.pembayaran_penjualans').val());
    		hitungKembalian		= pembayaran - kalkulasiTotal;
    		$('.kembalian_penjualans').val(hitungKembalian.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
        }

        function kalkulasiHarga(iditem)
        {
        	jumlah 			= parseFloat($('#jumlah_penjualan_details'+iditem).val());
        	harga  			= parseFloat($('#harga_penjualan_details'+iditem).val());
        	subTotalItem 	= jumlah * harga;
        	$('#sub_total_penjualan_details'+iditem).val(subTotalItem.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));

        	kalkulasiSubTotal = 0;
	        $('.sub_total_penjualan_details').each(function() {
	            var subTotal = parseFloat($(this).val().replace(/[^\d\.]/g,''));
	            kalkulasiSubTotal += subTotal;
	        });
	        $('.sub_total_penjualans').val(kalkulasiSubTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));

	        diskon 			= parseFloat($('.diskon_penjualans').val());
	        pajak 			= parseFloat($('.pajak_penjualans').val());
	        kalkulasiTotal 	= kalkulasiSubTotal - diskon + pajak;
	        convertTotal 	= kalkulasiTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
	        $('.total_penjualans').val(convertTotal);
	        pembayaran 			= parseFloat($('.pembayaran_penjualans').val());
    		hitungKembalian		= pembayaran - kalkulasiTotal;
    		$('.kembalian_penjualans').val(hitungKembalian.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
        }

        function deleteItemList(iditem)
        {
        	$('#list'+iditem).remove();
        	$('#hrlist'+iditem).remove();
        	kalkulasiSubTotal = 0;
            $('.sub_total_penjualan_details').each(function() {
                var subTotal = parseFloat($(this).val().replace(/[^\d\.]/g,''));
                kalkulasiSubTotal += subTotal;
            });
        	$('.sub_total_penjualans').val(kalkulasiSubTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));

        	diskon 			= parseFloat($('.diskon_penjualans').val());
        	pajak 			= parseFloat($('.pajak_penjualans').val());
        	kalkulasiTotal 	= kalkulasiSubTotal - diskon + pajak;
        	convertTotal 	= kalkulasiTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        	$('.total_penjualans').val(convertTotal);
	        pembayaran 			= parseFloat($('.pembayaran_penjualans').val());
    		hitungKembalian		= pembayaran - kalkulasiTotal;
    		$('.kembalian_penjualans').val(hitungKembalian.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));

        	if($('.items_id').length != 0)
        	{
	        	$('#cetakbutton').css('display','block');
        	}
        	else
        	{
        		$('#cetakbutton').css('display','none');
        	}
        }
	</script>

@endsection