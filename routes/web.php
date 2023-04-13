<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\GraphController;


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


Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::get('/show-map',[GraphController::class,'showMap']);

Route::middleware('auth')->group(function(){

    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('/barang', \App\Http\Controllers\BarangController::class);

    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('/customer', \App\Http\Controllers\CustomerController::class);

    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('/supplier', \App\Http\Controllers\SupplierController::class);

    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('/karyawan', \App\Http\Controllers\KaryawanController::class);

    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('/pelanggan', \App\Http\Controllers\PelangganController::class);

    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('/penjualan', \App\Http\Controllers\PenjualanController::class);

    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('/pembelian', \App\Http\Controllers\PembelianController::class);

});

Route::get('/logout', [CustomAuthController::class, 'signOut'])->name('logout');
Route::get('/', [CustomAuthController::class, 'home']);
Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('postlogin', [CustomAuthController::class, 'login'])->name('postlogin');
Route::get('signup', [CustomAuthController::class, 'signup'])->name('register-user');
Route::post('postsignup', [CustomAuthController::class, 'signupsave'])->name('postsignup');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.request');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('password.update');


// <?php

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CustomAuthController;


// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */
// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');


// Route::get('/logout', [CustomAuthController::class, 'signOut'])->name('logout');
// Route::get('/', [CustomAuthController::class, 'home']);
// Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
// Route::get('login', [CustomAuthController::class, 'index'])->name('login');
// Route::post('postlogin', [CustomAuthController::class, 'login'])->name('postlogin');
// Route::get('signup', [CustomAuthController::class, 'signup'])->name('register-user');
// Route::post('postsignup', [CustomAuthController::class, 'signupsave'])->name('postsignup');
// Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('/barang', \App\Http\Controllers\BarangController::class);

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('/customer', \App\Http\Controllers\CustomerController::class);

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('/supplier', \App\Http\Controllers\SupplierController::class);

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('/karyawan', \App\Http\Controllers\KaryawanController::class);

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('/pelanggan', \App\Http\Controllers\PelangganController::class);

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('/penjualan', \App\Http\Controllers\PenjualanController::class);

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('/pembelian', \App\Http\Controllers\PembelianController::class);

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.request');
// Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('password.update');
