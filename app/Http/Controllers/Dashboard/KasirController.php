<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;
use Storage;

class KasirController extends AdminCoreController
{

    public function index(Request $request)
    {
        if(Auth::user()->tokos_id == null)
        {
            $data['tambah_tokos']   = \App\Models\Master_toko::orderBy('nama_tokos')
                                                            ->get();
            $data['tambah_pembayarans'] = \App\Models\Master_pembayaran::orderBy('nama_pembayarans')
                                                                        ->get();
            $data['lihat_konfigurasi_aplikasi'] = \App\Models\Master_konfigurasi_aplikasi::where('id_konfigurasi_aplikasis',1)->first();
        }
        else
        {
            $data['tambah_tokos']       = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                            ->orderBy('nama_tokos')
                                                            ->get();
            $data['tambah_pembayarans'] = \App\Models\Master_pembayaran::orderBy('nama_pembayarans')
                                                                        ->get();
            $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)->first();
        }
        return view('dashboard.kasir.lihat',$data);
    }

    public function listitem($id_tokos=0, $cari='')
    {
        $cek_tokos = \App\Models\Master_toko::where('id_tokos',$id_tokos)->count();
        if($cek_tokos != 0)
        {
            if($cari == '')
            {
                $data['lihat_items'] = \App\Models\Master_item::join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                        ->where('tokos_id',$id_tokos)
                                                        ->orderBy('nama_kategori_items')
                                                        ->orderBy('nama_items')
                                                        ->get();
            }
            else
            {
                $data['lihat_items'] = \App\Models\Master_item::join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                        ->where('nama_items', 'LIKE', '%'.$cari.'%')
                                                        ->where('tokos_id',$id_tokos)
                                                        ->orderBy('nama_kategori_items')
                                                        ->orderBy('nama_items')
                                                        ->get();
            }
            return view('dashboard.kasir.listitem',$data);
        }
        else
            return 'anda tidak boleh mengakses halaman ini.';
    }

    public function listcustomer($id_tokos=0)
    {
        $cek_tokos = \App\Models\Master_toko::where('id_tokos',$id_tokos)->count();
        if($cek_tokos != 0)
        {
            $ambil_customer = \App\Models\Master_customer::where('tokos_id',$id_tokos)
                                                        ->orderBy('nama_customers')
                                                        ->get();
            return json_encode($ambil_customer);
        }
        else
            return 'anda tidak boleh mengakses halaman ini.';
    }

    public function teleponcustomer($id_customers=0)
    {
        $cek_customers = \App\Models\Master_customer::where('id_customers',$id_customers)->count();
        if($cek_customers != 0)
        {
            $ambil_customer = \App\Models\Master_customer::where('id_customers',$id_customers)
                                                        ->first();
            return json_encode($ambil_customer);
        }
        else
            return 'anda tidak boleh mengakses halaman ini.';
    }

    public function listpembayaran($id_tokos=0)
    {
        $cek_tokos = \App\Models\Master_toko::where('id_tokos',$id_tokos)->count();
        if($cek_tokos != 0)
        {
            $ambil_pembayaran = \App\Models\Master_pembayaran::where('tokos_id',$id_tokos)
                                                        ->orWhere('tokos_id',null)
                                                        ->get();
            return json_encode($ambil_pembayaran);
        }
        else
            return 'anda tidak boleh mengakses halaman ini.';
    }
    
    public function proses(Request $request)
    {
        if(empty($request->items_id))
        {
            $setelah_simpan = [
                'alert' => 'error',
                'text'  => 'Tidak ada item yang dipilih'
            ];
            return redirect()->back()->with('setelah_simpan',$setelah_simpan)->withInput($request->all());
        }
        else
        {
            $aturan = [
                'tokos_id'                          => 'required',
                'pembayarans_id'                    => 'required',
            ];

            $error_pesan = [
                'tokos_id.required'                 => 'Form Toko Harus Diisi.',
                'pembayarans_id.required'           => 'Form Pembayaran Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $customers_id = null;
            if(!empty($request->customers_id))
            {
                $cek_customers = \App\Models\Master_customer::where('id_customers',$request->customers_id)
                                                            ->count();
                if($cek_customers != 0)
                {
                    $customers_id = $request->customers_id;
                    $telepon_customers = '';
                    if(!empty($request->telepon_customers))
                        $telepon_customers = $request->telepon_customers;

                    $customers_data = [
                        'telepon_customers' => $telepon_customers,
                    ];
                    \App\Models\Master_customer::where('id_customers',$customers_id)
                                                ->update($customers_data);
                }
                else
                {
                    $telepon_customers = '';
                    if(!empty($request->telepon_customers))
                        $telepon_customers = $request->telepon_customers;

                    $customers_data = [
                        'tokos_id'          => $request->tokos_id,
                        'nama_customers'    => $request->customers_id,
                        'telepon_customers' => $telepon_customers,
                    ];
                    $customers_id = \App\Models\Master_customer::insertGetId($customers_data);
                }
            }

            $pajak_penjualans = 0;
            if(!empty($request->pajak_penjualans))
                $pajak_penjualans = $request->pajak_penjualans;

            $diskon_penjualans = 0;
            if(!empty($request->diskon_penjualans))
                $diskon_penjualans = $request->diskon_penjualans;

            $keterangan_penjualans = '';
            if(!empty($request->keterangan_penjualans))
                $keterangan_penjualans = $request->keterangan_penjualans;

            $penjualans_data = [
                'tokos_id'                          => $request->tokos_id,
                'customers_id'                      => $customers_id,
                'pembayarans_id'                    => $request->pembayarans_id,
                'users_id'                          => Auth::user()->id,
                'no_penjualans'                     => General::noPenjualan(),
                'tanggal_penjualans'                => date('Y-m-d H:i:s'),
                'keterangan_penjualans'             => $keterangan_penjualans,
                'pembayarans_id'                    => $request->pembayarans_id,
                'sub_total_penjualans'              => General::ubahHargaKeDB($request->sub_total_penjualans),
                'pajak_penjualans'                  => $pajak_penjualans,
                'diskon_penjualans'                 => $diskon_penjualans,
                'total_penjualans'                  => General::ubahHargaKeDB($request->total_penjualans),
                'created_at'                        => date('Y-m-d H:i:s'),
            ];
            $id_penjualans = \App\Models\Transaksi_penjualan::insertGetId($penjualans_data);

            if(!empty($request->items_id))
            {
                foreach($request->items_id as $key => $id_items)
                {
                    if($request->jumlah_penjualan_details[$id_items] != 0)
                    {
                        $jumlah_penjualan_details   = $request->jumlah_penjualan_details[$id_items];
                        $harga_penjualan_details    = General::ubahHargaKeDB($request->harga_penjualan_details[$id_items]);
                        $total_penjualan_details    = $jumlah_penjualan_details * $harga_penjualan_details;

                        $penjualans_details_data = [
                            'penjualans_id'                 => $id_penjualans,
                            'items_id'                      => $id_items,
                            'jumlah_penjualan_details'      => $jumlah_penjualan_details,
                            'harga_penjualan_details'       => $harga_penjualan_details,
                            'total_penjualan_details'       => $total_penjualan_details,
                            'created_at'                    => date('Y-m-d H:i:s'),
                        ];
                        \App\Models\Transaksi_penjualan_detail::insert($penjualans_details_data);

                        $ambil_items = \App\Models\Master_item::where('id_items',$id_items)->first();
                        $update_items_data = [
                            'stok_items'    => $ambil_items->stok_items - $jumlah_penjualan_details
                        ];
                        \App\Models\Master_item::where('id_items',$id_items)->update($update_items_data);
                    }
                }
            }

            return redirect('dashboard/kasir/cetak_penjualan/'.$id_penjualans);
        }
    }

    public function cetak_penjualan($id_penjualans=0)
    {
        $cek_penjualans = \App\Models\Transaksi_penjualan::where('id_penjualans',$id_penjualans)->count();
        if($cek_penjualans != 0)
        {
            $data['cetak_konfigurasi_aplikasis']    = \App\Models\Master_konfigurasi_aplikasi::where('id_konfigurasi_aplikasis',1)->first();
            $data['cetak_penjualans']               = \App\Models\Transaksi_penjualan::join('master_tokos','transaksi_penjualans.tokos_id','=','master_tokos.id_tokos')
                                                                            ->join('users','users_id','=','users.id')
                                                                            ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                            ->leftjoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                            ->where('id_penjualans',$id_penjualans)
                                                                            ->first();
            $data['cetak_penjualan_details']        = \App\Models\Transaksi_penjualan_detail::join('master_items','items_id','=','master_items.id_items')
                                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                    ->where('penjualans_id',$id_penjualans)
                                                                                    ->orderBy('nama_kategori_items')
                                                                                    ->orderBy('nama_items')
                                                                                    ->get();
            return view('dashboard.kasir.cetak',$data);
        }
        else
            return redirect('dashboard/kasir');
    }

}