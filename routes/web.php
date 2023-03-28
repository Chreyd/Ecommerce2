<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});


//  Products Routes
Route::get('/boutique', [ProductController::class,'index'])->name('products.index');
Route::get('/boutique/{slug}', [ProductController::class,'show'])->name('products.show');
Route::get('/search', [ProductController::class,'search'])->name('products.search');

Route::group(['middleware' => ['auth']], function(){

    //  Cart Routes
    Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
    Route::post('/panier/ajouter', [CartController::class,'store'])->name('cart.store');
    // Route::get('/videpanier',function(){
    //     Cart::destroy();
    // });
    Route::delete('/panier/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::patch('/panier/{rowId}',[CartController::class, 'update'])->name('cart.update');

});



Route::group(['middleware' => ['auth']], function(){

    //Checkout Routes
    Route::get('/paiement', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/paiement', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/merci', [CheckoutController::class, 'thankYou'])->name('checkout.thankYou');

});



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
