<?php
use Illuminate\Support\Facades\Route;

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
Route::post('become-agent/agentDetails', 'Pos\AuthController@register');
Route::get('/logout','Pos\AuthController@logout')->name('logout');

        //Get Comman Master Data Route
        Route::get('get-cities/{state_id}', 'Common@getCities');
        Route::get('get-financiers', 'Common@getFinanciers');
        Route::get('get-city-pincode/{cityc?}', 'Common@getCityPincode');
        Route::get('get-months/{year?}', 'Common@getMonths');
        Route::get('get-city-sate-by-pincode/{pincode}', 'Common@getCityStateByPincode');
        Route::get('get-validated-pincode', 'Common@getValidatedPincode');
        Route::get('common/terms-and-conditions/{type}/{supplier}', 'Common@termsConditionsModel');
 

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

// Motor common data get
    Route::get('moter-insurance/load-idv-modal/{type}/{device?}', 'Motor\MotorInsurance@loadidvModal');
    Route::get('moter-insurance/load-moter-premium/breakup-modal/{typ}/{refId}', 'Motor\MotorInsurance@moterPremiumBreakupModal');
    Route::get('moter-insurance/load-tp-details-modal/{type}/{preCover?}/{vTyp?}', 'Motor\MotorInsurance@load_TP_details_Modal');
    Route::get('moter-insurance/load-min-max-value/{type}/{device?}', 'Motor\MotorInsurance@getminMaxassValue');
    Route::post('moter-insurance/genrate-payment-link', 'Motor\MotorInsurance@sendPaymentLink');
    Route::get('/motor/{insType}/policy/payments/{enQId}', 'Motor\MotorInsurance@paymentLinkPage');
    Route::post('motor/get-vehicle-models', 'Motor\MotorInsurance@getModelByMake');
    Route::post('motor/get-vehicle-varients', 'Motor\MotorInsurance@getVarientByModel');
    Route::get('download-quote/motor-insurance/{enQ}', 'Motor\MotorInsurance@GetDownloadQuote');
    //health Common data
    Route::post('health-insurance/genrate-payment-link', 'Health\Healthinsurance@sendPaymentLink');
    Route::get('/health/{insType}/policy/payments/{enQId}', 'Health\Healthinsurance@paymentLinkPage');
    
    
    //Other comman data
     Route::get('/get/download/file/{type}/{file}', 'Common@getFileDownloads');
     Route::get('/get-enquiry-details/{enQ}', 'Common@getEnquiryData');
    
    //Insurance Comman Controller  
    Route::post('get-policy-document', 'Insurance@getPolicyDoc');
    Route::post('get-policy-status', 'Insurance@getPolicyStatus');
    

  
   Route::get('twowheeler-insurance', 'Motor\Twinsurance@index')->name('twowheeler-insurance');
    Route::get('twowheeler-insurance-detail/', 'Motor\Twinsurance@insuranceDetails');
   // Route::group(['middleware' => 'auth:customers'], function() {
    Route::get('twowheeler-insurance/registration-number/', 'Motor\Twinsurance@regNumber');
        Route::get('twowheeler-insurance/registration-location', 'Motor\Twinsurance@registrationLocation');
        Route::get('twowheeler-insurance/brand', 'Motor\Twinsurance@brand');
        Route::get('twowheeler-insurance/load-models/{brandId}/{brandName}', 'Motor\Twinsurance@loadTwModel');
        Route::get('twowheeler-insurance/model/{brand}', 'Motor\Twinsurance@model');
        Route::get('twowheeler-insurance/variant/{model}', 'Motor\Twinsurance@twVariant');
        Route::get('twowheeler-insurance/load-varients/{modelId}/{modelName}', 'Motor\Twinsurance@loadVarient');
        Route::get('twowheeler-insurance/registration-year', 'Motor\Twinsurance@registrationYear');
        Route::get('twowheeler-insurance/expiry-detail', 'Motor\Twinsurance@expiryDetail');
        Route::get('twowheeler-insurance/ncb-transfer', 'Motor\Twinsurance@ncbTransfer');
        Route::get('twowheeler-insurance/plans/', 'Motor\Twinsurance@plansData');
        Route::post('twowheeler-insurance/load-plans/', 'Motor\Twinsurance@loadPlans');
        Route::post('twowheeler-insurance/load-plans-recalculate/', 'Motor\Twinsurance@loadPlansRecalculate');
        Route::post('twowheeler-insurance/create-enquiry/', 'Motor\Twinsurance@createEnquiry');
        Route::get('twowheeler-insurance/users-information/{enquiryID}', 'Motor\Twinsurance@userInformationFrom');
        Route::post('twowheeler-insurance/update-info/{enQ}', 'Motor\Twinsurance@updateInfo');
        Route::post('twowheeler-insurance/create-proposal/{enquiryID}', 'Motor\Twinsurance@createProposal');
        Route::get('twowheeler-insurance/plan-summary/{enquiryID}', 'Motor\Twinsurance@plan_summary');
        Route::post('twowheeler-insurance/upload-files/{enquiryID}', 'Motor\Twinsurance@uploadFiles');
        Route::post('twowheeler-insurance/connect-to-insurer', 'Motor\Twinsurance@connectToinsurer');
   //});
    
    
    //CAR INSURANCE
    Route::get('car-insurance', 'Motor\Carinsurance@index')->name('car-insurance');
    Route::get('car-insurance-detail/', 'Motor\Carinsurance@insuranceDetails');
   // Route::group(['middleware' => 'auth:customers'], function() {
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
            
            Route::get('car-insurance/inspection/{enquiryID}', 'Motor\Carinsurance@inspectionCase');
            Route::get('car-insurance/get-inspection-info/{enquiryID}', 'Motor\Carinsurance@GetInspectionApprovalInfo');
            Route::get('car-insurance/get-post-inspection-calculate-premimum/{enquiryID}', 'Motor\Carinsurance@GetPostinspectionCalculatePremium');
             Route::get('car-insurance/get-post-inspection-create-proposal/{enquiryID}', 'Motor\Carinsurance@GetPostinspectionCreateProposal');
            
            Route::get('car-insurance/plan-summary/{enquiryID}', 'Motor\Carinsurance@plan_summary');
           // Route::post('car-insurance/upload-files/{enquiryID}', 'Motor\Carinsurance@uploadFiles');
            Route::post('car-insurance/connect-to-insurer', 'Motor\Carinsurance@connectToinsurer');
  //  });
    
    
    /*  HEALTH INSURANCE */
    Route::get('health-insurance', 'Health\Healthinsurance@index')->name('health-insurance');
    
    Route::get('health-insurance-detail', 'Health\Healthinsurance@health_insurance_detail')->name('health-insurance-detail');
     
        Route::get('health-insurance/health-profile', 'Health\Healthinsurance@healthProfile');
         
        Route::get('health-insurance/health-profile-members', 'Health\Healthinsurance@healthProfileMembers');
        Route::get('health-insurance/health-members-age', 'Health\Healthinsurance@healthProfileMembersAge');
        Route::get('health-insurance/health-plans', 'Health\Healthinsurance@healthPlans');
        Route::post('health-insurance/get-health-plans', 'Health\Healthinsurance@getHealthPlans');
        Route::post('health-insurance/create-enquiry', 'Health\Healthinsurance@createEnquiry');
        Route::post('health-insurance/update-quote', 'Health\Healthinsurance@updateQuote');
        Route::post('health-insurance/update-quick-quote-with-addons', 'Health\Healthinsurance@updateQuickQuoteWithAddons');
        Route::post('health-insurance/update-zone-quick-quote', 'Health\Healthinsurance@updateZoneQuickQuote');
        
        Route::get('health-insurance/product-detail/{enquiryID}', 'Health\Healthinsurance@productDetails');
        Route::get('health-insurance/product-info/{enquiryID}', 'Health\Healthinsurance@productInfo');
        Route::get('health-insurance/proposal/{enquiryID}', 'Health\Healthinsurance@proposalDetails');
        Route::post('health-insurance/update-proposal', 'Health\Healthinsurance@updateProposal');
        
        Route::get('health-insurance/table-proposer/{enquiryID}', 'Health\Healthinsurance@proposerInfoTemplate');
        Route::get('health-insurance/table-insurer/{enquiryID}', 'Health\Healthinsurance@insurerInfoTemplate');
        Route::get('health-insurance/table-address/{enquiryID}', 'Health\Healthinsurance@addressInfoTemplate');
        Route::get('health-insurance/table-medical/{enquiryID}', 'Health\Healthinsurance@medicalInfoTemplate');
        Route::get('health-insurance/table-review/{enquiryID}', 'Health\Healthinsurance@reviewInfoTemplate');
        
        Route::post('health-insurance/create-premium', 'Health\Healthinsurance@createPremium');
        Route::post('health-insurance/update-premium-info', 'Health\Healthinsurance@updatePremiumInfo');
        Route::post('health-insurance/get-payment-form', 'Health\Healthinsurance@getPaymentForm');
        
        Route::get('health-insurance/declaration/{enquiryID}', 'Health\Healthinsurance@proposalDeclaration');
        Route::get('health-insurance/get-pay-data/{enquiryID}', 'Health\Healthinsurance@getPayData');
     
     
     
     //After policy Success
   // Route::any('moter-insurance/insured-success/{type}/{enquiryID?}', 'SuccessController@moterTransactionUpdate');//Moter
   // Route::any('health-insurance/insured-success/{enquiryID}', 'SuccessController@healthtransactionupdate');//Health
    
    
    
});

     Route::get('policy/success/{type}/{enquiryID}','SuccessController@successPage');
    Route::get('policy/cancel/{enquiryID}','SuccessController@cancelPage');
    
    //Cancel for HDFC ERGO
    Route::any('insurance/policy/cancel/{enquiryID}','SuccessController@hdfcErgocancelPage');
?>