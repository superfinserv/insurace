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
            //$SRange = SumIncRange($range,'HDFCERGO','','customer');
            
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
                if($range['start']==26){ $rangeARR = ['50'=>5000000,'100'=>10000000,'200'=>20000000];}
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
           if($enQCode=="OptimaSecure"){
              $Silver = $this->optimasecure->createPolicy($enqId);
              return $Silver;
          }
    }
    
     function policyGeneration($enqId){
           $enQCode = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqId)->value('code');
           if($enQCode=="OptimaSecure"){
              $Silver = $this->optimasecure->policyGen($enqId);
              return $Silver;
          }
    }
    
    function savePDF($enQid,$policyno,$product){
          $result =  new \stdClass();
        if($product=="OPTIMA_SECURE"){
             $OP = $this->optimasecure->GetPDF($enQid,$policyno);
             if($OP['status']){
              $result->status =true;$result->filename =$OP['filename'];
             }else{
                 $result->status =false;$result->filename =""; $result->message =$OP['message'];
             }
        }else{
             $result->status =false;$result->filename ="";$result->message ="Invalid Product found";
        }
       
       return $result;
        
    }
    
    
    
}