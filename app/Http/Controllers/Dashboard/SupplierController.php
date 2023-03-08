<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class SupplierController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_supplier = 'supplier';
        if(General::hakAkses($link_supplier,'lihat') == 'true')
        {
            $data['link_supplier']              = $link_supplier;
            $data['hasil_kata']                 = '';
            $url_sekarang                       = $request->fullUrl();
        	$data['lihat_suppliers']            = \App\Models\Master_supplier::paginate(10);
            session()->forget('halaman');
            session()->forget('hasil_kata');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.supplier.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_supplier = 'supplier';
        if(General::hakAkses($link_supplier,'lihat') == 'true')
        {
            $data['link_supplier']              = $link_supplier;
            $url_sekarang                       = $request->fullUrl();
            $hasil_kata                         = $request->cari_kata;
            $data['hasil_kata']                 = $hasil_kata;
            $data['lihat_suppliers']            = \App\Models\Master_supplier::where('nama_suppliers', 'LIKE', '%'.$hasil_kata.'%')
                                                                    ->paginate(10);
            session(['halaman'              => $url_sekarang]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.supplier.lihat', $data);
        }
        else
            return redirect('dashboard/supplier');
    }

    public function tambah(Request $request)
    {
        $link_supplier = 'supplier';
        if(General::hakAkses($link_supplier,'tambah') == 'true')
            return view('dashboard.supplier.tambah');
        else
            return redirect('dashboard/supplier');
    }

    public function prosestambah(Request $request)
    {
        $link_supplier = 'supplier';
        if(General::hakAkses($link_supplier,'tambah') == 'true')
        {
            $aturan = [
                'nama_suppliers'                              => 'required',
            ];

            $error_pesan = [
                'nama_suppliers.required'                     => 'Form Nama Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $suppliers_data = [
                'nama_suppliers'                              => $request->nama_suppliers,
                'created_at'                                => date('Y-m-d H:i:s'),
            ];
            $id_suppliers = \App\Models\Master_supplier::insertGetId($suppliers_data);

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
                    $redirect_halaman  = 'dashboard/supplier';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/supplier');
    }

    public function edit($id_suppliers=0)
    {
        $link_supplier = 'supplier';
        if(General::hakAkses($link_supplier,'edit') == 'true')
        {
            $cek_suppliers = \App\Models\Master_supplier::where('id_suppliers',$id_suppliers)->first();
            if(!empty($cek_suppliers))
            {
                $data['edit_suppliers']           = $cek_suppliers;
                return view('dashboard.supplier.edit',$data);
            }
            else
                return redirect('dashboard/supplier');
        }
        else
            return redirect('dashboard/supplier');
    }

    public function prosesedit($id_suppliers=0, Request $request)
    {
        $link_supplier = 'supplier';
        if(General::hakAkses($link_supplier,'edit') == 'true')
        {
            $cek_suppliers = \App\Models\Master_supplier::where('id_suppliers',$id_suppliers)->first();
            if(!empty($cek_suppliers))
            {
                $aturan = [
                    'nama_suppliers'                          => 'required',
                ];
        
                $error_pesan = [
                    'nama_suppliers.required'                 => 'Form Nama Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);
        
                $suppliers_data = [
                    'nama_suppliers'                          => $request->nama_suppliers,
                    'updated_at'                            => date('Y-m-d H:i:s'),
                ];
                \App\Models\Master_supplier::where('id_suppliers',$id_suppliers)
                                                ->update($suppliers_data);

                if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/supplier';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/supplier');
        }
        else
            return redirect('dashboard/supplier');
    }

    public function hapus($id_suppliers=0)
    {
        $link_supplier = 'supplier';
        if(General::hakAkses($link_supplier,'hapus') == 'true')
        {
            $cek_suppliers = \App\Models\Master_supplier::where('id_suppliers',$id_suppliers)->first();
            if(!empty($cek_suppliers))
            {
                \App\Models\Master_supplier::where('id_suppliers',$id_suppliers)
                                        ->delete();
                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/supplier');
        }
        else
            return redirect('dashboard/supplier');
    }

}