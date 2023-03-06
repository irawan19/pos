<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class KonfigurasiAplikasiController extends AdminCoreController
{
    public function index()
    {
        $link_konfigurasi_aplikasi = 'konfigurasi_aplikasi';
        if(General::hakAkses($link_konfigurasi_aplikasi, 'lihat') == 'true')
        {
            $data['lihat_konfigurasi_aplikasis']       = \App\Models\Master_konfigurasi_aplikasi::first();
            session()->forget('halaman');
            return view('dashboard.konfigurasi_aplikasi.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function prosesedit(Request $request)
    {
        $link_konfigurasi_aplikasi = 'konfigurasi_aplikasi';
        if (General::hakAkses($link_konfigurasi_aplikasi, 'lihat') == 'true')
        {
            $aturan = [
                'nama_konfigurasi_aplikasis'                => 'required',
                'deskripsi_konfigurasi_aplikasis'           => 'required',
                'keywords_konfigurasi_aplikasis'            => 'required',
            ];
            $error_pesan = [
                'nama_konfigurasi_aplikasis.required'       => 'Form Email Harus Diisi.',
                'deskripsi_konfigurasi_aplikasis.required'  => 'Form Deskripsi Harus Diisi.',
                'keywords_konfigurasi_aplikasis.required'   => 'Form Keywords Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $konfigurasi_aplikasi_data = [
                'nama_konfigurasi_aplikasis'                    => $request->nama_konfigurasi_aplikasis,
                'deskripsi_konfigurasi_aplikasis'               => $request->deskripsi_konfigurasi_aplikasis,
                'keywords_konfigurasi_aplikasis'                => $request->keywords_konfigurasi_aplikasis,
                'updated_at'                                    => date('Y-m-d H:i:s'),
            ];
            \App\Models\Master_konfigurasi_aplikasi::query()->update($konfigurasi_aplikasi_data);

            $setelah_simpan = [
                'alert'                     => 'sukses',
                'text'                      => 'Data berhasil diperbarui',
            ];
            return redirect()->back()->with('setelah_simpan', $setelah_simpan);
        }
        else
            return redirect('dashboard');
    }

    public function proseseditlogo(Request $request)
    {
        $link_konfigurasi_aplikasi = 'konfigurasi_aplikasi';
        if(General::hakAkses($link_konfigurasi_aplikasi, 'lihat') == 'true')
        {
            $aturan = [
                'userfile_logo'     => 'required|mimes:png,jpg,jpeg,svg',
            ];
            $error_pesan = [
                'userfile_logo.required'   => 'Form Logo Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $cek_logo       = \App\Models\Master_konfigurasi_aplikasi::first();
            if (!empty($cek_logo)) {
                $logo_old        = $cek_logo->logo_konfigurasi_aplikasis;
                if (file_exists($logo_old))
                    unlink($logo_old);
            }

            $nama_logo = date('Ymd') . date('His') . str_replace(')', '', str_replace('(', '', str_replace(' ', '-', $request->file('userfile_logo')->getClientOriginalName())));
            $path_logo = 'public/uploads/logo/';
            $request->file('userfile_logo')->move(
                base_path() . '/public/uploads/logo/',
                $nama_logo
            );

            $data = [
                'logo_konfigurasi_aplikasis'    => $path_logo . $nama_logo,
                'updated_at'                    => date('Y-m-d H:i:s'),
            ];

            \App\Models\Master_konfigurasi_aplikasi::query()->update($data);

            $setelah_simpan_logo = [
                'alert'                     => 'sukses',
                'text'                      => 'Logo berhasil diperbarui',
            ];
            return redirect()->back()->with('setelah_simpan_logo', $setelah_simpan_logo);
        }
        else
            return redirect('dashboard');
    }

    public function prosesediticon(Request $request)
    {
        $link_konfigurasi_aplikasi = 'konfigurasi_aplikasi';
        if(General::hakAkses($link_konfigurasi_aplikasi, 'lihat') == 'true')
        {
            $aturan = [
                'userfile_icon'             => 'required|mimes:png,jpg,jpeg,svg',
            ];
            $error_pesan = [
                'userfile_icon.required'    => 'Form Icon Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $cek_icon       = \App\Models\Master_konfigurasi_aplikasi::first();
            if (!empty($cek_icon)) {
                $icon_old        = $cek_icon->icon_konfigurasi_aplikasis;
                if (file_exists($icon_old))
                    unlink($icon_old);
            }

            $nama_icon = date('Ymd') . date('His') . str_replace(')', '', str_replace('(', '', str_replace(' ', '-', $request->file('userfile_icon')->getClientOriginalName())));
            $path_icon = 'public/uploads/logo/';
            $request->file('userfile_icon')->move(
                base_path() . '/public/uploads/logo/',
                $nama_icon
            );

            $data = [
                'icon_konfigurasi_aplikasis'    => $path_icon . $nama_icon,
                'updated_at'                    => date('Y-m-d H:i:s'),
            ];

            \App\Models\Master_konfigurasi_aplikasi::query()->update($data);

            $setelah_simpan_icon = [
                'alert'                     => 'sukses',
                'text'                      => 'Icon berhasil diperbarui',
            ];
            return redirect()->back()->with('setelah_simpan_icon', $setelah_simpan_icon);
        }
        else
            return redirect('dashboard');
    }

    public function proseseditlogotext(Request $request)
    {
        $link_konfigurasi_aplikasi = 'konfigurasi_aplikasi';
        if(General::hakAkses($link_konfigurasi_aplikasi, 'lihat') == 'true')
        {
            $aturan = [
                'userfile_logo_text'            => 'required|mimes:png,jpg,jpeg,svg',
            ];
            $error_pesan = [
                'userfile_logo_text.required'   => 'Form Logo Text Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $cek_logo_text       = \App\Models\Master_konfigurasi_aplikasi::first();
            if (!empty($cek_logo_text)) {
                $logo_text_old        = $cek_logo_text->logo_text_konfigurasi_aplikasis;
                if (file_exists($logo_text_old))
                    unlink($logo_text_old);
            }

            $nama_logo_text = date('Ymd') . date('His') . str_replace(')', '', str_replace('(', '', str_replace(' ', '-', $request->file('userfile_logo_text')->getClientOriginalName())));
            $path_logo_text = 'public/uploads/logo/';
            $request->file('userfile_logo_text')->move(
                base_path() . '/public/uploads/logo/',
                $nama_logo_text
            );

            $data = [
                'logo_text_konfigurasi_aplikasis'   => $path_logo_text . $nama_logo_text,
                'updated_at'                        => date('Y-m-d H:i:s'),
            ];

            \App\Models\Master_konfigurasi_aplikasi::query()->update($data);

            $setelah_simpan_logo_text = [
                'alert'                     => 'sukses',
                'text'                      => 'Logo Text berhasil diperbarui',
            ];
            return redirect()->back()->with('setelah_simpan_logo_text', $setelah_simpan_logo_text);
        }
        else
            return redirect('dashboard');
    }
}