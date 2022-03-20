<?php

use Illuminate\Support\Facades\Route;

Route::prefix(LaravelLocalization::setLocale())
    ->middleware([
        // 'localeSessionRedirect',
        // 'localizationRedirect',
        // 'localeViewPath',
    ])
    ->group(function () {

        Route::get('/', function () {
            return view('auth.login');
        });
        Auth::routes(['register' => false]);
       // Auth::routes();



    });
