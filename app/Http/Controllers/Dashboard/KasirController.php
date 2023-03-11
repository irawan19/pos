<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use General;
use Auth;
use Storage;

class KasirController extends AdminCoreController
{

    public function index(Request $request)
    {
        if(Auth::user()->tokos_id == null)
        {
            $data['tambah_tokos']   = \App\Models\Master_toko::orderBy('nama_tokos')
                                                            ->get();
            $data['tambah_pembayarans'] = \App\Models\MAster_pembayaran::orderBy('nama_pembayarans')
                                                                        ->get();
        }
        else
        {
            $data['tambah_tokos']   = \App\Models\Master_toko::where('id_tokos',Auth::user()->tokos_id)
                                                            ->orderBy('nama_tokos')
                                                            ->get();
            $data['tambah_pembayarans'] = \App\Models\MAster_pembayaran::orderBy('nama_pembayarans')
                                                                        ->get();
        }
        $data['tambah_customers']   = \App\Models\Master_customer::orderBy('nama_customers')
                                                                ->get();
        return view('dashboard.kasir.lihat',$data);
    }

}