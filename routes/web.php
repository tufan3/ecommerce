<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\FrontendController;
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

// Route::get('/', function () {
//     return view('frontend.index');
// });

Auth::routes();

Route::get('/login', function(){
    return redirect()->to('/');
})->name('login');

Route::get('/register-user', function(){
    // return redirect()->to('/');
    return view('frontend.register_user');
})->name('register.user');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('user.logout');


/// frontend all route here---------------//
Route::group(['namespace'=>'App\Http\Controllers\Frontend'], function (){
    Route::get('/','FrontendController@index');
    Route::get('/product-details/{slug}','FrontendController@productDetails')->name('product.details');

    //---product quick view----///
    Route::get('/product-quick-view/{id}','FrontendController@productQuickView');

    //--cart--//
    Route::post('/add-to-cart','CartController@addToCartQuickView')->name('add.to.cart.quickView');

    Route::get('/all-cart','CartController@allCart')->name('all.cart');

    //---cart --//
    Route::get('/my-cart','CartController@myCart')->name('cart.page');
    Route::get('/cart/destroy','CartController@cartDestroy')->name('cart.destroy');

    //cart product remove--//
    // Route::get('/cart-product/romove/{rowId}','CartController@cartProductRemove')->name('cartproduct.remove');
    Route::get('/cartproduct/remove/{rowId}','CartController@cartProductRemove');
    //--cart update quantity--//
    Route::get('/cartproduct/update/{rowId}/{qty}','CartController@cartUpdateQty');
    //--cart update color--//
    Route::get('/cartproduct/update-color/{rowId}/{color}','CartController@cartUpdateColor');
    //--cart update size--//
    Route::get('/cartproduct/update-size/{rowId}/{size}','CartController@cartUpdateSize');


    //__ wishlist---------------//
    Route::get('/wishlist','CartController@wishlist')->name('wishlist');
    Route::get('/add/wishlist/{id}','CartController@addWishlist')->name('add.wishlist');
    Route::get('/clear/wishlist','CartController@clearWishlist')->name('clear.wishlist');
    Route::get('/wishlist-product/delete/{id}','CartController@wishlistProductDelete')->name('wishlistproduct.delete');


     //----category wise product show route----///
     Route::get('/category/product/{slug}','FrontendController@categoryWiseProduct')->name('categorywise.product');
     Route::get('/subcategory/product/{slug}','FrontendController@subcategoryWiseProduct')->name('subcategorywise.product');
     Route::get('/childcategory/product/{slug}','FrontendController@childcategoryWiseProduct')->name('childcategorywise.product');

     //--brand wise product--//
     Route::get('/brandwise/product/{slug}','FrontendController@brandWiseProduct')->name('brandwise.product');
    //  view page---//
     Route::get('/page/{slug}','FrontendController@viewPage')->name('view.page');

     //setting profile--//
     Route::get('/home/setting','ProfileController@customerSetting')->name('customer.setting');
     Route::POST('/home/password/update','ProfileController@customerPasswordChange')->name('customer.password.change');
     Route::POST('/home/shipping/update','ProfileController@customerShippingDetails')->name('customer.shipping.details');
     Route::get('/my/order','ProfileController@myOrder')->name('my.order');
     Route::get('/view/order/{id}','ProfileController@viewOrder')->name('view.order');

    //__reviews for product -----//
    Route::post('/store/review','ReviewController@store')->name('review.store');
    ///-- this review for website---///
    Route::get('/write/review','ReviewController@write')->name('write.review');
    Route::POST('/store/website/review','ReviewController@storeWebsiteReview')->name('store.website.review');

    //news letter--//
    Route::post('/store/newsletter','FrontendController@storeNewsLetter')->name('store.newsletter');

    //--checkout route--//
    Route::get('/checkout','CheckoutController@checkout')->name('checkout');
    Route::post('/apply/coupon','CheckoutController@applyCoupon')->name('apply.coupon');
    Route::get('/remove/coupon','CheckoutController@removeCoupon')->name('coupon.remove');
    Route::post('/order/place','CheckoutController@orderPlace')->name('order.place');

    //--support ticket--//
    Route::get('/open/ticket','TicketController@openTicket')->name('open.ticket');
    Route::post('/store/ticket','TicketController@storeTicker')->name('store.ticker');
    Route::get('/show/ticket/{id}','TicketController@showTicker')->name('show.ticket');
    Route::POST('/reply/ticket','TicketController@replyTicker')->name('reply.ticket');

    //--order tracking--//
    Route::get('/order/tracking','FrontendController@orderTracking')->name('order.tracking');
    Route::POST('/checking/order','FrontendController@checkingOrder')->name('checking.order');


    //--payment gateway--//
    Route::post('success','CheckoutController@success')->name('success');
    Route::post('fail','CheckoutController@fail')->name('fail');
    // Route::get('cancel','CheckoutController@cancel')->name('cancel');
    Route::get('cancel',function(){
        return redirect()->to('/');
    })->name('cancel');

    //--campaign --//
    Route::get('/campaign/product/{id}','FrontendController@campaignProducts')->name('frontend.campaign.product');
});

//--socialtie--//
Route::get('oauth/{drive}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{drive}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('social.callback');

// Route::get('/shop/product', function () {
//     return view('frontend.product.category_products');
// });
