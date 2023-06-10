<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Helpers\General;
use Auth;
use Storage;
use App\Exports\LaporanStok;
use App\Exports\LaporanStokBaca;
use Maatwebsite\Excel\Facades\Excel;

class LaporanStokController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_laporan_stok = 'laporan_stok';
        if(General::hakAkses($link_laporan_stok,'lihat') == 'true')
        {
            $url_sekarang                   = $request->fullUrl();
            $data['link_laporan_stok']      = $link_laporan_stok;
            $data['hasil_kata']             = '';

            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                $hasil_toko                 = '';
                $data['lihat_laporan_stoks']        = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                    ->get();
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $hasil_toko                 = Auth::user()->tokos_id;
                $data['lihat_laporan_stoks']        = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                    ->where('id_tokos',$hasil_toko)
                                                                    ->get();
            }
            $data['hasil_toko']             = $hasil_toko;
            $data['lihat_kategori_items']   = \App\Models\Master_kategori_item::orderBy('nama_kategori_items')
                                                                                ->get();
            $data['hasil_kategori_item']   = '';
            session()->forget('halaman');
            session()->forget('hasil_toko');
            session()->forget('hasil_kata');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.laporan_stok.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_laporan_stok = 'laporan_stok';
        if(General::hakAkses($link_laporan_stok,'lihat') == 'true')
        {
            $data['link_laporan_stok']      = $link_laporan_stok;
            $url_sekarang                   = $request->fullUrl();
            $hasil_kata                     = $request->cari_kata;
            $data['hasil_kata']             = $hasil_kata;
            $hasil_toko                     = $request->cari_toko;
            $data['hasil_toko']             = $hasil_toko;
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                if($hasil_toko != '')
                {
                    $data['lihat_laporan_stoks']            = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->where('nama_items', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->get();
                }
                else
                {
                    $data['lihat_laporan_stoks']            = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                    ->where('nama_items', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->get();
                }
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $data['lihat_laporan_stoks']            = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                        ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                        ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                        ->where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('id_tokos',$hasil_toko)
                                                                        ->orWhere('nama_kategori_items', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('id_tokos',$hasil_toko)
                                                                        ->orWhere('nama_satuans', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('id_tokos',$hasil_toko)
                                                                        ->orWhere('nama_satuans', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('id_tokos',$hasil_toko)
                                                                        ->get();
            }
            session(['halaman'              => $url_sekarang]);
            session(['hasil_toko'		    => $hasil_toko]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.laporan_stok.lihat', $data);
        }
        else
            return redirect('dashboard/laporan_stok');
    }

    public function cetakexcel()
    {
        $link_laporan_stok = 'laporan_stok';
        if(General::hakAkses($link_laporan_stok,'cetak') == 'true')
        {
            $tanggal      = date('Y-m-d H:i:s');
            return Excel::download(new LaporanStok, 'laporanstok_'.General::ubahDBKeTanggalwaktu($tanggal).'.xlsx');
        }
        else
            return redirect('dashboard/laporan_stok');
    }

    public function baca($id_items=0, Request $request)
    {
        $link_laporan_stok = 'laporan_stok';
        if(General::hakAkses($link_laporan_stok,'baca') == 'true')
        {
            $data['link_laporan_stok']                  = $link_laporan_stok;
            $data['lihat_itmes']                        = \App\Models\Master_item::where('id_items',$id_items)
                                                                                    ->first();
            $tanggal_mulai                              = date('Y-m-01');
            $tanggal_selesai                            = date('Y-m-j', strtotime("last day of this month"));
            $hasil_tanggal                              = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']                      = $tanggal_mulai;
            $data['tanggal_selesai']                    = $tanggal_selesai;
            $data['hasil_tanggal']                      = $hasil_tanggal;
            $data['baca_items']                         = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                    ->where('id_items',$id_items)
                                                                                    ->first();
            $transaksi_pembelian                        = \App\Models\Transaksi_pembelian_detail::selectRaw('no_pembelians AS no_transaksi,
                                                                                                            transaksi_pembelians.tanggal_pembelians AS tanggal_transaksi,
                                                                                                            "masuk" AS jenis_transaksi,
                                                                                                            users.name AS nama_admin,
                                                                                                            jumlah_pembelian_details AS total_transaksi')
                                                                                                ->join('transaksi_pembelians','transaksi_pembelians.id_pembelians','=','transaksi_pembelians.id_pembelians')
                                                                                                ->join('users','users_id','=','users.id')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->where('items_id',$id_items)
                                                                                                ->orderBy('transaksi_pembelians.tanggal_pembelians','asc');
            $transaksi_penjualan                        = \App\Models\Transaksi_penjualan_detail::selectRaw('no_penjualans AS no_transaksi,
                                                                                                            transaksi_penjualans.tanggal_penjualans AS tanggal_transaksi,
                                                                                                            "keluar" as jenis_transaksi,
                                                                                                            users.name AS nama_admin,
                                                                                                            jumlah_penjualan_details AS total_transaksi')
                                                                                                ->join('transaksi_penjualans','penjualans_id','=','transaksi_penjualans.id_penjualans')
                                                                                                ->join('users','users_id','=','users.id')
                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                ->where('items_id',$id_items)
                                                                                                ->union($transaksi_pembelian)
                                                                                                ->orderBy('tanggal_transaksi')
                                                                                                ->get();
            $data['baca_laporan_stoks']               = $transaksi_penjualan;
            session()->forget('tanggal_mulai');
            session()->forget('tanggal_selesai');
            return view('dashboard.laporan_stok.baca',$data);
        }
        else
            return redirect('dashboard/laporan_stok');
    }

    public function caribaca($id_items=0, Request $request)
    {
        $link_laporan_stok = 'laporan_stok';
        if(General::hakAkses($link_laporan_stok,'baca') == 'true')
        {
            $data['link_laporan_stok']                  = $link_laporan_stok;
            $data['lihat_itmes']                        = \App\Models\Master_item::where('id_items',$id_items)
                                                                                    ->first();
                                                                                    
            $ambil_tanggal                              = $request->cari_tanggal;
            $pecah_tanggal                              = explode(' sampai ',$ambil_tanggal);
            $tanggal_mulai                              = General::ubahTanggalKeDB($pecah_tanggal[0]);
            $tanggal_selesai                            = General::ubahTanggalKeDB($pecah_tanggal[1]);
            $hasil_tanggal                              = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']                      = $tanggal_mulai;
            $data['tanggal_selesai']                    = $tanggal_selesai;
            $data['hasil_tanggal']                      = $hasil_tanggal;

            $data['baca_items']                         = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                    ->where('id_items',$id_items)
                                                                                    ->first();
            $transaksi_pembelian                        = \App\Models\Transaksi_pembelian_detail::selectRaw('no_pembelians AS no_transaksi,
                                                                                                            transaksi_pembelians.tanggal_pembelians AS tanggal_transaksi,
                                                                                                            "masuk" AS jenis_transaksi,
                                                                                                            users.name AS nama_admin,
                                                                                                            jumlah_pembelian_details AS total_transaksi')
                                                                                                ->join('transaksi_pembelians','transaksi_pembelians.id_pembelians','=','transaksi_pembelians.id_pembelians')
                                                                                                ->join('users','users_id','=','users.id')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                ->where('items_id',$id_items)
                                                                                                ->orderBy('transaksi_pembelians.tanggal_pembelians','asc');
            $transaksi_penjualan                        = \App\Models\Transaksi_penjualan_detail::selectRaw('no_penjualans AS no_transaksi,
                                                                                                            transaksi_penjualans.tanggal_penjualans AS tanggal_transaksi,
                                                                                                            "keluar" as jenis_transaksi,
                                                                                                            users.name AS nama_admin,
                                                                                                            jumlah_penjualan_details AS total_transaksi')
                                                                                                ->join('transaksi_penjualans','penjualans_id','=','transaksi_penjualans.id_penjualans')
                                                                                                ->join('users','users_id','=','users.id')
                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                ->where('items_id',$id_items)
                                                                                                ->union($transaksi_pembelian)
                                                                                                ->orderBy('tanggal_transaksi')
                                                                                                ->get();
            $data['baca_laporan_stoks']               = $transaksi_penjualan;
            session(['tanggal_mulai'	    => $tanggal_mulai]);
            session(['tanggal_selesai'	    => $tanggal_selesai]);
            session(['hasil_tanggal'	    => $hasil_tanggal]);
            return view('dashboard.laporan_stok.baca',$data);
        }
        else
            return redirect('dashboard/laporan_stok');
    }

    public function cetakexcelbaca($id_items, Request $request)
    {
        $link_laporan_stok = 'laporan_stok';
        if(General::hakAkses($link_laporan_stok,'baca') == 'true')
        {
            $ambil_items        = \App\Models\Master_item::where('id_items',$id_items)->first();
            $tanggal_mulai = date('Y-m-d');
            if(!empty(session('tanggal_mulai')))
                $tanggal_mulai = session('tanggal_mulai');

            $tanggal_selesai = date('Y-m-j', strtotime("last day of this month"));
            if(!empty(session('tanggal_selesai')))
                $tanggal_selesai = session('tanggal_selesai');
            return Excel::download(new LaporanStokBaca($id_items), 'laporanstok_'.$ambil_items->nama_items.'_'.General::ubahDBKeTanggal($tanggal_mulai).'_'.General::ubahDBKeTanggal($tanggal_selesai).'.xlsx');
        }
        else
            return redirect('dashboard/laporan_stok');
    }
}