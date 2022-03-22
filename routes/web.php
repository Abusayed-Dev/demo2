<?php

use Illuminate\Support\Facades\Route;





Auth::routes();

Route::get('/login', function ()
{
    return redirect()->to('/');  
})->name('login');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');



//frontend all route here======
Route::group(['namespace' => 'App\Http\Controllers\Front'], function ()
{
    
    Route::get('/', 'IndexController@index');
    Route::get('/product-details/{slug}', 'IndexController@productDetails')->name('product.details');


    //__categorywise product
    Route::get('/popular/category/{id}', 'IndexController@categorywiseProduct')->name('categorywise.product');

    //__product quickview
    Route::get('/product/quickview/{id}', 'IndexController@productQuickView')->name('quickView');

    //__add to cart Quickview
    Route::post('/addToCart/{id}', 'CartController@addToCartQuickView')->name('add.to.cart.quickview');

    Route::get('/all-cart', 'CartController@allCart')->name('all.cart');

    Route::get('/store/whislist/{id}', 'CartController@addWhislist')->name('add.whislist');
    Route::get('/all/clear/whislist', 'CartController@clearWhislist')->name('clear.total.whislist');


    Route::get('/view/cart', 'CartController@viewCart')->name('view.cart');
    Route::get('/remove/cart_row/{rowId}', 'CartController@removeRow')->name('remove.cartRow');
    Route::get('/update/{rowId}/{color}', 'CartController@UpdateColor');
    Route::get('/update/cart-qty/{rowId}/{qty}', 'CartController@UpdateQty');

    Route::get('/clear/cart', 'CartController@destroyCart')->name('destroy.cart');

    //__checkout cart
    Route::get('/checkout/page', 'CheckoutController@checkout')->name('checkout');


    //__order route
    Route::post('/checkout/page', 'CheckoutController@orderPlace')->name('order.place');


    //__brandwise product
    Route::get('/brandwise/product/{id}', 'IndexController@brandwiseProduct')->name('brandwise.product');

    //__review product
    Route::post('/review/product', 'ReviewController@reviewStore')->name('store.review');

    //__whislist
    Route::get('/index/whislist/{user_id}', 'ReviewController@showWhislist')->name('index.whislist');
    Route::get('/delete/whislist/{id}', 'ReviewController@destroyWhislist')->name('delete.whislist');

    //__nav categorywise product
    Route::get('/categorywise/prodcut/{id}', 'IndexController@navCategoryWiseProduct')->name('nav.categorywise.product');
    //__subcategorywise product
    Route::get('/subcategorywise/prodcut/{id}', 'IndexController@subcategoryWiseProduct')->name('subcategory.product');
    //__nav childgorywise product
    Route::get('/chidcategorywise/prodcut/{id}', 'IndexController@childcategoryWiseProduct')->name('childcategorywise.product');

    //__website review
    Route::get('/write/review/', 'ReviewController@writeReview')->name('write.review');
    Route::post('/website/review/store', 'ReviewController@webReviewStore')->name('web.review.store');

    //__profile settings
    Route::get('/customer/setting/', 'ProfileController@setting')->name('customer.setting');
    Route::post('/home/password/update', 'ProfileController@passwordChange')->name('customer.password.change');
    Route::get('/orders', 'ProfileController@Orders')->name('order');
    Route::get('/order/details/{id}', 'ProfileController@orderDetails')->name('order.details');


    //__pages view route
    Route::get('/page-details/{page_slug}', 'PageController@pageView')->name('page.details');

    //__store newsletter
    Route::post('/store/newsletter', 'PageController@storeNewsleter')->name('store.newsletter'); 


    //__Website Blog details route
    Route::get('/blog-category-details/{id}', 'PageController@blogCatDetails')->name('blog.category.details'); 

    //__Coupon
    Route::get('/remove/coupon', 'CheckoutController@removeCoupon')->name('remove.coupon');
    Route::post('/apply/coupon', 'CheckoutController@applyCoupon')->name('apply.coupon');


    //__Tickets
    Route::get('/tickets', 'ProfileController@Tickets')->name('open.ticket');
    Route::get('/new/ticket', 'ProfileController@newTicket')->name('new.ticket');
    Route::post('/store/ticket', 'ProfileController@storeTicket')->name('store.ticket');

    //__Show Ticket
    Route::get('/show/ticket/{id}', 'ProfileController@showTicket')->name('show.ticket');
    Route::post('/reply/ticket/{id}', 'ProfileController@replyTicket')->name('reply.ticket');

    //__Order Tracking
    Route::get('/order/track', 'IndexController@orderTrack')->name('order.track');
    Route::post('/check/track', 'IndexController@checkTrack')->name('check.track');


    //__contact page
    Route::get('/contact/page', 'IndexController@contactIndex')->name('contact');
    Route::post('/store/contact', 'ContactController@store')->name('store.contact');

    
    //__payment gateway
    Route::post('/success','CheckoutController@success')->name('success');
    Route::post('/fail','CheckoutController@fail')->name('fail');
    Route::get('/cancel', function () {
        return redirect()->to('/');
    })->name('cancel');


});



//socialite
Route::get('oauth/{driver}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('social.callback');






