<?php

use App\Models\Calender;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OperatorController;

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


/*
|--------------------------------------------------------------------------
| Route Guest
|--------------------------------------------------------------------------*/

Route::get('/login', [LoginController::class, 'indexLogin'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'Logout']);

/*
|-------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| Route Auth
|--------------------------------------------------------------------------*/

Route::get('', [HomeController::class, 'index'])->middleware('auth');
Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/cartview', [HomeController::class, 'cartview'])->name('cartview')->middleware('auth');
Route::post('/cartplus', [HomeController::class, 'cartplus'])->name('cartplus')->middleware('auth');
Route::get('/total', [HomeController::class, 'total'])->name('total')->middleware('auth');
Route::post('/updateqty', [HomeController::class, 'updateqty'])->middleware('auth');
Route::post('/itemdel', [HomeController::class, 'itemdel'])->name('itemdel')->middleware('auth');
// checkout
Route::get('/cartitem', [HomeController::class, 'cartitem']);
Route::get('/checkresult', [CheckoutController::class, 'index'])->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'makeCheckout'])->middleware('auth');
Route::get('/print', [CheckoutController::class, 'printer'])->middleware('auth');


// route category
Route::get('/category', [CategoryController::class, 'index'])->middleware('auth');
Route::resource('/category', CategoryController::class)->except('show')->middleware('auth');

//route makanan
Route::get('/makanan', [MakananController::class, 'index'])->middleware('auth');
Route::resource('/makanan', MakananController::class)->middleware('auth');

//Route Penjualan Cart
// Route::resource('/cart', CartController::class)->middleware('auth');
// Route::post('/updateqty/{Cart:id}', [CartController::class, 'updateqty'])->middleware('auth');
Route::post('/deletecart', [CartController::class, 'deletecart'])->middleware('auth');
// Route::post('/deletelist/{Cart:id}', [CartController::class, 'deletelist'])->middleware('auth');
//Route Checkout


/*
|-------------------------------------------------------------------------
*/




/*
|--------------------------------------------------------------------------
| Route isAdmin
|--------------------------------------------------------------------------*/

// Route Operator
Route::resource('/operator', OperatorController::class)->middleware(['isAdmin', 'auth']);
Route::get('/changepass/{operator:id}', [OperatorController::class, 'changepassindex'])->middleware(['isAdmin', 'auth']);
Route::post('/change/{user:id}', [OperatorController::class, 'changepass'])->middleware(['isAdmin', 'auth']);

//Route Laporan
Route::get('/laporan', [LaporanController::class, 'index'])->middleware(['isAdmin', 'auth']);
Route::get('/laporan/semua', [LaporanController::class, 'semua'])->middleware(['isAdmin', 'auth']);
//Route Laporan 
Route::get('/laporan/harian', [LaporanController::class, 'day'])->middleware(['isAdmin', 'auth']);
Route::get('/laporan/bulanan', [LaporanController::class, 'month'])->middleware(['isAdmin', 'auth']);
Route::get('/laporan/tahunan', [LaporanController::class, 'year'])->middleware(['isAdmin', 'auth']);

// Route::get('/laporan/Mingguan')
Route::post('/pilihbulan', [LaporanController::class, 'pilihbulan'])->middleware(['isAdmin', 'auth']);
Route::post('/hari', [LaporanController::class, 'pilihhari'])->middleware(['isAdmin', 'auth']);
Route::get('/filter', [LaporanController::class, 'filter'])->middleware(['isAdmin', 'auth']);
Route::get('/show/{checkout:id}', [LaporanController::class, 'show'])->middleware(['isAdmin', 'auth']);
Route::get('/back', [LaporanController::class, 'back'])->middleware(['isAdmin', 'auth']);
 //

/*
|-------------------------------------------------------------------------
*/








// Route::group(['middleware' => ['isAdmin']], 
// 	function () {
//   	Route::get('/register', [RegisterController::class,'indexRegister']);
//   	Route::post('/register', [RegisterController::class,'Register']);
//  	});