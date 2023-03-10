<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class SatuanController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_satuan = 'satuan';
        if(General::hakAkses($link_satuan,'lihat') == 'true')
        {
            $data['link_satuan']              = $link_satuan;
            $data['hasil_kata']             = '';
            $url_sekarang                   = $request->fullUrl();
        	$data['lihat_satuans']            = \App\Models\Master_satuan::paginate(10);
            session()->forget('halaman');
            session()->forget('hasil_kata');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.satuan.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_satuan = 'satuan';
        if(General::hakAkses($link_satuan,'lihat') == 'true')
        {
            $data['link_satuan']              = $link_satuan;
            $url_sekarang                   = $request->fullUrl();
            $hasil_kata                     = $request->cari_kata;
            $data['hasil_kata']             = $hasil_kata;
            $data['lihat_satuans']            = \App\Models\Master_satuan::where('nama_satuans', 'LIKE', '%'.$hasil_kata.'%')
                                                                    ->paginate(10);
            session(['halaman'              => $url_sekarang]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.satuan.lihat', $data);
        }
        else
            return redirect('dashboard/satuan');
    }

    public function tambah(Request $request)
    {
        $link_satuan = 'satuan';
        if(General::hakAkses($link_satuan,'tambah') == 'true')
            return view('dashboard.satuan.tambah');
        else
            return redirect('dashboard/satuan');
    }

    public function prosestambah(Request $request)
    {
        $link_satuan = 'satuan';
        if(General::hakAkses($link_satuan,'tambah') == 'true')
        {
            $aturan = [
                'nama_satuans'                              => 'required',
            ];

            $error_pesan = [
                'nama_satuans.required'                     => 'Form Nama Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $satuans_data = [
                'nama_satuans'                              => $request->nama_satuans,
                'created_at'                                => date('Y-m-d H:i:s'),
            ];
            \App\Models\Master_satuan::insert($satuans_data);

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
                    $redirect_halaman  = 'dashboard/satuan';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/satuan');
    }

    public function edit($id_satuans=0)
    {
        $link_satuan = 'satuan';
        if(General::hakAkses($link_satuan,'edit') == 'true')
        {
            $cek_satuans = \App\Models\Master_satuan::where('id_satuans',$id_satuans)->first();
            if(!empty($cek_satuans))
            {
                $data['edit_satuans']           = $cek_satuans;
                return view('dashboard.satuan.edit',$data);
            }
            else
                return redirect('dashboard/satuan');
        }
        else
            return redirect('dashboard/satuan');
    }

    public function prosesedit($id_satuans=0, Request $request)
    {
        $link_satuan = 'satuan';
        if(General::hakAkses($link_satuan,'edit') == 'true')
        {
            $cek_satuans = \App\Models\Master_satuan::where('id_satuans',$id_satuans)->first();
            if(!empty($cek_satuans))
            {
                $aturan = [
                    'nama_satuans'                          => 'required',
                ];
        
                $error_pesan = [
                    'nama_satuans.required'                 => 'Form Nama Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);
        
                $satuans_data = [
                    'nama_satuans'                          => $request->nama_satuans,
                    'updated_at'                            => date('Y-m-d H:i:s'),
                ];
                \App\Models\Master_satuan::where('id_satuans',$id_satuans)
                                                ->update($satuans_data);

                if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/satuan';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/satuan');
        }
        else
            return redirect('dashboard/satuan');
    }

    public function hapus($id_satuans=0)
    {
        $link_satuan = 'satuan';
        if(General::hakAkses($link_satuan,'hapus') == 'true')
        {
            $cek_satuans = \App\Models\Master_satuan::where('id_satuans',$id_satuans)->first();
            if(!empty($cek_satuans))
            {
                \App\Models\Master_satuan::where('id_satuans',$id_satuans)
                                        ->delete();
                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/satuan');
        }
        else
            return redirect('dashboard/satuan');
    }

}