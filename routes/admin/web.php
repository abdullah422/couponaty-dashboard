<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'role:admin|super_admin',
])
    ->group(function () {

        Route::name('admin.')->prefix('admin')->group(function () {

            //home
            Route::get('/home/top_statistics', 'HomeController@topStatistics')->name('home.top_statistics');
            Route::get('/home', 'HomeController@index')->name('home');

            //role routes
            Route::get('/roles/data', 'RoleController@data')->name('roles.data');
            Route::delete('/roles/bulk_delete', 'RoleController@bulkDelete')->name('roles.bulk_delete');
            Route::resource('roles', 'RoleController');

            //admin routes
            Route::get('/admins/data', 'AdminController@data')->name('admins.data');
            Route::delete('/admins/bulk_delete', 'AdminController@bulkDelete')->name('admins.bulk_delete');
            Route::resource('admins', 'AdminController');

            //user routes
            Route::get('/users/data', 'UserController@data')->name('users.data');
            Route::delete('/users/bulk_delete', 'UserController@bulkDelete')->name('users.bulk_delete');
            Route::resource('users', 'UserController');

            //setting routes
            Route::get('/settings/general', 'SettingController@general')->name('settings.general');
            // Route::get('/settings/social_links', 'SettingController@socialLinks')->name('settings.social_links');
            // Route::get('/settings/mobile_links', 'SettingController@mobileLinks')->name('settings.mobile_links');
            Route::resource('settings', 'SettingController')->only(['store']);

            //profile routes
            Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
            Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

            Route::name('profile.')->namespace('Profile')->group(function () {

                //password routes
                Route::get('/password/edit', 'PasswordController@edit')->name('password.edit');
                Route::put('/password/update', 'PasswordController@update')->name('password.update');

            });

            //user category
            Route::get('/categories/data', 'CategoryController@data')->name('categories.data');
            Route::delete('/categories/bulk_delete', 'CategoryController@bulkDelete')->name('categories.bulk_delete');
            Route::resource('categories', 'CategoryController');

            // brand routes
            Route::get('/brands/data', 'BrandController@data')->name('brands.data');
            Route::delete('/brands/bulk_delete', 'BrandController@bulkDelete')->name('brands.bulk_delete');
            Route::resource('brands', 'BrandController');

            // Coupon routes
            Route::get('/coupons/data', 'CouponController@data')->name('coupons.data');
            Route::delete('/coupons/bulk_delete', 'CouponController@bulkDelete')->name('coupons.bulk_delete');
            Route::resource('coupons','CouponController');

            // Banners routes
            Route::get('/banners/data', 'BannerController@data')->name('banners.data');
            Route::delete('/banners/bulk_delete', 'BannerController@bulkDelete')->name('banners.bulk_delete');
            Route::resource('banners', 'BannerController');

        });

    });
