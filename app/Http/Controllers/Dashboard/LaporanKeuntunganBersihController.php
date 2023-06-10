<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Helpers\General;
use Auth;
use Storage;
use App\Exports\LaporanKeuntunganBersih;
use App\Exports\LaporanKeuntunganBersihBaca;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKeuntunganBersihController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_laporan_keuntungan_bersih = 'laporan_keuntungan_bersih';
        if(General::hakAkses($link_laporan_keuntungan_bersih,'lihat') == 'true')
        {
            $url_sekarang                               = $request->fullUrl();
            $data['link_laporan_keuntungan_bersih']     = $link_laporan_keuntungan_bersih;
            $data['hasil_kata']                         = '';
            
            $tanggal_mulai                              = date('Y-m-01');
            $tanggal_selesai                            = date('Y-m-j', strtotime("last day of this month"));
            $hasil_tanggal                              = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']                      = $tanggal_mulai;
            $data['tanggal_selesai']                    = $tanggal_selesai;
            $data['hasil_tanggal']                      = $hasil_tanggal;
            $hasil_toko                                 = $request->cari_toko;

            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                $hasil_toko                 = '';
                $data['lihat_laporan_keuntungan_bersihs']        = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
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
                $data['lihat_laporan_keuntungan_bersihs']        = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                                        ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                        ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                        ->where('id_tokos',$hasil_toko)
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
        	return view('dashboard.laporan_keuntungan_bersih.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_laporan_keuntungan_bersih = 'laporan_keuntungan_bersih';
        if(General::hakAkses($link_laporan_keuntungan_bersih,'lihat') == 'true')
        {
            $data['link_laporan_keuntungan_bersih']         = $link_laporan_keuntungan_bersih;
            $url_sekarang                                   = $request->fullUrl();
            $hasil_kata                                     = $request->cari_kata;
            $data['hasil_kata']                             = $hasil_kata;
            $hasil_toko                                     = $request->cari_toko;
            $data['hasil_toko']                             = $hasil_toko;
            $ambil_tanggal                                  = $request->cari_tanggal;
            $pecah_tanggal                                  = explode(' sampai ',$ambil_tanggal);
            $tanggal_mulai                                  = General::ubahTanggalKeDB($pecah_tanggal[0]);
            $tanggal_selesai                                = General::ubahTanggalKeDB($pecah_tanggal[1]);
            $hasil_tanggal                                  = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']                          = $tanggal_mulai;
            $data['tanggal_selesai']                        = $tanggal_selesai;
            $data['hasil_tanggal']                          = $hasil_tanggal;

            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                if($hasil_toko != '')
                {
                    $data['lihat_laporan_keuntungan_bersihs']            = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->where('nama_items', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->get();
                }
                else
                {
                    $data['lihat_laporan_keuntungan_bersihs']            = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
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
                $data['lihat_laporan_keuntungan_bersihs']            = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
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
            session(['tanggal_mulai'	    => $tanggal_mulai]);
            session(['tanggal_selesai'	    => $tanggal_selesai]);
            session(['hasil_tanggal'	    => $hasil_tanggal]);
            return view('dashboard.laporan_keuntungan_bersih.lihat', $data);
        }
        else
            return redirect('dashboard/laporan_keuntungan_bersih');
    }

    public function cetakexcel()
    {
        $link_laporan_keuntungan_bersih = 'laporan_keuntungan_bersih';
        if(General::hakAkses($link_laporan_keuntungan_bersih,'cetak') == 'true')
        {
            $tanggal      = date('Y-m-d H:i:s');
            return Excel::download(new LaporanKeuntunganBersih, 'laporankeuntungan_bersih_'.General::ubahDBKeTanggalwaktu($tanggal).'.xlsx');
        }
        else
            return redirect('dashboard/laporan_keuntungan_bersih');
    }

    public function baca($id_items=0, Request $request)
    {
        $link_laporan_keuntungan_bersih = 'laporan_keuntungan_bersih';
        if(General::hakAkses($link_laporan_keuntungan_bersih,'baca') == 'true')
        {
            $data['link_laporan_keuntungan_bersih']     = $link_laporan_keuntungan_bersih;
            $data['lihat_itmes']                        = \App\Models\Master_item::where('id_items',$id_items)
                                                                                    ->first();
            
            $tanggal_mulai                              = date('Y-m-01');
            if(!empty(session('tanggal_mulai')))
                $tanggal_mulai                          = session('tanggal_mulai');

            $tanggal_selesai                            = date('Y-m-j', strtotime("last day of this month"));
            if(!empty(session('tanggal_selesai')))
                $tanggal_selesai                        = session('tanggal_selesai');

            $hasil_tanggal                              = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']                      = $tanggal_mulai;
            $data['tanggal_selesai']                    = $tanggal_selesai;
            $data['hasil_tanggal']                      = $hasil_tanggal;

            $hasil_toko                                 = '';
            if(!empty(session('hasil_toko')))
                $hasil_toko                             = session('hasil_toko');

            if($hasil_toko == '')
            {
                $data['baca_items']                         = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                                        ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                        ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                        ->where('id_items',$id_items)
                                                                                        ->first();

                $data['transaksi_pembelian']                = \App\Models\Transaksi_pembelian_detail::join('transaksi_pembelians','pembelians_id','=','transaksi_pembelians.id_pembelians')
                                                                                                    ->join('users','users_id','=','users.id')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                    ->where('items_id',$id_items)
                                                                                                    ->orderBy('transaksi_pembelians.tanggal_pembelians','asc')
                                                                                                    ->get();
                $data['total_pembelians']                   = \App\Models\Transaksi_pembelian_detail::selectRaw('SUM(
                                                                                                        total_pembelian_details + (total_pembelian_details * pajak_pembelians/100) - (total_pembelian_details * diskon_pembelians/100)
                                                                                                    ) AS total_all_pembelians')
                                                                                                    ->join('transaksi_pembelians','pembelians_id','=','transaksi_pembelians.id_pembelians')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                    ->where('items_id',$id_items)
                                                                                                    ->first();

                $data['transaksi_penjualan']                = \App\Models\Transaksi_penjualan_detail::join('transaksi_penjualans','penjualans_id','=','transaksi_penjualans.id_penjualans')
                                                                                                    ->join('users','users_id','=','users.id')
                                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                    ->where('items_id',$id_items)
                                                                                                    ->orderBy('transaksi_penjualans.tanggal_penjualans','asc')
                                                                                                    ->get();
                
                $data['total_penjualans']                   = \App\Models\Transaksi_penjualan_detail::selectRaw('SUM(
                                                                                                                    total_penjualan_details + (total_penjualan_details * pajak_penjualans/100) - (total_penjualan_details * diskon_penjualans/100)
                                                                                                                ) AS total_all_penjualans')
                                                                                                    ->join('transaksi_penjualans','penjualans_id','=','transaksi_penjualans.id_penjualans')
                                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                    ->where('items_id',$id_items)
                                                                                                    ->first();
            }
            else
            {
                $data['baca_items']                         = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                                        ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                        ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                        ->where('id_items',$id_items)
                                                                                        ->where('id_tokos',$hasil_toko)
                                                                                        ->first();

                $data['transaksi_pembelian']                = \App\Models\Transaksi_pembelian_detail::join('transaksi_pembelians','pembelians_id','=','transaksi_pembelians.id_pembelians')
                                                                                                    ->join('users','users_id','=','users.id')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                    ->where('items_id',$id_items)
                                                                                                    ->where('transaksi_pembelians.tokos_id',$hasil_toko)
                                                                                                    ->orderBy('transaksi_pembelians.tanggal_pembelians','asc')
                                                                                                    ->get();
                $data['total_pembelians']                   = \App\Models\Transaksi_pembelian_detail::selectRaw('SUM(
                                                                                                                total_pembelian_details + (total_pembelian_details * pajak_pembelians/100) - (total_pembelian_details * diskon_pembelians/100)
                                                                                                            ) AS total_all_pembelians')
                                                                                                    ->join('transaksi_pembelians','pembelians_id','=','transaksi_pembelians.id_pembelians')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                                    ->where('items_id',$id_items)
                                                                                                    ->where('transaksi_pembelians.tokos_id',$hasil_toko)
                                                                                                    ->first();

                $data['transaksi_penjualan']                = \App\Models\Transaksi_penjualan_detail::join('transaksi_penjualans','penjualans_id','=','transaksi_penjualans.id_penjualans')
                                                                                                    ->join('users','users_id','=','users.id')
                                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                    ->where('items_id',$id_items)
                                                                                                    ->where('transaksi_penjualans.tokos_id',$hasil_toko)
                                                                                                    ->orderBy('transaksi_penjualans.tanggal_penjualans','asc')
                                                                                                    ->get();
                
                $data['total_penjualans']                   = \App\Models\Transaksi_penjualan_detail::selectRaw('SUM(
                                                                                                                    total_penjualan_details + (total_penjualan_details * pajak_penjualans/100) - (total_penjualan_details * diskon_penjualans/100)
                                                                                                                ) AS total_all_penjualans')
                                                                                                    ->join('transaksi_penjualans','penjualans_id','=','transaksi_penjualans.id_penjualans')
                                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                                    ->where('items_id',$id_items)
                                                                                                    ->where('transaksi_penjualans.tokos_id',$hasil_toko)
                                                                                                    ->first();
            }
            $data['hasil_toko'] = $hasil_toko;
            return view('dashboard.laporan_keuntungan_bersih.baca',$data);
        }
        else
            return redirect('dashboard/laporan_keuntungan_bersih');
    }

    public function cetakexcelbaca($id_items, Request $request)
    {
        $link_laporan_keuntungan_bersih = 'laporan_keuntungan_bersih';
        if(General::hakAkses($link_laporan_keuntungan_bersih,'baca') == 'true')
        {
            $ambil_items        = \App\Models\Master_item::where('id_items',$id_items)->first();
            $tanggal_mulai = date('Y-m-d');
            if(!empty(session('tanggal_mulai')))
                $tanggal_mulai = session('tanggal_mulai');

            $tanggal_selesai = date('Y-m-j', strtotime("last day of this month"));
            if(!empty(session('tanggal_selesai')))
                $tanggal_selesai = session('tanggal_selesai');
            return Excel::download(new LaporanKeuntunganBersihBaca($id_items), 'laporankeuntungan_bersih_'.$ambil_items->nama_items.'_'.General::ubahDBKeTanggal($tanggal_mulai).'_'.General::ubahDBKeTanggal($tanggal_selesai).'.xlsx');
        }
        else
            return redirect('dashboard/laporan_keuntungan_bersih');
    }
}