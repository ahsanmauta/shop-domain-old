<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\front\FPage;
use App\Http\Controllers\front\Domain;
use App\Http\Controllers\users\FPageUser;
use App\Http\Controllers\users\Auction;
use App\Http\Controllers\users\FBids;
use App\Http\Controllers\users\Deposit;
use App\Http\Controllers\users\Payment;
use App\Http\Controllers\users\Paypal;

use App\Http\Controllers\admins\AdminPage;
use App\Http\Controllers\admins\AdminUser;
use App\Http\Controllers\admins\AdminAuction;
use App\Http\Controllers\admins\AdminDeposit;
use App\Http\Controllers\admins\AdminPayment;
use App\Http\Controllers\admins\AdminReport;
use App\Http\Controllers\admins\AdminSetting;

// Main Page Route
Route::get('/', [FPage::class, 'index'])->name('home');


Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// locale
Route::get('/lang/{locale}', [LanguageController::class, 'swap']);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

// authentication
Route::get('/login', [LoginBasic::class, 'index'])->name('login');
Route::post('/login-submit', [LoginBasic::class, 'login'])->name('auth-login-submit');
Route::get('/logout', [LoginBasic::class, 'logout'])->name('logout');
Route::get('/change-password', [LoginBasic::class, 'change'])->name('change-password');
Route::post('/passreset', [LoginBasic::class, 'passreset'])->name('passreset');
Route::get('/freset', [LoginBasic::class, 'freset'])->name('freset');
Route::post('/reset-password', [LoginBasic::class, 'resetpassword'])->name('reset-password');
Route::get('/forget/{id}', [LoginBasic::class, 'forget'])->name('forget');
Route::post('/forgetsave', [LoginBasic::class, 'forgetsave'])->name('forgetsave');


Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/reload-captcha', [RegisterBasic::class, 'reloadcaptcha'])->name('reloadcaptcha');
Route::post('/auth/register-detail', [RegisterBasic::class, 'actionregister1'])->name('auth-register-detail');
Route::post('/auth/register-submit', [RegisterBasic::class, 'actionregister2'])->name('auth-register-submit');

Route::get('/domains', [Domain::class, 'index'])->name('domains');
Route::get('/domains/filter', [Domain::class, 'filter'])->name('domains-filter');
Route::get('/bidview/{id}', [Domain::class, 'bidview'])->name('bidview');

Route::post('/callback', [FBids::class, 'callback'])->name('callback');
Route::get('/updateref', [FBids::class, 'updateref'])->name('updateref');

Route::post('/cbdeposit', [Deposit::class, 'cbdeposit'])->name('cbdeposit');
Route::get('/rtdeposit', [Deposit::class, 'rtdeposit'])->name('rtdeposit');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
	
	Route::get('/', [AdminPage::class, 'index'])->name('pages-admin');
	Route::get('/userlist/{id}', [adminuser::class, 'userlist'])->name('admin-userlist');
	Route::post('/deluser', [AdminUser::class, 'deluser'])->name('deluser');
	Route::get('/sendemail', [adminuser::class, 'sendemail'])->name('admin-sendemail');
	Route::post('/emailsave', [AdminUser::class, 'emailsave'])->name('emailsave');
	Route::get('/adminuser/active', [adminuser::class, 'userlistactive'])->name('userlistactive');
	Route::get('/adminuser/{id}/suspend', [adminuser::class, 'usersuspend'])->name('usersuspend');
	Route::resource('adminuser', AdminUser::class);
	
	Route::get('/auctionlist', [AdminAuction::class, 'auctionlist'])->name('admin-auctionlist');
	Route::get('/auctionbid', [AdminAuction::class, 'indexbid'])->name('admin-indexbid');
	Route::get('/bidlist', [AdminAuction::class, 'bidlist'])->name('admin-bidlist');
	Route::post('/destroybid/{id}', [AdminAuction::class, 'destroybid'])->name('admin-destroybid');
	Route::get('/bidlistbyauction/{id}', [AdminAuction::class, 'bidlistbyauction'])->name('admin-bidlistbyauction');
	Route::get('/adminauction/bidshow/{id}', [AdminAuction::class, 'bidshow'])->name('admin-bidshow');
	Route::get('/auctionwin', [AdminAuction::class, 'auctionwin'])->name('admin-auctionwin');
	Route::get('/auctionpaid', [AdminAuction::class, 'auctionpaid'])->name('admin-auctionpaid');
	Route::get('/bidwin', [AdminAuction::class, 'bidwin'])->name('admin-bidwin');
	Route::get('/bidpaid', [AdminAuction::class, 'bidpaid'])->name('admin-bidpaid');
	Route::resource('adminauction', AdminAuction::class);
	
	Route::get('/depositlist/{id}', [AdminDeposit::class, 'depositlist'])->name('admin-depositlist');
	Route::get('/admindeposit/duitku', [AdminDeposit::class, 'admindeposit1'])->name('admin-admindeposit1');
	Route::get('/admindeposit/paypal', [AdminDeposit::class, 'admindeposit2'])->name('admin-admindeposit2');
	Route::resource('admindeposit', AdminDeposit::class);
	
	Route::get('/paymentlist/{id}', [AdminPayment::class, 'paymentlist'])->name('admin-paymentlist');
	Route::get('/adminpayment/duitku', [AdminPayment::class, 'adminpayment1'])->name('admin-adminpayment1');
	Route::get('/adminpayment/paypal', [AdminPayment::class, 'adminpayment2'])->name('admin-adminpayment2');
	Route::resource('adminpayment', AdminPayment::class);
	
	Route::get('/histlogin', [AdminReport::class, 'histlogin'])->name('admin-histlogin');
	Route::get('/histlogindata', [AdminReport::class, 'histlogindata'])->name('admin-histlogindata');
	Route::get('/histloginview/{id}', [AdminReport::class, 'histloginview'])->name('admin-histloginview');
	Route::get('/histtrans', [AdminReport::class, 'histtrans'])->name('admin-histtrans');
	Route::get('/histtransdata/{id}', [AdminReport::class, 'histtransdata'])->name('admin-histtransdata');
	Route::get('/histnotif', [AdminReport::class, 'histnotif'])->name('admin-histnotif');
	Route::get('/histnotifdata/{id}', [AdminReport::class, 'histnotifdata'])->name('admin-histnotifdata');
	Route::resource('adminreport', AdminReport::class);
	
	Route::get('/saveconf', [AdminSetting::class, 'saveconf'])->name('admin-saveconf');
	Route::get('/setting/profile', [AdminSetting::class, 'profile'])->name('setting-profile');
	Route::get('/setting/duitku', [AdminSetting::class, 'duitku'])->name('setting-duitku');
	Route::get('/setting/paypal', [AdminSetting::class, 'paypal'])->name('setting-paypal');
	Route::get('/setting/email', [AdminSetting::class, 'email'])->name('setting-email');
	Route::get('/setting/bid', [AdminSetting::class, 'bid'])->name('setting-bid');
	Route::post('/setting/profile/save', [AdminSetting::class, 'profilesave'])->name('setting-profile-save');
	Route::post('/setting/duitku/save', [AdminSetting::class, 'duitkusave'])->name('setting-duitku-save');
	Route::post('/setting/paypal/save', [AdminSetting::class, 'paypalsave'])->name('setting-paypal-save');
	Route::post('/setting/email/save', [AdminSetting::class, 'emailsave'])->name('setting-email-save');
	Route::post('/setting/bid/save', [AdminSetting::class, 'bidsave'])->name('setting-bid-save');
	Route::resource('adminsetting', AdminSetting::class);
	
});

Route::group(['middleware' => ['auth'], 'prefix' => 'users', 'as' => 'users.'], function () {
	
	Route::get('/', [FPageUser::class, 'index'])->name('pages-user');
	Route::resource('puser', FPageUser::class);
	Route::resource('auction', Auction::class);
	Route::get('/bidnow/{id}', [Domain::class, 'bidnow'])->name('bidnow');
	Route::post('/bidsave', [Domain::class, 'bidsave'])->name('bidsave');
	Route::get('/bidlist', [FBids::class, 'index'])->name('bidlist');
	Route::get('/bidwinnner', [FBids::class, 'bidwinnner'])->name('bidwinnner');
	Route::get('/bidwinnners/{id}', [Domain::class, 'bidwinnners'])->name('bidwinnners');
	Route::post('/winsave', [Domain::class, 'winsave'])->name('winsave');
	Route::get('/payment/{id}', [FBids::class, 'payment'])->name('payment');
	Route::post('/paymentsend', [FBids::class, 'paymentsend'])->name('paymentsend');
	Route::resource('deposit', Deposit::class);
	Route::resource('payment', Payment::class);
	Route::get('/paypal/button1/{id}', [Paypal::class, 'buttonPaypal1'])->name('paypal-button1');
	Route::get('/paypal/button2/{id}', [Paypal::class, 'buttonPaypal2'])->name('paypal-button2');
	Route::get('/paypal/deposit', [Paypal::class, 'depositPaypal'])->name('paypal-deposit');
	Route::get('/paypal/depositback', [Paypal::class, 'depositback'])->name('paypal-depositback');
	Route::post('/paypal/depositsave', [Paypal::class, 'depositsave'])->name('paypal-depositsave');
	
	Route::get('/paypal/payment/{id}', [Paypal::class, 'paymentPaypal'])->name('paypal-payment');
	Route::get('/paypal/paymentback', [Paypal::class, 'paymentback'])->name('paypal-paymentback');
	Route::post('/paypal/paymentsave', [Paypal::class, 'paymentsave'])->name('paypal-paymentsave');

	
});
