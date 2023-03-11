@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Baca Laporan Keuangan</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::cetakexcel($link_laporan_keuangan,'dashboard/laporan_keuangan/cetakexcel') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/laporan_keuangan/cari') }}">
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
                    <table id="tablesort" class="table table-responsive-sm table-bordered table-striped table-sm">
				    	<thead>
				    		<tr>
				    			<th class="nowrap">Tanggal</th>
				    			<th class="nowrap">No</th>
				    			<th class="nowrap">Admin</th>
				    			<th class="nowrap">Masuk</th>
				    			<th class="nowrap">Keluar</th>
				    			<th class="nowrap">Total</th>
				    		</tr>
				    	</thead>
				    	<tbody>
							@php($total_keuangan_masuk 	= 0)
							@php($total_keuangan_keluar = 0)
							@php($sub_total 			   = 0)
				    		@if(!$lihat_laporan_keuangans->isEmpty())
		            			@foreach($lihat_laporan_keuangans as $laporan_keuangans)
							    	<tr>
							    		<td class="nowrap">{{General::ubahDBKeTanggalwaktu($laporan_keuangans->tanggal_transaksi)}}</td>
							    		<td class="nowrap">{{$laporan_keuangans->no_transaksi}}</td>
							    		<td class="nowrap">{{$laporan_keuangans->nama_admin}}</td>
										@if($laporan_keuangans->jenis_transaksi == 'masuk')
											@php($keuangan_masuk = $laporan_keuangans->total_transaksi)
										@else
											@php($keuangan_masuk = 0)
										@endif
							    		<td class="nowrap right-align">
											{{General::ubahDBkeHarga($keuangan_masuk)}}
										</td>
										@if($laporan_keuangans->jenis_transaksi == 'keluar')
											@php($keuangan_keluar = $laporan_keuangans->total_transaksi)
										@else
											@php($keuangan_keluar = 0)
										@endif
							    		<td class="nowrap right-align">
											{{General::ubahDBkeHarga($keuangan_keluar)}}
										</td>
										<td class="nowrap right-align">
											@php($sub_total += $keuangan_masuk - $keuangan_keluar)
											{{General::ubahDBkeHarga($sub_total)}}
										</td>
							    	</tr>
							    	@php($total_keuangan_masuk 	+= $keuangan_masuk)
							    	@php($total_keuangan_keluar += $keuangan_keluar)
							    	@php($total 			    = $sub_total)
							    @endforeach
							@else
								<tr>
									<td colspan="6" class="center-align">Tidak ada data ditampilkan</td>
									<td style="display:none"></td>
									<td style="display:none"></td>
									<td style="display:none"></td>
									<td style="display:none"></td>
									<td style="display:none"></td>
								</tr>
							@endif
				    	</tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="right-align">Total</th>
                                <th class="right-align">{{General::ubahDBkeHarga($total_keuangan_masuk)}}</th>
                                <th class="right-align">{{General::ubahDBkeHarga($total_keuangan_keluar)}}</th>
                                <th class="right-align">{{General::ubahDBkeHarga($total)}}</th>
                            </tr>
                        </tfoot>
				    </table>
				</div>
				<div class="card-footer right-align">
				  	@if(request()->session()->get('halaman') != '')
		           		@php($ambil_kembali = request()->session()->get('halaman'))
	               	@else
	               		@php($ambil_kembali = URL('dashboard/admin'))
	               	@endif
					{{General::kembali($ambil_kembali)}}
				</div>
			</div>
		</div>
	</div>

@endsection