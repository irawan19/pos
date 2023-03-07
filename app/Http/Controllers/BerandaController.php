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

}