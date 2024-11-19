<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;


// Route::get('/admin/home', [AdminController::class, 'admin_index'])->name('admin.home')->middleware('is_admin');


Route::get('/admin-login', [App\Http\Controllers\Auth\loginController::class, 'admin_login'])->name('admin.login');

Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware'=>'is_admin'], function (){
    Route::get('/admin/home', 'AdminController@admin')->name('admin.home');
    Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/admin/password/change', 'AdminController@password_change')->name('admin.password.change');
    Route::post('/admin/password/update', 'AdminController@password_update')->name('admin.password.update');

//__category route
    Route::group(['prefix' => 'category'], function (){
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::get('/delete/{id}', 'CategoryController@destroy')->name('category.delete');
        Route::get('/edit/{id}', 'CategoryController@edit');
        Route::post('/update', 'CategoryController@update')->name('category.update');
    });
// global route
    Route::get('/getChildCategories/{id}', 'ProductController@getChildCategories')->name('getChildCategories');

//__sub category route
    Route::group(['prefix' => 'subcategory'], function (){
        Route::get('/', 'SubcategoryController@index')->name('subcategory.index');
        Route::post('/store', 'SubcategoryController@store')->name('subcategory.store');
        Route::get('/delete/{id}', 'SubcategoryController@destroy')->name('subcategory.delete');
        Route::get('/edit/{id}', 'SubcategoryController@edit');
        Route::post('/update', 'SubcategoryController@update')->name('subcategory.update');
    });

// child category route
    Route::group(['prefix' => 'childcategory'], function (){
        Route::get('/', 'ChildcategoryController@index')->name('childcategory.index');
        Route::post('/store', 'ChildcategoryController@store')->name('childcategory.store');
        Route::get('/delete/{id}', 'ChildcategoryController@destroy')->name('childcategory.delete');
        Route::get('/edit/{id}', 'ChildcategoryController@edit');
        Route::post('/update', 'ChildcategoryController@update')->name('childcategory.update');
    });

// brand route
    Route::group(['prefix' => 'brand'], function (){
        Route::get('/', 'brandController@index')->name('brand.index');
        Route::post('/store', 'brandController@store')->name('brand.store');
        Route::get('/delete/{id}', 'brandController@destroy')->name('brand.delete');
        Route::get('/edit/{id}', 'brandController@edit');
        Route::post('/update', 'brandController@update')->name('brand.update');
    });

//__warehouse route
    Route::group(['prefix' => 'warehouse'], function (){
        Route::get('/', 'WarehouseController@index')->name('warehouse.index');
        Route::post('/store', 'WarehouseController@store')->name('warehouse.store');
        Route::get('/delete/{id}', 'WarehouseController@destroy')->name('warehouse.delete');
        Route::get('/edit/{id}', 'WarehouseController@edit');
        Route::post('/update', 'WarehouseController@update')->name('warehouse.update');
    });

// product route
    Route::group(['prefix' => 'product'], function (){
        Route::get('/', 'ProductController@index')->name('product.index');
        Route::get('/create', 'ProductController@create')->name('product.create');
        Route::post('/store', 'ProductController@store')->name('product.store');
        Route::get('/delete/{id}', 'ProductController@destroy')->name('product.delete');
        Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::post('/update', 'ProductController@update')->name('product.update');


        //
        Route::post('/featured', 'ProductController@featured')->name('product.featured');
        Route::post('/today-deal', 'ProductController@todayDeal')->name('product.todayDeal');
        Route::post('/status', 'ProductController@status')->name('product.status');

    });


// coupon route
    Route::group(['prefix' => 'coupon'], function (){
        Route::get('/', 'CouponController@index')->name('coupon.index');
        Route::post('/store', 'CouponController@store')->name('coupon.store');
        Route::delete('/delete/{id}', 'CouponController@destroy')->name('coupon.delete');
        Route::get('/edit/{id}', 'CouponController@edit');
        Route::post('/update', 'CouponController@update')->name('coupon.update');
    });

// pickup point route
    Route::group(['prefix' => 'pickup-point'], function (){
        Route::get('/', 'PickupController@index')->name('pickuppoint.index');
        Route::post('/store', 'PickupController@store')->name('pickuppoint.store');
        Route::delete('/delete/{id}', 'PickupController@destroy')->name('pickuppoint.delete');
        Route::get('/edit/{id}', 'PickupController@edit');
        Route::post('/update', 'PickupController@update')->name('pickuppoint.update');
    });


// __setting route__//
    Route::group(['prefix' => 'setting'], function (){
    //__seo route
        Route::group(['prefix' => 'seo'], function (){
            Route::get('/', 'SettingController@seoSetting')->name('seo.setting');
            Route::post('/Update/{id}', 'SettingController@seoSettingUpdate')->name('seo.setting.update');
        });

    //__smtp route
        Route::group(['prefix' => 'smtp'], function (){
            Route::get('/', 'SettingController@smtpSetting')->name('smtp.setting');
            Route::post('/Update/{id}', 'SettingController@smtpSettingUpdate')->name('smtp.setting.update');
        });

    //__website setting route
         Route::group(['prefix' => 'website'], function (){
            Route::get('/', 'SettingController@websiteSetting')->name('website.setting');
            Route::post('/Update/{id}', 'SettingController@websiteSettingUpdate')->name('website.setting.update');
        });

    //__page route
        Route::group(['prefix' => 'page'], function (){
            Route::get('/', 'PageController@index')->name('page.index');
            Route::get('/create', 'PageController@create')->name('page.create');
            Route::post('/store', 'PageController@store')->name('page.store');
            Route::get('/delete/{id}', 'PageController@destroy')->name('page.delete');
            Route::get('/edit/{id}', 'PageController@edit')->name('page.edit');
            Route::post('/update/{id}', 'PageController@update')->name('page.update');
        });
    });
});


// Route::controller(AdminController::class)->middleware('is_admin')->group(function () {
//     Route::get('/admin/home', 'admin_index')->name('admin.home');
//     // Route::post('/orders', 'store');
// });
