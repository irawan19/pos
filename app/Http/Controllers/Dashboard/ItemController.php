<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;
use Storage;

class ItemController extends AdminCoreController
{

    public function index(Request $request)
    {
        $link_item = 'item';
        if(General::hakAkses($link_item,'lihat') == 'true')
        {
            $data['link_item']              = $link_item;
            $data['hasil_kata']             = '';
            $url_sekarang                   = $request->fullUrl();
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_items']        = \App\Models\Master_item::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                    ->paginate(10);
            }
            else
            {
                $data['lihat_items']        = \App\Models\Master_item::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                    ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                    ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                    ->where('tokos_id',Auth::user()->tokos_id)
                                                                    ->paginate(10);
            }
            session()->forget('halaman');
            session()->forget('hasil_kata');
            session(['halaman'              => $url_sekarang]);
        	return view('dashboard.item.lihat', $data);
        }
        else
            return redirect('dashboard');
    }

    public function cari(Request $request)
    {
        $link_item = 'item';
        if(General::hakAkses($link_item,'lihat') == 'true')
        {
            $data['link_item']              = $link_item;
            $url_sekarang                   = $request->fullUrl();
            $hasil_kata                     = $request->cari_kata;
            $data['hasil_kata']             = $hasil_kata;
            if(Auth::user()->tokos_id == null)
            {
                $data['lihat_items']            = \App\Models\Master_item::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                        ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                        ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                        ->where('nama_items', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->paginate(10);
            }
            else
            {
                $data['lihat_items']            = \App\Models\Master_item::join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                        ->join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                        ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                        ->where('nama_tokos', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('tokos_id',Auth::user()->tokos_id)
                                                                        ->orWhere('nama_kategori_items', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('tokos_id',Auth::user()->tokos_id)
                                                                        ->orWhere('nama_satuans', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('tokos_id',Auth::user()->tokos_id)
                                                                        ->orWhere('nama_satuans', 'LIKE', '%'.$hasil_kata.'%')
                                                                        ->where('tokos_id',Auth::user()->tokos_id)
                                                                        ->paginate(10);
            }
            session(['halaman'              => $url_sekarang]);
            session(['hasil_kata'		    => $hasil_kata]);
            return view('dashboard.item.lihat', $data);
        }
        else
            return redirect('dashboard/item');
    }

    public function tambah(Request $request)
    {
        $link_item = 'item';
        if(General::hakAkses($link_item,'tambah') == 'true')
        {  
            if(Auth::user()->tokos_id == null)
            {
                $data['tambah_tokos']           = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                            ->get();
            }
            else
            {
                $data['tambah_tokos']           = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->get();
            }
            $data['tambah_kategori_items']  = \App\Models\Master_kategori_item::orderBy('nama_kategori_items')
                                                                                ->get();
            $data['tambah_satuans']         = \App\Models\Master_satuan::orderBy('nama_satuans')
                                                                        ->get();
            return view('dashboard.item.tambah',$data);
        }
        else
            return redirect('dashboard/item');
    }

    public function prosestambah(Request $request)
    {
        $link_item = 'item';
        if(General::hakAkses($link_item,'tambah') == 'true')
        {
            $aturan = [
                'tokos_id'                              => 'required',
                'kategori_items_id'                     => 'required',
                'satuans_id'                            => 'required',
                'userfile_foto_item'                    => 'required|mimes:jpg,jpeg,png',
                'nama_items'                            => 'required',
                'kode_items'                            => 'required|unique:master_items',
                'harga_items'                           => 'required',
                'stock_items'                           => 'required',
            ];

            $error_pesan = [
                'tokos_id'                              => 'Form Toko Harus Diisi.',
                'kategori_items_id'                     => 'Form Kategori Item Harus Diisi.',
                'satuans_id'                            => 'Form Satuan Harus Diisi.',
                'userfile_foto_item.required'           => 'Form Foto Harus Diisi.',
                'nama_items.required'                   => 'Form Nama Harus Diisi.',
                'kode_items.required'                   => 'Form Kode Harus Diisi.',
                'kode_items.unique'                     => 'Kode Sudah Terdaftar.',
                'harga_items.required'                  => 'Form Harga Harus Diisi.',
                'stock_items.required'                  => 'Fkorm Stock Harus Diisi.',
            ];
            $this->validate($request, $aturan, $error_pesan);

            $nama_foto_item = date('Ymd').date('His').str_replace(')','',str_replace('(','',str_replace(' ','-',$request->file('userfile_foto_item')->getClientOriginalName())));
            $path_foto_item = 'item/';
            Storage::disk('public')->put($path_foto_item.$nama_foto_item, file_get_contents($request->file('userfile_foto_item')));

            $deskripsi_items = '';
            if(!empty($request->deskripsi_items))
                $deskripsi_items = $request->deskripsi_items;

            $items_data = [
                'tokos_id'                              => $request->tokos_id,
                'kategori_items_id'                     => $request->kategori_items_id,
                'satuans_id'                            => $request->satuans_id,
                'foto_items'                            => $path_foto_item.$nama_foto_item,
                'nama_items'                            => $request->nama_items,
                'kode_items'                            => $request->kode_items,
                'harga_items'                           => General::ubahHargaKeDB($request->harga_items),
                'stock_items'                           => $request->stock_items,
                'deskripsi_items'                       => $deskripsi_items,
                'created_at'                            => date('Y-m-d H:i:s'),
            ];
            $id_items = \App\Models\Master_item::insertGetId($items_data);

            $simpan           = $request->simpan;
            $simpan_kembali   = $request->simpan_kembali;
            if($simpan)
            {
                $setelah_simpan = [
                    'alert'  => 'sukses',
                    'text'   => 'Data berhasil ditambahkan',
                ];
                return redirect()->back()->with('setelah_simpan', $setelah_simpan)->withInput($request->all());;
            }
            if($simpan_kembali)
            {
                if(request()->session()->get('halaman') != '')
                    $redirect_halaman  = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/item';

                return redirect($redirect_halaman);
            }
        }
        else
            return redirect('dashboard/item');
    }

    public function baca($id_items=0)
    {
        $link_item = 'item';
        if(General::hakAkses($link_item,'edit') == 'true')
        {
            $cek_items = \App\Models\Master_item::where('id_items',$id_items)->count();
            if($cek_items != 0)
            {
                $data['baca_items'] = \App\Models\Master_item::join('master_kategori_items','kategori_items_id','=','master_kategori_items.id_kategori_items')
                                                                ->join('master_satuans','satuans_id','=','master_satuans.id_satuans')
                                                                ->join('master_tokos','tokos_id','=','master_tokos.id_tokos')
                                                                ->where('id_items',$id_items)
                                                                ->first();
                return view('dashboard.item.baca',$data);
            }
            else
                return redirect('dashboard/item');
        }
        else
            return redirect('dashboard/item');
    }

    public function edit($id_items=0)
    {
        $link_item = 'item';
        if(General::hakAkses($link_item,'edit') == 'true')
        {
            $cek_items = \App\Models\Master_item::where('id_items',$id_items)->first();
            if(!empty($cek_items))
            {
                if(Auth::user()->tokos_id == null)
                {
                    $data['edit_tokos']         = \App\Models\Master_toko::orderBy('nama_tokos')
                                                                        ->get();
                }
                else
                {
                    $data['edit_tokos']         = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                                        ->get();
                }
                $data['edit_kategori_items']    = \App\Models\Master_kategori_item::orderBy('nama_kategori_items')
                                                                                    ->get();
                $data['edit_satuans']           = \App\Models\Master_satuan::orderBy('nama_satuans')
                                                                            ->get();
                $data['edit_items']             = $cek_items;
                return view('dashboard.item.edit',$data);
            }
            else
                return redirect('dashboard/item');
        }
        else
            return redirect('dashboard/item');
    }

    public function prosesedit($id_items=0, Request $request)
    {
        $link_item = 'item';
        if(General::hakAkses($link_item,'edit') == 'true')
        {
            $cek_items = \App\Models\Master_item::where('id_items',$id_items)->first();
            if(!empty($cek_items))
            {
                if(!empty($request->userfile_foto_item))
                {
                    $aturan = [
                        'tokos_id'                              => 'required',
                        'kategori_items_id'                     => 'required',
                        'satuans_id'                            => 'required',
                        'userfile_foto_item'                    => 'required|mimes:jpg,jpeg,png',
                        'nama_items'                            => 'required',
                        'kode_items'                            => 'required|unique:master_items,kode_items,'.$id_items.',id_items',
                        'harga_items'                           => 'required',
                        'stock_items'                           => 'required',
                    ];
        
                    $error_pesan = [
                        'tokos_id'                              => 'Form Toko Harus Diisi.',
                        'kategori_items_id'                     => 'Form Kategori Item Harus Diisi.',
                        'satuans_id'                            => 'Form Satuan Harus Diisi.',
                        'userfile_foto_item.required'           => 'Form Foto Harus Diisi.',
                        'nama_items.required'                   => 'Form Nama Harus Diisi.',
                        'kode_items.required'                   => 'Form Kode Harus Diisi.',
                        'kode_items.unique'                     => 'Kode Sudah Terdaftar.',
                        'harga_items.required'                  => 'Form Harga Harus Diisi.',
                        'stock_items.required'                  => 'Fkorm Stock Harus Diisi.',
                    ];
                    $this->validate($request, $aturan, $error_pesan);

                    $foto_item_lama        = $cek_items->foto_items;
                    if (Storage::disk('public')->exists($foto_item_lama))
                        Storage::disk('public')->delete($foto_item_lama);
        
                    $nama_foto_item = date('Ymd').date('His').str_replace(')','',str_replace('(','',str_replace(' ','-',$request->file('userfile_foto_item')->getClientOriginalName())));
                    $path_foto_item = 'item/';
                    Storage::disk('public')->put($path_foto_item.$nama_foto_item, file_get_contents($request->file('userfile_foto_item')));
        
                    $deskripsi_items = '';
                    if(!empty($request->deskripsi_items))
                        $deskripsi_items = $request->deskripsi_items;

                    $items_data = [
                        'tokos_id'                              => $request->tokos_id,
                        'kategori_items_id'                     => $request->kategori_items_id,
                        'satuans_id'                            => $request->satuans_id,
                        'foto_items'                            => $path_foto_item.$nama_foto_item,
                        'nama_items'                            => $request->nama_items,
                        'kode_items'                            => $request->kode_items,
                        'harga_items'                           => General::ubahHargaKeDB($request->harga_items),
                        'stock_items'                           => $request->stock_items,
                        'deskripsi_items'                       => $deskripsi_items,
                        'updated_at'                            => date('Y-m-d H:i:s'),
                    ];
                }
                else
                {
                    $aturan = [
                        'tokos_id'                              => 'required',
                        'kategori_items_id'                     => 'required',
                        'satuans_id'                            => 'required',
                        'nama_items'                            => 'required',
                        'kode_items'                            => 'required|unique:master_items,kode_items,'.$id_items.',id_items',
                        'harga_items'                           => 'required',
                        'stock_items'                           => 'required',
                    ];
        
                    $error_pesan = [
                        'tokos_id'                              => 'Form Toko Harus Diisi.',
                        'kategori_items_id'                     => 'Form Kategori Item Harus Diisi.',
                        'satuans_id'                            => 'Form Satuan Harus Diisi.',
                        'nama_items.required'                   => 'Form Nama Harus Diisi.',
                        'kode_items.required'                   => 'Form Kode Harus Diisi.',
                        'kode_items.unique'                     => 'Kode Sudah Terdaftar.',
                        'harga_items.required'                  => 'Form Harga Harus Diisi.',
                        'stock_items.required'                  => 'Fkorm Stock Harus Diisi.',
                    ];
                    $this->validate($request, $aturan, $error_pesan);
        
                    $deskripsi_items = '';
                    if(!empty($request->deskripsi_items))
                        $deskripsi_items = $request->deskripsi_items;

                    $items_data = [
                        'tokos_id'                              => $request->tokos_id,
                        'kategori_items_id'                     => $request->kategori_items_id,
                        'satuans_id'                            => $request->satuans_id,
                        'nama_items'                            => $request->nama_items,
                        'kode_items'                            => $request->kode_items,
                        'harga_items'                           => General::ubahHargaKeDB($request->harga_items),
                        'stock_items'                           => $request->stock_items,
                        'deskripsi_items'                       => $deskripsi_items,
                        'updated_at'                            => date('Y-m-d H:i:s'),
                    ];
                }
                \App\Models\Master_item::where('id_items',$id_items)
                                            ->update($items_data);

                if(request()->session()->get('halaman') != '')
                    $redirect_halaman    = request()->session()->get('halaman');
                else
                    $redirect_halaman  = 'dashboard/item';
                
                return redirect($redirect_halaman);
            }
            else
                return redirect('dashboard/item');
        }
        else
            return redirect('dashboard/item');
    }

    public function hapus($id_items=0)
    {
        $link_item = 'item';
        if(General::hakAkses($link_item,'hapus') == 'true')
        {
            $cek_items = \App\Models\Master_item::where('id_items',$id_items)->first();
            if(!empty($cek_items))
            {
                \App\Models\Master_item::where('id_items',$id_items)
                                        ->delete();
                return response()->json(["sukses" => "sukses"], 200);
            }
            else
                return redirect('dashboard/item');
        }
        else
            return redirect('dashboard/item');
    }

    public function cetakbarcode($id_items=0)
    {
        $link_item = 'item';
        if(General::hakAkses($link_item,'cetak') == 'true')
        {
            $cek_items = \App\Models\Master_item::where('id_items',$id_items)
                                        ->first();
            if(!empty($cek_items))
            {
                $data['lihat_items']  = $cek_items;
                return view('dashboard.item.cetak_barcode',$data);
            }
            else
                return redirect('dashboard/item');
        }
        else
            return redirect('dashboard/item');
    }

}