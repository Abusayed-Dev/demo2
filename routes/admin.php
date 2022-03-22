<?php

use Illuminate\Support\Facades\Route;



Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');




Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function ()
{
    Route::get('/admin/home', 'AdminController@admin')->name('admin.home');
    Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/password/change', 'AdminController@passwordChange')->name('password.change');
    Route::post('/password/update', 'AdminController@passwordUpdate')->name('admin.password.update');



    //__category routes
    Route::group(['prefix' => 'category', 'middleware' => 'category'], function ()
    {
        Route::get('/index', 'CategoryController@index')->name('category.index');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('edit.category');
        Route::get('/delete/{id}', 'CategoryController@destroy')->name('delete.category');
        Route::post('/store', 'CategoryController@store')->name('store.category');
        Route::post('/update/{id}', 'CategoryController@update')->name('update.category');
    });


    //__subcategory routes
    Route::group(['prefix' => 'subcategory', 'middleware' => 'category'], function ()
    {
        Route::get('/index', 'SubcategoryController@index')->name('subcategory.index');
        Route::get('/edit/{id}', 'SubcategoryController@edit')->name('edit.subcategory');
        Route::get('/delete/{id}', 'SubcategoryController@destroy')->name('delete.subcategory');
        Route::post('/store', 'SubcategoryController@store')->name('store.subcategory');
        Route::post('/update/{id}', 'SubcategoryController@update')->name('update.subcategory');
    });


    //__childcategory routes
    Route::group(['prefix' => 'childcategory', 'middleware' => 'category'], function ()
    {
        Route::get('/index', 'ChildcategoryController@index')->name('childcategory.index');
        Route::get('/edit/{id}', 'ChildcategoryController@edit')->name('edit.childcategory');
        Route::get('/delete/{id}', 'ChildcategoryController@destroy')->name('delete.childcategory');
        Route::post('/store', 'ChildcategoryController@store')->name('store.childcategory');
        Route::post('/update/{id}', 'ChildcategoryController@update')->name('update.childcategory');
    });


    //__Brand routes
    Route::group(['prefix' => 'brand', 'middleware' => 'category'], function ()
    {
        Route::get('/index', 'BrandController@index')->name('brand.index');
        Route::get('/edit/{id}', 'BrandController@edit')->name('edit.brand');
        Route::get('/delete/{id}', 'BrandController@destroy')->name('delete.brand');
        Route::post('/store', 'BrandController@store')->name('store.brand');
        Route::post('/update/{id}', 'BrandController@update')->name('update.brand');
    });

    //__warehouse routes
    Route::group(['prefix' => 'warehouse', 'middleware' => 'category'], function ()
    {
        Route::get('/index', 'WarehouseController@index')->name('warehouse.index');
        Route::get('/edit/{id}', 'WarehouseController@edit')->name('edit.warehouse');
        Route::get('/delete/{id}', 'WarehouseController@destroy')->name('delete.warehouse');
        Route::post('/store', 'WarehouseController@store')->name('store.warehouse');
        Route::post('/update/{id}', 'WarehouseController@update')->name('update.warehouse');
    });

    //__settings routes
    Route::group(['prefix' => 'setting', 'middleware' => 'setting'], function ()
    {
        Route::group(['prefix' => 'seo'], function ()
        {
            Route::get('/index', 'SettingController@seo')->name('seo.setting.index');
            Route::post('/update/{id}', 'SettingController@updateSeo')->name('update.seo.setting');
        });

        //__smtp route
        Route::group(['prefix' => 'smtp'], function ()
        {
            Route::get('/index', 'SettingController@smtp')->name('smtp.setting.index');
            Route::post('/update/{id}', 'SettingController@updateSmtp')->name('update.smtp.setting');
        });

        //__website route
        Route::group(['prefix' => 'website'], function ()
        {
            Route::get('/setting/index', 'SettingController@wesite')->name('website.setting');
            Route::post('/update/{id}', 'SettingController@updateWebsite')->name('update.website');
        });

        //__page route
        Route::group(['prefix' => 'page'], function ()
        {
            Route::get('/index', 'PageController@page')->name('page.setting.index');
            Route::get('/create', 'PageController@pageCreate')->name('create.page.setting');
            Route::post('/store', 'PageController@pageStore')->name('store.page.setting');
            Route::post('/update/{id}', 'PageController@update')->name('update.page.setting');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit.page');
            Route::get('/delete/{id}', 'PageController@destroy')->name('delete.page');
        });
    });

    //__coupons routes
    Route::group(['prefix' => 'coupon', 'middleware' => 'offer'], function ()
    {
        Route::get('/index', 'CouponController@index')->name('coupon.index');
        Route::get('/edit/{id}', 'CouponController@edit')->name('edit.coupon');
        Route::get('/delete/{id}', 'CouponController@destroy')->name('delete.coupon');
        Route::post('/store', 'CouponController@store')->name('store.coupon');
        Route::post('/update/{id}', 'CouponController@update')->name('update.coupon');
    });

    //__campaign routes
    Route::group(['prefix' => 'campaign', 'middleware' => 'offer'], function ()
    {
        Route::get('/index', 'CampaignController@index')->name('campaign.index');
        Route::get('/edit/{id}', 'CampaignController@edit')->name('edit.campaign');
        Route::get('/delete/{id}', 'CampaignController@destroy')->name('delete.campaign');
        Route::post('/store', 'CampaignController@store')->name('store.campaign');
        Route::post('/update/{id}', 'CampaignController@update')->name('update.campaign');
    });

    //__pickup_point routes
    Route::group(['prefix' => 'pickup_point', 'middleware' => 'pickup'], function ()
    {
        Route::get('/index', 'PickupController@index')->name('pickuppoint.index');
        Route::get('/edit/{id}', 'PickupController@edit')->name('edit.pickup_point');
        Route::get('/delete/{id}', 'PickupController@destroy')->name('delete.pickup_point');
        Route::post('/store', 'PickupController@store')->name('store.pickup_point');
        Route::post('/update/{id}', 'PickupController@update')->name('update.pickup_point');
    });


    //__get-chid_Category
    Route::get('/get-child-category/{id}', 'ProductController@getChildCat');

    //__active featured product
    Route::get('/active/featured/product/{id}', 'ProductController@activeFeatured')->name('active.featured');
    Route::get('/deactive/featured/product/{id}', 'ProductController@deactiveFeatured')->name('deactive.featured');

    //__active deal 
    Route::get('/active/deal/{id}', 'ProductController@activeDeal')->name('active.deal');
    Route::get('/deactive/deal/{id}', 'ProductController@deactiveDeal')->name('deactive.deal');

    //__active status 
    Route::get('/active/status/{id}', 'ProductController@activeStatus')->name('active.status');
    Route::get('/deactive/status/{id}', 'ProductController@deactiveStatus')->name('deactive.status');


    //__product routes
    Route::group(['prefix' => 'product', 'middleware' => 'product'], function ()
    {
        Route::get('/create', 'ProductController@create')->name('create.product');
        Route::get('/index', 'ProductController@index')->name('index.product');
        Route::get('/edit/{id}', 'ProductController@edit')->name('edit.product');
        Route::get('/delete/{id}', 'ProductController@destroy')->name('delete.product');
        Route::post('/store', 'ProductController@store')->name('store.product');
        Route::post('/update/{id}', 'ProductController@update')->name('update.product');
    });

    //__Tickets routes
    Route::group(['prefix' => 'ticket', 'middleware' => 'ticket'], function ()
    {
        Route::get('/', 'TicketController@index')->name('index.ticket');
        Route::get('/view/{id}', 'TicketController@show')->name('view.ticket');
        Route::post('/reply/{id}', 'TicketController@replyTicket')->name('admin.reply.ticket');
        Route::get('/close/{id}', 'TicketController@closeTicket')->name('close.ticket');
        Route::get('/delete/{id}', 'TicketController@deleteTicket')->name('admin.delete.ticket');
    });

    //__Payment gateway routes
    Route::group(['prefix' => 'payment-gateway', 'middleware' => 'payment'], function ()
    {
        Route::get('/', 'PaymentController@paymentGateway')->name('payment.gateway');
        Route::post('/update/aamarpay/{id}', 'PaymentController@updateAamarpay')->name('update.aamarpay');
        Route::post('/update/surjopay/{id}', 'PaymentController@updateSurjopay')->name('update.surjopay');
        Route::post('/update/ssl/{id}', 'PaymentController@updateSSL')->name('update.ssl');
    });

    //__Order routes
    Route::group(['prefix' => 'order', 'middleware' => 'order'], function ()
    {
        Route::get('/', 'OrderController@index')->name('admin.order');
        Route::get('/view/order/{id}', 'OrderController@viewOrder')->name('view.order');
        Route::get('/edit/order/{id}', 'OrderController@editOrder')->name('edit.order');
        Route::get('/delete/order/{id}', 'OrderController@destroy')->name('delete.order');
        Route::post('/update/order-status/{id}', 'OrderController@updateOrderStatus')->name('update.order.status');
    });


    //__blog category routes
    Route::group(['prefix' => 'blog-category', 'middleware' => 'blog'], function ()
    {
        Route::get('/', 'BlogController@index')->name('blog.category');
        Route::post('/store', 'BlogController@storeCategory')->name('store.blog.category');
        Route::post('/update/{id}', 'BlogController@updateCategory')->name('update.blog.category');
        Route::get('/edit/{id}', 'BlogController@editCategory')->name('edit.blog.category');
        Route::get('/delete/{id}', 'BlogController@destroyCategory')->name('delete.blog.category');
    });

    //__blog details routes
    Route::group(['prefix' => 'blog', 'middleware' => 'blog'], function ()
    {
        Route::get('/', 'BlogController@blogIndex')->name('blog.details');
        Route::post('/store', 'BlogController@storeBlog')->name('store.blog');
        Route::post('/update/{id}', 'BlogController@updateBlog')->name('update.blog');
        Route::get('/edit/{id}', 'BlogController@editBlog')->name('edit.blog');
        Route::get('/delete/{id}', 'BlogController@destroyBlog')->name('delete.blog');
    });

    //__contact routes
    Route::group(['prefix' => 'contact', 'middleware' => 'contact'], function ()
    {
        Route::get('/', 'ContactController@Index')->name('admin.contact');
        Route::post('/reply/message', 'ContactController@replyContactMessage')->name('reply.message');
        Route::get('/reply/{id}', 'ContactController@replyMessage')->name('reply.contact.message');
        
    });

    //__Reports routes
    Route::group(['prefix' => 'report', 'middleware' => 'report'], function ()
    {
        Route::group(['prefix' => 'order-report'], function ()
        {
            Route::get('/', 'ReportController@orderReport')->name('order.report');
            Route::get('/print', 'ReportController@orderPrint')->name('report.order.print');
            
        });
    });

    //__user role routes
    Route::group(['prefix' => 'user-role', 'middleware' => 'user_role'], function ()
    {
        Route::get('/index', 'RoleController@index')->name('manage.role');
        Route::get('/create', 'RoleController@create')->name('create.role');
        Route::get('/edit/{id}', 'RoleController@edit')->name('edit.role');
        Route::post('/store', 'RoleController@store')->name('store.role');
        Route::post('/update/{id}', 'RoleController@update')->name('update.role');
        Route::get('/delete/{id}', 'RoleController@destroy')->name('delete.role');
    });




});
