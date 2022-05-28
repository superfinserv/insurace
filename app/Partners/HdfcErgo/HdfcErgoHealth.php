<?php 
namespace App\Partners\HdfcErgo;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use Config;
 
use App\Partners\HdfcErgo\OptimaSecure;

class HdfcErgoHealth{
    
    public function __construct() { 
        $this->optimasecure = new OptimaSecure;
    }
    

    function getQuickPlans($range,$params,$devicetoken,$pln,$policytyp){
            if($range['start']==2){ $rangeARR = ['2'=>200000,'3'=>300000];}
            if(isset(Auth::guard('agents')->user()->posp_ID)){
                if(Auth::guard('agents')->user()->userType=="POSP"){ //For POSP
                  if($range['start']==4){ $rangeARR = ['5'=>500000];}
                }else{ //FOR SP
                    if($range['start']==4){ $rangeARR = ['5'=>500000];}
                    if($range['start']==10){ $rangeARR = ['10'=>1000000,'15'=>1500000];}
                    if($range['start']==16){ $rangeARR = ['20'=>2000000,'25'=>2500000];}
                }
            }else{ // For customer
                if($range['start']==4){ $rangeARR = ['5'=>500000,'6'=>600000,'8'=>800000,'9'=>900000];}
                if($range['start']==10){ $rangeARR = ['10'=>1000000,'15'=>1500000];}
                if($range['start']==16){ $rangeARR = ['20'=>2000000,'25'=>2500000];}
                if($range['start']==16){ $rangeARR = ['50'=>5000000];}
            }
            
            
         $child = $params['total_child'];
         $adult = $params['total_adult'];
         $totalMem = $child+$adult;
         
        $count=0;$plans = [];
     //   $maxAge = $this->eldestMemberAge($params['members'])->maxAge;
        foreach($rangeARR as $sum=>$sumInsured){    
                   if($pln=="OptimaSecure" || $pln=="ALL"){
                     $OS = $this->optimasecure->calculatePremium(json_decode(json_encode($params)),$sum,$sumInsured,$devicetoken,$policytyp);
                    // print_r($Silver);
                     if($OS['status']){$count++; $_plans[] =$OS['data'];}
                  }
        }
        
           
         if($count>0){   
              $result['status'] ="success";
              $result['count'] =$count;
              $result['plans'] =$_plans;
         }else{
            $result['status'] ="error";
            $result['count'] =$count;
            $result['plans'] =[]; 
         }
         return $result; 
    }
    
    function recalculateQuickPlan($enqId,$termYear,$sum,$addOn){
          $enQ = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqId)->first();
          if($enQ->code=="OptimaSecure"){
              $silver = $this->optimasecure->recalculatePremium($enqId,$termYear,$sum,$addOn);
          }
    }
    
    function createProposal($enqId){
          
          $enQCode = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqId)->value('code');
           if($enQ->code=="OptimaSecure"){
              $Silver = $this->optimasecure->createPolicy($enqId);
              return $Silver;
          }else if($enQCode=="DGO01"){
              $Gold = $this->gold->createPolicy($enqId);
              return  $Gold;
          }else if($enQCode=="DDO01"){
              $Diamond = $this->diamond->createPolicy($enqId);
              return  $Diamond;
          }else{
              $Silver = $this->silver->createPolicy($enqId);
              return  $Silver;
          }
    }
    
    // function GetPDF($policyno){
       
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL =>config('mediclaim.DIGIT.pdf').$policyno,//"https://preprod-digitpolicyissuance.godigit.com/policyservice/v1/travel/policyDocument/".$policyno,//"http://preprod-digitpolicyissuance.godigit.com/policyservice/v1/travel/policyDocument/".$policyno,
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => "",
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 0,
    //       CURLOPT_FOLLOWLOCATION => true,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => "GET",
    //       CURLOPT_HTTPHEADER => array(
    //         "Authorization: ".config('mediclaim.DIGIT.ApiKey'),
    //         "Content-Type: application/json"
    //       ),
    //     ));
    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     $resp = json_decode($response);
    //     //print_r($response);
    //      $result = new \stdClass();
    //      try {
    //          if(isset($resp->status->code)){ 
    //               $result->status =false;$result->filename ="";$result->ecard ="";$result->proposal ="";   
    //          }else{
    //               if(isset($resp->schedulePath)){
    //                   $filePath1 = $resp->schedulePath;
    //                   $ff1 = file_get_contents($filePath1,true);
    //                   $file1 = getcwd()."/public/assets/customers/policy/pdf/Digit_Health_".$policyno.".pdf";
    //                   file_put_contents($file1, $ff1);
    //                   $result->filename = "Digit_Health_".$policyno.".pdf";
    //               }else{
    //                  $result->filename ="";
    //               } 
    //               if(isset($resp->proposalPath)){
    //                   $filePath2 = $resp->proposalPath;
    //                   $ff2 = file_get_contents($filePath2,true);
    //                   $file2 = getcwd()."/public/assets/customers/policy/pdf/Digit_Health_proposal_".$policyno.".pdf";
    //                   file_put_contents($file2, $ff2);
    //                   $result->proposal = "Digit_Health_proposal_".$policyno.".pdf";
    //               }else{
    //                   $result->proposal ="";
    //               }
    //               if(isset($resp->ecardPath)){      
    //                   $filePath3 = $resp->ecardPath;
    //                   $ff3 = file_get_contents($filePath3,true);
    //                   $file3 = getcwd()."/public/assets/customers/policy/pdf/Digit_Health_eCard_".$policyno.".pdf";
    //                   file_put_contents($file3, $ff3);
    //                   $result->ecard = "Digit_Health_eCard_".$policyno.".pdf";
    //               }else{
    //                   $result->ecard ="";
    //               }
    //               $result->status =true;
    //          }
            
              
               
    //      }catch(Exception $e) {
    //       $result->status =false;$result->filename ="";$result->ecard ="";$result->proposal ="";
    //      }
    //     return $result;
    // }
    
    
    // function updateTransactionData($REQ){
    //          $tr =  DB::table('app_quote')->where(['type'=>'HEALTH','token'=>$REQ['policyNumber']])->first();
    //          $isExist = DB::table('policy_saled')->where('type','HEALTH')->where('enquiry_id',$tr->enquiry_id)->count();
    //          $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$tr->enquiry_id)->first();
    //          $json_data = json_decode($data->json_data);
    //          $saledData = ['type'=>'HEALTH','provider'=>$data->provider,'mobile_no'=>$data->customer_mobile,'customer_name' =>$data->customer_name,
    //                       'json_data'=>$data->json_data,'mobile_no'=>"",'getway_response'=>json_encode($REQ),
    //                       "customer_id"=>1,'params'=>$data->params_request,
    //                       ];
    //          $saledData['transaction_no'] =$REQ['transactionNumber'];
    //          $saledData['policy_no'] =$REQ['policyNumber'];
             
    //          $SUM = json_decode($data->sumInsured);
    //          $replace = array("Lakhs", "INR", "Lakh", " ");
    //          $sumInsured = str_replace($replace, "", $SUM->shortAmt);
             
    //          $termYear = $data->termYear;
    //         // $Q['termYear']=$request->termYear;
    //          //$_amts = json_decode($data->amounts);
    //         // $Q['amounts']=$_amts->$termYear;
            
    //          $premium = json_decode($data->amounts); 
    //          $saledData['termYear'] = $data->termYear;
    //          $saledData['sumInsured'] = $sumInsured;//$json_data->sumInsured;
    //          $saledData['product_info'] = json_encode(['title'=>$data->title,'code'=>$data->code,'code'=>$data->code,'product'=>$data->product,'policyType'=>$data->policyType,'zone'=>$data->zone]);
    //          $saledData['premium_info'] = json_encode($premium->$termYear);
                 
             
    //          $saledData['sp_id'] =0;
    //          $saledData['mobile_no'] =$data->customer_mobile;
    //          $saledData['agent_id'] =$data->agent_id;
    //          $saledData['sp_id'] =$data->sp_id;
    //          $saledData['payment_status'] = "Completed";
    //          $saledData['policy_status']  = "Completed";
    //          $saledData['amount'] = number_format((float)$premium->$termYear->Total_Premium, 2, '.', '');//$json_data->amount;
    //          $saledData['netAmt']=$data->netAmt;
    //          $saledData['taxAmt']=$data->taxAmt;
    //          $saledData['grossAmt']=$data->grossAmt;
    //          $saledData['policyType'] = $data->policyType;
    //          $saledData['reqQuote']=$data->reqQuote;
    //          $saledData['respQuote']=$data->respQuote;
    //          $saledData['reqRecalculate']=$data->reqRecalculate;
    //          $saledData['respRecalculate']=$data->respRecalculate;
    //          $saledData['reqCreate']=$data->reqCreate;
    //          $saledData['respCreate']=$data->respCreate;
    //          $saledData['reqSaveGenPolicy']=$data->reqSaveGenPolicy;
    //          $saledData['respSaveGenPolicy']=$data->respSaveGenPolicy;
    //          $saledData['startDate']=$data->startDate;
    //          $saledData['endDate']=$data->endDate;
    //         if(!$isExist){
    //             $saledData['enquiry_id'] =$tr->enquiry_id;
    //             $refID = DB::table('policy_saled')->insertGetId($saledData);
    //          }else{
    //             $refID = DB::table('policy_saled')->where(['enquiry_id'=>$tr->enquiry_id])->update($saledData);
    //          }
    //         $result = new \stdClass();
    //         $result->status=true;
    //         $result->enq=$tr->enquiry_id;
    //         $result->transactionNo=$REQ['transactionNumber']; 
    //         $result->policyno=$REQ['policyNumber']; 
    //         $result->server=$data->server;
    //         $result->provider=$data->provider;
    //         $result->message="Transaction completed successfully";    
    //         return $result;   
    // }
    
}