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
        	$data['lihat_customers']            = \App\Models\Master_customer::paginate(10);
            session()->forget('halaman');
            session()->forget('hasil_kata');
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
            $data['lihat_customers']            = \App\Models\Master_customer::where('nama_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                    ->paginate(10);
            session(['halaman'              => $url_sekarang]);
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
            return view('dashboard.customer.tambah');
        else
            return redirect('dashboard/customer');
    }

    public function prosestambah(Request $request)
    {
        $link_customer = 'customer';
        if(General::hakAkses($link_customer,'tambah') == 'true')
        {
            $aturan = [
                'nama_customers'                              => 'required',
            ];

            $error_pesan = [
                'nama_customers.required'                     => 'Form Nama Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $customers_data = [
                'nama_customers'                              => $request->nama_customers,
                'created_at'                                => date('Y-m-d H:i:s'),
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
                    'nama_customers'                          => 'required',
                ];
        
                $error_pesan = [
                    'nama_customers.required'                 => 'Form Nama Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);
        
                $customers_data = [
                    'nama_customers'                          => $request->nama_customers,
                    'updated_at'                            => date('Y-m-d H:i:s'),
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