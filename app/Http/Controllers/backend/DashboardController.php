<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function dashboard()
    {
        // DB::connection()->getPDO();
        // echo DB::connection()->getDatabaseName();
        $data['category'] = count(DB::table('category')->get());
        $data['subcategory'] = count(DB::table('subcategory')->get());
        $data['product'] = count(DB::table('products')->get());
        $data['orders'] = count(DB::table('orders')->get());
        $data['sales_amount'] = DB::table('orders')->sum('order_total');
        $data['customers'] = count(DB::table('customers')->get());

        return view('backend/dashboard/index', $data);

    }
}
