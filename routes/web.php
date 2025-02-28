<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\CartController;
// khai bao cho (1-2)
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
session_start();
// home-trang chu (frontend)
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('/trang~chu', 'App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem', 'App\Http\Controllers\HomeController@search');

// danh muc san pham trang chu(1-2)
Route::get('danh-muc-san-pham{category_id}', 'App\Http\Controllers\CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham{brand_id}', [BrandProduct::class, 'show_brand_home']);

Route::get('chi-tiet-san-pham/{product_id}', 'App\Http\Controllers\ProductController@details_product');


// admin(backend)
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
//Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
Route::match(['get', 'post'], '/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');

// category-product
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');

Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@active_category_product');
Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@unactive_category_product');

Route::any('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
Route::any('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@update_category_product');


// Brand-product
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@delete_brand_product');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product');

Route::get('/active-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@active_brand_product');
Route::get('/unactive-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@unactive_brand_product');

Route::any('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');
Route::any('/update-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@update_brand_product');


// product
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');

Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');
Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');

Route::any('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::any('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');

// cart
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::get('/show_cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{id}', 'App\Http\Controllers\CartController@delete_cart');
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity'])->name('cart.update_quantity');

//checkout
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::post('/order-place', 'App\Http\Controllers\CheckoutController@order_place');
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckoutController@logout_checkout');
Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::get('/payment', 'App\Http\Controllers\CheckoutController@payment');
Route::post('/save-checkout-customer', 'App\Http\Controllers\CheckoutController@save_checkout_customer');

// quản lý đơn hàng order-admin
Route::get('/manager-order', 'App\Http\Controllers\CheckoutController@manager_order');
Route::get('/view-order/{orderID}', 'App\Http\Controllers\CheckoutController@view_order');
