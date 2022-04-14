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
use App\Resources\DigitBikeResource;
use App\Resources\HdfcErgoTwResource;
use App\Resources\FgiTwResource;
class Twinsurance extends Controller
{
    public $uniqueToken;
    
    public function __construct(DigitBikeResource $DigitBikeResource ,HdfcErgoTwResource $HdfcErgoTwResource) { 
           $this->DigitTw   = $DigitBikeResource; 
           $this->HdfcErgo  = $HdfcErgoTwResource; 
           $this->FgiTw =  new FgiTwResource;
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
       
         
         if(isset(Auth::guard('customers')->user()->id)){
            $template = ['title' => 'Twowheeler number',"subtitle"=>"Twowheeler number",'scripts'=>[asset('js/motor/tw/reg-number.js')]];  
            return View::make('motor.tw.reg_number')->with($template);
        }else{
           $template = ['title' => 'Twowheeler-Insurance',"subtitle"=>"Twowheeler-Insurance",];  
           return View::make('motor.tw.index')->with($template);
        }
    }
    
    public function insuranceDetails(){
          $template = ['title' => 'Twowheeler Insurance',"subtitle"=>"Twowheeler Insurance Detail"];  
          return View::make('motor.tw.insurance_detail')->with($template);
    
    }
    public function regNumber(){
         $template = ['title' => 'Twowheeler number',"subtitle"=>"Twowheeler number",'scripts'=>[asset('js/motor/tw/reg-number.js')]];  
         return View::make('motor.tw.reg_number')->with($template);
    }
     public function registrationLocation(){
         $rto_master = DB::table('rtoMaster')->get();
         $template = ['title' => 'Twowheeler',"subtitle"=>"Registration location",'scripts'=>[asset('js/motor/tw/registration-location.js')],'rto_master'=>$rto_master];  
         return View::make('motor.tw.registration_location')->with($template);
    }
    
  
    public function brand(){
        $brands = DB::table('vehicle_make_tw')->select('*')->where('status','ACTIVE')->orderBy('serial_no','ASC')->get();
        $brands10=DB::table('vehicle_make_tw')->select('*')->whereNotNull('serial_no')->where(['status'=>'ACTIVE'])->orderBy('serial_no','ASC')->limit(12)->get();
        $template = ['title' => 'Twowheeler',"subtitle"=>"Brands",'scripts'=>[asset('js/motor/tw/brand.js')],'brands'=>$brands,'brands10'=>$brands10];  
        return View::make('motor.tw.brand')->with($template);

    }
     public function model(Request $request){
         $template = ['title' => 'Twowheeler',"subtitle"=>"Model",'scripts'=>[asset('js/motor/tw/model.js')]];  
        return View::make('motor.tw.models')->with($template);
    }
    
    public function loadTwModel(Request $request){
       $count=DB::table('vehicle_modal_tw')->where(['make_id'=>$request->brandId,'status'=>'ACTIVE'])->count();
       $models=DB::table('vehicle_modal_tw')->select('id','modal')->where(['make_id'=>$request->brandId,'status'=>'ACTIVE'])->orderBy('modal','ASC')->get();
       $models10=DB::table('vehicle_modal_tw')->select('id','modal')->where(['make_id'=>$request->brandId,'status'=>'ACTIVE'])->orderBy('serial_no','ASC')->limit(10)->get();
      
       $template = ['count' => $count,"models"=>$models,"models10"=>$models10,"brandName"=>$request->brandName];  
       return View::make('motor.tw.loadModel')->with($template);
       
    }
    
    public function twVariant(Request $request){
        $template = ['title' => 'Twowheeler',"subtitle"=>"variant",'scripts'=>[asset('js/motor/tw/varients.js')]];  
        return View::make('motor.tw.variant')->with($template);
    }
    
    public function loadVarient(Request $request){
       $count=DB::table('vehicle_variant_tw')
                ->where('modal_id',$request->modelId)->count();
       $varients=DB::table('vehicle_variant_tw')
                    ->select('id','variant','fuel_type','cubic_capacity')
                    ->where('modal_id',$request->modelId)->get();
       $template = ['count' => $count,"varients"=>$varients,"modelName"=>$request->modelName];  
       
       return View::make('motor.tw.loadVarients')->with($template);
    }
    

    public function registrationYear(){
         $template = ['title' => 'Twowheeler',"subtitle"=>"Registration Year",'scripts'=>[asset('js/motor/tw/registration-year.js')]];  
         return View::make('motor.tw.registration_year')->with($template);
    }
    
    public function ncbTransfer(){
         $template = ['title' => 'Twowheeler',"subtitle"=>"NCB Transfer",'scripts'=>[asset('js/motor/tw/ncb-transfer.js')]]; 
         $template['previous_insurer']=DB::table('previous_insurer')->where(['status'=>'ACTIVE','type'=>'GENERAL'])->get();
         return View::make('motor.tw.ncb-transfer')->with($template);
    }
    public function expiryDetail(){
     //$previous_insurer=DB::table('previous_insurer')->where(['status'=>'ACTIVE','type'=>'GENERAL'])->get();
     $template = ['title' => 'Twowheeler',"subtitle"=>"Expiry Detail",'scripts'=>[asset('js/motor/tw/expiry_detail.js')]]; 
      $template['makeList'] = DB::table('vehicle_make_tw')->get();
     return View::make('motor.tw.expiry_detail')->with($template);

    }
    
    public  function plansData(Request $request){
        //  $idvdata = DB::table('app_temp_quote')
        //               ->select(DB::raw('MIN(min) as minval,MAX(max) as maxval'))
        //               ->where('type','BIKE')
        //               ->where('device',Auth::guard('customers')->user()->uniqueToken)->first();
         $template = ['title' => 'Twowheeler',"subtitle"=>"Plan List",'scripts'=>[asset('js/motor/tw/plan.js')]];  
         return View::make('motor.tw.plan_list')->with($template);
    }
    
    public function loadPlans(Request $request){
        if($request->supp=="DIGIT"){
             
             $_result = $this->DigitTw->getQuickQuote($this->getToken(),$request->twInfo);
             if($_result['status']){ 
              $result = $this->DigitTw->getRecalulateQuote($this->getToken(),$request->twInfo);
              if($result['status']){ 
                  return response()->json(['status' => 'success','data' => $result['plans']]);
              }else{
                  return response()->json(['status' => 'error','data' =>[],'message'=>$result['message']]);
              }
             }else{return response()->json(['status' => 'error','data' =>[],'message'=>$_result['message']]);}
         }
         if($request->supp=="HDFCERGO"){
             $plans =[];
             $result= $this->HdfcErgo->getQuickQuote($this->getToken(),$request->twInfo);
             if($result['status']){ 
                  return response()->json(['status' => 'success','data' => $result['plans']]);
              }else{
                  return response()->json(['status' => 'error','message'=>$result['message'],'data' =>[]]);
              }
         }
         
         if($request->supp=="FGI" ){
             
              $plans =[];
             $result= $this->FgiTw->getQuickQuote($this->getToken(),$request->twInfo);
             if($result['status']){ 
                  return response()->json(['status' => 'success','data' => $result['plans']]);
              }else{
                  return response()->json(['status' => 'error','message'=>$result['message'],'data' =>[]]);
              }
         }
    }
    
    public function loadPlansRecalculate(Request $request){
        if($request->supp=="DIGIT"){
               $result = $this->DigitTw->getRecalulateQuote($this->getToken(),$request->twInfo);
               if($result['status']){ 
                   return response()->json(['status'=>'success','message'=>'Quote get successfully','data'=>$result['plans']]); 
               }else{
                   return response()->json(['status'=>'error','message'=>'Something went wrong try again','data'=>[]]); 
               }
               
         }else if($request->supp=="HDFCERGO"){
             $plans =[];
             $hdfc= $this->HdfcErgo->getRecalulateQuote($this->getToken(),$request->twInfo);
             if($hdfc['status']){
                  return response()->json(['status' => 'success','message'=>'Quote get successfully','data' => $hdfc['plans']]);
             }else{
                 return response()->json(['status' => 'error','message'=>'unable to connect with partner','data' => []]);
             }
         }
         
          if($request->supp=="FGI" ){
             
              $plans =[];
             $result= $this->FgiTw->getRecalulateQuote($this->getToken(),$request->twInfo);
             if($result['status']){ 
                  return response()->json(['status' => 'success','data' => $result['plans']]);
              }else{
                  return response()->json(['status' => 'error','message'=>$result['message'],'data' =>[]]);
              }
         }
    }
    
    
    public function createEnquiry(Request $request){
        $Q =   DB::table('app_temp_quote')->where('quote_id',$request->id)->first();
        
        if($Q->provider=="DIGIT"){
            $recalculate = $this->DigitTw->getSingleRecalulateQuote($Q->quote_id,$this->getToken(),$request->twInfo);
            if($recalculate['status']){
                $enquiryId = md5(uniqid(rand(), true));
                $temp =   DB::table('app_temp_quote')->where('quote_id',$recalculate['quote_id'])->first();
                $json_data = json_decode($temp->json_data);//$this->DigitTw->getJsonData($temp->response);
                $json_data->enq = $enquiryId;
                if(isset(Auth::guard('agents')->user()->id)){
                  $customerID = _createCustomer(['mobile'=>$request->twInfo['customer']['mobile']]);
                  $custMobile = $request->twInfo['customer']['mobile'];
                  $agentID = Auth::guard('agents')->user()->id;
                }else{
                  $customerID =Auth::guard('customers')->user()->id;
                  $agentID = 0;
                  $custMobile = Auth::guard('customers')->user()->mobile;
                }
                $quoteData = ['type'=>'BIKE',
                              'provider'=>$temp->provider,
                              'device_id'=>$this->getToken(),
                              'termYear'=>$temp->tenure,
                              'agent_id'=>$agentID,
                              'customer_id'=>$customerID,
                              'customer_mobile'=>$custMobile,
                              'server'=>isset(Auth::guard('customers')->user()->id)?'USER_WEB':'AGENT_WEB',
                              'call_type'=>"ENQ",
                              'idv'=>$temp->idv,
                              'policyType'=>$temp->policyType,
                              'premiumAmount'=>$json_data->gross,
                              'min_idv'=>$temp->min_idv,
                              'max_idv'=>$temp->max_idv,
                              'params_request'=>json_encode($request->twInfo),
                              'json_data'=>json_encode($json_data),
                             // 'json_resp'=>$temp->json_quote,
                              //'json_recalculate'=>$temp->json_recalculate,
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
                $json_data = json_decode($temp->json_data);//$this->DigitTw->getJsonData($temp->response);
                $json_data->enq = $temp->quote_id;
                if(isset(Auth::guard('agents')->user()->id)){
                  $customerID = _createCustomer(['mobile'=>$request->customerData['mobile']]);
                  $custMobile = $request->customerData['mobile'];
                  $agentID = Auth::guard('agents')->user()->id;
                }else{
                  $customerID =Auth::guard('customers')->user()->id;
                  $agentID = 0;//Auth::guard('agents')->user()->id;
                  $custMobile = Auth::guard('customers')->user()->mobile;
                }
                $quoteData = ['type'=>'BIKE',
                              'provider'=>$temp->provider,
                              'device_id'=>$this->getToken(),
                              'agent_id'=>$agentID,
                              'customer_id'=>$customerID,
                              'customer_mobile'=>$custMobile,
                                'policyType'=>$temp->policyType,
                              'server'=>isset(Auth::guard('customers')->user()->id)?'USER_WEB':'AGENT_WEB',
                              'call_type'=>"ENQ",
                              'idv'=>$temp->idv,
                              'premiumAmount'=>$json_data->gross,
                              'min_idv'=>$temp->min_idv,
                              'max_idv'=>$temp->max_idv,
                              'params_request'=>json_encode($request->twInfo),
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
       //  $city =   DB::table('cities_list')->get()->toArray();
         $relations =   DB::table('relations')->get();
         $info =   DB::table('app_quote')->where('enquiry_id',$enquiryID)->first();
         $provider =  $info->provider;
         $preQuery=DB::table('previous_insurer');
         if($provider=='HDFCERGO'){
             $preQuery->whereNotNull('hdfcErgo');
         }
         $previous_insurer =$preQuery->where(['status'=>'ACTIVE','type'=>'GENERAL'])->get();
         $template = ['title' => 'usersDetails',"subtitle"=>"usersDetails",'relations'=>$relations,'scripts'=>[asset('js/motor/tw/user_info.js')],
                      'states'=>$states,'data'=>$info,'previous_insurer'=>$previous_insurer]; 
         $template['partner']  = DB::table('our_partners')->where('shortName',$info->provider)->first();
         $prm = json_decode($info->params_request);
         if(isset($prm->address->state)){
             $ST = explode('-',$prm->address->state);
             $template['cities'] =  DB::table('cities')->select(DB::raw("CONCAT(id,'-',name) AS id,name as value"))->where('state_id',$ST[0])->get(); 
         }
         return View::make('motor.tw.user_info')->with($template);
    }
    
    public function updateInfo(Request $request){
        if($request->enqId!=""){
            DB::table('app_quote')->where('enquiry_id', $request->enqId)->update(["params_request"=>json_encode($request->param)]);
            return response()->json(['status'=>'success','message'=>'Information updated successfully']);
        }else{
            return response()->json(['status'=>'error','message'=>'Something went wrong']);
        }
    }
    
     public function createProposal(Request $request){
      if($request->enc){
         $count = DB::table('app_quote')->where('enquiry_id',$request->enc)->count();
         if($count){
            //  DB::table('app_quote')->where('enquiry_id', $request->enc)->update(["params_request"=>json_encode($request->twInfo)]);
             $data = DB::table('app_quote')->where('enquiry_id',$request->enc)->first();
             if($data->provider=='DIGIT'){
                 $resp = $this->DigitTw->createQuote($request->enc,json_decode($data->params_request));
                if($resp['status']){
                     $result = ['status'=>'success','message'=>'Proposal Created successfully','data'=>['enc'=>$request->enc]];
                }else{
                    $result = ['status'=>'error','message'=>$resp['message'],'data'=>[]];
                }
             }else if($data->provider=='HDFCERGO'){
                 $resp = $this->HdfcErgo->createProposal($request->enc,json_decode($data->params_request));
                if($resp['status']){
                     $result = ['status'=>'success','message'=>'Proposal Created successfully','data'=>['enc'=>$request->enc]];
                }else{
                    $result = ['status'=>'error','message'=>$resp['message'],'data'=>[]];
                }
             }else if($data->provider=='FGI'){
                 $resp = $this->FgiTw->createQuote($request->enc,json_decode($data->params_request));
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
         $template = ['title' =>'Two Wheeler',"subtitle"=>"Plan Summary",'scripts'=>[asset('js/motor/tw/plan_summary.js')]];  
         $template['info'] =   DB::table('app_quote')->where('type','BIKE')->where('enquiry_id',$enquiryID)->first();
         $template['partner']  = DB::table('our_partners')->where('shortName',$template['info']->provider)->first();
         if($template['info']->provider=='HDFCERGO'){
              $txid = $template['info']->token;
              $hashSequence = config('motor.HDFCERGO.tw.mKey')."|".$txid."|".config('motor.HDFCERGO.tw.secretToken')."|S001";
              $template['checkSum'] = strtoupper(hash('sha512', $hashSequence));
              $template['paymetAction'] = config('motor.HDFCERGO.tw.paymentGateway');
         }else if($template['info']->provider=='FGI'){
             
              $template['TransactionID']= $template['info']->token;
              $template['PaymentOption']= 3;
              $template['ResponseURL'] = config('custom.site_url').'/moter-insurance/insured-success/bike/'.$enquiryID;
              
              $hashSequence = config('motor.HDFCERGO.tw.mKey')."|".$txid."|".config('motor.HDFCERGO.tw.secretToken')."|S001";
              $template['checkSum'] = strtoupper(hash('sha512', $hashSequence));
              $template['paymetAction'] = config('motor.HDFCERGO.tw.paymentGateway');
         }
         return View::make('motor.tw.plan_summary')->with($template);
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
                     $resp = $this->DigitTw->getPaymentInfo($jsonData->applicationId,$request->enc);
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
         $info =   DB::table('app_quote')->where('type','BIKE')->where('enquiry_id',$enquiryID)->first();
         $template = ['title' => 'Bike Insurance',"subtitle"=>"Pay Now",
                       'scripts'=>[asset('page_js/car/car-payment-link.js')],
                       'info'=>json_decode($info->json_data)];  
         return View::make('web.bike.bikePaymentLink')->with($template);
    }
    
   

    
}

