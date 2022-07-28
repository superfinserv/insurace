<?php
namespace App\Http\Controllers\Motor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use Auth;
use File;
use App\Resources\DigitCarResource;
use App\Resources\HdfcErgoCarResource;
use App\Resources\FgiCarResource;
use Symfony\Component\HttpFoundation\Cookie;
use App\Utils\UserManager;
class Carinsurance extends Controller
{
    public $uniqueToken;
    
    public function __construct() { 
           $this->DigitCar   = new DigitCarResource; 
           $this->HdfcErgoCar= new HdfcErgoCarResource; 
           $this->usermanger =  new UserManager;
           $this->FgiCar =  new FgiCarResource;
    }
    
    function getToken(){
            if(isset(Auth::guard('agents')->user()->id)){
                $this->uniqueToken  = Auth::guard('agents')->user()->posp_ID;
            }else{
                $this->uniqueToken  = Auth::guard('customers')->user()->uniqueToken;
            }
            return $this->uniqueToken;
    }
   
  
   public function index(){
    // $cookies =    \Cookie::get('enQ');
     // print_r($cookies);
        if(isset(Auth::guard('customers')->user()->id)){
            $template = ['title' => 'Car number',"subtitle"=>"Car number",'scripts'=>[asset('js/motor/car/reg-number.js')]];  
            return View::make('motor.car.reg_number')->with($template);
        }else{
         $template = ['title' => 'Car-Insurance',"subtitle"=>"Car-Insurance",];  
         return View::make('motor.car.index')->with($template);
        }
    }
    
    public function insuranceDetails(){
          $template = ['title' => 'Car Insurance',"subtitle"=>"Car Insurance Detail"];  
          return View::make('motor.car.insurance_detail')->with($template);
    
    }
    public function regNumber(){
         $template = ['title' => 'Car number',"subtitle"=>"Car number",'scripts'=>[asset('js/motor/car/reg-number.js')]];  
         return View::make('motor.car.reg_number')->with($template);
    }
     public function registrationLocation(){
         $rto_master = DB::table('rtoMaster')->get();
         $template = ['title' => 'Car',"subtitle"=>"Registration location",'scripts'=>[asset('js/motor/car/registration-location.js')],'rto_master'=>$rto_master];  
         return View::make('motor.car.registration_location')->with($template);
    }
    
  
    public function brand(){
         $brands = DB::table('vehicle_make_car')->select('*')->where('status','ACTIVE')->orderBy('serial_no','ASC')->get();
        $brands10=DB::table('vehicle_make_car')->select('*')->whereNotNull('serial_no')->where(['status'=>'ACTIVE'])->orderBy('serial_no','ASC')->limit(12)->get();
        $template = ['title' => 'Car',"subtitle"=>"Brands",'scripts'=>[asset('js/motor/car/brand.js')],'brands'=>$brands,'brands10'=>$brands10];  
        return View::make('motor.car.brand')->with($template);

    }
     public function model(Request $request){
         $template = ['title' => 'Car',"subtitle"=>"Model",'scripts'=>[asset('js/motor/car/model.js')]];  
        return View::make('motor.car.models')->with($template);
    }
    
    public function loadCarModel(Request $request){
       $count=DB::table('vehicle_modal_car')->where(['make_id'=>$request->brandId,'status'=>'ACTIVE'])->count();
       $models   = DB::table('vehicle_modal_car')->select('id','modal')->where(['make_id'=>$request->brandId,'status'=>'ACTIVE'])->orderBy('modal','ASC')->get();
       $models10 = DB::table('vehicle_modal_car')->select('id','modal')->where(['make_id'=>$request->brandId,'status'=>'ACTIVE'])->orderBy('serial_no','ASC')->limit(10)->get();
      
       $template = ['count' => $count,"models"=>$models,"models10"=>$models10,"brandName"=>$request->brandName];  
       return View::make('motor.car.loadModel')->with($template);
       
    }
    
    public function carVariant(Request $request){
        $template = ['title' => 'Car',"subtitle"=>"variant",'scripts'=>[asset('js/motor/car/varients.js')]];  
        return View::make('motor.car.variant')->with($template);
    }
    
    public function loadVarient(Request $request){
       $count=DB::table('vehicle_variant_car')
                ->where('modal_id',$request->modelId)->count();
       $varients=DB::table('vehicle_variant_car')
                    ->select('id','variant','fuel_type','seating_capacity','cubic_capacity')
                    ->where('modal_id',$request->modelId)->get();
       $template = ['count' => $count,"varients"=>$varients,"modelName"=>$request->modelName];  
       
       return View::make('motor.car.loadVarients')->with($template);
    }
    

    public function registrationYear(){
         $template = ['title' => 'Car',"subtitle"=>"Registration Year",'scripts'=>[asset('js/motor/car/registration-year.js')]];  
         return View::make('motor.car.registration_year')->with($template);
    }
    
    public function ncbTransfer(){
         $template = ['title' => 'Car',"subtitle"=>"NCB Transfer",'scripts'=>[asset('js/motor/car/ncb-transfer.js')]]; 
         $template['previous_insurer']=DB::table('previous_insurer')->where(['status'=>'ACTIVE','type'=>'GENERAL'])->get();
         return View::make('motor.car.ncb-transfer')->with($template);
    }
    
    public function expiryDetail(){
     //$previous_insurer=DB::table('previous_insurer')->where(['status'=>'ACTIVE','type'=>'GENERAL'])->get();
     
     $template = ['title' => 'Car',"subtitle"=>"Expiry Detail",'scripts'=>[asset('js/motor/car/expiry_detail.js')]];
      $template['makeList'] = DB::table('vehicle_make_car')->get();
     return View::make('motor.car.expiry_detail')->with($template);

    }
    
    public  function plansData(Request $request){
        //  $idvdata = DB::table('app_temp_quote')
        //               ->select(DB::raw('MIN(min) as minval,MAX(max) as maxval'))
        //               ->where('type','BIKE')
        //               ->where('device',Auth::guard('customers')->user()->uniqueToken)->first();
         $template = ['title' => 'Car',"subtitle"=>"Plan List",'scripts'=>[asset('js/motor/car/plan.js?v=0.0.2')]];  
         return View::make('motor.car.plan_list')->with($template);
    }
    
    public function loadPlans(Request $request){
        if($request->supp=="DIGIT"){
             
             $_result = $this->DigitCar->getQuickQuote($this->getToken(),$request->carInfo);
             if($_result['status']){ 
              $result = $this->DigitCar->getRecalulateQuote($this->getToken(),$request->carInfo);
              if($result['status']){ 
                  return response()->json(['status' => 'success','data' => $result['plans']]);
              }else{
                  return response()->json(['status' => 'error','data' =>[],'message'=>$result['message']]);
              }
             }else{return response()->json(['status' => 'error','data' =>[],'message'=>$_result['message']]);}
         }
         if($request->supp=="HDFCERGO"){
             
             $plans =[];
             $result= $this->HdfcErgoCar->getQuickQuote($this->getToken(),$request->carInfo);
             if($result['status']){ 
                  return response()->json(['status' => 'success','data' => $result['plans']]);
              }else{
                 return response()->json(['status' => 'error','data' =>[],'message'=>$result['message']]);
              }
         }
         
          if($request->supp=="FGI"){
             $plans =[];
             $result= $this->FgiCar->getQuickQuote($this->getToken(),$request->carInfo);
             if($result['status']){ 
                  return response()->json(['status' => 'success','data' => $result['plans']]);
              }else{
                 return response()->json(['status' => 'error','data' =>[],'message'=>$result['message']]);
              }
         }
    }
    
    public function loadPlansRecalculate(Request $request){
        if($request->supp=="DIGIT"){
               $result = $this->DigitCar->getRecalulateQuote($this->getToken(),$request->carInfo);
               if($result['status']){ 
                   return response()->json(['status'=>'success','message'=>'Quote get successfully','data'=>$result['plans']]); 
               }else{
                   return response()->json(['status'=>'error','message'=>'Something went wrong try again','data'=>[]]);
               }
               
         }
         else if($request->supp=="HDFCERGO"){
             $plans =[];
             $hdfc= $this->HdfcErgoCar->getRecalulateQuote($this->getToken(),$request->carInfo);
             if($hdfc['status']){
                  return response()->json(['status' => 'success','data' => $hdfc['plans']]);
             }else{
                 return response()->json(['status' => 'error','supp'=>'HDFCERGO','plans' => []]);
             }
         }else if($request->supp=="FGI"){
             $FGplans =[];
             $fgii= $this->FgiCar->getRecalulateQuote($this->getToken(),$request->carInfo);
             if($fgii['status']){
                  return response()->json(['status' => 'success','data' => $fgii['plans']]);
             }else{
                 return response()->json(['status' => 'error','supp'=>'FGI','plans' => []]);
             }
         }
    }
    
    public function createEnquiry(Request $request){
         $Q =   DB::table('app_temp_quote')->where('quote_id',$request->id)->first();
         $cust = $this->usermanger->GetPolicySoldBy();
         $QuoteId = uniqueQuoteNo('CAR');
        if($Q->provider=="DIGIT"){
            $recalculate = $this->DigitCar->getSingleRecalulateQuote($Q->quote_id,$this->getToken(),$request->carInfo);
            if($recalculate['status']){
                $enquiryId = md5(uniqid(rand(), true));
                $temp =   DB::table('app_temp_quote')->where('quote_id',$recalculate['quote_id'])->first();
                $json_data = json_decode($temp->json_data);//$this->DigitCar->getJsonData($temp->response);
                $json_data->enq = $enquiryId;
                $quoteData = ['type'=>'CAR', 'SFQuoteId'=>$QuoteId,
                              'provider'=>$temp->provider,
                              'device_id'=>$this->getToken(),
                              'agent_id'=>$cust->agent_id,//$agentID,
                              'sp_id'=>$cust->sp_id,//$spID,
                              'customer_id'=>$cust->customer_id,//$customerID,
                              'customer_mobile'=>$cust->customer_mobile,//$custMobile,
                              'server'=>isset(Auth::guard('customers')->user()->id)?'USER_WEB':'AGENT_WEB',
                              'call_type'=>"QUOTE",
                              'idv'=>$temp->idv,
                              'policyType'=>$temp->policyType,
                              'premiumAmount'=>$json_data->gross,
                              'netAmt'=>$temp->netAmt,
                              'taxAmt'=>$temp->taxAmt,
                              'grossAmt'=>$temp->grossAmt,
                              'min_idv'=>$temp->min_idv,
                              'max_idv'=>$temp->max_idv,
                              'params_request'=>json_encode($request->carInfo),
                              'json_data'=>json_encode($json_data),
                              'reqQuote'=>$temp->reqQuote,
                              'respQuote'=>$temp->respQuote,
                              'reqRecalculate'=>$temp->reqRecalculate,
                              'respRecalculate'=>$temp->respRecalculate
                             ];
                 $quoteData['enquiry_id'] =  $enquiryId;
                 $refID = DB::table('app_quote')->insertGetId($quoteData);
                 return response()->json(['status'=>'success','data'=>['enq'=>$enquiryId]]);
            }else{
                return response()->json(['status'=>'error','message'=>"Error while recalculating premium.",'data'=>[]]);
            }
        }else if($Q->provider=="HDFCERGO" || $Q->provider=="FGI" ){
                $enquiryId = md5(uniqid(rand(), true));
                $temp =   DB::table('app_temp_quote')->where('quote_id',$request->id)->first();
                $json_data = json_decode($temp->json_data);//$this->DigitCar->getJsonData($temp->response);
                $json_data->enq = $temp->quote_id;
                  
                $quoteData = ['type'=>'CAR','SFQuoteId'=>$QuoteId,
                              'provider'=>$temp->provider,
                              'device_id'=>$this->getToken(),
                              'agent_id'=>$cust->agent_id,//$agentID,
                              'sp_id'=>$cust->sp_id,//$spID,
                              'customer_id'=>$cust->customer_id,//$customerID,
                              'customer_mobile'=>$cust->customer_mobile,//$custMobile,
                               'policyType'=>$temp->policyType,
                              'server'=>isset(Auth::guard('customers')->user()->id)?'USER_WEB':'AGENT_WEB',
                              'call_type'=>"QUOTE",
                              'idv'=>$temp->idv,
                              'premiumAmount'=>$json_data->gross,
                              'netAmt'=>$temp->netAmt,
                              'taxAmt'=>$temp->taxAmt,
                              'grossAmt'=>$temp->grossAmt,
                              'min_idv'=>$temp->min_idv,
                              'max_idv'=>$temp->max_idv,
                              'params_request'=>json_encode($request->carInfo),
                              'json_data'=>json_encode($json_data),
                              'reqQuote'=>$temp->reqQuote,
                               'respQuote'=>$temp->respQuote,
                               'reqRecalculate'=>$temp->reqRecalculate,
                               'respRecalculate'=>$temp->respRecalculate
                              
                             ];
                 $quoteData['enquiry_id'] =  $enquiryId;
                 $refID = DB::table('app_quote')->insertGetId($quoteData);
                 return response()->json(['status'=>'success','data'=>['enq'=>$enquiryId]]);
        }else{
            return response()->json(['status'=>'error','message'=>"Something went wrong, try again.",'data'=>['enq'=>null]]);
        }
        
       
    }
    
    function uploadFiles(Request $request){
         $data =   DB::table('app_quote')->where('enquiry_id',$request->enc)->first();
         $oldfile = $data->policy_doc;
         $fileName = uniqid().'-'.$request->enc.'.'.request()->policy_doc->getClientOriginalExtension();
         $request->policy_doc->move("public/assets/customers/pre-policy-doc", $fileName);
         DB::table('app_quote')->where('enquiry_id',$request->enc)->update(['policy_doc'=>$fileName]);
         if($oldfile!=''){ 
              $image_path = public_path('assets/customers/pre-policy-doc/'.$oldfile);
             if(File::exists($image_path)) { File::delete($image_path); }
         }
         return response()->json(['status'=>'success','filename'=>$fileName,'message'=>'Document has been uploaded successfully']);
            
    }
    
    public function userInformationFrom(Request $request){
         $enquiryID = $request->enquiryID;
         $states = DB::table('states')->get()->toArray();
         $city =   DB::table('cities')->get()->toArray();
         $relations =   DB::table('relations')->get();
         $info =   DB::table('app_quote')->where('enquiry_id',$enquiryID)->first();
          $provider =  $info->provider;
        $preQuery=DB::table('previous_insurer');
         if($provider=='HDFCERGO'){
             $preQuery->whereNotNull('hdfcErgo');
         }
         $previous_insurer =$preQuery->where(['status'=>'ACTIVE','type'=>'GENERAL'])->get();
         $template = ['title' => 'usersDetails',"subtitle"=>"usersDetails",'relations'=>$relations,'scripts'=>[asset('js/motor/car/user_info.js')],
                      'states'=>$states,'data'=>$info,'previous_insurer'=>$previous_insurer]; 
         $template['partner']  = DB::table('our_partners')->where('shortName',$info->provider)->first();
         $prm = json_decode($info->params_request);
         if(isset($prm->address->state)){
             $ST = explode('-',$prm->address->state);
             $template['cities'] =  DB::table('cities')->select(DB::raw("CONCAT(id,'-',name) AS id,name as value"))->where('state_id',$ST[0])->get(); 
         }
         return View::make('motor.car.user_info')->with($template);
    }
    
    public function updateInfo(Request $request){
        if($request->enqId!=""){
             $arr =  ["params_request"=>json_encode($request->param)];
             $arr['customer_mobile'] =  $request->param['customer']['mobile'];
             $arr['customer_name'] =  $request->param['customer']['first_name']." ".$request->param['customer']['last_name'];
             $arr['customer_id'] = $this->usermanger->createCustomer([
                                                    'mobile'=>$request->param['customer']['mobile'],
                                                    'name'=>$request->param['customer']['first_name']." ".$request->param['customer']['last_name'],
                                                    'email'=>$request->param['customer']['email'],
                                                    //'address'=>$request->param['address']['addressLineOne'].",".$request->param['address']['addressLineTwo'],
                                                    //'city'=>explode('-',$request->param['address']['city'])[0],
                                                    //'state'=>explode('-',$request->param['address']['state'])[0],
                                                    //'pincode'=>$request->param['address']['pincode'],
                                               ]);
             
                // if(isset(Auth::guard('customers')->user()->mobile)){
                //      $isPOSP = DB::table('agents')->where('mobile',Auth::guard('customers')->user()->mobile)->count();
                //      if($isPOSP){
                //          $agent = DB::table('agents')->where('mobile',Auth::guard('customers')->user()->mobile)->first();
                //          if($agent->userType=="POSP"){ $arr['agent_id'] = $agent->id;$arr['sp_id'] = ($agent->mapped_sp)?$agent->mapped_sp:0;}
                //          if($agent->userType=="SP"){ $arr['agent_id'] = $agent->id;$arr['sp_id'] = $agent->id;}
                //      }
                // }
            DB::table('app_quote')->where('enquiry_id', $request->enqId)->update($arr);
            return response()->json(['status'=>'success','message'=>'Information updated successfully']);
        }else{
            return response()->json(['status'=>'error','message'=>'Something went wrong']);
        }
    }
    
    public function createProposal(Request $request){
      if($request->enc){
         $count = DB::table('app_quote')->where('enquiry_id',$request->enc)->count();
         if($count){
             //DB::table('app_quote')->where('enquiry_id', $request->enc)->update(["params_request"=>json_encode($request->carInfo)]);
             $data = DB::table('app_quote')->where('enquiry_id',$request->enc)->first();
             if($data->provider=='DIGIT'){
                 $resp = $this->DigitCar->createQuote($request->enc,json_decode($data->params_request));
                if($resp['status']){
                    if($resp['isBreakIn']){
                        $result = ['status'=>'success','isBreakIn'=>'Yes','message'=>'Inspection case created successfully','data'=>['enc'=>$request->enc]];
                    }else{
                        $result = ['status'=>'success','isBreakIn'=>'No','message'=>'Proposal Created successfully','data'=>['enc'=>$request->enc]];
                    }
                     //$result = ['status'=>'success','message'=>'Proposal Created successfully','data'=>['enc'=>$request->enc]];
                }else{
                    $result = ['status'=>'error','message'=>$resp['message'],'data'=>[]];
                }
             }else if($data->provider=='HDFCERGO'){
                 $resp = $this->HdfcErgoCar->createProposal($request->enc,json_decode($data->params_request));
                if($resp['status']){
                    if($resp['isBreakIn']){
                        $result = ['status'=>'success','isBreakIn'=>'Yes','message'=>'Inspection case created successfully','data'=>['enc'=>$request->enc]];
                    }else{
                        $result = ['status'=>'success','isBreakIn'=>'No','message'=>'Proposal Created successfully','data'=>['enc'=>$request->enc]];
                    }
                }else{
                    $result = ['status'=>'error','message'=>$resp['message'],'data'=>[]];
                }
             }else if($data->provider=='FGI'){
                 $resp = $this->FgiCar->createQuote($request->enc,json_decode($data->params_request));
                if($resp['status']){
                     $result = ['status'=>'success','message'=>'Proposal Created successfully','data'=>['enc'=>$request->enc]];
                }else{
                    $result = ['status'=>'error','message'=>$resp['message'],'data'=>[]];
                }
             }else{
                  $result  =['status'=>'error','message'=>'Unkonwn insurer found!','data'=>[]];
             }
         }else{
             $result  =['status'=>'error','message'=>'Unkonwn insurer found!','data'=>[]];
         }
        }else{
            $result  =['status'=>'error','message'=>'Unkonwn insurer found!','data'=>[]];
        }
         return response()->json($result);  
    }
    
    public  function plan_summary(Request $request){
         $enquiryID = $request->enquiryID;
         $template = ['title' =>'Pvt Car',"subtitle"=>"Plan Summary",'scripts'=>[asset('js/motor/car/plan_summary.js')]];  
         $template['info'] =   DB::table('app_quote')->where('type','CAR')->where('enquiry_id',$enquiryID)->first();
         $template['partner']  = DB::table('our_partners')->where('shortName',$template['info']->provider)->first();
         if($template['info']->provider=='HDFCERGO'){
              $txid = $template['info']->token;
              
              $hashSequence = config('motor.HDFCERGO.car.mKey')."|".$txid."|".config('motor.HDFCERGO.car.secretToken')."|S001";
              $template['checkSum'] = strtoupper(hash('sha512', $hashSequence));
              $template['paymetAction'] = config('motor.HDFCERGO.car.paymentGateway');
         }else if($template['info']->provider=='FGI'){
               $jsonData = json_decode($template['info']->json_data);
               $paramData = json_decode($template['info']->params_request);
               $template['TransactionID']= $template['info']->token;
               $template['PaymentOption']= 3;
               $template['ResponseURL'] = config('custom.site_url').'/moter-insurance/insured-success/car/'.$enquiryID;
               $template['ProposalNumber'] =$enquiryID;
               $template['PremiumAmount']  = $jsonData->gross;
               $template['UserIdentifier'] = $paramData->customer->first_name." ".$paramData->customer->last_name;
               $template['UserId'] = $paramData->customer->mobile;
               $template['FirstName'] =$paramData->customer->first_name;
               $template['LastName'] = $paramData->customer->last_name;
               $template['Mobile'] =$paramData->customer->mobile;
               $template['Email'] =$paramData->customer->email;
               $template['Vendor'] =1;
              //TransactionID|PaymentOption|ResponseURL|ProposalNumber|PremiumAmount|UserIdentifier|UserId|FirstName|LastName|Mobile|Email|
              $hashSequence=$template['info']->token."|".$template['PaymentOption']."|".$template['ResponseURL']."|".$enquiryID."|".$jsonData->gross."|".$template['UserIdentifier']."|".$template['UserId']."|".$template['FirstName']."|".$template['LastName']."|".$template['Mobile']."|".$template['Email']."|";
             // $hashSequence = config('motor.HDFCERGO.tw.mKey')."|".$txid."|".config('motor.HDFCERGO.tw.secretToken')."|S001";
              $template['checkSum'] = $this->FgiCar->Generatehash256($hashSequence);
              $template['paymetAction'] = config('motor.FGI.car.payment');
              //$template['paymetAction'] ="https://online.futuregenerali.in/ECOM_NL/WEBAPPLN/UI/Common/webaggpay.aspx";
         }
         return View::make('motor.car.plan_summary')->with($template);
    }
    
    public  function inspectionCase(Request $request){
         $enquiryID = $request->enquiryID;
         $template = ['title' =>'Pvt Car',"subtitle"=>"Plan Summary",'scripts'=>[asset('js/motor/car/inspection-case.js')]];  
         $template['info'] =   DB::table('app_quote')->where('type','CAR')->where('enquiry_id',$enquiryID)->first();
         $template['partner']  = DB::table('our_partners')->where('shortName',$template['info']->provider)->first();
         if($template['info']->provider=='HDFCERGO'){
              //$txid = $template['info']->token;
             // $hashSequence = "FINSERV|".$txid."|oBByKfE6gpv2AWnhjpk1VA==|S001";
             // $template['checkSum'] = strtoupper(hash('sha512', $hashSequence));
         }
         return View::make('motor.car.inspection')->with($template);
    }
    
    function GetInspectionApprovalInfo(Request $request){
       $info =   DB::table('app_quote')->where('type','CAR')->where('enquiry_id',$request->enquiryID)->first();
       if($info->provider=='HDFCERGO'){
               $breakIn =  json_decode($info->breakInJson,true);
               $res = $this->HdfcErgoCar->GetBreakinDetails($breakIn['BreakinId'],$breakIn['QuoteId']);
               if(trim($res['BreakInStatus'])=="Pending"){
                   $html= '<p class="text-center">Your inspection tracking no. <b>'.$breakIn['QuoteId'].'</b> </p>
                         <p class="text-center" style="margin: 10px;">Download HdfcErgo self Inspection app and enter above tracking number.</p> 
                         <p class="text-center">--OR--</p>
                         <p class="text-center">you will receive an SMS with <b>"Self-Inspection App Link"</b> to complete the inspection process</p>';
               }else if(trim($res['BreakInStatus'])=="Initiated"){
                    $html= '<p class="text-center">Your inspection tracking no. <b>'.$breakIn['QuoteId'].'</b> </p>
                         <p class="text-center" style="margin: 10px;">'.$res['message'].'</p> ';
               }else if(trim($res['BreakInStatus'])=="Processed"){
                    $html= '<p class="text-center">Your inspection tracking no. <b>'.$breakIn['QuoteId'].'</b> </p>
                         <p class="text-center" style="margin: 10px;">'.$res['message'].'</p> ';
               }else if(trim($res['BreakInStatus'])=="Approved"){
                    $html= '<p class="text-center">Your inspection tracking no. <b>'.$breakIn['QuoteId'].'</b> </p>
                         <p class="text-center" style="margin: 10px;">'.$res['message'].'</p> ';
               }
       }else if($info->provider=='DIGIT'){
            $breakIn =  json_decode($info->breakInJson);
            $res = $this->DigitCar->GetpolicyInfo($breakIn->BreakinId,$breakIn->QuoteId);
            //print_r($res);
            if(trim($res['BreakInStatus'])=="Pending"){
                   $html= '<p class="text-center">Your inspection tracking no. <b>'.$breakIn->QuoteId.'</b> </p>
                         <p class="text-center">you will receive an SMS with <b>"Self-Inspection App Link"</b> to complete the inspection process</p>';
               }else if(trim($res['BreakInStatus'])=="Initiated"){
                    $html= '<p class="text-center">Your inspection tracking no. <b>'.$breakIn->QuoteId.'</b> </p>
                         <p class="text-center" style="margin: 10px;">'.$res['message'].'</p> ';
               }else if(trim($res['BreakInStatus'])=="Processed"){
                    $html= '<p class="text-center">Your inspection tracking no. <b>'.$breakIn->QuoteId.'</b> </p>
                         <p class="text-center" style="margin: 10px;">'.$res['message'].'</p> ';
               }else if(trim($res['BreakInStatus'])=="Approved"){
                    $html= '<p class="text-center">Your inspection tracking no. <b>'.$breakIn->QuoteId.'</b> </p>
                         <p class="text-center" style="margin: 10px;">'.$res['message'].'</p> ';
               }
       }
       
        $result = ['status'=>'success','provider'=>$info->provider,'BreakInStatus'=>$res['BreakInStatus'],'message'=>"Success",'data'=>$html];
         return response()->json($result);
    }
    
     function GetPostinspectionCalculatePremium(Request $request){ 
       //  $info =   DB::table('app_quote')->where('type','CAR')->where('enquiry_id',$request->enquiryID)->first();
         $res = $this->HdfcErgoCar->GetPostInspectionCalculatePremium($request->enquiryID);
         if($res['status']){
             $result = ['status'=>'success','message'=>"Success",'data'=>['enq'=>$request->enquiryID]]; 
         }else{
             $result = ['status'=>'error','message'=>$res['message'],'data'=>['enq'=>$request->enquiryID]];
         } 
           return response()->json($result);
     }
     
     function GetPostinspectionCreateProposal(Request $request){ 
       //  $info =   DB::table('app_quote')->where('type','CAR')->where('enquiry_id',$request->enquiryID)->first();
         $res = $this->HdfcErgoCar->GetPostinspectionCreateProposal($request->enquiryID);
         if($res['status']){
             $result = ['status'=>'success','message'=>"Success",'data'=>['enq'=>$request->enquiryID]]; 
         }else{
             $result = ['status'=>'error','message'=>$res['message'],'data'=>['enq'=>$request->enquiryID]];
         } 
           return response()->json($result);
     }
   
    
    public function connectToinsurer(Request $request){
        if($request->enc){
         $count = DB::table('app_quote')->where('enquiry_id',$request->enc)->count();
         if($count){
             $data = DB::table('app_quote')->where('enquiry_id',$request->enc)->first();
             if($data->status=="SOLD"){
                $result  =['status'=>'error','message'=>"Policy for these enquiry already generated.",'data'=>''];
             }else{
                 if($data->provider=='DIGIT'){
                     $jsonData =  json_decode($data->respCreate);
                     $resp = $this->DigitCar->getPaymentInfo($jsonData->applicationId,$request->enc);
                     if($resp['status']){
                         $result = ['status'=>'success','message'=>$resp['message'],'data'=>$resp['data']];
                     }else{
                        $result = ['status'=>'error','message'=>$resp['message'],'data'=>''];
                     }
                 }else{
                      $result  =['status'=>'error','message'=>'Unkonwn service provider found!','data'=>''];
                 }
            }
         }else{
             $result  =['status'=>'error','message'=>"Invalid Enquiry Found. Kindly contact to SuperFinserv's Relationship Manager",'data'=>''];
         }
        }else{
            $result  =['status'=>'error','message'=>"Invalid Enquiry Found. Kindly contact to SuperFinserv's Relationship Manager",'data'=>''];
        }
      return response()->json($result);
    }
    
    public  function paymentlink(Request $request){
         $enquiryID = $request->enquiryID;
         $info =   DB::table('app_quote')->where('type','CAR')->where('enquiry_id',$enquiryID)->first();
         $template = ['title' => 'Car Insurance',"subtitle"=>"Pay Now",
                       'scripts'=>[asset('page_js/car/car-payment-link.js')],
                       'info'=>json_decode($info->json_data)];  
         return View::make('web.bike.bikePaymentLink')->with($template);
    }
    
   

    
}

