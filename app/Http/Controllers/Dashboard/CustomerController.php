<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class CustomerController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_customer = 'customer';
        if(General::hakAkses($link_customer,'lihat') == 'true')
        {
            $data['link_customer']              = $link_customer;
            $data['hasil_kata']                 = '';
            $url_sekarang                       = $request->fullUrl();
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']                = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                $hasil_toko                         = '';
        	    $data['lihat_customers']            = \App\Models\Master_customer::join('master_tokos','master_customers.tokos_id','=','master_tokos.id_tokos')
                                                                                ->paginate(10);
            }
            else
            {
                $data['lihat_tokos']                = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                                ->orderBy('nama_tokos')
                                                                                ->get();
                $hasil_toko                         = Auth::user()->tokos_id;
        	    $data['lihat_customers']            = \App\Models\Master_customer::join('master_tokos','master_customers.tokos_id','=','master_tokos.id_tokos')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->paginate(10);
            }
            $data['hasil_toko']             = $hasil_toko;
            session()->forget('halaman');
            session()->forget('hasil_kata');
            session()->forget('hasil_toko');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.customer.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_customer = 'customer';
        if(General::hakAkses($link_customer,'lihat') == 'true')
        {
            $data['link_customer']              = $link_customer;
            $url_sekarang                       = $request->fullUrl();
            $hasil_kata                         = $request->cari_kata;
            $data['hasil_kata']                 = $hasil_kata;
            $hasil_toko                         = $request->cari_toko;
            $data['hasil_toko']                 = $hasil_toko;
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']            = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                if($hasil_toko != '')
                {
                    $data['lihat_customers']            = \App\Models\Master_customer::join('master_tokos','master_customers.tokos_id','=','master_tokos.id_tokos')
                                                                                    ->where('nama_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->orWhere('telepon_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->paginate(10);
                }
                else
                {
                    $data['lihat_customers']            = \App\Models\Master_customer::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                    ->where('nama_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->paginate(10);
                }
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $data['lihat_customers']            = \App\Models\Master_customer::join('master_tokos','master_customers.tokos_id','=','master_tokos.id_tokos')
                                                                                ->where('nama_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                ->where('id_tokos',$hasil_toko)
                                                                                ->orWhere('telepon_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                ->where('id_tokos',$hasil_toko)
                                                                                ->paginate(10);
            }
            session(['halaman'              => $url_sekarang]);
            session(['hasil_toko'		    => $hasil_toko]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.customer.lihat', $data);
        }
        else
            return redirect('dashboard/customer');
    }

    public function tambah(Request $request)
    {
        $link_customer = 'customer';
        if(General::hakAkses($link_customer,'tambah') == 'true')
        {
            if(Auth::user()->tokos_id == null)
            {
                $data['tambah_tokos'] = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                ->get();
            }
            else
            {
                $data['tambah_tokos'] = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                ->orderBy('nama_tokos')
                                                                ->get();
            }
            return view('dashboard.customer.tambah',$data);
        }
        else
            return redirect('dashboard/customer');
    }

    public function prosestambah(Request $request)
    {
        $link_customer = 'customer';
        if(General::hakAkses($link_customer,'tambah') == 'true')
        {
            $aturan = [
                'tokos_id'                                    => 'required',
                'nama_customers'                              => 'required',
            ];

            $error_pesan = [
                'tokos_id.required'                           => 'Form Toko Harus Diisi.',
                'nama_customers.required'                     => 'Form Nama Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $telepon_customers = '';
            if(!empty($request->telepon_customers))
                $telepon_customers = $request->telepon_customers;

            $customers_data = [
                'tokos_id'                                    => $request->tokos_id,
                'nama_customers'                              => $request->nama_customers,
                'telepon_customers'                           => $telepon_customers,
                'created_at'                                  => date('Y-m-d H:i:s'),
            ];
            $id_customers = \App\Models\Master_customer::insertGetId($customers_data);

            $simpan           = $request->simpan;
            $simpan_kembali   = $request->simpan_kembali;
            if($simpan)
            {
                $setelah_simpan = [
                    'alert'  => 'sukses',
                    'text'   => 'Data berhasil ditambahkan',
                ];
                return redirect()->back()->with('setelah_simpan', $setelah_simpan)->withInput($request->all());
            }
            if($simpan_kembali)
            {
                if(request()->session()->get('halaman') != '')
                    $redirect_halaman  = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/customer';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/customer');
    }

    public function edit($id_customers=0)
    {
        $link_customer = 'customer';
        if(General::hakAkses($link_customer,'edit') == 'true')
        {
            $cek_customers = \App\Models\Master_customer::where('id_customers',$id_customers)->first();
            if(!empty($cek_customers))
            {
                if(Auth::user()->tokos_id == null)
                {
                    $data['edit_tokos'] = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                    ->get();
                }
                else
                {
                    $data['edit_tokos'] = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                    ->orderBy('nama_tokos')
                                                                    ->get();
                }
                $data['edit_customers']           = $cek_customers;
                return view('dashboard.customer.edit',$data);
            }
            else
                return redirect('dashboard/customer');
        }
        else
            return redirect('dashboard/customer');
    }

    public function prosesedit($id_customers=0, Request $request)
    {
        $link_customer = 'customer';
        if(General::hakAkses($link_customer,'edit') == 'true')
        {
            $cek_customers = \App\Models\Master_customer::where('id_customers',$id_customers)->first();
            if(!empty($cek_customers))
            {
                $aturan = [
                    'tokos_id'                                    => 'required',
                    'nama_customers'                              => 'required',
                ];
    
                $error_pesan = [
                    'tokos_id.required'                           => 'Form Toko Harus Diisi.',
                    'nama_customers.required'                     => 'Form Nama Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);

                $telepon_customers = '';
                if(!empty($request->telepon_customers))
                    $telepon_customers = $request->telepon_customers;
        
                $customers_data = [
                    'tokos_id'                                    => $request->tokos_id,
                    'nama_customers'                              => $request->nama_customers,
                    'telepon_customers'                           => $telepon_customers,
                    'updated_at'                                  => date('Y-m-d H:i:s'),
                ];
                \App\Models\Master_customer::where('id_customers',$id_customers)
                                                ->update($customers_data);

                if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/customer';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/customer');
        }
        else
            return redirect('dashboard/customer');
    }

    public function hapus($id_customers=0)
    {
        $link_customer = 'customer';
        if(General::hakAkses($link_customer,'hapus') == 'true')
        {
            $cek_customers = \App\Models\Master_customer::where('id_customers',$id_customers)->first();
            if(!empty($cek_customers))
            {
                \App\Models\Master_customer::where('id_customers',$id_customers)
                                        ->delete();
                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/customer');
        }
        else
            return redirect('dashboard/customer');
    }

}