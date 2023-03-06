<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;

class AdminController extends AdminCoreController
{
    public function index(Request $request)
    {
        $link_admin = 'admin';
        if(General::hakAkses($link_admin,'lihat') == 'true')
        {
            $data['link_admin']         = $link_admin;
            $data['hasil_kata']         = '';
            $url_sekarang               = $request->fullUrl();
        	$data['lihat_admins']    	= \App\Models\User::join('master_level_sistems','level_sistems_id','=','master_level_sistems.id_level_sistems')
                                                            ->orderBy('nama_level_sistems','asc')
                                                            ->paginate(10);
            session()->forget('halaman');
            session()->forget('hasil_kata');
            session(['halaman'          => $url_sekarang]);
        	return view('dashboard.admin.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_admin = 'admin';
        if(General::hakAkses($link_admin,'lihat') == 'true')
        {
            $data['link_admin']         = $link_admin;
            $url_sekarang               = $request->fullUrl();
            $hasil_kata                 = $request->cari_kata;
            $data['hasil_kata']         = $hasil_kata;
            $data['lihat_admins']       = \App\Models\User::join('master_level_sistems','level_sistems_id','=','master_level_sistems.id_level_sistems')
                                                            ->where('nama_level_sistems', 'LIKE', '%'.$hasil_kata.'%')
                											->orWhere('name', 'LIKE', '%'.$hasil_kata.'%')
                											->orWhere('username', 'LIKE', '%'.$hasil_kata.'%')
                                                            ->orWhere('email', 'LIKE', '%'.$hasil_kata.'%')
                                                            ->orderBy('nama_level_sistems')
                                                            ->paginate(10);
            session(['halaman'          => $url_sekarang]);
            session(['hasil_kata'		=> $hasil_kata]);
            return view('dashboard.admin.lihat', $data);
        }
        else
            return redirect('dashboard/admin');
    }

    public function tambah()
    {
        $link_admin = 'admin';
        if(General::hakAkses($link_admin,'tambah') == 'true')
        {
            $data['tambah_level_sistems']       = \App\Models\Master_level_sistem::orderBy('nama_level_sistems')
                                                      					->get();
            return view('dashboard.admin.tambah',$data);
        }
        else
            return redirect('dashboard/admin');
    }

    public function prosestambah(Request $request)
    {
    	$link_admin = 'admin';
        if(General::hakAkses($link_admin,'tambah') == 'true')
        {
            $ambil_foto_user = $request->userfile_foto_user;
            if($ambil_foto_user != '')
            {
                $aturan = [
                    'userfile_foto_user'    => 'required|mimes:png,jpg,jpeg',
                    'level_sistems_id'      => 'required',
                    'username'              => 'required|unique:users',
                    'nama'                  => 'required',
                    'email'                 => 'required|unique:users',
                    'password'              => 'required|string|min:6|confirmed',
                ];
                $error_pesan = [
                    'userfile_foto_user.required'   => 'Form Foto Harus Dipilih.',
                    'level_sistems_id.required'     => 'Form Level Sistem Harus Dipilih.',
                    'nama.required'                 => 'Form Nama Harus Diisi.',
                    'username.required'             => 'Form Username Harus Diisi.',
                    'email.required'                => 'Form Email Harus Diisi.',
                    'email.unique'                  => 'Email Sudah Terdaftar, Silahkan Gunakan Email Lain.',
                    'password.required'             => 'Form Password Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);

                $nama_foto_user = date('Ymd').date('His').str_replace(')','',str_replace('(','',str_replace(' ','-',$request->file('userfile_foto_user')->getClientOriginalName())));
                $path_foto_user = './public/uploads/user/';
                $request->file('userfile_foto_user')->move(
                    base_path() . '/public/uploads/user/', $nama_foto_user
                );

                $data = [
                    'profile_photo_path' 	=> $path_foto_user.$nama_foto_user,
                    'name'               	=> $request->name,
                    'username'              => $request->username,
                    'email'              	=> $request->email,
                    'created_at'         	=> date('Y-m-d H:i:s'),
                    'updated_at'         	=> date('Y-m-d H:i:s'),
                    'password'           	=> bcrypt($request->password),
                    'remember_token'     	=> str_random(100),
                    'level_sistems_id'   	=> $request->level_sistems_id,
                    'no_telp'               => '',
                    'alamat'                => '',
                ];
            }
            else
            {
                $aturan = [
                    'level_sistems_id'      => 'required',
                    'name'                  => 'required',
                    'username'              => 'required',
                    'email'                 => 'required|unique:users',
                    'password'              => 'required|string|min:6|confirmed',
                ];
                $error_pesan = [
                    'level_sistems_id.required'     => 'Form Level Sistem Harus Dipilih.',
                    'nama.required'                 => 'Form Nama Harus Diisi.',
                    'username.required'             => 'Form Username Harus Diisi.',
                    'email.required'                => 'Form Email Harus Diisi.',
                    'email.unique'                  => 'Email Sudah Terdaftar, Silahkan Gunakan Email Lain.',
                    'password.required'             => 'Form Password Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);

                $data = [
                    'profile_photo_path' 	=> null,
                    'name'               	=> $request->name,
                    'username'              => $request->username,
                    'email'              	=> $request->email,
                    'created_at'         	=> date('Y-m-d H:i:s'),
                    'updated_at'         	=> date('Y-m-d H:i:s'),
                    'password'           	=> bcrypt($request->password),
                    'remember_token'     	=> str_random(100),
                    'level_sistems_id'   	=> $request->level_sistems_id,
                    'no_telp'               => '',
                    'alamat'                => '',
                ];
            }
            \App\Models\User::insert($data);
    	    
    	    $simpan         	      = $request->simpan;
    	    $simpan_kembali 		  = $request->simpan_kembali;
    	    if($simpan)
    	    {
    	        $setelah_simpan = [
    	            'alert'  => 'sukses',
    	            'text'   => 'Data berhasil ditambahkan',
    	        ];
    	    	return redirect()->back()->with('setelah_simpan', $setelah_simpan);
    	    }
    	    if($simpan_kembali)
    	    {
    	    	if(request()->session()->get('halaman') != '')
                    $redirect_halaman  = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/admin';

                return redirect($redirect_halaman);
    	    }
        }
        else
            return redirect('dashboard/admin');
    }

    public function baca($id_admins=0)
    {
        $link_admin = 'admin';
        if(General::hakAkses($link_admin,'baca') == 'true')
        {
            $cek_admins = \App\Models\User::where('id',$id_admins)->first();
            if(!empty($cek_admins))
            {
            	$ambil_admin 					= \App\Models\User::join('master_level_sistems','level_sistems_id','=','master_level_sistems.id_level_sistems')
                                                                    ->where('id',$id_admins)
        		                                                    ->first();
            	$data['baca_level_sistems']		= \App\Models\Master_level_sistem::where('id_level_sistems',$ambil_admin->id_level_sistems)->first();
            	$data['baca_menus']             = \App\Models\Master_menu::where('menus_id',null)
                                                                ->orderBy('order_menus')
                                                                ->get();
                $data['baca_admins']    		= $ambil_admin;
                return view('dashboard.admin.baca',$data);
            }
            else
                return redirect('dashboard/admin');
        }
        else
            return redirect('dashboard/admin');
    }

    public function edit($id_admins=0)
    {
    	$link_admin = 'admin';
        if(General::hakAkses($link_admin,'edit') == 'true')
        {
            $cek_admins = \App\Models\User::where('id',$id_admins)->count();
            if($cek_admins != 0)
            {
                $data['edit_level_sistems']     = \App\Models\Master_level_sistem::orderBy('nama_level_sistems')
                                                          					->get();
                $data['edit_admins']			= \App\Models\User::where('id',$id_admins)
                													->first();
                return view('dashboard.admin.edit',$data);
            }
            else
                return redirect('dashboard/admin');
        }
        else
            return redirect('dashboard/admin');
    }

    public function prosesedit($id_admins=0, Request $request)
    {
    	$link_admin = 'admin';
        if(General::hakAkses($link_admin,'edit') == 'true')
        {
            $cek_admins = \App\Models\User::where('id',$id_admins)->first();
            if(!empty($cek_admins))
            {
            	if($request->password != '')
                {
                    $ambil_foto_user = $request->userfile_foto_user;
                    if($ambil_foto_user != '')
                    {
                        $aturan = [
                            'userfile_foto_user'    => 'required|mimes:png,jpg,jpeg',
                            'level_sistems_id'      => 'required',
                            'name'                  => 'required',
                            'username'              => 'required|unique:users,username,'.$id_admins.',id',
                            'email'                 => 'required|unique:users,email,'.$id_admins.',id',
                            'password'              => 'required|string|min:6|confirmed',
                        ];
                        $error_pesan = [
                            'userfile_foto_user.required'   => 'Form Foto Harus Dipilih.',
                            'level_sistems_id.required'     => 'Form Level Sistem Harus Dipilih.',
                            'name.required'                 => 'Form Nama Harus Diisi.',
                            'username.required'             => 'Form Username Harus Diisi.',
                            'email.required'                => 'Form Email Harus Diisi.',
                            'email.unique'                  => 'Email Sudah Terdaftar, Silahkan Gunakan Email Lain.',
                            'password.required'             => 'Form Password Harus Diisi.',
                        ];
                        $this->validate($request, $aturan, $error_pesan);

                        $foto_user_lama        = $cek_admins->profile_photo_path;
                        if (file_exists($foto_user_lama))
                            unlink($foto_user_lama);

                        $nama_foto_user = date('Ymd').date('His').str_replace(')','',str_replace('(','',str_replace(' ','-',$request->file('userfile_foto_user')->getClientOriginalName())));
                        $path_foto_user = './public/uploads/user/';
                        $request->file('userfile_foto_user')->move(
                            base_path() . '/public/uploads/user/', $nama_foto_user
                        );

                        $data = [
                            'foto_user'             => $path_foto_user.$nama_foto_user,
                            'name'                  => $request->name,
                            'username'              => $request->username, 
                            'email'                 => $request->email,
                            'updated_at'            => date('Y-m-d H:i:s'),
                            'password'              => bcrypt($request->password),
                            'level_sistems_id'      => $request->level_sistems_id,
                        ];
                    }
                    else
                    {
                        $aturan = [
                            'level_sistems_id'      => 'required',
                            'nama'                  => 'required',
                            'username'              => 'required|unique:users,username,'.$id_admins.',id',
                            'email'                 => 'required|unique:users,email,'.$id_admins.',id',
                            'password'              => 'required|string|min:6|confirmed',
                        ];
                        $error_pesan = [
                            'level_sistems_id.required'     => 'Form Level Sistem Harus Dipilih.',
                            'nama.required'                 => 'Form Nama Harus Diisi.',
                            'username.required'             => 'Form Username Harus Diisi.',
                            'email.required'                => 'Form Email Harus Diisi.',
                            'email.unique'                  => 'Email Sudah Terdaftar, Silahkan Gunakan Email Lain.',
                            'password.required'             => 'Form Password Harus Diisi.',
                        ];
                        $this->validate($request, $aturan, $error_pesan);

                	    $data = [
                	        'name' 			        => $request->name,
                            'username'              => $request->username,
                	        'email'			        => $request->email,
                	        'updated_at'	        => date('Y-m-d H:i:s'),
                	        'password' 		        => bcrypt($request->password),
                            'level_sistems_id'      => $request->level_sistems_id,
                	    ];
                    }
            	}
            	else
            	{
                    $ambil_foto_user = $request->userfile_foto_user;
                    if($ambil_foto_user != '')
                    {
                        $aturan = [
                            'userfile_foto_user'    => 'required|mimes:png,jpg,jpeg',
                            'level_sistems_id'      => 'required',
                            'username'              => 'required',
                            'name'                  => 'required',
                            'email'                 => 'required|unique:users,email,'.$id_admins.',id',
                        ];
                        $error_pesan = [
                            'userfile_foto_user.required'   => 'Form Foto Harus Dipilih.',
                            'level_sistems_id.required'     => 'Form Level Sistem Harus Dipilih.',
                            'username.required'             => 'Form Username Harus Diisi.',
                            'name.required'                 => 'Form Nama Harus Diisi.',
                            'email.required'                => 'Form Email Harus Diisi.',
                            'email.unique'                  => 'Email Sudah Terdaftar, Silahkan Gunakan Email Lain.',
                        ];
                        $this->validate($request, $aturan, $error_pesan);

                        $foto_user_lama        = $cek_admins->profile_photo_path;
                        if (file_exists($foto_user_lama))
                            unlink($foto_user_lama);

                        $nama_foto_user = date('Ymd').date('His').str_replace(')','',str_replace('(','',str_replace(' ','-',$request->file('userfile_foto_user')->getClientOriginalName())));
                        $path_foto_user = './public/uploads/user/';
                        $request->file('userfile_foto_user')->move(
                            base_path() . '/public/uploads/user/', $nama_foto_user
                        );

                        $data = [
                            'username'              => $request->username,
                            'name'                  => $request->name,
                            'email'                 => $request->email,
                            'updated_at'            => date('Y-m-d H:i:s'),
                            'level_sistems_id'      => $request->level_sistems_id,
                            'foto_user'             => $path_foto_user.$nama_foto_user,
                        ];
                    }
                    else
                    {
                        $aturan = [
                            'level_sistems_id'      => 'required',
                            'username'              => 'required|unique:users,username,'.$id_admins.',id',
                            'nama'                  => 'required',
                            'email'                 => 'required|unique:users,email,'.$id_admins.',id',
                        ];
                        $error_pesan = [
                            'level_sistems_id.required'     => 'Form Level Sistem Harus Dipilih.',
                            'nama.required'                 => 'Form Nama Harus Diisi.',
                            'username.required'             => 'Form Username Harus Diisi.',
                            'email.required'                => 'Form Email Harus Diisi.',
                            'email.unique'                  => 'Email Sudah Terdaftar, Silahkan Gunakan Email Lain.',
                        ];
                        $this->validate($request, $aturan, $error_pesan);
                        
                	    $data = [
                            'username'              => $request->username,
                	        'nama' 			     	=> $request->nama,
                	        'email'			     	=> $request->email,
                	        'updated_at'	     	=> date('Y-m-d H:i:s'),
                            'level_sistems_id'    	=> $request->level_sistems_id,
                	    ];
                    }
            	}
            	\App\Models\User::where('id', $id_admins)->update($data);

	            if(request()->session()->get('halaman') != '')
	                $redirect_halaman    = request()->session()->get('halaman');
	            else
	                $redirect_halaman  = 'dashboard/admin';
	            
	            return redirect($redirect_halaman);
	        }
	        else
	        	return redirect('dashboard/admin');
        }
        else
            return redirect('dashboard/admin');
    }

    public function hapus($id_admins=0)
    {
    	$link_admin = 'admin';
        if(General::hakAkses($link_admin,'hapus') == 'true')
        {
            $cek_admins = \App\Models\User::where('id',$id_admins)->first();
            if(!empty($cek_admins))
            {
                $delete_users_data = [
                    'updated_at'         => date('Y-m-d H:i:s'),
                ];
                \App\Models\User::where('id',$id_admins)->update($delete_users_data);

                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/admin');
        }
        else
            return redirect('dashboard/admin');
    }

}