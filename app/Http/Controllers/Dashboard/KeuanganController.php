<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class KeuanganController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_keuangan = 'keuangan';
        if(General::hakAkses($link_keuangan,'lihat') == 'true')
        {
            $data['link_keuangan']                      = $link_keuangan;
            $url_sekarang                               = $request->fullUrl();
            $data['hasil_kata']                         = '';
            $tanggal_mulai                              = date('Y-m-01');
            $tanggal_selesai                            = date('Y-m-j', strtotime("last day of this month"));
            $hasil_tanggal                              = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']                      = $tanggal_mulai;
            $data['tanggal_selesai']                    = $tanggal_selesai;
            $data['hasil_tanggal']                      = $hasil_tanggal;
            $hasil_toko                                 = $request->cari_toko;
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                $hasil_toko                 = '';
                $data['lihat_keuangans']            = \App\Models\Transaksi_keuangan::join('master_tokos','tokos_id','master_tokos.id_tokos')
                                                                                    ->join('users','users_id','=','users.id')
                                                                                    ->paginate(10);
            }
            else
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->orderBy('nama_tokos')
                                                                        ->get();
                $hasil_toko                 = Auth::user()->tokos_id;
                $data['lihat_keuangans']            = \App\Models\Transaksi_keuangan::join('master_tokos','tokos_id','master_tokos.id_tokos')
                                                                                    ->join('users','users_id','=','users.id')
                                                                                    ->where('tokos_id',$hasil_toko)
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
        	return view('dashboard.keuangan.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_keuangan = 'keuangan';
        if(General::hakAkses($link_keuangan,'lihat') == 'true')
        {
            $data['link_keuangan']          = $link_keuangan;
            $url_sekarang                   = $request->fullUrl();
            $hasil_kata                     = $request->cari_kata;
            $data['hasil_kata']             = $hasil_kata;
            $tanggal_mulai                  = date('Y-m-01');
            $tanggal_selesai                = date('Y-m-j', strtotime("last day of this month"));
            $hasil_tanggal                  = General::ubahDBKeTanggal($tanggal_mulai).' sampai '.General::ubahDBKeTanggal($tanggal_selesai);
            $data['tanggal_mulai']          = $tanggal_mulai;
            $data['tanggal_selesai']        = $tanggal_selesai;
            $data['hasil_tanggal']          = $hasil_tanggal;
            $hasil_toko                     = $request->cari_toko;
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_tokos']        = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                if($hasil_toko != '')
                {
                    $data['lihat_keuangans']        = \App\Models\Transaksi_keuangan::join('master_tokos','tokos_id','master_tokos.id_tokos')
                                                                                    ->join('users','users_id','=','users.id')
                                                                                    ->where('nama_keuangans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->orwhere('no_keuangans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->where('id_tokos',$hasil_toko)
                                                                                    ->paginate(10);
                }
                else
                {
                    $data['lihat_keuangans']        = \App\Models\Transaksi_keuangan::join('master_tokos','tokos_id','master_tokos.id_tokos')
                                                                                    ->join('users','users_id','=','users.id')
                                                                                    ->where('nama_keuangans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->orwhere('no_keuangans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                    ->paginate(10);
                }
            }
            else
            {
                $data['lihat_keuangans']        = \App\Models\Transaksi_keuangan::join('master_tokos','tokos_id','master_tokos.id_tokos')
                                                                                ->join('users','users_id','=','users.id')
                                                                                ->where('nama_keuangans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                ->where('id_tokos',$hasil_toko)
                                                                                ->orwhere('no_keuangans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                ->where('id_tokos',$hasil_toko)
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
            return view('dashboard.keuangan.lihat', $data);
        }
        else
            return redirect('dashboard/keuangan');
    }

    public function tambah(Request $request)
    {
        $link_keuangan = 'keuangan';
        if(General::hakAkses($link_keuangan,'tambah') == 'true')
        {
            return view('dashboard.keuangan.tambah');
        }
        else
            return redirect('dashboard/keuangan');
    }

    public function prosestambah(Request $request)
    {
        $link_keuangan = 'keuangan';
        if(General::hakAkses($link_keuangan,'tambah') == 'true')
        {
            $aturan = [
                'tokos_id'                                    => 'required',
                'nama_keuangans'                              => 'required',
                'jumlah_keuangans'                            => 'required',
                'jenis_transaksi_keuangans'                   => 'required',
                'created_at'                                  => 'required',
            ];

            $error_pesan = [
                'tokos_id.required'                           => 'Form Toko Harus Dipilih.',
                'nama_keuangans.required'                     => 'Form Nama Harus Diisi.',
                'jumlah_keuangans.required'                   => 'Form Jumlah Harus Diisi.',
                'jenis_transaksi_keuangans.required'          => 'Form Jenis Transaksi Harus Dipilih.',
                'created_at.required'                         => 'Form Tanggal Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $keuangans_data = [
                'tokos_id'                                      => $request->tokos_id,
                'no_keuangans'                                  => General::noKeuangan(),
                'nama_keuangans'                                => $request->nama_keuangans,
                'jenis_transaksi_keuangans'                     => $request->jenis_transaksi_keuangans,
                'jumlah_keuangans'                              => General::ubahHargaKeDB($request->jumlah_keuangans),
                'created_at'                                    => General::ubahTanggalKeDB($request->created_at),
            ];
            \App\Models\Transaksi_keuangan::insert($keuangans_data);

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
                    $redirect_halaman  = 'dashboard/keuangan';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/keuangan');
    }

    public function edit($id_keuangans=0)
    {
        $link_keuangan = 'keuangan';
        if(General::hakAkses($link_keuangan,'edit') == 'true')
        {
            $cek_keuangans = \App\Models\Transaksi_keuangan::where('id_keuangans',$id_keuangans)->first();
            if(!empty($cek_keuangans))
            {
                $data['edit_keuangans']           = $cek_keuangans;
                return view('dashboard.keuangan.edit',$data);
            }
            else
                return redirect('dashboard/keuangan');
        }
        else
            return redirect('dashboard/keuangan');
    }

    public function prosesedit($id_keuangans=0, Request $request)
    {
        $link_keuangan = 'keuangan';
        if(General::hakAkses($link_keuangan,'edit') == 'true')
        {
            $cek_keuangans = \App\Models\Transaksi_keuangan::where('id_keuangans',$id_keuangans)->first();
            if(!empty($cek_keuangans))
            {
                $aturan = [
                    'tokos_id'                                    => 'required',
                    'nama_keuangans'                              => 'required',
                    'jumlah_keuangans'                            => 'required',
                    'jenis_transaksi_keuangans'                   => 'required',
                    'created_at'                                  => 'required',
                ];
    
                $error_pesan = [
                    'tokos_id.required'                           => 'Form Toko Harus Dipilih.',
                    'nama_keuangans.required'                     => 'Form Nama Harus Diisi.',
                    'jumlah_keuangans.required'                   => 'Form Jumlah Harus Diisi.',
                    'jenis_transaksi_keuangans.required'          => 'Form Jenis Transaksi Harus Dipilih.',
                    'created_at.required'                         => 'Form Tanggal Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);
        
                $keuangans_data = [
                    'tokos_id'                                  => $request->tokos_id,
                    'jenis_transaksi_keuangans'                 => $request->jenis_transaksi_keuangans,
                    'nama_keuangans'                            => $request->nama_keuangans,
                    'jumlah_keuangans'                          => General::ubahHargaKeDB($request->jumlah_keuangans),
                    'created+_at'                               => General::ubahTanggalKeDB($request->created_at),
                    'updated_at'                                => date('Y-m-d H:i:s'),
                ];
                \App\Models\Transaksi_keuangan::where('id_keuangans',$id_keuangans)
                                                ->update($keuangans_data);

                if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/keuangan';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/keuangan');
        }
        else
            return redirect('dashboard/keuangan');
    }

    public function hapus($id_keuangans=0)
    {
        $link_keuangan = 'keuangan';
        if(General::hakAkses($link_keuangan,'hapus') == 'true')
        {
            $cek_keuangans = \App\Models\Transaksi_keuangan::where('id_keuangans',$id_keuangans)->first();
            if(!empty($cek_keuangans))
            {
                \App\Models\Transaksi_keuangan::where('id_keuangans',$id_keuangans)
                                                ->delete();
                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/keuangan');
        }
        else
            return redirect('dashboard/keuangan');
    }

}