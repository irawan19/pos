<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use app\Helpers\General;
use Auth;
use DB;

class LevelSistemController extends AdminCoreController
{
    public function index(Request $request)
    {
        $link_level_sistem = 'level_sistem';
        if(General::hakAkses($link_level_sistem,'lihat') == 'true')
        {
            $data['link_level_sistem']      = $link_level_sistem;
            $url_sekarang                   = $request->fullUrl();
            $data['hasil_kata']             = '';
        	$data['lihat_level_sistems']    = \App\Models\Master_level_sistem::get();
            session()->forget('halaman');
            session()->forget('hasil_kata');
            session(['halaman'                          => $url_sekarang]);
        	return view('dashboard.level_sistem.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_level_sistem = 'level_sistem';
        if(General::hakAkses($link_level_sistem,'lihat') == 'true')
        {
            $data['link_level_sistem']          = $link_level_sistem;
            $url_sekarang                       = $request->fullUrl();
            $hasil_kata                         = $request->cari_kata;
            $data['hasil_kata']                 = $hasil_kata;
            $data['lihat_level_sistems']        = \App\Models\Master_level_sistem::where('nama_level_sistems', 'LIKE', '%'.$hasil_kata.'%')
                                                                            ->get();
            session(['halaman'                  => $url_sekarang]);
            session(['hasil_kata'               => $hasil_kata]);
            return view('dashboard.level_sistem.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function tambah()
    {
        $link_level_sistem = 'level_sistem';
        if(General::hakAkses($link_level_sistem,'tambah') == 'true')
        {
            $data['tambah_menus']  = \App\Models\Master_menu::where('menus_id',null)
                                                    ->orderBy('order_menus')
                                                    ->get();
            return view('dashboard.level_sistem.tambah',$data);
        }
        else
            return redirect('dashboard/level_sistem');
    }

    public function prosestambah(Request $request)
    {
        $link_level_sistem = 'level_sistem';
        if(General::hakAkses($link_level_sistem,'tambah') == 'true')
        {
            $aturan = [
                'nama_level_sistems'           => 'required',
            ];
            $error_pesan = [
                'nama_level_sistems.required'   => 'Form Nama Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $data = [
                'nama_level_sistems'    => $request->nama_level_sistems,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ];
            $id_level_sistems = \App\Models\Master_level_sistem::insertGetId($data);

            foreach ($request->fiturs_id as $fiturs_id)
            {
                $akses_data = [
                    'level_sistems_id'      => $id_level_sistems,
                    'fiturs_id'             => $fiturs_id,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ];
                \App\Models\Master_akses::insert($akses_data);
            }
            
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
                    $redirect_halaman  = 'dashboard/level_sistem';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/level_sistem');
    }

    public function baca($id_level_sistems=0)
    {
        $link_level_sistem = 'level_sistem';
        if(General::hakAkses($link_level_sistem,'baca') == 'true')
        {
            $cek_level_sistems = \App\Models\Master_level_sistem::where('id_level_sistems',$id_level_sistems)->count();
            if($cek_level_sistems != 0)
            {
            	$data['baca_admins']			= \App\Models\User::where('level_sistems_id',$id_level_sistems)
                												->get();
                $data['baca_menus']             = \App\Models\Master_menu::where('menus_id',null)
                                                                ->orderBy('order_menus')
                                                                ->get();
                $data['baca_level_sistems']     = \App\Models\Master_level_sistem::where('id_level_sistems',$id_level_sistems)
                                                                ->first();
                return view('dashboard.level_sistem.baca',$data);
            }
            else
                return redirect('dashboard/level_sistem');
        }
        else
            return redirect('dashboard/level_sistem');
    }

    public function edit($id_level_sistems=0)
    {
        $link_level_sistem = 'level_sistem';
        if(General::hakAkses($link_level_sistem,'edit') == 'true')
        {
            $cek_level_sistems = \App\Models\Master_level_sistem::where('id_level_sistems',$id_level_sistems)->count();
            if($cek_level_sistems != 0)
            {
                $data['edit_menus']          = \App\Models\Master_menu::where('menus_id',null)
                                                                ->orderBy('order_menus')
                                                                ->get();
                $data['edit_level_sistems']  = \App\Models\Master_level_sistem::where('id_level_sistems',$id_level_sistems)
                                                                      ->first();
                return view('dashboard.level_sistem.edit',$data);
            }
            else
                return redirect('dashboard/level_sistem');
        }
        else
            return redirect('dashboard/level_sistem');
    }

    public function prosesedit($id_level_sistems=0, Request $request)
    {
        $link_level_sistem = 'level_sistem';
        if(General::hakAkses($link_level_sistem,'edit') == 'true')
        {
            $cek_level_sistems = \App\Models\Master_level_sistem::where('id_level_sistems',$id_level_sistems)->count();
            if($cek_level_sistems != 0)
            {
                $aturan = [
                    'nama_level_sistems'           => 'required',
                ];
                $error_pesan = [
                    'nama_level_sistems.required'   => 'Form Nama Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);

                $data = [
                    'nama_level_sistems'    => $request->nama_level_sistems,
                    'updated_at'            => date('Y-m-d H:i:s')
                ];
                \App\Models\Master_level_sistem::where('id_level_sistems', $id_level_sistems)
                                        ->update($data);
                
                \App\Models\Master_akses::where('level_sistems_id',$id_level_sistems)->delete();
                foreach ($request->fiturs_id as $fiturs_id)
                {
                    $akses_data = [
                        'level_sistems_id'      => $id_level_sistems,
                        'fiturs_id'             => $fiturs_id,
                        'created_at'            => date('Y-m-d H:i:s'),
                        'updated_at'            => date('Y-m-d H:i:s'),
                    ];
                    \App\Models\Master_akses::insert($akses_data);
                }

                if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/level_sistem';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/level_sistem');
        }
        else
            return redirect('dashboard/level_sistem');
    }

    public function hapus($id_level_sistems=0)
    {
        $link_level_sistem = 'level_sistem';
        if(General::hakAkses($link_level_sistem,'hapus') == 'true')
        {
            $cek_level_sistems = \App\Models\Master_level_sistem::where('id_level_sistems',$id_level_sistems)->count();
            if($cek_level_sistems != 0)
            {
                if($id_level_sistems != 1)
                {
                    $users_data = [
                        'level_sistems_id'  => 1
                    ];
                    \App\Models\User::where('level_sistems_id',$id_level_sistems)
                                    ->update($users_data);

                    DB::raw("DELETE t1.*, t2.* FROM master_level_sistems t1 LEFT JOIN master_akses t2 ON t2.level_sistems_id=t1.id_level_sistems WHERE id_level_sistems='$id_level_sistems'");

                    return response()->json(["sukses" => "sukses"], 200);
                }
                else
                    return redirect('dashboard/level_sistem');
            }
            else
                return redirect('dashboard/level_sistem');
        }
        else
            return redirect('dashboard/level_sistem');
    }

}
