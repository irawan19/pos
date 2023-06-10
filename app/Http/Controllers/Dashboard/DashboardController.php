<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Helpers\General;
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

    public function index(Request $request)
    {
        $url_sekarang                           = $request->fullUrl();
        $data['lihat_konfigurasi_aplikasi']     = \App\Models\Master_konfigurasi_aplikasi::where('id_konfigurasi_aplikasis',1)->first();
        $bulan                                  = date('m');
        $tahun                                  = date('Y');
        $data['hasil_bulan']                    = General::ubahDBKeBulan($bulan).' '.$tahun;
        if(Auth::user()->tokos_id == null)
        {
            $data['total_customer']                 = \App\Models\Master_customer::whereRaw('MONTH(master_customers.created_at) >= "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(master_customers.created_at) >= "'.$tahun.'"')
                                                                                    ->count();
            $data['total_supplier']                 = \App\Models\Master_supplier::whereRaw('MONTH(master_suppliers.created_at) >= "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(master_suppliers.created_at) >= "'.$tahun.'"')
                                                                                    ->count();
            $data['total_jumlah_penjualan']         = \App\Models\Transaksi_penjualan::selectRaw('COUNT(total_penjualans) AS total_jumlah_penjualan')
                                                                                    ->whereRaw('MONTH(transaksi_penjualans.tanggal_penjualans) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_penjualans.tanggal_penjualans) = "'.$tahun.'"')
                                                                                    ->first();
            $data['total_jumlah_pembelian']         = \App\Models\Transaksi_pembelian::selectRaw('COUNT(total_pembelians) AS total_jumlah_pembelian')
                                                                                    ->whereRaw('MONTH(transaksi_pembelians.tanggal_pembelians) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_pembelians.tanggal_pembelians) = "'.$tahun.'"')
                                                                                    ->first();
            $data['total_toko']                     = \App\Models\Master_toko::whereRaw('MONTH(master_tokos.created_at) >= "'.$bulan.'"')
                                                                            ->whereRaw('YEAR(master_tokos.created_at) >= "'.$tahun.'"')
                                                                            ->count();
            $data['total_penjualan']                = \App\Models\Transaksi_penjualan::selectRaw('SUM(total_penjualans) AS total_penjualan')
                                                                                    ->whereRaw('MONTH(transaksi_penjualans.tanggal_penjualans) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_penjualans.tanggal_penjualans) = "'.$tahun.'"')
                                                                                    ->first();
            $data['total_pembelian']                = \App\Models\Transaksi_pembelian::selectRaw('SUM(total_pembelians) AS total_pembelian')
                                                                                    ->whereRaw('MONTH(transaksi_pembelians.tanggal_pembelians) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_pembelians.tanggal_pembelians) = "'.$tahun.'"')
                                                                                    ->first();
        }
        else
        {
            $data['total_customer']                 = \App\Models\Master_customer::whereRaw('MONTH(master_customers.created_at) >= "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(master_customers.created_at) >= "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->count();
            $data['total_supplier']                 = \App\Models\Master_supplier::whereRaw('MONTH(master_suppliers.created_at) >= "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(master_suppliers.created_at) >= "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->count();
            $data['total_jumlah_penjualan']         = \App\Models\Transaksi_penjualan::selectRaw('COUNT(total_penjualans) AS total_jumlah_penjualan')
                                                                                    ->whereRaw('MONTH(transaksi_penjualans.tanggal_penjualans) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_penjualans.tanggal_penjualans) = "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->first();
            $data['total_jumlah_pembelian']         = \App\Models\Transaksi_pembelian::selectRaw('COUNT(total_pembelians) AS total_jumlah_pembelian')
                                                                                    ->whereRaw('MONTH(transaksi_pembelians.tanggal_pembelians) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_pembelians.tanggal_pembelians) = "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->first();
            $data['total_toko']                     = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                                ->whereRaw('MONTH(master_tokos.created_at) >= "'.$bulan.'"')
                                                                                ->whereRaw('YEAR(master_tokos.created_at) >= "'.$tahun.'"')
                                                                                ->count();
            $data['total_penjualan']                = \App\Models\Transaksi_penjualan::selectRaw('SUM(total_penjualans) AS total_penjualan')
                                                                                    ->whereRaw('MONTH(transaksi_penjualans.tanggal_penjualans) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_penjualans.tanggal_penjualans) = "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->first();
            $data['total_pembelian']                = \App\Models\Transaksi_pembelian::selectRaw('SUM(total_pembelians) AS total_pembelian')
                                                                                    ->whereRaw('MONTH(transaksi_pembelians.tanggal_pembelians) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_pembelians.tanggal_pembelians) = "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->first();
        }
        session()->forget('halaman');
        session()->forget('hasil_bulan');
        session(['halaman'              => $url_sekarang]);
        return view('dashboard.dashboard.lihat',$data);
    }

    public function cari(Request $request)
    {
        $url_sekarang                           = $request->fullUrl();
        $data['lihat_konfigurasi_aplikasi']     = \App\Models\Master_konfigurasi_aplikasi::where('id_konfigurasi_aplikasis',1)->first();
        $hasil_bulan                            = $request->cari_bulan;
        $pecah_bulan                            = explode(' ',$hasil_bulan);
        $bulan                                  = $pecah_bulan[0];
        $tahun                                  = $pecah_bulan[1];
        $data['hasil_bulan']                    = $hasil_bulan;
        if(Auth::user()->tokos_id == null)
        {
            $data['total_customer']                 = \App\Models\Master_customer::whereRaw('MONTH(master_customers.created_at) >= "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(master_customers.created_at) >= "'.$tahun.'"')
                                                                                    ->count();
            $data['total_supplier']                 = \App\Models\Master_supplier::whereRaw('MONTH(master_suppliers.created_at) >= "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(master_suppliers.created_at) >= "'.$tahun.'"')
                                                                                    ->count();
            $data['total_jumlah_penjualan']         = \App\Models\Transaksi_penjualan::selectRaw('COUNT(total_penjualans) AS total_jumlah_penjualan')
                                                                                    ->whereRaw('MONTH(transaksi_penjualans.tanggal_penjualans) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_penjualans.tanggal_penjualans) = "'.$tahun.'"')
                                                                                    ->first();
            $data['total_jumlah_pembelian']         = \App\Models\Transaksi_pembelian::selectRaw('COUNT(total_pembelians) AS total_jumlah_pembelian')
                                                                                    ->whereRaw('MONTH(transaksi_pembelians.tanggal_pembelians) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_pembelians.tanggal_pembelians) = "'.$tahun.'"')
                                                                                    ->first();
            $data['total_toko']                     = \App\Models\Master_toko::whereRaw('MONTH(master_tokos.created_at) >= "'.$bulan.'"')
                                                                                ->whereRaw('YEAR(master_tokos.created_at) >= "'.$tahun.'"')
                                                                                ->count();
            $data['total_penjualan']                = \App\Models\Transaksi_penjualan::selectRaw('SUM(total_penjualans) AS total_penjualan')
                                                                                    ->whereRaw('MONTH(transaksi_penjualans.tanggal_penjualans) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_penjualans.tanggal_penjualans) = "'.$tahun.'"')
                                                                                    ->first();
            $data['total_pembelian']                = \App\Models\Transaksi_pembelian::selectRaw('SUM(total_pembelians) AS total_pembelian')
                                                                                    ->whereRaw('MONTH(transaksi_pembelians.tanggal_pembelians) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_pembelians.tanggal_pembelians) = "'.$tahun.'"')
                                                                                    ->first();
        }
        else
        {
            $data['total_customer']                 = \App\Models\Master_customer::whereRaw('MONTH(master_customers.created_at) >= "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(master_customers.created_at) >= "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->count();
            $data['total_supplier']                 = \App\Models\Master_supplier::whereRaw('MONTH(master_suppliers.created_at) >= "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(master_suppliers.created_at) >= "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->count();
            $data['total_jumlah_penjualan']         = \App\Models\Transaksi_penjualan::selectRaw('COUNT(total_penjualans) AS total_jumlah_penjualan')
                                                                                    ->whereRaw('MONTH(transaksi_penjualans.tanggal_penjualans) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_penjualans.tanggal_penjualans) = "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->first();
            $data['total_jumlah_pembelian']         = \App\Models\Transaksi_pembelian::selectRaw('COUNT(total_pembelians) AS total_jumlah_pembelian')
                                                                                    ->whereRaw('MONTH(transaksi_pembelians.tanggal_pembelians) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_pembelians.tanggal_pembelians) = "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->first();
            $data['total_toko']                     = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                                ->whereRaw('MONTH(master_tokos.created_at) >= "'.$bulan.'"')
                                                                                ->whereRaw('YEAR(master_tokos.created_at) >= "'.$tahun.'"')
                                                                                ->count();
            $data['total_penjualan']                = \App\Models\Transaksi_penjualan::selectRaw('SUM(total_penjualans) AS total_penjualan')
                                                                                    ->whereRaw('MONTH(transaksi_penjualans.tanggal_penjualans) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_penjualans.tanggal_penjualans) = "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->first();
            $data['total_pembelian']                = \App\Models\Transaksi_pembelian::selectRaw('SUM(total_pembelians) AS total_pembelian')
                                                                                    ->whereRaw('MONTH(transaksi_pembelians.tanggal_pembelians) = "'.$bulan.'"')
                                                                                    ->whereRaw('YEAR(transaksi_pembelians.tanggal_pembelians) = "'.$tahun.'"')
                                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                                    ->first();
        }
        session(['halaman'                      => $url_sekarang]);
        session(['hasil_bulan'		            => $hasil_bulan]);
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