<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use app\Helpers\General;
use Auth;
use Storage;

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
                'alamat_konfigurasi_aplikasis'              => 'required',
                'email_konfigurasi_aplikasis'               => 'required',
                'telepon_konfigurasi_aplikasis'             => 'required',
            ];
            $error_pesan = [
                'nama_konfigurasi_aplikasis.required'       => 'Form Email Harus Diisi.',
                'deskripsi_konfigurasi_aplikasis.required'  => 'Form Deskripsi Harus Diisi.',
                'keywords_konfigurasi_aplikasis.required'   => 'Form Keywords Harus Diisi.',
                'alamat_konfigurasi_aplikasis.required'     => 'Form Alamat Harus Diisi.',
                'email_konfigurasi_aplikasis.required'      => 'Form Email Harus Diisi.',
                'telepon_konfigurasi_aplikasis.required'    => 'Form Telepon Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $facebook_konfigurasi_aplikasis = '';
            if(!empty($request->facebook_konfigurasi_aplikasis))
                $facebook_konfigurasi_aplikasis = $request->facebook_konfigurasi_aplikasis;
            
            $twitter_konfigurasi_aplikasis = '';
            if(!empty($request->twitter_konfigurasi_aplikasis))
                $twitter_konfigurasi_aplikasis = $request->twitter_konfigurasi_aplikasis;

            $instagram_konfigurasi_aplikasis = '';
            if(!empty($request->instagram_konfigurasi_aplikasis))
                $instagram_konfigurasi_aplikasis = $request->instagram_konfigurasi_aplikasis;

            $konfigurasi_aplikasi_data = [
                'nama_konfigurasi_aplikasis'                    => $request->nama_konfigurasi_aplikasis,
                'deskripsi_konfigurasi_aplikasis'               => $request->deskripsi_konfigurasi_aplikasis,
                'keywords_konfigurasi_aplikasis'                => $request->keywords_konfigurasi_aplikasis,
                'alamat_konfigurasi_aplikasis'                  => $request->alamat_konfigurasi_aplikasis,
                'email_konfigurasi_aplikasis'                   => $request->email_konfigurasi_aplikasis,
                'telepon_konfigurasi_aplikasis'                 => $request->telepon_konfigurasi_aplikasis,
                'facebook_konfigurasi_aplikasis'                => $request->facebook_konfigurasi_aplikasis,
                'twitter_konfigurasi_aplikasis'                 => $request->twitter_konfigurasi_aplikasis,
                'instagram_konfigurasi_aplikasis'               => $request->instagram_konfigurasi_aplikasis,
                'updated_at'                                    => date('Y-m-d H:i:s'),
            ];
            \App\Models\Master_konfigurasi_aplikasi::query()->update($konfigurasi_aplikasi_data);

            $setelah_simpan = [
                'alert'                     => 'sukses',
                'text'                      => 'Data berhasil diperbarui',
            ];
            return redirect()->back()->with('setelah_simpan', $setelah_simpan)->withInput($request->all());
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
                $logo_lama        = $cek_logo->logo_konfigurasi_aplikasis;
                if (Storage::disk('public')->exists($logo_lama))
                    Storage::disk('public')->delete($logo_lama);
            }

            $nama_logo = date('Ymd') . date('His') . str_replace(')', '', str_replace('(', '', str_replace(' ', '-', $request->file('userfile_logo')->getClientOriginalName())));
            $path_logo = 'logo/';
            Storage::disk('public')->put($path_logo.$nama_logo, file_get_contents($request->file('userfile_logo')));

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
                $icon_lama        = $cek_icon->icon_konfigurasi_aplikasis;
                if (Storage::disk('public')->exists($icon_lama))
                    Storage::disk('public')->delete($icon_lama);
            }

            $nama_icon = date('Ymd') . date('His') . str_replace(')', '', str_replace('(', '', str_replace(' ', '-', $request->file('userfile_icon')->getClientOriginalName())));
            $path_icon = 'logo/';
            Storage::disk('public')->put($path_icon.$nama_icon, file_get_contents($request->file('userfile_icon')));

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
                $logo_text_lama        = $cek_logo_text->logo_text_konfigurasi_aplikasis;
                if (Storage::disk('public')->exists($logo_text_lama))
                    Storage::disk('public')->delete($logo_text_lama);
            }

            $nama_logo_text = date('Ymd') . date('His') . str_replace(')', '', str_replace('(', '', str_replace(' ', '-', $request->file('userfile_logo_text')->getClientOriginalName())));
            $path_logo_text = 'logo/';
            Storage::disk('public')->put($path_logo_text.$nama_logo_text, file_get_contents($request->file('userfile_logo_text')));

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

    public function proseseditbackgroundwebsite(Request $request)
    {
        $link_konfigurasi_aplikasi = 'konfigurasi_aplikasi';
        if(General::hakAkses($link_konfigurasi_aplikasi, 'lihat') == 'true')
        {
            $aturan = [
                'userfile_background_website'     => 'required|mimes:png,jpg,jpeg,svg',
            ];
            $error_pesan = [
                'userfile_background_website.required'   => 'Form Logo Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $cek_background_website       = \App\Models\Master_konfigurasi_aplikasi::first();
            if (!empty($cek_background_website)) {
                $background_website_lama        = $cek_background_website->background_website_konfigurasi_aplikasis;
                if (Storage::disk('public')->exists($background_website_lama))
                    Storage::disk('public')->delete($background_website_lama);
            }

            $nama_background_website = date('Ymd') . date('His') . str_replace(')', '', str_replace('(', '', str_replace(' ', '-', $request->file('userfile_background_website')->getClientOriginalName())));
            $path_background_website = 'logo/';
            Storage::disk('public')->put($path_background_website.$nama_background_website, file_get_contents($request->file('userfile_background_website')));

            $data = [
                'background_website_konfigurasi_aplikasis'    => $path_background_website . $nama_background_website,
                'updated_at'                    => date('Y-m-d H:i:s'),
            ];

            \App\Models\Master_konfigurasi_aplikasi::query()->update($data);

            $setelah_simpan_background_website = [
                'alert'                     => 'sukses',
                'text'                      => 'Logo berhasil diperbarui',
            ];
            return redirect()->back()->with('setelah_simpan_background_website', $setelah_simpan_background_website);
        }
        else
            return redirect('dashboard');
    }
}