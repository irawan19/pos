<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class PembayaranController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_pembayaran = 'pembayaran';
        if(General::hakAkses($link_pembayaran,'lihat') == 'true')
        {
            $data['link_pembayaran']              = $link_pembayaran;
            $data['hasil_kata']             = '';
            $url_sekarang                   = $request->fullUrl();
        	$data['lihat_pembayarans']            = \App\Models\Master_pembayaran::paginate(10);
            session()->forget('halaman');
            session()->forget('hasil_kata');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.pembayaran.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_pembayaran = 'pembayaran';
        if(General::hakAkses($link_pembayaran,'lihat') == 'true')
        {
            $data['link_pembayaran']              = $link_pembayaran;
            $url_sekarang                   = $request->fullUrl();
            $hasil_kata                     = $request->cari_kata;
            $data['hasil_kata']             = $hasil_kata;
            $data['lihat_pembayarans']            = \App\Models\Master_pembayaran::where('nama_pembayarans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                ->orwhere('akun_pembayarans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                ->orwhere('no_rekening_pembayarans', 'LIKE', '%'.$hasil_kata.'%')
                                                                                ->paginate(10);
            session(['halaman'              => $url_sekarang]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.pembayaran.lihat', $data);
        }
        else
            return redirect('dashboard/pembayaran');
    }

    public function tambah(Request $request)
    {
        $link_pembayaran = 'pembayaran';
        if(General::hakAkses($link_pembayaran,'tambah') == 'true')
            return view('dashboard.pembayaran.tambah');
        else
            return redirect('dashboard/pembayaran');
    }

    public function prosestambah(Request $request)
    {
        $link_pembayaran = 'pembayaran';
        if(General::hakAkses($link_pembayaran,'tambah') == 'true')
        {
            $aturan = [
                'nama_pembayarans'                              => 'required',
            ];

            $error_pesan = [
                'nama_pembayarans.required'                     => 'Form Nama Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $akun_pembayarans = '';
            if(!empty($request->akun_pembayarans))
                $akun_pembayarans = $request->akun_pembayarans;

            $no_rekening_pembayarans = '';
            if(!empty($request->no_rekening_pembayarans))
                $no_rekening_pembayarans = $request->no_rekening_pembayarans;

            $pembayarans_data = [
                'nama_pembayarans'                              => $request->nama_pembayarans,
                'akun_pembayarans'                              => $akun_pembayarans,
                'no_rekening_pembayarans'                       => $no_rekening_pembayarans,
                'created_at'                                    => date('Y-m-d H:i:s'),
            ];
            $id_pembayarans = \App\Models\Master_pembayaran::insertGetId($pembayarans_data);

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
                    $redirect_halaman  = 'dashboard/pembayaran';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/pembayaran');
    }

    public function edit($id_pembayarans=0)
    {
        $link_pembayaran = 'pembayaran';
        if(General::hakAkses($link_pembayaran,'edit') == 'true')
        {
            $cek_pembayarans = \App\Models\Master_pembayaran::where('id_pembayarans',$id_pembayarans)->first();
            if(!empty($cek_pembayarans))
            {
                $data['edit_pembayarans']           = $cek_pembayarans;
                return view('dashboard.pembayaran.edit',$data);
            }
            else
                return redirect('dashboard/pembayaran');
        }
        else
            return redirect('dashboard/pembayaran');
    }

    public function prosesedit($id_pembayarans=0, Request $request)
    {
        $link_pembayaran = 'pembayaran';
        if(General::hakAkses($link_pembayaran,'edit') == 'true')
        {
            $cek_pembayarans = \App\Models\Master_pembayaran::where('id_pembayarans',$id_pembayarans)->first();
            if(!empty($cek_pembayarans))
            {
                 $aturan = [
                     'nama_pembayarans'                          => 'required',
                 ];
        
                 $error_pesan = [
                     'nama_pembayarans.required'                 => 'Form Nama Harus Diisi.',
                 ];
                 $this->validate($request, $aturan, $error_pesan);

                 $akun_pembayarans = '';
                 if(!empty($request->akun_pembayarans))
                     $akun_pembayarans = $request->akun_pembayarans;

                 $no_rekening_pembayarans = '';
                 if(!empty($request->no_rekening_pembayarans))
                     $no_rekening_pembayarans = $request->no_rekening_pembayarans;
        
                 $pembayarans_data = [
                     'nama_pembayarans'                          => $request->nama_pembayarans,
                     'akun_pembayarans'                          => $akun_pembayarans,
                     'no_rekening_pembayarans'                   => $no_rekening_pembayarans,
                     'updated_at'                                => date('Y-m-d H:i:s'),
                 ];
                 \App\Models\Master_pembayaran::where('id_pembayarans',$id_pembayarans)
                                             ->update($pembayarans_data);

                if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/pembayaran';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/pembayaran');
        }
        else
            return redirect('dashboard/pembayaran');
    }

    public function hapus($id_pembayarans=0)
    {
        $link_pembayaran = 'pembayaran';
        if(General::hakAkses($link_pembayaran,'hapus') == 'true')
        {
            $cek_pembayarans = \App\Models\Master_pembayaran::where('id_pembayarans',$id_pembayarans)->first();
            if(!empty($cek_pembayarans))
            {
                \App\Models\Master_pembayaran::where('id_pembayarans',$id_pembayarans)
                                        ->delete();
                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/pembayaran');
        }
        else
            return redirect('dashboard/pembayaran');
    }

}