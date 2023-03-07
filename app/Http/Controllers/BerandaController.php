<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use General;

class BerandaController extends Controller
{

    public function index()
    {
        $data['lihat_konfigurasi_aplikasis']    = \App\Models\Master_konfigurasi_aplikasi::where('id_konfigurasi_aplikasis',1)
                                                                                        ->first();
        return view('beranda',$data);
    }

    public function kirimpesan(Request $request)
    {
        $aturan = [
            'nama_pesans'               => 'required',
            'email_pesans'              => 'required',
            'telepon_pesans'            => 'required',
            'konten_pesans'             => 'required',
        ];

        $error_pesan = [
            'nama_pesans.required'      => 'Form Nama Harus Diisi.',
            'email_pesans.required'     => 'Form Email Harus Diisi.',
            'telepon_pesans.required'   => 'Form Telepon Harus Diisi.',
            'konten_pesans.required'    => 'Form Konten Harus Diisi.',
        ];
        $this->validate($request, $aturan, $error_pesan);

        $pesans_data = [
            'nama_pesans'               => $request->nama_pesans,
            'email_pesans'              => $request->email_pesans,
            'telepon_pesans'            => $request->telepon_pesans,
            'konten_pesans'             => $request->konten_pesans,
            'created_at'                => date('Y-m-d H:i:s'),
            'status_baca'               => 0,
        ];
        \App\Models\Master_pesan::insert($pesans_data);

        $setelah_simpan = [
            'alert'  => 'sukses',
            'text'   => 'Pesan anda berhasil dikirim. Silahkan tunggu, kami akan membalas secepatnya.',
        ];
        return redirect('/#kontakkami')->with('setelah_simpan', $setelah_simpan);
    }

}