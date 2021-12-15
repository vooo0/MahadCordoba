<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Middleware\LoginLevel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/', function () { return view('user.auth.login'); })->name('login');
// Route::get('/login', function () { return view('user.auth.login'); })->name('login');
Route::get('auth/register', function () { return view('user.auth.register'); })->name('register');

Route::post('/register', 'Admin\PendaftaranController@storeSiswa')->name('daftarBaru');

// Route::get('login', function () { return view('user.auth.login'); })->name('login');

// Route::group(['prefix' => 'auth'], function(){
    // Route::post('login', 'Auth\LoginController');
    // Route::post('logout', 'Auth\LoginController');
// });

Route::group(['prefix' => 'admin', 'middleware' => 'AdminUmum'], function(){
    Route::resource('/', 'Admin\DashboardController');
    Route::get('/', 'Admin\DashboardController@dashboard')->name('admin.dashboard');
    Route::resource('profile', 'Admin\ProfileController');
    Route::post('pendaftaran/print/', 'Admin\PendaftaranController@pdf')->name('admin.pdf');
    Route::resource('pendaftaran', 'Admin\PendaftaranController');
    Route::resource('dataAdmin', 'Admin\AdminController');
    Route::resource('dataGuru', 'Admin\GuruController');
    Route::resource('dataKelas', 'Admin\KelasController');
    Route::post('dataKelas/kelasSiswa', 'Admin\KelasController@storeKelasSiswa')->name('kelasSiswa.store');
    Route::resource('dataSiswa', 'Admin\SiswaController');
    Route::resource('dataMatapelajaran', 'Admin\MatapelajaranController');
});

Route::group(['prefix' => 'keuangan', 'middleware' => 'AdminKeuangan'], function(){
    Route::resource('/', 'Keuangan\DashboardController');
    Route::get('/', 'Keuangan\DashboardController@dashboard')->name('keuangan.dashboard');
    Route::post('pemasukkan/print/', 'Keuangan\PemasukkanController@pdf')->name('pemasukkan.pdf');
    Route::resource('pemasukkan', 'Keuangan\PemasukkanController');
    Route::post('pengeluaran/print/', 'Keuangan\PengeluaranController@pdf')->name('pengeluaran.pdf');
    Route::resource('pengeluaran', 'Keuangan\PengeluaranController');
    Route::post('gaji/print/', 'Keuangan\GajiController@pdf')->name('gajiKeuangan.pdf');
    Route::resource('gaji', 'Keuangan\GajiController');
    Route::get('gaji/guru/{id}/edit', 'Keuangan\GajiController@edit')->name('gajiGuru.edit');
    Route::get('gaji/admin/{id}/show', 'Keuangan\GajiController@show')->name('gajiAdmin.show');
    Route::post('gajiGuru', 'Keuangan\GajiController@gajiGuru')->name('gaji.gajiGuru');
    Route::post('gajiAdmin', 'Keuangan\GajiController@gajiAdmin')->name('gaji.gajiAdmin');
    Route::post('pembayaran/print/', 'Keuangan\PembayaranController@pdf')->name('pembayaranKeuangan.pdf');
    Route::resource('pembayaran', 'Keuangan\PembayaranController');
    Route::get('pembayaran', 'Keuangan\PembayaranController@index')->name('pembayaranKeuangan.index');
    Route::post('pembayaran/store', 'Keuangan\PembayaranController@store')->name('pembayaranSiswa.store');
    Route::post('labarugi/print/', 'Keuangan\LabarugiController@pdf')->name('labarugi.pdf');
    Route::resource('labaRugi', 'Keuangan\LabarugiController');
    Route::post('labaRugi', 'Keuangan\LabarugiController@getMonth')->name('labaRugi.getMonth');
    Route::post('labaRugi/{id}', 'Keuangan\LabarugiController@updateThisMonth')->name('labaRugi.updateThisMonth');
});

Route::group(['prefix' => 'guru', 'middleware' => 'Guru'], function(){
    Route::resource('/', 'Guru\DashboardController');
    Route::get('/', 'Guru\DashboardController@dashboard')->name('guru.dashboard');
    Route::resource('matapelajaran', 'Guru\MatapelajaranController');
    Route::get('matapelajaran/{id}/show', 'Guru\MatapelajaranController@show')->name('matapelajaranGuru.show');
    Route::get('matapelajaran/{id}/edit', 'Guru\MatapelajaranController@edit')->name('matapelajaranGuru.edit');
    Route::resource('nilai', 'Guru\NilaiController');
    Route::resource('tugas', 'Guru\TugasController');
    Route::resource('rapot', 'Guru\NilaiController');
    Route::resource('gaji', 'Guru\GajiController');
    Route::resource('pengumuman', 'Guru\PengumumanController');
});

Route::group(['prefix' => 'siswa', 'middleware' => 'Siswa'], function(){
    Route::resource('/', 'Siswa\DashboardController');
    Route::get('/', 'Siswa\DashboardController@dashboard')->name('siswa.dashboard');
    Route::resource('matapelajaran', 'Siswa\MatapelajaranController');
    Route::post('matapelajaran', 'Siswa\MatapelajaranController@tugasSiswa')->name('kumpulTugas');
    Route::resource('pembayaran', 'Siswa\PembayaranController');
    Route::get('tugas', function () { return view('siswa.tugas.index'); });
});

Route::group(['prefix' => 'user'], function(){
    Route::get('profile', function () { return view('pages.general.profile'); });
});

Route::get('blog', function () { return view('pages.error.404'); });


Route::group(['prefix' => 'error'], function(){
    Route::get('404', function () { return view('pages.error.404'); });
    Route::get('500', function () { return view('pages.error.500'); });
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('pages.error.404');
})->where('page','.*');

