<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\Queue\ShouldQueue;
use General;
use Auth;

class LaporanKeuntunganBersih implements FromView, ShouldQueue
{
    use Exportable;

    public function view(): View
    {
        $hasil_kata = '';
        if(!empty(session('hasil_kata')))
            $hasil_kata = session('hasil_kata');

        $hasil_toko = '';
        if(!empty(session('hasil_toko')))
        	$hasil_toko = session('hasil_toko');

        $tanggal_mulai = date('Y-m-01');
        if(!empty(session('tanggal_mulai')))
            $tanggal_mulai = session('tanggal_mulai');
    
        $tanggal_selesai  = date('Y-m-j', strtotime("last day of this month"));
        if(!empty(session('tanggal_selesai')))
            $tanggal_selesai = session('tanggal_selesai');

        $data['tanggal_mulai'] 	    = $tanggal_mulai;
        $data['tanggal_selesai']	= $tanggal_selesai;

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
        return view('dashboard.laporan_keuntungan_bersih.cetak_excel',$data);
    }
}
