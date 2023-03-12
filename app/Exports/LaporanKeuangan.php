<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\Queue\ShouldQueue;
use General;
use Auth;

class LaporanKeuangan implements FromView, ShouldQueue
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

        if(Auth::user()->tokos_id == null)
        {
            if($hasil_toko != '')
            {
                $transaksi_pembelian                        = \App\Models\Transaksi_pembelian::selectRaw('no_pembelians AS no_transaksi,
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
                $transaksi_penjualan                        = \App\Models\Transaksi_penjualan::selectRaw('no_penjualans AS no_transaksi,
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
                $transaksi_pembelian                        = \App\Models\Transaksi_pembelian::selectRaw('no_pembelians AS no_transaksi,
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
                $transaksi_penjualan                        = \App\Models\Transaksi_penjualan::selectRaw('no_penjualans AS no_transaksi,
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
            $transaksi_pembelian                        = \App\Models\Transaksi_pembelian::selectRaw('no_pembelians AS no_transaksi,
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
            $transaksi_penjualan                        = \App\Models\Transaksi_penjualan::selectRaw('no_penjualans AS no_transaksi,
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
        $data['lihat_laporan_keuangans'] = $transaksi_penjualan;
        return view('dashboard.laporan_keuangan.cetak_excel',$data);
    }
}
