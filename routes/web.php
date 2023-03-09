<?php

use Illuminate\Support\Facades\Route;

//Beranda
use App\Http\Controllers\BerandaController as Beranda;

//Dashboard
use App\Http\Controllers\Dashboard\DashboardController as Dashboard;

//Konfigurasi Profil
use App\Http\Controllers\Dashboard\KonfigurasiProfilController as DashboardKonfigurasiProfil;

//Konfigurasi Akun
use App\Http\Controllers\Dashboard\KonfigurasiAkunController as DashboardKonfigurasiAkun;

//Master Data
use App\Http\Controllers\Dashboard\TokoController as DashboardToko;
use App\Http\Controllers\Dashboard\SatuanController as DashboardSatuan;
use App\Http\Controllers\Dashboard\KategoriItemController as DashboardKategoriItem;
use App\Http\Controllers\Dashboard\ItemController as DashboardItem;
use App\Http\Controllers\Dashboard\PembayaranController as DashboardPembayaran;

//Transaksi
use App\Http\Controllers\Dashboard\CustomerController as DashboardCustomer;
use App\Http\Controllers\Dashboard\SupplierController as DashboardSupplier;
use App\Http\Controllers\Dashboard\PembelianController as DashboardPembelian;

//Laporan
use App\Http\Controllers\Dashboard\LaporanPenjualanController as DashboardLaporanPenjualan;
use App\Http\Controllers\Dashboard\LaporanPembelianController as DashboardLaporanPembelian;
use App\Http\Controllers\Dashboard\LaporanStokController as DashboardLaporanStok;
use App\Http\Controllers\Dashboard\LaporanKeuanganController as DashboardLaporanKeuangan;


//Konfigurasi Aplikasi
use App\Http\Controllers\Dashboard\MenuController as DashboardMenu;
use App\Http\Controllers\Dashboard\LevelSistemController as DashboardLevelSistem;
use App\Http\Controllers\Dashboard\AdminController as DashboardAdmin;
use App\Http\Controllers\Dashboard\KonfigurasiAplikasiController as DashboardKonfigurasiAplikasi;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Beranda::class, 'index']);
Route::post('/kirimpesan', [Beranda::class, 'kirimpesan']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::group(['prefix' => 'dashboard'], function (){
        //Dashboard
        Route::get('/', [Dashboard::class, 'index'])->name('dashboard');
        Route::get('/pesan', [Dashboard::class, 'pesan']);
        Route::get('/pesan/cari', [Dashboard::class, 'caripesan']);
        Route::get('/pesan/baca/{id}', [Dashboard::class, 'bacapesan']);

        //Konfigurasi Profil
        Route::group(['prefix' => 'konfigurasi_profil'], function(){
            Route::get('/', [DashboardKonfigurasiProfil::class, 'index']);
            Route::post('/prosesedit', [DashboardKonfigurasiProfil::class, 'prosesedit']);
        });

        //Konfigurasi Akun
        Route::group(['prefix' => 'konfigurasi_akun'], function() {
            Route::get('/', [DashboardKonfigurasiAkun::class, 'index']);
            Route::post('/prosesedit', [DashboardKonfigurasiAkun::class, 'prosesedit']);
        });

        //Master Data
            //Toko
            Route::group(['prefix' => 'toko'], function() {
                Route::get('/', [DashboardToko::class, 'index']);
                Route::get('/cari', [DashboardToko::class, 'cari']);
                Route::get('/tambah', [DashboardToko::class, 'tambah']);
                Route::post('/prosestambah', [DashboardToko::class, 'prosestambah']);
                Route::get('/edit/{id}', [DashboardToko::class, 'edit']);
                Route::post('/prosesedit/{id}', [DashboardToko::class, 'prosesedit']);
                Route::get('/hapus/{id}', [DashboardToko::class, 'hapus']);
            });
            
            //Satuan
            Route::group(['prefix' => 'satuan'], function() {
                Route::get('/', [DashboardSatuan::class, 'index']);
                Route::get('/cari', [DashboardSatuan::class, 'cari']);
                Route::get('/tambah', [DashboardSatuan::class, 'tambah']);
                Route::post('/prosestambah', [DashboardSatuan::class, 'prosestambah']);
                Route::get('/edit/{id}', [DashboardSatuan::class, 'edit']);
                Route::post('/prosesedit/{id}', [DashboardSatuan::class, 'prosesedit']);
                Route::get('/hapus/{id}', [DashboardSatuan::class, 'hapus']);
            });

            //Kategori Item
            Route::group(['prefix' => 'kategori_item'], function() {
                Route::get('/', [DashboardKategoriItem::class, 'index']);
                Route::get('/cari', [DashboardKategoriItem::class, 'cari']);
                Route::get('/tambah', [DashboardKategoriItem::class, 'tambah']);
                Route::post('/prosestambah', [DashboardKategoriItem::class, 'prosestambah']);
                Route::get('/edit/{id}', [DashboardKategoriItem::class, 'edit']);
                Route::post('/prosesedit/{id}', [DashboardKategoriItem::class, 'prosesedit']);
                Route::get('/hapus/{id}', [DashboardKategoriItem::class, 'hapus']);
            });

            //Item
            Route::group(['prefix' => 'item'], function() {
                Route::get('/', [DashboardItem::class, 'index']);
                Route::get('/cari', [DashboardItem::class, 'cari']);
                Route::get('/tambah', [DashboardItem::class, 'tambah']);
                Route::post('/prosestambah', [DashboardItem::class, 'prosestambah']);
                Route::get('/baca/{id}', [DashboardItem::class, 'baca']);
                Route::get('/edit/{id}', [DashboardItem::class, 'edit']);
                Route::post('/prosesedit/{id}', [DashboardItem::class, 'prosesedit']);
                Route::get('/hapus/{id}', [DashboardItem::class, 'hapus']);
                Route::get('/cetakbarcode/{id}', [DashboardItem::class, 'cetakbarcode']);
            });

            //Pembayaran
            Route::group(['prefix' => 'pembayaran'], function() {
                Route::get('/', [DashboardPembayaran::class, 'index']);
                Route::get('/cari', [DashboardPembayaran::class, 'cari']);
                Route::get('/tambah', [DashboardPembayaran::class, 'tambah']);
                Route::post('/prosestambah', [DashboardPembayaran::class, 'prosestambah']);
                Route::get('/edit/{id}', [DashboardPembayaran::class, 'edit']);
                Route::post('/prosesedit/{id}', [DashboardPembayaran::class, 'prosesedit']);
                Route::get('/hapus/{id}', [DashboardPembayaran::class, 'hapus']);
            });
        
        //Transaksi
            //Customer
            Route::group(['prefix' => 'customer'], function() {
                Route::get('/', [DashboardCustomer::class, 'index']);
                Route::get('/cari', [DashboardCustomer::class, 'cari']);
                Route::get('/tambah', [DashboardCustomer::class, 'tambah']);
                Route::post('/prosestambah', [DashboardCustomer::class, 'prosestambah']);
                Route::get('/edit/{id}', [DashboardCustomer::class, 'edit']);
                Route::post('/prosesedit/{id}', [DashboardCustomer::class, 'prosesedit']);
                Route::get('/hapus/{id}', [DashboardCustomer::class, 'hapus']);
            });

            //Supplier
            Route::group(['prefix' => 'supplier'], function() {
                Route::get('/', [DashboardSupplier::class, 'index']);
                Route::get('/cari', [DashboardSupplier::class, 'cari']);
                Route::get('/tambah', [DashboardSupplier::class, 'tambah']);
                Route::post('/prosestambah', [DashboardSupplier::class, 'prosestambah']);
                Route::get('/edit/{id}', [DashboardSupplier::class, 'edit']);
                Route::post('/prosesedit/{id}', [DashboardSupplier::class, 'prosesedit']);
                Route::get('/hapus/{id}', [DashboardSupplier::class, 'hapus']);
            });

            //Pembelian
            Route::group(['prefix' =>  'pembelian'], function() {
                Route::get('/', [DashboardPembelian::class, 'index']);
                Route::get('/cari', [DashboardPembelian::class, 'cari']);
                Route::get('/tambah', [DashboardPembelian::class, 'tambah']);
                Route::post('/prosestambah', [DashboardPembelian::class, 'prosestambah']);
                Route::get('/baca/{id}', [DashboardPembelian::class, 'baca']);
                Route::get('/edit/{id}', [DashboardPembelian::class, 'edit']);
                Route::post('/prosesedit/{id}', [DashboardPembelian::class, 'prosesedit']);
                Route::get('/hapus/{id}', [DashboardPembelian::class, 'hapus']);
                Route::get('/listitem/{id}', [DashboardPembelian::class, 'listitem']);
            });

        //Laporan
            //Penjualan
            Route::group(['prefix' => 'laporan_penjualan'], function() {
                Route::get('/', [DashboardLaporanPenjualan::class, 'index']);
                Route::get('/cari', [DashboardLaporanPenjualan::class, 'cari']);
                Route::get('/baca/{id}', [DashboardLaporanPenjualan::class, 'baca']);
                Route::get('/cetakexcel', [DashboardLaporanPenjualan::class, 'cetakexcel']);
            });

            //Pembelian
            Route::group(['prefix' => 'laporan_pembelian'], function() {
                Route::get('/', [DashboardLaporanPembelian::class, 'index']);
                Route::get('/cari', [DashboardLaporanPembelian::class, 'cari']);
                Route::get('/cetakexcel', [DashboardLaporanPembelian::class, 'cetakexcel']);
                Route::get('/baca/{id}', [DashboardLaporanPembelian::class, 'baca']);
            });

            //Stok
            Route::group(['prefix' => 'laporan_stok'], function() {
                Route::get('/', [DashboardLaporanStok::class, 'index']);
                Route::get('/cari', [DashboardLaporanStok::class, 'cari']);
                Route::get('/cetakexcel', [DashboardLaporanStok::class, 'cetakexcel']);
                Route::get('/baca/{id}', [DashboardLaporanStok::class, 'baca']);
                Route::get('/baca/{id}/cari', [DashboardLaporanStok::class, 'caribaca']);
                Route::get('/baca/{id}/cetakexcel', [DashboardLaporanStok::class, 'cetakexcelbaca']);
            });

            //Keuangan
            Route::group(['prefix' => 'laporan_keuangan'], function() {
                Route::get('/', [DashboardLaporanKeuangan::class, 'index']);
                Route::get('/cari', [DashboardLaporanKeuangan::class, 'cari']);
                Route::get('/baca/{id}', [DashboardLaporanKeuangan::class, 'baca']);
                Route::get('/cetakexcel', [DashboardLaporanKeuangan::class, 'cetakexcel']);
            });

        //Konfigurasi Aplikasi
            //Menu
            Route::group(['prefix' => 'menu'], function () {
                Route::get('/', [DashboardMenu::class, 'index']);
                Route::get('/cari', [DashboardMenu::class, 'cari']);
                Route::get('/urutan', [DashboardMenu::class, 'urutan']);
                Route::post('/prosesurutan', [DashboardMenu::class, 'prosesurutan']);
                Route::get('/tambah', [DashboardMenu::class, 'tambah']);
                Route::post('/prosestambah', [DashboardMenu::class, 'prosestambah']);
                Route::get('/baca/{id}', [DashboardMenu::class, 'baca']);
                Route::get('/edit/{id}', [DashboardMenu::class, 'edit']);
                Route::post('/prosesedit/{id}', [DashboardMenu::class, 'prosesedit']);
                Route::get('/hapus/{id}', [DashboardMenu::class, 'hapus']);
                Route::get('/submenu/{id}', [DashboardMenu::class, 'submenu']);
                Route::get('/cari_submenu/{id}', [DashboardMenu::class, 'cari_submenu']);
                Route::get('/tambah_submenu/{id}', [DashboardMenu::class, 'tambah_submenu']);
                Route::post('/prosestambah_submenu/{id}', [DashboardMenu::class, 'prosestambah_submenu']);
                Route::get('/urutan_submenu/{id}', [DashboardMenu::class, 'urutan_submenu']);
                Route::get('/baca_submenu/{id}', [DashboardMenu::class, 'baca_submenu']);
                Route::get('/edit_submenu/{id}', [DashboardMenu::class, 'edit_submenu']);
                Route::post('/prosesedit_submenu/{id}', [DashboardMenu::class, 'prosesedit_submenu']);
                Route::get('/hapus_submenu/{id}', [DashboardMenu::class, 'hapus_submenu']);
            });

            //Level Sistem
            Route::group(['prefix' => 'level_sistem'], function () {
                Route::get('/', [DashboardLevelSistem::class, 'index']);
                Route::get('/cari', [DashboardLevelSistem::class, 'cari']);
                Route::get('/tambah', [DashboardLevelSistem::class, 'tambah']);
                Route::post('/prosestambah', [DashboardLevelSistem::class, 'prosestambah']);
                Route::get('/baca/{id}', [DashboardLevelSistem::class, 'baca']);
                Route::get('/edit/{id}', [DashboardLevelSistem::class, 'edit']);
                Route::post('/prosesedit/{id}', [DashboardLevelSistem::class, 'prosesedit']);
                Route::get('/hapus/{id}', [DashboardLevelSistem::class, 'hapus']);
            });

            //Admin
            Route::group(['prefix' => 'admin'], function () {
                Route::get('/', [DashboardAdmin::class, 'index']);
                Route::get('/cari', [DashboardAdmin::class, 'cari']);
                Route::get('/tambah', [DashboardAdmin::class, 'tambah']);
                Route::post('/prosestambah', [DashboardAdmin::class, 'prosestambah']);
                Route::get('/baca/{id}', [DashboardAdmin::class, 'baca']);
                Route::get('/edit/{id}', [DashboardAdmin::class, 'edit']);
                Route::post('/prosesedit/{id}', [DashboardAdmin::class, 'prosesedit']);
                Route::get('/hapus/{id}', [DashboardAdmin::class, 'hapus']);
            });

            //Konfigurasi Aplikasi
            Route::group(['prefix' => 'konfigurasi_aplikasi'], function () {
                Route::get('/', [DashboardKonfigurasiAplikasi::class, 'index']);
                Route::post('/prosesedit', [DashboardKonfigurasiAplikasi::class, 'prosesedit']);
                Route::post('/proseseditlogo', [DashboardKonfigurasiAplikasi::class, 'proseseditlogo']);
                Route::post('/prosesediticon', [DashboardKonfigurasiAplikasi::class, 'prosesediticon']);
                Route::post('/proseseditlogotext', [DashboardKonfigurasiAplikasi::class, 'proseseditlogotext']);
                Route::post('/proseseditbackgroundwebsite', [DashboardKonfigurasiAplikasi::class, 'proseseditbackgroundwebsite']);
            });

        //Logout
        Route::get('/logout', [Dashboard::class, 'logout']);
    });
});