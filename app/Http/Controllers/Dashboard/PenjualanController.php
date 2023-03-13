<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class PenjualanController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_penjualan = 'penjualan';
        if(General::hakAkses($link_penjualan,'lihat') == 'true')
        {
            $data['link_penjualan']             = $link_penjualan;
            $url_sekarang                       = $request->fullUrl();
            $data['hasil_kata']                 = '';
            $tanggal_mulai                      = date('Y-m-01');
            $tanggal_selesai                    = date('Y-m-j', strtotime("last day of this month"));
            $hasil_tanggal                      = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']              = $tanggal_mulai;
            $data['tanggal_selesai']            = $tanggal_selesai;
            $data['hasil_tanggal']              = $hasil_tanggal;
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                $hasil_toko                 = '';
                $data['lihat_penjualans']           = \App\Models\Transaksi_penjualan::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                    ->join('users','users_id','=','users.id')
                                                                                    ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                    ->paginate(10);
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $hasil_toko                 = Auth::user()->tokos_id;
                $data['lihat_penjualans']           = \App\Models\Transaksi_penjualan::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                    ->join('users','users_id','=','users.id')
                                                                                    ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                                    ->where('tokos_id',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                    ->paginate(10);
            }
            $data['hasil_toko']             = $hasil_toko;
        	
            session()->forget('halaman');
            session()->forget('hasil_toko');
            session()->forget('hasil_kata');
            session()->forget('tanggal_mulai');
            session()->forget('tanggal_selesai');
            session()->forget('hasil_tanggal');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.penjualan.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_penjualan = 'penjualan';
        if(General::hakAkses($link_penjualan,'lihat') == 'true')
        {
            $data['link_penjualan']             = $link_penjualan;
            $url_sekarang                       = $request->fullUrl();
            $hasil_kata                         = $request->cari_kata;
            $data['hasil_kata']                 = $hasil_kata;
            $tanggal_mulai                      = date('Y-m-01');
            $tanggal_selesai                    = date('Y-m-j', strtotime("last day of this month"));
            $hasil_tanggal                      = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']              = $tanggal_mulai;
            $data['tanggal_selesai']            = $tanggal_selesai;
            $data['hasil_tanggal']              = $hasil_tanggal;
            $hasil_toko                 = $request->cari_toko;
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                if($hasil_toko != '')
                {
                    $data['lihat_penjualans']           = \App\Models\Transaksi_penjualan::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                        ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                        ->join('users','users_id','=','users.id')
                                                                                        ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                                        ->where('no_penjualans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('tokos_id',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('referensi_no_nota_penjualans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('tokos_id',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('nama_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('tokos_id',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('tokos_id',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                        ->paginate(10);
                }
                else
                {
                    $data['lihat_penjualans']           = \App\Models\Transaksi_penjualan::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                        ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                        ->join('users','users_id','=','users.id')
                                                                                        ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                                        ->where('no_penjualans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('referensi_no_nota_penjualans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('nama_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('tokos_id',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('tokos_id',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                        ->paginate(10);
                }
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $data['lihat_penjualans']           = \App\Models\Transaksi_penjualan::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                    ->join('users','users_id','=','users.id')
                                                                                    ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                                    ->where('no_penjualans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('tokos_id',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                    ->orWhere('referensi_no_nota_penjualans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('tokos_id',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                    ->orWhere('nama_customers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('tokos_id',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                    ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('tokos_id',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_penjualans.tanggal_penjualans) <= "'.$tanggal_selesai.'"')
                                                                                    ->paginate(10);
            }
            $data['hasil_toko']             = $hasil_toko;
            session()->forget('halaman');
            session()->forget('hasil_toko');
            session()->forget('hasil_kata');
            session()->forget('tanggal_mulai');
            session()->forget('tanggal_selesai');
            session()->forget('hasil_tanggal');
            session(['halaman'              => $url_sekarang]);
            return view('dashboard.penjualan.lihat', $data);
        }
        else
            return redirect('dashboard/penjualan');
    }

    public function tambah(Request $request)
    {
        $link_penjualan = 'penjualan';
        if(General::hakAkses($link_penjualan,'tambah') == 'true')
        {
            if(Auth::user()->tokos_id == null)
            {
                $data['tambah_tokos']   = \App\Models\Master_toko::orderBy('nama_tokos','asc')
                                                                ->get();
            }
            else
            {
                $data['tambah_tokos']   = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                    ->orderBy('nama_tokos','asc')
                                                                    ->get();
            }
            $data['tambah_customers']   = \App\Models\Master_customer::orderBy('nama_customers')
                                                                    ->get();
            $data['tambah_pembayarans'] = \App\Models\Master_pembayaran::orderBy('nama_pembayarans')
                                                                        ->get();
            return view('dashboard.penjualan.tambah',$data);
        }
        else
            return redirect('dashboard/penjualan');
    }

    public function listitem($id_tokos=0, $id_penjualans=0, Request $request)
    {
        if($id_tokos != 0)
        {
            $cek_tokos = \App\Models\Master_toko::where('id_tokos',$id_tokos)
                                                ->count();
            if($cek_tokos != 0)
            {
                if($id_penjualans == 0)
                {
                    $data['lihat_items']    = \App\Models\Master_item::where('tokos_id',$id_tokos)
                                                                    ->orderBy('nama_items')
                                                                    ->get();
                    return view('dashboard.penjualan.listitem',$data);
                }
                else
                {
                    $cek_penjualans = \App\Models\Transaksi_penjualan::where('id_penjualans',$id_penjualans)->count();
                    if($cek_penjualans != 0)
                    {
                        $data['lihat_items']    = \App\Models\Master_item::where('tokos_id',$id_tokos)
                                                                        ->orderBy('nama_items')
                                                                        ->get();
                        $data['id_penjualans']  = $id_penjualans;
                        return view('dashboard.penjualan.listitem',$data);
                    }
                    else
                        return 'anda tidak boleh mengakses halaman ini.';
                }
            }
            else
                return 'anda tidak boleh mengakses halaman ini.';
        }
        else
        {
            $data['lihat_items']    = \App\Models\Master_item::where('tokos_id',$id_tokos)
                                                            ->orderBy('nama_items')
                                                            ->get();
            return view('dashboard.penjualan.listitem',$data);
        }
    }

    public function prosestambah(Request $request)
    {
        $link_penjualan = 'penjualan';
        if(General::hakAkses($link_penjualan,'tambah') == 'true')
        {
            $aturan = [
                'tokos_id'                          => 'required',
                'tanggal_penjualans'                => 'required',
                'pembayarans_id'                    => 'required',
            ];

            $error_pesan = [
                'tokos_id.required'                 => 'Form Toko Harus Diisi.',
                'tanggal_penjualans.required'       => 'Form Tanggal Harus Diisi.',
                'pembayarans_id.required'           => 'Form Pembayaran Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $customers_id = null;
            if(!empty($request->customers_id))
            {
                $cek_customers = \App\Models\Master_customer::where('id_customers',$request->customers_id)
                                                            ->count();
                if($cek_customers != 0)
                    $customers_id = $request->customers_id;
                else
                {
                    $customers_data = [
                        'tokos_id'          => $request->tokos_id,
                        'nama_customers'    => $request->customers_id,
                    ];
                    $customers_id = \App\Models\Master_customer::insertGetId($customers_data);
                }
            }

            $referensi_no_nota_penjualans = '';
            if(!empty($request->referensi_no_nota_penjualans))
                $referensi_no_nota_penjualans = $request->referensi_no_nota_penjualans;

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
                'referensi_no_nota_penjualans'      => $referensi_no_nota_penjualans,
                'tanggal_penjualans'                => General::ubahTanggalKeDB($request->tanggal_penjualans),
                'keterangan_penjualans'             => $keterangan_penjualans,
                'pembayarans_id'                    => $request->pembayarans_id,
                'sub_total_penjualans'              => 0,
                'pajak_penjualans'                  => $pajak_penjualans,
                'diskon_penjualans'                 => $diskon_penjualans,
                'total_penjualans'                  => 0,
                'created_at'                        => date('Y-m-d H:i:s'),
            ];
            $id_penjualans = \App\Models\Transaksi_penjualan::insertGetId($penjualans_data);

            if(!empty($request->id_items))
            {
                foreach($request->id_items as $key => $id_items)
                {
                    if($request->jumlah_penjualan_details[$key] != 0)
                    {
                        $jumlah_penjualan_details   = $request->jumlah_penjualan_details[$key];
                        $harga_penjualan_details    = General::ubahHargaKeDB($request->harga_penjualan_details[$key]);
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

            $ambil_total_penjualan_details = \App\Models\Transaksi_penjualan_detail::selectRaw("SUM(total_penjualan_details) AS total_detail_penjualans")
                                                                                    ->where('penjualans_id',$id_penjualans)
                                                                                    ->first();
            $sub_total = 0;
            if(!empty($ambil_total_penjualan_details))
                $sub_total = $ambil_total_penjualan_details->total_detail_penjualans;
            
            $hitung_total = $sub_total + ($sub_total * $pajak_penjualans/100) - ($sub_total * $diskon_penjualans/100);
            $penjualans_update_data = [
                'sub_total_penjualans'  => $sub_total,
                'total_penjualans'      => $hitung_total,
            ];
            \App\Models\Transaksi_penjualan::where('id_penjualans',$id_penjualans)
                                            ->update($penjualans_update_data);

            $simpan           = $request->simpan;
            $simpan_kembali   = $request->simpan_kembali;
            if($simpan)
            {
                $setelah_simpan = [
                    'alert'  => 'sukses',
                    'text'   => 'Data berhasil ditambahkan',
                ];
                return redirect()->back()->with('setelah_simpan', $setelah_simpan)->withInput($request->all());
            }
            if($simpan_kembali)
            {
                if(request()->session()->get('halaman') != '')
                    $redirect_halaman  = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/penjualan';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/penjualan');
    }

    public function baca($id_penjualans=0)
    {
        $link_penjualan = 'penjualan';
        if(General::hakAkses($link_penjualan,'edit') == 'true')
        {
            $cek_penjualans = \App\Models\Transaksi_penjualan::where('id_penjualans',$id_penjualans)->count();
            if($cek_penjualans != 0)
            {
                $data['baca_penjualans']        = \App\Models\Transaksi_penjualan::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                            ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                            ->join('users','users_id','=','users.id')
                                                                            ->leftJoin('master_customers','customers_id','=','master_customers.id_customers')
                                                                            ->where('id_penjualans',$id_penjualans)
                                                                            ->first();
                $data['baca_penjualan_details'] = \App\Models\Transaksi_penjualan_detail::join('master_items','items_id','=','master_items.id_items')
                                                                                        ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                        ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                        ->where('penjualans_id',$id_penjualans)
                                                                                        ->get();
                return view('dashboard.penjualan.baca',$data);
            }
            else
                return redirect('dashboard/penjualan');
        }
        else
            return redirect('dashboard/penjualan');
    }

    public function edit($id_penjualans=0)
    {
        $link_penjualan = 'penjualan';
        if(General::hakAkses($link_penjualan,'edit') == 'true')
        {
            $cek_penjualans = \App\Models\Transaksi_penjualan::where('id_penjualans',$id_penjualans)->first();
            if(!empty($cek_penjualans))
            {
                if(Auth::user()->tokos_id == null)
                {
                    $data['edit_tokos']   = \App\Models\Master_toko::orderBy('nama_tokos','asc')
                                                                    ->get();
                }
                else
                {
                    $data['edit_tokos']   = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos','asc')
                                                                        ->get();
                }
                $data['edit_customers']   = \App\Models\Master_customer::orderBy('nama_customers')
                                                                        ->get();
                $data['edit_pembayarans'] = \App\Models\Master_pembayaran::orderBy('nama_pembayarans')
                                                                            ->get();
                $data['edit_penjualans']           = $cek_penjualans;
                return view('dashboard.penjualan.edit',$data);
            }
            else
                return redirect('dashboard/penjualan');
        }
        else
            return redirect('dashboard/penjualan');
    }

    public function prosesedit($id_penjualans=0, Request $request)
    {
        $link_penjualan = 'penjualan';
        if(General::hakAkses($link_penjualan,'edit') == 'true')
        {
            $cek_penjualans = \App\Models\Transaksi_penjualan::where('id_penjualans',$id_penjualans)->first();
            if(!empty($cek_penjualans))
            {
                $aturan = [
                    'tokos_id'                          => 'required',
                    'tanggal_penjualans'                => 'required',
                    'pembayarans_id'                    => 'required',
                ];
    
                $error_pesan = [
                    'tokos_id.required'                 => 'Form Toko Harus Diisi.',
                    'tanggal_penjualans.required'       => 'Form Tanggal Harus Diisi.',
                    'pembayarans_id.required'           => 'Form Pembayaran Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);
    
                $customers_id = null;
                if(!empty($request->customers_id))
                {
                    $cek_customers = \App\Models\Master_customer::where('id_customers',$request->customers_id)
                                                                ->count();
                    if($cek_customers != 0)
                        $customers_id = $request->customers_id;
                    else
                    {
                        $customers_data = [
                            'tokos_id'          => $request->tokos_id,
                            'nama_customers'    => $request->customers_id,
                        ];
                        $customers_id = \App\Models\Master_customer::insertGetId($customers_data);
                    }
                }
    
                $referensi_no_nota_penjualans = '';
                if(!empty($request->referensi_no_nota_penjualans))
                    $referensi_no_nota_penjualans = $request->referensi_no_nota_penjualans;
    
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
                    'referensi_no_nota_penjualans'      => $referensi_no_nota_penjualans,
                    'tanggal_penjualans'                => General::ubahTanggalKeDB($request->tanggal_penjualans),
                    'keterangan_penjualans'             => $keterangan_penjualans,
                    'pembayarans_id'                    => $request->pembayarans_id,
                    'pajak_penjualans'                  => $pajak_penjualans,
                    'diskon_penjualans'                 => $diskon_penjualans,
                    'updated_at'                        => date('Y-m-d H:i:s'),
                ];
                \App\Models\Transaksi_penjualan::where('id_penjualans',$id_penjualans)
                                                ->update($penjualans_data);

                $ambil_pemesanan_details = \App\Models\Transaksi_penjualan_detail::where('penjualans_id',$id_penjualans)->get();
                foreach($ambil_pemesanan_details as $pemesanan_details)
                {
                    $ambil_items = \App\Models\Master_item::where('id_items',$pemesanan_details->items_id)->first();
                    $update_items_data = [
                        'stok_items'    => $ambil_items->stok_items + $pemesanan_details->jumlah_penjualan_details
                    ];
                    \App\Models\Master_item::where('id_items',$ambil_items->id_items)->update($update_items_data);
                    \App\Models\Transaksi_penjualan_detail::where('penjualans_id',$id_penjualans)
                                                            ->where('items_id',$ambil_items->id_items)
                                                            ->delete();
                }
                
                if(!empty($request->id_items))
                {
                    foreach($request->id_items as $key => $id_items)
                    {
                        if($request->jumlah_penjualan_details[$key] != 0)
                        {
                            $jumlah_penjualan_details   = $request->jumlah_penjualan_details[$key];
                            $harga_penjualan_details    = General::ubahHargaKeDB($request->harga_penjualan_details[$key]);
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

                $ambil_total_penjualan_details = \App\Models\Transaksi_penjualan_detail::selectRaw("SUM(total_penjualan_details) AS total_detail_penjualans")
                                                                                        ->where('penjualans_id',$id_penjualans)
                                                                                        ->first();
                $sub_total = 0;
                if(!empty($ambil_total_penjualan_details))
                    $sub_total = $ambil_total_penjualan_details->total_detail_penjualans;
                
                $hitung_total = $sub_total + ($sub_total * $pajak_penjualans/100) - ($sub_total * $diskon_penjualans/100);
                $penjualans_update_data = [
                    'sub_total_penjualans'  => $sub_total,
                    'total_penjualans'      => $hitung_total,
                ];
                \App\Models\Transaksi_penjualan::where('id_penjualans',$id_penjualans)
                                                ->update($penjualans_update_data);

                if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/penjualan';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/penjualan');
        }
        else
            return redirect('dashboard/penjualan');
    }

    public function hapus($id_penjualans=0)
    {
        $link_penjualan = 'penjualan';
        if(General::hakAkses($link_penjualan,'hapus') == 'true')
        {
            $cek_penjualans = \App\Models\Transaksi_penjualan::where('id_penjualans',$id_penjualans)->first();
            if(!empty($cek_penjualans))
            {
                \App\Models\Transaksi_penjualan_detail::where('penjualans_id',$id_penjualans)
                                                        ->delete();
                \App\Models\Transaksi_penjualan::where('id_penjualans',$id_penjualans)
                                        ->delete();
                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/penjualan');
        }
        else
            return redirect('dashboard/penjualan');
    }

}