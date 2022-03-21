<?php
namespace App\Partners\Manipal;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Auth;


use App\Partners\Manipal\ManipalProtect;
use App\Partners\Manipal\ManipalPlus;

class Manipal {
    protected $protect;
    protected $plus;
    
    public function __construct(){
         $this->protect = new ManipalProtect;
         $this->plus = new ManipalPlus;
    }
    
    function getZone($pincode){
         $zone = DB::table('zone_mapping')->where('pincode',$pincode)->first();
         return $zone->manipal_zone;
    }
    
     function generateApplicationNumber($enqID){
            $client = new Client([
                'headers' => [ 'Content-Type'=>'application/json',"app_key"=>config('mediclaim.MANIPAL.appKey'),"app_id"=>config('mediclaim.MANIPAL.appIdAppNum')]
            ]);
            
             
            $clientResp =  $client->get(config('mediclaim.MANIPAL.GetPolicyNum')."325");
            
            $response = $clientResp->getBody()->getContents();   
            $result=json_decode($response);
         
             if(isset($result->applicationNumber) && $result->applicationNumber!=""){
                 $Querydata = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqID)->first();
                  $dataParam = json_decode($Querydata->json_data);
                  $dataParam->applicationID= $result->applicationNumber;
                  
                   DB::table('app_quote')->where('type','HEALTH')
                                         ->where('enquiry_id',$enqID)
                                         ->update(['proposalNumber'=>$result->applicationNumber,'premiumAmount'=>$dataParam->amount,'json_data'=>json_encode($dataParam)]);
                                                                                                        
                       $data=['enq'=>$enqID,'amount'=> $dataParam->amount,  'proposalNum'=>"",'applicationID'=>$result->applicationNumber,
                              'quotationPremium'=>$dataParam->amount
                              ];
                        if($Querydata->product=="RPRT06SBSF"){ //Prohealth Protect     
                              $res = $this->protect->validateProposal($enqID);
                              if($res['status']){
                                return ['status'=>'success','data'=>$data];
                             }else{
                                return ['status'=>'error','message'=>$res['message'],'data'=>[]];  
                             }
                        }else{
                            $res = $this->plus->validateProposal($enqID);
                              if($res['status']){
                                return ['status'=>'success','data'=>$data];
                             }else{
                                return ['status'=>'error','message'=>$res['message'],'data'=>[]];  
                             }
                        }
             }else{
                 $result = ['status'=>'error','message'=>"Something went wrong, try again!",'data'=>[]];
             }
             
             return $result;
         
    }
    
     function getQuickPlans($range,$params,$devicetoken,$policytyp){
         
        
          
           $child = $params['total_child'];
           $adult = $params['total_adult'];
          
           $rangeARR =[];
          
         if($range['start']==2){ $rangeARR = ['2'=>200000,'3'=>300000.0];}
         if(isset(Auth::guard('agents')->user()->posp_ID)){ 
             if($range['start']==4){ $rangeARR = ['4.5'=>450000];}
         }else{
                if($range['start']==4){ $rangeARR = ['4.5'=>450000,'5.5'=>550000,'7.5'=>750000];}
                if($range['start']==10){ $rangeARR = ['10'=>1000000,'15'=>1500000];}
                if($range['start']==16){ $rangeARR = ['20'=>2000000,'25'=>2500000];}
        }
          
          
          $_plans =[];$count=0;
          
          foreach($rangeARR as $sum=>$sumInsured){
              
                    $mProtect = $this->protect->calculatePremium($params,$sum,$sumInsured,$devicetoken,$policytyp);
                    if($mProtect['status']){$count++; $_plans[] =$mProtect['data'];}
                    
                    $mPlus = $this->plus->calculatePremium($params,$sum,$sumInsured,$devicetoken,$policytyp);
                    if($mPlus['status']){$count++; $_plans[] =$mPlus['data'];}
                  
            }//foreach Range
           
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
     
    function recalculateQuickPlan($enqId,$termYear,$sum,$_zone,$addOn){ 
          
          $enQproduct = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqId)->value('product');
          if($enQproduct=="RPRT06SBSF"){
               $this->protect->recalculatePremium($enqId,$termYear,$sum,$_zone,$addOn);
          }else{
               $this->plus->recalculatePremium($enqId,$termYear,$sum,$_zone,$addOn);
           }
      }
      
      
    function saveProposalData($enqID,$quoteId,$proposalNum,$txnid,$amount){ 
              $enQproduct = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqID)->value('product');
              if($enQproduct=="RPRT06SBSF"){
                   $this->protect->saveProposal($enqID,$quoteId,$proposalNum,$txnid,$amount);
              }else{
                   $this->plus->saveProposal($enqID,$quoteId,$proposalNum,$txnid,$amount);
              }
       }
       
    function GetPolicyInfo($pno){
        $listofPolicyDetailsTO[]  = ['policyNum'=>$pno];
         $REQUEST = ["listofPolicyDetailsTO"=>$listofPolicyDetailsTO];
        
          $client = new Client([
                'headers' => ['Content-Type'=>'application/json',"app_key"=>config('mediclaim.MANIPAL.appKey'),"app_id"=>config('mediclaim.MANIPAL.appIdGetPolicy')]
            ]);
            
            $clientResp = $client->post(config('mediclaim.MANIPAL.GetPolicyDetails'),
                ['body' => json_encode($REQUEST)]
            );
            
            $response = $clientResp->getBody()->getContents();   
            $_result=json_decode($response);
         
         
         //  print_r($_result);
       //  if(isset($_result->errorList)){
           
                 if($_result->errorList==null || $_result->errorList==""){
                     $statusCd  = $_result->listofPolicyDetailsTO[0]->statusCd;
                     $caseType  = $_result->listofPolicyDetailsTO[0]->caseType;
                     $recptId   = $_result->listofPolicyDetailsTO[0]->inwardDOList[0]->receiptId;
                     if($statusCd=="Pending"){
                         $_result = ['status'=>'pending','message'=>'Policy is under issuance. Please try downloading after some time','receipt'=>$recptId];
                     }else{
                         $_result = ['status'=>'success' ,'receipt'=>$recptId];
                     }
                 }else{
                      $_result = ['status'=>'error','message'=>$_result->errorList[0]->errDescription];
                 }
    //      }else{
         
    //          $_result = ['status'=>'error','message'=>"Internal error try again later"]; 
    //   }
       return $_result;  
    }
    
    function GetPDF($pno,$data,$f=false){
       $policy =  $this->GetPolicyInfo($pno);
       
       $json = json_decode($data->json_data);
       $params = ($f)?json_decode($data->params):json_decode($data->params_request);
       $policyno = base64_encode($pno);
       $username = base64_encode("1000015-01");//1607112-01
       $password = base64_encode("Cigna@123");//15041995
       $email = base64_encode($params->selfEmail);
       $applicationID = base64_encode($json->applicationID);
       
      
         if($policy['status']=='success'){
             $fileName = "MANIPAL_CIGNA_".$pno.".pdf";
             $client = new Client([
                'headers' => [ 'Content-Type'=>'application/json',"app_key"=>config('mediclaim.MANIPAL.appKey'),"app_id"=>config('mediclaim.MANIPAL.appIdDocsModule')]
            ]);
            
             $_url  = config('mediclaim.MANIPAL.DocsModule')."?DocumentType=&RenewalId=&ApplicationNumber=".$applicationID."&PolicyNumber=".$policyno."&UserId=".$username."&Password=".$password."&EmailId=".$email;
            $clientResp =  $client->get($_url);
            
            $response = $clientResp->getBody()->getContents();   
           // $result=json_decode($response);
              
              if($response!=""){
                $filePath1 = $response;
                $file1 = getcwd()."/public/assets/customers/policy/pdf/".$fileName;
                file_put_contents($file1, $filePath1);
                $result = ['status'=>true,'receipt'=>'','filename'=>$fileName];
              }else{
                $result = ['status'=>false,'filename'=>'','receipt'=>'',"message"=>"Please try downloading after some time"];
              }
         
       }else{
            $result = ['status'=>false,'filename'=>"",'receipt'=>'','message'=>$policy['message']];
       }
       return $result;
    }
    
    function GetReceipt($pno,$data,$f=false){
       $policy =  $this->GetPolicyInfo($pno);
       
       $json = json_decode($data->json_data);
       
       $params = ($f)?json_decode($data->params):json_decode($data->params_request);
       $policyno = base64_encode($pno);
       $username = base64_encode("1000015-01");//1607112-01
       $password = base64_encode("Cigna@123");//15041995
       $email = base64_encode($params->selfEmail);
       $applicationID = base64_encode($json->applicationID);
       
       if($policy['status']=='success' || $policy['status']=='pending'){
         
              $fileName = "MANIPAL_CIGNA_Receipt_".$pno.".pdf";
              $reciptId = base64_encode($policy['receipt']);
            
                $client = new Client([
                    'headers' => [ 'Content-Type'=>'application/json',"app_key"=>config('mediclaim.MANIPAL.appKey'),"app_id"=>config('mediclaim.MANIPAL.appIdDocsModule')]
                ]);
                
                $_url  = config('mediclaim.MANIPAL.DocsModule')."?ReceiptNo=".$reciptId."&UserId=".$username."&Password=".$password."&EmailId=".$email;
                $clientResp =  $client->get($_url);
                
                $response = $clientResp->getBody()->getContents();   
            
              if($response!=""){
                $filePath1 = $response;
                $file1 = getcwd()."/public/assets/customers/policy/pdf/".$fileName;
                file_put_contents($file1, $filePath1);
                $result = ['status'=>true,'filename'=>'','receipt'=>$fileName];
              }else{
                $result = ['status'=>false,'filename'=>"",'receipt'=>'',"message"=>"Please try downloading after some time"];
              }
       }else{
            $result = ['status'=>false,'filename'=>"",'receipt'=>'','message'=>$policy['message']];
       }
       return $result;
    }
      
}