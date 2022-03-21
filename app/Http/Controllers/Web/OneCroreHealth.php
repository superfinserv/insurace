<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Nathanmac\Utilities\Parser\Parser;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
//use App\Resources\ManipalResource;
use App\Resources\ReligareOneCrResource;
// use App\Resources\FgiResource;
use App\Resources\DigitOneCrResource;


class OneCroreHealth extends Controller{
   public function __construct(ReligareOneCrResource $ReligareResource ,DigitOneCrResource $DigitResource) { 
       $this->ReligareOneCrResource = $ReligareResource;
       $this->DigitOneCrResource = $DigitResource;
   }
   
    
    public function index(){
        $template = ['title' => 'Health-Insurance',"subtitle"=>"Health-Insurance"];  
        return View::make('oneCroreHealth.health_insurance')->with($template);
    }
     public function health_insurance_detail(){
        $template = ['title' => 'Health-Insurance',"subtitle"=>"Health-Insurance"];  
        return View::make('oneCroreHealth.health_insurance_detail')->with($template);
    }

     public function healthProfile(){
        $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Profile",'scripts'=>[asset('page_js/oneCroreHealth/health_profile.js')]];  
         return View::make('oneCroreHealth.health_profile')->with($template);
    }
    
    public function healthProfileMembers(){
        $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Profile Members",'scripts'=>[asset('page_js/oneCroreHealth/health_profile_members.js')]];  
         return View::make('oneCroreHealth.health_profile_members')->with($template);
    }
    
    public function healthProfileMembersAge(){
        $states = DB::table('states_list')->get();
        $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Profile Members",'states'=>$states,'scripts'=>[asset('page_js/oneCroreHealth/health_members_age.js')]];  
         return View::make('oneCroreHealth.health_profile_members_age')->with($template);
    }
    
    public function healthPlans(){
        $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Plans",'scripts'=>[asset('page_js/oneCroreHealth/health_plans.js')]];  
        return View::make('oneCroreHealth.health_plans')->with($template);
        
    }
    
  
  
    public function getHealthPlans(Request $request){
        
        $R = explode("-",$request->range);
        $range['start'] = 75;
        $range['end']   = 100;
        
        if($request->supp=="RELIGARE"){
            $plans =[];
             $ReligarePlans = $this->ReligareOneCrResource->getQuickPlans($range,$request->params,$request->deviceToken,$request->policytyp);
             if($ReligarePlans['status']=='success'){
                 foreach($ReligarePlans['plans'] as $pln){
                     array_push($plans,$pln);
                 }
                 $result = ['status' => 'success','supp'=>'RELIGARE','plans' => $plans];
             }else{
                $result = ['status' => 'success','supp'=>'RELIGARE','plans' => []];  
             }
              return response()->json($result);
        }
        
         if($request->supp=="DIGIT"){
              $plans =[];
             $DigitPlans = $this->DigitOneCrResource->getQuickPlans($range,$request->params,$request->deviceToken,$request->pln,$request->policytyp);
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
        $sup = DB::table('suppliers')->where('id','=',$request->provider)->first();
        $hasEnq = DB::table('app_quote')->where(['server'=>'USER_WEB','type'=>'HEALTH','device_id'=>$request->deviceToken,'agent_id'=>$request->customerData['customer_id']])->count();
        $quoteData = ['type'=>'HEALTH',
                      'provider'=>$sup->short,
                      'device_id'=>$request->deviceToken,
                      'agent_id'=>0,
                      'customer_id'=>$request->customerData['customer_id'],
                      'customer_mobile'=>$request->customerData['mobile'],
                      'server'=>'USER_WEB',
                      'call_type'=>"ENQ",
                      'params_request'=>json_encode($request->insurerInfo)];
        $sumInsured = str_replace(" ","",str_replace("Lakhs","",$request->insurerInfo['sumInsured']));
        $temp =   DB::table('app_temp_quote')->where('quote_id',$request->insurerInfo['plan'])->first();
        
        $json_data = ['cust_mobile'=>$request->customerData['mobile'],'title'=>$temp->title,'product'=>$temp->product,'code'=>$temp->code,'id'=>$request->insurerInfo['plan'],
                                              'sumInsured'=>$sumInsured,'amount'=>$request->insurerInfo['amount'],'quotation'=>$request->insurerInfo['amount']];
        if($sup->short=="DIGIT_H"){
            $json_data['zone'] = $this->DigitOneCrResource->getZone($request->insurerInfo['address']['pincode']);
        }else if($sup->short=="MANIPAL_CIGNA"){
            $json_data['zone'] = $this->ManipalResource->getZone($request->insurerInfo['address']['pincode']);
        }else{
            $json_data['zone'] ="";
        } 
        $quoteData['json_data']  = json_encode($json_data);
        $quoteData['policyType']=$temp->policyType;
        // if($hasEnq){
        //   $Enq = DB::table('app_quote')->where(['server'=>'USER_WEB','type'=>'HEALTH','device_id'=>$request->deviceToken,'customer_id'=>$request->customerData['customer_id']])->first();
        //   $enquiryId = $Enq->enquiry_id;
        //   $refID = DB::table('app_quote')->where(['enquiry_id'=>$enquiryId])->update($quoteData);
        // }else{
           $enquiryId = md5(uniqid(rand(), true));
           $quoteData['enquiry_id'] =  $enquiryId;
           $refID = DB::table('app_quote')->insertGetId($quoteData);
       // } 
      //  DB::table('leads')->where(['id'=>$request->customerData['lead_id']])->update(['type'=>'HEALTH','enquiry_id'=>$enquiryId,'provider'=>$sup->short,'param'=>json_encode($request->insurerInfo)]);
        return response()->json(['status'=>'success','data'=>['enq'=>$enquiryId]]);
    }
    
    public function updateZoneQuickQuote(Request $request){
         $enquiryID = $request->enq;
         $zone = $request->zone;
         $count = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->count();
         if($count){
            $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
           // print_r($data);
           if($data->provider=="MANIPAL_CIGNA"){
             $plan = $this->ManipalResource->getUpdatedPlan($data,$zone);
             if($plan['status']=='success'){
                 $params = json_decode($data->params_request);
                 $jd = json_decode($data->json_data);
                 $pdata = $plan['data'];
                 $tempId = $pdata['id'];
                 $temp =   DB::table('app_temp_quote')->where('quote_id',$tempId)->first();
                 $json_data  = json_encode(['zone'=>$zone,'cust_mobile'=>$jd->cust_mobile,'title'=>$temp->title,'product'=>$temp->product,'code'=>$temp->code,
                                            'id'=>$pdata['id'],'sumInsured' => $pdata['sumInsured'],'amount'=>$pdata['amount'],'quotation'=>$pdata['amount']]);
                 $QuoteArr = ["params_request->plan"=>$pdata['id'],'params_request->amount'=>$pdata['amount'],'json_data'=>($json_data)];
                 DB::table('app_quote')->where('enquiry_id', $enquiryID)->update($QuoteArr);
                 $result = ['status'=>"success",'data'=>['amount'=>$pdata['amount']]];
             }else{
                 $result = ['status'=>"error","message"=>"Unable to update zone",'data'=>[]];
             }
            
          }else  if($data->provider=="DIGIT_H"){
             $plan = $this->DigitResource->getUpdatedPlan($data,$zone);
             if($plan['status']=='success'){
                 $params = json_decode($data->params_request);
                 $jd = json_decode($data->json_data);
                 $pdata = $plan['data'];
                 $tempId = $pdata['id'];
                 $temp =   DB::table('app_temp_quote')->where('quote_id',$tempId)->first();
                 $json_data  = json_encode(['zone'=>$zone,'cust_mobile'=>$jd->cust_mobile,'title'=>$temp->title,'product'=>$temp->product,'code'=>$temp->code,
                                            'id'=>$pdata['id'],'sumInsured' => $pdata['sumInsured'],'amount'=>$pdata['amount'],'quotation'=>$pdata['amount']]);
                 $QuoteArr = ["params_request->plan"=>$pdata['id'],'params_request->amount'=>$pdata['amount'],'json_data'=>($json_data)];
                 DB::table('app_quote')->where('enquiry_id', $enquiryID)->update($QuoteArr);
                 $result = ['status'=>"success",'data'=>['amount'=>$pdata['amount']]];
             }else{
                 $result = ['status'=>"error","message"=>"Unable to update zone",'data'=>[]];
             }
          }else{
               $result = ['status'=>"error","message"=>"Unable to update zone",'data'=>[]];
          }
          
        }else{
             $result = ['status'=>"error","message"=>"Unable to update zone",'data'=>[]];
        }
        return response()->json($result);
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
              $supp = DB::table('suppliers')
                     ->select('suppliers.name as supp_name','suppliers.short as sp','suppliers.logo as supp_logo')
                     ->where('suppliers.id','=',$params->supplier)->first();
             
              $planInfo = new \stdClass(); 
              $planInfo->supp_logo = $supp->supp_logo;
              $planInfo->sp = $supp->sp;
              $planInfo->supp_name = $supp->supp_name;
              $planInfo->sumInsured = str_replace("Lakhs","",$jd->sumInsured);
              $planInfo->amount = $jd->amount;
              $planInfo->zone = $jd->zone;
              
              $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Proposal","relations"=>$relations,'plan'=>$planInfo,'param'=>$params,'data'=>$data,'scripts'=>[asset('page_js/oneCroreHealth/health_proposal.js')]];  
            
             return View::make('oneCroreHealth.health_proposal')->with($template);
         }
    }
    
    function proposerInfoTemplate(Request $request){
         $enquiryID = $request->enquiryID;
         $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         $template['param'] = json_decode($data->params_request);
          $template['relations'] = DB::table('relations')->get();
         return View::make('oneCroreHealth.info.proposer')->with($template);
    }
    
    function insurerInfoTemplate(Request $request){ 
         $enquiryID = $request->enquiryID;
         $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         
         //$template['realtions'] = DB::table('realtions')->select('*')->get();
         $template['param'] = json_decode($data->params_request);
         $template['relations'] = DB::table('relations')->get();
         return View::make('oneCroreHealth.info.insurer')->with($template);
    }
    
    function addressInfoTemplate(Request $request){ 
         $enquiryID = $request->enquiryID;
         $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         $states = DB::table('states_list')->get();
         $param = json_decode($data->params_request);
         $state = explode("-",$param->state);
         $cities = DB::table('cities_list')->where('state_id','=',$state[0])->get();
         $template['param'] = $param; 
         $template['cities'] = $cities;
         $template['states'] = $states;
         return View::make('oneCroreHealth.info.address')->with($template);
    }
    
    function medicalInfoTemplate(Request $request){ 
         $enquiryID = $request->enquiryID;
         $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         $param = json_decode($data->params_request);
         $supp = $param->supplier;
         $template['questions'] = DB::table('medical_questions')->where(['status'=>1,'supplier'=>$supp])->get();
         $template['param'] = $param;
         return View::make('oneCroreHealth.info.medical')->with($template);
    }
    
    function reviewInfoTemplate(Request $request){
         $enquiryID = $request->enquiryID;
         $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enquiryID)->first();
         $template['questions'] = DB::table('medical_questions')->where('status',1)->get();
         $template['param'] = json_decode($data->params_request);
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
       if($enqData->provider=="RELIGARE"){
           $resp = $this->ReligareOneCrResource->createPremiumReligare($request->enq);
       }else if($enqData->provider=="MANIPAL_CIGNA"){
            $resp = $this->ManipalResource->createPolicyNumManipalCigna($enqData);
       }else if($enqData->provider=="FGI_H"){
            $resp = $this->FgiResource->createPolicy($enqData,$request->enq);
       }else if($enqData->provider=="DIGIT_H"){
            $resp = $this->DigitOneCrResource->createPolicy($request->enq);
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
             $template = ['title' => 'Health Insurance Detail',"subtitle"=>"Health Declaration",'jd'=>$result['jd'],'pageData'=>$result['pageData'],'includePage'=>$result['includePage'],'plan'=>$result['plan'],'param'=>$result['param'],'data'=>$result['data'],'scripts'=>[asset('page_js/health/health_declaration.js')]];  
             return View::make('oneCroreHealth.health_declaration')->with($template);
         }
    }
    
    public function updatePremiumInfo(Request $request){
         $arr = ["params_request->addOn" =>$request->addons ];
         DB::table('app_quote')->where('enquiry_id', $request->enqId)->update($arr);
         $enqData = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$request->enqId)->first();
         $jd = json_decode($enqData->json_data);
         if($enqData->provider=="RELIGARE"){
            $resp = $this->ReligareResource->createPremiumReligare($request->enqId);
            if($resp['status']=='success'){
             $result = ['status'=>'success','message'=>'Policy inforamtion updated successfully','data'=>$resp['data']]; 
            }else{
                
                 $result = ['status'=>'error','message'=>$resp['message'],'data'=>['amount'=>$jd->amount]]; 
            }
         }else{
           $result = ['status'=>'error','message'=>'Unknown provider.','data'=>['amount'=>$jd->amount]]; 
         }
         return response()->json($result); 
    }
    
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
             if($data->provider=="RELIGARE"){
            
                     $plan = DB::table('suppliers')
                     ->select('suppliers.name as supp_name','suppliers.short as sp','suppliers.logo as supp_logo')
                     ->where('suppliers.id','=',$params->supplier)->first();
                      $planInfo->supp_logo = $plan->supp_logo;
                      $planInfo->supp_name = $plan->supp_name;
                      $planInfo->sp = $plan->sp;
                      $planInfo->sumInsured =  str_replace("Lakhs","",$jd->sumInsured);//$jd->intPolicyDataIO->policy->sumInsuredValue;
                      $planInfo->amount = $jd->amount;
                      $include = 'health.declarationPages.religare';
                      $pageData->formAction = "https://apiuat.religarehealthinsurance.com/portalui/PortalPayment.run";
                      $pageData->returnURL = "https://supersolutions.in/health-insurance/insured-success/".$enquiryID;
                      
             }else if($data->provider=="MANIPAL_CIGNA"){
                 
                  $plan = DB::table('suppliers')
                     ->select('suppliers.name as supp_name','suppliers.short as sp','suppliers.logo as supp_logo')
                     ->where('suppliers.id','=',$params->supplier)->first();
                      $planInfo->supp_logo = $plan->supp_logo;
                      $planInfo->supp_name = $plan->supp_name;
                      $planInfo->sp = $plan->sp;
                      $planInfo->sumInsured = $jd->sumInsured;
                      $planInfo->amount = $jd->amount;
                  $include = 'health.declarationPages.manipalCigna';
                  $pageData->formAction = "https://test.payu.in/_payment";
                  $formData = new \stdClass(); 
                  
                  $txid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                  $amt = $params->amount;
                  $productInfo = "Manipal health insurance from supersolutions";
                  $formData->key = "2M6Fzv";
                  $formData->txnid = $txid;
                  $formData->amount = $amt;
                  $formData->productinfo = "Manipal health insurance from supersolutions";
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
                  $formData->udf4 = $jd->proposalNum;
                  $formData->udf5 = "141806";
                  $formData->surl = "https://supersolutions.in/health-insurance/insured-success/".$enquiryID;
                  $formData->furl = "https://supersolutions.in/insurance/policy/cancel/".$enquiryID;
                   $hashSequence = "2M6Fzv|".$txid."|".$amt."|".$productInfo."|".$params->selfFname."|".$params->selfEmail."||||".$jd->proposalNum."|141806||||||wUTyMOKS";
                 // $str = "2M6Fzv|".$txid."|".$amt."||Praveen|p@gmail.com||||PROHLR010288924|141806||||||wUTyMOKS";
                  $hashed = hash("sha512", $hashSequence);
                  $formData->hash = $hashed ;
                  $pageData->formData = $formData;
                 
             }else if($data->provider=="FGI_H"){
                 
                  $plan = DB::table('suppliers')
                     ->select('suppliers.name as supp_name','suppliers.short as sp','suppliers.logo as supp_logo')
                     ->where('suppliers.id','=',$params->supplier)->first();
                      $planInfo->supp_logo = $plan->supp_logo;
                      $planInfo->supp_name = $plan->supp_name;
                      $planInfo->sumInsured = $jd->sumInsured;
                      $planInfo->sp = $plan->sp;
                      $planInfo->amount = $jd->amount;
                  $include = 'health.declarationPages.futureGenerali';
                  $pageData->formAction = "http://fglpg001.futuregenerali.in/Ecom_NL/WEBAPPLN/UI/Common/WebAggPayNew.aspx";
                  $formData = new \stdClass(); 
                  
                  $txid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                  $amt = $params->amount;
                  $productInfo = "Future Genrali health insurance from supersolutions";
                  
                  $formData->TransactionID = $jd->TransactionID;
                  $formData->PaymentOption = 3; //1 [PayTm] OR 2 [HDFC] OR 3 [Pay U]
                  $formData->ResponseURL ="https://supersolutions.in/health-insurance/insured-success/".$enquiryID;
                  $formData->ProposalNumber = $jd->proposalNum;
                  $formData->PremiumAmount =  $jd->amount;
                  $formData->UserIdentifier = "NA";//$params->selfFname.$params->selfMobile;
                  $formData->UserId = "NA";//$params->selfMobile;
                  $formData->FirstName = $params->selfFname;
                  $formData->LastName = $params->selfLname;
                  $formData->Mobile = $params->selfMobile;
                  $formData->Email = $params->selfEmail;
                  //"TransactionID|PaymentOption|ResponseURL|ProposalNumber|PremiumAmount|UserIdentifier|UserId|FirstName|LastName|Mobile|Email|"
                  $hashSequence = $jd->TransactionID."|3|https://supersolutions.in/health-insurance/insured-success/".$enquiryID."|".$jd->proposalNum."|".$jd->amount."|NA|NA|".$params->selfFname."|".$params->selfLname."|".$params->selfMobile."|".$params->selfEmail."|";
                  $hash = $this->Generatehash256($hashSequence);
                  $formData->CheckSum = $hash;
                  $formData->Vendor = 1; //Blank[.Net] or 0[.Net] or 1[PHP]
                  
                  
                  
                  $pageData->formData = $formData;
                 
             }else if($data->provider=="DIGIT_H"){
                $plan = DB::table('suppliers')
                 ->select('suppliers.name as supp_name','suppliers.short as sp','suppliers.logo as supp_logo')
                 ->where('suppliers.id','=',$params->supplier)->first();
                  $planInfo->supp_logo = $plan->supp_logo;
                  $planInfo->supp_name = $plan->supp_name;
                  $planInfo->sp = $plan->sp;
                  $planInfo->sumInsured =  str_replace("Lakhs","",$jd->sumInsured);//$jd->intPolicyDataIO->policy->sumInsuredValue;
                  $planInfo->amount = $jd->amount;
                  $include = 'health.declarationPages.digitHealth';
                  $pageData->formAction =$jd->paymentLink;
                  $pageData->returnURL = "https://supersolutions.in/health-insurance/insured-success/".$enquiryID;
                 
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
             }else if($data->provider="MANIPAL_CIGNA"){
                 $result = ['status'=>'success','enquiryID'=>$enquiryID,'proposal'=>$json->proposalNum];
             }else{
                 $result = ['status'=>'error','enquiryID'=>"",'proposal'=>""]; 
             }
            return response()->json($result);
         }else{
             return response()->json(['status'=>'error']); 
         }
     }


}

