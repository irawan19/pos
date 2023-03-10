<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class DashboardController extends AdminCoreController
{

    public function redirect()
    {
        return redirect('dashboard');
    }

    public function logout(Request $request)
    {
        $check_session = \App\Models\Session::where('user_id',Auth::user()->id)->count();
        if($check_session != 0)
            \App\Models\Session::where('user_id',Auth::user()->id)->delete();

        $users_data = [
            'remember_token' => ''
        ];
        \App\Models\User::where('id',Auth::user()->id)
                        ->update($users_data);

        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('login');
    }

    public function index()
    {
        $tanggal_hari_ini                       = date('Y-m-d');
        $data['lihat_konfigurasi_aplikasis']    = \App\Models\Master_konfigurasi_aplikasi::first();
        $data['total_pesanans']                 = 0;
        $data['total_items']                    = 0;
        $data['total_pelanggans']               = 0;
        $data['total_admins']                   = 0;
        return view('dashboard.dashboard.lihat',$data);
    }

    public function pesan(Request $request)
    {
        if(Auth::user()->tokos_id == null)
        {
            $data['hasil_kata']             = '';
            $url_sekarang                   = $request->fullUrl();
            $data['lihat_pesans']           = \App\Models\Master_pesan::orderBy('created_at','desc')
                                                                    ->orderBy('status_baca_pesans','asc')
                                                                    ->paginate(10);
            session()->forget('halaman');
            session()->forget('hasil_kata');
            session(['halaman'              => $url_sekarang]);
            return view('dashboard.dashboard.pesan',$data);
        }
        else
            return redirect('dashboard');
    }

    public function caripesan(Request $request)
    {
        if(Auth::user()->tokos_id == null)
        {
            $url_sekarang                   = $request->fullUrl();
            $hasil_kata                     = $request->cari_kata;
            $data['hasil_kata']             = $hasil_kata;
            $data['lihat_pesans']           = \App\Models\Master_pesan::where('nama_pesans', 'LIKE', '%'.$hasil_kata.'%')
                                                                    ->orWhere('email_pesans', 'LIKE', '%'.$hasil_kata.'%')
                                                                    ->orWhere('telepon_pesans', 'LIKE', '%'.$hasil_kata.'%')
                                                                    ->orderBy('created_at','desc')
                                                                    ->orderBy('status_baca_pesans','asc')
                                                                    ->paginate(10);
            session()->forget('halaman');
            session()->forget('hasil_kata');
            session(['halaman'              => $url_sekarang]);
            return view('dashboard.dashboard.pesan',$data);
        }
        else
            return redirect('dashboard');
    }

    public function bacapesan($id_pesans=0, Request $request)
    {
        if(Auth::user()->tokos_id == null)
        {
            $cek_pesans = \App\Models\Master_pesan::where('id_pesans',$id_pesans)->first();
            if(!empty($cek_pesans))
            {
                $pesans_data = [
                    'status_baca_pesans'    => 1,
                    'updated_at'            => date('Y-m-d H:i:s'),
                ];
                \App\Models\Master_pesan::where('id_pesans',$id_pesans)
                                        ->update($pesans_data);
                return json_encode($cek_pesans);
            }
            else
                return 'anda tidak boleh mengakses halaman ini.';
        }
        else
            return 'anda tidak boleh mengakses halaman ini.';
    }

}