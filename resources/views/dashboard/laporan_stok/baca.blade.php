@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Baca Laporan Stok</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::cetakexcel($link_laporan_stok,'dashboard/laporan_stok/baca/'.$baca_items->id_items.'/cetakexcel') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/laporan_stok/baca/'.$baca_items->id_items.'/cari') }}">
						@csrf
                        <div class="row">
							<div class="col-sm-12">
                                <div class="input-group">
                                    <input class="form-control getStartEndDateRange" readonly id="input2-group2" type="text" name="cari_tanggal" placeholder="Cari" value="{{$hasil_tanggal}}">
                                    <button class="btn btn-primary" type="submit"> Cari</button>
                                </div>
                            </div>
                        </div>
	                </form>
	            	<br/>
                    <table class="table table-responsive-sm table-striped table-sm">
						<tr>
							<th width="150px">Toko</th>
							<th width="1px">:</th>
							<td>{{$baca_items->nama_tokos}}</td>
						</tr>
						<tr>
							<th>Kategori</th>
							<th>:</th>
							<td>{{$baca_items->nama_kategori_items}}</td>
						</tr>
						<tr>
							<th>Item</th>
							<th>:</th>
							<td>{{$baca_items->nama_items}}</td>
						</tr>
						<tr>
							<th>Satuan</th>
							<th>:</th>
							<td>{{$baca_items->nama_satuans}}</td>
						</tr>
					</table>
                    
                    <table id="tablesort" class="table table-responsive-sm table-bordered table-striped table-sm">
				    	<thead>
				    		<tr>
				    			<th class="nowrap">Tanggal</th>
				    			<th class="nowrap">No</th>
				    			<th class="nowrap">Admin</th>
				    			<th class="nowrap">Masuk</th>
				    			<th class="nowrap">Keluar</th>
				    			<th class="nowrap">Sub Total</th>
				    		</tr>
				    	</thead>
				    	<tbody>
							<tr>
								<td colspan="3">Saldo Awal</td>
								<td align="right">
									@php($saldo_awal = $baca_items->stok_awal_items)
									{{$saldo_awal}}
								</td>
								<td align="right">0</td>
								<td align="right">
									{{$saldo_awal}}
								</td>
							</tr>
							@php($sub_total 		= 0)
							@php($total_stok_masuk 	= 0)
							@php($total_stok_keluar = 0)
							@php($total 			= 0)
		            		@foreach($baca_laporan_stoks as $laporan_stoks)
								<tr>
									<td class="nowrap">{{General::ubahDBKeTanggalwaktu($laporan_stoks->tanggal_transaksi)}}</td>
									<td class="nowrap">{{$laporan_stoks->no_transaksi}}</td>
									<td class="nowrap">{{$laporan_stoks->nama_admin}}</td>
									<td class="nowrap right-align">
										@if($laporan_stoks->jenis_transaksi == 'masuk')
											@php($jumlah_stok_masuk = $laporan_stoks->total_transaksi)
										@else
											@php($jumlah_stok_masuk = 0)
										@endif
										{{$jumlah_stok_masuk}}
									</td>
									<td class="nowrap right-align">
										@if($laporan_stoks->jenis_transaksi == 'keluar')
											@php($jumlah_stok_keluar = $laporan_stoks->total_transaksi)
										@else
											@php($jumlah_stok_keluar = 0)
										@endif
										{{$jumlah_stok_keluar}}
									</td>
									<td class="nowrap right-align">
										@php($sub_total += $saldo_awal + $jumlah_stok_masuk - $jumlah_stok_keluar)
										{{$sub_total}}
									</td>
								</tr>
								@php($total_stok_masuk 	+= $jumlah_stok_masuk)
								@php($total_stok_keluar += $jumlah_stok_keluar)
								@php($total 			= $sub_total)
							@endforeach
				    	</tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="right-align">Total</th>
                                <th class="right-align">{{$total_stok_masuk}}</th>
                                <th class="right-align">{{$total_stok_keluar}}</th>
                                <th class="right-align">{{$total}}</th>
                            </tr>
                        </tfoot>
				    </table>
				</div>
				<div class="card-footer right-align">
				  	@if(request()->session()->get('halaman') != '')
		           		@php($ambil_kembali = request()->session()->get('halaman'))
	               	@else
	               		@php($ambil_kembali = URL('dashboard/laporan_stok'))
	               	@endif
					{{General::kembali($ambil_kembali)}}
				</div>
			</div>
		</div>
	</div>

@endsection