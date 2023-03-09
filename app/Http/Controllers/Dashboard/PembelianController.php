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
                $data['lihat_pembelians']           = \App\Models\Transaksi_pembelian::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                    ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.created_at) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.created_at) <= "'.$tanggal_selesai.'"')
                                                                                    ->paginate(10);
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $hasil_toko                 = Auth::user()->tokos_id;
                $data['lihat_pembelians']           = \App\Models\Transaksi_pembelian::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                    ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                    ->where('tokos_id',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_pembelians.created_at) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.created_at) <= "'.$tanggal_selesai.'"')
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
                    $data['lihat_pembelians']           = \App\Models\Transaksi_pembelian::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                        ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                        ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                        ->where('no_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('tokos_id',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_pembelians.created_at) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.created_at) <= "'.$tanggal_selesai.'"')
                                                                                        ->orwhere('referensi_no_nota_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->where('tokos_id',$hasil_toko)
                                                                                        ->whereRaw('DATE(transaksi_pembelians.created_at) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.created_at) <= "'.$tanggal_selesai.'"')
                                                                                        ->paginate(10);
                }
                else
                {
                    $data['lihat_pembelians']           = \App\Models\Transaksi_pembelian::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                        ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                        ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                        ->where('no_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.created_at) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.created_at) <= "'.$tanggal_selesai.'"')
                                                                                        ->orwhere('referensi_no_nota_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.created_at) >= "'.$tanggal_mulai.'"')
                                                                                        ->whereRaw('DATE(transaksi_pembelians.created_at) <= "'.$tanggal_selesai.'"')
                                                                                        ->paginate(10);
                }
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $data['lihat_pembelians']           = \App\Models\Transaksi_pembelian::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                                    ->join('master_pembayarans','pembayarans_id','=','master_pembayarans.id_pembayarans')
                                                                                    ->leftJoin('master_suppliers','suppliers_id','=','master_suppliers.id_suppliers')
                                                                                    ->where('no_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('tokos_id',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_pembelians.created_at) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.created_at) <= "'.$tanggal_selesai.'"')
                                                                                    ->orwhere('referensi_no_nota_pembelians', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('tokos_id',$hasil_toko)
                                                                                    ->whereRaw('DATE(transaksi_pembelians.created_at) >= "'.$tanggal_mulai.'"')
                                                                                    ->whereRaw('DATE(transaksi_pembelians.created_at) <= "'.$tanggal_selesai.'"')
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

    public function listitem($id_tokos=0, Request $request)
    {
        if($id_tokos != 0)
        {
            $cek_tokos = \App\Models\Master_toko::where('id_tokos',$id_tokos)
                                                ->count();
            if($cek_tokos != 0)
            {
                $data['lihat_items']    = \App\Models\Master_item::where('tokos_id',$id_tokos)
                                                                ->orderBy('nama_items')
                                                                ->get();
                return view('dashboard.pembelian.listitem',$data);
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

    public function prosestambah(Request $request)
    {
        $link_pembelian = 'pembelian';
        if(General::hakAkses($link_pembelian,'tambah') == 'true')
        {
            $aturan = [
                'nama_pembelians'                              => 'required',
            ];

            $error_pesan = [
                'nama_pembelians.required'                     => 'Form Nama Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $pembelians_data = [
                'nama_pembelians'                              => $request->nama_pembelians,
                'created_at'                                => date('Y-m-d H:i:s'),
            ];
            $id_pembelians = \App\Models\Transaksi_pembelian::insertGetId($pembelians_data);

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

    public function edit($id_pembelians=0)
    {
        $link_pembelian = 'pembelian';
        if(General::hakAkses($link_pembelian,'edit') == 'true')
        {
            $cek_pembelians = \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)->first();
            if(!empty($cek_pembelians))
            {
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
                    'nama_pembelians'                          => 'required',
                ];
        
                $error_pesan = [
                    'nama_pembelians.required'                 => 'Form Nama Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);
        
                $pembelians_data = [
                    'nama_pembelians'                          => $request->nama_pembelians,
                    'updated_at'                            => date('Y-m-d H:i:s'),
                ];
                \App\Models\Transaksi_pembelian::where('id_pembelians',$id_pembelians)
                                                ->update($pembelians_data);

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