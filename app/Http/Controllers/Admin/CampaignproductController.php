<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CampaignproductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //--campaign product all---//
    public function index($campaign_id){

        $product = DB::table('products')->leftJoin('categories','products.category_id','categories.id')
        ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
        ->leftJoin('brands','products.brand_id','brands.id')
        ->leftJoin('warehouses','products.warehouse','warehouses.id')
        ->select('products.*','categories.category_name','brands.brand_name','warehouses.warehouse_name','subcategories.subcategory_name')
        ->where('products.status',1)
        ->get();
        return view('admin.offer.campaign_product.index',compact('product','campaign_id'));
    }
    //--campaign product all---//


    //--add campaign product---//
    public function addProductCampaign($product_id,$campaign_id){
        $campaign = DB::table('campaigns')->where('id',$campaign_id)->first();
        $product = DB::table('products')->where('id',$product_id)->first();

        $discount  = ($product->selling_price * $campaign->discount)/100;
        $price = $product->selling_price - $discount;

        $data = array();
        $data['campaign_id'] = $campaign_id;
        $data['product_id'] = $product_id;
        $data['price'] = $price;

        DB::table('campaign_product')->insert($data);
        $notification = array('message' => 'Product added to campaign successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //--add campaign product---//


    //--campaign product list---//
    public function productListCampaign($campaign_id){
        $product = DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')->select('campaign_product.*','products.product_name','products.product_code','products.product_thumbnail')->where('campaign_id',$campaign_id)->get();
        $campaign = DB::table('campaigns')->where('id',$campaign_id)->first();

        return view('admin.offer.campaign_product.campaign_product_list',compact('product','campaign'));
    }
    //--campaign product list---//

    //--remove campaign product---//
    public function productRemoveCampaign($id){
        DB::table('campaign_product')->where('id',$id)->delete();
        $notification = array('message' => 'Product removed from campaign successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //--remove campaign product---//


}
