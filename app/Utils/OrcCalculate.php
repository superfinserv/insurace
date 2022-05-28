<?php
namespace App\Utils;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Response;
class OrcCalculate {
    public function __construct(){}
    
    
    function calculateAndSave($policyNo){
         if(DB::table('policy_payouts')->where('policy_no', $policyNo)->doesntExist()){ 
             $policy = DB::table('policy_saled')->where('policy_no', $policyNo)->first();
             $comsn = $this->calculateORC($policy);
             DB::table('policy_payouts')->insertGetId($comsn);
             return  ['status'=>true,'pospAmt'=>$comsn['pospDst'],'spAmt'=>$comsn['spDst']];
         }else{
             return  ['status'=>false,'pospAmt'=>0,'spAmt'=>0];
         }
    }
    
    private function calculateORC($policy){
        if($policy->type=="BIKE" || $policy->type=="CAR"){
            $_comsn =  $this->calculateMotor($policy);
        }else if($policy->type=="HEALTH"){
             $_comsn = $this->calculateHealth($policy);
        }
        
         $_comsn['policy_no']=$policy->policy_no;  
         $_comsn['pospId']=$policy->agent_id;
         $_comsn['spId']=$policy->sp_id;
         $_comsn['status']='Pending'; 
         $_comsn['policyMonth'] = Carbon::CreateFromFormat('Y-m-d H:i:s',$policy->date)->format('m');
         $_comsn['policyYear'] = Carbon::CreateFromFormat('Y-m-d H:i:s',$policy->date)->format('Y');
        return $_comsn;
    }
    
    private function calculateMotor($policy){
             $SQL =  DB::table('policy_rule_sheet');
            if($policy->type=="BIKE"){
                $jsonData =  json_decode($policy->json_data);
                $paramData =  json_decode($policy->params);
                $var =  $paramData->vehicle->varient->id;
                $twBODY =  DB::table('vehicle_variant_tw')->where('id',$var)->value('body_type');
                $BODY  = ($twBODY=="Scooter")?"Scooter":"Bike";
                $hasCPA = 'No';
                foreach($jsonData->covers as $key=>$covers){
                    if($key=='pa_owner' && $covers->selection===true){
                        $hasCPA = 'Yes';
                    }
                }
                $SQL->where('vehicleType',"TW")->where('CPA',$hasCPA)->where('bodyType',$BODY);
            }else{
                $SQL->where('vehicleType',"CAR");
            }
            $SQL->where('insurer',$policy->provider)->where('type','MOTOR')->where('policyType',$policy->policyType)
                ->whereDate('fromDate', '<=', $policy->date)
                ->whereDate('toDate','>=', $policy->date);
            
            $row =  $SQL->first();  
            
            
                $CommissionablePremium = ($row->onAmt=='Net')?$policy->netAmt:$policy->netOD;
                $pospCommission = 0.00;
                $spCommission = 0.00;
                $totalCommission = 0.00;
                
                if($row->commisionType=="Percent"){
                    if($policy->agent_id){
                      $pospCommission = number_format((float)(($CommissionablePremium*$row->pospIn)/100), 2, '.', '');
                    }
                    if($policy->sp_id){
                        $spCommission = number_format((float)(($CommissionablePremium*$row->spIn)/100), 2, '.', '');
                    }
                    $totalCommission = number_format((float)(($CommissionablePremium*$row->totalIn)/100), 2, '.', '');
                }else{
                      $pospCommission = ($policy->agent_id)?$row->pospIn:0.00;
                      $spCommission = ($policy->sp_id)?$row->spIn:0.00;
                      $totalCommission = $row->totalIn;
                }
                $calc['onAmt']= $CommissionablePremium;
                $calc['onAmtType']= $row->onAmt;
                
                $calc['pospDst']= $pospCommission;
                $calc['spDst']= $spCommission; 
                $calc['totalDst']  = $totalCommission;
                $calc['IpospComsn']= $pospCommission;
                $calc['IspComsn']= $spCommission; 
                $calc['ItotalComsn']  = $totalCommission;
                return $calc;
       
    }
    
    private function calculateHealth($policy){
        $row =  DB::table('policy_rule_sheet')
                    ->where('insurer',$policy->provider)
                    ->where('type','HEALTH')
                    ->where('policyType',$policy->policyType)
                    ->whereDate('fromDate', '<=', $policy->date)
                    ->whereDate('toDate','>=', $policy->date)
                    ->first();
        $CommissionablePremium = $policy->netAmt;
        $pospCommission = 0.00;
        $spCommission = 0.00;
                if($row->commisionType=="Percent"){
                    if($policy->agent_id){
                      $pospCommission = number_format((float)(($CommissionablePremium*$row->pospIn)/100), 2, '.', '');
                    }
                    if($policy->sp_id){
                        $spCommission = number_format((float)(($CommissionablePremium*$row->spIn)/100), 2, '.', '');
                    }
                    $totalCommission = number_format((float)(($CommissionablePremium*$row->totalIn)/100), 2, '.', '');
                }else{
                      $pospCommission = ($policy->agent_id)?$row->pospIn:0.00;
                      $spCommission = ($policy->sp_id)?$row->spIn:0.00;
                      $totalCommission = $row->totalIn;
                }
        $calc['onAmt']= $CommissionablePremium;
        $calc['onAmtType']= $row->onAmt;
        
        $calc['pospDst']= $pospCommission;
        $calc['spDst']= $spCommission; 
        $calc['totalDst']  = $totalCommission;
        $calc['IpospComsn']= $pospCommission;
        $calc['IspComsn']= $spCommission; 
        $calc['ItotalComsn']  = $totalCommission;
        return $calc;
    }
 
}