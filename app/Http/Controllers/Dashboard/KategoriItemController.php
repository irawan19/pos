<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class KategoriItemController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_kategori_item = 'kategori_item';
        if(General::hakAkses($link_kategori_item,'lihat') == 'true')
        {
            $data['link_kategori_item']     = $link_kategori_item;
            $data['hasil_kata']             = '';
            $url_sekarang                   = $request->fullUrl();
        	$data['lihat_kategori_items']   = \App\Models\Master_kategori_item::paginate(10);
            session()->forget('halaman');
            session()->forget('hasil_kata');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.kategori_item.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_kategori_item = 'kategori_item';
        if(General::hakAkses($link_kategori_item,'lihat') == 'true')
        {
            $data['link_kategori_item']     = $link_kategori_item;
            $url_sekarang                   = $request->fullUrl();
            $hasil_kata                     = $request->cari_kata;
            $data['hasil_kata']             = $hasil_kata;
            $data['lihat_kategori_items']   = \App\Models\Master_kategori_item::where('nama_kategori_items', 'LIKE', '%'.$hasil_kata.'%')
                                                                    ->paginate(10);
            session(['halaman'              => $url_sekarang]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.kategori_item.lihat', $data);
        }
        else
            return redirect('dashboard/kategori_item');
    }

    public function tambah(Request $request)
    {
        $link_kategori_item = 'kategori_item';
        if(General::hakAkses($link_kategori_item,'tambah') == 'true')
            return view('dashboard.kategori_item.tambah');
        else
            return redirect('dashboard/kategori_item');
    }

    public function prosestambah(Request $request)
    {
        $link_kategori_item = 'kategori_item';
        if(General::hakAkses($link_kategori_item,'tambah') == 'true')
        {
            $aturan = [
                'nama_kategori_items'                              => 'required|unique:master_kategori_items',
            ];

            $error_pesan = [
                'nama_kategori_items.required'                     => 'Form Nama Harus Diisi.',c
            ];
            $this->validate($request, $aturan, $error_pesan);

            $kategori_items_data = [
                'nama_kategori_items'                              => $request->nama_kategori_items,
                'created_at'                                => date('Y-m-d H:i:s'),
            ];
            \App\Models\Master_kategori_item::insert($kategori_items_data);

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
                    $redirect_halaman  = 'dashboard/kategori_item';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/kategori_item');
    }

    public function edit($id_kategori_items=0)
    {
        $link_kategori_item = 'kategori_item';
        if(General::hakAkses($link_kategori_item,'edit') == 'true')
        {
            $cek_kategori_items = \App\Models\Master_kategori_item::where('id_kategori_items',$id_kategori_items)->first();
            if(!empty($cek_kategori_items))
            {
                $data['edit_kategori_items']           = $cek_kategori_items;
                return view('dashboard.kategori_item.edit',$data);
            }
            else
                return redirect('dashboard/kategori_item');
        }
        else
            return redirect('dashboard/kategori_item');
    }

    public function prosesedit($id_kategori_items=0, Request $request)
    {
        $link_kategori_item = 'kategori_item';
        if(General::hakAkses($link_kategori_item,'edit') == 'true')
        {
            $cek_kategori_items = \App\Models\Master_kategori_item::where('id_kategori_items',$id_kategori_items)->first();
            if(!empty($cek_kategori_items))
            {
                $aturan = [
                    'nama_kategori_items'                          => 'required|unique:master_kategori_items,nama_kategori_items,'.$id_kategori_items.',id_kategori_items',
                ];
        
                $error_pesan = [
                    'nama_kategori_items.required'                  => 'Form Nama Harus Diisi.',
                    'nama_kategori_items.unique'                    => 'Nama Sudah Terdaftar.',
                ];
                $this->validate($request, $aturan, $error_pesan);
        
                $kategori_items_data = [
                    'nama_kategori_items'                          => $request->nama_kategori_items,
                    'updated_at'                            => date('Y-m-d H:i:s'),
                ];
                \App\Models\Master_kategori_item::where('id_kategori_items',$id_kategori_items)
                                            ->update($kategori_items_data);

                if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/kategori_item';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/kategori_item');
        }
        else
            return redirect('dashboard/kategori_item');
    }

    public function hapus($id_kategori_items=0)
    {
        $link_kategori_item = 'kategori_item';
        if(General::hakAkses($link_kategori_item,'hapus') == 'true')
        {
            $cek_kategori_items = \App\Models\Master_kategori_item::where('id_kategori_items',$id_kategori_items)->first();
            if(!empty($cek_kategori_items))
            {
                \App\Models\Master_kategori_item::where('id_kategori_items',$id_kategori_items)
                                        ->delete();
                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/kategori_item');
        }
        else
            return redirect('dashboard/kategori_item');
    }

}