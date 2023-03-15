<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\Queue\ShouldQueue;
use General;
use Auth;

class LaporanStok implements FromView, ShouldQueue
{
    use Exportable;

    public function view(): View
    {
        $hasil_kata = '';
        if(!empty(session('hasil_kata')))
            $hasil_kata = session('hasil_kata');

        $tanggal      = date('Y-m-d H:i:s');

        $hasil_toko = '';
        if(!empty(session('hasil_toko')))
        	$hasil_toko = session('hasil_toko');

        $data['tanggal'] 	    = $tanggal;

        if($hasil_toko != '')
        {
            $data['lihat_laporan_stoks']            = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                            ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                            ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                            ->where('id_tokos',$hasil_toko)
                                                                            ->where('nama_items', 'LIKE', '%'.$hasil_kata.'%')
                                                                            ->get();
            $ambil_tokos                = \App\Models\Master_toko::select('nama_tokos')->where('id_tokos',$hasil_toko)->first();
            $data['hasil_toko']         = $hasil_toko->nama_tokos;
        }
        else
        {
            $data['lihat_laporan_stoks']            = \App\Models\Master_item::join('master_tokos','master_items.tokos_id','=','master_tokos.id_tokos')
                                                                            ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                            ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                            ->where('nama_items', 'LIKE', '%'.$hasil_kata.'%')
                                                                            ->get();
            $data['hasil_toko']         = 'Semua Toko';
        }
        return view('dashboard.laporan_stok.cetak_excel',$data);
    }
}
