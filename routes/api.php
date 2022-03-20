<?php

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::get('/public_coupons', 'CouponController@index');

Route::get('/categories', 'CategoryController@index');
Route::get('/brands', 'BrandController@index');
//Route::get('/coupons', 'CouponController@index');
Route::get('/banners', 'BannerController@index');
Route::get('/home', 'HomeController@index');


Route::middleware('auth:sanctum')->group(function () {

    //user route
    Route::get( '/user', 'AuthController@user');
    Route::get('/private_coupons', 'CouponController@index');

    Route::get('/coupons/toggle_coupon', 'CouponController@toggleFavourite');
    Route::get('/coupons/is_Favourite', 'CouponController@isFavourite');
    Route::get('/coupons/get_favourites', 'CouponController@getFavourites');


});


Route::middleware([
    'auth',
    'role:admin|super_admin',
])
    ->group(function () {

        Route::name('admin.')->prefix('admin')->group(function () {

            Route::get('/categories', 'CategoryController@index');

        });

    });
