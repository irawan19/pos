<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use DB;
use General;
use Auth;

class MenuController extends AdminCoreController
{
    public function index(Request $request)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'lihat') == 'true')
        {
            $data['link_menu']              = $link_menu;
            $url_sekarang                   = $request->fullUrl();
            $data['hasil_kata']            	= '';
        	$data['lihat_menus']    		= \App\Models\Master_menu::where('menus_id','=',null)
        														->orderBy('order_menus')
        														->get();
        	session()->forget('halaman');
            session()->forget('hasil_kata');
            session()->forget('halaman2');
            session()->forget('hasil_kata2');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.menu.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'lihat') == 'true')
        {
            $data['link_menu']              = $link_menu;
            $url_sekarang                   = $request->fullUrl();
            $hasil_kata 					= $request->cari_kata;
            $data['hasil_kata']            	= $hasil_kata;
            $data['lihat_menus']    		= \App\Models\Master_menu::where('menus_id','=',null)
            													->where('nama_menus', 'LIKE', '%'.$hasil_kata.'%')
            													->orderBy('order_menus')
                                                                ->get();
            session(['halaman'              => $url_sekarang]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.menu.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function urutan()
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'edit') == 'true')
        {
        	$data['lihat_urutans'] = \App\Models\Master_menu::where('menus_id','=',null)
        											->orderBy('order_menus')
        											->get();
        	return view('dashboard.menu.urutan',$data);
        }
        else
            return redirect('dashboard/menu');
    }

    public function prosesurutan(Request $request)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'edit') == 'true')
        {
    		parse_str($request->namaHalaman, $urutanHalaman);
    		foreach ($urutanHalaman['menu'] as $key => $hasil)
    		{
    			$no 		= $key + 1;
    			$data 		= ['order_menus' => $no];
    			\App\Models\Master_menu::where('id_menus', $hasil)
                                ->update($data);
    		}
        }
        else
            return redirect('dashboard/menu');
    }

    public function tambah()
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'tambah') == 'true')
        {
            $data['lihat_icons']   = General::iconMenus();
    	   	return view('dashboard.menu.tambah',$data);
        }
        else
            return redirect('dashboard/menu');
    }

    public function prosestambah(Request $request)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'tambah') == 'true')
        {
            $aturan = [
                'icon_menus'                  => 'required',
                'nama_menus'                  => 'required',
            ];
            $error_pesan = [
                'icon_menus.required'           => 'Form Icon Harus Diisi.',
                'nama_menus.required'           => 'Form Nama Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

        	$data = [
        		'icon_menus'	=> $request->icon_menus,
                'nama_menus' 	=> $request->nama_menus,
                'order_menus'	=> General::autoIncrementKey('master_menus','order_menus'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];
        	\App\Models\Master_menu::insert($data);
        	
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
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/menu';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/menu');
    }

    public function baca($id_menus=0)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'baca') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
            	$data['baca_menus'] 		= \App\Models\Master_menu::where('id_menus',$id_menus)
                                                       		->first();
                $data['baca_sub_menus'] 	= \App\Models\Master_menu::where('menus_id',$id_menus)
                                                       		->get();
                return view('dashboard.menu.baca',$data);
            }
            else
                return redirect('dashboard/menu');
        }
        else
            return redirect('dashboard/menu');
    }

    public function edit($id_menus=0)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'edit') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
            	$data['lihat_icons']   	= General::iconMenus();
            	$data['edit_menus'] 	= \App\Models\Master_menu::where('id_menus',$id_menus)
                                                      ->first();
                return view('dashboard.menu.edit',$data);
            }
            else
                return redirect('dashboard/menu');
        }
        else
            return redirect('dashboard/menu');
    }

    public function prosesedit($id_menus=0, Request $request)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'edit') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
                $aturan = [
                    'icon_menus'                  => 'required',
                    'nama_menus'                  => 'required',
                ];
                $error_pesan = [
                    'icon_menus.required'           => 'Form Icon Harus Diisi.',
                    'nama_menus.required'           => 'Form Nama Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);

            	$data = [
                    'icon_menus'    => $request->icon_menus,
                    'nama_menus'    => $request->nama_menus,
                    'updated_at'    => date('Y-m-d H:i:s'),
                ];
            	\App\Models\Master_menu::where('id_menus', $id_menus)
                                ->update($data);
            	

            	if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/menu';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/menu');
        }
        else
            return redirect('dashboard/menu');
    }

    public function hapus($id_menus=0)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'hapus') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
                $ambil_sub_menus = \App\Models\Master_menu::where('menus_id',$id_menus)->get();
                if(!$ambil_sub_menus->isEmpty())
                {
                    foreach($ambil_sub_menus as $sub_menus)
                    {
                        \App\Models\Master_akses::join('master_fiturs','fiturs_id','=','master_fiturs.id_fiturs')
                                                ->where('menus_id',$sub_menus->id_menus)
                                                ->delete();
                        \App\Models\Master_fitur::where('menus_id',$sub_menus->id_menus)->delete();
                        \App\Models\Master_menu::where('id_menus',$sub_menus->id_menus)->delete();
                    }
                }
                \App\Models\Master_akses::join('master_fiturs','fiturs_id','=','master_fiturs.id_fiturs')
                                        ->where('menus_id',$id_menus)
                                        ->delete();
                \App\Models\Master_fitur::where('menus_id',$id_menus)->delete();
                \App\Models\Master_menu::where('id_menus',$id_menus)->delete();
                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/menu');
        }
        else
            return redirect('dashboard/menu');
    }

    public function submenu($id_menus=0, Request $request)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'lihat') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
                $data['link_menu']              = $link_menu;
                $data['hasil_kata2']			= '';
                $url_sekarang					= $request->fullUrl();
                $data['lihat_menus']			= \App\Models\Master_menu::where('id_menus','=',$id_menus)
                													->first();
            	$data['lihat_sub_menus']    	= \App\Models\Master_menu::where('menus_id','=',$id_menus)
            														->orderBy('order_menus')
            														->get();
            	session(['halaman2'             => $url_sekarang]);
            	return view('dashboard.menu.sub_menu_lihat', $data);
            }
            else
                return redirect('dashboard/menu/submenu/'.$id_menus);
        }
        else
            return redirect('dashboard/menu');
    }

    public function cari_submenu($id_menus=0, Request $request)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'lihat') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
                $data['link_menu']                  = $link_menu;
            	$url_sekarang                       = $request->fullUrl();
                $kata                               = $request->cari_kata;
                $data['hasil_kata2']                = $kata;
                $data['lihat_menus']				= \App\Models\Master_menu::where('id_menus','=',$id_menus)
                														->first();
                $data['lihat_sub_menus']    		= \App\Models\Master_menu::where('menus_id','=',$id_menus)
	                													->where('nama_menus', 'LIKE', '%'.$kata.'%')
	                													->orderBy('order_menus')
	                                                                    ->get();
                session(['halaman2'                 => $url_sekarang]);
                session(['hasil_kata2'              => $kata]);
                return view('dashboard.menu.sub_menu_lihat', $data);
            }
            else
                return redirect('dashboard/menu/submenu/'.$id_menus);
        }
        else
            return redirect('dashboard/menu');
    }

    public function tambah_submenu($id_menus=0)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'tambah') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
            	$data['lihat_icons']   = General::iconMenus();
            	$data['lihat_menus']   = \App\Models\Master_menu::where('id_menus',$id_menus)
                                                       		->first();
            	return view('dashboard.menu.sub_menu_tambah',$data);
            }
            else
                return redirect('dashboard/menu/submenu/'.$id_menus);
        }
        else
            return redirect('dashboard/menu');
    }

    public function prosestambah_submenu($id_menus=0, Request $request)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'tambah') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
                $aturan = [
                    'icon_menus'        => 'required',
                    'nama_menus'        => 'required',
                    'link_menus'        => 'required',
                    'nama_fiturs.0'     => 'required',
                ];
                $error_pesan = [
                    'icon_menus.required'           => 'Form Icon Harus Diisi.',
                    'nama_menus.required'           => 'Form Nama Harus Diisi.',
                    'link_menus.required'           => 'Form Link Harus Diisi.',
                    'nama_fiturs.0.required'        => 'Form Nama Fitur Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);

            	$data = [
            		'menus_id'	=> $id_menus,
                    'icon_menus' 	=> $request->icon_menus,
                    'nama_menus' 	=> $request->nama_menus,
                    'link_menus' 	=> $request->link_menus,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ];
            	$id_sub_menu = \App\Models\Master_menu::insertGetId($data);
                foreach($request->nama_fiturs as $nama_fiturs)
        		{
        			$fitur_data = [
        	            'nama_fiturs' => $nama_fiturs,
        	            'menus_id' 	  	=> $id_sub_menu,
        	        ];
        			\App\Models\Master_fitur::insert($fitur_data);
        		}

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
	                if(request()->session()->get('halaman2') != '')
	                    $redirect_halaman  = request()->session()->get('halaman2');
	                else
	                    $redirect_halaman  = 'dashboard/menu/submenu/'.$id_menus;

	                return redirect($redirect_halaman);
	            }
            }
            else
                return redirect('dashboard/menu/submenu/'.$id_menus);
        }
        else
            return redirect('dashboard/menu');
    }

    public function urutan_submenu($id_menus=0)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'edit') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
            	$data['lihat_menus']	    = \App\Models\Master_menu::where('id_menus',$id_menus)->first();
            	$data['lihat_urutans']      = \App\Models\Master_menu::where('menus_id','=',$id_menus)
            											->orderBy('order_menus')
            											->get();
            	return view('dashboard.menu.urutan',$data);
            }
            else
                return redirect('dashboard/menu');
        }
        else
            return redirect('dashboard/menu');
    }

    public function baca_submenu($id_menus=0)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'baca') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
            	$get_sub_menus 			= \App\Models\Master_menu::where('id_menus',$id_menus)
                                                       		->first();
                $data['baca_sub_menus'] = $get_sub_menus;
                $id_sub_menus 			= $get_sub_menus->menus_id;
                $data['baca_menus']		= \App\Models\Master_menu::where('id_menus',$id_sub_menus)
                											->first();
                return view('dashboard.menu.sub_menu_baca',$data);
            }
            else
                return redirect('dashboard/menu');
        }
        else
            return redirect('dashboard/menu');
    }

    public function edit_submenu($id_menus=0)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'edit') == 'true')
        {
            $cek_menu = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menu != 0)
            {
            	$data['lihat_icons']    = General::iconMenus();
            	$get_sub_menus 			= \App\Models\Master_menu::where('id_menus',$id_menus)
                                                       		->first();
                $data['edit_sub_menus'] = $get_sub_menus;
                $id_sub_menus 			= $get_sub_menus->menus_id;
                $data['lihat_menus']	= \App\Models\Master_menu::where('id_menus',$id_sub_menus)
                											->first();
                return view('dashboard.menu.sub_menu_edit',$data);
            }
            else
                return redirect('dashboard/menu');
        }
        else
            return redirect('dashboard/menu');
    }

    public function prosesedit_submenu($id_menus=0, Request $request)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'edit') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
                $aturan = [
                    'icon_menus'        => 'required',
                    'nama_menus'        => 'required',
                    'link_menus'        => 'required',
                    'nama_fiturs.0'     => 'required',
                ];
                $error_pesan = [
                    'icon_menus.required'           => 'Form Icon Harus Diisi.',
                    'nama_menus.required'           => 'Form Nama Harus Diisi.',
                    'link_menus.required'           => 'Form Link Harus Diisi.',
                    'nama_fiturs.0.required'        => 'Form Nama Fitur Harus Diisi.',
                ];
                $this->validate($request, $aturan, $error_pesan);

            	$data = [
                    'icon_menus' => $request->icon_menus,
                    'nama_menus' => $request->nama_menus,
                    'link_menus' => $request->link_menus,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            	$prosesedit = \App\Models\Master_menu::where('id_menus', $id_menus)
                                               ->update($data);
                $proseshapus = \App\Models\Master_fitur::where('menus_id',$id_menus)
                								->delete();
                foreach($request->nama_fiturs as $nama_fiturs)
        		{
        			$fitur_data = [
        	            'nama_fiturs'   => $nama_fiturs,
        	            'menus_id' 		=> $id_menus,
                        'updated_at'    => date('Y-m-d H:i:s')
        	        ];
        			\App\Models\Master_fitur::insert($fitur_data);
        		}

            	if(request()->session()->get('halaman2') != '')
                    $redirect_halaman    = request()->session()->get('halaman2');
                else
                {
                	$get_menus 		= \App\Models\Master_menu::where('id_menus',$id_menus)->first();
                	$get_id_menus 	= $get_menus->menus_id;
                    $redirect_halaman  = 'dashboard/menu/submenu/'.$get_id_menus;
                }
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/menu');
        }
        else
            return redirect('dashboard/menu');
    }

    public function hapus_submenu($id_menus=0)
    {
        $link_menu = 'menu';
        if(General::hakAkses($link_menu,'hapus') == 'true')
        {
            $cek_menus = \App\Models\Master_menu::where('id_menus',$id_menus)->count();
            if($cek_menus != 0)
            {
                \App\Models\Master_akses::join('master_fiturs','fiturs_id','=','master_fiturs.id_fiturs')
                                        ->where('menus_id',$id_menus)
                                        ->delete();
                \App\Models\Master_fitur::where('menus_id',$id_menus)->delete();
                \App\Models\Master_menu::where('id_menus',$id_menus)->delete();
               return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/menu');
        }
        else
            return redirect('dashboard/menu');
    }
}