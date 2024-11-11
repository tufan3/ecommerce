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

    //__setting route
    Route::group(['prefix' => 'setting'], function (){
        //__seo route
        Route::group(['prefix' => 'seo'], function (){
            Route::get('/', 'SettingController@seoSetting')->name('seo.setting');
            Route::post('/Update/{id}', 'SettingController@seoSettingUpdate')->name('seo.setting.update');
        });

        //__smtp route
        Route::group(['prefix' => 'smtp'], function (){
            Route::get('/', 'SettingController@smtpSetting')->name('smtp.setting');
            Route::post('/Update/{id}', 'SettingController@smtpSettingUpdate')->name('seo.setting.update');
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
