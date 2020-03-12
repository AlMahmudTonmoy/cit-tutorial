<?php

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

//frontend controller routes
Route::get('/', 'FrontendController@index');
Route::get('contact', 'FrontendController@contact');
Route::post('contact/submit', 'FrontendController@contactsubmit');
Route::get('about', 'FrontendController@about');
Route::get('products/{fproduct_id}/{fproduct_slug}', 'FrontendController@productdetals');
Route::get('customer/register', 'FrontendController@customerregister');
Route::post('customer/register/insert', 'FrontendController@customerregisterinsert')->name('customerregisterinsert');

Auth::routes(['verify' => true]);

//dashboard controller routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add/coupon', 'HomeController@addcoupon')->name('addcoupon');
Route::post('/coupon/insert', 'HomeController@couponinsert')->name('couponinsert');

//product Controller Routes
Route::prefix('product')->group(function () {
  Route::group(['middleware' => ['checkrole']], function () {
    Route::get('/', 'ProductController@product');
    Route::post('/insert', 'ProductController@productinsert');
    Route::get('/delete/{product_id}', 'ProductController@productdelete');
    Route::get('/restore/{product_id}', 'ProductController@productrestore');
    Route::get('/force/delete/{product_id}', 'ProductController@productforcedelete');
    Route::get('/edit/{product_id}', 'ProductController@productedit')->name('productedit');
    Route::post('/edit', 'ProductController@productupdate');
  });
});



//category Controller Routes
Route::resource('/category', 'CategoryController');

//contact controller routes
Route::get('/contact/messages', 'ContactController@contactmessages')->name('contactmessages');
Route::get('contact/upload/download/{file_name}', 'ContactController@contactuploaddownload')->name('contactuploaddownload');

//user Controller Routes
Route::get('/profile', 'UserController@profile')->name('profile');
Route::post('/password/change', 'UserController@passwordchange')->name('passwordchange');




// just a comment and reply sec
Route::get('/comments', 'CommentsController@comment');
Route::post('/comment/insert', 'CommentsController@commentinsert');

Route::get('/comment/reply/{comment_id}', 'RepliesController@commentreply');
Route::post('/reply/insert', 'RepliesController@replyinsert');
// comment and reply sec ends here

//slider controller
Route::get('/slider', 'SliderController@slider')->name('slider');
Route::post('/slider/insert', 'SliderController@sliderinsert')->name('sliderinsert');

//Cart controller
Route::post('add/to/cart', 'CartController@addtocart')->name('addtocart');
Route::get('/cart', 'CartController@cart')->name('cart');
Route::get('/cart/{coupon_code}', 'CartController@cart')->name('cartwithcoupon');
Route::get('/cart/delete/{cart_id}', 'CartController@cartdelete')->name('cartdelete');
Route::post('/cart/update', 'CartController@cartupdate')->name('cartupdate');

//customer route
Route::get('customer/dashboard', 'CustomerController@customerdashboard')->name('customerdashboard');
Route::get('download/pdf/{sale_id}', 'CustomerController@downloadpdf')->name('downloadpdf');

//github Controller Socialite
Route::get('login/github', 'GithubController@redirectToProvider');
Route::get('login/github/callback', 'GithubController@handleProviderCallback');

//google Controller Socialite
Route::get('login/google', 'GoogleController@redirectToProvider');
Route::get('login/google/callback', 'GoogleController@handleProviderCallback');

//checkout Controllers
Route::get('/checkout', 'CheckoutController@checkout')->name('checkout');
Route::get('/checkout/{coupon_code}', 'CheckoutController@checkout')->name('checkoutwithcoupon');
Route::post('/getcitylist', 'CheckoutController@getcitylist')->name('getcitylist');

//Stripe Controllers
Route::post('stripe/payment', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
