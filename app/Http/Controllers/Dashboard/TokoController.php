<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;
use Storage;

class TokoController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_toko = 'toko';
        if(General::hakAkses($link_toko,'lihat') == 'true')
        {
            $data['link_toko']              = $link_toko;
            $data['hasil_kata']             = '';
            $url_sekarang                   = $request->fullUrl();
        	$data['lihat_tokos']            = \App\Models\Master_toko::paginate(10);
            session()->forget('halaman');
            session()->forget('hasil_kata');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.toko.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_toko = 'toko';
        if(General::hakAkses($link_toko,'lihat') == 'true')
        {
            $data['link_toko']              = $link_toko;
            $url_sekarang                   = $request->fullUrl();
            $hasil_kata                     = $request->cari_kata;
            $data['hasil_kata']             = $hasil_kata;
            $data['lihat_tokos']            = \App\Models\Master_toko::where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                    ->paginate(10);
            session(['halaman'              => $url_sekarang]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.toko.lihat', $data);
        }
        else
            return redirect('dashboard/toko');
    }

    public function tambah(Request $request)
    {
        $link_toko = 'toko';
        if(General::hakAkses($link_toko,'tambah') == 'true')
            return view('dashboard.toko.tambah');
        else
            return redirect('dashboard/toko');
    }

    public function prosestambah(Request $request)
    {
        $link_toko = 'toko';
        if(General::hakAkses($link_toko,'tambah') == 'true')
        {
            $aturan = [
                'userfile_logo_toko'                    => 'required|mimes:jpg,jpeg,png',
                'nama_tokos'                            => 'required',
                'alamat_tokos'                          => 'required',
            ];

            $error_pesan = [
                'userfile_logo_toko.required'           => 'Form Logo Harus Diisi.',
                'nama_tokos.required'                   => 'Form Nama Harus Diisi.',
                'alamat_tokos.required'                 => 'Form Alamat Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $nama_logo_toko = date('Ymd').date('His').str_replace(')','',str_replace('(','',str_replace(' ','-',$request->file('userfile_logo_toko')->getClientOriginalName())));
            $path_logo_toko = 'toko/';
            Storage::disk('public')->put($path_logo_toko.$nama_logo_toko, file_get_contents($request->file('userfile_logo_toko')));

            $tokos_data = [
                'logo_tokos'                            => $path_logo_toko.$nama_logo_toko,
                'nama_tokos'                            => $request->nama_tokos,
                'alamat_tokos'                          => $request->alamat_tokos,
                'created_at'                            => date('Y-m-d H:i:s'),
            ];
            \App\Models\Master_toko::insert($tokos_data);

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
                    $redirect_halaman  = 'dashboard/toko';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/toko');
    }

    public function edit($id_tokos=0)
    {
        $link_toko = 'toko';
        if(General::hakAkses($link_toko,'edit') == 'true')
        {
            $cek_tokos = \App\Models\Master_toko::where('id_tokos',$id_tokos)->first();
            if(!empty($cek_tokos))
            {
                $data['edit_tokos']           = $cek_tokos;
                return view('dashboard.toko.edit',$data);
            }
            else
                return redirect('dashboard/toko');
        }
        else
            return redirect('dashboard/toko');
    }

    public function prosesedit($id_tokos=0, Request $request)
    {
        $link_toko = 'toko';
        if(General::hakAkses($link_toko,'edit') == 'true')
        {
            $cek_tokos = \App\Models\Master_toko::where('id_tokos',$id_tokos)->first();
            if(!empty($cek_tokos))
            {
                if(!empty($request->userfile_logo_toko))
                {
                    $aturan = [
                        'userfile_logo_toko'                    => 'required|mimes:jpg,jpeg,png',
                        'nama_tokos'                            => 'required',
                        'alamat_tokos'                          => 'required',
                    ];
        
                    $error_pesan = [
                        'userfile_logo_toko.required'           => 'Form Logo Harus Diisi.',
                        'nama_tokos.required'                   => 'Form Nama Harus Diisi.',
                        'alamat_tokos.required'                 => 'Form Alamat Harus Diisi.',
                    ];
                    $this->validate($request, $aturan, $error_pesan);

                    $logo_toko_lama        = $cek_tokos->logo_tokos;
                    if (Storage::disk('public')->exists($logo_toko_lama))
                        Storage::disk('public')->delete($logo_toko_lama);
        
                    $nama_logo_toko = date('Ymd').date('His').str_replace(')','',str_replace('(','',str_replace(' ','-',$request->file('userfile_logo_toko')->getClientOriginalName())));
                    $path_logo_toko = 'toko/';
                    Storage::disk('public')->put($path_logo_toko.$nama_logo_toko, file_get_contents($request->file('userfile_logo_toko')));
        
                    $tokos_data = [
                        'logo_tokos'                            => $path_logo_toko.$nama_logo_toko,
                        'nama_tokos'                            => $request->nama_tokos,
                        'alamat_tokos'                          => $request->alamat_tokos,
                        'updated_at'                            => date('Y-m-d H:i:s'),
                    ];
                    \App\Models\Master_toko::where('id_tokos',$id_tokos)
                                                ->update($tokos_data);
                }
                else
                {
                    $aturan = [
                        'nama_tokos'                            => 'required',
                        'alamat_tokos'                          => 'required',
                    ];
        
                    $error_pesan = [
                        'nama_tokos.required'                   => 'Form Nama Harus Diisi.',
                        'alamat_tokos.required'                 => 'Form Alamat Harus Diisi.',
                    ];
                    $this->validate($request, $aturan, $error_pesan);
        
                    $tokos_data = [
                        'nama_tokos'                            => $request->nama_tokos,
                        'alamat_tokos'                          => $request->alamat_tokos,
                        'updated_at'                            => date('Y-m-d H:i:s'),
                    ];
                    \App\Models\Master_toko::where('id_tokos',$id_tokos)
                                                ->update($tokos_data);
                }

                if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/toko';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/toko');
        }
        else
            return redirect('dashboard/toko');
    }

    public function hapus($id_tokos=0)
    {
        $link_toko = 'toko';
        if(General::hakAkses($link_toko,'hapus') == 'true')
        {
            $cek_tokos = \App\Models\Master_toko::where('id_tokos',$id_tokos)->first();
            if(!empty($cek_tokos))
            {
                \App\Models\Master_toko::where('id_tokos',$id_tokos)
                                        ->delete();
                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/toko');
        }
        else
            return redirect('dashboard/toko');
    }

}