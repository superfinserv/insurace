<?php 
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
 
 
    //Get Dates of year span 
    if (!function_exists('timePeriod')) {
      function timePeriod($format,$tenure,$startDate=""){
        $policyStartDate = ($startDate=="")?date('Y-m-d'):$startDate;
        $_policyEndDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($policyStartDate)) . " +".$tenure." year")); 
        $policyEndDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($_policyEndDate)) . " -1 day"));

        $resp = new \stdClass(); 
        $resp->startDate = date_format(date_create($policyStartDate),$format);
        $resp->endDate   = date_format(date_create($policyEndDate),$format);
        
        return $resp;
    }
    }
    
    function uniqueQuoteNo($param){
        $length = 10;
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ'.date('YmdHis').$param.rand(1111111111,9999999999);
        return substr(str_shuffle($str), 0, $length);
    }
    
    
    //Get eldest Member age
    if (!function_exists('eldestMemberAge')) {
      function eldestMemberAge($members){
       $maxAge = 0 ;$minAge=0;
       foreach($members as $key=>$data){
              $age = (int)$data['age'];
                 if($minAge==0){$minAge =   $data['age'];}
                 else if($data['age']<$minAge){ $minAge =  intval($age);}
                 
                if($maxAge==0){$maxAge =  intval($data['age']);}
                else if($data['age']>$maxAge){ $maxAge =  intval($age);}
        }
        
        $resp = new \stdClass(); 
        $resp->maxAge = intval($maxAge);
        $resp->minAge = intval($minAge);
        return $resp;
    }
    }
    
    // Get age from date
      if (!function_exists('calulateAge')) {
         function calulateAge($dob){
        $dateOfBirth = date("Y-m-d", strtotime($dob));  
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        return $diff->format('%y');
    }
      }
    
    
     // SI Range 
     if (!function_exists('sumInsuredArr')) {
     function sumInsuredArr($provider,$plan,$uType){
         if($provider=='DIGIT'){
             if($uType=="customer" || $uType=="sp" ){
                return ['2'=>200000,'3'=>300000,'4'=>400000,'5'=>500000,'6'=>600000,'7'=>700000,'9'=>900000,'10'=>1000000,'15'=>1500000,'20'=>2000000,'25'=>2500000];
             }else{
               return ['2'=>200000,'3'=>300000,'4'=>400000,'5'=>500000];  
             }
                 
             }else if($provider=='CARE'){
                if($plan=='1967'){
                    return  ['25'=>2500000,'50'=>5000000,'100'=>10000000];
                }else{
                    if($uType=="customer" || $uType=="sp"){
                        if($plan=="608"){
                            return  ['5'=>500000,'7'=>700000,'10'=>1000000,'15'=>1500000,'20'=>2000000,'25'=>2500000,'30'=>3000000,'40'=>4000000,'50'=>5000000,'60'=>6000000,'75'=>7500000];
                        }else if($plan=="611"){
                            return  ['5'=>500000,'7'=>700000,'10'=>1000000,'15'=>1500000,'20'=>2000000,'25'=>2500000,'30'=>3000000,'40'=>4000000];
                        }else if($plan=="1439"){
                            return  ['5'=>500000,'7'=>700000,'10'=>1000000,'15'=>1500000];
                        }else{
                           return   ['5'=>500000,'7'=>700000,'10'=>1000000,'15'=>1500000,'20'=>2000000,'25'=>2500000,'30'=>3000000,'40'=>4000000,'50'=>5000000,'60'=>6000000,'75'=>7500000];
                        }
                    }else{
                       return  ['5'=>500000];
                    }
                        
                    }
         }else if($provider=='MANIPAL_CIGNA'){
             if($uType=="customer" || $uType=="sp"){
                 
                 return ['4.5'=>450000,'5.5'=>550000,'7.5'=>750000,'10'=>1000000,'15'=>1500000,'20'=>2000000,'25'=>2500000];
             }else{
                return ['4.5'=>450000]; 
             }
         }else if($provider=='HDFCERGO'){
             if($uType=="customer" || $uType=="sp"){
                 return ['5'=>50000,'10'=>1000000,'15'=>1500000,'20'=>2000000,'25'=>2500000,'50'=>5000000];
             }else{
                return ['5'=>50000]; 
             }
         }
      }
    }
