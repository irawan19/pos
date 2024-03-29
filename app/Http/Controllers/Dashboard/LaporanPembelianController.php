<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Helpers\General;
use Auth;
use App\Exports\LaporanPembelian;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPembelianController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_laporan_pembelian = 'laporan_pembelian';
        if(General::hakAkses($link_laporan_pembelian,'lihat') == 'true')
        {
            $data['link_laporan_pembelian']             = $link_laporan_pembelian;
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
                $data['lihat_laporan_pembelians']           = \App\Models\Transaksi_pembelian::selectRaw('*')
                                                                                            ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                            ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                            ->join('users','users_id','=','users.id')
                                                                                            ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                            ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                            ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                            ->orderBy('transaksi_pembelians.tanggal_pembelians','asc')
                                                                                            ->get();
            }
            else
            {
                $data['lihat_tokos']                        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                                    ->orderBy('nama_tokos')
                                                                                    ->get();
                $hasil_toko                                 = Auth::user()->tokos_id;
                $data['lihat_laporan_pembelians']           = \App\Models\Transaksi_pembelian::selectRaw('*')
                                                                                            ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                            ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                            ->join('users','users_id','=','users.id')
                                                                                            ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                            ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                            ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                            ->where('id_tokos',$hasil_toko)
                                                                                            ->orderBy('transaksi_pembelians.tanggal_pembelians','asc')
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
        	return view('dashboard.laporan_pembelian.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_laporan_pembelian = 'laporan_pembelian';
        if(General::hakAkses($link_laporan_pembelian,'lihat') == 'true')
        {
            $data['link_laporan_pembelian']             = $link_laporan_pembelian;
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
                    $data['lihat_laporan_pembelians']           = \App\Models\Transaksi_pembelian::selectRaw('*')
                                                                                                ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                                ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                                ->join('users','users_id','=','users.id')
                                                                                                ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
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
                                                                                                ->orWhere('nama_suppliers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->where('id_tokos',$hasil_toko)
                                                                                                ->orderBy('transaksi_pembelians.tanggal_pembelians','asc')
                                                                                                ->get();
                }
                else
                {
                    $data['lihat_laporan_pembelians']           = \App\Models\Transaksi_pembelian::selectRaw('*')
                                                                                                ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                                ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                                ->join('users','users_id','=','users.id')
                                                                                                ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                                ->where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->orWhere('no_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->orWhere('nama_suppliers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->orderBy('transaksi_pembelians.tanggal_pembelians','asc')
                                                                                                ->get();
                }
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $data['lihat_laporan_pembelians']           = \App\Models\Transaksi_pembelian::selectRaw('*')
                                                                                            ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                            ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                            ->join('users','users_id','=','users.id')
                                                                                            ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
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
                                                                                            ->orWhere('nama_suppliers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                            ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                            ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                            ->where('id_tokos',$hasil_toko)
                                                                                            ->orderBy('transaksi_pembelians.tanggal_pembelians','asc')
                                                                                            ->get();
            }
            session(['halaman'              => $url_sekarang]);
            session(['hasil_toko'		    => $hasil_toko]);
            session(['tanggal_mulai'	    => $tanggal_mulai]);
            session(['tanggal_selesai'	    => $tanggal_selesai]);
            session(['hasil_tanggal'	    => $hasil_tanggal]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.laporan_pembelian.lihat', $data);
        }
        else
            return redirect('dashboard/laporan_pembelian');
    }

    public function baca($id_pembelians=0)
    {
        $link_laporan_pembelian = 'laporan_pembelian';
        if(General::hakAkses($link_laporan_pembelian,'lihat') == 'true')
        {
            $cek_pembelians = \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)
                                                            ->count();
            if($cek_pembelians != 0)
            {
                $data['baca_laporan_pembelians']    = \App\Models\Transaksi_pembelian::selectRaw('*')
                                                                                    ->join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                    ->join('users','users_id','=','users.id')
                                                                                    ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                    ->where('id_pembelians',$id_pembelians)
                                                                                    ->first();
                $data['baca_laporan_pembelian_details'] = \App\Models\Transaksi_pembelian_detail::join('master_items','items_id','=','master_items.id_items')
                                                                                                ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                                ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                                ->where('pembelians_id',$id_pembelians)
                                                                                                ->get();
                return view('dashboard.laporan_pembelian.baca',$data);
            }
            else
                return redirect('dashboard/laporan_pembelian');
        }
        else
            return redirect('dashboard/laporan_pembelian');
    }

    public function cetakexcel()
    {
        $link_laporan_pembelian = 'laporan_pembelian';
        if(General::hakAkses($link_laporan_pembelian,'cetak') == 'true')
        {
            $tanggal_mulai = date('Y-m-d');
            if(!empty(session('tanggal_mulai')))
                $tanggal_mulai = session('tanggal_mulai');

            $tanggal_selesai = date('Y-m-j', strtotime("last day of this month"));
            if(!empty(session('tanggal_selesai')))
                $tanggal_selesai = session('tanggal_selesai');
            
            return Excel::download(new LaporanPembelian, 'laporanpembelian_'.General::ubahDBKeTanggal($tanggal_mulai).'_'.General::ubahDBKeTanggal($tanggal_selesai).'.xlsx');
        }
        else
            return redirect('dashboard/laporan_pembelian');
    }
}