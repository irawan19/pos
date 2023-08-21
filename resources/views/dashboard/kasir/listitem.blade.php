    <div class="row">
        @if(!$lihat_items->isEmpty())
            @foreach($lihat_items as $items)
                @if($items->stok_items > 0)
                    <div class="col-xl-2 col-md-6 col-sm-6 mb-4">
                        <div class="card" style="cursor:pointer" onclick="tambahItemList({{$items->id_items}},{{$items->nama_items}},{{$items->harga_items}})">
                            <div class="card-header mx-4 p-3 text-center">
                                <span class="text-xs">{{$items->nama_kategori_items}}</span><br/>
                                <div class="shadow text-center border-radius-lg">
                                    @if(!empty($items->foto_items))
                                        <img src="{{URL::asset('storage/'.$items->foto_items)}}" width="100%">
                                    @else
                                        <img src="{{URL::asset('template/default.png')}}" width="100%">
                                    @endif
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
                                <span class="text-xs">{{$items->nama_kategori_items}}</span><br/>
                                <div class="shadow text-center border-radius-lg">
                                    @if(!empty($items->foto_items))
                                        <img src="{{URL::asset('storage/'.$items->foto_items)}}" width="100%">
                                    @else
                                        <img src="{{URL::asset('template/default.png')}}" width="100%">
                                    @endif
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
        @else
            <div class="col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body center-align">
                        <strong>Tidak ada item yang dapat di tampilkan</strong>
                    </div>
                </div>
            </div>
        @endif
	</div>