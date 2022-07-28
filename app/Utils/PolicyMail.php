<?php
namespace App\Utils;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Response;
class PolicyMail {
    public function __construct(){}
    
    function calculateAndSendMail($policyNo){
     
               $policy = DB::table('policy_saled')->where('policy_no', $policyNo)->first();
               if($policy->MailStatus=="No"){ 
                    if($policy->type=="BIKE" || $policy->type=="CAR"){
                        $comsn =  $this->calculateMotorAndSend($policy);
                        DB::table('policy_saled')->where('policy_no',$policy->policy_no)->update($comsn);
                    }else if($policy->type=="HEALTH"){
                        $comsn =  $this->calculateHealthAndSend($policy);
                        DB::table('policy_saled')->where('policy_no',$policy->policy_no)->update($comsn);
                    }
                    
                    
                }else{
                   //['status'=>false,'message'=>$policyNo." is already exist."]; 
                }
    }
    
    private function calculateMotorAndSend($policy){
        $jsonData =  json_decode($policy->json_data);
        $netOD = 0.00;$netTP = 0.00;
        foreach($jsonData->covers as $key=>$covers){
            $netOD += ($key=='od' && $covers->selection===true)?$covers->netAmt:0.00;
            $netTP += ($key=='tp' && $covers->selection===true)?$covers->netAmt:0.00;
            $netTP += ($key=='ll_emp' && $covers->selection===true)?$covers->netAmt:0.00;
            $netTP += ($key=='pa_owner' && $covers->selection===true)?$covers->netAmt:0.00;
            $netTP += ($key=='ll_driver' && $covers->selection===true)?$covers->netAmt:0.00;
            $netTP += ($key=='pa_driver' && $covers->selection===true)?$covers->netAmt:0.00;
            $netTP += ($key=='ll_passanger' && $covers->selection===true)?$covers->netAmt:0.00;
            $netTP += ($key=='pa_passanger' && $covers->selection===true)?$covers->netAmt:0.00;
            
            if($key=="addons"){
                foreach($covers as $adon){ 
                  $netOD += $adon->netAmt;
                }
            } 
        }
        
        $netOD -= $jsonData->discount->total;
        
        $taxOD =  number_format((float)(($netOD*18)/100), 2, '.', '');
        $taxTP =  number_format((float)(($netTP*18)/100), 2, '.', '');
        
        $grossOD = ($netOD+$taxOD);
        $grossTP = ($netTP+$taxTP);
        
        $netTotal   = number_format((float)($netOD+$netTP), 2, '.', '');
        $taxTotal   = number_format((float)($taxTP+$taxOD), 2, '.', '');
        $grossTotal = number_format((float)($grossOD+$grossTP), 2, '.', '');
        
        //$comsn['policy_no']=$policy->policy_no; 
       // $comsn['customer_name']=$policy->customer_name; 
       // $comsn['policyDate']=Carbon::CreateFromFormat('Y-m-d H:i:s',$policy->date)->format('Y-m-d');
        $comsn['policyMonth']=Carbon::CreateFromFormat('Y-m-d H:i:s',$policy->date)->format('m');
        $comsn['policyYear']=Carbon::CreateFromFormat('Y-m-d H:i:s',$policy->date)->format('Y');
       // $comsn['partner']=$policy->provider; 
       // $comsn['policyType']=$policy->policyType;
        $comsn['policyProductName']=$policy->type.' '.ucfirst(strtolower($policy->policyType)).' Policy';
        $comsn['netTP']=$netTP;
        $comsn['netOD']=$netOD; 
        $comsn['taxTP']=$taxTP; 
        $comsn['taxOD']=$taxOD; 
        $comsn['grossTP']=$grossTP; 
        $comsn['grossOD']=$grossOD; 
       // $comsn['netTotal']=$netTotal;
        //$comsn['taxTotal']=$taxTotal; 
        //$comsn['grossTotal']=$grossTotal; 
        //$comsn['pospId']=$policy->agent_id;
        //$comsn['spId']=$policy->sp_id;
        //$comsn['type']=$policy->type;
        $comsn['MailStatus']='Yes';
        return $comsn;
    }
    
    private function calculateHealthAndSend($policy){ 
        
        $productInfo =  json_decode($policy->product_info);
      //  $comsn['policy_no']=$policy->policy_no; 
      //  $comsn['customer_name']=$policy->customer_name; 
     //  $comsn['policyDate']=Carbon::CreateFromFormat('Y-m-d H:i:s',$policy->date)->format('Y-m-d');
        $comsn['policyMonth']=Carbon::CreateFromFormat('Y-m-d H:i:s',$policy->date)->format('m');
        $comsn['policyYear']=Carbon::CreateFromFormat('Y-m-d H:i:s',$policy->date)->format('Y');
       // $comsn['partner']=$policy->provider; 
       // $comsn['policyType']=$policy->policyType;
        $comsn['policyProductName']=isset($productInfo->title)?$productInfo->title:"";
        $comsn['netTP']=0.00;
        $comsn['netOD']=0.00; 
        $comsn['taxTP']=0.00; 
        $comsn['taxOD']=0.00; 
        $comsn['grossTP']=0.00; 
        $comsn['grossOD']=0.00; 
       // $comsn['netTotal']=$policy->netAmt;
       // $comsn['taxTotal']=$policy->taxAmt;
       // $comsn['grossTotal']=$policy->grossAmt; 
       // $comsn['pospId']=$policy->agent_id;
       // $comsn['spId']=$policy->sp_id;
        //$comsn['type']=$policy->type;
         $comsn['MailStatus']='Yes';
        return $comsn;
     }
     
    // private function sendPolicyMailTocustomer(){
    //     Mail::send('insurance.email-template.moter-payment-link', $data, function($message) use ($custname, $custemail,$subject) {
    //       $message->to($custemail, $custname)
    //       ->subject($subject);
    //      $message->from('care@superfinserv.com',config('custom.site_short_name'));
    //     });
    // }
    
}