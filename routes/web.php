<?php
use App\Http\Controllers\StripeController;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Collection;
use App\User;
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
Route::get('/', 'WebsiteController@index');

Route::get('/consultant-login', "Auth\LoginController@login_consultant")->name('consultant-login');

Route::get('/register-consultant', 'WebsiteController@consultantRegister')->name('register.consultant');
Route::get('/home', 'WebsiteController@index')->name('home');

Route::get('/header_product_search_ajax', 'WebsiteController@headerProductSearchAjax')->name('header_product_search_ajax');

Route::get('/about-us', 'WebsiteController@aboutUs')->name('about-us');

Route::get('/contact-us', "WebsiteController@contactUs")->name('contact-us');
Route::get('/kits', "WebsiteController@kits")->name('kits');

 Route::get('/pricing-list', "WebsiteController@pricingList")->name('pricing_list');


Route::post('/contact-us', "WebsiteController@submitContactUs")->name('contact.us');

Route::get('/bible-verses', "WebsiteController@angelNumbers")->name('angel-numbers');

Route::get('/giving', "WebsiteController@giving")->name('giving');

Route::get('/party', "WebsiteController@party")->name('party');

Route::post('/add-consultant', "WebsiteController@addConsultant")->name('add.consultant');

Route::post('/session-kit',"WebsiteController@sessionKit")->name('session.kit');

Route::post('/party',"PaymentController@buyCollection")->name('collection.buy');



// Route::middleware(['consultant'])->group(function () {

    Route::post('/add-to-cart', "WebsiteController@addToCart")->name('add.to.cart');
Route::get('/clear-cart', "WebsiteController@clearCart")->name("clear.cart");
Route::get('/minus-quantity', "WebsiteController@minusQuantity")->name('minus.quantity');
Route::get('/plus-quantity', "WebsiteController@plusQuantity")->name('plus.quantity');
Route::get('/remove-product', "WebsiteController@removeProduct")->name('remove.product');



Route::get('/signup-options', "WebsiteController@signupopt")->name('signup_options');
Route::get('/privacy-policy', "WebsiteController@privacy_policy")->name('privacy-policy');
Route::get('/compensation-policy', "WebsiteController@compansation")->name('compansation-policy');

// });




Route::post('/find', function (Request $request, User $user) {

    $consultant = $user->query();
    if(isset($request->req['zipcode'])){
        $consultant->where('zip',$request->req['zipcode']);
    }
    else if(isset($request->req['name'])){
        $consultant->where('name','LIKE','%'.$request->req['name'].'%');
    }
    else if(isset($request->req['rep'])){
        $consultant->where('unique_id',$request->req['rep']);
    }


    $consultant = $consultant->where(['status'=> 1, 'role' => 2,'is_consultant' => 1])->get();
    if ($consultant->isEmpty()){
        $consultant = $user->query()->where(['status'=> 1, 'role' => 2,'is_consultant' => 1])->where('accnt_num' ,$request->req['zipcode'] )->get();
     }
    // echo "<pre>";
    echo json_encode($consultant);
})->name('find');

Route::get('/earrings', function () {
    return view('site.earrings');
})->name('earrings');

Route::get('/bracelets', function () {
    return view('site.bracelets');
})->name('bracelets');

Route::get('/necklaces', function () {
    return view('site.necklaces');
})->name('necklaces');

Route::get('/consultant', function () {
    return view('site.consultant');
})->name('consultant')->middleware('auth');

Route::get('/earrings-necklaces', function () {
    return view('site.earrings-necklaces');
})->name('earrings-necklaces');

Route::get('/product-detail/{slug}', "WebsiteController@productDetails")->name('product-detail');

Route::get('/cart', "WebsiteController@cart")->name('cart');

Route::get('/checkout', "WebsiteController@checkout")->name('checkout');

Route::get('/pricing', "WebsiteController@pricing")->name('pricing');

Route::get('/mission', "WebsiteController@mission")->name('mission');

Route::get('/shop', "WebsiteController@shop")->name('shop');




Route::get('check_mail', 'PaymentController@check_mail')->name('check_mail')->middleware('auth');


Route::get('/notification-list', 'AdminController@notification_list')->name('notification_list')->middleware('auth');
Route::post('/notification-destroy/{id}', 'AdminController@notification_destroy')->name('notification_destroy')->middleware('auth');


Auth::routes();
// consultant resource routes
Route::prefix('user')->group(function() {
    // Route::get('/dashboard', 'HomeController@index')->name('user.dashboard')->middleware('admin');
    Route::get('/profile', 'HomeController@profile')->name('user.profile')->middleware('auth');
    Route::post('/personal','HomeController@personal')->name('profile.personal')->middleware('auth');
    Route::post('/address','HomeController@address')->name('profile.address')->middleware('auth');
    Route::post('payment', 'PaymentController@payment')->name('payment');
    Route::get('cancel/{id}', 'PaymentController@cancel')->name('payment.cancel');
    Route::get('success/{id}', 'PaymentController@success')->name('payment.success');
    Route::get('success/kit/{id}', 'PaymentController@successKit')->name('payment.success.kit');
    Route::get('/order-success/{id}', 'HomeController@orderSuccess')->name('order.success')->middleware('consultant');
    Route::get('/order-details/{id}','HomeController@orderDetails')->name('order.detail')->middleware('consultant');
    Route::post('/apply-coupon','HomeController@applyCoupon')->name('apply.coupon')->middleware('consultant');
    Route::get('/remove-coupon','HomeController@removeCoupon')->name('remove.coupon')->middleware('consultant');
    Route::get('/dashboard','HomeController@member_dashboard')->name('user.dashboard')->middleware('consultant');
    Route::get('/account-information','HomeController@member_information')->name('user.information');
    Route::get('/past-transactions','HomeController@past_transactions')->name('user.transactions');
    Route::get('/payment-setting','HomeController@payment_setting')->name('user.payment');
    Route::get('/payment-details','HomeController@payment_details')->name('user.payment_details');
    Route::get('/edit-payments','HomeController@edit_payments')->name('user.edit_payments');
    Route::get('/edit-accounts','HomeController@edit_accounts')->name('user.edit_accounts');
    Route::post('/edit/account/store','HomeController@store_account')->name('user.store_account');
    Route::get('/edit-password','HomeController@edit_password')->name('user.edit_password');
    Route::post('/change/password','HomeController@changePasswordStore')->name('user.change.password');
    Route::get('/delete/transaction/{id}','HomeController@DeleteTransaction')->name('delete.transaction');

});
// admin resource routes
Route::prefix('admin')->group(function() {
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard')->middleware('admin');

    Route::get('/profile', 'AdminController@profile')->name('admin.profile');
    Route::post('/update_profile', 'AdminController@updateProfile')->name('admin.update_profile');
    // category
    Route::get('/category', 'AdminController@category')->name('admin.category')->middleware('admin');
    Route::get('/category-add', 'AdminController@categoryAdd')->name('admin.category.add')->middleware('admin');
    Route::post('/category-add', 'AdminController@categoryStore')->name('admin.category.store')->middleware('admin');
    Route::get('/category-edit/{id}', 'AdminController@categoryEditView')->name('admin.category.edit.view')->middleware('admin');
    Route::post('/category-edit/{id}', 'AdminController@categoryEdit')->name('admin.category.edit')->middleware('admin');
    Route::get('/category-remove/{id}', 'AdminController@categoryRemove')->name('admin.category.remove')->middleware('admin');

    // kits
    Route::get('/collection', "AdminController@collection")->name('admin.collection')->middleware('admin');
    Route::get('/collection-add', 'AdminController@collectionAdd')->name('admin.collection.add')->middleware('admin');
    Route::post('/collection-add', 'AdminController@collectionStore')->name('admin.collection.store')->middleware('admin');
    Route::get('/collection-edit/{id}', 'AdminController@collectionEditView')->name('admin.collection.edit.view')->middleware('admin');
    Route::post('/collection-edit/{id}', 'AdminController@collectionEdit')->name('admin.collection.edit')->middleware('admin');
    Route::get('/collection-remove/{id}', 'AdminController@collectionRemove')->name('admin.collection.remove')->middleware('admin');

    //coupons
    Route::get('/coupon', "AdminController@couponIndex")->name('admin.coupons')->middleware('admin');
    Route::get('/coupon-add', 'AdminController@couponCreate')->name('admin.coupon.add')->middleware('admin');
    Route::post('/coupon-add', 'AdminController@couponStore')->name('admin.coupon.store')->middleware('admin');
    Route::get('/coupon-edit/{id}', 'AdminController@couponEdit')->name('admin.coupon.edit.view')->middleware('admin');
    Route::put('/coupon-edit/{id}', 'AdminController@couponUpdate')->name('admin.coupon.edit')->middleware('admin');

    // products
    Route::get('/product', 'AdminController@product')->name('admin.product')->middleware('admin');
    Route::get('/product-add', 'AdminController@productAdd')->name('admin.product.add')->middleware('admin');
    Route::post('/product-add', 'AdminController@productStore')->name('admin.product.store')->middleware('admin');
    Route::get('/product-edit/{id}', 'AdminController@productShow')->name('admin.product.show')->middleware('admin');
    Route::post('/product-edit/{id}', 'AdminController@productEdit')->name('admin.product.edit')->middleware('admin');
    Route::get('/product-remove/{id}', 'AdminController@productRemove')->name('admin.product.remove')->middleware('admin');

    // orders
    Route::get('/orders', 'AdminController@orders')->name('admin.orders')->middleware('admin');
    Route::get('/order-details/{id}','AdminController@orderDetails')->name('order.details')->middleware('admin');
    Route::get('/order-dispatch', 'AdminController@orderDispatch')->name('order.dispatch')->middleware('admin');

    // users
    Route::get('/customer', 'AdminController@customer')->name('admin.customer')->middleware('admin');
    Route::get('/customer-confirmed/{id}', 'AdminController@customerConfirmed')->name('admin.customer.confirmed');

    Route::get('/site-settings', 'AdminController@siteSettings')->name('admin.siteSettings')->middleware('admin');
    Route::post('/site-settings', 'AdminController@updateSiteSettings')->name('update.siteSettings')->middleware('admin');

    Route::get('/email-notification', 'AdminController@emailNotification')->name('admin.email_notification')->middleware('admin');
    Route::post('/email-notification', 'AdminController@emailNotificationUpdate')->name('admin.email_notification_update')->middleware('admin');

    // Route::get('/csv-import', 'AdminController@import')->name('admin.import')->middleware('admin');
    // Route::post('/csv-import', 'AdminController@importCsv')->name('admin.import.csv')->middleware('admin');



    Route::post('stripe' , 'StripeController@stripePost')->name('stripe.post');
    Route::get('/cache/clear', function () {
        Artisan::call('optimize:clear');
        return back()->withSuccess(__('System Cache Has Been Removed.'));
    });

});

Route::get('/cache', function() {
    Artisan::call('optimize:clear');
    // return redirect()->route('home')->withSuccess(__('System Cache Has Been Removed.'));
  });
