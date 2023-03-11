@extends('dashboard.layouts.app')
@section('content')

    <script src="{{ URL::asset('template/vendors/scanner/instascan.min.js') }}"></script>
	<div class="row">
		<div class="col-sm-8 mb-4">
			<div class="card">
				<div class="card-body"></div>
            </div>
        </div>
		<div class="col-sm-4 mb-4">
			<div class="card">
				<div class="card-body">
                    @if (Session::get('setelah_simpan.alert') == 'sukses')
						{{ General::pesanSuksesForm(Session::get('setelah_simpan.text')) }}
					@endif
					<div class="form-group">
						<select class="form-control select2" id="tokos_id" name="tokos_id">
							@foreach($tambah_tokos as $tokos)
								<option value="{{$tokos->id_tokos}}" {{ Request::old('tokos_id') == $tokos->id_tokos ? $select='selected' : $select='' }}>{{$tokos->nama_tokos}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-col-form-label" for="customers_id">Customer</label>
						<select class="form-control select2creation" id="customers_id" name="customers_id">
							<option value="">-</option>
							@foreach($tambah_customers as $customers)
								<option value="{{$customers->id_customers}}" {{ Request::old('customers_id') == $customers->id_customers ? $select='selected' : $select='' }}>{{$customers->nama_customers}}</option>
							@endforeach
						</select>
					</div>
                </div>
            </div>
        </div>
    </div>

@endsection