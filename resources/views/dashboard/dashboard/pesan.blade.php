@extends('dashboard.layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
				    <strong>Pesan</strong>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ URL('dashboard/pesan/cari') }}">
						@csrf
	                	<div class="input-group">
	                		<input class="form-control" id="input2-group2" type="text" name="cari_kata" placeholder="Cari" value="{{$hasil_kata}}">
	                		<button class="btn btn-primary" type="submit"> Cari</button>
	                	</div>
	                </form>
	            	<br/>
	            	<div class="scrolltable">
                        <table id="tablesort" class="table table-responsive-sm table-bordered table-striped table-sm">
				    		<thead>
				    			<tr>
						    		<th width="5px"></th>
				    				<th class="nowrap" width="50px">No</th>
				    				<th class="nowrap" width="50px">Tanggal</th>
				    				<th class="nowrap">Nama</th>
				    				<th class="nowrap">Email</th>
				    				<th class="nowrap">Telepon</th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			@if(!$lihat_pesans->isEmpty())
									@php($no = 1)
		            				@foreach($lihat_pesans as $pesans)
                                        @if($pesans->status_baca_pesans == 0)
                                            @php($color = "style=font-weight:bold")
                                        @else
                                            @php($color = "")
                                        @endif
								    	<tr {{$color}}>
								    		<td class="nowrap">
												<button type="button" class="btn bg-gradient-primary mb-0 buttondetail" id="buttondetail{{$pesans->id_pesan}}" data-idpesans="{{$pesans->id_pesans}}">
													<i class="fas fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Baca
												</button>
                                            </td>
								    		<td class="nowrap">{{$no}}</td>
								    		<td class="nowrap">{{General::ubahDBKeTanggalWaktu($pesans->created_at)}}</td>
								    		<td class="nowrap">{{$pesans->nama_pesans}}</td>
								    		<td class="nowrap">{{$pesans->email_pesans}}</td>
								    		<td class="nowrap">{{$pesans->telepon_pesans}}</td>
								    	</tr>
										@php($no++)
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
				    	</table>
				    </div>
					<br/>
				   	{{ $lihat_pesans->appends(Request::except('page'))->links('vendor.pagination.custom') }}
				</div>
			</div>
		</div>
	</div>

	<div id="modalpesan" class="modal" tabindex="-1">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Detail</h5>
					<button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<table class="table table-responsive-sm table-bordered table-striped table-sm">
						<tr>
							<th>Tanggal</th>
							<th>:</th>
							<td id="tanggalpesans"></td>
						</tr>
						<tr>
							<th>Nama</th>
							<th>:</th>
							<td id="namapesans"></td>
						</tr>
						<tr>
							<th>Email</th>
							<th>:</th>
							<td id="emailpesans"></td>
						</tr>
						<tr>
							<th>Telepon</th>
							<th>:</th>
							<td id="teleponpesans"></td>
						</tr>
						<tr>
							<th>Pesan</th>
							<th>:</th>
							<td id="kontenpesans"></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

    <script type="text/javascript">
		$('.buttondetail').on('click', async function() {
			idpesan = $(this).data('idpesans');
			var headerRequest = {
							'X-CSRF-Token': $('meta[name="_token"]').attr('content'),
						};
			$.ajax({
						url: '{{URL("/dashboard/pesan/baca/")}}/'+idpesan,
						type: "GET",
						dataType: 'JSON',
						headers: headerRequest,
						success: function(data)
						{
							$('#tanggalpesans').text( moment(data['created_at']).format("DD MMM YYYY HH:mm:ss") );
							$('#namapesans').text(data['nama_pesans']);
							$('#emailpesans').text(data['email_pesans']);
							$('#teleponpesans').text(data['telepon_pesans']);
							$('#kontenpesans').text(data['konten_pesans']);
						},
                        error: function(data) {
                            console.log(data);
                        }
                });
			$("#modalpesan").modal('show');
        });
	</script>

@endsection