<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryFrontController extends Controller
{
    public function header()
    {
        $data['categories'] = DB::table('category')->get();
        $data['subcategories'] = DB::table('subcategory')->get();

        $data['cart_data'] = session()->get('cart');

        if (!empty($data['cart_data'])) {
            foreach ($data['cart_data'] as $product_id => $quantity) {
                $cart_product_ids[] = $product_id;
            }
            // $product_ids=implode(',',$cart_product_ids);
            // $data['cart_products'] = DB::table('products')->where('product_id','IN',$product_ids)->get();

            $data['cart_products'] = DB::table('products')->whereIn('product_id', $cart_product_ids)->get();
            $data['product_images'] = DB::table('product_images')->whereIn('product_id', $cart_product_ids)->get();
        }
        
        echo view('frontend/header', $data);
    }
    public function get_subcategory_info($subcategory_id)
    {
         
        $data['categories'] = DB::table('category')->get();
        $data['subcategories'] = DB::table('subcategory')->where('subcategory_id', $subcategory_id)->get();;
        $data['products'] = DB::table('products')->where('subcategory_id', $subcategory_id)->get();
        $data['product_images'] = DB::table('product_images')->get();

        $data['cart_data'] = session()->get('cart');

        // $this->header();
        return view('frontend/subcategory_description', $data);
        // echo view('frontend/footer');
    }
}
