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

// use Illuminate\Routing\Route;

use App\Banner;
use App\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;
// use Ramsey\Uuid\Uuid;

Route::get('/', 'HomeController@index');

Route::any('/province/{id}/cities', 'CheckoutController@getCities');
// Route::get('apicity', 'CheckoutController@gettown');


Auth::routes();

Route::group(['middleware' => ['auth', 'auth.admin']], function () {

    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::resource('orders', 'OrderController');
    Route::resource('banners', 'BannerController');
    Route::resource('dashboard', 'DashboardController');
    Route::get('/detail/{id}', 'OrderController@detail');
    Route::get('/peramalan', 'OrderController@peramalanproduk');
    Route::get('/peramalan/{slug}', 'OrderController@peramalan');
    Route::post('editProduct', 'ProductController@editProduct');
    Route::post('gantiFotoProduk', 'ProductController@gantiFotoProduk');
    Route::get('verifikasiOrder/{id}', 'OrderController@verifikasiOrder');
    Route::post('batalOrder', 'OrderController@batalOrder');
    Route::get('getproduk', [
        'uses' => 'ProductController@getproduk',
        'as' => 'ajax.get.produk',
    ]);
    Route::get('getproduk', [
        'uses' => 'ProductController@getproduk',
        'as' => 'ajax.get.produk',
    ]);
    Route::get('getuser', [
        'uses' => 'UserController@getuser',
        'as' => 'ajax.get.user',
    ]);

    Route::get('getcategories', [
        'uses' => 'CategoryController@getcategories',
        'as' => 'ajax.get.categories',
    ]);
    Route::get('getneworder', [
        'uses' => 'DashboardController@get_new_order',
        'as' => 'ajax.get.new_order',
    ]);
    Route::post('selesai', [
        'uses' => 'CheckoutController@selesai',
        'as' => 'selesai'
    ]);

    Route::get('new_order', 'DashboardController@new_order');
    // Route::get('cost', 'DashboardController@cost');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', 'HomeController@cart')->name('cart.index');
    Route::post('/shop/{id}', 'OrderController@simpan');
    Route::post('/hapuscart/{id}', 'HomeController@hapuscart');
    Route::resource('cart', 'CartController');
    Route::get('/hapus-cart/{id}/{user_id}', 'CartController@hapusItem');
    Route::get('kembali', 'HomeController@kembali');
    Route::get('empty', function () {
        Cart::destroy();
    });
    Route::resource('checkout', 'CheckoutController');
    Route::post('/cekOngkir', 'CheckoutController@getPembayaran');
    Route::get('/ongkir', 'CheckoutController@ongkir');
    Route::post('/biaya/{id}', 'CheckoutController@costOngkir');
    Route::get('/pembelian/{id}', 'OrderController@cekPembayaran');
    Route::get('/pembayaran/{id}', 'OrderController@pembayaranId');
    Route::get('/pembayaran', [
        'uses' => 'CheckoutController@pembayaran',
        'as' => 'pembayaran'
    ]);
    Route::get('/terimakasih', [
        'uses' => 'CheckoutController@terimakasih',
        'as' => 'terimakasih'
    ]);

    Route::get('testiModal/{id}', [
        'uses' => 'HomeController@testiModal',
    ]);

    Route::get('thanks', function () {
        return view('terimakasih');
    });
    Route::get('profile', 'UserController@profile');
    Route::get('testi/{id}/{rating}', 'HomeController@testi');

    Route::post('gantiFoto', 'UserController@gantiFoto');
    Route::post('editProfile', 'UserController@editProfile');
    Route::resource('users', 'UserController');
});





// Route::get('/detail', 'HomeController@detail');
Route::get('/show/{id}', 'HomeController@show');
Route::get('/belanja/{id}', 'HomeController@kategori');
Route::get('/belanja', [
    'uses' => 'HomeController@shop',
    'as' => 'belanja'
]);




// Route::get('/belanja', function(){
//     $products = \App\Product::all();
//     return view('shop', compact('products'))->with(['banners' => Banner::all(), 'categories' => Category::all()]);
// });

//dashboard
