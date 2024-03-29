<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Helpers\General;
use Auth;
use App\Exports\LaporanKeuangan;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKeuanganController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_laporan_keuangan = 'laporan_keuangan';
        if(General::hakAkses($link_laporan_keuangan,'lihat') == 'true')
        {
            $data['link_laporan_keuangan']             = $link_laporan_keuangan;
            $url_sekarang                               = $request->fullUrl();
            $data['hasil_kata']                         = '';
            $tanggal_mulai                              = date('Y-m-01');
            $tanggal_selesai                            = date('Y-m-j', strtotime("last day of this month"));
            $hasil_tanggal                              = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']                      = $tanggal_mulai;
            $data['tanggal_selesai']                    = $tanggal_selesai;
            $data['hasil_tanggal']                      = $hasil_tanggal;
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']                        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                                        ->get();
                $hasil_toko                                 = '';
                $transaksi_pembelian                        = \App\Models\Transaksi_pembelian::selectRaw('id_pembelians AS id_transaksi,
                                                                                                        no_pembelians AS no_transaksi,
                                                                                                        nama_tokos,
                                                                                                        transaksi_pembelians.tanggal_pembelians AS tanggal_transaksi,
                                                                                                        "keluar" AS jenis_transaksi,
                                                                                                        users.name AS nama_admin,
                                                                                                        total_pembelians AS total_transaksi')
                                                                                                ->join('users','users_id','=','users.id')
                                                                                                ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->orderBy('transaksi_pembelians.tanggal_pembelians','asc');
                $transaksi_penjualan                        = \App\Models\Transaksi_penjualan::selectRaw('id_penjualans AS id_transaksi,
                                                                                                        no_penjualans AS no_transaksi,
                                                                                                        nama_tokos,
                                                                                                        transaksi_penjualans.tanggal_penjualans AS tanggal_transaksi,
                                                                                                        "masuk" as jenis_transaksi,
                                                                                                        users.name AS nama_admin,
                                                                                                        total_penjualans AS total_transaksi')
                                                                                            ->join('users','users_id','=','users.id')
                                                                                            ->join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                            ->union($transaksi_pembelian)
                                                                                            ->orderBy('tanggal_transaksi')
                                                                                            ->get();
            }
            else
            {
                $data['lihat_tokos']                        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                                    ->orderBy('nama_tokos')
                                                                                    ->get();
                $hasil_toko                                 = Auth::user()->tokos_id;
                $transaksi_pembelian                        = \App\Models\Transaksi_pembelian::selectRaw('id_pembelians AS id_transaksi,
                                                                                                        no_pembelians AS no_transaksi,
                                                                                                        nama_tokos,
                                                                                                        transaksi_pembelians.tanggal_pembelians AS tanggal_transaksi,
                                                                                                        "keluar" AS jenis_transaksi,
                                                                                                        users.name AS nama_admin,
                                                                                                        total_pembelians AS total_transaksi')
                                                                                                ->join('users','transaksi_pembelians.users_id','=','users.id')
                                                                                                ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->where('transaksi_pembelians.tokos_id',$hasil_toko)
                                                                                                ->orderBy('transaksi_pembelians.tanggal_pembelians','asc');
                $transaksi_penjualan                        = \App\Models\Transaksi_penjualan::selectRaw('id_penjualans AS id_transaksi,
                                                                                                        no_penjualans AS no_transaksi,
                                                                                                        nama_tokos,
                                                                                                        transaksi_penjualans.tanggal_penjualans AS tanggal_transaksi,
                                                                                                        "masuk" as jenis_transaksi,
                                                                                                        users.name AS nama_admin,
                                                                                                        total_penjualans AS total_transaksi')
                                                                                            ->join('users','users_id','=','users.id')
                                                                                            ->join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                            ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                            ->where('transaksi_penjualans.tokos_id',$hasil_toko)
                                                                                            ->union($transaksi_pembelian)
                                                                                            ->orderBy('tanggal_transaksi')
                                                                                            ->get();
            }
            $data['lihat_laporan_keuangans']               = $transaksi_penjualan;
            $data['hasil_toko']             = $hasil_toko;
            session()->forget('halaman');
            session()->forget('hasil_toko');
            session()->forget('hasil_kata');
            session()->forget('tanggal_mulai');
            session()->forget('tanggal_selesai');
            session()->forget('hasil_tanggal');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.laporan_keuangan.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_laporan_keuangan = 'laporan_keuangan';
        if(General::hakAkses($link_laporan_keuangan,'lihat') == 'true')
        {
            $data['link_laporan_keuangan']             = $link_laporan_keuangan;
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
                    $transaksi_pembelian                        = \App\Models\Transaksi_pembelian::selectRaw('id_pembelians AS id_transaksi,
                                                                                                            no_pembelians AS no_transaksi,
                                                                                                            nama_tokos,
                                                                                                            transaksi_pembelians.tanggal_pembelians AS tanggal_transaksi,
                                                                                                            "keluar" AS jenis_transaksi,
                                                                                                            users.name AS nama_admin,
                                                                                                            total_pembelians AS total_transaksi')
                                                                                                    ->join('users','users_id','=','users.id')
                                                                                                    ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                                    ->where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                                    ->orWhere('no_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                                    ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                                    ->orderBy('transaksi_pembelians.tanggal_pembelians','asc');
                    $transaksi_penjualan                        = \App\Models\Transaksi_penjualan::selectRaw('id_penjualans AS id_transaksi,
                                                                                                            no_penjualans AS no_transaksi,
                                                                                                            nama_tokos,
                                                                                                            transaksi_penjualans.tanggal_penjualans AS tanggal_transaksi,
                                                                                                            "masuk" as jenis_transaksi,
                                                                                                            users.name AS nama_admin,
                                                                                                            total_penjualans AS total_transaksi')
                                                                                                ->join('users','users_id','=','users.id')
                                                                                                ->join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
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
                                                                                                ->union($transaksi_pembelian)
                                                                                                ->orderBy('tanggal_transaksi')
                                                                                                ->get();
                }
                else
                {
                    $transaksi_pembelian                        = \App\Models\Transaksi_pembelian::selectRaw('id_pembelians AS id_transaksi,
                                                                                                            no_pembelians AS no_transaksi,
                                                                                                            nama_tokos,
                                                                                                            transaksi_pembelians.tanggal_pembelians AS tanggal_transaksi,
                                                                                                            "keluar" AS jenis_transaksi,
                                                                                                            users.name AS nama_admin,
                                                                                                            total_pembelians AS total_transaksi')
                                                                                                    ->join('users','users_id','=','users.id')
                                                                                                    ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                                    ->where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                    ->orWhere('no_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                    ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                    ->orderBy('transaksi_pembelians.tanggal_pembelians','asc');
                    $transaksi_penjualan                        = \App\Models\Transaksi_penjualan::selectRaw('id_penjualans AS id_transaksi,
                                                                                                            no_penjualans AS no_transaksi,
                                                                                                            nama_tokos,
                                                                                                            transaksi_penjualans.tanggal_penjualans AS tanggal_transaksi,
                                                                                                            "masuk" as jenis_transaksi,
                                                                                                            users.name AS nama_admin,
                                                                                                            total_penjualans AS total_transaksi')
                                                                                                ->join('users','users_id','=','users.id')
                                                                                                ->join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
                                                                                                ->where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                ->orWhere('no_penjualans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                ->union($transaksi_pembelian)
                                                                                                ->orderBy('tanggal_transaksi')
                                                                                                ->get();
                }
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                                                                        
                $transaksi_pembelian                        = \App\Models\Transaksi_pembelian::selectRaw('id_pembelians AS id_transaksi,
                                                                                                        no_pembelians AS no_transaksi,
                                                                                                        nama_tokos,
                                                                                                        transaksi_pembelians.tanggal_pembelians AS tanggal_transaksi,
                                                                                                        "keluar" AS jenis_transaksi,
                                                                                                        users.name AS nama_admin,
                                                                                                        total_pembelians AS total_transaksi')
                                                                                                ->join('users','users_id','=','users.id')
                                                                                                ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                                ->where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->where('id_tokos',$hasil_toko)
                                                                                                ->orWhere('no_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->where('id_tokos',$hasil_toko)
                                                                                                ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->where('id_tokos',$hasil_toko)
                                                                                                ->orderBy('transaksi_pembelians.tanggal_pembelians','asc');
                $transaksi_penjualan                        = \App\Models\Transaksi_penjualan::selectRaw('id_penjualans AS id_transaksi,
                                                                                                        no_penjualans AS no_transaksi,
                                                                                                        nama_tokos,
                                                                                                        transaksi_penjualans.tanggal_penjualans AS tanggal_transaksi,
                                                                                                        "masuk" as jenis_transaksi,
                                                                                                        users.name AS nama_admin,
                                                                                                        total_penjualans AS total_transaksi')
                                                                                            ->join('users','users_id','=','users.id')
                                                                                            ->join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
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
                                                                                            ->union($transaksi_pembelian)
                                                                                            ->orderBy('tanggal_transaksi')
                                                                                            ->get();
            }
            $data['lihat_laporan_keuangans']= $transaksi_penjualan;
            session(['halaman'              => $url_sekarang]);
            session(['hasil_toko'		    => $hasil_toko]);
            session(['tanggal_mulai'	    => $tanggal_mulai]);
            session(['tanggal_selesai'	    => $tanggal_selesai]);
            session(['hasil_tanggal'	    => $hasil_tanggal]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.laporan_keuangan.lihat', $data);
        }
        else
            return redirect('dashboard/laporan_keuangan');
    }

    public function cetakexcel()
    {
        $link_laporan_keuangan = 'laporan_keuangan';
        if(General::hakAkses($link_laporan_keuangan,'cetak') == 'true')
        {
            $tanggal_mulai = date('Y-m-d');
            if(!empty(session('tanggal_mulai')))
                $tanggal_mulai = session('tanggal_mulai');

            $tanggal_selesai = date('Y-m-j', strtotime("last day of this month"));
            if(!empty(session('tanggal_selesai')))
                $tanggal_selesai = session('tanggal_selesai');
            
            return Excel::download(new LaporanKeuangan, 'laporankeuangan_'.General::ubahDBKeTanggal($tanggal_mulai).'_'.General::ubahDBKeTanggal($tanggal_selesai).'.xlsx');
        }
        else
            return redirect('dashboard/laporan_keuangan');
    }

    public function baca($id_transaksi=0, $jenis_transaksi='')
    {

        $link_laporan_keuangan = 'laporan_keuangan';
        if(General::hakAkses($link_laporan_keuangan,'cetak') == 'true')
        {
            if($jenis_transaksi == 'masuk')
            {
                $cek_penjualans = \App\Models\Transaksi_penjualan::where('id_penjualans',$id_transaksi)
                                                                ->count();
                if($cek_penjualans != 0)
                {
                    $data['baca_laporan_penjualans']    = \App\Models\Transaksi_penjualan::selectRaw('*,
                                                                                                    transaksi_penjualans.tanggal_penjualans AS tanggal_penjualans')
                                                                                        ->join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
                                                                                        ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                        ->join('users','users_id','=','users.id')
                                                                                        ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                                        ->where('id_penjualans',$id_transaksi)
                                                                                        ->first();
                    $data['baca_laporan_penjualan_details'] = \App\Models\Transaksi_penjualan_detail::join('master_items','items_id','=','master_items.id_items')
                                                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                                    ->where('penjualans_id',$id_transaksi)
                                                                                                    ->get();
                    return view('dashboard.laporan_keuangan.baca_penjualan',$data);
                }
                else
                    return redirect('dashboard/laporan_keuangan');
            }
            elseif($jenis_transaksi == 'keluar')
            {
                $cek_pembelians = \App\Models\Transaksi_pembelian::where('id_pembelians',$id_transaksi)
                                                                ->count();
                if($cek_pembelians != 0)
                {
                    $data['baca_laporan_pembelians']    = \App\Models\Transaksi_pembelian::selectRaw('*,
                                                                                                    transaksi_pembelians.tanggal_pembelians AS tanggal_pembelians')
                                                                                        ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                        ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                        ->join('users','users_id','=','users.id')
                                                                                        ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                        ->where('id_pembelians',$id_transaksi)
                                                                                        ->first();
                    $data['baca_laporan_pembelian_details'] = \App\Models\Transaksi_pembelian_detail::join('master_items','items_id','=','master_items.id_items')
                                                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                                    ->where('pembelians_id',$id_transaksi)
                                                                                                    ->get();
                    return view('dashboard.laporan_keuangan.baca_pembelian',$data);
                }
                else
                    return redirect('dashboard/laporan_keuangan');
            }
        }
        else
            return redirect('dashboard/laporan_keuangan');
    }
}