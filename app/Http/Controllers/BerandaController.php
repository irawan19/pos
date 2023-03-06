<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use General;

class BerandaController extends Controller
{

    public function index()
    {
        return view('beranda');    
    }

}