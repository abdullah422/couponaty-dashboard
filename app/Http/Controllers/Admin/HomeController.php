<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home');

    }// end of index


    public function topStatistics()
    {
        $categoriesCount = number_format( Category::count(),1);
        $brandsCount = number_format( Brand::count(),1);
        $couponsCount = number_format( Coupon::count(),1);

        return response()->json([
            'categories_count' => $categoriesCount,
            'brands_count' => $brandsCount,
            'coupons_count' => $couponsCount,
        ]);

    }// end of topStatistics

}//end of controller
