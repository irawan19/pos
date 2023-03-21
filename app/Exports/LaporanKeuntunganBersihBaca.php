<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\Queue\ShouldQueue;
use General;
use Auth;

class LaporanKeuntunganBersihBaca implements FromView, ShouldQueue
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

        $data['hasil_tanggal']      = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
        $data['tanggal_mulai'] 	    = $tanggal_mulai;
        $data['tanggal_selesai']	= $tanggal_selesai;

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
        return view('dashboard.laporan_keuntungan_bersih.cetak_excel_baca',$data);
    }
}
