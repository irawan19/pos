<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Helpers\General;
use Auth;
use App\Exports\LaporanPenjualanDetail;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPenjualanDetailController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_laporan_penjualan_detail = 'laporan_penjualan_detail';
        if(General::hakAkses($link_laporan_penjualan_detail,'lihat') == 'true')
        {
            $data['link_laporan_penjualan_detail']          = $link_laporan_penjualan_detail;
            $url_sekarang                                   = $request->fullUrl();
            $data['hasil_kata']                             = '';
            $tanggal_mulai                                  = date('Y-m-01');
            $tanggal_selesai                                = date('Y-m-j', strtotime("last day of this month"));
            $hasil_tanggal                                  = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']                          = $tanggal_mulai;
            $data['tanggal_selesai']                        = $tanggal_selesai;
            $data['hasil_tanggal']                          = $hasil_tanggal;
            $hasil_toko                                     = $request->cari_toko;
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']                        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                                        ->get();
                $hasil_toko                                 = '';
                $data['lihat_laporan_penjualan_details']           = \App\Models\Transaksi_penjualan_detail::selectRaw('*')
                                                                                            ->join('transaksi_penjualans','transaksi_penjualan_details.penjualans_id','=','transaksi_penjualans.id_penjualans')
                                                                                            ->join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
                                                                                            ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                            ->join('master_items','items_id','=','master_items.id_items')
                                                                                            ->join('users','users_id','=','users.id')
                                                                                            ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                            ->orderBy('transaksi_penjualans.tanggal_penjualans','asc')
                                                                                            ->get();
            }
            else
            {
                $data['lihat_tokos']                        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                                    ->orderBy('nama_tokos')
                                                                                    ->get();
                $hasil_toko                                 = Auth::user()->tokos_id;
                $data['lihat_laporan_penjualan_details']    = \App\Models\Transaksi_penjualan_detail::selectRaw('*')
                                                                                                     ->join('transaksi_penjualans','transaksi_penjualan_details.penjualans_id','=','transaksi_penjualans.id_penjualans')
                                                                                                     ->join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
                                                                                                     ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                                    ->join('master_items','items_id','=','master_items.id_items')
                                                                                                    ->join('users','users_id','=','users.id')
                                                                                                     ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                                                     ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                     ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                     ->where('id_tokos',$hasil_toko)
                                                                                                     ->orderBy('transaksi_penjualans.tanggal_penjualans','asc')
                                                                                                     ->get();
            }
            $data['hasil_toko']             = $hasil_toko;
            session()->forget('halaman');
            session()->forget('hasil_toko');
            session()->forget('hasil_kata');
            session()->forget('tanggal_mulai');
            session()->forget('tanggal_selesai');
            session()->forget('hasil_tanggal');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.laporan_penjualan_detail.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_laporan_penjualan_detail = 'laporan_penjualan_detail';
        if(General::hakAkses($link_laporan_penjualan_detail,'lihat') == 'true')
        {
            $data['link_laporan_penjualan_detail']      = $link_laporan_penjualan_detail;
            $url_sekarang                               = $request->fullUrl();
            $hasil_kata                                 = $request->cari_kata;
            $data['hasil_kata']                         = $hasil_kata;
            $hasil_toko                                 = $request->cari_toko;
            $data['hasil_toko']                         = $hasil_toko;

            $ambil_tanggal                              = $request->cari_tanggal;
            $pecah_tanggal                              = explode(' sampai ',$ambil_tanggal);
            $tanggal_mulai                              = General::ubahTanggalKeDB($pecah_tanggal[0]);
            $tanggal_selesai                            = General::ubahTanggalKeDB($pecah_tanggal[1]);
            $hasil_tanggal                              = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']                      = $tanggal_mulai;
            $data['tanggal_selesai']                    = $tanggal_selesai;
            $data['hasil_tanggal']                      = $hasil_tanggal;

            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                if($hasil_toko != '')
                {
                    $data['lihat_laporan_penjualan_details']           = \App\Models\Transaksi_penjualan_detail::selectRaw('*')
                                                                                                                ->join('transaksi_penjualans','transaksi_penjualan_details.penjualans_id','=','transaksi_penjualans.id_penjualans')
                                                                                                                ->join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
                                                                                                                ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                                                ->join('master_items','items_id','=','master_items.id_items')
                                                                                                                ->join('users','users_id','=','users.id')
                                                                                                                ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                                                                ->where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                                ->where('id_tokos',$hasil_toko)
                                                                                                                ->orWhere('no_penjualans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                                ->where('id_tokos',$hasil_toko)
                                                                                                                ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                                ->where('id_tokos',$hasil_toko)
                                                                                                                ->orWhere('nama_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                                ->where('id_tokos',$hasil_toko)
                                                                                                                ->orderBy('transaksi_penjualans.tanggal_penjualans','asc')
                                                                                                                ->get();
                }
                else
                {
                    $data['lihat_laporan_penjualan_details']           = \App\Models\Transaksi_penjualan_detail::selectRaw('*')
                                                                                                                ->join('transaksi_penjualans','transaksi_penjualan_details.penjualans_id','=','transaksi_penjualans.id_penjualans')
                                                                                                                ->join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
                                                                                                                ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                                                ->join('master_items','items_id','=','master_items.id_items')
                                                                                                                ->join('users','users_id','=','users.id')
                                                                                                                ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                                                                ->where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                                ->orWhere('no_penjualans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                                ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                                ->orWhere('nama_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                                ->orderBy('transaksi_penjualans.tanggal_penjualans','asc')
                                                                                                                ->get();
                }
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $data['lihat_laporan_penjualan_details']           = \App\Models\Transaksi_penjualan_detail::selectRaw('*')
                                                                                                            ->join('transaksi_penjualans','transaksi_penjualan_details.penjualans_id','=','transaksi_penjualans.id_penjualans')
                                                                                                            ->join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
                                                                                                            ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                                            ->join('master_items','items_id','=','master_items.id_items')
                                                                                                            ->join('users','users_id','=','users.id')
                                                                                                            ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                                                            ->where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                            ->where('id_tokos',$hasil_toko)
                                                                                                            ->orWhere('no_penjualans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                            ->where('id_tokos',$hasil_toko)
                                                                                                            ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                            ->where('id_tokos',$hasil_toko)
                                                                                                            ->orWhere('nama_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                            ->where('id_tokos',$hasil_toko)
                                                                                                            ->orderBy('transaksi_penjualans.tanggal_penjualans','asc')
                                                                                                            ->get();
            }
            session(['halaman'              => $url_sekarang]);
            session(['hasil_toko'		    => $hasil_toko]);
            session(['tanggal_mulai'	    => $tanggal_mulai]);
            session(['tanggal_selesai'	    => $tanggal_selesai]);
            session(['hasil_tanggal'	    => $hasil_tanggal]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.laporan_penjualan_detail.lihat', $data);
        }
        else
            return redirect('dashboard/laporan_penjualan_detail');
    }

    public function cetakexcel()
    {
        $link_laporan_penjualan_detail = 'link_laporan_penjualan_detail';
        if(General::hakAkses($link_laporan_penjualan_detail,'cetak') == 'true')
        {
            $tanggal_mulai = date('Y-m-d');
            if(!empty(session('tanggal_mulai')))
                $tanggal_mulai = session('tanggal_mulai');

            $tanggal_selesai = date('Y-m-j', strtotime("last day of this month"));
            if(!empty(session('tanggal_selesai')))
                $tanggal_selesai = session('tanggal_selesai');
            
            return Excel::download(new LaporanPenjualanDetail, 'laporanpenjualandetail_'.General::ubahDBKeTanggal($tanggal_mulai).'_'.General::ubahDBKeTanggal($tanggal_selesai).'.xlsx');
        }
        else
            return redirect('dashboard/laporan_penjualan_detail');
    }
}