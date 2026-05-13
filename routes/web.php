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
Route::prefix('admin')->group(function() {

    Route::middleware('auth:admin')->group(function() {
        // Dashboard
        Route::get('/', 'DashboardController@index');

        // Products
        Route::resource('/koleksi','KoleksiController');
        Route::resource('/news','NewsController');
        Route::resource('/event','EventController');

        // Logout
        Route::get('/logout','AdminUserController@logout');
        Route::get('/kritik', [ 'as' => 'kritik', 'uses' => 'DashboardController@indexKritik' ]);
        Route::get('/filterKritik', [ 'as' => 'kritik', 'uses' => 'DashboardController@filterKritik' ]);
        Route::post('/updatekritik', [ 'as' => 'kritik', 'uses' => 'DashboardController@updateKritik' ]);
    });

    // Admin Login
    Route::get('/login', 'AdminUserController@index');
    Route::post('/login', [ 'as' => 'login', 'uses' => 'AdminUserController@store' ]);
    Route::get('/registering', [ 'as' => 'registering', 'uses' => 'AdminUserController@indexregister' ]);
    Route::post('/registerpost', 'AdminUserController@create');
    Route::post('/updatepass', [ 'as' => 'updatepass', 'uses' => 'AdminUserController@updatepass' ]);
    Route::post('/updatedark', [ 'as' => 'updatedark', 'uses' => 'AdminUserController@updatedark' ]);
    
});

/* User Controller */
Route::get('/', 'Front\HomeController@index');
Route::get('/lantai_bawah', 'Front\HomeController@lantai_bawah');
Route::get('/lantai_atas', 'Front\HomeController@lantai_atas');
Route::get('/berita', 'Front\NewsController@index');
Route::get('/event', 'Front\EventController@index');

Route::view('/gallery.html', 'front/info/gallery');

Route::view('/tentang', 'front/about/tentang');

Route::view('/alamat', 'front/kunjungan/alamat');
Route::view('/denah', 'front/kunjungan/denah');
Route::view('/fasilitas', 'front/kunjungan/fasilitas');
Route::view('/tiket', 'front/kunjungan/tiket');
Route::view('/waktu', 'front/kunjungan/waktu');


/* ============================================  ADMIN  ============================================= */
Route::post('/dashboardedit', 'DashboardController@store');
Route::get('/koleksi/print', 'KoleksiController@print');
Route::get('/news/print', 'NewsController@print');
Route::get('/event/print', 'EventController@print');
Route::post('/admin/edit/{id}', 'AdminUserController@updatenormaladmin');
Route::post('/admin/delete/{id}', 'AdminUserController@deletenormaladmin');
Route::get('/admin/print', 'DashboardController@printAdmin');

/* =============================================================================================== */

Route::get('/detail_koleksi/{id}', 'Front\HomeController@showKoleksi');
Route::get('/searchKoleksi', 'Front\HomeController@searchKoleksi');
Route::get('/detail_event/{id}', 'Front\HomeController@showEvent');
Route::get('/searchEvent', 'Front\EventController@search');
Route::get('/filterEvent', 'Front\EventController@filterDateEvent');
Route::get('/detail_berita/{id}', 'Front\HomeController@showBerita');
Route::get('/searchNews', 'Front\NewsController@search');
Route::get('/newNews', 'Front\NewsController@filterNew');
Route::get('/newEvent', 'Front\EventController@filterNew');
Route::get('/filterNews', 'Front\NewsController@filterDateNews');
Route::post('/createKritik','Front\HomeController@createKritik');