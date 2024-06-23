    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AddMoneyController;
use App\Http\Controllers\AdminShowPaymentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\AffilateController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPaymentController;
use App\Http\Controllers\CuponSettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminEmailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CommunityTokenController;
use App\Http\Controllers\BaseMindController;
use App\Http\Middleware\PreventDuplicate;

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


Route::get('/runfinacron', function() {
    $exitCode = Artisan::call('Bonus:daily');
    return 'Cron Run Success';
});


//Route::get('/home2', [App\Http\Controllers\HomeController::class, 'landing']);
// Route::get('/', function () {
//     return view('dist.index');
// });
Route::get('/', function () {
    return view('auth.login');
});

// Route::with(['web', 'csrf'])->get('/', function () {
//     return view('auth.login');
// });

Route::get('/bmindteaminvest', [FrontendController::class, 'bmindteaminvest'])->name('bmindteaminvest')->middleware('auth');


Auth::routes();
// routes/web.php
Route::post('/check-duplicate', [App\Http\Controllers\Auth\RegisterController::class, 'checkDuplicate'])->name('checkDuplicate');

Route::get('/home/wallet/{id}', [FrontendController::class, 'wallet12'])->name('wallet')->middleware('auth');


Route::get('/home/elite_club/{id}', [FrontendController::class, 'elite_club'])->name('elite-club')->middleware('auth');

Route::middleware([PreventDuplicate::class])->group(function(){
    Route::post('/user/add-fund-elite/store', [AddMoneyController::class,'StoreUSD'])
    ->name('money-store-elite')
    ->middleware(['auth']);
});
// Route::post('/user/add-fund-elite/store', [AddMoneyController::class,'StoreUSD'])->name('money-store-elite')->middleware('auth');
Route::post('/user/join-elite', [AddMoneyController::class,'joinElite'])->name('join-elite')->middleware('auth');

Route::get('/career1', function () {
    return view('user.pages.career1');
})->name('career')->middleware('auth');

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'registration'])->name('registration');
Route::get('/home', [App\Http\Controllers\FrontendController::class, 'index'])->name('home')->middleware('auth');
//user contact us 
Route::get('/home/contact_us/{id}', [FrontendController::class, 'ContactUs'])->middleware('auth');
Route::post('/contact/store', [FrontendController::class,'storeContact']);
//User package
Route::get('/home/buy_staking/{id}', [FrontendController::class, 'buy_staking'])->middleware('auth');
Route::post('/home/buy_staking/store', [FrontendController::class, 'store_staking'])->name('buy-staking')->middleware('auth');
Route::get('/home/buy_mstaking/{id}', [FrontendController::class, 'buy_mstaking'])->middleware('auth');
Route::post('/home/buy_mstaking/store', [FrontendController::class, 'store_mstaking'])->name('buy-mstaking')->middleware('auth');
Route::get('/home/buy_package/{id}', [FrontendController::class, 'buy_package'])->middleware('auth');
Route::post('/home/buy_package/store', [FrontendController::class, 'store_package'])->name('buy-package')->middleware('auth');
Route::post('/home/buy_package-bonus/store', [FrontendController::class, 'store_package_bonus'])->name('buy-package-bonus')->middleware('auth');
Route::get('/home/become-merchant/{id}', [FrontendController::class, 'become_merchant'])->middleware('auth');
Route::post('/home/become-merchant/save', [FrontendController::class, 'become_merchant_save'])->name('store-merchant')->middleware('auth');
Route::get('/home/coupon/{id}', [FrontendController::class, 'coupon'])->middleware('auth');
Route::post('/home/coupon-store/save', [FrontendController::class, 'coupon_store'])->name('store-coupon')->middleware('auth');
Route::post('/validate-coupon', [FrontendController::class,'validateCoupon'])->name('validate-coupon');

//User Community Token
Route::get('/home/community_token/{id}', [FrontendController::class, 'buy_community_token'])->name('buy_community_token')->middleware('auth');
Route::middleware([PreventDuplicate::class])->group(function(){
    Route::post('/home/buy_bmind/store', [FrontendController::class, 'store_bmind'])->name('buy-bmind')->middleware('auth');
});
Route::get('/home/buy-bmind/{id}', [FrontendController::class, 'bmindStages'])->middleware('auth');
Route::post('/home/bmind/update-daily-bonus', [FrontendController::class, 'bmindDailyBonusUpdate'])->name('bmindDailyBonusUpdate');

//User Community Token History
Route::get('/home/bmind-staking-history/{id}', [FrontendController::class, 'bmind_staking_history'])->middleware('auth');
Route::get('/home/bmind-sponsor-bonus-history/{id}', [FrontendController::class, 'bmindSponsorBonus'])->middleware('auth');
Route::get('/home/bmind-daily-bonus-history/{id}', [FrontendController::class, 'BmindStakingBonus'])->middleware('auth');
Route::get('/home/bmind-level-bonus-history/{id}', [FrontendController::class, 'bmindLevelBonus'])->middleware('auth');
Route::get('/dailybonus', [FrontendController::class, 'dailybonus1']);


//user transaction report
Route::get('/home/transactions/{id}', [FrontendController::class, 'manage_transaction'])->middleware('auth');
//user profile
Route::get('/home/user-profile/{id}', [ProfileController::class, 'profile'])->middleware('auth');
Route::post('/home/update-profile/store', [ProfileController::class, 'UpdateProfile'])->name('update-profile')->middleware('auth');
Route::post('/home/user-password/change-password-store',[ProfileController::class,'changePassStore'])->name('change-password-store')->middleware('auth');
Route::get('/home/my_asset/{id}', [FrontendController::class, 'my_asset'])->middleware('auth');
Route::get('/home/staking-history/{id}', [FrontendController::class, 'my_asset_staking'])->middleware('auth');
Route::get('/home/mstaking-history/{id}', [FrontendController::class, 'my_asset_mstaking'])->middleware('auth');
//Usr payment method
Route::get('/home/user-payment-method/{id}', [UserPaymentController::class, 'index'])->middleware('auth');
Route::get('/home/user-wallet-settings/{id}', [UserPaymentController::class, 'wallet'])->middleware('auth');
Route::post('/home/user-payment-method/store', [UserPaymentController::class, 'store'])->name('user-payment-method')->middleware('auth');
Route::post('/home/user-payment-method/update', [UserPaymentController::class, 'update'])->name('user-payment-method-update')->middleware('auth');
Route::post('/home/user-wallet/store', [UserPaymentController::class, 'storeWallet'])->name('user-wallet-add')->middleware('auth');
Route::post('/home/user-wallet/update', [UserPaymentController::class, 'updateWallet'])->name('user-wallet-update')->middleware('auth');
Route::post('/home/add-money-auto', [PaymentController::class,'create'])->name('metamask.create'); 

// User Withdraw
Route::get('/home/withdraw/{id}', [AddMoneyController::class, 'withdraw_manage'])->middleware('auth');
Route::post('/home/withdraw/store', [AddMoneyController::class, 'withdraw_store'])->name('withdraw-store')->middleware('auth');

//
Route::get('/home/withdraw-usd/{id}', [AddMoneyController::class, 'withdrawUSD'])->name('withdrawUSD')->middleware('auth');
Route::post('/home/withdraw-usd/store', [AddMoneyController::class, 'withdrawUsdStore'])->name('withdrawUsdStore')->middleware('auth');
Route::post('withdraw-usd-confirmation/', [AddMoneyController::class, 'withdrawUsdconfirmation'])->middleware('auth')->name('withdraw-usd-confirmation');
Route::post('withdraw-usd-cancel/', [AddMoneyController::class, 'withdrawUsdcancel'])->middleware('auth')->name('withdraw-usd-cancel');

//user token withdraw 
Route::get('/home/withdraw-bonus/{id}', [AddMoneyController::class, 'withdrawbonus_manage'])->middleware('auth');
Route::middleware([PreventDuplicate::class])->group(function(){
    Route::post('/home/withdraw-bonus/store', [AddMoneyController::class, 'withdrawbonus_store'])->name('withdrawbonus-store')->middleware('auth');
    Route::post('withdraw-bonus-confirmation/', [AddMoneyController::class, 'withdrawconfirmation'])->middleware('auth')->name('withdraw-bonus-confirmation');
    Route::post('withdraw-bonus-cancel/', [AddMoneyController::class, 'withdrawMindCancel'])->middleware('auth')->name('withdraw-mind-cancel');

});

//user fund transfer
Route::get('/home/fund-transfer/{id}', [FrontendController::class, 'fund_transfer'])->middleware('auth');
Route::post('/home/fund-transfer/store', [FrontendController::class, 'fund_transfer_store'])->name('fund-transfer')->middleware('auth');

Route::get('/home/send-bonus/{id}', [FrontendController::class, 'send_bonus'])->middleware('auth');
Route::get('/home/send-usdt/{id}', [FrontendController::class, 'send_usdt'])->middleware('auth');

Route::post('/home/send-bonus/store', [FrontendController::class, 'send_bonus_store'])->name('send-bonus')->middleware('auth');
Route::post('/home/send-usdt/store', [FrontendController::class, 'send_usdt_store'])->name('send-usdt')->middleware('auth');

//user buy/sell token
Route::post('/home/buy_token/store', [FrontendController::class, 'store_buy_token'])->name('buy-token')->middleware('auth');
Route::post('/home/sell_token/store', [FrontendController::class, 'store_sell_token'])->name('sell-token')->middleware('auth');
//user payment
Route::get('/home/add-fund/{id}', [App\Http\Controllers\AddMoneyController::class, 'index'])->name('add-money')->middleware('auth');
Route::get('/home/approve_fund/{amount}/{description}', [App\Http\Controllers\AddMoneyController::class, 'approveFund'])->middleware('auth');

Route::post('/user/add-fund/store', [AddMoneyController::class,'Store'])->name('money-store')->middleware('auth');
Route::post('/user/add-fund/manually/store', [AddMoneyController::class,'StoreManual'])->name('money-store-manual')->middleware('auth');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware(['is_admin']);
Route::post('/home/get-sponsor', [RegisterController::class,'getSponsor'])->name('get-sponsor');
Route::post('/home/get-user', [HomeController::class,'getUser'])->name('get-users');

//user affilate
Route::get('/home/my-affilate/{id}', [AffilateController::class, 'index'])->name('affilates')->middleware('auth');
Route::get('/home/add-affilate/{id}', [AffilateController::class, 'add_affilate'])->middleware('auth');
Route::post('/home/add-affilate/store', [AffilateController::class, 'userAdd'])->name('affilate-add')->middleware('auth');


//general settings
Route::get('admin/general-settings', [SettingsController::class, 'index'])->name('general-settings')->middleware(['is_admin']);
Route::get('admin/general-settings/new', [SettingsController::class, 'index'])->name('admin-general-settings')->middleware(['is_admin']);

//payment type route
Route::get('admin/payment-type', [AdminPaymentController::class, 'payment_type'])->name('admin-payment-type')->middleware(['is_admin']);
Route::post('admin/payment-type/store', [AdminPaymentController::class, 'payment_type_store'])->name('payment-type-store')->middleware(['is_admin']);
Route::post('admin/payment-type/update', [AdminPaymentController::class, 'payment_type_update'])->name('payment-type-update')->middleware(['is_admin']);
Route::get('/admin/payment-type/delete/{id}', [AdminPaymentController::class, 'payment_type_delete'])->middleware(['is_admin']);

//payement way route
Route::get('admin/payment-way', [AdminPaymentController::class, 'payment_way'])->name('admin-payment-way')->middleware(['is_admin']);
Route::post('admin/payment-way/store', [AdminPaymentController::class, 'payment_way_store'])->name('payment-way-store')->middleware(['is_admin']);
Route::post('admin/payment-way/update', [AdminPaymentController::class, 'payment_way_update'])->name('payment-way-update')->middleware(['is_admin']);
Route::get('/admin/payment-way/delete/{id}', [AdminPaymentController::class, 'payment_way_delete'])->middleware(['is_admin']);

//acccount info
Route::get('admin/account-info', [AdminPaymentController::class, 'account_info'])->name('admin-account-info')->middleware(['is_admin']);
Route::post('admin/account-info/store', [AdminPaymentController::class, 'account_info_store'])->name('account-info-store')->middleware(['is_admin']);
Route::post('admin/account-info/update', [AdminPaymentController::class, 'account_info_update'])->name('account-info-update')->middleware(['is_admin']);
Route::get('/admin/account-info/delete/{id}', [AdminPaymentController::class, 'account_info_delete'])->middleware(['is_admin']);

//admin show payment reqs
Route::get('/admin/add-deposit-usd/requests', [AdminShowPaymentController::class,'depositUSD'])->name('deposit-elite')->middleware(['is_admin']);
Route::get('/admin/add-usd-approve/usd/{id}', [AdminShowPaymentController::class,'approveUSD'])->middleware(['is_admin']);
Route::get('/admin/add-money-rejected/usd/{id}', [AdminShowPaymentController::class,'rejectUSD'])->middleware(['is_admin']);

Route::get('/admin/add-money/requests', [AdminShowPaymentController::class,'Manage'])->name('deposit-manage')->middleware(['is_admin']);
Route::get('/admin/add-money-approve/{id}', [AdminShowPaymentController::class,'approve'])->middleware(['is_admin']);
Route::get('/admin/add-money-reject/{id}/{user_id}/{amount}', [AdminShowPaymentController::class,'rejected'])->middleware(['is_admin']);
Route::get('/admin/add-money-rejected/{id}', [AdminShowPaymentController::class,'rejectedDeposit'])->middleware(['is_admin']);
//admin withdraw Request
Route::get('/admin/withdraw/requests', [AdminShowPaymentController::class,'ManageWithdraw'])->name('withdraw-manage1')->middleware(['is_admin']);
Route::post('/admin/withdraw-approve', [AdminShowPaymentController::class,'withdrawapprove'])->name('musd-withdraw-approve')->middleware(['is_admin']);
Route::get('/admin/withdraw-reject/{id}/{user_id}/{amount}', [AdminShowPaymentController::class,'withdrawrejected'])->middleware(['is_admin']);

//admin usd withdraw Request
Route::get('/admin/usd-withdraw/requests', [AdminShowPaymentController::class,'ManageUsdWithdraw'])->name('usd-withdraw-manage')->middleware(['is_admin']);
Route::post('/admin/usd-withdraw-approve', [AdminShowPaymentController::class,'withdrawUsdApprove'])->name('usd-withdraw-approve')->middleware(['is_admin']);
Route::get('/admin/usd-withdraw-reject/{id}/{user_id}/{amount}', [AdminShowPaymentController::class,'withdrawUsdRejected'])->middleware(['is_admin']);


//admin token withdraw req 
Route::get('/admin/withdraw-bonus/requests', [AdminShowPaymentController::class,'ManageWithdrawBonus'])->name('withdraw-bonus-manage')->middleware(['is_admin']);
Route::post('/admin/withdraw-bonus-approve', [AdminShowPaymentController::class,'withdrawbonusapprove'])->name('withdraw-bonus-approve')->middleware(['is_admin']);
Route::get('/admin/withdraw-bonus-reject/{id}/{user_id}/{amount}', [AdminShowPaymentController::class,'withdrawbonusrejected'])->middleware(['is_admin']);

// Settings Update
Route::post('admin/token-rate/update', [SettingsController::class, 'token_rate_update'])->name('token-rate-update')->middleware(['is_admin']);
Route::post('admin/ambassador/update', [SettingsController::class, 'ambassador_update'])->name('ambassador-update')->middleware(['is_admin']);
Route::post('admin/transfer-info/update', [SettingsController::class, 'transfer_info_update'])->name('transfer-info-update')->middleware(['is_admin']);
Route::post('admin/topbar-info/update', [SettingsController::class, 'topbar_info_update'])->name('topbar-info-update')->middleware(['is_admin']);

Route::post('admin/withdraw-info/update', [SettingsController::class, 'withdraw_info_update'])->name('withdraw-info-update')->middleware(['is_admin']);
Route::post('admin/usdt-withdraw-info/update', [SettingsController::class, 'usdt_withdraw_info_update'])->name('usdt-withdraw-info-update')->middleware(['is_admin']);
Route::post('admin/company-info/update', [SettingsController::class, 'company_update'])->name('company-update')->middleware(['is_admin']);
Route::post('admin/token_settings/update', [SettingsController::class, 'token_update'])->name('tokens-update')->middleware(['is_admin']);
Route::post('admin/level_settings/update', [SettingsController::class, 'level_update'])->name('update-level-settings')->middleware(['is_admin']);
Route::post('admin/staking_settings/update', [SettingsController::class, 'staking_update'])->name('update-staking-settings')->middleware(['is_admin']);
Route::post('admin/musdstaking_settings/update', [SettingsController::class, 'musdstaking_update'])->name('update-musdstaking-settings')->middleware(['is_admin']);
Route::post('admin/merchant_settings/update', [SettingsController::class, 'merchant_update'])->name('update-merchant-settings')->middleware(['is_admin']);
Route::post('admin/elite_settings/update', [SettingsController::class, 'elite_update'])->name('update-elite-settings')->middleware(['is_admin']);
Route::post('admin/banner_settings/update', [SettingsController::class, 'banner_update'])->name('banner-update')->middleware(['is_admin']);
//all users
Route::get('admin/user-lists', [HomeController::class, 'user_lists'])->name('admin-user-lists')->middleware(['is_admin']);
Route::get('admin/all-users', [HomeController::class, 'get_all_users'])->name('all-users')->middleware(['is_admin']);
Route::get('admin/all-kyc-lists', [FrontendController::class, 'all_kyc_lists'])->name('all_kyc_lists')->middleware(['is_admin']);
Route::post('admin/users/search', [HomeController::class, 'search_user'])->name('search_user')->middleware(['is_admin']);
Route::get('admin/ambassador-lists', [HomeController::class, 'ambassador_lists'])->name('admin-ambassador-lists')->middleware(['is_admin']);
Route::get('admin/merchant-lists', [HomeController::class, 'merchant_lists'])->name('admin-merchant-lists')->middleware(['is_admin']);
Route::get('admin/consultant-lists', [HomeController::class, 'consultant_lists'])->name('admin-consultant-lists')->middleware(['is_admin']);
Route::get('admin/elite-member-lists', [HomeController::class, 'elite_member_lists'])->name('admin-elite-member-lists')->middleware(['is_admin']);
Route::get('admin/consultant/add-user', [HomeController::class, 'add_consultant'])->name('admin-consultant-store')->middleware(['is_admin']);
Route::post('/admin/user-password/reset',[HomeController::class,'changePassword'])->name('reset-password')->middleware(['is_admin']);
//Cupon Settings
Route::prefix('admin')->group(function () {
    Route::resource('cupon-settings', CuponSettingsController::class);
});

Route::get('admin/cupon-settings/newcupon', [CuponSettingsController::class, 'index'])->name('cupon-settings.index')->middleware(['is_admin']);
Route::get('admin/cupon-settings', [HomeController::class, 'cupon_settings'])->name('cupon_settings')->middleware(['is_admin']);
Route::post('admin/cupon-settings/store', [HomeController::class, 'cupon_settings_store'])->name('cupon_settings_store')->middleware(['is_admin']);
//admin add money to user
Route::post('admin/add-money/store', [AddMoneyController::class, 'AdminAddMoney'])->name('admin-add-money')->middleware(['is_admin']);
Route::post('admin/add-money-usdt/store', [AddMoneyController::class, 'AdminAddUsdt'])->name('admin-add-money-usdt')->middleware(['is_admin']);
Route::post('admin/add-money/token/store', [AddMoneyController::class, 'AdminAddMoneyToken'])->name('admin-add-money-token')->middleware(['is_admin']);
Route::post('admin/add-money/bonus/store', [AddMoneyController::class, 'AdminAddMoneyBonus'])->name('admin-add-money-bonus')->middleware(['is_admin']);

//admin distribute amount to ambassador
Route::post('admin/ambassador/add-money/store', [AddMoneyController::class, 'AdminAmbassadorAddMoney'])->name('admin-add-ambassador-money')->middleware(['is_admin']);
Route::post('admin/ambassador/add-token/store', [AddMoneyController::class, 'AdminAmbassadorAddToken'])->name('admin-add-ambassador-token')->middleware(['is_admin']);



//admin package settings

Route::get('admin/community-token-list', [CommunityTokenController::class, 'communityToken'])->name('admin-community-token-list')->middleware(['is_admin']);
Route::post('admin/community-token/store', [CommunityTokenController::class, 'store'])->name('store-community-token')->middleware(['is_admin']);


//admin Bmind settings

Route::get('admin/base-mind-stage-list', [BaseMindController::class, 'index'])->name('baseMindStageList')->middleware('is_admin');
Route::post('admin/bmind-stage/store', [BaseMindController::class, 'store'])->name('storeBmindStage')->middleware('is_admin');
Route::get('/admin/bmindstage/edit/{id}', [BaseMindController::class, 'edit'])->middleware('is_admin');
Route::post('admin/bmind-stage/update', [BaseMindController::class, 'update'])->name('updateBmindStage')->middleware('is_admin');
Route::get('admin/bmind-user-target-settings', [BaseMindController::class, 'target_lists'])->name('admin-target-lists')->middleware('is_admin');
Route::post('admin/bmind-target-store', [BaseMindController::class, 'target_store'])->name('admin-target-store')->middleware('is_admin');

// Route::get('/admin/bmindstage/delete/{id}', [BaseMindController::class, 'delete'])->middleware('is_admin');

Route::get('admin/base-mind-package-settings', [BaseMindController::class, 'baseMindPacakgeSettings'])->name('baseMindPacakgeSettings')->middleware('is_admin');
Route::post('admin/base-mind-package-add', [BaseMindController::class, 'storeBmindPackage'])->name('baseMindPacakgeAdd')->middleware('is_admin');
Route::get('/admin/bmind-package/edit/{id}', [BaseMindController::class, 'baseMindPackageedit'])->middleware(['is_admin']);
Route::post('admin/bmind-package/update', [BaseMindController::class, 'updateBmindPackage'])->name('updateBmindPackage')->middleware('is_admin');

//admin package settings

Route::get('admin/packages', [PackageController::class, 'index'])->name('admin-packages')->middleware(['is_admin']);
Route::post('admin/packages/store', [PackageController::class, 'store'])->name('store-package')->middleware(['is_admin']);
Route::post('admin/packages/update', [PackageController::class, 'update'])->name('update-package')->middleware(['is_admin']);
Route::get('/admin/packages/delete/{id}', [PackageController::class, 'delete'])->middleware(['is_admin']);
Route::get('/admin/packages/edit/{id}', [PackageController::class, 'edit'])->middleware(['is_admin']);

Route::post('admin/make-ambassador', [HomeController::class, 'MakeAmbassador'])->name('make-ambassador')->middleware(['is_admin']);
Route::post('admin/make-consultant', [HomeController::class, 'MakeConsultant'])->name('make-consultant')->middleware(['is_admin']);
Route::post('admin/remove-consultant', [HomeController::class, 'RemoveConsultant'])->name('remove-consultant')->middleware(['is_admin']);
Route::post('admin/user-restrict', [HomeController::class, 'UserRestrict'])->name('user-restrict')->middleware(['is_admin']);
Route::post('admin/user-unrestrict', [HomeController::class, 'UserUnRestrict'])->name('user-unrestrict')->middleware(['is_admin']);

//admin transaction report 
Route::get('admin/transaction-report', [HomeController::class, 'AdminTransaction'])->name('admin-transaction-report')->middleware(['is_admin']);
//kyc verification
Route::get('/home/kyc-verification/{id}', [FrontendController::class, 'Kyc'])->middleware('auth');
Route::post('/home/kyc-verification/store', [FrontendController::class, 'KycStore'])->name('kyc-store')->middleware('auth');
Route::post('/home/kyc-verification/approve', [FrontendController::class, 'KycApprove'])->name('kyc-approve')->middleware('is_admin');
Route::get('/home/kyc-verifications', [FrontendController::class, 'KycVerification'])->name('kyc-verification')->middleware('is_admin');
Route::get('/home/kyc-verifications/reject/{id}', [FrontendController::class, 'KycReject'])->middleware('is_admin');

Route::get('/home/add-mind/{id}', [App\Http\Controllers\AddMoneyController::class, 'mind_index'])->middleware('auth');
Route::post('/user/add-mind/manually/store', [AddMoneyController::class,'StoreMindManual'])->name('token-store-manual')->middleware('auth');
Route::get('/admin/add-token/requests', [AdminShowPaymentController::class,'ManageToken'])->name('deposit-token-manage')->middleware(['is_admin']);

Route::get('/admin/add-token-approve/{id}', [AdminShowPaymentController::class,'approveToken'])->middleware('is_admin');
Route::get('/admin/add-token-reject/{id}/{user_id}/{amount}', [AdminShowPaymentController::class,'rejectedToken'])->middleware(['is_admin']);
Route::get('/admin/add-token-rejected/{id}', [AdminShowPaymentController::class,'rejectedDepositToken'])->middleware(['is_admin']);
Route::get('user-verification-email/{id}', [LoginController::class, 'verification'])->name('email-verification');

Route::post('send-bonus-confirmation/', [FrontendController::class, 'Coin_bonus_transfer_Confirm'])->middleware('auth')->name('send-bonus-confirmation');
Route::post('send-usdt-confirmation/', [FrontendController::class, 'usdt_transfer_Confirm'])->middleware('auth')->name('usdt-send-confirmation');

Route::post('send-fund-confirmation/', [FrontendController::class, 'TransferFundConfirm'])->middleware('auth')->name('send-fund-confirmation');
Route::post('withdraw-fund-confirmation/', [AddMoneyController::class, 'fundwithdrawconfirmation'])->middleware('auth')->name('withdraw-fund-confirmation');
Route::post('withdraw-fund-cancel/', [AddMoneyController::class, 'musdWithdrawCancel'])->middleware('auth')->name('musd-withdraw-cancel');

Route::get('admin/get-user-id/{id}', [HomeController::class, 'user_id'])->middleware('is_admin');
Route::get('admin/get-profile/{id}', [HomeController::class, 'profile_id'])->middleware('is_admin');
Route::get('admin/get-user-ajax/{name}', [HomeController::class, 'profile_id'])->middleware('is_admin')->name('user_ajax');

//Send email to user
Route::get('/admin/compose-email', [App\Http\Controllers\Admin\AdminEmailController ::class, 'compose'])->name('admin.compose.email')->middleware(['is_admin']);
Route::post('/admin/send-email', [App\Http\Controllers\Admin\AdminEmailController ::class, 'send'])->name('admin.send.email')->middleware(['is_admin']);
Route::post('ckeditor/upload', [AdminEmailController ::class, 'upload'])->name('ckeditor.image-upload')->middleware(['is_admin']);

//email verification 

Route::get('account/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');
Route::post('/logout', function (Request $request) {
    
            
  Auth::logout();
 
        return Redirect::route('login');
    

   
})->name('logout');
Route::get('admin/cashwallet-transaction', [HomeController::class, 'CashwalletTransaction'])->name('cash-wallet-transaction')->middleware('is_admin');
Route::get('admin/bonuswallet-transaction', [HomeController::class, 'BonuswalletTransaction'])->name('bonus-wallet-transaction')->middleware('is_admin');
Route::get('admin/tokenwallet-transaction', [HomeController::class, 'TokenwalletTransaction'])->name('token-wallet-transaction')->middleware('is_admin');



//user transaction report 

Route::get('/home/usd-staking-bonus-history/{id}', [FrontendController::class, 'usdStakingBonus'])->middleware('auth');
Route::get('/home/elite-sponsor-bonus-history/{id}', [FrontendController::class, 'eliteSponsorBonus'])->middleware('auth');
Route::get('/home/elite-deposit-history/{id}', [FrontendController::class, 'eliteDepositHistory'])->middleware('auth');


Route::get('/home/affilate-bonus-history/{id}', [FrontendController::class, 'AffiliateBonus'])->middleware('auth');
Route::get('/home/refferer-bonus-history/{id}', [FrontendController::class, 'ReffererBonus'])->middleware('auth');
Route::get('/home/daily-bonus-history/{id}', [FrontendController::class, 'DailyBonus'])->middleware('auth');
Route::get('/home/staking-bonus-history/{id}', [FrontendController::class, 'StakingBonus'])->middleware('auth');
Route::get('/home/level-bonus-history/{id}', [FrontendController::class, 'LevelBonus'])->middleware('auth');
Route::get('/home/transfer-history/{id}', [FrontendController::class, 'TransferHistory'])->middleware('auth');
Route::get('/home/withdraw-history/{id}', [FrontendController::class, 'WithdrawHistory'])->middleware('auth');
Route::get('/home/other-transaction-history/{id}', [FrontendController::class, 'OtherHistory'])->middleware('auth');
Route::get('/home/token-settlement-bonus-history/{id}', [FrontendController::class, 'TokenSettlement'])->middleware('auth');
Route::get('/home/user-redeem', [CuponSettingsController::class, 'user_cupon_index'])->name('user_cupon.index')->middleware('auth');
Route::get('/home/user-redeem/redeem/{id}', [CuponSettingsController::class, 'user_cupon_redeem'])->name('user_cupon.redeem')->middleware('auth');
