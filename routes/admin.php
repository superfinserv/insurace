<?php
use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function() {
         // $exitCode = Artisan::call('route:cache');
          
          $exitCode = Artisan::call('cache:clear');
          $exitCode = Artisan::call('config:cache');
          $exitCode = Artisan::call('view:clear');
          return 'Application cache cleared';
     });
    
     
     Route::get('/', 'Admin\Login@index');
     Route::get('login', 'Admin\Login@index');
    //Route::post('login', 'Admin\Login@getAuth');
     Route::post('login', [ 'as' => 'login', 'uses' => 'Admin\Login@getAuth']);
     Route::group(['middleware' => 'auth:admin'], function() {
        
        
         
         //TEMP
        Route::post('agents/hdfc-route', 'Admin\AgentsController@hdfc_data_link');
        // TEMP
         
       //All the routes that belongs to the group goes here
       Route::get('/get-plans-for-partner/{partner}', 'Common@getPlansByPartner');
       
        Route::get('/policy-orc', 'Admin\OrcsController@index');
        Route::post('/policies-orc/datatable', 'Admin\OrcsController@getdatatable');
        
        Route::get('/rules', 'Admin\RulesController@index');
        Route::post('/rules/datatable', 'Admin\RulesController@getdatatable');
        Route::get('/rules/model/{param}/{code?}', 'Admin\RulesController@curdRuleModel');
        Route::post('/rules/manage/save/', 'Admin\RulesController@saveRules');
        Route::post('/rules/manage/copy/rule/', 'Admin\RulesController@copyRule');
        
        
        Route::get('/home','Admin\HomeController@index')->name('home');
        Route::get('/get-posp-statistic/{tab?}','Admin\HomeController@getPOSPStatistic');
        Route::get('/get-nop-statistic/{tab?}','Admin\HomeController@getNOPStatistic');
        Route::get('/get-premium-statistic/{tab?}','Admin\HomeController@getPremiumStatistic');
        Route::get('/get-sales-statistic/','Admin\HomeController@getSalesStatistic');
        
        
        Route::get('/logout', 'Admin\HomeController@logout');
             //common
        Route::get('/get-cities/{state_id}', 'Common@getCities');
        Route::get('/get-brands-by-category/{type}', 'Admin\CommanController@getBrandsByCategory');
        Route::get('get-months/{year?}', 'Admin\CommanController@getMonths');
        Route::get('/get-models-by-brand/{brand_id}', 'Admin\CommanController@getModelsByBrands');
        Route::get('/get-branch-by-region/{region_id}', 'Admin\CommanController@getBranchesByRegion');
        Route::get('/get/download/file/{type}/{file}', 'Common@getFileDownloads');
        
     
        
        Route::post('agent/files/upload', 'Admin\CommanController@agentuploadFiles');
        Route::get('agents/files/remove/{filename}/{id}', 'Admin\CommanController@agentRemoveFiles');
        
        
        Route::get('/settings', 'Admin\Settings@index');
        Route::get('/settings/portal-settings', 'Admin\Settings@portalSettings');
        Route::get('/settings/social-settings', 'Admin\Settings@socialSettings');
        Route::get('/settings/posp-settings', 'Admin\Settings@pospSettings');
        Route::get('/settings/pg-settings', 'Admin\Settings@pgSettings');
        Route::post('/settings/site-settings/save-change', 'Admin\Settings@updateSiteSettings');
        
        
       // Route::post('/site/settings/update/', 'Admin\Settings@updateSiteSettings');
      //   Route::post('/settings/delete-ip', 'Admin\Settings@removeIP');
       // Route::post('/settings/save-ip', 'Admin\Settings@addNewIP');
        
        
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
        
         Route::post('/agents/datatable', 'Admin\AgentTables@getAgentsdatatable');
         Route::post('/agents/applications/datatable', 'Admin\AgentTables@getApplicationsdatatable');
         Route::post('/agent/payments/datatable', 'Admin\AgentTables@getPaymentsdatatable');
         Route::post('/agent/trash/datatable', 'Admin\AgentTables@getAgentsTrashdatatable');
         
        Route::get('agent/applications', 'Admin\AgentsController@applicationsList');
        Route::get('agents', 'Admin\AgentsController@index');
        Route::get('agents/trash', 'Admin\AgentsController@trashList');
        Route::get('agent/payments', 'Admin\AgentsController@paymentsList');
        
        Route::get('agent/register', 'Admin\AgentsController@registerAgent');
        Route::post('/agent/new/saveInfo', 'Admin\AgentsController@savenewInfo');
        
         Route::get('/agentinfo/{id}', 'Admin\AgentsController@agentinfo');
         Route::post('/agent/internal/status/manage/', 'Admin\AgentsController@ManagePospStatus');
         
        // Route::get('/agents/allowTest/{id}/{isTestAllow}', 'Admin\AgentsController@allowTest');
        // Route::get('/agents/agent-verification/{id}/{isVerified}', 'Admin\AgentsController@updateVerificationStatus');
        // Route::post('/agents/trash/process', 'Admin\AgentsController@trashStatus');
        
      
        
        
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
        
       
       
        Route::get('/agent/get-tax-invoice/{agentID}', 'Admin\AgentsController@taxInvoiceDownload');
        Route::get('/agents/export', 'Admin\AgentsController@exportExcel');//expor  Excel
        
        Route::get('customers', 'Admin\CustomersController@index');
        Route::post('customers/datatable', 'Admin\CustomersController@getCustomersdatatable');
        
        Route::get('vehicles/{param?}', 'Admin\VehiclesController@index');
        Route::post('/vehicles/2w/datatable', 'Admin\VehiclesController@getTwoVehiclesdatatable');
        Route::post('/vehicles/pvt-car/datatable', 'Admin\VehiclesController@getPvtCarVehiclesdatatable');
        Route::post('/vehicles/update-vcode/{param}', 'Admin\VehiclesController@updateVcode');
        Route::get('/vehicles/search/details-info', 'Admin\VehiclesController@GetvehicleDetailsInfo');
        Route::get('/vehicles/search/details-info/{vNumber}', 'Admin\VehiclesController@PostvehicleDetailsInfo');
        Route::get('/vehicles/2w/export','Admin\VehiclesController@exportTw'); //Excel export
        Route::get('/vehicles/pvt-car/export','Admin\VehiclesController@exportPvtCar'); //Excel export
        
        Route::get('hdfc-vehicles-models/{param}', 'Admin\VehiclesController@hdfcModelData');
        Route::get('fgi-vehicles-models/{param}', 'Admin\VehiclesController@FgiModelData');
        
          Route::get('rto-master', 'Admin\RtoController@index');
          Route::get('rto-vehicle-info', 'Admin\RtoController@GetRtoVehicleInfo');
          Route::post('get-vehicle-rto-info', 'Admin\RtoController@GetVehicleRegDetails');
          Route::post('rto-master/create', 'Admin\RtoController@savenewInfo');
          Route::post('rto-master/datatable', 'Admin\RtoController@getdatatable');
          Route::post('rto-master/update-code/{param}', 'Admin\RtoController@updateVcode');
        
        
        // Route::get('vehicles', 'Admin\VehiclesController@index');
        // Route::post('/vehicles/datatable', 'Admin\VehiclesController@getVehiclesdatatable');
        // Route::get('/vehicle/view/{id}', 'Admin\VehiclesController@viewDeatils');
        // Route::post('/vehicle/image/upload/{param}', 'Admin\VehiclesController@uploadFiles');
        
        
         Route::get('/vehicles/make/sortable/{vtype}', 'Admin\VehiclesController@sortableMake');
         Route::post('/vehicles/update/make/serial-number/{vtype}', 'Admin\VehiclesController@updateMakeSerialNumber');
         Route::get('/vehicles/modal/sortable/{make}/{vtype}', 'Admin\VehiclesController@sortableModals');
         Route::post('/vehicles/update/modal/serial-number/{make}/{vtype}', 'Admin\VehiclesController@updateModalSerialNumber');
        
        
        // Route::get('vehicle/brands', 'Admin\VehiclesController@brands');
        // Route::post('/vehicle/brands/save', 'Admin\VehiclesController@brandSave');
        // Route::post('/vehicle/brands/getBrandsdatatable', 'Admin\VehiclesController@getBrandsdatatable');
        
        // Route::get('vehicle/models', 'Admin\VehiclesController@models');
        // Route::post('/vehicle/models/save', 'Admin\VehiclesController@modelSave');
        // Route::post('/vehicle/models/getModelsdatatable', 'Admin\VehiclesController@getModelsdatatable');
        // Route::get('/vehicle/model/update-model-category/{typ}/{id}','Admin\VehiclesController@updateCatModel');
        
        // Route::get('/vehicle/variants', 'Admin\VehiclesController@variants');
        // Route::post('/vehicle/variants/save', 'Admin\VehiclesController@variantSave');
        // Route::post('/vehicle/variants/getVariantsdatatable', 'Admin\VehiclesController@getVariantsdatatable');
        // Route::get('/vehicle/variant/status-update/{id}/{status}', 'Admin\VehiclesController@UpdatevariantStatus');
        
        // Route::get('/vehicle/delete/{type}/{id}', 'Admin\VehiclesController@deleteVehicleData');
        // Route::get('/vehicle/variants/update-code/modal/{typ}/{vid}','Admin\VehiclesController@varientcodeUpdateModel');
        // Route::post('/vehicle/varients/update-code/', 'Admin\VehiclesController@varientcodeUpdate');
        
        
        Route::get('/sales/insured', 'Admin\InsuredController@index');
        Route::get('/sales/insured/view', 'Admin\InsuredController@view');
        Route::post('/sales/insured/getInsureddatatable', 'Admin\InsuredController@getInsureddatatable');
        Route::post('/sales/insured/getpdf', 'Admin\InsuredController@getPolicyPdf');
        Route::get('/sales/insured/get-policy-overview/{policyid}', 'Admin\InsuredController@policyOverviewModal');
        Route::get('/sales/insured/export', 'Admin\InsuredController@exportExcel');
        Route::get('/sales/add/new/{param?}', 'Admin\InsuredController@addNewSoldPolicy');
        
        
        Route::post('/sales/save/new/policy', 'Admin\InsuredController@saveNewPolicy');
        
        Route::get('/get/list/make/{param?}', 'Motor\MotorInsurance@GetMake');
        Route::get('/get/list/model-with-varient/{make}/{param?}', 'Motor\MotorInsurance@GetModelVarientByMake');
        
        
        
        Route::get('/sales/leads', 'Admin\LeadsController@index');
        Route::post('sales/leads/datatable/enq', 'Admin\LeadsController@getLeadsenQdatatable');
        Route::post('sales/leads/datatable/quote', 'Admin\LeadsController@getLeadsQuotedatatable');
        Route::get('/sales/leads/info/{lead_id}', 'Admin\LeadsController@getLeadsDetails');
        
        Route::get('/pincode-master', 'Admin\PincodeController@index');
        Route::post('pincode/datatable', 'Admin\PincodeController@getPincodedatatable');
        
          Route::get('/test/kit', 'TestController@testkit');
     });

?>