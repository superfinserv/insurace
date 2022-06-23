<?php
namespace App\Resources;
use Nathanmac\Utilities\Parser\Parser;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ErrorException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;

use Artisaninweb\SoapWrapper\SoapWrapper;
//use App\Soap\Request\GetConversionAmount;
//use App\Soap\Response\GetConversionAmountResponse;

use Carbon\Carbon;

class FgiCarResource extends AppResource{ 
    
 
    
    public function __construct(){
      $this->soapWrapper = new SoapWrapper;
    }
    
     public function productCode($plan){
          $res =  new \stdClass();
          
            switch ($plan) {
            //  case "COM":
            //     $res->contract =  "FTW"; $res->risk =  "FTW"; $res->cover =  "CO";
            //     return $res;
            //     break;
             case "COM-NEW":
                $res->contract = "F13";$res->risk  =  "F13";$res->cover =  "CO";
                return $res;
                break;
            case "COM-ROLLOVER":
                $res->contract =  "FPV";$res->risk =  "FPV";  $res->cover =  "CO";
                return $res;
                break;
            case "COM-USED":
                $res->contract =  "FPV"; $res->risk =  "FPV";$res->cover =  "CO";
                return $res;
                break;
            case "TP-ROLLOVER":
                $res->contract =  "FPV";$res->risk =  "FPV"; $res->cover =  "LO";
                return $res;
                break;
           case "TP-NEW":
                $res->contract =  "FPV";$res->risk =  "FPV"; $res->cover =  "LO";
                return $res;
                break;
            case "TP-USED":
                $res->contract =  "FPV";$res->risk =  "FPV"; $res->cover =  "LO";
                return $res;
                break;
              case "SAOD-ROLLOVER":
                $res->contract = "FVO"; $res->risk  =  "FVO"; $res->cover =  "OD";
                return $res;
                break;
             case "SAOD-NEW":
                $res->contract = "FVO"; $res->risk  =  "FVO"; $res->cover =  "OD";
                return $res;
                break;
             case "SAOD-USED":
                $res->contract = "FVO"; $res->risk  =  "FVO"; $res->cover =  "OD";
                return $res;
                break;
              default:
                $res->contract =  "FPV"; $res->risk =  "FPV";  $res->cover =  "CO";
                return $res;
            }
    }
    
     public function getJsonData($options,$data,$preInfo){
            //$resp = $temp->response;
            //$data = json_decode($response);
            
           // $ncb = isset($options['previousInsurance']['ncb'])?$options['previousInsurance']['ncb']:"ZERO";
            ///$ncbArray = ['ZERO'=>0,'TWENTY'=>20,'TWENTY_FIVE'=>25,'THIRTY_FIVE'=>35,'FORTY_FIVE'=>45,'FIFTY'=>50];
           /// $ncbArrayNew = ['ZERO'=>20,'TWENTY'=>25,'TWENTY_FIVE'=>35,'THIRTY_FIVE'=>45,'FORTY_FIVE'=>50,'FIFTY'=>50];
           // $hasMadePreClaim  = (isset($options['previousInsurance']['hasPreClaim']) && $options['previousInsurance']['hasPreClaim']=='yes')?'Y':'N';
            //$ncbPercent = $ncbArray[$ncb];
           // $ncbPercentNew = $ncbArrayNew[$ncb];
            $additionalBenefitDiscount =0.00;
            $tp =  new \stdClass();
            $tp->title = "Third Party";
            $tp->code = "TP";
            $tp->selection = false;
            $tp->grossAmt = 0.00;
            $tp->netAmt   = 0.00;
            $tp->discount = 0.00;
            $tp->tax = 0.00;
            
            $od =  new \stdClass();
            $od->selection = false;
            $od->title = "Motor Own Damage";
            $od->code = "OD";
            $od->grossAmt = 0.00;
            $od->netAmt   = 0.00;
            $od->discount = 0.00;
            $od->tax = 0.00;
            
            $pa_od =  new \stdClass();
            $pa_od->title = "PA(Personal Accident) Owner Driver";
            $pa_od->code = "PA_OWNER";
            $pa_od->insuredValue  = 100000;
            $pa_od->selection = false;
            $pa_od->grossAmt = 0.00;
            $pa_od->netAmt   = 0.00;
            $pa_od->discount = 0.00;
            $pa_od->tax = 0.00;
            
            $pa_un_pass =  new \stdClass();
            $pa_un_pass->title = "PA cover for Unnamed Passenger";
            $pa_un_pass->code  = "PA_UNNAMMED_PASS";
            $pa_un_pass->insured  = 1;
            $pa_un_pass->insuredValue  = 100000;
            $pa_un_pass->selection = false;
            $pa_un_pass->grossAmt = 0.00;
            $pa_un_pass->netAmt   = 0.00;
            $pa_un_pass->discount = 0.00;
            $pa_un_pass->tax = 0.00;
            
            $pa_paid_driver =  new \stdClass();
            $pa_paid_driver->title = "PA cover for Paid Driver";
            $pa_paid_driver->code  = "PA_PAID_DRIVER";
            $pa_paid_driver->insured  = 1;
            $pa_paid_driver->insuredValue  = 100000;
            $pa_paid_driver->selection = false;
            $pa_paid_driver->grossAmt = 0.00;
            $pa_paid_driver->netAmt   = 0.00;
            $pa_paid_driver->discount = 0.00;
            $pa_paid_driver->tax = 0.00;
            
            $ll_un_pass =  new \stdClass();
            $ll_un_pass->title = "Legal Liability to Unnamed passenger";
            $ll_un_pass->code  = "LL_UN_PASS";
            $ll_un_pass->insured  = 1;
            $ll_un_pass->selection = false;
            $ll_un_pass->grossAmt = 0.00;
            $ll_un_pass->netAmt   = 0.00;
            $ll_un_pass->discount = 0.00;
            $ll_un_pass->tax = 0.00;
            
            $ll_emp =  new \stdClass();
            $ll_emp->title = "Legal Liability to Employees";
            $ll_emp->code  = "LL_EMP";
            $ll_emp->insured  = 1;
            $ll_emp->selection = false;
            $ll_emp->grossAmt = 0.00;
            $ll_emp->netAmt   = 0.00;
            $ll_emp->discount = 0.00;
            $ll_emp->tax = 0.00;
            
            $ll_paid_driver =  new \stdClass();
            $ll_paid_driver->title = "Legal Liability to Paid Driver";
            $ll_paid_driver->code  = "LL_PAID_DRIVER";
            $ll_paid_driver->insured  = 1;
            $ll_paid_driver->selection = false;
            $ll_paid_driver->grossAmt = 0.00;
            $ll_paid_driver->netAmt   = 0.00;
            $ll_paid_driver->discount = 0.00;
            $ll_paid_driver->tax = 0.00;
            
            $discount = new \stdClass();
            $discounts = [];$totalDis =0;
             //print_r($data);
            $addons = []; $totalgrossAmt = 0;$totalnetAmt = 0;$totalTax=0;
            $contracts = $data->Policy->NewDataSet->Table1;
            foreach($contracts as $cover){
               
                if($cover->Code=="IDV" && $cover->Type=='TP'){
                      $tp->selection = true;
                      $tp->grossAmt  = trim($cover->BOValue);
                      $tp->netAmt    = trim($cover->BOValue);
                     // $totalnetAmt = $totalnetAmt+trim($cover->BOValue);
                }
                
               if($cover->Code=="Gross Premium" && $cover->Type=='OD'){
                         $od->selection = true;
                         $od->grossAmt = trim($cover->BOValue);
                         $od->netAmt   = trim($cover->BOValue);
                        // $totalnetAmt = $totalnetAmt+trim($cover->BOValue);
                        
                }
                
                if($cover->Code=="CPA" && trim($cover->Type)=='TP'){
                    
                     $pa_od->selection = true;
                     $pa_od->grossAmt = trim($cover->BOValue);
                     $pa_od->netAmt   = trim($cover->BOValue);
                    // $totalgrossAmt = $totalgrossAmt+trim($cover->BOValue);
                    // $totalnetAmt = $totalnetAmt+trim($cover->BOValue);
                       
                }
                
                if($cover->Code=="APA" && trim($cover->Type)=='TP'){
                    $pa_un_pass->selection =true;
                    $pa_un_pass->insured = 1; 
                    $pa_un_pass->grossAmt =  trim($cover->BOValue);
                    $pa_un_pass->netAmt   =  trim($cover->BOValue);
                }
                
                
                
                 if($cover->Code=="LLDE" && trim($cover->Type)=='TP'){
                    $ll_paid_driver->selection =true;
                    $ll_paid_driver->insured = 1; 
                    $ll_paid_driver->grossAmt =  trim($cover->BOValue);
                    $ll_paid_driver->netAmt   =  trim($cover->BOValue);
                }
                
                if($cover->Code=="LLOE" && trim($cover->Type)=='TP'){
                    $ll_emp->selection =true;
                    $ll_emp->insured = 1; 
                    $ll_emp->grossAmt =  trim($cover->BOValue);
                    $ll_emp->netAmt   =  trim($cover->BOValue);
                }
                
                if($cover->Code=="PrmDue" && trim($cover->Type)=='TP'){
                    
                     $tp->grossAmt = trim($cover->BOValue);
                     $totalgrossAmt = $totalgrossAmt+trim($cover->BOValue);
                       
                }
                
                 if($cover->Code=="PrmDue" && trim($cover->Type)=='OD'){
                    
                     $od->grossAmt = trim($cover->BOValue);
                     $totalgrossAmt = $totalgrossAmt+trim($cover->BOValue);
                       
                }
                
                if($cover->Code=="ServTax" && trim($cover->Type)=='TP'){
                    
                     $tp->tax = trim($cover->BOValue);
                     $totalTax = $totalTax+trim($cover->BOValue);
                       
                }
                
                 if($cover->Code=="ServTax" &&trim($cover->Type)=='OD'){
                    
                     $od->tax = trim($cover->BOValue);
                     $totalTax = $totalTax+trim($cover->BOValue);
                       
                }
                
                if($cover->Code=="00001" && trim($cover->Type)=='OD'){
                   $eachAddon =   new \stdClass();
                   $eachAddon->title   = "Tyre Protect";
                   $eachAddon->code    = "00001";
                   $eachAddon->insured = 0; 
                   $eachAddon->grossAmt= trim($cover->BOValue);
                   $eachAddon->netAmt  = trim($cover->BOValue);
                   array_push($addons,$eachAddon);
                }
                
                if($cover->Code=="ENGPR" && trim($cover->Type)=='OD'){
                   $eachAddon =   new \stdClass();
                   $eachAddon->title   = "Engine and Gear Box Protect";
                   $eachAddon->code    = "ENGPR";
                   $eachAddon->insured = 0; 
                   $eachAddon->grossAmt= trim($cover->BOValue);
                   $eachAddon->netAmt  = trim($cover->BOValue);
                   array_push($addons,$eachAddon);
                }
                if($cover->Code=="PLAN1" && trim($cover->Type)=='OD'){
                   $eachAddon =   new \stdClass();
                   $eachAddon->title   = "Zero Dep";
                   $eachAddon->code    = "PLAN1";
                   $eachAddon->insured = 0; 
                   $eachAddon->grossAmt= trim($cover->BOValue);
                   $eachAddon->netAmt  = trim($cover->BOValue);
                   array_push($addons,$eachAddon);
                }
                
                if($cover->Code=="NCB" && trim($cover->Type)=='OD'){ 
                     $eachDis =   new \stdClass();
                     $eachDis->type    = "NCB_DISCOUNT";
                     $eachDis->amount  = trim($cover->BOValue);
                     $eachDis->percent = $preInfo->ncbNew;
                     array_push($discounts,$eachDis);
                     $totalDis+= trim($cover->BOValue);
                }
                
                 if($cover->Code=="ZODEP" && trim($cover->Type)=='OD'){ 
                       $eachAddon =   new \stdClass();
                       $eachAddon->title   = $cover->Description;
                       $eachAddon->code    = $cover->Code;
                        $eachAddon->grossAmt= trim($cover->BOValue);
                       $eachAddon->netAmt  = trim($cover->BOValue);
                       array_push($addons,$eachAddon);
                 }
                 if($cover->Code=="CONSM" && trim($cover->Type)=='OD'){ 
                       $eachAddon =   new \stdClass();
                       $eachAddon->title   = $cover->Description;
                       $eachAddon->code    = $cover->Code;
                        $eachAddon->grossAmt= trim($cover->BOValue);
                       $eachAddon->netAmt  = trim($cover->BOValue);
                       array_push($addons,$eachAddon);
                 }
                 
                 if($cover->Code=="RODSA" && trim($cover->Type)=='OD'){ 
                       $eachAddon =   new \stdClass();
                       $eachAddon->title   = $cover->Description;
                       $eachAddon->code    = $cover->Code;
                        $eachAddon->grossAmt= trim($cover->BOValue);
                       $eachAddon->netAmt  = trim($cover->BOValue);
                       array_push($addons,$eachAddon);
                 }
                
                if($cover->Code=="DISCPERC" && trim($cover->Type)=='OD'){ 
                     $additionalBenefitDiscount =  trim($cover->BOValue);
                }
                
            }
            
            $covers = new \stdClass();
            $covers->od = $od;
            $covers->tp = $tp;
            $covers->pa_owner = $pa_od;
            $covers->pa_driver = $pa_paid_driver;
            $covers->pa_passanger = $pa_un_pass;
            $covers->ll_passanger = $ll_un_pass;
            $covers->ll_driver = $ll_paid_driver;
            $covers->ll_emp = $ll_emp;
            $covers->addons = $addons;
            
            
            
            
                
             
            // if(isset($data->discounts->otherDiscounts)){
            //      foreach($data->discounts->otherDiscounts as $dis){
            //          $amt = trim(str_replace('INR', '',$dis->discountAmount));
            //          if($amt>0){
            //              $eachDis =   new \stdClass();
            //              $eachDis->type   = $dis->discountType;
            //              $eachDis->amount = $amt;
            //              $eachDis->percent = $dis->discountPercent;
            //              array_push($discounts,$eachDis);
            //              $totalDis+= $amt;
            //          }
            //      }
            //  }
            //  if(isset($data->specialDiscountAmount)){ 
            //      $spdisamt = trim(str_replace('INR', '',$data->specialDiscountAmount));
            //      if($spdisamt>0){
            //          $eachDis =   new \stdClass();
            //          $eachDis->type   = "SPECIAL_DISCOUNT";
            //          $eachDis->amount = $dis->discountAmount;
            //          array_push($discounts,$eachDis);
            //          $totalDis+= $spdisamt;
            //      }
            //  }
             
             
            $discount->discounts = $discounts;
            $discount->total = $totalDis;
             
            $obj = new \stdClass();
            $obj->covers = $covers;
            $obj->gross =  trim($totalgrossAmt);
            $obj->net   =  trim($totalgrossAmt-$totalTax);
            $obj->tax   =  trim($totalTax);
            $obj->idv   =  $data->Policy->VehicleIDV;
            $obj->discount=  $discount;
            $obj->additionalBenefitDiscount  =  $additionalBenefitDiscount;
            //customer
            // $customer = new \stdClass(); 
            // $customer->name ="";
            // $customer->mobile ="";
            // $customer->email ="";
            // $customer->dob ="";
            
            // $obj->customer = $customer;
            
            // $supplier = new \stdClass(); 
            // $supplier->id =6;
            // $supplier->name ="Future Generali Insurance";
            // $supplier->short ="FGI";
            // $supplier->logo ="https://general.futuregenerali.in/img/logo.png";
            // $obj->supplier = $supplier;
            
            // //vehicle
            // $RTO = substr($options['carnumber'],0,4);
            $vehicle = new \stdClass(); 
            // $vehicle->make =$options['vehicle']['brand']['name'];
            // $vehicle->model =$options['vehicle']['model']['name'];
            // $vehicle->varient =$options['vehicle']['varient']['name'];
            // $vehicle->code = "";
            // $vehicle->rto =$options['vehicle']['rtoCode'];
            // $vehicle->rto_no = $options['vehicle']['rtoCode'];
            // $vehicle->reg_date = date('d').'-'.$options['vehicle']['regMonth']."-".$options['regYear'];
            // $vehicle->chassis_no = '';
            // $vehicle->engin_no = '';
             $vehicle->newNCB = $preInfo->ncbNew;
             $vehicle->idv =$data->Policy->VehicleIDV;
            // $vehicle->minIdv =$data->Policy->VehicleIDV;
            // $vehicle->maxIdv =$data->Policy->VehicleIDV;
             $obj->vehicle = $vehicle;
            
            return $obj;
    }
    
     function GetPreviousPolicyData($params,$callTyp){
          
            $res =  new \stdClass();
            $res->isExp = false;
            $res->expDate = "";
            $res->ncb = "ZERO";
            $res->ncbPercent =0;
            $res->prePolicyType = "";
            $res->isPreviousInsurerKnown = false;
            $res->hasPreClaim ="N";
            $res->preInsurerCode = "";
            $res->businessType   = "Rollover";
            $res->prePolicyNo ="";
            $res->isRollover ="Y";
            $res->isUsed ="N";
            $res->isNew = 'N';
            $res->startDate = "";
            $res->ChassisNumber = getRandomStr(17);
            $res->EngineNumber  = getRandomStr(10);
            
             $ncbArr = ["ZERO"=>0,'TWENTY'=>20,'TWENTY_FIVE'=>25,'THIRTY_FIVE'=>35,'FORTY_FIVE'=>45,'FIFTY'=>50];
            
            if($params['vehicle']['isBrandNew']==='false'){ 
                if(isset($params['previousInsurance']['isExp']) && $params['previousInsurance']['isExp']!=""){ 
                         
                         if($params['previousInsurance']['isExp']=="Not Expired"){ //Not Expired 
                              $res->businessType ="Rollover";
                              $res->isRollover ="Y";
                              $res->isUsed ="N";
                               if($callTyp=="Proposal"){
                                    $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('Y-m-d');
                              }else{
                                  
                                   if($params['previousInsurance']['expDate']!=""){
                                         $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('Y-m-d');
                                    }else{
                                         $res->expDate =date('Y-m-d', strtotime('+10 days'));
                                    }
                                    
                                }
                              $res->startDate = Carbon::createFromFormat('Y-m-d', $res->expDate)->addDays()->format('Y-m-d');  
                              $res->prePolicyType = !empty($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):"Comprehensive"; 
                              if($res->prePolicyType=="ThirdParty"){
                                    $res->ncb = "ZERO";//isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                     $res->hasPreClaim = 'Y';//($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                               }else{
                                     $res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                     $res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"Y":"N";
                               }
                              $res->isPreviousInsurerKnown = true;
                         }else if($params['previousInsurance']['isExp']=="Expired"){
                             if($params['previousInsurance']['exp']=="+90"){ 
                                       if($callTyp=="Proposal"){
                                          $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('d/m/Y');
                                         
                                       }else{
                                          
                                            if($params['previousInsurance']['expDate']!=""){
                                                 $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('d/m/Y');
                                            }else{
                                                 $res->expDate =date('d/m/Y', strtotime('-100 days'));
                                            }
                                       }
                                       $res->startDate = Carbon::now()->addDays(3)->format('Y-m-d');//Carbon::createFromFormat('d/m/Y', $res->expDate)->addDays()->format('Y-m-d');  
                                       $res->prePolicyType = !empty($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):"Comprehensive";
                                       if($res->prePolicyType=="ThirdParty"){
                                            $res->ncb = "ZERO";//isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                            $res->hasPreClaim = 'Y';//($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                                       }else{
                                             $res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                             $res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"Y":"N";
                                       }
                                      
                                       $res->isPreviousInsurerKnown = true;
                                       $res->businessType   = "Rollover";$res->isRollover ="N";$res->isUsed ="Y";
                             }else if($params['previousInsurance']['exp']=="45-90"){
                                      if($callTyp=="Proposal"){
                                           $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('d/m/Y');
                                        
                                       }else{
                                            
                                             if($params['previousInsurance']['expDate']!=""){
                                                 $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('d/m/Y');
                                            }else{
                                                $res->expDate = date('d/m/Y', strtotime('-60 days'));
                                            }
                                       }
                                      $res->startDate = Carbon::now()->addDays(3)->format('Y-m-d');//Carbon::createFromFormat('d/m/Y', $res->expDate)->addDays()->format('Y-m-d');  
                                      $res->prePolicyType = !empty($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):"Comprehensive";
                                       if($res->prePolicyType=="ThirdParty"){
                                            $res->ncb = "ZERO";
                                             $res->hasPreClaim = 'Y';
                                       }else{
                                             $res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                             $res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"Y":"N";
                                       }
                                    
                                      $res->isPreviousInsurerKnown = true;
                                      $res->businessType   = "Rollover"; $res->isRollover ="N";$res->isUsed ="Y";
                             }else if($params['previousInsurance']['exp']=="-45"){
                                      if($callTyp=="Proposal"){
                                           $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('d/m/Y');
                                       }else{
                                            if($params['previousInsurance']['expDate']!=""){
                                                 $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('d/m/Y');
                                            }else{
                                                 $res->expDate = date('d/m/Y', strtotime('-25 days'));
                                            }
                                       }
                                       $res->startDate = Carbon::now()->addDays(3)->format('Y-m-d');//Carbon::createFromFormat('d/m/Y', $res->expDate)->addDays()->format('Y-m-d');  
                                       $res->prePolicyType = !empty($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):"Comprehensive";
                                       if($res->prePolicyType=="ThirdParty"){
                                            $res->ncb = "ZERO";
                                             $res->hasPreClaim = 'Y';
                                       }else{
                                             $res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                             $res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"Y":"N";
                                       }
                                      $res->isPreviousInsurerKnown = true;
                                      $res->businessType   = "Rollover"; $res->isRollover ="N";$res->isUsed ="Y";
                             }else if($params['previousInsurance']['exp']=="0"){ 
                                      $res->expDate = "";
                                      $res->ncb = "ZERO";	
                                      $res->hasPreClaim="Y";
                                      $res->isPreviousInsurerKnown = false;
                                      $res->businessType   = "USED"; $res->isRollover ="N";$res->isUsed ="Y";
                                      $res->startDate = Carbon::now()->addDays(3)->format('Y-m-d');//date('Y-m-d', strtotime('+1 days'));
                             }
                         }
                }else{  //exp data not avialble
                    $res->expDate = "";
                    $res->ncb = "ZERO";	
                    $res->hasPreClaim="N";
                    $res->isPreviousInsurerKnown = false;
                    $res->businessType   = "NEW";$res->isNew = 'Y';$res->isRollover ="N";$res->isUsed ="N";
                    $res->startDate = date('Y-m-d', strtotime('+1 days'));
                }
            }else{ // new
                $res->expDate = "";
                $res->ncb = "ZERO";	
                $res->hasPreClaim="N";
                $res->isPreviousInsurerKnown = false;
                $res->businessType   = "NEW";$res->isNew = 'Y';$res->isRollover ="N";$res->isUsed ="N";
                $res->startDate = date('Y-m-d', strtotime('+1 days'));
            }
            
            if(isset($params['previousInsurance']['insurer']) && $params['previousInsurance']['insurer']!="0"){
                if($res->businessType!="NEW")
                $res->preInsurerCode = DB::table('previous_insurer')->where('id', $params['previousInsurance']['insurer'])->value('name');
            }else{ 
                if($res->businessType!="NEW")
                $res->preInsurerCode = DB::table('previous_insurer')->where('type', 'GENERAL')->inRandomOrder()->limit(1)->value('name');
            }
            if($params['previousInsurance']['policyType']=='TP'){
                $res->ncbPercent =0; 
            }else{
                $res->ncbPercent =$ncbArr[$res->ncb]; 
            }
            
            if($callTyp=="Proposal"){
                  
                  $res->prePolicyNo = !empty($params['previousInsurance']['policyNo'])?$params['previousInsurance']['policyNo']:"";
                  
            }
             $ncbArrayNew = ['ZERO'=>20,'TWENTY'=>25,'TWENTY_FIVE'=>35,'THIRTY_FIVE'=>45,'FORTY_FIVE'=>50,'FIFTY'=>50];
             $res->ncbNew = ($res->isRollover!='Y' || $res->hasPreClaim=='Y')?0:$ncbArrayNew[$res->ncb];
              
            
             if(isset($params['vehicle']['chassisNumber'])){
                 $res->ChassisNumber =   ($params['vehicle']['chassisNumber']!="")?$params['vehicle']['chassisNumber']:getRandomStr(17);
             }
             if(isset($params['vehicle']['engineNumber'])){
                 $res->EngineNumber = ($params['vehicle']['engineNumber']!="")?$params['vehicle']['engineNumber']:getRandomStr(10);
             }
           
             
            return $res;
                                      
    }
    
     function fnQuoteRequest($params){
         $chars = date('Ymd').time();
         $uid = str_shuffle(substr(str_shuffle($chars), 0, 10));
         $preInfo = $this->GetPreviousPolicyData($params,"Premium");
        //print_r($preInfo);die;
         $productCode = $this->productCode(strtoupper($params['planType']."-".$preInfo->businessType));
        // $productCode = $this->productCode("COM-ROLLOVER");
         $make=($params['vehicle']['brand']['name'])?trim($params['vehicle']['brand']['name']):null;
         $model = ($params['vehicle']['model']['name'])?$params['vehicle']['model']['name']:null;
         $varient = ($params['vehicle']['varient']['name'])?$params['vehicle']['varient']['name']:null;
         $regionCode = $params['vehicle']['rtoCode'];
         $registrationDate=date('d').'/'.$params['vehicle']['regMonth'].'/'.$params['vehicle']['regYear'];
        
         
         //$expDate = createFormatDate($params['previousInsurance']['expDate'],'d-m-Y','d/m/Y');
        // $startDate = Carbon::createFromFormat('d/m/Y', $params['previousInsurance']['expDate'])->addDays()->format('Y-m-d');
        $damiPolicyNo = getRandomStr(12);
        if($params['vehicle']['isBrandNew']==='false'){ 
            $period = $this->timePeriod('d/m/Y',1 ,$preInfo->startDate);
         }else{
             if($productCode->cover=="OD"){ 
                 $period = $this->timePeriod('d/m/Y',1 );
             }else{
                 $period = $this->timePeriod('d/m/Y',3 );
             }
             $damiPolicyNo ="";
         }
         
         $TPStartDate="";
         $TPEndDate ="";
         $TPInsurer ="";
         $TPpolicyNo ="";
          if($params['planType']=="SAOD"){
             
            $TPStartDate = isset($params['TP']['TPpolicyStartDate'])?Carbon::createFromFormat('d-m-Y',$params['TP']['TPpolicyStartDate'])->format('d/m/Y'):"";
            $TPEndDate   = isset($params['TP']['TPpolicyEndDate'])?Carbon::createFromFormat('d-m-Y',$params['TP']['TPpolicyEndDate'])->format('d/m/Y'):"";
            $TPInsurer   = isset($params['TP']['TPInsurer'])?DB::table('previous_insurer')->where('id', $params['TP']['TPInsurer'])->value('name'):"";
            $TPpolicyNo  = isset($params['TP']['TP_policyno'])?$params['TP']['TP_policyno']:"";
          }
         $rto_master=DB::table('rtoMaster')->select('rtoMaster.rtoCode as rtoCode','cities.name as cityName','cities.id as cityId','states.name as stateName',
                                                    'states.id as stateId')
                                                ->where('rtoCode',strtoupper($params['vehicle']['rtoCode']))
                                                ->leftJoin('cities', 'cities.id', '=', 'rtoMaster.city_id')
                                                ->leftJoin('states', 'states.id', '=', 'cities.state_id')->first();
       
         $adrsData = DB::table('pincode_masters')->where('pincode',$params['vehicle']['regPincode'])->first();
         $var = DB::table('vehicle_variant_car')->where('id',$params['vehicle']['varient']['id'])->first();
         //print_r($params['vehicle']['varient']['id']);die;
        // $adrsData = DB::table('pincode_masters')->where('city_id',$rto_master->cityId)->first();
         
         $pincode =  isset($params['vehicle']['regPincode'])?$params['vehicle']['regPincode']:'';
         $_city   =  isset($adrsData->District)?strtoupper($adrsData->District):'';
         $_state  =  isset($adrsData->State)?strtoupper($adrsData->State):'';
         $fuel = "P";
         switch (strtolower($var->fuel_type)) {
            case "petrol":$fuel =  "P";break;
            case "diesel":$fuel =  "D";break;
            case "cng": $fuel =  "C";break;
            default:$fuel =  "P";
        }
        
       
            $ROOT = "<Root>
                    	<Uid>".$uid."</Uid>
                    	<VendorCode>".config('motor.FGI.car.vendorCode')."</VendorCode>
                    	<VendorUserId>".config('motor.FGI.car.vendorName')."</VendorUserId>
                    	<PolicyHeader>
                    		<PolicyStartDate>".$period->startDate."</PolicyStartDate> 
                            <PolicyEndDate>".$period->endDate."</PolicyEndDate>
                    		<AgentCode>".config('motor.FGI.car.AgentCode')."</AgentCode>
                    		<BranchCode>".config('motor.FGI.car.BranchCode')."</BranchCode>
                    		<MajorClass>MOT</MajorClass>
                    		<ContractType>".$productCode->contract."</ContractType>
                    		<METHOD>ENQ</METHOD>
                    		<PolicyIssueType>I</PolicyIssueType>
                    		<PolicyNo></PolicyNo>
                    		<ClientID></ClientID>
                    		<ReceiptNo></ReceiptNo>
                    	</PolicyHeader>
                    	<POS_MISP>
		                   <Type></Type>
		                   <PanNo></PanNo>
	                    </POS_MISP>
                    	<Client>
                    		<ClientType></ClientType>
                    		<CreationType></CreationType>
                    		<Salutation></Salutation>
                    		<FirstName></FirstName>
                    		<LastName></LastName>
                    		<DOB></DOB>
                    		<Gender></Gender>
                    		<MaritalStatus></MaritalStatus>
                    		<Occupation>SVCM</Occupation>
                    		<PANNo></PANNo>
                    		<GSTIN></GSTIN>
                    		<AadharNo></AadharNo>
                    		<CKYCNo></CKYCNo>
                    		<EIANo></EIANo>
                    		<Address1>
                    			<AddrLine1></AddrLine1>
                    			<AddrLine2></AddrLine2>
                    			<AddrLine3></AddrLine3>
                    			<Landmark></Landmark>
                    			<Pincode></Pincode>
                    			<City></City>
                    			<State></State>
                    			<Country>IND</Country>
                    			<AddressType>R</AddressType>
                    			<HomeTelNo></HomeTelNo>
                    			<OfficeTelNo></OfficeTelNo>
                    			<FAXNO></FAXNO>
                    			<MobileNo></MobileNo>
                    			<EmailAddr></EmailAddr>
                    		</Address1>
                    		<Address2>
                    			<AddrLine1></AddrLine1>
                    			<AddrLine2></AddrLine2>
                    			<AddrLine3></AddrLine3>
                    			<Landmark></Landmark>
                    			<Pincode></Pincode>
                    			<City></City>
                    			<State></State>
                    			<Country>IND</Country>
                    			<AddressType></AddressType>
                    			<HomeTelNo></HomeTelNo>
                    			<OfficeTelNo></OfficeTelNo>
                    			<FAXNO></FAXNO>
                    			<MobileNo></MobileNo>
                    			<EmailAddr></EmailAddr>
                    		</Address2>
                         	<VIPFlag>N</VIPFlag>
                    	    <VIPCategory></VIPCategory>
                    	</Client>
                    	<Receipt>
                    		<UniqueTranKey></UniqueTranKey>
                    		<CheckType></CheckType>
                    		<BSBCode></BSBCode>
                    		<TransactionDate></TransactionDate>
                    		<ReceiptType></ReceiptType>
                    		<Amount></Amount>
                    		<TCSAmount></TCSAmount>
                    		<TranRefNo></TranRefNo>
                    		<TranRefNoDate></TranRefNoDate>
                    	</Receipt>
	                    <Risk>
                    		<RiskType>".$productCode->risk."</RiskType>
                    		<Zone>A</Zone>
                    		<Cover>".$productCode->cover."</Cover>
                    		<Vehicle>
                    			<TypeOfVehicle></TypeOfVehicle>
                    			<VehicleClass></VehicleClass>
                    			<RTOCode>".$regionCode."</RTOCode>
                    			<Make>".strtoupper($make)."</Make>
                    			<ModelCode>".$var->fgi_code."</ModelCode>
                    			<RegistrationNo>{{RegistrationNo}}</RegistrationNo>
                    			<RegistrationDate>".$registrationDate."</RegistrationDate>
                    			<ManufacturingYear>".clean_str($params['vehicle']['regYear'])."</ManufacturingYear>
                    			<FuelType>".$fuel."</FuelType>
                    			<CNGOrLPG>
                    				<InbuiltKit>N</InbuiltKit>
                    				<IVDOfCNGOrLPG></IVDOfCNGOrLPG>
                    			</CNGOrLPG>
                    			<BodyType>SALOON</BodyType>
                    			<EngineNo>".$preInfo->EngineNumber."</EngineNo>
                    			<ChassiNo>".$preInfo->ChassisNumber."</ChassiNo>
                    			<CubicCapacity>".$var->cubic_capacity."</CubicCapacity>
                    			<SeatingCapacity>".$var->seating_capacity."</SeatingCapacity>
                    			<IDV>{{IDV}}</IDV>
                    			<GrossWeigh></GrossWeigh>
                    			<CarriageCapacityFlag></CarriageCapacityFlag>
                    			<ValidPUC>Y</ValidPUC>
                    			<TrailerTowedBy></TrailerTowedBy>
                    			<TrailerRegNo></TrailerRegNo>
                    			<NoOfTrailer></NoOfTrailer>
                    			<TrailerValLimPaxIDVDays></TrailerValLimPaxIDVDays>
                    	     	<TrailerChassisNo></TrailerChassisNo>
                    	    	<TrailerMfgYear></TrailerMfgYear>
                    	    	<SchoolBusFlag></SchoolBusFlag>
                    		</Vehicle>
                    		<InterestParty>
                    			<Code></Code>
                    			<BankName></BankName>
                    		</InterestParty>
                    		<AdditionalBenefit>
                    			<Discount>0.00000</Discount>
                    			<ElectricalAccessoriesValues></ElectricalAccessoriesValues>
                    			<NonElectricalAccessoriesValues></NonElectricalAccessoriesValues>
                    			<FibreGlassTank></FibreGlassTank>
                    			<GeographicalArea></GeographicalArea>
                    			<PACoverForUnnamedPassengers>{{isPA_UNPassCover}}</PACoverForUnnamedPassengers>
                    			<LegalLiabilitytoPaidDriver>{{isLL_PaidDriverCover}}</LegalLiabilitytoPaidDriver>
                    			<LegalLiabilityForOtherEmployees>{{isLL_EmpCover}}</LegalLiabilityForOtherEmployees>
                    			<LegalLiabilityForNonFarePayingPassengers></LegalLiabilityForNonFarePayingPassengers>
                    			<UseForHandicap></UseForHandicap>
                    			<AntiThiefDevice></AntiThiefDevice>
                    			<NCB>".$preInfo->ncbNew."</NCB>
                    			<RestrictedTPPD></RestrictedTPPD>
                    			<PrivateCommercialUsage></PrivateCommercialUsage>
                    			<CPAYear>{{CPAYear}}</CPAYear>
                    			<CPADisc></CPADisc>
                    			<IMT23></IMT23>
                    			<CPAReq>{{CPAReq}}</CPAReq>
                    			<CPA>
                    				<CPANomName>{{CPANomName}}</CPANomName>
                                    <CPANomAge>{{CPANomAge}}</CPANomAge>
                                    <CPANomAgeDet>{{CPANomAgeDet}}</CPANomAgeDet>
                                    <CPANomPerc>{{CPANomPerc}}</CPANomPerc>
                                    <CPARelation>{{CPARelation}}</CPARelation>
                    				<CPAAppointeeName></CPAAppointeeName>
                    				<CPAAppointeRel></CPAAppointeRel>
                    			</CPA>
                    			<NPAReq>N</NPAReq>
                    			<NPA>
                    				<NPAName></NPAName>
                    				<NPALimit></NPALimit>
                    				<NPANomName></NPANomName>
                    				<NPANomAge></NPANomAge>
                    				<NPANomAgeDet></NPANomAgeDet>
                    				<NPARel></NPARel>
                    				<NPAAppinteeName></NPAAppinteeName>
                    				<NPAAppinteeRel></NPAAppinteeRel>
                    			</NPA>
                        		<ZNCBRSRCV></ZNCBRSRCV>
                        		<ZNOFEMPLY></ZNOFEMPLY>
                        		<ZLMTPERPD></ZLMTPERPD>
                        		<ZADDLPAPD></ZADDLPAPD>
                        		<ZTPPER></ZTPPER>
                        		<ZCMPTPPA></ZCMPTPPA>
                        		<ZLMTTPPD></ZLMTTPPD>
                        		<ZPREMISE></ZPREMISE>
                        		<ZVINTAGE></ZVINTAGE>
                        		<XCESSLAB></XCESSLAB>
                        		<XCESCDE></XCESCDE>
                        		<ZSCARSI></ZSCARSI>
                        		<ZSCARIND></ZSCARIND>
                        		<ZAANO></ZAANO>
                        		<ZEMBASSY></ZEMBASSY>
                        		<ZSPECRAL></ZSPECRAL>
                        		<ZRALTRAIL></ZRALTRAIL>
                        		<ZDRVTTN></ZDRVTTN>
                        		<EXPDTE></EXPDTE>
                        		<ZOVRTFLG></ZOVRTFLG>
                        		<ZIMT44ID></ZIMT44ID>
                        		<ZPAPDPRM></ZPAPDPRM>
                        		<ZNOPPM></ZNOPPM>
                        		<ZIMT34ID></ZIMT34ID>
                        	</AdditionalBenefit>
                    		<AddonReq>{{HAS_ADDONS}}</AddonReq>
                    		{{ADDONS}}
                    		<PreviousTPInsDtls>
                    			<PreviousInsurer>".$TPInsurer."</PreviousInsurer>
                    			<TPPolicyNumber>".$TPpolicyNo."</TPPolicyNumber>
                    			<TPPolicyEffdate>".$TPStartDate."</TPPolicyEffdate>
                    			<TPPolicyExpiryDate>".$TPEndDate."</TPPolicyExpiryDate>
                    		</PreviousTPInsDtls>
                    		<PreviousInsDtls>
                    			<UsedCar>".$preInfo->isUsed."</UsedCar>
                    			<UsedCarList>
                    				<PurchaseDate>".$registrationDate."</PurchaseDate>
                    				<InspectionRptNo></InspectionRptNo>
                    				<InspectionDt></InspectionDt>
                    			</UsedCarList>
                    			<RollOver>".$preInfo->isRollover."</RollOver>
                    			<RollOverList>
                    			    <PolicyNo>".$damiPolicyNo."</PolicyNo>
                                    <InsuredName>".$preInfo->preInsurerCode."</InsuredName>
                    				<PreviousPolExpDt>".$preInfo->expDate."</PreviousPolExpDt>
                    				<ClientCode>40062645</ClientCode>
                    				<Address1>".$_city."</Address1>
                    				<Address2>".$_city."</Address2>
                    				<Address3>".$_city."</Address3>
                    				<Address4>".$_city."</Address4>
                    				<Address5>".$_state."</Address5>
                    				<PinCode>".$pincode."</PinCode>
                    				<InspectionRptNo></InspectionRptNo>
                    				<InspectionDt></InspectionDt>
                    				<NCBDeclartion>".$preInfo->hasPreClaim."</NCBDeclartion>  
                    				<ClaimInExpiringPolicy>".$preInfo->hasPreClaim."</ClaimInExpiringPolicy>
                    				<NCBInExpiringPolicy>".$preInfo->ncbPercent."</NCBInExpiringPolicy>
                    		   	    <PreviousPolStartDt></PreviousPolStartDt>
                    			    <TypeOfDoc></TypeOfDoc>
                    			    <NoOfClaims></NoOfClaims>
                    			</RollOverList>
                    			<NewVehicle>".$preInfo->isNew."</NewVehicle>
                    			<NewVehicleList>
                    				<InspectionRptNo></InspectionRptNo>
                    				<InspectionDt></InspectionDt>
                    			</NewVehicleList>
                    		</PreviousInsDtls>
                        	<ZLLOTFLG></ZLLOTFLG>
                        	<GARAGE></GARAGE>
                        	<ZREFRA></ZREFRA>
                        	<ZREFRB></ZREFRB>
                        	<ZIDVBODY></ZIDVBODY>
                        	<COVERNT></COVERNT>
                        	<CNTISS></CNTISS>
                        	<ZCVNTIME></ZCVNTIME>
                        	<AddressSeqNo></AddressSeqNo>
                    	</Risk>
                   </Root>";


 return $ROOT;
              
    }
    
     function getQuickQuote($deviceToken,$options){
        $XML =  $this->fnQuoteRequest($options);
        $preInfo = $this->GetPreviousPolicyData($options,"Premium");
        $subcovers = $options['subcovers'];
        $optionValues = $options['coverValues'];
        
        if((isset($subcovers['isPA_OwnerDriverCover']) && $subcovers['isPA_OwnerDriverCover']=='true')){ 
                  if($options['planType']=="TP" && $preInfo->businessType=="NEW"){
                           $PA_OWNER =3;
                      }else{ 
                           $paCoverVal = isset($optionValues['PA_OwnerDriverCoverval'])?$optionValues['PA_OwnerDriverCoverval']:1;
                           $PA_OWNER = ($preInfo->businessType=="NEW")?$paCoverVal:"";
                      }
                  
              }else{
                  $PA_OWNER ="";
              }
        if($options['planType']!="SAOD" && $options['vehicle']['policyHolder'] == "IND"){      
            $XML = str_replace("{{CPAYear}}",$PA_OWNER,$XML);
            $XML = str_replace("{{CPAReq}}","Y",$XML);
            $XML = str_replace("{{CPANomName}}","Test",$XML);
            $XML = str_replace("{{CPANomAge}}","25",$XML);
            $XML = str_replace("{{CPANomAgeDet}}","Y",$XML);
            $XML = str_replace("{{CPANomPerc}}","100",$XML);
            $XML = str_replace("{{CPARelation}}","BROT",$XML);
        }else{
            $XML = str_replace("{{CPAYear}}","",$XML);
            $XML = str_replace("{{CPAReq}}","N",$XML);
            $XML = str_replace("{{CPANomName}}","",$XML);
            $XML = str_replace("{{CPANomAge}}","",$XML);
            $XML = str_replace("{{CPANomAgeDet}}","",$XML);
            $XML = str_replace("{{CPANomPerc}}","",$XML);
            $XML = str_replace("{{CPARelation}}","",$XML); 
        }
        
       
            $licensePlateNumber =$options['vehicle']['rtoCode']."JK".rand(1231,7879);
             if($options['vehicle']['hasvehicleNumber']=="true"){
                $licensePlateNumber =$options['vehicle']['vehicleNumber'];
             }
            if($options['vehicle']['isBrandNew']==='true'){ 
                $licensePlateNumber = "";
            }
           //  if($preInfo->businessType=="N"){$licensePlateNumber = "NEW";}
        $XML = str_replace("{{RegistrationNo}}",$licensePlateNumber,$XML);
        
        $idv = isset($options['vehicle']['idv']['value'])?$options['vehicle']['idv']['value']:0;
        $XML = str_replace("{{IDV}}",$idv,$XML);
        
        $PA_UNNAMED_PASS = (isset($subcovers['isPA_UNPassCover']) && $subcovers['isPA_UNPassCover']=='true')?$options['coverValues']['PA_UNPassCoverval']:'';
        $XML = str_replace("{{isPA_UNPassCover}}",$PA_UNNAMED_PASS,$XML);
        
        $LL_PaidDriver = (isset($subcovers['isLL_PaidDriverCover']) && $subcovers['isLL_PaidDriverCover']=='true')?"1":"";
        $XML = str_replace("{{isLL_PaidDriverCover}}",$LL_PaidDriver,$XML);
        
        $LL_Emp = (isset($subcovers['isLL_EmpCover']) && $subcovers['isLL_EmpCover']=='true')?"Y":"";
        $XML = str_replace("{{isLL_EmpCover}}",$LL_Emp,$XML);
        $ADDONS="";
        $ADDONS .= (isset($subcovers['isBreakDownAsCover']) && $subcovers['isBreakDownAsCover']=='true')?"<Addon><CoverCode>RODSA</CoverCode></Addon>":"";
        $ADDONS .= (isset($subcovers['isConsumableCover']) && $subcovers['isConsumableCover']=='true')?"<Addon><CoverCode>CONSM</CoverCode></Addon>":"";
        $ADDONS .= (isset($subcovers['isPartDepProCover']) && $subcovers['isPartDepProCover']=='true')?"<Addon><CoverCode>ZODEP</CoverCode></Addon>":"";
        $hasAddons = ($ADDONS!="")?"Y":"N";
        $XML = str_replace("{{HAS_ADDONS}}",$hasAddons,$XML);
        if($hasAddons=="Y"){
            $XML = str_replace("{{ADDONS}}",$ADDONS,$XML);
        }else{
            $XML = str_replace("{{ADDONS}}","<Addon><CoverCode></CoverCode></Addon>",$XML);	
        }
        
        if($options['vehicle']['isBrandNew']==='true' && $options['planType']=="TP"){
             return ['status' =>false, 'plans'=>[],'message' => "Plan nott available"];
        }else{
            
          try {
            $factory = new Factory();
            $client = $factory->create(new Client(), config('motor.FGI.car.QuickQuote')); 
            $result = $client->call('CreatePolicy', [["Product"=>"Motor","XML"=>$XML]]);
            $xml   = simplexml_load_string($result->CreatePolicyResult, 'SimpleXMLElement', LIBXML_NOCDATA);
            $array = json_decode(json_encode((array)$xml), TRUE);
          //  print_r($XML);
           // print_r($result);die;
              
            if(isset($array['Policy'])){
                  $policy = $array['Policy'];
                  $response  = json_decode(json_encode($array));
                if($policy['Status']=="Successful"){
                    $partner = DB::table('our_partners')->where('shortName','FGI')->value('name');
                    $json_data = $this->getJsonData($options,$response,$preInfo);
                    $enq = "QT-FW-".time().mt_rand();
                    
                      $plan['title'] = $partner;
                      $plan['grossamount'] = $json_data->gross;
                      $plan['netamount']   = $json_data->net;
                      $plan['discount']    = 0;
                      $plan['id'] =$enq;
                      $plan['addons'] =  $json_data;
                      $plan['idv'] = $policy['VehicleIDV'];
                      
                      $Inuptxml   = simplexml_load_string($XML, 'SimpleXMLElement', LIBXML_NOCDATA);
                      $Inuptxml = json_decode(json_encode((array)$Inuptxml), TRUE);
                      
                      $quoteData = ['quote_id'=>$enq,'type'=>'CAR','title'=>$partner,
                                    'device'=>$deviceToken,'provider'=>'FGI',
                                    'policyType'=>$options['planType'],
                                    'min_idv'=>$policy['VehicleIDV'],
                                    'max_idv'=>$policy['VehicleIDV'],
                                    'idv'    =>$policy['VehicleIDV'],
                                    'call_type'=>"QUOTE",
                                    'reqQuote'=>json_encode($Inuptxml),
                                    'respQuote'=>json_encode($policy),
                                    'reqRecalculate'=>json_encode($Inuptxml),
                                    'respRecalculate'=>json_encode($policy),
                                    'json_data'=>json_encode($json_data),
                                    'netAmt'=>$json_data->net,
                                    'taxAmt'=>$json_data->tax,
                                    'grossAmt'=>$json_data->gross,
                                    'req'=>json_encode($Inuptxml),
                                    'resp'=>json_encode($policy)];
                        //  print_r($quoteData);die;          
                    $quoteID = DB::table('app_temp_quote')->insertGetId($quoteData);
                    if($quoteID){
                      return ['status'=>true,'plans'=>$plan];
                    }else{
                         return ['status'=>false,'message' => "Internal error",'plans'=>[]];
                    }
                }else{ //Fail
                    return ['status'=>false,'message' => "Connection error",'plans'=>[]];
                }
            }else{
               return ['status'=>false,'message' => "Connection Fail",'plans'=>[]];
            }
            }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
              
                return ['status' => false,'plans'=>[], 'message' => "ConnectException"];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                 return ['status' => false,'plans'=>[], 'message' => 'RequestException'];
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return ['status' =>false, 'plans'=>[],'message' => "ClientException"];
            }catch (ErrorException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return ['status' =>false, 'plans'=>[],'message' => "ErrorException"];
            }
       }
    }
    
     function getRecalulateQuote($deviceToken,$params){
        $preInfo = $this->GetPreviousPolicyData($params,"Premium");
        $XML =  $this->fnQuoteRequest($params);
        $options = $params['subcovers'];
        $_quoteData = DB::table('app_temp_quote')->where(['provider'=>"FGI",'type'=>'BIKE','device'=>$deviceToken])->orderBy('id','desc')->first();  
        
        
        $CPAReq = (isset($options['isPA_OwnerDriverCover']) && $options['isPA_OwnerDriverCover']=='true')?'Y':'N';
        
         $optionValues = $params['coverValues'];
        
        if((isset($options['isPA_OwnerDriverCover']) && $options['isPA_OwnerDriverCover']=='true')){ 
                  if($params['planType']=="TP" && $preInfo->businessType=="NEW"){
                        $PA_OWNER =3;
                      }else{ 
                           $paCoverVal = isset($optionValues['PA_OwnerDriverCoverval'])?$optionValues['PA_OwnerDriverCoverval']:1;
                           $PA_OWNER = ($preInfo->businessType=="NEW")?$paCoverVal:"";
                      }
                  
              }else{
                  $PA_OWNER ="";
              }
        
       if($params['planType']!="SAOD" && $params['vehicle']['policyHolder'] == "IND"){      
            $XML = str_replace("{{CPAYear}}",$PA_OWNER,$XML);
            $XML = str_replace("{{CPAReq}}","Y",$XML);
            $XML = str_replace("{{CPANomName}}","Test",$XML);
            $XML = str_replace("{{CPANomAge}}","25",$XML);
            $XML = str_replace("{{CPANomAgeDet}}","Y",$XML);
            $XML = str_replace("{{CPANomPerc}}","100",$XML);
            $XML = str_replace("{{CPARelation}}","BROT",$XML);
        }else{
            $XML = str_replace("{{CPAYear}}","",$XML);
            $XML = str_replace("{{CPAReq}}","N",$XML);
            $XML = str_replace("{{CPANomName}}","",$XML);
            $XML = str_replace("{{CPANomAge}}","",$XML);
            $XML = str_replace("{{CPANomAgeDet}}","",$XML);
            $XML = str_replace("{{CPANomPerc}}","",$XML);
            $XML = str_replace("{{CPARelation}}","",$XML); 
        }
        
         $licensePlateNumber =$params['vehicle']['rtoCode']."JK".rand(1231,7879);
             if($params['vehicle']['hasvehicleNumber']=="true"){
                $licensePlateNumber =$params['vehicle']['vehicleNumber'];
             }
            if($params['vehicle']['isBrandNew']==='true'){ 
                $licensePlateNumber = "";
            }
        $XML = str_replace("{{RegistrationNo}}",$licensePlateNumber,$XML);
        
        $idv = isset($params['vehicle']['idv']['value'])?$params['vehicle']['idv']['value']:0;
        
        $XML = str_replace("{{IDV}}",$idv,$XML);
        
        $PA_UNNAMED_PASS = (isset($options['isPA_UNPassCover']) && $options['isPA_UNPassCover']=='true')?$params['coverValues']['PA_UNPassCoverval']:'';
        $XML = str_replace("{{isPA_UNPassCover}}",$PA_UNNAMED_PASS,$XML);
        
        $LL_PaidDriver = (isset($options['isLL_PaidDriverCover']) && $options['isLL_PaidDriverCover']=='true')?"1":"";
        $XML = str_replace("{{isLL_PaidDriverCover}}",$LL_PaidDriver,$XML);
        
        $LL_Emp = (isset($options['isLL_EmpCover']) && $options['isLL_EmpCover']=='true')?"Y":"";
        $XML = str_replace("{{isLL_EmpCover}}",$LL_Emp,$XML);
        $ADDONS="";
        $ADDONS .= (isset($options['isBreakDownAsCover']) && $options['isBreakDownAsCover']=='true')?"<Addon><CoverCode>RODSA</CoverCode></Addon>":"";
        $ADDONS .= (isset($options['isConsumableCover']) && $options['isConsumableCover']=='true')?"<Addon><CoverCode>CONSM</CoverCode></Addon>":"";
        $ADDONS .= (isset($options['isPartDepProCover']) && $options['isPartDepProCover']=='true')?"<Addon><CoverCode>ZODEP</CoverCode></Addon>":"";
        $hasAddons = ($ADDONS!="")?"Y":"N";
        $XML = str_replace("{{HAS_ADDONS}}",$hasAddons,$XML);
        if($hasAddons=="Y"){
             $XML = str_replace("{{ADDONS}}",$ADDONS,$XML);
        }else{
             $XML = str_replace("{{ADDONS}}","<Addon><CoverCode></CoverCode></Addon>",$XML);	
        }
       //  echo $XML;
        
       // $url = 'http://fglpg001.futuregenerali.in/BO/Service.svc?wsdl';
        try {
            $factory = new Factory();
            $client = $factory->create(new Client(), config('motor.FGI.car.QuickQuote')); 
            $result = $client->call('CreatePolicy', [["Product"=>"Motor","XML"=>$XML]]);
           
            $xml   = simplexml_load_string($result->CreatePolicyResult, 'SimpleXMLElement', LIBXML_NOCDATA);
            $array = json_decode(json_encode((array)$xml), TRUE);
           // print_r($array);
          // print_r($result);die;
            if(isset($array['Policy'])){
                  $policy = $array['Policy'];  
                  $response  = json_decode(json_encode($array));
                if($policy['Status']=="Successful"){
                    $partner = DB::table('our_partners')->where('shortName','FGI')->value('name');
                    $json_data = $this->getJsonData($options,$response,$preInfo);
                    $enq = "QT-FW-".time().mt_rand();
                    
                      $plan['title'] = $partner;
                      $plan['grossamount'] = $json_data->gross;
                      $plan['netamount']   = $json_data->net;
                      $plan['discount']    = 0;
                      $plan['id'] =$enq;
                      $plan['addons'] =  $json_data;
                      $plan['idv'] = $policy['VehicleIDV'];
                      
                      $Inuptxml   = simplexml_load_string($XML, 'SimpleXMLElement', LIBXML_NOCDATA);
                      $Inuptxml = json_decode(json_encode((array)$Inuptxml), TRUE);
                      
                      $quoteData = ['quote_id'=>$enq,'type'=>'CAR','title'=>$partner,
                                    'device'=>$deviceToken,'provider'=>'FGI',
                                    'policyType'=>$params['planType'],
                                    'min_idv'=>$policy['VehicleIDV'],
                                    'max_idv'=>$policy['VehicleIDV'],
                                    'idv'    =>$policy['VehicleIDV'],
                                    'call_type'=>"QUOTE",
                                    'netAmt'=>$json_data->net,
                                    'taxAmt'=>$json_data->tax,
                                    'grossAmt'=>$json_data->gross,
                                    'reqRecalculate'=>json_encode($Inuptxml),
                                    'respRecalculate'=>json_encode($policy),
                                    'json_data'=>json_encode($json_data),
                                    'req'=>json_encode($Inuptxml),
                                    'resp'=>json_encode($policy)];
                    $quoteID = DB::table('app_temp_quote')->where('id',$_quoteData->id)->update($quoteData);
                    return ['status'=>true,'plans'=>$plan,'message' => "Success"];
                }else{ //Fail
                    return ['status'=>false,'plans'=>[],'message' => "Connection Fail"];
                }
            }else{
               return ['status'=>false,'plans'=>[]];
            }
        }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
              
                return ['status' => false,'plans'=>[], 'message' => "ConnectException"];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                 return ['status' => false,'plans'=>[], 'message' => 'RequestException'];
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return ['status' =>false, 'plans'=>[],'message' => "ClientException"];
            }
    }
    
     function createQuote($enquiry_id,$options){
               $EnQ = DB::table('app_quote')->where('enquiry_id', $enquiry_id)->first();
               $params = json_decode(json_encode(json_decode($EnQ->params_request)),true);
               if($params['previousInsurance']['insurer']==11){
                 return ['status'=>false,'data'=>$enquiry_id,'token'=>"",'message' => "Future Generali India Insurance Company Limited is not allowed as prevoius insurer"];
               }
               $preInfo = $this->GetPreviousPolicyData($params,"Premium");
               $XML =  $this->fnQuoteRequest($params);
               $options = $params['subcovers'];
               // $_quoteData = DB::table('app_temp_quote')->where(['provider'=>"FGI",'type'=>'BIKE','device'=>$deviceToken])->orderBy('id','desc')->first();  
                $PR = json_decode($EnQ->params_request);
                
                $CPAReq = (isset($options['isPA_OwnerDriverCover']) && $options['isPA_OwnerDriverCover']=='true')?'Y':'N';
                $optionValues = $params['coverValues'];
                    if((isset($options['isPA_OwnerDriverCover']) && $options['isPA_OwnerDriverCover']=='true')){ 
                          if($params['planType']=="TP" && $preInfo->businessType=="NEW"){
                                $PA_OWNER =3;
                              }else{ 
                                   $paCoverVal = isset($optionValues['PA_OwnerDriverCoverval'])?$optionValues['PA_OwnerDriverCoverval']:1;
                                   $PA_OWNER = ($preInfo->businessType=="NEW")?$paCoverVal:"";
                              }
                          
                      }else{
                          $PA_OWNER ="";
                      }
                if($params['planType']!="SAOD" && $params['vehicle']['policyHolder'] == "IND"){     
                    $XML = str_replace("{{CPAYear}}",$PA_OWNER,$XML);
                    $XML = str_replace("{{CPAReq}}","Y",$XML);
                    $XML = str_replace("{{CPANomName}}","Test",$XML);
                    $XML = str_replace("{{CPANomAge}}","25",$XML);
                    $XML = str_replace("{{CPANomAgeDet}}","Y",$XML);
                    $XML = str_replace("{{CPANomPerc}}","100",$XML);
                    $XML = str_replace("{{CPARelation}}","BROT",$XML);
                }else{
                    $XML = str_replace("{{CPAYear}}","",$XML);
                    $XML = str_replace("{{CPAReq}}","N",$XML);
                    $XML = str_replace("{{CPANomName}}","",$XML);
                    $XML = str_replace("{{CPANomAge}}","",$XML);
                    $XML = str_replace("{{CPANomAgeDet}}","",$XML);
                    $XML = str_replace("{{CPANomPerc}}","",$XML);
                    $XML = str_replace("{{CPARelation}}","",$XML); 
                }
                
                $licensePlateNumber =$PR->vehicle->vehicleNumber;
                //  $licensePlateNumber =$params['vehicle']['rtoCode']."JK7104";
                //      if($params['vehicle']['hasvehicleNumber']=="true"){
                //         $licensePlateNumber =$params['vehicle']['vehicleNumber'];
                //      }
                //     if($params['vehicle']['isBrandNew']==='true'){ 
                //         $licensePlateNumber = "";
                //     }
                $XML = str_replace("{{RegistrationNo}}",$licensePlateNumber,$XML);
                
                $idv = isset($params['vehicle']['idv']['value'])?$params['vehicle']['idv']['value']:0;
                $XML = str_replace("{{IDV}}",$idv,$XML);
                
                $PA_UNNAMED_PASS = (isset($options['isPA_UNPassCover']) && $options['isPA_UNPassCover']=='true')?$params['coverValues']['PA_UNPassCoverval']:'';
                $XML = str_replace("{{isPA_UNPassCover}}",$PA_UNNAMED_PASS,$XML);
                
                $LL_PaidDriver = (isset($options['isLL_PaidDriverCover']) && $options['isLL_PaidDriverCover']=='true')?"1":"";
                $XML = str_replace("{{isLL_PaidDriverCover}}",$LL_PaidDriver,$XML);
                
                $LL_Emp = (isset($options['isLL_EmpCover']) && $options['isLL_EmpCover']=='true')?"Y":"";
                $XML = str_replace("{{isLL_EmpCover}}",$LL_Emp,$XML);
                $ADDONS="";
                $ADDONS .= (isset($options['isBreakDownAsCover']) && $options['isBreakDownAsCover']=='true')?"<Addon><CoverCode>RODSA</CoverCode></Addon>":"";
                $ADDONS .= (isset($options['isConsumableCover']) && $options['isConsumableCover']=='true')?"<Addon><CoverCode>CONSM</CoverCode></Addon>":"";
                $ADDONS .= (isset($options['isPartDepProCover']) && $options['isPartDepProCover']=='true')?"<Addon><CoverCode>ZODEP</CoverCode></Addon>":"";
                $hasAddons = ($ADDONS!="")?"Y":"N";
                $XML = str_replace("{{HAS_ADDONS}}",$hasAddons,$XML);
                if($hasAddons=="Y"){
                     $XML = str_replace("{{ADDONS}}",$ADDONS,$XML);
                }else{
                     $XML = str_replace("{{ADDONS}}","<Addon><CoverCode></CoverCode></Addon>",$XML);	
                }
               
                try {
                    $factory = new Factory();
                    $client = $factory->create(new Client(), config('motor.FGI.car.QuickQuote')); 
                    $result = $client->call('CreatePolicy', [["Product"=>"Motor","XML"=>$XML]]);
                   
                    $xml   = simplexml_load_string($result->CreatePolicyResult, 'SimpleXMLElement', LIBXML_NOCDATA);
                    $array = json_decode(json_encode((array)$xml), TRUE);
                   // print_r($array);
                   //print_r($result);die;
                    if(isset($array['Policy'])){
                          $policy = $array['Policy'];  
                          $response  = json_decode(json_encode($array));
                        if($policy['Status']=="Successful"){
                            $json_data = $this->getJsonData($options,$response,$preInfo);
                            $Inuptxml   = simplexml_load_string($XML, 'SimpleXMLElement', LIBXML_NOCDATA);
                            $Inuptxml = json_decode(json_encode((array)$Inuptxml), TRUE);
                            
                            $token =  getRandomStr(10);
                            $quoteData = ['policyType'=>$params['planType'],
                                            'min_idv'=>$policy['VehicleIDV'],
                                            'max_idv'=>$policy['VehicleIDV'],
                                            'idv'    =>$policy['VehicleIDV'],
                                            'reqCreate'=>json_encode($Inuptxml),
                                            'respCreate'=>json_encode($policy),
                                            'json_data'=>json_encode($json_data),
                                            'req'=>json_encode($Inuptxml),
                                            'resp'=>json_encode($policy),
                                            'token'=>$token,
                                            'netAmt'=>$json_data->net,
                                            'taxAmt'=>$json_data->tax,
                                            'grossAmt'=>$json_data->gross,
                                            'startDate'=>isset($policy['PolicyHeader']['PolicyStartDate'])?Carbon::createFromFormat('d/m/Y',$policy['PolicyHeader']['PolicyStartDate'])->format('Y-m-d'):NULL,
                                            'endDate'  =>isset($policy['PolicyHeader']['PolicyEndDate'])?Carbon::createFromFormat('d/m/Y',$policy['PolicyHeader']['PolicyEndDate'])->format('Y-m-d'):NULL
                                            ];
                            $quoteID = DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update($quoteData);
                            return ['status'=>true,'data'=>$enquiry_id,'token'=>$token];
                        }else{ //Fail
                            return ['status'=>false,'data'=>$enquiry_id,'token'=>"",'message' => "Connection Fail"];
                        }
                    }else{
                       return ['status'=>false,'data'=>$enquiry_id, 'message' => "ConnectException" ,'token'=>""];
                    }
        }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
              
                return ['status' => false,'data'=>$enquiry_id, 'message' => "ConnectException" ,'token'=>""];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                 return ['status' => false,'data'=>$enquiry_id, 'message' => 'RequestException' ,'token'=>""];
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return ['status' =>false, 'data'=>$enquiry_id,'message' => "ClientException" ,'token'=>""];
            }
               
            //   
            //   if($result['status']){
            //       $reQRec = json_decode($EnQ->reqRecalculate);
            //       $DATA = ['token'=>$token,
            //                 'startDate'=>isset($reQRec->PolicyHeader->PolicyStartDate)?Carbon::createFromFormat('d/m/Y',$reQRec->PolicyHeader->PolicyStartDate)->format('Y-m-d'):NULL,
            //                 'endDate'  =>isset($reQRec->PolicyHeader->PolicyEndDate)?Carbon::createFromFormat('d/m/Y',$reQRec->PolicyHeader->PolicyEndDate)->format('Y-m-d'):NULL];
            //       DB::table('app_quote')->where('enquiry_id', $enquiry_id)->update($DATA);
            //       return ['status'=>true,'data'=>$enquiry_id,'token'=>$token];
            //   }else{
            //         return ['status'=>true,'data'=>$enquiry_id,'token'=>""];
            //   }
     }
     
     function fnPolicyIssuance($params,$Premium,$WS_P_ID,$TID,$PGID){
         $preInfo = $this->GetPreviousPolicyData($params,"Proposal");
         $productCode = $this->productCode(strtoupper($params['planType']."-".$preInfo->businessType));
         
         $chars = date('Ymd').time();
         $uid = str_shuffle(substr(str_shuffle($chars), 0, 10));
         
         //$productCode = $this->productCode($params['planType']);
         $make=($params['vehicle']['brand']['name'])?trim($params['vehicle']['brand']['name']):null;
         $model = ($params['vehicle']['model']['name'])?$params['vehicle']['model']['name']:null;
         $varient = ($params['vehicle']['varient']['name'])?$params['vehicle']['varient']['name']:null;
         $regionCode = $params['vehicle']['rtoCode'];
         $registrationDate=date('d').'/'.$params['vehicle']['regMonth'].'/'.$params['vehicle']['regYear'];
         //$expDate = createFormatDate($params['previousInsurance']['expDate'],'d-m-Y','d/m/Y');
         //$startDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->addDays()->format('Y-m-d');
         
         $var = DB::table('vehicle_variant_car')->where('id',$params['vehicle']['varient']['id'])->first();
    
         $pincode =  $params['address']['pincode'];
         $_city   =  strtoupper(explode("-",$params['address']['state'])[1]);
         $_state  =  strtoupper(explode("-",$params['address']['state'])[1]);
         $fuel = "P";
         switch (strtolower($var->fuel_type)) {
            case "petrol":$fuel =  "P";break;
            case "diesel":$fuel =  "D";break;
            case "cng": $fuel =  "C";break;
            default:$fuel =  "P";
        }
        
        if($params['vehicle']['isBrandNew']==='false'){ 
            $period = $this->timePeriod('d/m/Y',1 ,$preInfo->startDate);
         }else{
             if($productCode->cover=="OD"){ 
                 $period = $this->timePeriod('d/m/Y',1 );
             }else{
                 $period = $this->timePeriod('d/m/Y',5 );
             }
           
         }
         
         $hypothecationAgency = !empty($params['vehicle']['hypothecationAgency'])?$params['vehicle']['hypothecationAgency']:"";
         
         
          $TPStartDate="";
         $TPEndDate ="";
         $TPInsurer ="";
         $TPpolicyNo ="";
          if($params['planType']=="SAOD"){
             
            $TPStartDate= isset($params['TP']['TPpolicyStartDate'])?Carbon::createFromFormat('d-m-Y',$params['TP']['TPpolicyStartDate'])->format('d/m/Y'):"";
            $TPEndDate= isset($params['TP']['TPpolicyEndDate'])?Carbon::createFromFormat('d-m-Y',$params['TP']['TPpolicyEndDate'])->format('d/m/Y'):"";
            $TPInsurer= isset($params['TP']['TPInsurer'])?DB::table('previous_insurer')->where('id', $params['TP']['TPInsurer'])->value('name'):"";
            $TPpolicyNo= isset($params['TP']['TP_policyno'])?$params['TP']['TP_policyno']:"";
          }
         
        //$ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
       //// $ncbArray = ['ZERO'=>0,'TWENTY'=>20,'TWENTY_FIVE'=>25,'THIRTY_FIVE'=>35,'FORTY_FIVE'=>45,'FIFTY'=>50];
       // $ncbArrayNew = ['ZERO'=>20,'TWENTY'=>25,'TWENTY_FIVE'=>35,'THIRTY_FIVE'=>45,'FORTY_FIVE'=>50,'FIFTY'=>50];
       // $hasMadePreClaim  = (isset($params['previousInsurance']['hasPreClaim']) && $params['previousInsurance']['hasPreClaim']=='yes')?'Y':'N';
       // $ncbPercent = $ncbArray[$ncb];
        //$ncbPercentNew = $ncbArrayNew[$ncb];
        if($params['vehicle']['policyHolder'] == "IND"){
            $ClientType = "I";
            $salutation = strtoupper($params['customer']['salutation']);
            $Fname = $params['customer']['first_name'];
            $Lname = $params['customer']['last_name'];
            $dob = str_replace('-','/',$params['customer']['dob']);
            $Gender = strtoupper(substr($params['customer']['gender'],0,1));
            $Mstatus =  'M';
            $gistn =  "";
        }else{
             $ClientType = "C";
             $salutation ="MS";
             $Fname = $params['customer']['company'];
             $Lname = "";//$params['customer']['last_name'];
             $dob = "";//str_replace('-','/',$params['customer']['dob']);
             $Gender = "";//strtoupper(substr($params['customer']['gender'],0,1));
             $Mstatus =  '';
             $gistn =  $params['customer']['gstin'];
        }
            $ROOT = "<Root>
                    	<Uid>".$uid."</Uid>
                    	<VendorCode>".config('motor.FGI.car.vendorCode')."</VendorCode>
                    	<VendorUserId>".config('motor.FGI.car.vendorName')."</VendorUserId>
                    	<PolicyHeader>
                    		<PolicyStartDate>".$period->startDate."</PolicyStartDate> 
                            <PolicyEndDate>".$period->endDate."</PolicyEndDate>
                    		<AgentCode>".config('motor.FGI.car.AgentCode')."</AgentCode>
                    		<BranchCode>".config('motor.FGI.car.BranchCode')."</BranchCode>
                    		<MajorClass>MOT</MajorClass>
                    		<ContractType>".$productCode->contract."</ContractType>
                    		<METHOD>CRT</METHOD>
                    		<PolicyIssueType>I</PolicyIssueType>
                    		<PolicyNo></PolicyNo>
                    		<ClientID></ClientID>
                    		<ReceiptNo></ReceiptNo>
                    	</PolicyHeader>
                    	<POS_MISP>
		                   <Type></Type>
		                   <PanNo></PanNo>
	                    </POS_MISP>
                    	<Client>
                    		<ClientType>".$ClientType."</ClientType>
                    		<CreationType>C</CreationType>
                    		<Salutation>".$salutation."</Salutation>
                    		<FirstName>".$Fname."</FirstName>
                    		<LastName>".$Lname."</LastName>
                    		<DOB>".$dob."</DOB>
                    		<Gender>".$Gender."</Gender>
                    		<MaritalStatus>".$Mstatus."</MaritalStatus>
                    		<Occupation>SVCM</Occupation>
                    		<PANNo></PANNo>
                    		<GSTIN>".$gistn."</GSTIN>
                    		<AadharNo></AadharNo>
                    		<CKYCNo></CKYCNo>
                    		<EIANo></EIANo>
                    		<Address1>
                    			<AddrLine1>".$params['address']['addressLineOne']."</AddrLine1>
                    			<AddrLine2>".$params['address']['addressLineTwo']."</AddrLine2>
                    			<AddrLine3></AddrLine3>
                    			<Landmark></Landmark>
                    			<Pincode>".$pincode."</Pincode>
                    			<City>".$_city."</City>
                    			<State>".$_state."</State>
                    			<Country>IND</Country>
                    			<AddressType>R</AddressType>
                    			<HomeTelNo></HomeTelNo>
                    			<OfficeTelNo></OfficeTelNo>
                    			<FAXNO></FAXNO>
                    			<MobileNo>".$params['customer']['mobile']."</MobileNo>
                    			<EmailAddr>".$params['customer']['email']."</EmailAddr>
                    		</Address1>
                    		<Address2>
                    		    <AddrLine1>".$params['address']['addressLineOne']."</AddrLine1>
                    			<AddrLine2>".$params['address']['addressLineTwo']."</AddrLine2>
                    			<AddrLine3></AddrLine3>
                    			<Landmark></Landmark>
                    			<Pincode>".$pincode."</Pincode>
                    			<City>".$_city."</City>
                    			<State>".$_state."</State>
                    			<Country>IND</Country>
                    			<AddressType>B</AddressType>
                    			<HomeTelNo></HomeTelNo>
                    			<OfficeTelNo></OfficeTelNo>
                    			<FAXNO></FAXNO>
                    		    <MobileNo>".$params['customer']['mobile']."</MobileNo>
                    			<EmailAddr>".$params['customer']['email']."</EmailAddr>
                    		</Address2>
                         	<VIPFlag>N</VIPFlag>
                    	    <VIPCategory></VIPCategory>
                    	</Client>
                    	<Receipt>
                    		<UniqueTranKey>".$WS_P_ID."</UniqueTranKey>
                    		<CheckType></CheckType>
                    		<BSBCode></BSBCode>
                    		<TransactionDate>".date('d/m/Y')."</TransactionDate>
                    		<ReceiptType>IVR</ReceiptType>
                    		<Amount>".$Premium."</Amount>
                    		<TCSAmount></TCSAmount>
                    		<TranRefNo>".$TID."</TranRefNo>
                    		<TranRefNoDate>".date('d/m/Y')."</TranRefNoDate>
                    	</Receipt>
	                    <Risk>
                    		<RiskType>".$productCode->risk."</RiskType>
                    		<Zone>A</Zone>
                    		<Cover>".$productCode->cover."</Cover>
                    		<Vehicle>
                    			<TypeOfVehicle></TypeOfVehicle>
                    			<VehicleClass></VehicleClass>
                    			<RTOCode>".$regionCode."</RTOCode>
                    			<Make>".strtoupper($make)."</Make>
                    			<ModelCode>".$var->fgi_code."</ModelCode>
                    			<RegistrationNo>{{RegistrationNo}}</RegistrationNo>
                    			<RegistrationDate>".$registrationDate."</RegistrationDate>
                    			<ManufacturingYear>".clean_str($params['vehicle']['regYear'])."</ManufacturingYear>
                    			<FuelType>".$fuel."</FuelType>
                    			<CNGOrLPG>
                    				<InbuiltKit>N</InbuiltKit>
                    				<IVDOfCNGOrLPG></IVDOfCNGOrLPG>
                    			</CNGOrLPG>
                    			<BodyType>SALOON</BodyType>
                    			<EngineNo>".$params['vehicle']['engineNumber']."</EngineNo>
                    			<ChassiNo>".$params['vehicle']['chassisNumber']."</ChassiNo>
                    			<CubicCapacity>".$var->cubic_capacity."</CubicCapacity>
                    			<SeatingCapacity>".$var->seating_capacity."</SeatingCapacity>
                    			<IDV>{{IDV}}</IDV>
                    			<GrossWeigh></GrossWeigh>
                    			<CarriageCapacityFlag></CarriageCapacityFlag>
                    			<ValidPUC>Y</ValidPUC>
                    			<TrailerTowedBy></TrailerTowedBy>
                    			<TrailerRegNo></TrailerRegNo>
                    			<NoOfTrailer></NoOfTrailer>
                    			<TrailerValLimPaxIDVDays></TrailerValLimPaxIDVDays>
                    	     	<TrailerChassisNo></TrailerChassisNo>
                    	    	<TrailerMfgYear></TrailerMfgYear>
                    	    	<SchoolBusFlag></SchoolBusFlag>
                    		</Vehicle>
                    		<InterestParty>
                    			<Code></Code>
                    			<BankName>".$hypothecationAgency."</BankName>
                    		</InterestParty>
                    		<AdditionalBenefit>
                    			<Discount>{{Discount}}</Discount>
                    			<ElectricalAccessoriesValues></ElectricalAccessoriesValues>
                    			<NonElectricalAccessoriesValues></NonElectricalAccessoriesValues>
                    			<FibreGlassTank></FibreGlassTank>
                    			<GeographicalArea></GeographicalArea>
                    			<PACoverForUnnamedPassengers>{{isPA_UNPassCover}}</PACoverForUnnamedPassengers>
                    			<LegalLiabilitytoPaidDriver>{{isLL_PaidDriverCover}}</LegalLiabilitytoPaidDriver>
                    			<LegalLiabilityForOtherEmployees>{{isLL_EmpCover}}</LegalLiabilityForOtherEmployees>
                    			<LegalLiabilityForNonFarePayingPassengers></LegalLiabilityForNonFarePayingPassengers>
                    			<UseForHandicap></UseForHandicap>
                    			<AntiThiefDevice></AntiThiefDevice>
                    			<NCB>".$preInfo->ncbNew."</NCB>
                    			<RestrictedTPPD></RestrictedTPPD>
                    			<PrivateCommercialUsage></PrivateCommercialUsage>
                    			<CPAYear>{{CPAYear}}</CPAYear>
                    			<CPADisc></CPADisc>
                    			<IMT23></IMT23>
                    			<CPAReq>{{CPAReq}}</CPAReq>
                    			<CPA>
                    				<CPANomName>{{CPANomName}}</CPANomName>
                                    <CPANomAge>{{CPANomAge}}</CPANomAge>
                                    <CPANomAgeDet>{{CPANomAgeDet}}</CPANomAgeDet>
                                    <CPANomPerc>{{CPANomPerc}}</CPANomPerc>
                                    <CPARelation>{{CPARelation}}</CPARelation>
                    				<CPAAppointeeName></CPAAppointeeName>
                    				<CPAAppointeRel></CPAAppointeRel>
                    			</CPA>
                    			<NPAReq>N</NPAReq>
                    			<NPA>
                    				<NPAName></NPAName>
                    				<NPALimit></NPALimit>
                    				<NPANomName></NPANomName>
                    				<NPANomAge></NPANomAge>
                    				<NPANomAgeDet></NPANomAgeDet>
                    				<NPARel></NPARel>
                    				<NPAAppinteeName></NPAAppinteeName>
                    				<NPAAppinteeRel></NPAAppinteeRel>
                    			</NPA>
                        		<ZNCBRSRCV></ZNCBRSRCV>
                        		<ZNOFEMPLY></ZNOFEMPLY>
                        		<ZLMTPERPD></ZLMTPERPD>
                        		<ZADDLPAPD></ZADDLPAPD>
                        		<ZTPPER></ZTPPER>
                        		<ZCMPTPPA></ZCMPTPPA>
                        		<ZLMTTPPD></ZLMTTPPD>
                        		<ZPREMISE></ZPREMISE>
                        		<ZVINTAGE></ZVINTAGE>
                        		<XCESSLAB></XCESSLAB>
                        		<XCESCDE></XCESCDE>
                        		<ZSCARSI></ZSCARSI>
                        		<ZSCARIND></ZSCARIND>
                        		<ZAANO></ZAANO>
                        		<ZEMBASSY></ZEMBASSY>
                        		<ZSPECRAL></ZSPECRAL>
                        		<ZRALTRAIL></ZRALTRAIL>
                        		<ZDRVTTN></ZDRVTTN>
                        		<EXPDTE></EXPDTE>
                        		<ZOVRTFLG></ZOVRTFLG>
                        		<ZIMT44ID></ZIMT44ID>
                        		<ZPAPDPRM></ZPAPDPRM>
                        		<ZNOPPM></ZNOPPM>
                        		<ZIMT34ID></ZIMT34ID>
                        	</AdditionalBenefit>
                    		<AddonReq>{{HAS_ADDONS}}</AddonReq>
                    		{{ADDONS}}
                    		<PreviousTPInsDtls>
                    			<PreviousInsurer>".$TPInsurer."</PreviousInsurer>
                    			<TPPolicyNumber>".$TPpolicyNo."</TPPolicyNumber>
                    			<TPPolicyEffdate>".$TPStartDate."</TPPolicyEffdate>
                    			<TPPolicyExpiryDate>".$TPEndDate."</TPPolicyExpiryDate>
                    		</PreviousTPInsDtls>
                    		<PreviousInsDtls>
                    			<UsedCar>".$preInfo->isUsed."</UsedCar>
                    			<UsedCarList>
                    				<PurchaseDate>".$registrationDate."</PurchaseDate>
                    				<InspectionRptNo></InspectionRptNo>
                    				<InspectionDt></InspectionDt>
                    			</UsedCarList>
                    			<RollOver>".$preInfo->isRollover."</RollOver>
                    			<RollOverList>
                    			    <PolicyNo>".$preInfo->prePolicyNo."</PolicyNo>
                                    <InsuredName>".$preInfo->preInsurerCode."</InsuredName>
                    				<PreviousPolExpDt>".$preInfo->expDate."</PreviousPolExpDt>
                    				<ClientCode>40062645</ClientCode>
                    				<Address1>".$_city."</Address1>
                    				<Address2>".$_city."</Address2>
                    				<Address3>".$_city."</Address3>
                    				<Address4>".$_city."</Address4>
                    				<Address5>".$_state."</Address5>
                    				<PinCode>".$pincode."</PinCode>
                    				<InspectionRptNo></InspectionRptNo>
                    				<InspectionDt></InspectionDt>
                    				<NCBDeclartion>".$preInfo->hasPreClaim."</NCBDeclartion>  
                    				<ClaimInExpiringPolicy>".$preInfo->hasPreClaim."</ClaimInExpiringPolicy>
                    				<NCBInExpiringPolicy>".$preInfo->ncbPercent."</NCBInExpiringPolicy>
                    		   	    <PreviousPolStartDt></PreviousPolStartDt>
                    			    <TypeOfDoc></TypeOfDoc>
                    			    <NoOfClaims></NoOfClaims>
                    			</RollOverList>
                    			<NewVehicle>".$preInfo->isNew."</NewVehicle>
                    			<NewVehicleList>
                    				<InspectionRptNo></InspectionRptNo>
                    				<InspectionDt></InspectionDt>
                    			</NewVehicleList>
                    		</PreviousInsDtls>
                        	<ZLLOTFLG></ZLLOTFLG>
                        	<GARAGE></GARAGE>
                        	<ZREFRA></ZREFRA>
                        	<ZREFRB></ZREFRB>
                        	<ZIDVBODY></ZIDVBODY>
                        	<COVERNT></COVERNT>
                        	<CNTISS></CNTISS>
                        	<ZCVNTIME></ZCVNTIME>
                        	<AddressSeqNo></AddressSeqNo>
                    	</Risk>
                   </Root>";
                return $ROOT;
              
    }
    
     function policyIssuance($enQId,$Premium,$WS_P_ID,$TID,$PGID){
        $info =    DB::table('app_quote')->where('enquiry_id',$enQId)->first();
        
        $params = json_decode($info->params_request);
        $jsonData = json_decode($info->json_data);
        $preInfo = $this->GetPreviousPolicyData(json_decode(json_encode($params), true),"Proposal");
        $subcovers = $params->subcovers;
        $optionValues = $params->coverValues;
         if((isset($subcovers->isPA_OwnerDriverCover) && $subcovers->isPA_OwnerDriverCover=='true')){ 
            if($params->planType=="TP" && $preInfo->businessType=="NEW"){
               $PA_OWNER =5;
            }else{ 
               $paCoverVal = isset($optionValues->PA_OwnerDriverCoverval)?$optionValues->PA_OwnerDriverCoverval:1;
               $PA_OWNER = ($preInfo->businessType=="NEW")?$paCoverVal:"";
            }
          }else{
              $PA_OWNER ="";
          }
        $XML =  $this->fnPolicyIssuance(json_decode(json_encode($params), true),$Premium,$WS_P_ID,$TID,$PGID);
        
        //$jData = json_decode($info->json_data);
        $CPAReq = (isset($subcovers->isPA_OwnerDriverCover) && $subcovers->isPA_OwnerDriverCover=='true')?'Y':'N';
        if($CPAReq=="Y" && $params->vehicle->policyHolder == "IND" && $params->planType!="SAOD"){
             
            $nR = DB::table('relations')->where('value',$params->nominee->relation)->value('FGI');
            $nR = ($nR)?$nR:"BROT";
            $age = calulateAge(createFormatDate($params->nominee->dob,'d-m-Y','Y-m-d'));
            $XML = str_replace("{{CPAYear}}",$PA_OWNER,$XML);
            $XML = str_replace("{{CPAReq}}",$CPAReq,$XML);
            $XML = str_replace("{{CPANomName}}",$params->nominee->name,$XML);
            $XML = str_replace("{{CPANomAge}}",$age,$XML);
            $XML = str_replace("{{CPANomAgeDet}}","Y",$XML);
            $XML = str_replace("{{CPANomPerc}}","100",$XML);
            $XML = str_replace("{{CPARelation}}",$nR,$XML);
        }else{
            $XML = str_replace("{{CPAYear}}","",$XML);
            $XML = str_replace("{{CPAReq}}","N",$XML);
            $XML = str_replace("{{CPANomName}}","",$XML);
            $XML = str_replace("{{CPANomAge}}","",$XML);
            $XML = str_replace("{{CPANomAgeDet}}","",$XML);
            $XML = str_replace("{{CPANomPerc}}","",$XML);
            $XML = str_replace("{{CPARelation}}","",$XML);
        }
        
        
        
       
          $XML = str_replace("{{Discount}}",$jsonData->additionalBenefitDiscount,$XML);
           //$licensePlateNumber =$options['vehicle']['vehicleNumber'];
            //if($params->vehicle->hasvehicleNumber=="true"){
                $licensePlateNumber =$params->vehicle->vehicleNumber;
            //  }else {
            //     $licensePlateNumber ="NEW".$params->vehicle->rtoCode;
            //  }
            $XML = str_replace("{{RegistrationNo}}",$licensePlateNumber,$XML);
        
             $idv = isset($params->vehicle->idv->value)?$params->vehicle->idv->value:0;
             $XML = str_replace("{{IDV}}",$idv,$XML);
            
            $PA_UNNAMED_PASS = (isset($subcovers->isPA_UNPassCover) && $subcovers->isPA_UNPassCover=='true')?$params->coverValues->PA_UNPassCoverval:'';
            $XML = str_replace("{{isPA_UNPassCover}}",$PA_UNNAMED_PASS,$XML);
            
            $LL_PaidDriver = (isset($subcovers->isLL_PaidDriverCover) && $subcovers->isLL_PaidDriverCover=='true')?"1":"";
            $XML = str_replace("{{isLL_PaidDriverCover}}",$LL_PaidDriver,$XML);
            
            $LL_Emp = (isset($subcovers->isLL_EmpCover) && $subcovers->isLL_EmpCover=='true')?"Y":"";
            $XML = str_replace("{{isLL_EmpCover}}",$LL_Emp,$XML);
            $ADDONS="";
           $ADDONS .= (isset($subcovers->isBreakDownAsCover) && $subcovers->isBreakDownAsCover=='true')?"<Addon><CoverCode>RODSA</CoverCode></Addon>":"";
           $ADDONS .= (isset($subcovers->isConsumableCover) && $subcovers->isConsumableCover=='true')?"<Addon><CoverCode>CONSM</CoverCode></Addon>":"";
           $ADDONS .= (isset($subcovers->isPartDepProCover) && $subcovers->isPartDepProCover=='true')?"<Addon><CoverCode>ZODEP</CoverCode></Addon>":"";
            $hasAddons = ($ADDONS!="")?"Y":"N";
            $XML = str_replace("{{HAS_ADDONS}}",$hasAddons,$XML);
            if($hasAddons=="Y"){
                 $XML = str_replace("{{ADDONS}}",$ADDONS,$XML);
            }else{
                 $XML = str_replace("{{ADDONS}}","<Addon><CoverCode></CoverCode></Addon>",$XML);	
            }
        try {
             $Inuptxml   = simplexml_load_string($XML, 'SimpleXMLElement', LIBXML_NOCDATA);
             $Inuptxml = json_decode(json_encode((array)$Inuptxml), TRUE);
           // echo "<pre>";
             //echo '<pre>', htmlentities($XML), '</pre>';
            $factory = new Factory();
            $client = $factory->create(new Client(), config('motor.FGI.car.QuickQuote')); 
            $result = $client->call('CreatePolicy', [["Product"=>"Motor","XML"=>$XML]]);
           // print_r($result);die;
          // echo '<pre>', htmlentities($result->CreatePolicyResult), '</pre>';
            $xml   = simplexml_load_string($result->CreatePolicyResult, 'SimpleXMLElement', LIBXML_NOCDATA);
            $array = json_decode(json_encode((array)$xml), TRUE);
           //  print_r($array);
              
            if(isset($array['Policy'])){
                    $Inuptxml   = simplexml_load_string($XML, 'SimpleXMLElement', LIBXML_NOCDATA);
                    $Inuptxml = json_decode(json_encode((array)$Inuptxml), TRUE);
                     
                    $policyNo = is_array($array['Policy']['PolicyNo'])?"":$array['Policy']['PolicyNo'];
                   
                    $QDATA = ['reqCreate'=>json_encode($Inuptxml),'respCreate'=>json_encode($array)];
                    //print_r($QDATA);
                    DB::table('app_quote')->where('enquiry_id',$enQId)->update($QDATA);
                    return ['status'=>true,'message'=>'Policy Generated successfully','data'=>$policyNo];
            }else{
                $QDATA = ['reqCreate'=>json_encode($Inuptxml),'respCreate'=>json_encode($array)];
                DB::table('app_quote')->where('enquiry_id',$enQId)->update($QDATA);
               return ['status'=>false,'message' => "Connection Fail",'data'=>""];
            }
        }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return ['status' => false, 'message' => "ConnectException",'data'=>""];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                 return ['status' => false,'message' => 'RequestException','data'=>""];
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return ['status' =>false,'message' => "ClientException",'data'=>""];
            }
    }
    
     function Generatehash256($message){
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
    
     function GetPDF($pno){
            
            try {
              $REQUEST= ["PolicyNumber"=>$pno,'UserID'=>config('motor.FGI.car.userID'),'Password'=>config('motor.FGI.car.Password')];
               
               
               $this->soapWrapper->add('DataTable', function ($service) {
                      $service
                        ->wsdl(config('motor.FGI.car.policyPDF'))
                        ->trace(true);
                        // ->options([
                        //     'UserID' => 'webagg',
                        //     'Password' => 'webagg@123'
                        // ]);
                    });
                   
                    // Without classmap
                    $response = $this->soapWrapper->call('DataTable.GetPDF', [$REQUEST]);
                     print_r($response->GetPDFResult->any);
                      $xmmll =  "<root>".$response->GetPDFResult->any."</root>";
                        $doc = new \DOMDocument();
                        $doc->preserveWhiteSpace = true;
                        $doc->loadXML($xmmll);
                        $doc->save('t.xml');
                    
                        $xmlfile  = file_get_contents('t.xml');
                        $parseObj = str_replace($doc->lastChild->prefix.':',"",$xmlfile);
                        $ob       = simplexml_load_string($parseObj);
                        $data     = json_decode(json_encode($ob), true);
                    
                   // print_r($data);
                    if(isset($data['diffgrdiffgram'])){
                    $diffgrdiffgram = $data['diffgrdiffgram'];
                    $DocumentElement = $diffgrdiffgram['DocumentElement'];
                    $PDF = $DocumentElement['PDF'];
                        if(isset($PDF['PDFBytes'])){
                            $PDFBytes = $PDF['PDFBytes'];
                            $fileName = "FGI-FW-".$pno.".pdf";
                            $filePath1 = base64_decode($PDFBytes);
                             $file1 = getcwd()."/public/assets/customers/policy/pdf/".$fileName;
                            file_put_contents($file1, $filePath1);
                            return  ['status'=>true,'filename'=>$fileName];
                        }else{
                            return  ['status'=>false,'filename'=>"",'filename1'=>"" ,'message'=>$response->GetPDFResult->any];
                        }
                    }else{
                        return  ['status'=>false,'filename'=>"", 'filename2'=>"",'message'=>$response->GetPDFResult->any];
                    }
                    
            }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                 return  ['status'=>false,'filename'=>"",'message'=>"ConnectException error"];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
               return  ['status'=>false,'filename'=>"",'message'=>"RequestException error"];
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return  ['status'=>false,'filename'=>"",'message'=>"ClientException error"];
            }catch (ErrorException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return  ['status'=>false,'filename'=>"",'message'=>"ErrorException error"];
            }
    }
    
    
   
    
   
    
}