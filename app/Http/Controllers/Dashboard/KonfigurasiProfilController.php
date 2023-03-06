<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class KonfigurasiProfilController extends AdminCoreController
{
    public function index()
    {
    	$data['lihat_level_sistems']	= \App\Models\Master_level_sistem::where('id_level_sistems',Auth::user()->level_sistems_id)->first();
        session()->forget('halaman');
       	return view('dashboard.konfigurasi_profil.lihat',$data);
    }

    public function prosesedit(Request $request)
    {
    	$id_users  	= Auth::user()->id;
        $ambil_foto_user = $request->userfile_foto_user;
        if($ambil_foto_user != '')
        {
            $aturan = [
                'userfile_foto_user'    => 'required|mimes:png,jpg,jpeg,svg',
                'name'                  => 'required',
            ];
            $error_pesan = [
                'userfile_foto_user.required'   => 'Form Foto Harus Diisi.',
                'name.required'                 => 'Form Nama Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $cek_foto_user       = \App\Models\User::where('id',$id_users)->first();
            if($cek_foto_user != null)
            {
                $foto_user_lama        = $cek_foto_user->profile_photo_path;
            	if (file_exists($foto_user_lama))
            	    unlink($foto_user_lama);
            }

            $nama_foto_user = date('Ymd').date('His').str_replace(')','',str_replace('(','',str_replace(' ','-',$request->file('userfile_foto_user')->getClientOriginalName())));
            $path_foto_user = 'public/uploads/foto_user/';
            $request->file('userfile_foto_user')->move(
                base_path() . '/public/uploads/foto_user/', $nama_foto_user
            );

            $data = [
                'profile_photo_path'  	=> $path_foto_user.$nama_foto_user,
                'name'                  => $request->name,
                'updated_at'            => date('Y-m-d H:i:s'),
            ];
        }
        else
        {
            $aturan = [
                'name'                  => 'required',
            ];
            $error_pesan = [
                'name.required'                 => 'Form Nama Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $data = [
                'name' 			     	=> $request->name,
                'updated_at'	     	=> date('Y-m-d H:i:s'),
            ];
        }

        \App\Models\User::where('id',$id_users)->update($data);

        $setelah_simpan = [
            'alert'  => 'sukses',
            'text'   => 'Profil berhasil diperbarui',
        ];
        return redirect()->back()->with('setelah_simpan', $setelah_simpan);
    }
}