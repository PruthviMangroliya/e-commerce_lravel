<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\OrdersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function order_list()
    {
        $data['orders'] = DB::table('orders')->get();

        return  view('backend/orders/order_list', $data);

    }

    public function order_details($order_id)
    {
        $data['order_id']=$order_id;
        $data['orders'] = DB::table('orders')
        ->join('customers','orders.customer_id','=','customers.customer_id')
        ->where('order_id',$order_id)->get();

        $data['order_details'] = DB::table('order_products')->where('order_id',$order_id)->get();

        return view('backend/orders/order_details', $data);

    }

    public function change_order_status(Request $request)
    {
        $order_id=$request->order_id;
        $order_status=$request->order_status;

        $cacellation = OrdersModel::find($order_id)->update(['order_status' => $order_status]);

    }
}
