<?php
namespace App\Http\Controllers\Health;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Auth;
use Session;
use File;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Partners\Care\Care;
use App\Partners\Manipal\Manipal;
use App\Partners\Digit\DigitHealth;

class Healthinsurance extends Controller{
   public $uniqueToken;
   public function __construct(Care $care,DigitHealth $digit,Manipal $manipal) { 
       $this->Care =  $care;
       $this->DigitHealth = $digit;
       $this->Manipal =  $manipal;
   }
   
 
    function sendMessage($uName,$enQId){
        $content = array(
            "en" => $uName. " is looking for health insurance"
            );
     
        $hashes_array = array();
        array_push($hashes_array, array(
            "id" => "like-button",
            "text" => "View",
            //"icon" => "http://superfinserv.co.in.com/N8SN8ZS.png",
            "url" => "https://admin.superfinserv.co.in/"
        ));
        // array_push($hashes_array, array(
        //     "id" => "like-button-2",
        //     "text" => "Like2",
        //     "icon" => "http://i.imgur.com/N8SN8ZS.png",
        //     "url" => "https://yoursite.com"
        // ));
        
        
         $fields = array(
        'app_id' => "4e1174c0-be7d-43d7-a934-b56456fd8668",
        'included_segments' => array(
            'Subscribed Users'
        ),
        'data' => array("foo" => "bar"),
        //'content_available'=>true,
        'contents' => $content,
        "subtitle"=>['en'=>'Health Insurance'],
        'headings'=>['en'=>'Super Finserv'],
        'web_buttons' => $hashes_array
    );
        
        $fields = json_encode($fields);
        //print("\nJSON sent:\n");
       // print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic NTdjY2M3ZDktY2Q1MS00ZTIyLTk5ODMtOWQ3MzI4YzFlMGU1'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        //return $response;
    }
    
    

   
   function testJson(){
        $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Plans",'scripts'=>[asset('js/health/health_plans.js')]];  
        return View::make('health.new_health_plans')->with($template);
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
        
        //print_r(Auth::guard('customers')->user());
        if(isset(Auth::guard('customers')->user()->id)){
           $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Profile",'scripts'=>[asset('js/health/health_profile.js')]];  
           return View::make('health.health_profile')->with($template); 
        }else{
           $template = ['title' => 'Health-Insurance',"subtitle"=>"Health-Insurance"];  
           return View::make('health.health_insurance')->with($template);
        }
    }
    public function health_insurance_detail(){
        
          
     
         $template = ['title' => 'Health-Insurance',"subtitle"=>"Health-Insurance"];  
         return View::make('health.health_insurance_detail')->with($template);
    }

     public function healthProfile(){
       
         $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Profile",'scripts'=>[asset('js/health/health_profile.js')]];  
         return View::make('health.health_profile')->with($template);
    }
    
    public function healthProfileMembers(){
        $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Profile Members",'scripts'=>[asset('js/health/health_profile_members.js')]];  
         return View::make('health.health_profile_members')->with($template);
    }
    
    public function healthProfileMembersAge(){
        $states = DB::table('states')->get();
        $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Profile Members",'states'=>$states,'scripts'=>[asset('js/health/health_members_age.js')]];  
         return View::make('health.health_profile_members_age')->with($template);
    }
    
    public function healthPlans(){
        $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Plans",'scripts'=>[asset('js/health/health_plans.js')]];  
        return View::make('health.health_plans')->with($template);
        
    }
    
     
    
    public function getHealthPlans(Request $request){
        
        $R = explode("-",$request->range);
        $range['start'] = $R[0];
        $range['end'] = ($R[1]=="#")?75:$R[1];
        //  if($request->supp=="HDFCERGO"){ 
        //     $plans =[];
        //     $hdfcErgoPlans = $this->HdfcErgoResource->getQuickPlans($range,$request->params,$this->getToken(),$request->policytyp,$request->pln);
        //     if($hdfcErgoPlans['status']=='success'){
        //          foreach($hdfcErgoPlans['plans'] as $pln){
        //              array_push($plans,$pln);
        //          }
        //          $result = ['status' => 'success','supp'=>'HDFCERGO','plans' => $plans];
        //      }else{
        //         $result = ['status' => 'success','supp'=>'HDFCERGO','plans' => []];  
        //      }
        //       return response()->json($result);
            
        // }
        
         if($request->supp=="CARE" && $R[0]>2 && config('mediclaim.CARE.status')===true){
            $plans =[];
            
            $careplans = $this->Care->getQuickPlans($range,$request->params,$this->getToken(),$request->policytyp,$request->pln);
             if($careplans['status']=='success'){
                 foreach($careplans['plans'] as $pln){
                     array_push($plans,$pln);
                 }
                 $result = ['status' => 'success','supp'=>'CARE','plans' => $plans];
             }else{
                 $result = ['status' => 'success','supp'=>'CARE','plans' => []];  
             }
              return response()->json($result);
        }
        
         if($range['start']>=4){
          if($request->supp=="MANIPAL_CIGNA" && config('mediclaim.MANIPAL.status')===true){
              $plans =[];
             $ManipalCignaPlans = $this->Manipal->getQuickPlans($range,$request->params,$this->getToken(),$request->policytyp);
             if($ManipalCignaPlans['status']=='success'){ 
                 foreach($ManipalCignaPlans['plans'] as $pln){
                  array_push($plans,$pln);
                }
                $result = ['status' => 'success','supp'=>'MANIPAL_CIGNA','plans' => $plans];
             }else{
                $result = ['status' => 'success','supp'=>'MANIPAL_CIGNA','plans' => []];  
             }
              return response()->json($result);
          }
         }
         
         if($request->supp=="DIGIT" && config('mediclaim.DIGIT.status')===true){
              $plans =[];
             $DigitPlans = $this->DigitHealth->getQuickPlans($range,$request->params,$this->getToken(),$request->pln,$request->policytyp);
             if($DigitPlans['status']=='success'){ 
                  foreach($DigitPlans['plans'] as $pln){
                      array_push($plans,$pln);
                    }
                $result = ['status' => 'success','supp'=>'DIGIT','plans' => $plans];
             }else{
                $result = ['status' => 'success','supp'=>'DIGIT','plans' => []]; 
             }
             return response()->json($result);
         }
         
    }
    
    public function createEnquiry(Request $request){
             
   
       
        $sup = DB::table('our_partners')->where('shortName',$request->provider)->first();
        if(isset(Auth::guard('agents')->user()->id)){
                  $customerID = _createCustomer(['mobile'=>$request->carInfo['customer']['mobile']]);
                  $custMobile = $request->carInfo['customer']['mobile'];
                  $agentID = Auth::guard('agents')->user()->id;
                }else{
                  $customerID =Auth::guard('customers')->user()->id;
                  $agentID = 0;
                  $custMobile = Auth::guard('customers')->user()->mobile;
                }                                        
        $quoteData = ['type'=>'HEALTH',
                      'provider'=>$sup->shortName,
                      'device_id'=>$this->getToken(),
                      'agent_id'=>$agentID,
                      'customer_id'=>$customerID,
                      'customer_mobile'=>$custMobile,
                      'customer_name'=>$request->insurerInfo['selfName'],
                      'server'=>isset(Auth::guard('customers')->user()->id)?'USER_WEB':'AGENT_WEB',
                      'call_type'=>"ENQ",
                      
                      ];
                      
                      
        $sumInsured = str_replace(" ","",str_replace("Lakhs","",$request->insurerInfo['sumInsured']));
        $temp =   DB::table('app_temp_quote')->where('quote_id',$request->insurerInfo['plan'])->first();
        $quoteData['mandatoryAddons'] = $temp->mandatoryAddons;
        $json_data = ['cust_mobile'=>$request->customerData['mobile'],'title'=>$temp->title,'product'=>$temp->product,'code'=>$temp->code,
                      'id'=>$request->insurerInfo['plan'],'customerID'=>$request->insurerInfo['plan'],
                      'sumInsured'=>$sumInsured,'amount'=>$request->insurerInfo['amount'],'quotation'=>$request->insurerInfo['amount']];
        $json_data['zone'] ="";
        if($sup->shortName=="DIGIT"){
            $json_data['zone'] = $this->DigitHealth->getZone($request->insurerInfo['address']['pincode']);
        }else if($sup->shortName=="MANIPAL_CIGNA"){
            $json_data['zone'] = $this->Manipal->getZone($request->insurerInfo['address']['pincode']);//"ZONE1"
        }else if($sup->shortName=="HDFCERGO"){
            $json_data['zone'] = 3;
        }
        $params = $request->insurerInfo;
        $ad = "";
        if($temp->product=='CARECLASSIC'){
           $params['addOn'] =  "AHCCC1126"; 
           $ad = "AHCCC1126";
           
        }
        $quoteData['params_request']=json_encode($params);
        $quoteData['product'] =$temp->product;
        $quoteData['code'] =$temp->code;
        $quoteData['zone'] =$json_data['zone'];
        $quoteData['actualZone'] =$json_data['zone'];
        $quoteData['sumInsured'] =json_encode(['shortAmt'=>$temp->short_sumInsured,'longAmt'=>$temp->long_sumInsured]);
        $AMT[1]  = ['Base_Premium'=>$temp->premiumAmount,'Addons_Total'=>0.00,'Total_Tax'=>0.00,'Addons'=>[],'Total_Premium'=>$temp->premiumAmount];
        $quoteData['amounts']  = json_encode($AMT);
        $quoteData['title'] =$temp->title;
        $quoteData['json_data']  = json_encode($json_data);
        $quoteData['policyType']=$temp->policyType;
        
        $quoteData['reqQuote']=$temp->reqQuote;
        $quoteData['respQuote']=$temp->respQuote;
        $quoteData['reqRecalculate']=$temp->reqRecalculate;
        $quoteData['respRecalculate']=$temp->respRecalculate;
        
        $enquiryId = md5(uniqid(rand(), true));
        $quoteData['enquiry_id'] =  $enquiryId;
        $refID = DB::table('app_quote')->insertGetId($quoteData);
        if($refID){
            if($sup->shortName=="DIGIT"){
              //$this->DigitResource->updateQuickQuote($enquiryId,1,$temp->short_sumInsured,$json_data['zone'],"");
              $this->DigitHealth->recalculateQuickPlan($enquiryId,1,$temp->short_sumInsured,$json_data['zone'],"");
            }else if($sup->shortName=="CARE"){
              //$this->CareResource->updateQuickQuote($enquiryId,1,$temp->short_sumInsured,"");
              $this->Care->recalculateQuickPlan($enquiryId,1,$temp->short_sumInsured,"");
            }else if($sup->shortName=="MANIPAL_CIGNA"){
              $this->Manipal->recalculateQuickPlan($enquiryId,1,$temp->short_sumInsured,$json_data['zone'],"");
            }
            
        }
       // $this->sendMessage($request->insurerInfo['selfName'],$enquiryId);
        $result = ['status'=>'success','data'=>['enq'=>$enquiryId]];
        if($ad!=""){$result['data']['addon']=$ad;}
       return response()->json($result);
    }
    
    public function updateQuote(Request $request){
         
         $enQ = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$request->enqId)->first();
         $sUM = json_decode($enQ->sumInsured);
         //if($sUM->shortAmt==$request->sumInsured){
         if($request->action=="addon" || $request->action=="sumInsured" || $request->action=="zone"){
             if($enQ->provider=="DIGIT"){
                 //$resp =$this->DigitResource->updateQuickQuote($request->enqId,$request->termYear,$request->sumInsured,$request->zoneType,$request->addons);
                 $resp =$this->DigitHealth->recalculateQuickPlan($request->enqId,$request->termYear,$request->sumInsured,$request->zoneType,$request->addons);
             }else if($enQ->provider=="CARE"){
                 //$resp = $this->CareResource->updateQuickQuote($request->enqId,$request->termYear,$request->sumInsured,$request->addons);
                 $resp = $this->Care->recalculateQuickPlan($request->enqId,$request->termYear,$request->sumInsured,$request->addons);
             }else if($enQ->provider=="MANIPAL_CIGNA"){
                 $resp = $this->Manipal->recalculateQuickPlan($request->enqId,$request->termYear,$request->sumInsured,$request->zoneType,$request->addons);
             }
             $enq = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$request->enqId)->first();
             $sum = json_decode($enq->sumInsured);
             $word = ($sum->shortAmt<=1)?'Lakh':'Lakhs';
             $result=["partner"=>$enq->code,'SI'=>$sum->shortAmt,'enq'=>$request->enqId,'amt'=>json_decode($enq->amounts),'extParam'=>$enq->mandatoryAddons,'termYear'=>$enq->termYear,'sumInsured'=>$sum->shortAmt." ".$word,'title'=>$enq->title];
             return response()->json(['status'=>true,'data'=>$result]);
          
         }else{
            $_amts = json_decode($enQ->amounts);
             $word = ($sUM->shortAmt<=1)?'Lakh':'Lakhs';
             $termYear = $request->termYear;
             $Q['termYear']=$request->termYear;
             
             $Q['premiumAmount']=number_format((float)$_amts->$termYear->Total_Premium, 2, '.', '');
             $Q['json_data->quotation']=number_format((float)$_amts->$termYear->Total_Premium, 2, '.', '');
             $Q['json_data->amount']=number_format((float)$_amts->$termYear->Total_Premium, 2, '.', '');
             DB::table('app_quote')->where('enquiry_id', $request->enqId)->update($Q);
             $result=["partner"=>$enQ->code,'SI'=>$sUM->shortAmt,'enq'=>$request->enqId,'amt'=>json_decode($enQ->amounts),'extParam'=>$enQ->mandatoryAddons,'termYear'=>$request->termYear,'sumInsured'=>$sUM->shortAmt." ".$word,'title'=>$enQ->title];
             return response()->json(['status'=>true,'data'=>$result]);
         }
          
    }
    
    public function productDetails(Request $request){
         $enquiryID = $request->enquiryID;
         $count = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->count();
         
         if($count){
              $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
              $params = json_decode($data->params_request);
              $jd = json_decode($data->json_data);
              $params->selfMobile = isset($params->selfMobile)?$params->selfMobile:$jd->cust_mobile;
            //   $supp = DB::table('suppliers')
            //          ->select('suppliers.name as supp_name','suppliers.short as sp','suppliers.logo as supp_logo')
            //          ->where('suppliers.id','=',$params->supplier)->first();
              $supp = DB::table('our_partners')->where('shortName','=',$data->provider)->first();
              $planInfo = new \stdClass(); 
              $planInfo->supp_logo = asset('assets/partners/'.$supp->logo_image);
              $planInfo->sp = $supp->shortName;
              $planInfo->supp_name = $supp->name;
              $planInfo->sumInsured = str_replace("Lakhs","",$jd->sumInsured);
              $planInfo->amount = $jd->amount;
              $planInfo->zone = $jd->zone;
              
                  $plan_val ="";
                 if($data->provider=='CARE'){
                     if($data->product=='CAREWITHNCB'){
                         $plan_val = 'CARE-NCB_SUPER';
                     }else if($data->product=='CARESMART'){
                         $plan_val = 'CARE-SMART';
                     }else if($data->product=='CARE'){
                         $plan_val = 'CARE-CARE_HELATH';
                     }else if($data->product=='CAREFREEDOM'){
                         $plan_val = 'CARE-FREEDOM';
                     }else if($data->product=='CARECLASSIC'){
                         $plan_val = 'CARE-CLASSIC';
                     }else if($data->product=='CAREADVANTAGE'){
                         $plan_val = 'CARE-ADV';
                     }
                     
                 }else if($data->provider=='DIGIT'){
                     if($data->code=='DSO01'){
                         $plan_val = 'DIGIT-SILVER';
                     }else if($data->code=='DGO01'){
                         $plan_val = 'DIGIT-GOLD';
                     }else if($data->code=='DDO01'){
                         $plan_val = 'DIGIT-DIAMOND';
                     }
                     
                 }else if($data->provider=='MANIPAL_CIGNA'){
                     if($data->product=='RPRT06SBSF'){
                         $plan_val = 'MANIPAL_CIGNA-PROHEALTH_PROTECT';
                     }else if($data->product=='RPLS06SBSF'){
                         $plan_val = 'MANIPAL_CIGNA-PROHEALTH_PLUS';
                     }
                     
                 }
              $pData = DB::table('plans')->select('*')->where('plan_val','=',$plan_val)->first();
              
              
              $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Product Details",
                          'plan'=>$planInfo,'param'=>$params,'data'=>$data,'pData'=>$pData,
                          'scripts'=>[asset('js/health/health_product-details.js?v=0.4')]];  
            
             return View::make('health.health_product_details')->with($template);
         }
     }
     
    public function productInfo(Request $request){
             $enquiryID = $request->enquiryID;
             $enQ = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
             $plan_val ="";
             if($enQ->provider=='CARE'){
                 if($enQ->product=='CAREWITHNCB'){
                     $plan_val = 'CARE-NCB_SUPER';
                 }else if($enQ->product=='CARESMART'){
                     $plan_val = 'CARE-SMART_NCB_SUPER';
                 }else if($enQ->product=='CARE'){
                     $plan_val = 'CARE-CARE_HELATH';
                 }
                 
             }else if($enQ->provider=='DIGIT'){
                 if($enQ->code=='DSO01'){
                     $plan_val = 'DIGIT-SILVER';
                 }else if($enQ->code=='DGO01'){
                     $plan_val = 'DIGIT-GOLD';
                 }else if($enQ->code=='DDO01'){
                     $plan_val = 'DIGIT-DIAMOND';
                 }
                 
             }else if($enQ->provider=='MANIPAL_CIGNA'){
                     if($enQ->product=='RPRT04SBSF'){
                         $plan_val = 'MANIPAL_CIGNA-PROHEALTH_PROTECT';
                     }else if($enQ->product=='RPLS04SBSF'){
                         $plan_val = 'MANIPAL_CIGNA-PROHEALTH_PLUS';
                     }
                     
                 }
            //  $supp = DB::table('suppliers')
            //          ->select('suppliers.name as supp_name','suppliers.short as sp','suppliers.logo as supp_logo')
            //          ->where('suppliers.short','=',$enQ->provider)->first();
             $supp = DB::table('our_partners')->where('shortName','=',$enQ->provider)->first();
              $planInfo = new \stdClass(); 
              $planInfo->supp_logo = asset('assets/partners/'.$supp->logo_image);
              $planInfo->sp = $supp->shortName;
              $planInfo->supp_name = $supp->name;
              $data = DB::table('plans')->select('*')->where('plan_val','=',$plan_val)->first();
              $features = DB::table('plans_features')->select('*')->where('plan_id','=',$data->id)->get();
              $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Product Details",'features'=>$features,'data'=>$data,
                          'enquiryID'=>$enquiryID,'plan'=>$planInfo,'enQ'=>$enQ,
                          'scripts'=>[asset('js/health/health_product-details.js?v=0.4')]];  
            
             return View::make('health.health_product_info')->with($template);
         
     }
    
    function proposalDetails(Request $request){
        
         $enquiryID = $request->enquiryID;
         $count = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->count();
         
         if($count){
              
              $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
              
              $relations =   DB::table('relations')->get();
              $params = json_decode($data->params_request);
              $jd = json_decode($data->json_data);
              $params->selfMobile = isset($params->selfMobile)?$params->selfMobile:$jd->cust_mobile;
            //   $supp = DB::table('suppliers')
            //          ->select('suppliers.name as supp_name','suppliers.short as sp','suppliers.logo as supp_logo')
            //          ->where('suppliers.id','=',$params->supplier)->first();
              $supp = DB::table('our_partners')->where('shortName','=',$data->provider)->first();
              $planInfo = new \stdClass(); 
              $planInfo->supp_logo = asset('assets/partners/'.$supp->logo_image);
              $planInfo->sp = $supp->shortName;
              $planInfo->supp_name = $supp->name;
              $planInfo->sumInsured = str_replace("Lakhs","",$jd->sumInsured);
              $planInfo->amount = $jd->amount;
              $planInfo->zone = $jd->zone;
              
              $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Proposal","relations"=>$relations,'plan'=>$planInfo,'param'=>$params,'data'=>$data,'scripts'=>[asset('js/health/health_proposal.js')]];  
            
             return View::make('health.health_proposal')->with($template);
         }
    }
    
    function proposerInfoTemplate(Request $request){
         $enquiryID = $request->enquiryID;
         $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         $template['param'] = json_decode($data->params_request);
          $template['relations'] = DB::table('relations')->get();
         return View::make('health.info.proposer')->with($template);
    }
    
    function insurerInfoTemplate(Request $request){ 
         $enquiryID = $request->enquiryID;
         $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         
         //$template['realtions'] = DB::table('realtions')->select('*')->get();
         $template['param'] = json_decode($data->params_request);
         $template['relations'] = DB::table('relations')->get();
         return View::make('health.info.insurer')->with($template);
    }
    
    function addressInfoTemplate(Request $request){ 
         $enquiryID = $request->enquiryID;
         $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         $states = DB::table('states')->get();
         $param = json_decode($data->params_request);
         $state = explode("-",$param->state);
         $cities = DB::table('cities')->where('state_id','=',$state[0])->get();
         $template['param'] = $param; 
         $template['cities'] = $cities;
         $template['states'] = $states;
         return View::make('health.info.address')->with($template);
    }
    
    function medicalInfoTemplate(Request $request){ 
         $enquiryID = $request->enquiryID;
         $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         $param = json_decode($data->params_request);
         $supp = $data->provider;//$param->supplier;
         if($data->provider=="CARE"){
              $whr = ($data->product=="CAREFREEDOM")?['status'=>1,'supplier'=>$supp,'productTyp'=>'CARE_FREEDOM']:['status'=>1,'supplier'=>$supp,'productTyp'=>'OTHER'];
          }else{
             $whr = ['status'=>1,'supplier'=>$supp];
         }
        
         $template['questions'] =  DB::table('medical_questions')->where($whr)->where('parentId',0)->get();
         $template['param'] = $param;
         $template['info'] = $data;
         return View::make('health.info.medical')->with($template);
    }
    
    function reviewInfoTemplate(Request $request){
         $enquiryID = $request->enquiryID;
         $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         $template['questions'] = DB::table('medical_questions')->where('status',1)->where('parentId',0)->get();
         $template['param'] = json_decode($data->params_request);
         $template['info'] = $data;
         return View::make('health.info.review')->with($template);
    }
    
    private function updateProposerInfo($param,$enquiryID){
                    $arr = ["params_request->selfDob"=>$param['selfDob'],
                            "params_request->selfdd"      =>$param['selfdd'],
                            "params_request->selfmm"      =>$param['selfmm'],
                            "params_request->selfyy"      =>$param['selfyy'],
                            "params_request->selfFeet"    =>$param['selfFeet'],
                            "params_request->selfInch"    =>$param['selfInch'],
                            "params_request->selfName"    =>$param['selfName'],
                            "params_request->selfEmail"   =>$param['selfEmail'],
                            "params_request->selfFname"   =>$param['selfFname'],
                            "params_request->selfLname"   =>$param['selfLname'],
                            "params_request->selfHeight"  =>$param['selfFeet']."-".$param['selfInch'],
                            "params_request->selfMobile"  =>$param['selfMobile'],
                            "params_request->selfWeight"  =>$param['selfWeight'],
                            "params_request->selfMstatus" =>$param['selfMstatus'],
                            "params_request->nomineename" => $param['nomineename'],
                            "params_request->nomineerelation"  =>$param['nomineerelation'],
                            "params_request->nomineedd" => $param['nomineedd'],
                            "params_request->nomineemm" => $param['nomineemm'],
                            "params_request->nomineeyy" => $param['nomineeyy']
                            ];
             DB::table('app_quote')->where('enquiry_id', $enquiryID)->update($arr);
    }
    
    private function updateInsurerInfo($param,$enquiryID){
        //$arr = ["params_request->members"=>$param['selfDob'],
         $Querydata = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         $dataParam = json_decode($Querydata->params_request);
         $members = [];
         foreach($param['members'] as $key=>$each){ 
             $each['mkey'] = $key;
             array_push($members,$each);
         }
         //print_r($members);
         $dataParam->members = $members;
         DB::table('app_quote')->where('enquiry_id', $enquiryID)->update(['params_request'=>json_encode($dataParam)]);
    }
    
    private function updateAddressInfo($param,$enquiryID){
                    $arr = ["params_request->address->house_no" =>$param['address']['house_no'],
                            "params_request->address->street"   =>$param['address']['street'],
                            "params_request->address->pincode"  =>$param['address']['pincode'],
                            "params_request->address->state"    =>$param['address']['state'],
                            "params_request->address->city"     =>$param['address']['city'],
                            
                            "params_request->document->documentType"  =>$param['document']['documentType'],
                            "params_request->document->documentId"    =>$param['document']['documentId'],
                            "params_request->document->documentdd"    =>$param['document']['documentdd'],
                            "params_request->document->documentmm"    =>$param['document']['documentmm'],
                            "params_request->document->documentyy"    =>$param['document']['documentyy'],
                            
                          ];
             DB::table('app_quote')->where('enquiry_id', $enquiryID)->update($arr);
    }
    
    private function updateMedicalInfo($param,$enquiryID){
         $Querydata = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         $dataParam = json_decode($Querydata->params_request);
        
        $members = [];
         foreach($param['members'] as $key=>$each){ 
             $each['mkey'] = $key;
             array_push($members,$each);
         }
        
         $dataParam->members = $members;
         $dataParam->hasMedical = $param['hasMedical'];
         $medical = isset($param['medical'])?$param['medical']:[];
         $dataParam->medical = $medical;
         
        DB::table('app_quote')->where('enquiry_id', $enquiryID)->update(['params_request'=>json_encode($dataParam)]);
    }
    
    function updateProposal(Request $request){
        if($request->enqId!=""){
            $count = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$request->enqId)->count();
            if($count){
                DB::table('leads')->where(['id'=>$request->customerData['lead_id']])->update(['param'=>json_encode($request->param)]);
                $arr =[];
                if($request->step=="proposer"){
                   $arr= $this->updateProposerInfo($request->param,$request->enqId);
                }else if($request->step=="insurer"){
                   $arr= $this->updateInsurerInfo($request->param,$request->enqId);
                }else if($request->step=="address"){
                   $arr= $this->updateAddressInfo($request->param,$request->enqId);
                }else if($request->step=="medical"){
                   $arr= $this->updateMedicalInfo($request->param,$request->enqId);
                }
                return response()->json(['status'=>'success','message'=>'Inforamtion updated successfully']);
                
            }else{
                return response()->json(['status'=>'error','message'=>'Something went wrong']);
            }
        }else{
             return response()->json(['status'=>'error','message'=>'Something went wrong']);
        }
    }
    
    public function createPremium(Request $request){ 
        $enqData = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$request->enq)->first();
        $params = json_decode($enqData->params_request); 
       if($enqData->provider=="CARE"){
            $resp = $this->Care->createProposal($request->enq);
       }else if($enqData->provider=="MANIPAL_CIGNA"){
            $resp = $this->Manipal->generateApplicationNumber($request->enq);
       }else if($enqData->provider=="DIGIT"){
            $resp = $this->DigitHealth->createProposal($request->enq);
       }else if($enqData->provider=="HDFCERGO"){
          //  $resp = $this->HdfcErgoResource->createPolicy($request->enq);
       }
     return response()->json($resp);
    }
    
    function Generatehash256($message) {
         $hash = hash('sha256', mb_convert_encoding($message, 'UTF-8'), true);
        return $this->hexToStr($hash);
    }
    
    function hexToStr($string){
                $hex="";
                for ($i=0; $i < strlen($string); $i++) {
                    if (ord($string[$i])<16)
                    $hex .= "0";
                    $hex .= dechex(ord($string[$i]));
                }
        return ($hex);
    }
    
    function proposalDeclaration(Request $request){
         $enquiryID = $request->enquiryID;
         $count = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->count();
         if($count){
             
             $result = $this->getPaymentFormInfo($enquiryID);
             $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Declaration",'jd'=>$result['jd'],'pageData'=>$result['pageData'],'includePage'=>$result['includePage'],'plan'=>$result['plan'],'param'=>$result['param'],'data'=>$result['data'],'scripts'=>[asset('js/health/health_declaration.js')]];  
             $encrypted = Crypt::encryptString($enquiryID);
             $template['url'] = url('health/health-insurance/policy/payments/'.$enquiryID."?utm_target=".$encrypted);
             return View::make('health.health_declaration')->with($template);
             //return View::make('health.declarationPages.hdfcErgo')->with($template);
         }
    }
    
    // public function updatePremiumInfo(Request $request){
    //      $arr = ["params_request->addOn" =>$request->addons ];
    //      DB::table('app_quote')->where('enquiry_id', $request->enqId)->update($arr);
    //      $enqData = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$request->enqId)->first();
    //      $jd = json_decode($enqData->json_data);
         
         
    //      if($enqData->provider=="RELIGARE"){
             
    //           if($enqData->product=='CAREADVANTAGE'){
    //               $resp = $this->CareResource->createPremiumCareAdv($request->enqId);
    //                 if($resp['status']=='success'){
    //                     $result = ['status'=>'success','message'=>'Policy inforamtion updated successfully','data'=>$resp['data']]; 
    //                 }else{
    //                     $result = ['status'=>'error','message'=>$resp['message'],'data'=>['amount'=>$jd->amount]]; 
    //                 }
    //           }else{
    //              $resp = $this->CareResource->createPremiumReligare($request->enqId);
    //                 if($resp['status']=='success'){
    //                     $result = ['status'=>'success','message'=>'Policy inforamtion updated successfully','data'=>$resp['data']]; 
    //                 }else{
    //                     $result = ['status'=>'error','message'=>$resp['message'],'data'=>['amount'=>$jd->amount]]; 
    //                 }
    //           }
            
    //      }else{
    //       $result = ['status'=>'error','message'=>'Unknown provider.','data'=>['amount'=>$jd->amount]]; 
    //      }
    //      return response()->json($result); 
    // }
    
    function getPaymentFormInfo($enquiryID){
            $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
            $params = json_decode($data->params_request);
            $jd = json_decode($data->json_data);
            $planInfo = new \stdClass(); 
            $pageData = new \stdClass(); 
            $planInfo->supp_logo = "";
            $planInfo->supp_name = "";
            $planInfo->premium_amount = "";
            $planInfo->amount = "";
            
            $termYear = $data->termYear;
            $_amts = json_decode($data->amounts);
            //$quoteId = $_amts->$termYear->quoteId; // for manipal cigna only
            $quoteAmt = $_amts->$termYear->Total_Premium;
             if($data->provider=="CARE"){
            
                    //  $plan = DB::table('suppliers')
                    //  ->select('suppliers.name as supp_name','suppliers.short as sp','suppliers.logo as supp_logo')
                    //  ->where('suppliers.id','=',$params->supplier)->first();
                      $plan = DB::table('our_partners')->where('shortName','=',$data->provider)->first();
                      $planInfo = new \stdClass(); 
                      $planInfo->supp_logo = asset('assets/partners/'.$plan->logo_image);
                      $planInfo->sp = $plan->shortName;
                      $planInfo->supp_name = $plan->name;
                  
                      $planInfo->sumInsured =  str_replace("Lakhs","",$jd->sumInsured);//$jd->intPolicyDataIO->policy->sumInsuredValue;
                      $planInfo->amount = $quoteAmt;
                      $include = 'health.declarationPages.religare';
                      $pageData->formAction = config('mediclaim.CARE.payment_url');//"https://apiuat.religarehealthinsurance.com/portalui/PortalPayment.run";
                      //$pageData->formAction ="https://api.religarehealthinsurance.com/portalui/PortalPayment.run";
                                              
                      $pageData->returnURL = url("/health-insurance/insured-success/".$enquiryID);
                      
             }else if($data->provider=="MANIPAL_CIGNA"){
                 
                  $plan = DB::table('our_partners')->where('shortName','=',$data->provider)->first();
                      $planInfo = new \stdClass(); 
                      $planInfo->supp_logo = asset('assets/partners/'.$plan->logo_image);
                      $planInfo->sp = $plan->shortName;
                      $planInfo->supp_name = $plan->name;
                      $planInfo->sumInsured = $jd->sumInsured;
                      $planInfo->amount = $quoteAmt;
                  $include = 'health.declarationPages.manipalCigna';
                  $pageData->formAction = config('mediclaim.MANIPAL.payment_url');//"https://test.payu.in/_payment";
                  $formData = new \stdClass(); 
                  
                  $txid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                  $amt = $quoteAmt;//$params->amount;
                  $productInfo = "Manipal cigna health insurance from SuperFinserv";
                  $formData->key = "2M6Fzv";
                  $formData->txnid = $txid;
                  $formData->amount = $amt;
                  $formData->productinfo = "Manipal cigna health insurance from SuperFinserv";
                  $formData->firstname = $params->selfFname;
                  $formData->lastname = "";
                  $formData->email = $params->selfEmail;
                  $formData->phone = $params->selfMobile;
                  $formData->address1 = $params->address->house_no;
                  $formData->address2 = $params->address->street;
                  $formData->city = explode('-',$params->address->city)[1];
                  $formData->state = explode('-',$params->address->state)[1];
                  $formData->country = "India";
                  $formData->zipcode =$params->address->pincode;
                  $formData->udf1 = "";
                  $formData->udf2 = "";
                  $formData->udf3 = "";
                  $formData->udf4 = $jd->applicationID;
                  $formData->udf5 = "141806";
                  $formData->surl = url("/health-insurance/insured-success/".$enquiryID);
                  $formData->furl = url("/insurance/policy/cancel/".$enquiryID);
                  $hashSequence = "2M6Fzv|".$txid."|".$amt."|".$productInfo."|".$params->selfFname."|".$params->selfEmail."||||".$jd->applicationID."|141806||||||wUTyMOKS";
                 // $str = "2M6Fzv|".$txid."|".$amt."||Praveen|p@gmail.com||||PROHLR010288924|141806||||||wUTyMOKS";
                  $hashed = hash("sha512", $hashSequence);
                  $formData->hash = $hashed ;
                  $pageData->formData = $formData;
                 
             }else if($data->provider=="FGI"){
                 $plan = DB::table('our_partners')->where('shortName','=',$data->provider)->first();
                      $planInfo = new \stdClass(); 
                      $planInfo->supp_logo = asset('assets/partners/'.$plan->logo_image);
                      $planInfo->sp = $plan->shortName;
                      $planInfo->supp_name = $plan->name;
                      $planInfo->sumInsured = $jd->sumInsured;
                    
                      $planInfo->amount = $jd->amount;
                  $include = 'health.declarationPages.futureGenerali';
                  $pageData->formAction = "http://fglpg001.futuregenerali.in/Ecom_NL/WEBAPPLN/UI/Common/WebAggPay.aspx";//"http://fglpg001.futuregenerali.in/Ecom_NL/WEBAPPLN/UI/Common/WebAggPayNew.aspx";
                  $formData = new \stdClass(); 
                  
                  $txid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                  $amt = $params->amount;
                  $productInfo = "Future Genrali health insurance from supersolutions";
                  $returnURL = config('custom.site_url')."/health-insurance/insured-success/".$enquiryID;
                  $formData->TransactionID = $jd->TransactionID;
                  $formData->PaymentOption = 3; //1 [PayTm] OR 2 [HDFC] OR 3 [Pay U]
                  $formData->ResponseURL =$returnURL;
                  $formData->ProposalNumber = $jd->proposalNum;
                  $formData->PremiumAmount =  $jd->amount;
                  $formData->UserIdentifier = "NA";//$params->selfFname.$params->selfMobile;
                  $formData->UserId = "NA";//$params->selfMobile;
                  $formData->FirstName = $params->selfFname;
                  $formData->LastName = $params->selfLname;
                  $formData->Mobile = $params->selfMobile;
                  $formData->Email = $params->selfEmail;
                  //"TransactionID|PaymentOption|ResponseURL|ProposalNumber|PremiumAmount|UserIdentifier|UserId|FirstName|LastName|Mobile|Email|"
                  $hashSequence = $jd->TransactionID."|3|".$returnURL."|".$jd->proposalNum."|".$jd->amount."|NA|NA|".$params->selfFname."|".$params->selfLname."|".$params->selfMobile."|".$params->selfEmail."|";
                  $hash = $this->Generatehash256($hashSequence);
                  $formData->CheckSum = $hash;
                  $formData->Vendor = 1; //Blank[.Net] or 0[.Net] or 1[PHP]
                  $pageData->formData = $formData;
                 
             }else if($data->provider=="DIGIT"){
               $plan = DB::table('our_partners')->where('shortName','=',$data->provider)->first();
                      $planInfo = new \stdClass(); 
                      $planInfo->supp_logo = asset('assets/partners/'.$plan->logo_image);
                      $planInfo->sp = $plan->shortName;
                      $planInfo->supp_name = $plan->name;
                  $planInfo->sumInsured =  str_replace("Lakhs","",$jd->sumInsured);//$jd->intPolicyDataIO->policy->sumInsuredValue;
                  $planInfo->amount = $jd->amount;
                  $include = 'health.declarationPages.digitHealth';
                  $pageData->formAction =$jd->paymentLink;
                  $pageData->returnURL = config('custom.site_url')."/health-insurance/insured-success/".$enquiryID;
                 
             }else if($data->provider=='HDFCERGO'){
                 
                      $plan = DB::table('our_partners')->where('shortName','=',$data->provider)->first();
                      $planInfo = new \stdClass(); 
                      $planInfo->supp_logo = asset('assets/partners/'.$plan->logo_image);
                      $planInfo->sp = $plan->shortName;
                      $planInfo->supp_name = $plan->name;
                      $planInfo->sumInsured = $jd->sumInsured;
                      $planInfo->amount = $jd->amount;
                  $include = 'health.declarationPages.hdfcErgo';
                  $pageData->formAction = "http://202.191.196.210/UAT/OnlineProducts/HealthSurakshaOnline/tim.aspx";
                  $formData = new \stdClass(); 
                  
                  $txid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                  $amt = $params->amount;
                  $productInfo = "HDFC ERGO health insurance from supersolutions";
                  $returnURL = config('custom.site_url')."/health-insurance/insured-success/".$enquiryID;
                  $formData->CustomerId = $data->proposalNumber;
                  $formData->TxnAmount = $jd->amount; 
                  $formData->AdditionalInfo1 ='NB';
                  $formData->AdditionalInfo2 = 'HSP';
                  $formData->AdditionalInfo3 =  1;
                  $formData->hdnPayMode = "DD";//$params->selfFname.$params->selfMobile;
                  $formData->UserName = $params->selfFname." ".$params->selfLname;
                  $formData->UserMailId = $params->selfEmail;
                  $formData->ProductCd = 'HSP';
                  $formData->ProducerCd ='MHC00140';
                  $pageData->formData = $formData;
             }
             
             $result = ['pageData'=>$pageData,'includePage'=>$include,'plan'=>$planInfo,'jd'=>$jd,'param'=>$params,'data'=>$data];  
             return $result;     
    }
    
    function getPaymentForm(Request $request){
         $enquiryID = $request->enqId;
         $result = $this->getPaymentFormInfo($enquiryID);
         $template = ['jd'=>$result['jd'],'pageData'=>$result['pageData'],'includePage'=>$result['includePage'],'plan'=>$result['plan'],'param'=>$result['param'],'data'=>$result['data']];  
            
         return View::make($result['includePage'])->with($template);
    }
     
    function getPayData(Request $request){
          $enquiryID = $request->enquiryID;
          $count = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->count();
          if($count){
             $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
             $json = json_decode($data->json_data);
             if($data->provider=="RELIGARE"){
                 $result = ['status'=>'success','enquiryID'=>$enquiryID,'proposal'=>$json->proposalNum];
             }else if($data->provider=="MANIPAL_CIGNA"){
                 $result = ['status'=>'success','enquiryID'=>$enquiryID,'proposal'=>$json->applicationID];
             }else if($data->provider=='HDFCERGO_H'){
                 $result = ['status'=>'success','enquiryID'=>$enquiryID,'proposal'=>$json->customerID];
             }else{
                 $result = ['status'=>'error','enquiryID'=>"",'proposal'=>""]; 
             }
            return response()->json($result);
         }else{
             return response()->json(['status'=>'error']); 
         }
     }
     
    public function sendPaymentLink(Request $request){
       if($request->enquiryID){
           $SQL = DB::table('app_quote')->where('enquiry_id',$request->enquiryID)->where('type','HEALTH');
           //$count = DB::table('app_quote')->where('enquiry_id',$request->enquiryID)->where('type','HEALTH')->count();
            if($SQL->count()){
                      $enQ = $SQL->first();
                      if($enQ->status=="SOLD"){
                          $result  =['status'=>false,'message'=>"Policy for these enquiry already sold.",'data'=>''];
                       }else{
                          
                              $paramReQ = json_decode($enQ->params_request);
                              $jsonData = json_decode($enQ->json_data);
                              $termYear = $enQ->termYear;
                              $AllAmounts = json_decode($enQ->amounts);
                              $sumInsureds  =  json_decode($enQ->sumInsured);
                              //$termYearAmts  =  $AllAmounts->$termYear;
                             // print_r($AllAmounts->$termYear);die;
                              $_thisYearAmts =  $AllAmounts->$termYear;
                              $addons = "";
                              if(isset($_thisYearAmts->Addons)){
                                  foreach($_thisYearAmts->Addons as $adon){
                                      $addons = ($addons!="")?$addons.",".$adon->title:$adon->title;
                                  }
                              }
                              
                               
                               $partner = DB::table('our_partners')->where('shortName',$enQ->provider)->first();
                               
                               $encrypted = Crypt::encryptString($enQ->id);
                               $data['url'] = url('health/'.strtolower($enQ->type)."-insurance/policy/payments/".$request->enquiryID."?utm_target=".$encrypted);
                               $data['enQ'] = $enQ;
                               $data['SI'] = setMoneyFormat($sumInsureds->longAmt);
                               $data['title'] = $enQ->title;
                               $data['partnerName'] = $partner->name;
                               $data['PlanName'] = $enQ->title;
                               $data['params'] = $paramReQ;
                               $data['addons'] = !empty($addons)?$addons:"NA";
                               $data['partnerLogo'] = asset('assets/partners/'.$partner->logo_image);
                               $data['bannerImage'] = asset('site_assets/health-email-banner.png');
                               $data['sfLogo'] = asset('site_assets/logo/'.config('custom.site_logo'));
                               $data['amount'] =  isset($enQ->premiumAmount)?setMoneyFormat($enQ->premiumAmount):null;
                               $data['vehicleInfo'] = "";//$paramReQ->vehicle->brand->name." ".$paramReQ->vehicle->model->name." ".$paramReQ->vehicle->varient->name."-".$paramReQ->vehicle->fueltype."(".$paramReQ->vehicle->cc.")";
                               $data['customerName'] = $paramReQ->selfFname;
                               $custname = $paramReQ->selfFname." ".$paramReQ->selfLname;
                               $custemail=$paramReQ->selfEmail;
                               $subject = "Payment link for your ". $enQ->title;
                                Mail::send('insurance.email-template.health-payment-link', $data, function($message) use ($custname, $custemail,$subject) {
                                  $message->to($custemail, $custname)
                                  ->subject($subject);
                                 $message->from('care@superfinserv.com',config('custom.site_short_name'));
                                });
                           return response()->json(['status'=>true,'message'=>'Payment link has been sent to `'.$custemail.'`']);
                    }
            }else{
                return response()->json(['status'=>false,'message'=>"Invalid Enquiry Found. Kindly contact to SuperFinserv's Relationship Manager"]);
                 
            }
       }else{
           return response()->json(['status'=>false,'message'=>'Something went wrong']);
       }
   }
  
    public function paymentLinkPage(Request $request){
              
         $enQId = $request->enQId;
         $template = ['title' => 'Health Insurance',"subtitle"=>"Payment Link",'scripts'=>[asset('js/health/health-pay.js')]]; 
         $template['info'] =   DB::table('app_quote')->where('enquiry_id',$enQId)->first();
         $template['partner']  = DB::table('our_partners')->where('shortName',$template['info']->provider)->first();
         $result = $this->getPaymentFormInfo($enQId);
         $template['jd']=$result['jd'];
         $template['pageData']=$result['pageData'];
         $template['includePage']=$result['includePage'];
         $template['plan']=$result['plan'];
         $template['param']=$result['param'];
         $template['data']=$result['data'];  
            
         return View::make('health.payment-link-page')->with($template);
        
    }
    
     
    
     
 

}

