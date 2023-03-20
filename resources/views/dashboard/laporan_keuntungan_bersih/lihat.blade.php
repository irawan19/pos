@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<strong>Laporan Keuntungan Bersih</strong>
						</div>
						<div class="col-sm-6">
							<div class="right-align">
								{{ General::cetakexcel($link_laporan_keuntungan_bersih,'dashboard/laporan_keuntungan_bersih/cetakexcel') }}
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/laporan_keuntungan_bersih/cari') }}">
						@csrf
                        <div class="row">
							<div class="col-sm-3">
								<div class="form-group">
									<select class="form-control select2" id="cari_toko" name="cari_toko">
										@if(Auth::user()->tokos_id == null)
											<option value="" selected>Semua Toko</option>
										@endif
										@foreach($lihat_tokos as $tokos)
											@php($selected = '')
											@if(!empty($hasil_toko))
												@if($tokos->id_tokos == $hasil_toko)
													@php($selected = 'selected')
												@endif
											@else
												@if($tokos->id_tokos == Request::old('cari_toko'))
													@php($selected = 'selected')
												@endif
											@endif
											<option value="{{$tokos->id_tokos}}" {{ $selected }}>{{$tokos->nama_tokos}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-3">
                                <div class="form-group">
                                    <input class="form-control getStartEndDateRange" readonly id="input2-group2" type="text" name="cari_tanggal" placeholder="Cari" value="{{$hasil_tanggal}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input class="form-control" id="input2-group2" type="text" name="cari_kata" placeholder="Cari" value="{{$hasil_kata}}">
                                    <button class="btn btn-primary" type="submit"> Cari</button>
                                </div>
                            </div>
                        </div>
	                </form>
	            	<br/>
	            	<div class="scrolltable">
                        <table id="tablesort" class="table table-responsive-sm table-bordered table-striped table-sm">
				    		<thead>
				    			<tr>
				    				@if(General::totalHakAkses($link_laporan_keuntungan_bersih) != 0)
						    			<th width="5px"></th>
						    		@endif
				    				<th class="nowrap" width="50px">No</th>
				    				<th class="nowrap">Toko</th>
				    				<th class="nowrap">Kategori</th>
				    				<th class="nowrap">Kode</th>
				    				<th class="nowrap">Nama</th>
				    				<th class="nowrap">Jual</th>
				    				<th class="nowrap">Beli</th>
				    				<th class="nowrap">Keuntungan</th>
				    			</tr>
				    		</thead>
				    		<tbody>
								@php($total_all_penjualans = 0)
								@php($total_all_pembelians = 0)
								@php($total_all_keuntungans = 0)
				    			@if(!$lihat_laporan_keuntungan_bersihs->isEmpty())
									@php($no = 1)
		            				@foreach($lihat_laporan_keuntungan_bersihs as $laporan_keuntungan_bersihs)
								    	<tr>
								    		@if(General::totalHakAkses($link_laporan_keuntungan_bersih) != 0)
								    			<td class="nowrap">
													{{General::bacaButton($link_laporan_keuntungan_bersih,'dashboard/laporan_keuntungan_bersih/baca/'.$laporan_keuntungan_bersihs->id_items)}}
											    </td>
								    		@endif
								    		<td class="nowrap">{{$no}}</td>
								    		<td class="nowrap">{{$laporan_keuntungan_bersihs->nama_tokos}}</td>
								    		<td class="nowrap">{{$laporan_keuntungan_bersihs->nama_kategori_items}}</td>
								    		<td class="nowrap">{{$laporan_keuntungan_bersihs->kode_items}}</td>
								    		<td class="nowrap">{{$laporan_keuntungan_bersihs->nama_items}}</td>
											@php($ambil_penjualan = \App\Models\Transaksi_penjualan_detail::selectRaw('SUM(total_penjualan_details) AS total_penjualan_details')
																											->join('transaksi_penjualans','penjualans_id','=','transaksi_penjualans.id_penjualans')
																											->where('tokos_id',$laporan_keuntungan_bersihs->id_tokos)
																											->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
																											->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
																											->first())
								    		@if(!empty($ambil_penjualan))
												@php($total_penjualan = $ambil_penjualan->total_penjualan_details)
											@else
												@php($total_penjualan = 0)
											@endif
											<td class="nowrap right-align">{{General::ubahDBKeHarga($total_penjualan)}}</td>
								    		@php($ambil_pembelian = \App\Models\Transaksi_pembelian_detail::selectRaw('SUM(total_pembelian_details) AS total_pembelian_details')
																											->join('transaksi_pembelians','pembelians_id','=','transaksi_pembelians.id_pembelians')
																											->where('tokos_id',$laporan_keuntungan_bersihs->id_tokos)
																											->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
																											->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
																											->first())
											@if(!empty($ambil_pembelian))
												@php($total_pembelian = $ambil_pembelian->total_pembelian_details)
											@else
												@php($total_pembelian = 0)
											@endif
											<td class="nowrap right-align">{{General::ubahDBKeHarga($total_pembelian)}}</td>
											@php($total_keuntungan = $total_penjualan - $total_pembelian)
											<td class="nowrap right-align">{{General::ubahDBKeHarga($total_keuntungan)}}</td>
								    	</tr>
										@php($total_all_penjualans += $total_penjualan)
										@php($total_all_penjualans += $total_pembelian)
										@php($total_all_keuntungans += $total_keuntungan)
										@php($no++)
								    @endforeach
								@else
									<tr>
										@if(General::totalHakAkses($link_laporan_keuntungan_bersih) != 0)
											<td colspan="9" class="center-align">Tidak ada data ditampilkan</td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
										@else
											<td colspan="8" class="center-align">Tidak ada data ditampilkan</td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
											<td style="display:none"></td>
										@endif
									</tr>
								@endif
				    		</tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6" class="center-align">Total {{General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai)}}</th>
                                    <th class="right-align">{{General::ubahDBKeHarga($total_all_penjualans)}}</th>
                                    <th class="right-align">{{General::ubahDBKeHarga($total_all_pembelians)}}</th>
                                    <th class="right-align">{{General::ubahDBKeHarga($total_all_keuntungans)}}</th>
                                </tr>
                            </tfoot>
				    	</table>
				    </div>
				</div>
			</div>
		</div>
	</div>

@endsection