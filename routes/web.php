<?php

use Illuminate\Support\Facades\Route;

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
//Frontend
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::get('/search','HomeController@search');
Route::get('/orders','HomeController@orders');
Route::get('/order-details/{order_id}','HomeController@order_details');
Route::get('/account','HomeController@account');
Route::get('/address','HomeController@address');
Route::post('/add-address','HomeController@add_address');
Route::post('/update-address','HomeController@update_address');
Route::post('/update-info','HomeController@update_info');
Route::get('/change-password','HomeController@change_password');
Route::post('/update-password','HomeController@update_password');

//Danh muc san pham trang chu
Route::get('/categories/{category_id}','CategoryProduct@show_category_home');
Route::get('/brands/{brand_id}','BrandProduct@show_brand_home');
Route::get('/product-details/{product_id}','ProductController@details_product');


//Backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/logout','AdminController@logout');
Route::get('/all-user','AdminController@all_user');

//Category product
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');

Route::get('/inactive-category-product/{category_product_id}','CategoryProduct@inactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');

Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');

//Brand product
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');

Route::get('/inactive-brand-product/{brand_product_id}','BrandProduct@inactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');

Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');

//Product
Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');

Route::get('/inactive-product/{product_id}','ProductController@inactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');
Route::post('/search-product','ProductController@search_product');
Route::get('/show-all-product','ProductController@show_all_product');
Route::get('/best-seller','ProductController@best_seller');



//Cart
Route::post('/update-cart','CartController@update_cart');
Route::get('/cart','CartController@cart');
Route::get('/del-cart-product/{session_id}','CartController@del_cart_product');
Route::post('/add-cart','CartController@add_cart');
Route::get('/clear-all','CartController@clear_all');

//Coupon
Route::post('/apply-coupon','CartController@apply_coupon');
Route::get('/add-coupon','CouponController@add_coupon');
Route::post('/add-coupon-code','CouponController@add_coupon_code');
Route::post('/update-coupon/{coupon_id}','CouponController@update_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::get('/edit-coupon/{coupon_id}','CouponController@edit_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/ignore-coupon','CouponController@ignore_coupon');




//Checkout
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::post('/user-login-checkout','CheckoutController@user_login_checkout');
Route::get('/signup-checkout','CheckoutController@signup_checkout');
Route::post('/create-account-checkout','CheckoutController@create_account_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');

Route::post('/select-location-checkout','CheckoutController@select_location_checkout');
Route::post('/cal-fee','CheckoutController@cal_fee');
Route::post('/confirm-order','CheckoutController@confirm_order');
Route::get('/shipping','CheckoutController@shipping');
Route::get('/review-order','CheckoutController@review_order');

//Order

Route::get('/manage-order','OrderController@manage_order');
Route::get('/accept-order/{order_code}','OrderController@accept_order');
Route::get('/ship-order/{order_code}','OrderController@ship_order');
Route::get('/complete-order/{order_code}','OrderController@complete_order');
Route::get('/cancel-order/{order_code}','OrderController@cancel_order');
// Huy don hang frontend
Route::get('/cancel-ord/{order_code}','OrderController@cancel_ord');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::get('/print-receipt/{order_code}','OrderController@print_receipt');
Route::post('/search-order','OrderController@search_order');
Route::post('/filter-order','OrderController@filter_order');

//Delivery
Route::get('/shipping-fee','DeliveryController@shipping_fee');
Route::post('/select-location','DeliveryController@select_location');
Route::post('/add-shipping-fee','DeliveryController@add_shipping_fee');
Route::post('/list-shipping-fee','DeliveryController@list_shipping_fee');
Route::post('/update-shipping-fee','DeliveryController@update_shipping_fee');


//Login
Route::get('/login','LoginController@login');
Route::post('/user-login','LoginController@user_login');
Route::get('/signup','LoginController@signup');
Route::post('/create-account','LoginController@create_account');