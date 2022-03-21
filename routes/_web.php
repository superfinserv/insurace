<?php

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

$WebRoutes = function() {
    //all main domain specific routes 
    
    Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
    });
    Route::get('/clear-route', function() {
        Artisan::call('route:clear');
        return "route is cleared";
    });
    Route::get('/clear-config', function() {
        Artisan::call('config:clear');
        return "config is cleared";
    });
    Route::get('/clear-view', function() {
        Artisan::call('view:clear');
        return "view is cleared";
    });
    
    //comming-soon
    Route::get('term-insurance', function () {
       return view('web.comming-soon.index', ['text' => 'Term-Insurance is under development.']);
    });
    Route::get('investment-plan', function () {
       return view('web.comming-soon.index', ['text' => 'Investment-Plan is under development.']);
    });
    Route::get('accidental-insurance', function () {
       return view('web.comming-soon.index', ['text' => 'Accidental-Insurance is under development.']);
    });
    Route::get('bus-insurance', function () {
       return view('web.comming-soon.index', ['text' => 'Bus-Insurance is under development.']);
    });
     Route::get('taxi-insurance', function () {
       return view('web.comming-soon.index', ['text' => 'Taxi-Insurance is under development.']);
    });
     Route::get('travel-insurance', function () {
       return view('web.comming-soon.index', ['text' => 'Travel-Insurance is under development.']);
    });
    
    
    
    // Route::get('/test-json/', 'Web\Healthinsurance@testJson');
    // Route::get('/test/vh', 'Web\Home@modelsNew');
    Route::post('sendotp/', 'Web\LoginAuth@sendotp');
    Route::post('resendotp', 'Web\LoginAuth@resendotp');
    Route::post('verifyotp/{mobile}', 'Web\LoginAuth@verifyOtp');
    Route::post('isuserexist', 'Web\LoginAuth@getCheckEmail');
    Route::post('customerDetails', 'Web\LoginAuth@customerDetails');
    Route::get('otp_modal/{msg}/{mobileno}', 'Web\LoginAuth@otp_modal');
    
    Route::get('/sign-in', 'Web\LoginAuth@index');
    Route::get('/logout', 'Web\Profile@logout');
   
    Route::group(['middleware' => 'auth:customers'], function() { 
        Route::get('/profile', 'Web\Profile@index');
    });
   
    
    Route::get('/', 'Web\Home@index');
    Route::get('home', 'Web\Home@index')->name('home');
    Route::get('about', 'Web\Home@aboutus')->name('about');
    Route::get('contact', 'Web\Home@contact')->name('contact');
    Route::get('artical', 'Web\Home@artical')->name('artical');
    Route::post('contact/send-mail', 'Web\Home@sendContactMail');
    Route::get('claims', 'Web\Home@ClaimsAssistance');
    Route::post('request-my-claim', 'Web\Home@claimMyRequest');
    Route::get('shipping', 'Web\Home@shipping');
    Route::get('privacy-policy', 'Web\Home@privacy');
    Route::get('terms-conditions', 'Web\Home@terms');
    Route::get('disclaimer', 'Web\Home@disclaimer');
    
    Route::get('get-cities/{state_id}', 'Common@getCities');
    Route::post('get-city-pincode/', 'Common@getCityPincode');
    Route::get('get-months/{year?}', 'Common@getMonths');
    
    Route::get('common/load-idv-modal/{type}/{device?}', 'Insurance@loadidvModal');
    Route::get('common/load-moter-premiumbreakup-modal/{typ}/{refId}', 'Insurance@moterPremiumBreakupModal');
    Route::get('common/load-tp-details-modal/{type}', 'Insurance@load_TP_details_Modal');
    Route::get('commomn/load-min-max-value/{type}/{device?}', 'Insurance@getminMaxassValue');
    Route::get('common/terms-and-conditions/{type}/{supplier}', 'Insurance@termsConditionsModel');
    Route::post('moter-insurance/genrate-payment-link', 'Insurance@genratePaymentLink');
    
    Route::post('get-policy-document', 'Insurance@getPolicyDoc');
    
    Route::get('getpdf/{no}', 'Insurance@policyfilledData');
    
    
    Route::get('policy/success/{type}/{enquiryID}','Insurance@successPage');
    Route::get('policy/cancel/{enquiryID}','Insurance@cancelPage');
    
    Route::get('moter-insurance/insured-success/{type}/{enquiryID}', 'Insurance@moterTransactionUpdate');//Moter
    Route::any('health-insurance/insured-success/{enquiryID}', 'Insurance@healthtransactionupdate');//Health
    Route::get('policy/document/download/{file}', 'Insurance@getDownload');
    Route::get('/get/download/file/{type}/{file}', 'Common@getFileDownloads');
    
    Route::get('/get-enquiry-details/{enQ}', 'Common@getEnquiryData');
    
    //BIKE
    Route::get('twowheeler-insurance', 'Motor\Twinsurance@index')->name('twowheeler-insurance');
    Route::get('twowheeler-insurance-detail/', 'Motor\Twinsurance@insuranceDetails');
    Route::get('twowheeler-insurance/registration-number/', 'Motor\Twinsurance@regNumber');
    Route::get('twowheeler-insurance/registration-location', 'Motor\Twinsurance@registrationLocation');
    Route::get('twowheeler-insurance/brand', 'Motor\Twinsurance@brand');
    Route::get('twowheeler-insurance/load-models/{brandId}/{brandName}', 'Motor\Twinsurance@loadTwModel');
    Route::get('twowheeler-insurance/model/{brand}', 'Motor\Twinsurance@model');
    Route::get('twowheeler-insurance/variant/{model}', 'Motor\Twinsurance@twVariant');
    Route::get('twowheeler-insurance/load-varients/{modelId}/{modelName}', 'Motor\Twinsurance@loadVarient');
    //Route::get('bike-insurance/fuel-type', 'Motor\Twinsurance@bike_fuel_type');
    Route::get('twowheeler-insurance/registration-year', 'Motor\Twinsurance@registrationYear');
    Route::get('twowheeler-insurance/expiry-detail', 'Motor\Twinsurance@expiryDetail');
    Route::get('twowheeler-insurance/ncb-transfer', 'Motor\Twinsurance@ncbTransfer');
    Route::get('twowheeler-insurance/plans/', 'Motor\Twinsurance@plansData');
   //Route::get('bike-insurance/get-idv/', 'Motor\Twinsurance@getLatestIdv');
    Route::post('twowheeler-insurance/load-plans/', 'Motor\Twinsurance@loadPlans');
    Route::post('twowheeler-insurance/load-plans-recalculate/', 'Motor\Twinsurance@loadPlansRecalculate');
    Route::post('twowheeler-insurance/create-enquiry/', 'Motor\Twinsurance@createEnquiry');
    //Route::post('bike-insurance/single-bike-plans-recalculate/', 'Web\Bikeinsurance@BikePlansRecalculateSingle');
    Route::get('twowheeler-insurance/users-information/{enquiryID}', 'Motor\Twinsurance@userInformationFrom');
    Route::post('twowheeler-insurance/update-info/{enQ}', 'Motor\Twinsurance@updateInfo');
    Route::post('twowheeler-insurance/create-proposal/{enquiryID}', 'Motor\Twinsurance@createProposal');
    Route::get('twowheeler-insurance/plan-summary/{enquiryID}', 'Motor\Twinsurance@plan_summary');
    Route::post('twowheeler-insurance/upload-files/{enquiryID}', 'Motor\Twinsurance@uploadFiles');
    Route::post('twowheeler-insurance/connect-to-insurer', 'Motor\Twinsurance@connectToinsurer');
    Route::get('twowheeler-insurance/policy/payments/{enquiryID}', 'Motor\Twinsurance@paymentlink');
    
    
    //CAR
    Route::get('car-insurance', 'Motor\Carinsurance@index')->name('twowheeler-insurance');
    Route::get('car-insurance-detail/', 'Motor\Carinsurance@insuranceDetails');
    Route::get('car-insurance/registration-number/', 'Motor\Carinsurance@regNumber');
    Route::get('car-insurance/registration-location', 'Motor\Carinsurance@registrationLocation');
    Route::get('car-insurance/brand', 'Motor\Carinsurance@brand');
    Route::get('car-insurance/load-models/{brandId}/{brandName}', 'Motor\Carinsurance@loadCarModel');
    Route::get('car-insurance/model/{brand}', 'Motor\Carinsurance@model');
    Route::get('car-insurance/variant/{model}', 'Motor\Carinsurance@carVariant');
    Route::get('car-insurance/load-varients/{modelId}/{modelName}', 'Motor\Carinsurance@loadVarient');
    Route::get('car-insurance/registration-year', 'Motor\Carinsurance@registrationYear');
    Route::get('car-insurance/expiry-detail', 'Motor\Carinsurance@expiryDetail');
    Route::get('car-insurance/ncb-transfer', 'Motor\Carinsurance@ncbTransfer');
    Route::get('car-insurance/plans/', 'Motor\Carinsurance@plansData');
    Route::post('car-insurance/load-plans/', 'Motor\Carinsurance@loadPlans');
    Route::post('car-insurance/load-plans-recalculate/', 'Motor\Carinsurance@loadPlansRecalculate');
    Route::post('car-insurance/create-enquiry/', 'Motor\Carinsurance@createEnquiry');
    Route::get('car-insurance/users-information/{enquiryID}', 'Motor\Carinsurance@userInformationFrom');
    Route::post('car-insurance/update-info/{enQ}', 'Motor\Carinsurance@updateInfo');
    Route::post('car-insurance/create-proposal/{enquiryID}', 'Motor\Carinsurance@createProposal');
    Route::get('car-insurance/plan-summary/{enquiryID}', 'Motor\Carinsurance@plan_summary');
    Route::post('car-insurance/upload-files/{enquiryID}', 'Motor\Carinsurance@uploadFiles');
    Route::post('car-insurance/connect-to-insurer', 'Motor\Carinsurance@connectToinsurer');
    
    
    
    
    // Route::get('/car-insurance', 'Web\Carinsurance@index')->name('car-insurance');
    // Route::get('/car-insurance-detail/', 'Web\Carinsurance@insuranceDetails');
    // Route::get('/car-insurance/car-number/', 'Web\Carinsurance@car_number');
    // Route::get('/car-insurance/registration-location', 'Web\Carinsurance@car_registration_location');
    // Route::get('/car-insurance/car-brand/', 'Web\Carinsurance@car_brand');
    // Route::get('/car-insurance/car-model/{brand}', 'Web\Carinsurance@car_model');
    // Route::get('/car-insurance/load-car-models/{brandId}/{brandName}', 'Web\Carinsurance@loadCarModel');
    // Route::get('/car-insurance/fuel-type', 'Web\Carinsurance@car_fuel_type');
    // Route::get('/car-insurance/car-variant/{model}', 'Web\Carinsurance@car_variant');
    // Route::get('/car-insurance/load-car-varients/{modelId}/{modelName}', 'Web\Carinsurance@loadCarVarient');
    // Route::get('/car-insurance/registration-year', 'Web\Carinsurance@car_registration_year');
    // Route::get('/car-insurance/expiry-detail', 'Web\Carinsurance@car_expiry_detail');
    // Route::get('car-insurance/car-plan/', 'Web\Carinsurance@car_plan');
    // Route::post('car-insurance/load-car-plans/', 'Web\Carinsurance@loadCarPlans');
    // Route::post('car-insurance/load-car-plans-recalculate/', 'Web\Carinsurance@loadCarPlansRecalculate');
    // Route::post('car-insurance/create-enquiry/', 'Web\Carinsurance@createEnquiry');
    // Route::post('car-insurance/create-proposal/{enquiryID}', 'Web\Carinsurance@createProposal');
    // Route::post('car-insurance/upload-files/{enquiryID}', 'Web\Carinsurance@uploadFiles');
    // Route::get('car-insurance/users-information/{enquiryID}', 'Web\Carinsurance@userInformationFrom');
    // Route::get('car-insurance/plan-summary/{enquiryID}', 'Web\Carinsurance@plan_summary');
    // Route::post('car-insurance/connect-to-insurer', 'Web\Carinsurance@connectToinsurer');
    // Route::get('car-insurance/policy/payments/{enquiryID}', 'Web\Carinsurance@paymentlink');
    
    
    /*  HEALTH INSURANCE */
    Route::get('health-insurance', 'Web\Healthinsurance@index')->name('health-insurance');
    Route::get('health-insurance-detail', 'Web\Healthinsurance@health_insurance_detail')->name('health-insurance-detail');
    Route::get('health-insurance/health-profile', 'Web\Healthinsurance@healthProfile');
    Route::get('health-insurance/health-profile-members', 'Web\Healthinsurance@healthProfileMembers');
    Route::get('health-insurance/health-members-age', 'Web\Healthinsurance@healthProfileMembersAge');
    Route::get('health-insurance/health-plans', 'Web\Healthinsurance@healthPlans');
    Route::post('health-insurance/get-health-plans', 'Web\Healthinsurance@getHealthPlans');
    Route::post('health-insurance/create-enquiry', 'Web\Healthinsurance@createEnquiry');
    Route::post('health-insurance/update-quote', 'Web\Healthinsurance@updateQuote');
    Route::post('health-insurance/update-quick-quote-with-addons', 'Web\Healthinsurance@updateQuickQuoteWithAddons');
    Route::post('health-insurance/update-zone-quick-quote', 'Web\Healthinsurance@updateZoneQuickQuote');
    
    Route::get('health-insurance/product-detail/{enquiryID}', 'Web\Healthinsurance@productDetails');
    Route::get('health-insurance/product-info/{enquiryID}', 'Web\Healthinsurance@productInfo');
    Route::get('health-insurance/proposal/{enquiryID}', 'Web\Healthinsurance@proposalDetails');
    Route::post('health-insurance/update-proposal', 'Web\Healthinsurance@updateProposal');
    
    Route::get('health-insurance/table-proposer/{enquiryID}', 'Web\Healthinsurance@proposerInfoTemplate');
    Route::get('health-insurance/table-insurer/{enquiryID}', 'Web\Healthinsurance@insurerInfoTemplate');
    Route::get('health-insurance/table-address/{enquiryID}', 'Web\Healthinsurance@addressInfoTemplate');
    Route::get('health-insurance/table-medical/{enquiryID}', 'Web\Healthinsurance@medicalInfoTemplate');
    Route::get('health-insurance/table-review/{enquiryID}', 'Web\Healthinsurance@reviewInfoTemplate');
    
    Route::post('health-insurance/create-premium', 'Web\Healthinsurance@createPremium');
    Route::post('health-insurance/update-premium-info', 'Web\Healthinsurance@updatePremiumInfo');
    Route::post('health-insurance/get-payment-form', 'Web\Healthinsurance@getPaymentForm');
    
    
    Route::get('health-insurance/declaration/{enquiryID}', 'Web\Healthinsurance@proposalDeclaration');
    Route::get('health-insurance/get-pay-data/{enquiryID}', 'Web\Healthinsurance@getPayData');
};

Route::group(array('domain' => 'superfinserv.co.in'), $WebRoutes);
Route::group(array('domain' => 'www.superfinserv.co.in'), $WebRoutes);

// Route::domain(env("APP_URL"))->group(function () {     
//     //all main domain specific routes 
// }); 


$pospRoutes = function() {
  // Route::get('/', 'Pos\Home@index');
   Route::get('/', 'Pos\HomeController@index')->name('home');
   Route::get('/faq', 'Pos\HomeController@faq');
   Route::get('/terms-conditions', 'Pos\HomeController@terms');
   Route::get('shipping', 'Web\Home@shipping');
   Route::get('privacy-policy', 'Web\Home@privacy');
   Route::get('disclaimer', 'Web\Home@disclaimer');
   Route::get('login', [ 'as' => 'login', 'uses' => 'Pos\AuthController@sign_in']);

Route::get('/forgot-password','Pos\AuthController@forgotPassword');
Route::post('/password-reset-email','Pos\AuthController@password_reset_email');
Route::get('/password/reset/{token}', 'Pos\AuthController@resetPassword');
Route::post('/reset-password/', 'Pos\AuthController@updatePassword');

Route::get('/sign-in', 'Pos\AuthController@sign_in');
Route::post('/auth-agent','Pos\AuthController@authAgent');


Route::get('register', 'Pos\AuthController@index')->name('register');
Route::post('sendotp', 'Pos\AuthController@sendotp');
Route::post('verifyotp', 'Pos\AuthController@verifyOtp');
Route::post('isuserexist', 'Pos\AuthController@getCheckEmail');
Route::post('isuserexistmobile', 'Pos\AuthController@getCheckMobile');
Route::post('isuserexistmobilecheck', 'Pos\AuthController@getCheckMobileno');
Route::post('become-agent/agentDetails', 'Pos\AuthController@agentDetails');
Route::get('/logout','Pos\AuthController@logout')->name('logout');

Route::get('/get-cities/{state_id}','Common@getCities');
Route::post('get-city-pincode/', 'Common@getCityPincode');
Route::get('/get-months/{year?}', 'Common@getMonths');
Route::get('/get/download/file/{type}/{file}', 'Common@getFileDownloads');
 Route::post('get-policy-document', 'Insurance@getPolicyDoc');
 
Route::get('common/load-tp-details-modal/{type}', 'Insurance@load_TP_details_Modal');
Route::get('get-modal-by-make/{brandId}', 'Pos\CommonController@getvehicleModals');
Route::get('get-variant-by-modal/{modaltId}', 'Pos\CommonController@getvehiclevariant');
Route::get('get-months/{year}', 'Pos\CommonController@getMonths');
Route::post('moter-insurance/genrate-payment-link', 'Pos\CommonController@genratePaymentLink');
Route::get('common/load-idv-modal/{type}/{device?}', 'Pos\CommonController@loadidvModal');
Route::get('common/load-moter-premiumbreakup-modal/{typ}/{refId}', 'Pos\CommonController@moterPremiumBreakupModal');
//Route::get('common/load-tp-details-modal/{type}', 'Pos\CommonController@load_TP_details_Modal');
Route::get('common/load-min-max-value/{type}/{device?}', 'Pos\CommonController@getminMaxassValue');
Route::get('common/terms-and-conditions/{type}/{supplier}', 'Pos\CommonController@termsConditionsModel');

Route::group(['middleware' => 'auth:agents'], function() {
Route::post('/posp/is-posp-exist/{type}', 'Pos\ProfileController@checkIsExist');

Route::get('/profile', 'Pos\ProfileController@index');
Route::get('/profile-overview', 'Pos\ProfileController@profileOverview');
// Route::get('password/reset', 'Pos\AgentloginController@forgotPassword')->name('password/reset');
// Route::get('password/reset/{token}', 'Pos\AgentloginController@changePassword');
// Route::post('upadate_password', 'Pos\AgentloginController@upadate_password');
Route::get('/recording/video','Pos\ProfileController@recordingvideo');
Route::post('/update-posp-info', 'Pos\ProfileController@updateSingleInfo');

Route::get('get-alert-notification/', 'Pos\ProfileController@getAlertNotification');
Route::post('personalinfo', 'Pos\ProfileController@personalinfo');
Route::post('educationinfo', 'Pos\ProfileController@educationinfo');
Route::post('bankinfo', 'Pos\ProfileController@bankinfo');
Route::post('documentinfo', 'Pos\ProfileController@documentinfo');
Route::post('businessinfo', 'Pos\ProfileController@businessinfo');
Route::get('deletecertificate/{id}', 'Pos\ProfileController@deletecertificate');
Route::get('deletebankstatement/{id}', 'Pos\ProfileController@deletebankstatement');
Route::get('deletepan_card/{id}', 'Pos\ProfileController@deletepan_card');
Route::get('deleteadhaar_card/{id}', 'Pos\ProfileController@deleteadhaar_card');
Route::get('deleteadhaar_card_back/{id}', 'Pos\ProfileController@deleteadhaar_card_back');
Route::get('deleteprofile/{id}', 'Pos\ProfileController@deleteprofile');
Route::get('my-certification', 'Pos\CertificationController@my_certification');
Route::get('/is-allow-certification-test/', 'Pos\CertificationController@isAllowtest');
Route::post('/profile/updateprofile', 'Pos\ProfileController@updateprofile');

Route::get('/profile/payment-process', 'Pos\FeeController@payment_process');
Route::post('/payment/initOrder','Pos\FeeController@initOrder');
Route::post('/payment/create-payment', 'Pos\FeeController@createPayment');
Route::get('/payment/success', 'Pos\FeeController@pay_success');
Route::get('/payment/fail', 'Pos\FeeController@pay_fail');
Route::get('/get/load-feeinfo/', 'Pos\FeeController@loadPaymentInfo');
Route::get('/get/tax-invoice', 'Pos\FeeController@taxInvoice');

Route::get('/profile/details', 'Pos\ProfileController@profile_details');
Route::get('/profile/video-uploads', 'Pos\ProfileController@profile_video_uploads');
Route::post('/profile/video-upload', 'Pos\ProfileController@profile_video_uploads_save');
Route::get('/create/quote', 'Pos\SalesController@createQuote');


  

Route::get('certificatedownload/{id}', 'Pos\CertificationController@certificate_downloads');
Route::get('test-start', 'Pos\CertificationController@test_start');
Route::get('questions/{ids}', 'Pos\CertificationController@questions');
Route::post('submit_question', 'Pos\CertificationController@submit_question');
Route::get('exam-result/{id}', 'Pos\CertificationController@exam_result');
Route::get('exam-review/{id}', 'Pos\CertificationController@exam_review');


Route::get('/dashboard', 'Pos\SalesController@index');
Route::post('/sales-dashbord/datatable', 'Pos\SalesController@salesDatatable');
Route::post('/sales-dashbord/get-dashboard-counts', 'Pos\SalesController@getDashboardCount');

Route::post('/get-policy-doc', 'Pos\SalesController@getPolicyDoc');
Route::get('/get-enquiry-details/{enQ}', 'Common@getEnquiryData');

  Route::get('policy/success/{type}/{enquiryID}','Insurance@successPage');
  Route::get('policy/cancel/{enquiryID}','Insurance@cancelPage');
/*  HEALTH INSURANCE */
   // Route::get('health-insurance', 'Pos\Healthinsurance@index')->name('health-insurance');
    //Route::get('health-insurance-detail', 'Pos\Healthinsurance@health_insurance_detail')->name('health-insurance-detail');
    Route::get('health-insurance/health-profile', 'Pos\Healthinsurance@healthProfile');
    Route::get('health-insurance/health-profile-members', 'Pos\Healthinsurance@healthProfileMembers');
    Route::get('health-insurance/health-members-age', 'Pos\Healthinsurance@healthProfileMembersAge');
    Route::get('health-insurance/health-plans', 'Pos\Healthinsurance@healthPlans');
    Route::post('health-insurance/get-health-plans', 'Pos\Healthinsurance@getHealthPlans');
    Route::post('health-insurance/create-enquiry', 'Pos\Healthinsurance@createEnquiry');
    Route::post('health-insurance/update-quote', 'Pos\Healthinsurance@updateQuote');
    Route::post('health-insurance/update-quick-quote-with-addons', 'Pos\Healthinsurance@updateQuickQuoteWithAddons');
    Route::post('health-insurance/update-zone-quick-quote', 'Pos\Healthinsurance@updateZoneQuickQuote');
    
    Route::get('health-insurance/product-detail/{enquiryID}', 'Pos\Healthinsurance@productDetails');
    Route::get('health-insurance/product-info/{enquiryID}', 'Pos\Healthinsurance@productInfo');
    Route::get('health-insurance/proposal/{enquiryID}', 'Pos\Healthinsurance@proposalDetails');
    Route::post('health-insurance/update-proposal', 'Pos\Healthinsurance@updateProposal');
    
    Route::get('health-insurance/table-proposer/{enquiryID}', 'Pos\Healthinsurance@proposerInfoTemplate');
    Route::get('health-insurance/table-insurer/{enquiryID}', 'Pos\Healthinsurance@insurerInfoTemplate');
    Route::get('health-insurance/table-address/{enquiryID}', 'Pos\Healthinsurance@addressInfoTemplate');
    Route::get('health-insurance/table-medical/{enquiryID}', 'Pos\Healthinsurance@medicalInfoTemplate');
    Route::get('health-insurance/table-review/{enquiryID}', 'Pos\Healthinsurance@reviewInfoTemplate');
    
    Route::post('health-insurance/create-premium', 'Pos\Healthinsurance@createPremium');
    Route::post('health-insurance/update-premium-info', 'Pos\Healthinsurance@updatePremiumInfo');
    Route::post('health-insurance/get-payment-form', 'Pos\Healthinsurance@getPaymentForm');
    
    
    Route::get('health-insurance/declaration/{enquiryID}', 'Pos\Healthinsurance@proposalDeclaration');
    Route::get('health-insurance/get-pay-data/{enquiryID}', 'Pos\Healthinsurance@getPayData');
    
    /*===================Car============================*/
       
    Route::get('/car-insurance', 'Pos\Carinsurance@index')->name('car-insurance');
    Route::get('/car-insurance-detail/', 'Pos\Carinsurance@insuranceDetails');
    Route::get('/car-insurance/car-number/', 'Pos\Carinsurance@car_number');
    Route::get('/car-insurance/registration-location', 'Pos\Carinsurance@car_registration_location');
    Route::get('/car-insurance/car-brand/', 'Pos\Carinsurance@car_brand');
    Route::get('/car-insurance/car-model/{brand}', 'Pos\Carinsurance@car_model');
    Route::get('/car-insurance/load-car-models/{brandId}/{brandName}', 'Pos\Carinsurance@loadCarModel');
    Route::get('/car-insurance/fuel-type', 'Pos\Carinsurance@car_fuel_type');
    Route::get('/car-insurance/car-variant/{model}', 'Pos\Carinsurance@car_variant');
    Route::get('/car-insurance/load-car-varients/{modelId}/{modelName}', 'Pos\Carinsurance@loadCarVarient');
    Route::get('/car-insurance/registration-year', 'Pos\Carinsurance@car_registration_year');
    Route::get('/car-insurance/expiry-detail', 'Pos\Carinsurance@car_expiry_detail');
    Route::get('car-insurance/car-plan/', 'Pos\Carinsurance@car_plan');
    Route::post('car-insurance/load-car-plans/', 'Pos\Carinsurance@loadCarPlans');
    Route::post('car-insurance/load-car-plans-recalculate/', 'Pos\Carinsurance@loadCarPlansRecalculate');
    Route::post('car-insurance/create-enquiry/', 'Pos\Carinsurance@createEnquiry');
    Route::post('car-insurance/create-proposal/{enquiryID}', 'Pos\Carinsurance@createProposal');
    Route::post('car-insurance/upload-files/{enquiryID}', 'Pos\Carinsurance@uploadFiles');
    Route::get('car-insurance/users-information/{enquiryID}', 'Pos\Carinsurance@userInformationFrom');
    Route::get('car-insurance/plan-summary/{enquiryID}', 'Pos\Carinsurance@plan_summary');
    Route::post('car-insurance/connect-to-insurer', 'Pos\Carinsurance@connectToinsurer');
    Route::get('car-insurance/policy/payments/{enquiryID}', 'Pos\Carinsurance@paymentlink');
    
    //Two wheeler
    Route::get('twowheeler-insurance', 'Motor\Twinsurance@index')->name('twowheeler-insurance');
    Route::get('twowheeler-insurance-detail/', 'Motor\Twinsurance@insuranceDetails');
    Route::get('twowheeler-insurance/registration-number/', 'Motor\Twinsurance@regNumber');
    Route::get('twowheeler-insurance/registration-location', 'Motor\Twinsurance@registrationLocation');
    
    Route::get('twowheeler-insurance/brand', 'Motor\Twinsurance@brand');
    Route::get('twowheeler-insurance/load-models/{brandId}/{brandName}', 'Motor\Twinsurance@loadTwModel');
    Route::get('twowheeler-insurance/model/{brand}', 'Motor\Twinsurance@model');
    Route::get('twowheeler-insurance/variant/{model}', 'Motor\Twinsurance@twVariant');
    Route::get('twowheeler-insurance/load-varients/{modelId}/{modelName}', 'Motor\Twinsurance@loadVarient');
    //Route::get('bike-insurance/fuel-type', 'Motor\Twinsurance@bike_fuel_type');
    Route::get('twowheeler-insurance/registration-year', 'Motor\Twinsurance@registrationYear');
    Route::get('twowheeler-insurance/expiry-detail', 'Motor\Twinsurance@expiryDetail');
    
    Route::get('twowheeler-insurance/ncb-transfer', 'Motor\Twinsurance@ncbTransfer');
    
    Route::get('twowheeler-insurance/plans/', 'Motor\Twinsurance@plansData');
   // Route::get('bike-insurance/get-idv/', 'Motor\Twinsurance@getLatestIdv');
    Route::post('twowheeler-insurance/load-plans/', 'Motor\Twinsurance@loadPlans');
    Route::post('twowheeler-insurance/load-plans-recalculate/', 'Motor\Twinsurance@loadPlansRecalculate');
    Route::post('twowheeler-insurance/create-enquiry/', 'Motor\Twinsurance@createEnquiry');
    //Route::post('bike-insurance/single-bike-plans-recalculate/', 'Web\Bikeinsurance@BikePlansRecalculateSingle');
    Route::get('twowheeler-insurance/users-information/{enquiryID}', 'Motor\Twinsurance@userInformationFrom');
    Route::post('twowheeler-insurance/update-info/{enQ}', 'Motor\Twinsurance@updateInfo');
    
    Route::post('twowheeler-insurance/create-proposal/{enquiryID}', 'Motor\Twinsurance@createProposal');
    Route::get('twowheeler-insurance/plan-summary/{enquiryID}', 'Motor\Twinsurance@plan_summary');
    Route::post('twowheeler-insurance/upload-files/{enquiryID}', 'Motor\Twinsurance@uploadFiles');
    Route::post('twowheeler-insurance/connect-to-insurer', 'Motor\Twinsurance@connectToinsurer');
    Route::get('twowheeler-insurance/policy/payments/{enquiryID}', 'Motor\Twinsurance@paymentlink');

});
   
};

Route::group(array('domain' => 'pos.superfinserv.co.in'), $pospRoutes);
Route::group(array('domain' => 'www.pos.superfinserv.co.in'), $pospRoutes);

$adminRoutes = function() {
    
     //Clear route cache:
    //  Route::get('/route-cache', function() {
    //      $exitCode = Artisan::call('route:cache');
    //      return 'Routes cache cleared';
    //  });
    
    //  //Clear config cache:
    //  Route::get('/config-cache', function() {
    //      $exitCode = Artisan::call('config:cache');
    //      return 'Config cache cleared';
    //  }); 
    
    // Clear application cache:
     Route::get('/clear-cache', function() {
         // $exitCode = Artisan::call('route:cache');
          $exitCode = Artisan::call('config:cache');
          $exitCode = Artisan::call('cache:clear');
          $exitCode = Artisan::call('view:clear');
         return 'Application cache cleared';
     });
    
     // Clear view cache:
    //  Route::get('/view-clear', function() {
    //      $exitCode = Artisan::call('view:clear');
    //      return 'View cache cleared';
    //  });

    
   
    
   // Route::get('/', 'Admin\AgentsController@test');
     Route::get('/', 'Admin\Login@index');
     Route::get('login', 'Admin\Login@index');
    //Route::post('login', 'Admin\Login@getAuth');
    Route::post('login', [ 'as' => 'login', 'uses' => 'Admin\Login@getAuth']);
     Route::group(['middleware' => 'auth:admin'], function() {
         
         
         //TEMP
        Route::post('agents/hdfc-route', 'Admin\AgentsController@hdfc_data_link');
        // TEMP
         
       //All the routes that belongs to the group goes here
        Route::get('/home','Admin\HomeController@index')->name('home');
        Route::get('/get-posp-statistic/{tab?}','Admin\HomeController@getPOSPStatistic');
        Route::get('/get-nop-statistic/{tab?}','Admin\HomeController@getNOPStatistic');
        Route::get('/get-premium-statistic/{tab?}','Admin\HomeController@getPremiumStatistic');
        
        
        Route::get('/logout', 'Admin\HomeController@logout');
             //common
        Route::get('/get-cities/{state_id}', 'Admin\CommanController@getCities');
        Route::get('/get-brands-by-category/{type}', 'Admin\CommanController@getBrandsByCategory');
        Route::get('get-months/{year?}', 'Admin\CommanController@getMonths');
        Route::get('/get-models-by-brand/{brand_id}', 'Admin\CommanController@getModelsByBrands');
        Route::get('/get-branch-by-region/{region_id}', 'Admin\CommanController@getBranchesByRegion');
        Route::get('/get/download/file/{type}/{file}', 'Common@getFileDownloads');
        
        Route::get('common/load-idv-modal/{type}/{device?}', 'Admin\CommanController@loadidvModal');
        Route::get('common/load-moter-premiumbreakup-modal/{typ}/{refId}', 'Admin\CommanController@moterPremiumBreakupModal');
        Route::get('common/load-tp-details-modal/{type}', 'Admin\CommanController@load_TP_details_Modal');
        Route::get('commomn/load-min-max-value/{type}/{device?}', 'Admin\CommanController@getminMaxassValue');
        Route::get('common/terms-and-conditions/{type}/{supplier}', 'Admin\CommanController@termsConditionsModel');
        Route::post('moter-insurance/genrate-payment-link', 'Admin\CommanController@genratePaymentLink');
        
        Route::post('agent/files/upload', 'Admin\CommanController@agentuploadFiles');
        Route::get('agents/files/remove/{filename}/{id}', 'Admin\CommanController@agentRemoveFiles');
        Route::get('/settings', 'Admin\Settings@index');
        Route::post('/site/settings/update/', 'Admin\Settings@updateSiteSettings');
         Route::post('/settings/delete-ip', 'Admin\Settings@removeIP');
        Route::post('/settings/save-ip', 'Admin\Settings@addNewIP');
        
        
        Route::get('/regions', 'Admin\RegionsController@index');
        Route::post('/regions/save', 'Admin\RegionsController@regionSave');
        Route::post('/regions/getdatatable', 'Admin\RegionsController@getRegiondatatable');
        Route::get('/regions/status/update/{id}/{status}', 'Admin\RegionsController@statusUpdate');
        
        Route::get('/notification/templates/email', 'Admin\EmailController@index');
        Route::get('/notification/templates/email/{param}/{id?}', 'Admin\EmailController@create_edit_template');
        
        Route::post('/notification/template/email/datatable', 'Admin\EmailController@getEmailTempdatatable');
        Route::post('/notification/templates/email/save/', 'Admin\EmailController@saveTemplate');
        
        Route::get('/notification/templates/getBody/email/{id}', 'Admin\EmailController@getEmailBody');
        
        //sms
        Route::get('/notification/templates/sms', 'Admin\SmsController@index');
        Route::get('/notification/templates/sms/{param}/{id?}', 'Admin\SmsController@create_edit_template');
        Route::post('/notification/template/sms/datatable', 'Admin\SmsController@getSmsTempdatatable');
        Route::post('/notification/templates/sms/save/', 'Admin\SmsController@saveTemplate');
        Route::get('/notification/templates/getBody/sms/{id}', 'Admin\SmsController@getSmsBody');
        
        //notification setting
        Route::get('/notification/templates/settings', 'Admin\Notifications@index');
        Route::post('/notification/template/settings/update','Admin\Notifications@updateSettings');
        
        Route::get('/our-partners', 'Admin\Ourpartners@index');
        Route::post('/our-partners/save/', 'Admin\Ourpartners@partnersSave');
        Route::get('/our-partners/update-status/{id}/{status}', 'Admin\Ourpartners@statusUpdate');
        Route::post('/our-partners/delete', 'Admin\Ourpartners@deletePartner');
        
        
        Route::get('/our-partners/plans/update-status/{id}/{status}', 'Admin\Ourpartners@updatePlanInfoStatus');
        Route::get('/our-partners/plans-list', 'Admin\Ourpartners@partnerPlanslist'); 
        Route::post('/our-partners/plans/datatable', 'Admin\Ourpartners@getPlanListdatatable');
        Route::get('/our-partners/plans/manage/{id}', 'Admin\Ourpartners@managePlans');
        //Route::post('/our-partners/plan-benifits/update', 'Admin\Ourpartners@updateBenifits');
        //Route::post('/our-partners/plan-benifits/save', 'Admin\Ourpartners@addNewBenifits');
        //Route::post('/our-partners/plan-benifits/delete', 'Admin\Ourpartners@deletePartnerPlansbenifits');
        Route::post('/our-partners/plan-info/update', 'Admin\Ourpartners@updatePlanInfo');
         
        //claims
        Route::get('/claims', 'Admin\ClaimController@index');
         
        Route::get('/pre-insurers', 'Admin\PreInsurer@index');
        Route::post('/pre-insurers/datatable/', 'Admin\PreInsurer@getDatatable');
        Route::get('/pre-insurer/model/{param}/{id?}', 'Admin\PreInsurer@createUpdateInsrerModel');
        Route::post('/pre-insurer/manage/save', 'Admin\PreInsurer@saveChangeInsurer');
        
        Route::get('/branches', 'Admin\BranchesController@index');
        Route::post('/branch/save', 'Admin\BranchesController@branchSave');
        Route::post('/branch/getdatatable', 'Admin\BranchesController@getBranchdatatable');
        Route::get('/branch/status/update/{id}/{status}', 'BranchesController@statusUpdate');
        
        Route::get('/roles', 'Admin\RolesController@index');
        Route::post('/role/save', 'Admin\RolesController@roleSave');
        Route::post('/role/getdatatable', 'Admin\RolesController@getRoledatatable');
        Route::get('/role/status/update/{id}/{status}', 'Admin\RolesController@statusUpdate');
        
        Route::get('/categories', 'Admin\CategoriesController@index');
        //Route::post('/categories/save', 'CategoriesController@categoriesSave');
        Route::post('/categories/getdatatable', 'Admin\CategoriesController@getCategoriesdatatable');
        //Route::get('/categories/status/update/{id}/{status}', 'RegionsController@statusUpdate');
        //register
        
        Route::get('users', 'Admin\UsersController@index');
        Route::post('users/datatable', 'Admin\UsersController@getUsersdatatable');
        Route::get('users/manage/{param}/{id?}', 'Admin\UsersController@register_edit_User');
        Route::post('user/update-status/', 'Admin\UsersController@updateStatus');
        Route::post('/users/new/saveInfo', 'Admin\UsersController@savenewInfo');
        Route::get('/users/view/details/{id}', 'Admin\UsersController@viewUser');
        
        Route::get('/users/reset-password/modal/{id}', 'Admin\UsersController@resetPasswordModel');
        Route::post('/users/update/password/info/', 'Admin\UsersController@updatePassword');
        
        
        
        Route::get('agents', 'Admin\AgentsController@index');
        Route::get('agent/register', 'Admin\AgentsController@registerAgent');
        Route::post('/agent/new/saveInfo', 'Admin\AgentsController@savenewInfo');
        
        Route::get('/agentinfo/{id}', 'Admin\AgentsController@agentinfo');
        Route::post('/agents/getAgentsdatatable', 'Admin\AgentsController@getAgentsdatatable');
        Route::get('/agents/allowTest/{id}/{isTestAllow}', 'Admin\AgentsController@allowTest');
        Route::get('/agents/agent-verification/{id}/{isVerified}', 'Admin\AgentsController@updateVerificationStatus');
        Route::post('/agents/trash/process', 'Admin\AgentsController@trashStatus');
        
        Route::get('agents/trash', 'Admin\Agentstrash@index');
        Route::post('/agents/trash/getAgentsdatatable', 'Admin\Agentstrash@getAgentsdatatable');
        
        
        Route::get('/agent/edit/personal/{id}', 'Admin\AgentsController@editPersonal');
        Route::post('/agent/update/personalInfo', 'Admin\AgentsController@personalInfoupdate');
        
        Route::get('/agent/reset-password/modal/{id}', 'Admin\AgentsController@resetPasswordModel');
        Route::post('/agent/update/password/info/', 'Admin\AgentsController@updatePassword');
        
        Route::get('/agent/edit/educational/{id}', 'Admin\AgentsController@editEducational');
        Route::post('/agent/update/educationalInfo', 'Admin\AgentsController@educationalInfoupdate');
        
        Route::get('/agent/edit/bank/{id}', 'Admin\AgentsController@editBank');
        Route::post('/agent/update/bankInfo', 'Admin\AgentsController@bankInfoupdate');
        
        Route::get('/agent/edit/document/{id}', 'Admin\AgentsController@editDocument');
        Route::post('/agent/update/documentInfo', 'Admin\AgentsController@documentInfoupdate');
        
        Route::get('/agent/edit/identity/{id}', 'Admin\AgentsController@editIdentity');
        Route::get('/agent/edit/payment/{id}', 'Admin\AgentsController@editPayment');
        Route::get('/agent/payment/modal/info/{id}', 'Admin\AgentsController@modalupdatePayment');
        Route::post('/agent/payment/update/info/', 'Admin\AgentsController@updatePayInfo');
        
        Route::get('/agent/certificates/{id}', 'Admin\AgentsController@certificates');
        Route::get('/certificate/start/model/{id}', 'Admin\CertificateController@startTest');
        Route::post('/certificate/getQuestion', 'Admin\CertificateController@getQuestion');
        Route::post('/certificate/submitTest/', 'Admin\CertificateController@submitTest');
        Route::get('/certificate/direct/genrate', 'Admin\CertificateController@direct_certificateGenrate');
        Route::post('/certificate/regenerate', 'Admin\CertificateController@regenerate_certificate');
        
        Route::get('/agent/edit/otherinfo/{id}', 'Admin\AgentsController@editotherInformations');
        Route::post('/agent/update/otherInfo', 'Admin\AgentsController@otherInfoupdate');
        Route::post('/agent/send/tranning_info', 'Admin\AgentsController@sendTranningcrd');
        
        Route::get('/agent/activity/log/{id}', 'Admin\AgentsController@activitylogInformations');
        
        
        Route::get('/agent/otherInfo/tranning-complete-status/{id}/{st}', 'Admin\AgentsController@tranningCompletestatus');
        
        
        Route::get('customers', 'Admin\CustomersController@index');
        Route::post('customers/datatable', 'Admin\CustomersController@getCustomersdatatable');
        
        Route::get('vehicles', 'Admin\VehiclesController@index');
        Route::post('/vehicles/datatable', 'Admin\VehiclesController@getVehiclesdatatable');
        Route::get('/vehicle/view/{id}', 'Admin\VehiclesController@viewDeatils');
        Route::post('/vehicle/image/upload/{param}', 'Admin\VehiclesController@uploadFiles');
        
        
        Route::get('/vehicles/make/sortable/', 'Admin\VehiclesController@sortableMake');
        Route::post('/vehicles/update/make/serial-number/', 'Admin\VehiclesController@updateMakeSerialNumber');
        Route::get('/vehicles/modal/sortable/{make}', 'Admin\VehiclesController@sortableModals');
        Route::post('/vehicles/update/modal/serial-number/{make}', 'Admin\VehiclesController@updateModalSerialNumber');
        
        
        Route::get('vehicle/brands', 'Admin\VehiclesController@brands');
        Route::post('/vehicle/brands/save', 'Admin\VehiclesController@brandSave');
        Route::post('/vehicle/brands/getBrandsdatatable', 'Admin\VehiclesController@getBrandsdatatable');
        
        Route::get('vehicle/models', 'Admin\VehiclesController@models');
        Route::post('/vehicle/models/save', 'Admin\VehiclesController@modelSave');
        Route::post('/vehicle/models/getModelsdatatable', 'Admin\VehiclesController@getModelsdatatable');
        Route::get('/vehicle/model/update-model-category/{typ}/{id}','Admin\VehiclesController@updateCatModel');
        
        Route::get('/vehicle/variants', 'Admin\VehiclesController@variants');
        Route::post('/vehicle/variants/save', 'Admin\VehiclesController@variantSave');
        Route::post('/vehicle/variants/getVariantsdatatable', 'Admin\VehiclesController@getVariantsdatatable');
        Route::get('/vehicle/variant/status-update/{id}/{status}', 'Admin\VehiclesController@UpdatevariantStatus');
        
        Route::get('/vehicle/delete/{type}/{id}', 'Admin\VehiclesController@deleteVehicleData');
        Route::get('/vehicle/variants/update-code/modal/{typ}/{vid}','Admin\VehiclesController@varientcodeUpdateModel');
        Route::post('/vehicle/varients/update-code/', 'Admin\VehiclesController@varientcodeUpdate');
        
        
        Route::get('/sales/insured', 'Admin\InsuredController@index');
        Route::post('/sales/insured/getInsureddatatable', 'Admin\InsuredController@getInsureddatatable');
        Route::post('/sales/insured/getpdf', 'Admin\InsuredController@getPolicyPdf');
        Route::get('/sales/insured/get-policy-overview/{policyid}', 'Admin\InsuredController@policyOverviewModal');
        
        Route::get('/sales/leads', 'Admin\LeadsController@index');
        Route::post('sales/leads/datatable', 'Admin\LeadsController@getLeadsdatatable');
        Route::get('/sales/leads/info/{lead_id}', 'Admin\LeadsController@getLeadsDetails');
        
          Route::get('/test/kit', 'TestController@testkit');
       
   });
   
    
};

Route::group(array('domain' => 'admin.superfinserv.co.in'), $adminRoutes);
Route::group(array('domain' => 'www.admin.superfinserv.co.in'), $adminRoutes);

// Route::domain("admin.supersolutions.co.in")->group(function() { 
//     //all main domain specific routes 
    
// });
