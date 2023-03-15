<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\Queue\ShouldQueue;
use General;
use Auth;

class LaporanStokBaca implements FromView, ShouldQueue
{
    use Exportable;

	private $id_items;

    public function __construct($id_items){
    	$this->id_items 				= $id_items;
    }

    public function view(): View
    {
        $id_items	= $this->id_items;
        
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
        return view('dashboard.laporan_stok.cetak_excel_baca',$data);
    }
}
