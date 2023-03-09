<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;
use Storage;
use App\Exports\LaporanStok;
use Maatwebsite\Excel\Facades\Excel;

class LaporanStokController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_laporan_stok = 'laporan_stok';
        if(General::hakAkses($link_laporan_stok,'lihat') == 'true')
        {
            $url_sekarang                   = $request->fullUrl();
            $data['link_laporan_stok']              = $link_laporan_stok;
            $data['hasil_kata']             = '';

            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                $hasil_toko                 = '';
                $data['lihat_laporan_stoks']        = \App\Models\Master_item::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
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
                $data['lihat_laporan_stoks']        = \App\Models\Master_item::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                    ->where('tokos_id',$hasil_toko)
                                                                    ->get();
            }
            $data['hasil_toko']             = $hasil_toko;
            $data['lihat_kategori_items']   = \App\Models\Master_kategori_item::orderBy('nama_kategori_items')
                                                                                ->get();
            $data['hasil_kategori_item']   = '';
            session()->forget('halaman');
            session()->forget('hasil_toko');
            session()->forget('hasil_kategori_item');
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
            $data['lihat_kategori_items']   = \App\Models\Master_kategori_item::orderBy('nama_kategori_items')
                                                                                ->get();
            $hasil_kategori_item            = $request->hasil_kategori_item;
            $data['hasil_kategori_item']    = $request->cari_kategori_item;
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                if($hasil_toko != '')
                {
                    $data['lihat_laporan_stoks']            = \App\Models\Master_item::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                    ->where('tokos_id',$hasil_toko)
                                                                                    ->where('nama_laporan_stoks', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->get();
                }
                else
                {
                    $data['lihat_laporan_stoks']            = \App\Models\Master_item::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                    ->where('nama_laporan_stoks', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->get();
                }
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $data['lihat_laporan_stoks']            = \App\Models\Master_item::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                        ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                        ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                        ->where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('tokos_id',$hasil_toko)
                                                                        ->orWhere('nama_kategori_items', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('tokos_id',$hasil_toko)
                                                                        ->orWhere('nama_satuans', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('tokos_id',$hasil_toko)
                                                                        ->orWhere('nama_satuans', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('tokos_id',$hasil_toko)
                                                                        ->get();
            }
            session(['halaman'              => $url_sekarang]);
            session(['hasil_toko'		    => $hasil_toko]);
            session(['hasil_kategori_item'	=> $hasil_kategori_item]);
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
            $tanggal_mulai = date('Y-m-d');
            $tanggal_selesai = date('Y-m-d');
            return Excel::download(new LaporanStok, 'laporanstok_'.General::ubahDBKeTanggal($tanggal_mulai).'_'.General::ubahDBKeTanggal($tanggal_selesai).'.xlsx');
        }
        else
            return redirect('/dashboard/laporan_stok');
    }

    public function baca($id_items=0, Request $request)
    {
        $link_laporan_stok = 'laporan_stok';
        if(General::hakAkses($link_laporan_stok,'baca') == 'true')
        {
            
        }
        else
            return redirect('/dashboard/laporan_stok');
    }

    public function caribaca($id_items=0, Request $request)
    {
        $link_laporan_stok = 'laporan_stok';
        if(General::hakAkses($link_laporan_stok,'baca') == 'true')
        {
            
        }
        else
            return redirect('/dashboard/laporan_stok');
    }

    public function cetakexcelbaca($id_items, Request $request)
    {
        $link_laporan_stok = 'laporan_stok';
        if(General::hakAkses($link_laporan_stok,'baca') == 'true')
        {
            
        }
        else
            return redirect('/dashboard/laporan_stok');
    }
}