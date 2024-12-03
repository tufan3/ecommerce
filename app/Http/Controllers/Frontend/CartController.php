<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCartQuickView(Request $request){
        $product = Product::find($request->product_id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'qty' => $request->qty,
            'price' => $request->product_price,
            'weight' => '1',
            'options' => ['size' => $request->size, 'color' => $request->color, 'product_thumbnail' => $product->product_thumbnail]
    ]);
    // return response()->json(['message' => 'Product added to cart successfully']);
    return response()->json('Product added to cart successfully.');
    }

    //--all cart--//
    public function allCart(){
        $data = array();
        $data['cart_qty'] = Cart::count() ;
        $data['cart_total'] = Cart::total();
        return response()->json($data);
    }

    //--my cart--//
    public function myCart(){
        $cart_content = Cart::content();
        // return response()->json($cart_content);
        return view('frontend.cart.cart', compact('cart_content'));
    }
    //--my cart--//

    //--remove cart product from cart--//
    public function cartProductRemove($rowId){
        Cart::remove($rowId);
        return response()->json('Product removed from cart successfully.');
    }
    //--remove cart product from cart--//

    //--update qty from product from cart--//
    public function cartUpdateQty($rowId, $qty){
        Cart::update($rowId, $qty);
        return response()->json('Product quantity updated successfully.');
    }
    //--update qty from product from cart--//

    //--update color from product from cart--//
    public function cartUpdateColor($rowId, $color){
        $product = Cart::get($rowId);
        $product_thumbnail = $product->options->product_thumbnail;
        $size = $product->options->size;

        Cart::update($rowId, ['options'  => ['color' => $color, 'size' => $size, 'product_thumbnail' => $product_thumbnail]]);
        return response()->json('Product color updated successfully.');
    }
    //--update color from product from cart--//


    //--update size from product from cart--//
    public function cartUpdateSize($rowId, $size){
        $product = Cart::get($rowId);
        $color = $product->options->color;
        $product_thumbnail = $product->options->product_thumbnail;

        Cart::update($rowId, ['options'  => ['color' => $color, 'size' => $size, 'product_thumbnail' => $product_thumbnail]]);
        return response()->json('Product size updated successfully.');
    }
    //--update size from product from cart--//

    //--cart Destroy--//
    public function cartDestroy(){
        Cart::destroy();
        $notification = array('messege' => 'Cart Clear', 'alert-type' => 'success');
        return redirect()->to('/')->with($notification);
    }
    //--cart Destroy--//




//-----------------wishlist------------------------------------------//


    public function wishlist(){
        if(Auth::check()){
            // $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
            $wishlist = DB::table('wishlists')->leftJoin('products','wishlists.product_id','products.id')->select('wishlists.*','products.product_name','products.product_thumbnail','products.product_slug')->where('wishlists.user_id', Auth::user()->id)->get();
            return view('frontend.cart.wishlist', compact('wishlist'));
        }
        $notification = array('message' => 'At first Login your account!', 'alert-type' => 'error');
        return redirect()->back()->with($notification);
    }

    //___wishlist add---------//
    public function addWishlist($id)
    {
        if(Auth::check()){
            $check = DB::table('wishlists')->where('user_id',auth()->user()->id)->where('product_id',$id)->first();
            if($check){
                $notification = array('message' => 'Already you have a wishlist with this product', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }else{
                $wishlist = array();
                $wishlist['user_id'] = auth()->user()->id;
                $wishlist['product_id'] = $id;
                $wishlist['date'] = date('d ,F Y');
                DB::table('wishlists')->insert($wishlist);

                $notification = array('message' => 'product added on wishlist', 'alert-type' => 'success');
                return redirect()->back()->with($notification);
            }
        }
        $notification = array('message' => 'At first Login your account!', 'alert-type' => 'error');
        return redirect()->back()->with($notification);
    }
    //___wishlist add---------//

    //--wishlist single product delete--//
    public function wishlistProductDelete($id)
    {
        DB::table('wishlists')->where('id', $id)->delete();
        $notification = array('message' => 'Product deleted from wishlist', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //--wishlist single product delete--//


    //___wishlist delete all data---------//
    public function clearWishlist()
    {
        if(Auth::check()){
            DB::table('wishlists')->where('user_id',auth()->user()->id)->delete();
            $notification = array('message' => 'product deleted from wishlist', 'alert-type' =>'success');
            return redirect()->to('/')->with($notification);
        }
        $notification = array('message' => 'At first Login your account!', 'alert-type' => 'error');
        return redirect()->back()->with($notification);
    }
    //___wishlist delete all data---------//


}
