<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\Queue\ShouldQueue;
use General;
use Auth;

class LaporanPembelian implements FromView, ShouldQueue
{
    use Exportable;

    public function view(): View
    {
        $hasil_kata = '';
        if(!empty(session('hasil_kata')))
            $hasil_kata = session('hasil_kata');

        $tanggal_mulai = date('Y-m-01');
        if(!empty(session('tanggal_mulai')))
            $tanggal_mulai = session('tanggal_mulai');

        $tanggal_selesai  = date('Y-m-j', strtotime("last day of this month"));
        if(!empty(session('tanggal_selesai')))
            $tanggal_selesai = session('tanggal_selesai');

        $hasil_toko = '';
        if(!empty(session('hasil_toko')))
        	$hasil_toko = session('hasil_toko');

        $data['tanggal_mulai'] 	    = $tanggal_mulai;
        $data['tanggal_selesai']	= $tanggal_selesai;

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
        return view('dashboard.laporan_pembelian.cetak_excel',$data);
    }
}
