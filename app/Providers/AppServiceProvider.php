<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Pagination\Paginator;
use Gloudemans\Shoppingcart\Facades\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //pagination
        Paginator::useBootstrap();

        $setting = DB::table('settings')->first();
        view()->share('setting',$setting);

        $taxRate = env('TAX_RATE', 0);
        Cart::setGlobalTax((float)$taxRate);
    }
}
