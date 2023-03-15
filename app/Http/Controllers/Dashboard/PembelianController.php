<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class PembelianController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_pembelian = 'pembelian';
        if(General::hakAkses($link_pembelian,'lihat') == 'true')
        {
            $data['link_pembelian']             = $link_pembelian;
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
                $data['lihat_pembelians']           = \App\Models\Transaksi_pembelian::join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                    ->join('users','users_id','=','users.id')
                                                                                    ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                    ->paginate(10);
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $hasil_toko                 = Auth::user()->tokos_id;
                $data['lihat_pembelians']           = \App\Models\Transaksi_pembelian::join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                    ->join('users','users_id','=','users.id')
                                                                                    ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
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
        	return view('dashboard.pembelian.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_pembelian = 'pembelian';
        if(General::hakAkses($link_pembelian,'lihat') == 'true')
        {
            $data['link_pembelian']             = $link_pembelian;
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
                    $data['lihat_pembelians']           = \App\Models\Transaksi_pembelian::join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                        ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                        ->join('users','users_id','=','users.id')
                                                                                        ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                        ->where('no_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('id_tokos',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('referensi_no_nota_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('id_tokos',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('nama_suppliers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('id_tokos',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('id_tokos',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                        ->paginate(10);
                }
                else
                {
                    $data['lihat_pembelians']           = \App\Models\Transaksi_pembelian::join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                        ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                        ->join('users','users_id','=','users.id')
                                                                                        ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                        ->where('no_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('id_tokos',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('referensi_no_nota_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('id_tokos',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('nama_suppliers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('id_tokos',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                        ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('id_tokos',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                        ->paginate(10);
                }
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $data['lihat_pembelians']           = \App\Models\Transaksi_pembelian::join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                    ->join('users','users_id','=','users.id')
                                                                                    ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                    ->where('no_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                    ->orWhere('referensi_no_nota_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                    ->orWhere('nama_suppliers', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                    ->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.tanggal_pembelians) <= "'.$tanggal_selesai.'"')
                                                                                    ->paginate(10);
            }
            $data['hasil_toko']             = $hasil_toko;
            session(['halaman'              => $url_sekarang]);
            session(['hasil_toko'		    => $hasil_toko]);
            session(['tanggal_mulai'	    => $tanggal_mulai]);
            session(['tanggal_selesai'	    => $tanggal_selesai]);
            session(['hasil_tanggal'	    => $hasil_tanggal]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.pembelian.lihat', $data);
        }
        else
            return redirect('dashboard/pembelian');
    }

    public function tambah(Request $request)
    {
        $link_pembelian = 'pembelian';
        if(General::hakAkses($link_pembelian,'tambah') == 'true')
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
            $data['tambah_suppliers']   = \App\Models\Master_supplier::orderBy('nama_suppliers')
                                                                    ->get();
            $data['tambah_pembayarans'] = \App\Models\Master_pembayaran::orderBy('nama_pembayarans')
                                                                        ->get();
            return view('dashboard.pembelian.tambah',$data);
        }
        else
            return redirect('dashboard/pembelian');
    }

    public function listitem($id_tokos=0, $id_pembelians=0, Request $request)
    {
        if($id_tokos != 0)
        {
            $cek_tokos = \App\Models\Master_toko::where('id_tokos',$id_tokos)
                                                ->count();
            if($cek_tokos != 0)
            {
                if($id_pembelians == 0)
                {
                    $data['lihat_items']    = \App\Models\Master_item::where('tokos_id',$id_tokos)
                                                                    ->orderBy('nama_items')
                                                                    ->get();
                    $data['id_pembelians']  = $id_pembelians;
                    return view('dashboard.pembelian.listitem',$data);
                }
                else
                {
                    $cek_pembelians = \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)->count();
                    if($cek_pembelians != 0)
                    {
                        $data['lihat_items']    = \App\Models\Master_item::where('tokos_id',$id_tokos)
                                                                        ->orderBy('nama_items')
                                                                        ->get();
                        $data['id_pembelians']  = $id_pembelians;
                        return view('dashboard.pembelian.listitem',$data);
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
            return view('dashboard.pembelian.listitem',$data);
        }
    }

    public function listsupplier($id_tokos=0)
    {
        $cek_tokos = \App\Models\Master_toko::where('id_tokos',$id_tokos)->count();
        if($cek_tokos != 0)
        {
            $ambil_supplier = \App\Models\Master_supplier::where('tokos_id',$id_tokos)
                                                        ->orderBy('nama_suppliers')
                                                        ->get();
            return json_encode($ambil_supplier);
        }
        else
            return 'anda tidak boleh mengakses halaman ini.';
    }

    public function teleponsupplier($id_suppliers=0)
    {
        $cek_suppliers = \App\Models\Master_supplier::where('id_suppliers',$id_suppliers)->count();
        if($cek_suppliers != 0)
        {
            $ambil_supplier = \App\Models\Master_supplier::where('id_suppliers',$id_suppliers)
                                                        ->first();
            return json_encode($ambil_supplier);
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

    public function prosestambah(Request $request)
    {
        $link_pembelian = 'pembelian';
        if(General::hakAkses($link_pembelian,'tambah') == 'true')
        {
            $aturan = [
                'tokos_id'                          => 'required',
                'tanggal_pembelians'                => 'required',
                'pembayarans_id'                    => 'required',
            ];

            $error_pesan = [
                'tokos_id.required'                 => 'Form Toko Harus Diisi.',
                'tanggal_pembelians.required'       => 'Form Tanggal Harus Diisi.',
                'pembayarans_id.required'           => 'Form Pembayaran Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);
            
            $total_item = 0;
            foreach($request->id_items as $key => $id_items)
            {
                if($request->jumlah_pembelian_details[$key] != 0)
                {
                    $total_item += 1;
                }
            }
            
            if($total_item == 0)
            {
                $setelah_simpan = [
                    'alert' => 'error',
                    'text'  => 'Tidak ada item dengan jumlah lebih dari 0'
                ];
                return redirect()->back()->with('setelah_simpan',$setelah_simpan)->withInput($request->all());
            }

            $suppliers_id = null;
            if(!empty($request->suppliers_id))
            {
                $cek_suppliers = \App\Models\Master_supplier::where('id_suppliers',$request->suppliers_id)
                                                            ->count();
                if($cek_suppliers != 0)
                {
                    $suppliers_id = $request->suppliers_id;
                    $telepon_suppliers = '';
                    if(!empty($request->telepon_suppliers))
                        $telepon_suppliers = $request->telepon_suppliers;

                    $suppliers_data = [
                        'telepon_suppliers' => $telepon_suppliers,
                    ];
                    \App\Models\Master_supplier::where('id_suppliers',$suppliers_id)
                                                ->update($suppliers_data);
                }
                else
                {
                    $telepon_suppliers = '';
                    if(!empty($request->telepon_suppliers))
                        $telepon_suppliers = $request->telepon_suppliers;

                    $suppliers_data = [
                        'tokos_id'          => $request->tokos_id,
                        'nama_suppliers'    => $request->suppliers_id,
                        'telepon_suppliers' => $telepon_suppliers,
                    ];
                    $suppliers_id = \App\Models\Master_supplier::insertGetId($suppliers_data);
                }
            }

            $referensi_no_nota_pembelians = '';
            if(!empty($request->referensi_no_nota_pembelians))
                $referensi_no_nota_pembelians = $request->referensi_no_nota_pembelians;

            $pajak_pembelians = 0;
            if(!empty($request->pajak_pembelians))
                $pajak_pembelians = $request->pajak_pembelians;

            $diskon_pembelians = 0;
            if(!empty($request->diskon_pembelians))
                $diskon_pembelians = $request->diskon_pembelians;

            $keterangan_pembelians = '';
            if(!empty($request->keterangan_pembelians))
                $keterangan_pembelians = $request->keterangan_pembelians;

            $pembelians_data = [
                'tokos_id'                          => $request->tokos_id,
                'suppliers_id'                      => $suppliers_id,
                'pembayarans_id'                    => $request->pembayarans_id,
                'users_id'                          => Auth::user()->id,
                'no_pembelians'                     => General::noPembelian(),
                'referensi_no_nota_pembelians'      => $referensi_no_nota_pembelians,
                'tanggal_pembelians'                => General::ubahTanggalKeDB($request->tanggal_pembelians),
                'keterangan_pembelians'             => $keterangan_pembelians,
                'pembayarans_id'                    => $request->pembayarans_id,
                'sub_total_pembelians'              => 0,
                'pajak_pembelians'                  => $pajak_pembelians,
                'diskon_pembelians'                 => $diskon_pembelians,
                'total_pembelians'                  => 0,
                'created_at'                        => date('Y-m-d H:i:s'),
            ];
            $id_pembelians = \App\Models\Transaksi_pembelian::insertGetId($pembelians_data);

            if(!empty($request->id_items))
            {
                foreach($request->id_items as $key => $id_items)
                {
                    if($request->jumlah_pembelian_details[$key] != 0)
                    {
                        $jumlah_pembelian_details   = $request->jumlah_pembelian_details[$key];
                        $harga_pembelian_details    = General::ubahHargaKeDB($request->harga_pembelian_details[$key]);
                        $total_pembelian_details    = $jumlah_pembelian_details * $harga_pembelian_details;

                        $pembelians_details_data = [
                            'pembelians_id'                 => $id_pembelians,
                            'items_id'                      => $id_items,
                            'jumlah_pembelian_details'      => $jumlah_pembelian_details,
                            'harga_pembelian_details'       => $harga_pembelian_details,
                            'total_pembelian_details'       => $total_pembelian_details,
                            'created_at'                    => date('Y-m-d H:i:s'),
                        ];
                        \App\Models\Transaksi_pembelian_detail::insert($pembelians_details_data);

                        $ambil_items = \App\Models\Master_item::where('id_items',$id_items)->first();
                        $update_items_data = [
                            'stok_items'    => $ambil_items->stok_items + $jumlah_pembelian_details
                        ];
                        \App\Models\Master_item::where('id_items',$id_items)->update($update_items_data);
                    }
                }
            }

            $ambil_total_pembelian_details = \App\Models\Transaksi_pembelian_detail::selectRaw("SUM(total_pembelian_details) AS total_detail_pembelians")
                                                                                    ->where('pembelians_id',$id_pembelians)
                                                                                    ->first();
            $sub_total = 0;
            if(!empty($ambil_total_pembelian_details))
                $sub_total = $ambil_total_pembelian_details->total_detail_pembelians;
            
            $hitung_total = $sub_total + ($sub_total * $pajak_pembelians/100) - ($sub_total * $diskon_pembelians/100);
            $pembelians_update_data = [
                'sub_total_pembelians'  => $sub_total,
                'total_pembelians'      => $hitung_total,
            ];
            \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)
                                            ->update($pembelians_update_data);

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
                    $redirect_halaman  = 'dashboard/pembelian';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/pembelian');
    }

    public function baca($id_pembelians=0)
    {
        $link_pembelian = 'pembelian';
        if(General::hakAkses($link_pembelian,'edit') == 'true')
        {
            $cek_pembelians = \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)->count();
            if($cek_pembelians != 0)
            {
                $data['baca_pembelians']        = \App\Models\Transaksi_pembelian::join('master_tokos','transaksi_pembelians.tokos_id','=','master_tokos.id_tokos')
                                                                            ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                            ->join('users','users_id','=','users.id')
                                                                            ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                            ->where('id_pembelians',$id_pembelians)
                                                                            ->first();
                $data['baca_pembelian_details'] = \App\Models\Transaksi_pembelian_detail::join('master_items','items_id','=','master_items.id_items')
                                                                                        ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                                        ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                                        ->where('pembelians_id',$id_pembelians)
                                                                                        ->get();
                return view('dashboard.pembelian.baca',$data);
            }
            else
                return redirect('dashboard/pembelian');
        }
        else
            return redirect('dashboard/pembelian');
    }

    public function edit($id_pembelians=0)
    {
        $link_pembelian = 'pembelian';
        if(General::hakAkses($link_pembelian,'edit') == 'true')
        {
            $cek_pembelians = \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)->first();
            if(!empty($cek_pembelians))
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
                $data['edit_suppliers']   = \App\Models\Master_supplier::where('tokos_id',$cek_pembelians->tokos_id)
                                                                        ->orderBy('nama_suppliers')
                                                                        ->get();
                $data['edit_pembayarans'] = \App\Models\Master_pembayaran::where('tokos_id',$cek_pembelians->tokos_id)
                                                                            ->orderBy('nama_pembayarans')
                                                                            ->get();
                $data['edit_pembelians']           = $cek_pembelians;
                return view('dashboard.pembelian.edit',$data);
            }
            else
                return redirect('dashboard/pembelian');
        }
        else
            return redirect('dashboard/pembelian');
    }

    public function prosesedit($id_pembelians=0, Request $request)
    {
        $link_pembelian = 'pembelian';
        if(General::hakAkses($link_pembelian,'edit') == 'true')
        {
            $cek_pembelians = \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)->first();
            if(!empty($cek_pembelians))
            {
                $aturan = [
                    'tokos_id'                          => 'required',
                    'tanggal_pembelians'                => 'required',
                    'pembayarans_id'                    => 'required',
                ];
    
                $error_pesan = [
                    'tokos_id.required'                 => 'Form Toko Harus Diisi.',
                    'tanggal_pembelians.required'       => 'Form Tanggal Harus Diisi.',
                    'pembayarans_id.required'           => 'Form Pembayaran Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);
            
                $total_item = 0;
                foreach($request->id_items as $key => $id_items)
                {
                    if($request->jumlah_pembelian_details[$key] != 0)
                    {
                        $total_item += 1;
                    }
                }
                
                if($total_item == 0)
                {
                    $setelah_simpan = [
                        'alert' => 'error',
                        'text'  => 'Tidak ada item dengan jumlah lebih dari 0'
                    ];
                    return redirect()->back()->with('setelah_simpan',$setelah_simpan)->withInput($request->all());
                }
    
                $suppliers_id = null;
                if(!empty($request->suppliers_id))
                {
                    $cek_suppliers = \App\Models\Master_supplier::where('id_suppliers',$request->suppliers_id)
                                                                ->count();
                    if($cek_suppliers != 0)
                    {
                        $suppliers_id = $request->suppliers_id;
                        $telepon_suppliers = '';
                        if(!empty($request->telepon_suppliers))
                            $telepon_suppliers = $request->telepon_suppliers;

                        $suppliers_data = [
                            'telepon_suppliers' => $telepon_suppliers,
                        ];
                        \App\Models\Master_supplier::where('id_suppliers',$suppliers_id)
                                                    ->update($suppliers_data);
                    }
                    else
                    {
                        $telepon_suppliers = '';
                        if(!empty($request->telepon_suppliers))
                            $telepon_suppliers = $request->telepon_suppliers;

                        $suppliers_data = [
                            'tokos_id'          => $request->tokos_id,
                            'nama_suppliers'    => $request->suppliers_id,
                            'telepon_suppliers' => $telepon_suppliers,
                        ];
                        $suppliers_id = \App\Models\Master_supplier::insertGetId($suppliers_data);
                    }
                }
    
                $referensi_no_nota_pembelians = '';
                if(!empty($request->referensi_no_nota_pembelians))
                    $referensi_no_nota_pembelians = $request->referensi_no_nota_pembelians;
    
                $pajak_pembelians = 0;
                if(!empty($request->pajak_pembelians))
                    $pajak_pembelians = $request->pajak_pembelians;
    
                $diskon_pembelians = 0;
                if(!empty($request->diskon_pembelians))
                    $diskon_pembelians = $request->diskon_pembelians;
    
                $keterangan_pembelians = '';
                if(!empty($request->keterangan_pembelians))
                    $keterangan_pembelians = $request->keterangan_pembelians;
    
                $pembelians_data = [
                    'tokos_id'                          => $request->tokos_id,
                    'suppliers_id'                      => $suppliers_id,
                    'pembayarans_id'                    => $request->pembayarans_id,
                    'users_id'                          => Auth::user()->id,
                    'referensi_no_nota_pembelians'      => $referensi_no_nota_pembelians,
                    'tanggal_pembelians'                => General::ubahTanggalKeDB($request->tanggal_pembelians),
                    'keterangan_pembelians'             => $keterangan_pembelians,
                    'pembayarans_id'                    => $request->pembayarans_id,
                    'pajak_pembelians'                  => $pajak_pembelians,
                    'diskon_pembelians'                 => $diskon_pembelians,
                    'updated_at'                        => date('Y-m-d H:i:s'),
                ];
                \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)
                                                ->update($pembelians_data);

                $ambil_pemesanan_details = \App\Models\Transaksi_pembelian_detail::where('pembelians_id',$id_pembelians)->get();
                foreach($ambil_pemesanan_details as $pemesanan_details)
                {
                    $ambil_items = \App\Models\Master_item::where('id_items',$pemesanan_details->items_id)->first();
                    $update_items_data = [
                        'stok_items'    => $ambil_items->stok_items - $pemesanan_details->jumlah_pembelian_details
                    ];
                    \App\Models\Master_item::where('id_items',$ambil_items->id_items)->update($update_items_data);
                    \App\Models\Transaksi_pembelian_detail::where('pembelians_id',$id_pembelians)
                                                            ->where('items_id',$ambil_items->id_items)
                                                            ->delete();
                }

                if(!empty($request->id_items))
                {
                    foreach($request->id_items as $key => $id_items)
                    {
                        if($request->jumlah_pembelian_details[$key] != 0)
                        {
                            $jumlah_pembelian_details   = $request->jumlah_pembelian_details[$key];
                            $harga_pembelian_details    = General::ubahHargaKeDB($request->harga_pembelian_details[$key]);
                            $total_pembelian_details    = $jumlah_pembelian_details * $harga_pembelian_details;

                            $pembelians_details_data = [
                                'pembelians_id'                 => $id_pembelians,
                                'items_id'                      => $id_items,
                                'jumlah_pembelian_details'      => $jumlah_pembelian_details,
                                'harga_pembelian_details'       => $harga_pembelian_details,
                                'total_pembelian_details'       => $total_pembelian_details,
                                'created_at'                    => date('Y-m-d H:i:s'),
                            ];
                            \App\Models\Transaksi_pembelian_detail::insert($pembelians_details_data);

                            $ambil_items = \App\Models\Master_item::where('id_items',$id_items)->first();
                            $update_items_data = [
                                'stok_items'    => $ambil_items->stok_items + $jumlah_pembelian_details
                            ];
                            \App\Models\Master_item::where('id_items',$id_items)->update($update_items_data);
                        }
                    }
                }

                $ambil_total_pembelian_details = \App\Models\Transaksi_pembelian_detail::selectRaw("SUM(total_pembelian_details) AS total_detail_pembelians")
                                                                                        ->where('pembelians_id',$id_pembelians)
                                                                                        ->first();
                $sub_total = 0;
                if(!empty($ambil_total_pembelian_details))
                    $sub_total = $ambil_total_pembelian_details->total_detail_pembelians;
                
                $hitung_total = $sub_total + ($sub_total * $pajak_pembelians/100) - ($sub_total * $diskon_pembelians/100);
                $pembelians_update_data = [
                    'sub_total_pembelians'  => $sub_total,
                    'total_pembelians'      => $hitung_total,
                ];
                \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)
                                                ->update($pembelians_update_data);

                if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/pembelian';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/pembelian');
        }
        else
            return redirect('dashboard/pembelian');
    }

    public function hapus($id_pembelians=0)
    {
        $link_pembelian = 'pembelian';
        if(General::hakAkses($link_pembelian,'hapus') == 'true')
        {
            $cek_pembelians = \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)->first();
            if(!empty($cek_pembelians))
            {
                \App\Models\Transaksi_pembelian_detail::where('pembelians_id',$id_pembelians)
                                                        ->delete();
                \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)
                                        ->delete();
                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/pembelian');
        }
        else
            return redirect('dashboard/pembelian');
    }

}