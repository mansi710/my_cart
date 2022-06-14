<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserShoppingController;

use App\Http\Controllers\AdminController;


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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');




//--------------------- ROLE WISED CHECKING  -----------------
// Route::get('/dashboard', function () {
//     return view('product.listOfProducts');
// })->middleware(['auth','user'])->name('xyz');


Route::get('listingPage',function(){
    return redirect()->route('userShopping');
})->middleware(['auth','user'])->name('listingPage');

// Route::get('/dashboard', function () {
//     return redirect()->route('categoryies.create');
// })->middleware(['auth','admin'])->name('admin_dashboard');


Route::get('/dashboard', function () {
    return redirect()->route('categoryies.index');
})->name('admin_dashboard');

Route::group(['prefix'=>'admin','middleware'=>['admin','auth']],function()
{
    Route::get('welcomeAdmin',[AdminController::class,'welcomeAdmin'])->name('welcomeAdmin');
    Route::resource('categoryies',CategoryController::class);
    Route::resource('products',ProductController::class);
    Route::get('showOrderList',[OrderController::class,'show_order_list'])->name('orders.list');
    Route::get('perticularOrderShow/{id}',[OrderController::class,'perticular_order_show'])->name('perticular_order_show');

    Route::get('get-data',[CategoryController::class,'getData'])->name('get');

    Route::get('get-product',[ProductController::class,'getProduct'])->name('getProduct');

    Route::get('get-order',[OrderController::class,'getOrder'])->name('getOrder');

    Route::get('deleteImg/{id}',[ProductController::class,'deleteImg'])->name('deleteImg');

    Route::post('updateProduct/{id}',[ProductController::class,'updateProduct'])->name('updateProduct');

});


Route::group(['prefix'=>'user','middleware'=>['user','auth']],function()
{
    Route::get('userShopping',[UserShoppingController::class,'index'])->name('userShopping');

    Route::get('add/carts',[UserShoppingController::class,'store_cart'])->name('add.carts');
    Route::get('show/carts',[UserShoppingController::class,'show_carts'])->name('show.carts');
    Route::get('order/checkout',[UserShoppingController::class,'checkout'])->name('order.checkout');
 
    Route::get('detailPage/{id}',[UserShoppingController::class,'show'])->name('detailPage');


    Route::get('show/products',[UserShoppingController::class,'show_products'])->name('show.products');

    Route::get('remove/carts',[UserShoppingController::class,'deleteCart'])->name('remove.carts');



    Route::get('load-cart-data',[UserShoppingController::class,'cartCounter'])->name('load-cart-data');

     // Route::get('/product/add-to-cart/{id}', [UserShoppingController::class, 'addToCart'])->name('addCart')->middleware(['auth','user']);
    // Route::get('details',[UserShoppingController::class,'addTocart'])->name('addToCartDetail');
  
    // Route::get('remove-from-cart', [UserShoppingController::class, 'remove'])->name('remove.from.cart');

    // Route::get('checkout', [UserShoppingController::class, 'checkout'])->name('checkout');
});
// Route::get('cartListing',[UserShoppingController::class,'cartListing'])->name('cartListing');

// Route::get('students', [OrderController::class, 'index'])->name('students');
// Route::get('students/list', [OrderController::class, 'getStudents'])->name('students.list');

Route::get('users', [OrderController::class, 'index'])->name('users.index');

Route::get('datatable',[OrderController::class,'datatable'])->name('datatable');


Route::post('uploadImageMultiple',[ProductController::class,'uploadMultipleImage'])->name('uploadImageMultiple');

require __DIR__.'/auth.php';
