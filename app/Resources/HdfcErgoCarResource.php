<?php
namespace App\Resources;
use Nathanmac\Utilities\Parser\Parser;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Carbon\Carbon;

class HdfcErgoCarResource extends AppResource{ 
    
 
    
    public function __construct(){ }
    
    public function productCode($plan){
    
            switch ($plan) {
              case "COM":
                return "Comprehensive";
                break;
              case "TP":
                return "ThirdParty";
                break;
              case "SAOD":
                return "ODOnly";
                break;
              default:
                return "Comprehensive";
            }
    }
    
    public function getJsonData($response,$params){
            //$resp = $temp->response;
            $data = json_decode($response);
            $subcover = $params['subcovers'];
            $subcoverval = $params['coverValues'];
            $tp =  new \stdClass();
            $tp->title = "Third Party";
            $tp->code = "TP";
            $tp->selection = true;
            $tp->grossAmt = $data->Data[0]->BasicTPPremium;
            $tp->netAmt   = $data->Data[0]->BasicTPPremium;
            $tp->discount = 0.00;
            $tp->tax = 0.00;
            
            $od =  new \stdClass();
            $od->selection = true;
            $od->title = "Motor Own Damage";
            $od->code = "OD";
            $od->grossAmt = isset($data->Data[0]->BasicODPremium)?$data->Data[0]->BasicODPremium:0.00;
            $od->netAmt   = isset($data->Data[0]->BasicODPremium)?$data->Data[0]->BasicODPremium:0.00;
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
            
           
            
            $addons = [];
            $addonCovers  = $data->Data[0]->AddOnCovers; 
             foreach($addonCovers as $cover){
               
               if($subcover['isPA_OwnerDriverCover']=="true" && $params['planType']=="TP" && $params['vehicle']['isBrandNew']==='true'){
                    $pa_od->title = "PA(Personal Accident) Owner Driver (3 Year)";
                    $pa_od->selection = true;
                    $pa_od->grossAmt = $cover->CoverPremium;
                    $pa_od->netAmt   = $cover->CoverPremium;
               }else if($cover->CoverName=="PACoverOwnerDriver" && ($subcover['isPA_OwnerDriverCover']=="true" && $subcoverval['PA_OwnerDriverCoverval']==1)){
                   $pa_od->selection = true;
                   $pa_od->title = "PA(Personal Accident) Owner Driver (1 Year)";
                   $pa_od->grossAmt = $cover->CoverPremium;
                   $pa_od->netAmt   = $cover->CoverPremium;
                }else if($cover->CoverName=="PACoverOwnerDriver3Year" && ($subcover['isPA_OwnerDriverCover']=="true" &&  $subcoverval['PA_OwnerDriverCoverval']==3)){
                    $pa_od->title = "PA(Personal Accident) Owner Driver (3 Year)";
                    $pa_od->selection = true;
                    $pa_od->grossAmt = $cover->CoverPremium;
                    $pa_od->netAmt   = $cover->CoverPremium;
                }
                
                
                 if($cover->CoverName=='LLPaidDriver' && $subcover['isLL_PaidDriverCover']=="true"){ 
                        //$pa_un_pass->insuredValue  = $subcoverval['PA_UNPassCoverval'];
                        $ll_paid_driver->selection = true;
                        $ll_paid_driver->grossAmt = $cover->CoverPremium;
                        $ll_paid_driver->netAmt   = $cover->CoverPremium;
                 }
                 
                 if($cover->CoverName=='PAPaidDriver' && $subcover['isPA_UNDriverCover']=="true"){ 
                        //$pa_un_pass->insuredValue  = $subcoverval['PA_UNPassCoverval'];
                        $pa_paid_driver->selection = true;
                        $pa_paid_driver->grossAmt = $cover->CoverPremium;
                        $pa_paid_driver->netAmt   = $cover->CoverPremium;
                 }
                
                if($cover->CoverName=='LLEmployee' && $subcover['isLL_EmpCover']=="true"){ 
                        //$pa_un_pass->insuredValue  = $subcoverval['PA_UNPassCoverval'];
                        $ll_emp->selection = true;
                        $ll_emp->grossAmt = $cover->CoverPremium;
                        $ll_emp->netAmt   = $cover->CoverPremium;
                 }
             
                 
                
                 if($cover->CoverName=='UnnamedPassenger' && $subcover['isPA_UNPassCover']=="true"){ 
                        $pa_un_pass->insuredValue  = $subcoverval['PA_UNPassCoverval'];
                        $pa_un_pass->selection = true;
                        $pa_un_pass->grossAmt = $cover->CoverPremium;
                        $pa_un_pass->netAmt   = $cover->CoverPremium;
                 }
                 if($cover->CoverName=='ZERODEP' && $subcover['isPartDepProCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = 'Zero Depreciation cover';
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 if($cover->CoverName=='EMERGASSIST' && $subcover['isBreakDownAsCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = $cover->CoverDisplayName;//'Road Side Assistance';
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 if($cover->CoverName=='ENGEBOX' && $subcover['isEng_GearBoxProCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = $cover->CoverDisplayName;
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 
                 if($cover->CoverName=='COSTCONS' && $subcover['isConsumableCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = $cover->CoverDisplayName;
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 
                 if($cover->CoverName=='RTI' && $subcover['isRetInvCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = $cover->CoverDisplayName;
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 
                 if($cover->CoverName=='EMERGASSISTWIDER' && $subcover['isKeyLockProCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = $cover->CoverDisplayName;
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 
                 if($cover->CoverName=='LOSSUSEDOWN' && $subcover['isPersonalBelongCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = $cover->CoverDisplayName;
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 
                 
                 
                 if($cover->CoverName=='TYRESECURE' && $subcover['isTyreProCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = $cover->CoverDisplayName;
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 
                 if($cover->CoverName=='ElectricalAccessoriesIdv' && $subcover['isElecAccCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Electrical Accessories";
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 
                 if($cover->CoverName=='NonelectricalAccessoriesIdv' && $subcover['isNonElecAccCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Non Electrical Accessories";
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 
                 
                 if($cover->CoverName=='LpgCngKitIdvOD' && $subcover['isCngKitCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "CNG Kit Cover(OD)";
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 
                 if($cover->CoverName=='LpgCngKitIdvTP' && $subcover['isCngKitCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "CNG Kit Cover(TP)";
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
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
            
            $discount = new \stdClass();
            $discounts = [];$totalDis =0;
            if(isset($data->Data[0]->NewNcbDiscountPercentage)){
                     $amt = $data->Data[0]->NewNcbDiscountAmount;
                     if($amt>0){
                         $eachDis =   new \stdClass();
                         $eachDis->type   = "NCB_DISCOUNT";
                         $eachDis->amount = $amt;
                         $eachDis->percent = $data->Data[0]->NewNcbDiscountPercentage;
                         array_push($discounts,$eachDis);
                         $totalDis+= $amt;
                     }
              
             }
             
             
            $discount->discounts = $discounts;
            $discount->total = $totalDis;
             
            $obj = new \stdClass();
            $obj->covers = $covers;
            $obj->gross =  trim(str_replace('INR', '', $data->Data[0]->TotalPremiumAmount));
            $obj->net   =  trim(str_replace('INR', '', $data->Data[0]->NetPremiumAmount));
            $obj->tax   =  trim(str_replace('INR', '', $data->Data[0]->TaxAmount));
            
            $obj->discount=  $discount;
            
            //customer
            $customer = new \stdClass(); 
            $customer->name ="";
            $customer->mobile ="";
            $customer->email ="";
            $customer->dob ="";
            
            $obj->customer = $customer;
            
            $supplier = new \stdClass(); 
            $supplier->id =5;
            $supplier->name ="HDFC ERGO Insurance";
            $supplier->short ="HDFCERGO";
            $supplier->logo ="https://www.hdfcergo.com/images/default-source/home/logo_hdfc.svg";
            $obj->supplier = $supplier;
            
            //vehicle
            $RTO = "";//substr($data->vehicle->licensePlateNumber,0,4);
            $vehicle = new \stdClass(); 
            $vehicle->make = '';//$data->vehicle->make;
            $vehicle->model = '';//$data->vehicle->model;
            $vehicle->varient = '';//$data->vehicle->varient;
            $vehicle->code = '';//$data->vehicle->vehicleMaincode;
            $vehicle->rto = '';//$RTO;
            $vehicle->rto_no = '';//$data->vehicle->licensePlateNumber;
            $vehicle->reg_date = '';//$data->vehicle->registrationDate;
            $vehicle->chassis_no = '';
            $vehicle->engin_no = '';
            $vehicle->newNCB = isset($data->Data[0]->NewNcbDiscountPercentage)?$data->Data[0]->NewNcbDiscountPercentage:"";
            $vehicle->idv    = isset($data->Data[0]->VehicleIdv)?$data->Data[0]->VehicleIdv:0;
            $vehicle->minIdv =isset($data->Data[0]->VehicleIdvMin)?$data->Data[0]->VehicleIdvMin:0;
            $vehicle->maxIdv =isset($data->Data[0]->VehicleIdvMax)?$data->Data[0]->VehicleIdvMax:0;
            $obj->vehicle = $vehicle;
            
            return $obj;
    }
    
    function GetPreviousPolicyData($params,$callTyp){
            //print_r($params);die;
            $res =  new \stdClass();
            $res->isExp = false;
            $res->isBreakIn = false;
            $res->expDate = "";
            $res->ncb = "ZERO";
            $res->ncbPercent =0;
            $res->prePolicyType = "";
            $res->isPreviousInsurerKnown = false;
            $res->hasPreClaim ="NO";
            $res->preInsurerCode = "";
            $res->businessType   = "Rollover";
            $res->prePolicyNo ="";
            
             $ncbArr = ["ZERO"=>0,'TWENTY'=>20,'TWENTY_FIVE'=>25,'THIRTY_FIVE'=>35,'FORTY_FIVE'=>45,'FIFTY'=>50];
            
            if($params['vehicle']['isBrandNew']==='false'){ 
                if(isset($params['previousInsurance']['isExp']) && $params['previousInsurance']['isExp']!=""){ 
                         
                         if($params['previousInsurance']['isExp']=="Not Expired"){ //Not Expired 
                              $res->businessType ="Rollover";
                               if($callTyp=="Proposal"){
                                    $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('Y-m-d');
                              }else{
                                    if($params['previousInsurance']['expDate']!=""){
                                         $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('Y-m-d');
                                    }else{
                                       $res->expDate = date('Y-m-d', strtotime('+10 days'));
                                    }
                                   //$res->expDate =date('Y-m-d', strtotime('+10 days'));
                                   // $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('Y-m-d');
                                }
                              $res->prePolicyType = !empty($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):"Comprehensive"; 
                              if($res->prePolicyType=="ThirdParty"){
                                    $res->ncb = "ZERO";//isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                     $res->hasPreClaim = 'YES';//($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                               }else{
                                     $res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                     $res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                               }
                              $res->isPreviousInsurerKnown = true;
                         }else if($params['previousInsurance']['isExp']=="Expired"){
                             if($params['previousInsurance']['exp']=="+90"){ 
                                       if($callTyp=="Proposal"){
                                          $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('Y-m-d');
                                       }else{
                                          
                                           if($params['previousInsurance']['expDate']!=""){
                                               $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('Y-m-d');
                                            }else{
                                               $res->expDate = date('Y-m-d', strtotime('-100 days'));
                                            }
                                       }
                                       $res->prePolicyType = !empty($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):"Comprehensive";
                                       if($res->prePolicyType=="ThirdParty"){
                                            $res->ncb = "ZERO";//isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                            $res->hasPreClaim = 'YES';//($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                                       }else{
                                             $res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                             $res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                                       }
                                       $res->isBreakIn = true;
                                       $res->isPreviousInsurerKnown = true;
                                       $res->businessType   = "Rollover";
                             }else if($params['previousInsurance']['exp']=="45-90"){
                                      if($callTyp=="Proposal"){
                                           $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('Y-m-d');
                                       }else{
                                            
                                            if($params['previousInsurance']['expDate']!=""){
                                               $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('Y-m-d');
                                            }else{
                                               $res->expDate = date('Y-m-d', strtotime('-60 days'));
                                            }
                                       }
                                      $res->prePolicyType = !empty($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):"Comprehensive";
                                       if($res->prePolicyType=="ThirdParty"){
                                            $res->ncb = "ZERO";//isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                             $res->hasPreClaim = 'YES';//($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                                       }else{
                                             $res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                             $res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                                       }
                                       $res->isBreakIn = true;
                                      $res->isPreviousInsurerKnown = true;
                                      $res->businessType   = "Rollover";
                             }else if($params['previousInsurance']['exp']=="-45"){
                                      if($callTyp=="Proposal"){
                                           $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('Y-m-d');
                                       }else{
                                           if($params['previousInsurance']['expDate']!=""){
                                               $res->expDate = Carbon::createFromFormat('d-m-Y', $params['previousInsurance']['expDate'])->format('Y-m-d');
                                          }else{
                                               $res->expDate = date('Y-m-d', strtotime('-25 days'));
                                          }
                                       }
                                       $res->prePolicyType = !empty($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):"Comprehensive";
                                       if($res->prePolicyType=="ThirdParty"){
                                            $res->ncb = "ZERO";//isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                             $res->hasPreClaim = 'YES';//($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                                       }else{
                                             $res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                             $res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                                       }
                                      $res->isBreakIn = true;
                                      $res->isPreviousInsurerKnown = true;
                                      $res->businessType   ="Rollover";
                             }else if($params['previousInsurance']['exp']=="0"){ 
                                      $res->expDate = "";
                                      $res->ncb = "ZERO";	
                                      $res->hasPreClaim="";
                                      $res->isPreviousInsurerKnown = false;
                                      $res->businessType   = "USED";
                                      $res->isBreakIn = true;
                             }
                             
                             
                         }
                }else{  //exp data not avialble
                    $res->expDate = "";
                    $res->ncb = "ZERO";	
                    $res->hasPreClaim="";
                    $res->isPreviousInsurerKnown = false;
                    $res->businessType   = "NEW";
                }
            }else{ // new
                $res->expDate = "";
                $res->ncb = "ZERO";	
                $res->hasPreClaim="";
                $res->isPreviousInsurerKnown = false;
                $res->businessType   = "NEW";
            }
            
            if(isset($params['previousInsurance']['insurer']) && $params['previousInsurance']['insurer']!="0"){
                   $res->preInsurerCode = DB::table('previous_insurer')->where('id', $params['previousInsurance']['insurer'])->value('hdfcErgo');
            }
            if($params['previousInsurance']['policyType']=='TP' || $params['planType']=="TP"){
                $res->ncbPercent =0; 
            }else{
                $res->ncbPercent =$ncbArr[$res->ncb]; 
            }
            
            if($callTyp=="Proposal"){
                  
                    $res->prePolicyNo = !empty($params['previousInsurance']['policyNo'])?$params['previousInsurance']['policyNo']:"";
                  
            }
            
           
            return $res;
                                      
    }
    
    function fnQuoteRequest($params){
        //print_r($params);
              $options = $params['subcovers'];
             // print_r($options);
              $optionValues  = $params['coverValues'];
              $preInfo = $this->GetPreviousPolicyData($params,"Premium");
              
               if((isset($options['isPA_OwnerDriverCover']) && $options['isPA_OwnerDriverCover']=='true')){ 
                  if($params['planType']=="TP" && $preInfo->businessType=="NEW"){
                          $PA_OWNER =3;
                      }else{ 
                           $paCoverVal = isset($optionValues['PA_OwnerDriverCoverval'])?$optionValues['PA_OwnerDriverCoverval']:1;
                           $PA_OWNER =$paCoverVal;
                      }
                  
              }else{
                  $PA_OWNER =0;
              }
             
              if((isset($options['isPA_UNPassCover']) && $options['isPA_UNPassCover']=='true')){
                  $paCoverVal = isset($optionValues['PA_UNPassCoverval'])?$optionValues['PA_UNPassCoverval']:40000;
                  $paCoverVal = ($paCoverVal<40000)?40000:$paCoverVal;
                  $PA_UNPassSumInsured =$paCoverVal;
                  $PA_UNPass = "YES";
                  $PAUnnamedPassengerNo =1;
              }else{
                  $PA_UNPassSumInsured =0;
                  $PA_UNPass = "NO";
                  $PAUnnamedPassengerNo=0;
              }
             
           
              $isPAUNPaidDriver = (isset($options['isPA_UNDriverCover']) && $options['isPA_UNDriverCover']=='true')?'YES':'NO';
              $PAPaidDriverSumInsured = ($isPAUNPaidDriver=='YES')?10000:0;
              
              $LL_PaidDriver = (isset($options['isLL_PaidDriverCover']) && $options['isLL_PaidDriverCover']=='true')?'YES':'NO';
              $LLPaidDriverNo = ($LL_PaidDriver=='YES')?1:0;
                
             
               $LL_EmpCover = (isset($options['isLL_EmpCover']) && $options['isLL_EmpCover']=='true')?'YES':'NO';
               $LLEmployeeNo = ($LL_EmpCover=='YES')?1:0;
              
              
              
              
              
              $zeroDep = (isset($options['isPartDepProCover']) && $options['isPartDepProCover']=='true')?'YES':'NO';
              $isEng_GearBoxProCover = (isset($options['isEng_GearBoxProCover']) && $options['isEng_GearBoxProCover']=='true')?'YES':'NO';
              $isBreakDownAsCover = (isset($options['isBreakDownAsCover']) && $options['isBreakDownAsCover']=='true')?'YES':'NO';
              
              $isConsCover = (isset($options['isConsumableCover']) && $options['isConsumableCover']=='true')?'YES':'NO';
              $isRtiCover = (isset($options['isRetInvCover']) && $options['isRetInvCover']=='true')?'YES':'NO';
              $isKeyLockProCover = (isset($options['isKeyLockProCover']) && $options['isKeyLockProCover']=='true')?'YES':'NO';
              $isPersonalBelongCover = (isset($options['isPersonalBelongCover']) && $options['isPersonalBelongCover']=='true')?'YES':'NO';
              
             
              $isTyreProtect = (isset($options['isTyreProCover']) && $options['isTyreProCover']=='true')?'YES':'NO';
              
              $isCngCover = (isset($options['isCngKitCover']) && $options['isCngKitCover']=='true')?'YES':'NO';
              if($isCngCover=='YES'){
                  $selectedFuleTyp = "CNG";
                  $cngIdv = isset($optionValues['cngCoverVal'])?$optionValues['cngCoverVal']:10;
              }else{
                  $cngIdv =0;  
                  $selectedFuleTyp = "";
              }
              
              $isElecCover = (isset($options['isElecAccCover']) && $options['isElecAccCover']=='true')?'YES':'NO';
              if($isElecCover=='YES'){
                  $elecIdv = isset($optionValues['elecCoverVal'])?$optionValues['elecCoverVal']:10;
              }else{
                  $elecIdv =0;  
              }
              
              $isNonElecCover = (isset($options['isNonElecAccCover']) && $options['isNonElecAccCover']=='true')?'YES':'NO';
              if($isNonElecCover=='YES'){
                  $nonElecIdv = isset($optionValues['nonElecCoverVal'])?$optionValues['nonElecCoverVal']:10;
              }else{
                  $nonElecIdv =0;  
              }
              
            
              $insuranceProductCode =  $this->productCode($params['planType']); 
              $isVehicleNew = $params['vehicle']['isBrandNew'];
              $policyHolder =($params['vehicle']['policyHolder']=='IND')?"INDIVIDUAL":"Corporate";//CORPORATE
              
              
               $rto_master=DB::table('rtoMaster')->select('rtoMaster.rtoCode as rtoCode','rtoMaster.hdfcErgoCodeTw as hdfcErgoCodeTw','cities.id as cityId',
                                                           'states.id as stateId','cities.hdfcErgoCode as cityCode','states.hdfcErgoCode as stateCode')
                                ->where('rtoCode',strtoupper($params['vehicle']['rtoCode']))
                                ->leftJoin('cities', 'cities.id', '=', 'rtoMaster.city_id')
                                ->leftJoin('states', 'states.id', '=', 'cities.state_id')->first();
              
              
              
            //  $rto_master=DB::table('rto_master')->where('region_code',strtoupper($params['vehicle']['rtoMaster']))->first();
              $makeCode=DB::table('vehicle_make_car')->where('id',$params['vehicle']['brand']['id'])->value('hdfcErgo_makeCode');
              $modelCode=DB::table('vehicle_variant_car')->where('id',$params['vehicle']['varient']['id'])->value('hdfcErgo_code');
               $regDate = $params['vehicle']['regYear']."-".$params['vehicle']['regMonth']."-".$params['vehicle']['regDate'];
          
              $rto_master=DB::table('rtoMaster')->select('rtoMaster.rtoCode as rtoCode','rtoMaster.hdfcErgoCodeCar as hdfcErgoCodeCar','cities.id as cityId',
                                                          'states.id as stateId','cities.hdfcErgoCode as cityCode','states.hdfcErgoCode as stateCode')
                                                ->where('rtoCode',strtoupper($params['vehicle']['rtoCode']))
                                                ->leftJoin('cities', 'cities.id', '=', 'rtoMaster.city_id')
                                                ->leftJoin('states', 'states.id', '=', 'cities.state_id')->first();
              // print_r($params['vehicle']['rtoCode']);die;
             
                $request =  new \stdClass();
                $configurationParam = new \stdClass();
                $configurationParam->AgentCode = config('motor.HDFCERGO.car.agentCode');//"FWC17723";
                
                $request->ConfigurationParam = $configurationParam;
                $request->TypeOfBusiness = $preInfo->businessType;
                $request->PolicyType = $insuranceProductCode;
                $request->CustomerType = $policyHolder;
                $request->CustomerStateCode = (int)$rto_master->stateCode;//14
                $request->RtoLocationCode = (int)$rto_master->hdfcErgoCodeCar;//10406
                $request->VehicleModelCode = (int)$modelCode;
                $request->VehicleMakeCode = (int)$makeCode;
                $request->RequiredIDV = 0;
                if($preInfo->isPreviousInsurerKnown){
                   $request->PreviousPolicyType = $preInfo->prePolicyType; 
                   $request->PreviousPolicyEndDate = $preInfo->expDate; 
                   if($params['planType']!="TP"){
                     $request->IsPreviousClaim = $preInfo->hasPreClaim;
                     $request->PreviousNCBDiscountPercentage = $preInfo->ncbPercent;
                   }
                   $request->PreviousInsurerId = 23;//$preInfo->preInsurerCode;//23;
                   if($params['planType']=="SAOD"){
                     $TPEnd = explode('-',$params['TP']['TPpolicyEndDate']);
                     $request->TPExistingEndDate = $TPEnd[2]."-".$TPEnd[1]."-".$TPEnd[0];
                   }
               }
                
                $request->PurchaseRegistrationDate = $regDate;
                $request->PospCode = "";
                
                $plnTypeAddon = "";
                // if($isCashAllowCover=='YES'){
                //     $plnTypeAddon = !empty($plnTypeAddon)?$plnTypeAddon.',CASHALLOW':'CASHALLOW';
                // }
                // if($isEng_GearBoxProCover=='YES'){
                //     $plnTypeAddon = !empty($plnTypeAddon)?$plnTypeAddon.',ENGEBOX':'ENGEBOX';
                // }
               
                $addOnCovers = new \stdClass();
                  //$addOnCovers->IsTPPDDiscount = "YES";
                  $addOnCovers->IsZeroDepTakenLastYear=($zeroDep=='YES')?1:0;
                  $addOnCovers->IsZeroDepCover=$zeroDep;
                  
                  $addOnCovers->IsLossOfUse=$isPersonalBelongCover;
                  $addOnCovers->IsEmergencyAssistanceCover=$isBreakDownAsCover;
                  
                  $addOnCovers->IsNoClaimBonusProtection="NO";
                  
                  $addOnCovers->IsEngineAndGearboxProtectorCover=$isEng_GearBoxProCover;
                  $addOnCovers->IsCostOfConsumable=$isConsCover;
                  $addOnCovers->IsReturntoInvoice=$isRtiCover;
                  $addOnCovers->IsEmergencyAssistanceWiderCover=$isKeyLockProCover;
            	  $addOnCovers->IsTyreSecureCover=$isTyreProtect;
            	  
            	  
                  
                  $addOnCovers->NonelectricalAccessoriesIdv=$nonElecIdv;
                  $addOnCovers->ElectricalAccessoriesIdv=$elecIdv;
                  $addOnCovers->LpgCngKitIdv=$cngIdv;
            	  $addOnCovers->SelectedFuelType= $selectedFuleTyp;
            	  
                  $addOnCovers->IsPAPaidDriver=$isPAUNPaidDriver;
                   
                  $addOnCovers->PAPaidDriverSumInsured=$PAPaidDriverSumInsured;
                  
                  $addOnCovers->IsPAUnnamedPassenger= $PA_UNPass;
                  $addOnCovers->PAUnnamedPassengerNo=$PAUnnamedPassengerNo;
                  $addOnCovers->PAPerUnnamedPassengerSumInsured=$PA_UNPassSumInsured;
                  
                  $addOnCovers->IsLegalLiabilityDriver=$LL_PaidDriver;
                  $addOnCovers->LLPaidDriverNo=$LLPaidDriverNo;
                  
                  $addOnCovers->IsLLEmployee= $LL_EmpCover;
                  $addOnCovers->LLEmployeeNo=$LLEmployeeNo;
                  if($params['planType']!="SAOD"){
            	    $addOnCovers->CpaYear= (int)$PA_OWNER;
                  }
            	  
                 if($plnTypeAddon!=''){
                   $addOnCovers->planType = $plnTypeAddon;
                 }
                $request->AddOnCovers = $addOnCovers;
                return $request;
    }
    
    function getQuickQuote($deviceToken,$params){
         try {
             
            $request = $this->fnQuoteRequest($params);
        
            $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.car.mKey'),'SecretToken'=>config('motor.HDFCERGO.car.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.car.calculatePremium'),
                ['body' => json_encode(
                    $request
                )]
            );
            $result = $clientResp->getBody()->getContents();
           //print_r($result);die;
            $response = json_decode($result);
           
           DB::table('app_temp_quote')->where(['type'=>'CAR','device'=>$deviceToken,'provider'=>'HDFCERGO'])->delete();
           if(isset($response->Status) && $response->Status==200 ){
                  $partner = DB::table('our_partners')->where('shortName','HDFCERGO')->value('name');
                  $json_data = $this->getJsonData($result,$params);
                  $plan['title'] = $partner;
                  $plan['grossamount'] = $json_data->gross;
                  $plan['netamount']   = $json_data->net;
                  $plan['discount']    = $json_data->discount->total;//str_replace('INR', '', $response->netPremium);
                  $plan['id'] =$response->UniqueRequestID;
                  $plan['addons'] =  $json_data;
                  $plan['idv'] = isset($response->Data[0]->VehicleIdv)?$response->Data[0]->VehicleIdv:0;
                  $quoteData = ['quote_id'=>$response->UniqueRequestID,'type'=>'CAR','title'=>$partner,'tenure'=>$response->Data[0]->PremiumYear,
                                'device'=>$deviceToken,'provider'=>'HDFCERGO',
                                'policyType'=>$params['planType'],'product'=>'Rollover',
                                'min_idv'=>isset($response->Data[0]->VehicleIdvMin)?$response->Data[0]->VehicleIdvMin:0,
                                'max_idv'=>isset($response->Data[0]->VehicleIdvMax)?$response->Data[0]->VehicleIdvMax:0,
                                'idv'    =>isset($response->Data[0]->VehicleIdv)?$response->Data[0]->VehicleIdv:0,
                                'call_type'=>"QUOTE",
                                'reqQuote'=>json_encode($request),
                                'respQuote'=>$result,
                                'reqRecalculate'=>$result,
                                'respRecalculate'=>$result,
                                
                                //'response'=>($result),
                                //'json_quote'=>($result),
                                'json_data'=>json_encode($json_data),
                                'req'=>json_encode($request),'resp'=>($result)];
              DB::table('app_temp_quote')->where(['type'=>'CAR','device'=>$deviceToken,'provider'=>'HDFCERGO'])->delete();
              $quoteID = DB::table('app_temp_quote')->insertGetId($quoteData);
              return ['status'=>true,'plans'=>$plan];
            }else{
              return ['status'=>false,'plans'=>[],'message'=>'Sorry we are unable to process your request.'];
            }
           }catch(Exception $e) {
                return ['status'=>false,'plans'=>[],'message'=>'Sorry we are unable to process your request.'];
          }

    }
    
    function getRecalulateQuote($deviceToken,$params){
        $quoteData = DB::table('app_temp_quote')->where(['provider'=>"HDFCERGO",'device'=>$deviceToken])->orderBy('id','desc')->first();
        $request = $this->fnQuoteRequest($params);
        $idv = isset($params['vehicle']['idv']['value'])?$params['vehicle']['idv']['value']:$quoteData->idv;
         try {
            if($idv>$quoteData->max_idv){
               $idv =  $quoteData->max_idv;
            }else if($idv<$quoteData->min_idv){
                  $idv =  $quoteData->min_idv;
            }
            $request->RequiredIDV = (int)$idv;
            //echo  json_encode($request);
           //$header = ["accept: */*","Content-Type:application/json","MerchantKey:FINSERV","SecretToken:KxP8dEbeAWC+Ic7O7gFu9A=="];
           //$auth['header'] = $header;
          //$auth['url'] = "https://uatcp.hdfcergo.com/TWOnline/ChannelPartner/CalculatePremium";
          // $result = $this->curlPost(json_encode($request),$auth);
           //print_r($result); 
          
            
             $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.car.mKey'),'SecretToken'=>config('motor.HDFCERGO.car.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.car.calculatePremium'),
                ['body' => json_encode(
                    $request
                )]
            );
            $result = $clientResp->getBody()->getContents();
        // print_r($result);die;
           $response = json_decode($result);
           
           $returnData =[];
          if(isset($response->Status) && $response->Status==200 ){
                  $json_data = $this->getJsonData($result,$params);
                  $partner = DB::table('our_partners')->where('shortName','HDFCERGO')->value('name');
                  $plan['title'] = $partner;
                  $plan['grossamount'] = $json_data->gross;
                  $plan['netamount']   = $json_data->net;
                  $plan['discount']    = $json_data->discount->total;//str_replace('INR', '', $response->netPremium);
                  $plan['id']  = $response->UniqueRequestID;
                  $plan['addons'] =  $json_data;
                  $plan['idv'] = isset($response->Data[0]->VehicleIdv)?$response->Data[0]->VehicleIdv:0;
                  $_quoteData = ['quote_id'=>$response->UniqueRequestID,'type'=>'CAR','title'=>$partner,
                                'device'=>$deviceToken,'provider'=>'HDFCERGO','policyType'=>$params['planType'],
                                'min_idv'=>isset($response->Data[0]->VehicleIdvMin)?$response->Data[0]->VehicleIdvMin:0,
                                'max_idv'=>isset($response->Data[0]->VehicleIdvMax)?$response->Data[0]->VehicleIdvMax:0,
                                'idv'    =>isset($response->Data[0]->VehicleIdv)?$response->Data[0]->VehicleIdv:0,
                                'call_type'=>"QUOTE", 
                                'reqRecalculate'=>json_encode($request),
                                 'respRecalculate'=>$result,
                                //'response'=>($result),
                                //'json_quote'=>($result),
                                'json_data'=>json_encode($json_data),
                                'req'=>json_encode($request),'resp'=>($result)];
                                
              $quoteID = DB::table('app_temp_quote')->where('id',$quoteData->id)->update($_quoteData);
              return ['status'=>true,'plans'=>$plan];
            }else{
              return ['status'=>false,'plans'=>[]];
            }
         }catch(Exception $e) {
                return ['status'=>false,'plans'=>[]];
          }

    }
    
    function createProposal($enquiry_id,$options){
         $enQ = DB::table('app_quote')->where('enquiry_id', $enquiry_id)->first();
         $jData = json_decode($enQ->json_data);
         $params = json_decode($enQ->params_request);
         $preInfo = $this->GetPreviousPolicyData($options,"Proposal");
         $insuranceProductCode =  $this->productCode($enQ->policyType); 
        
          $subcovr = $params->subcovers;
          $optionValues  = $params->coverValues;
          $idv = $enQ->idv;//isset($params->vehicle->idv->value)?$params->vehicle->idv->value:0;
         
                        if((isset($subcovr->isPA_OwnerDriverCover) && $subcovr->isPA_OwnerDriverCover=='true')){ 
                            if($params->planType=="TP" && $preInfo->businessType=="NEW"){
                                  $PA_OWNER =3;
                                }else{ 
                                     $paCoverVal = isset($optionValues->PA_OwnerDriverCoverval)?$optionValues->PA_OwnerDriverCoverval:1;
                                     $PA_OWNER =$paCoverVal;
                                }
                            
                        }else{
                            $PA_OWNER =0;
                        }
                        
                        if((isset($subcovr->isPA_UNPassCover) && $subcovr->isPA_UNPassCover=='true')){
                            $paCoverVal = isset($optionValues->PA_UNPassCoverval)?$optionValues->PA_UNPassCoverval:40000;
                            $PA_UNPassSumInsured =$paCoverVal;
                            $PA_UNPass = "YES";
                            $PAUnnamedPassengerNo =1;
                        }else{
                            $PA_UNPassSumInsured =0;
                            $PA_UNPass = "NO";
                            $PAUnnamedPassengerNo=0;
                        }
                        
                        
                        $isPAUNPaidDriver = (isset($subcovr->isPA_UNDriverCover) && $subcovr->isPA_UNDriverCover=='true')?'YES':'NO';
                        $PAPaidDriverSumInsured = ($isPAUNPaidDriver=='YES')?10000:0;
                        
                        $LL_PaidDriver = (isset($subcovr->isLL_PaidDriverCover) && $subcovr->isLL_PaidDriverCover=='true')?'YES':'NO';
                        $LLPaidDriverNo = ($LL_PaidDriver=='YES')?1:0;
                          
                        
                         $LL_EmpCover = (isset($subcovr->isLL_EmpCover) && $subcovr->isLL_EmpCover=='true')?'YES':'NO';
                         $LLEmployeeNo = ($LL_EmpCover=='YES')?1:0;
                        
                        $zeroDep = (isset($subcovr->isPartDepProCover) && $subcovr->isPartDepProCover=='true')?'YES':'NO';
                        $isEng_GearBoxProCover = (isset($subcovr->isEng_GearBoxProCover) && $subcovr->isEng_GearBoxProCover=='true')?'YES':'NO';
                        $isBreakDownAsCover = (isset($subcovr->isBreakDownAsCover) && $subcovr->isBreakDownAsCover=='true')?'YES':'NO';
                        
                        $isConsCover = (isset($subcovr->isConsumableCover) && $subcovr->isConsumableCover=='true')?'YES':'NO';
                        $isRtiCover = (isset($subcovr->isRetInvCover) && $subcovr->isRetInvCover=='true')?'YES':'NO';
                        $isKeyLockProCover = (isset($subcovr->isKeyLockProCover) && $subcovr->isKeyLockProCover=='true')?'YES':'NO';
                        $isPersonalBelongCover = (isset($subcovr->isPersonalBelongCover) && $subcovr->isPersonalBelongCover=='true')?'YES':'NO';
                        
                        $isTyreProtect = (isset($subcovr->isTyreProCover) && $subcovr->isTyreProCover=='true')?'YES':'NO';
                        
                        $isCngCover = (isset($subcovr->isCngKitCover) && $subcovr->isCngKitCover=='true')?'YES':'NO';
                        if($isCngCover=='YES'){
                            $selectedFuleTyp = "CNG";
                            $cngIdv = isset($optionValues->cngCoverVal)?$optionValues->cngCoverVal:10;
                        }else{
                            $cngIdv =0;  
                            $selectedFuleTyp = "";
                        }
                        
                        $isElecCover = (isset($subcovr->isElecAccCover) && $subcovr->isElecAccCover=='true')?'YES':'NO';
                        if($isElecCover=='YES'){
                            $elecIdv = isset($optionValues->elecCoverVal)?$optionValues->elecCoverVal:10;
                        }else{
                            $elecIdv =0;  
                        }
                        
                        $isNonElecCover = (isset($subcovr->isNonElecAccCover) && $subcovr->isNonElecAccCover=='true')?'YES':'NO';
                        if($isNonElecCover=='YES'){
                            $nonElecIdv = isset($optionValues->nonElecCoverVal)?$optionValues->nonElecCoverVal:10;
                        }else{
                            $nonElecIdv =0;  
                        }
       
        
        
       
              if(isset($options['vehicle']['vehicleNumber'])){
                  $vNo  = $options['vehicle']['vehicleNumber'];
                  $vehicleNo = substr($vNo, 0,2)."-".substr($vNo, 2,2)."-".substr($vNo, 4,2)."-".substr($vNo, 6,4);
               }else{
                  $vNo = $options['vehicle']['rtoCode'];
                  $vehicleNo = substr($vNo, 0,1)."-".substr($vNo, 2,3);
               }
            $vehicleNo = ($preInfo->businessType=="NEW")?"NEW":$vehicleNo;
         
         
        
        
        $policyHolder =($options['vehicle']['policyHolder']=='IND')?"INDIVIDUAL":"Corporate";
        //$rto_master=DB::table('rto_master')->where('region_code',strtoupper($options['vehicle']['rtoCode']))->first();
        $rto_master=DB::table('rtoMaster')->select('rtoCode as rtoCode','hdfcErgoCodeCar')
                                           ->where('rtoCode',strtoupper($options['vehicle']['rtoCode']))->first();
        //print_r($rto_master);die;
        $makeCode=DB::table('vehicle_make_car')->where('id',$options['vehicle']['brand']['id'])->value('hdfcErgo_makeCode');
        $modelCode=DB::table('vehicle_variant_car')->where('id',$options['vehicle']['varient']['id'])->value('hdfcErgo_code');
        $regDate = $options['vehicle']['regYear']."-".$options['vehicle']['regMonth']."-".$options['vehicle']['regDate'];
        
        $cityID = explode('-',$options['address']['city'])[0];
        $stateID = explode('-',$options['address']['state'])[0];
        
        $state =  DB::table('states')->where('id',$stateID)->first();
        $city  =  DB::table('cities')->where('id',$cityID)->first();
        
        
        $FinancierCode = isset($options['vehicle']['hypothecationAgency'])?DB::table('financiers')->where('id', $options['vehicle']['hypothecationAgency'])->value('hdfcErgoCode'):"";
        $request =  new \stdClass();
       
        $request->UniqueRequestID = $jData->enq;
        $proposalDetails = new \stdClass();
       
       $configurationParam = new \stdClass();
       $configurationParam->AgentCode = config('motor.HDFCERGO.car.agentCode');//"FWC17723";//"A000000101";
       $proposalDetails->ConfigurationParam = $configurationParam;
       if($options['planType']=="TP" && $preInfo->businessType=="NEW"){
          $proposalDetails->PremiumYear =3;
       }else{
          $proposalDetails->PremiumYear =$enQ->termYear; 
       }
       $proposalDetails->TypeOfBusiness =$preInfo->businessType;
       $proposalDetails->CustomerType = $policyHolder;
       $proposalDetails->RtoLocationCode = (int)$rto_master->hdfcErgoCodeCar;
       $proposalDetails->VehicleModelCode = (int)$modelCode;
       $proposalDetails->VehicleMakeCode = (int)$makeCode;
       $proposalDetails->RequiredIdv = (int)$idv;
       if($preInfo->isPreviousInsurerKnown==true){
            $proposalDetails->PreviousPolicyEndDate =$preInfo->expDate;
           $proposalDetails->PreviousPolicyType = $preInfo->prePolicyType;
            if($enQ->policyType!="TP"){
              $proposalDetails->IsPreviousClaim =strtoupper($preInfo->hasPreClaim);
              $proposalDetails->PreviousNCBDiscountPercentage =(int)$preInfo->ncbPercent;
            }
           $proposalDetails->PreviousInsurerCode=(int)$preInfo->preInsurerCode;
           $proposalDetails->PreviousPolicyNumber=$preInfo->prePolicyNo;
       }
       $proposalDetails->PurchaseRegistrationDate = $regDate;
       
       $proposalDetails->YearofManufacture = (int)$options['vehicle']['regYear'];
       
       $proposalDetails->FinancierCode = (int)$FinancierCode;
       $proposalDetails->RegistrationNo = $vehicleNo;
       $proposalDetails->EngineNo =  ($options['vehicle']['engineNumber'])?$options['vehicle']['engineNumber']:null;
       $proposalDetails->ChassisNo = ($options['vehicle']['chassisNumber'])?$options['vehicle']['chassisNumber']:null;
       $proposalDetails->NetPremiumAmount = (int)$jData->net;
       $proposalDetails->TotalPremiumAmount =(int)$jData->gross;
       $proposalDetails->TaxAmount = (int)$jData->tax;
       $isNom = (isset($subcovr->isPA_OwnerDriverCover) && $subcovr->isPA_OwnerDriverCover=='true')?true:false;
       $nomineeRelation = ['BROTHER'=>'Sibling','HUSBAND'=>'Spouse','GRAND_FATHER'=>'','GRAND_MOTHER'=>'','FATHER_IN_LAW'=>'','MOTHER_IN_LAW'=>'Mother','MOTHER'=>'Mother','SISTER'=>'Sibling','SON'=>'Son','DAUGHTER'=>'Daughter','FATHER'=>'Father','SPOUSE'=>'Spouse'];
        if($options['vehicle']['policyHolder']=="IND" && $isNom){ 
            $proposalDetails->PAOwnerDriverNomineeName = ($isNom)?$options['nominee']['name']:"";
            if($isNom){
              $nDob = Carbon::createFromFormat('d-m-Y', $options['nominee']['dob'])->format('Y-m-d');
           }
          $proposalDetails->PAOwnerDriverNomineeAge = ($isNom)?$this->calulateAge($nDob):"";
          $proposalDetails->PAOwnerDriverNomineeRelationship = ($isNom)?$nomineeRelation[$options['nominee']['relation']]:"";
        }
       $proposalDetails->PolicyType = $insuranceProductCode;
       
             $plnTypeAddon = "";
            // if($isCashAllowCover=='YES'){
            //     $plnTypeAddon = !empty($plnTypeAddon)?$plnTypeAddon.',CASHALLOW':'CASHALLOW';
            // }
            // if($isEng_GearBoxProCover=='YES'){
            //     $plnTypeAddon = !empty($plnTypeAddon)?$plnTypeAddon.',ENGEBOX':'ENGEBOX';
            // }
       
       $addOnCovers = new \stdClass();
       $addOnCovers = new \stdClass();
          //$addOnCovers->IsTPPDDiscount = "YES";  
          $addOnCovers->IsZeroDepTakenLastYear=($zeroDep=='YES')?1:0;
          $addOnCovers->IsZeroDepCover=$zeroDep;
          
          $addOnCovers->IsLossOfUse=$isPersonalBelongCover;
          $addOnCovers->IsEmergencyAssistanceCover=$isBreakDownAsCover;
          
          $addOnCovers->IsNoClaimBonusProtection="NO";
          
          $addOnCovers->IsEngineAndGearboxProtectorCover=$isEng_GearBoxProCover;
          $addOnCovers->IsCostOfConsumable=$isConsCover;
          $addOnCovers->IsReturntoInvoice=$isRtiCover;
          $addOnCovers->IsEmergencyAssistanceWiderCover=$isKeyLockProCover;
    	  $addOnCovers->IsTyreSecureCover=$isTyreProtect;
    	  
    	  
          
          $addOnCovers->NonelectricalAccessoriesIdv=$nonElecIdv;
          $addOnCovers->ElectricalAccessoriesIdv=$elecIdv;
          $addOnCovers->LpgCngKitIdv=$cngIdv;
    	  $addOnCovers->SelectedFuelType= $selectedFuleTyp;
    	  
          $addOnCovers->IsPAPaidDriver=$isPAUNPaidDriver;
          $addOnCovers->PAPaidDriverSumInsured=$PAPaidDriverSumInsured;
          
          $addOnCovers->IsPAUnnamedPassenger= $PA_UNPass;
          $addOnCovers->PAUnnamedPassengerNo=$PAUnnamedPassengerNo;
          $addOnCovers->PAPerUnnamedPassengerSumInsured=$PA_UNPassSumInsured;
          
          $addOnCovers->IsLegalLiabilityDriver=$LL_PaidDriver;
          $addOnCovers->LLPaidDriverNo=$LLPaidDriverNo;
          
          $addOnCovers->IsLLEmployee= $LL_EmpCover;
          $addOnCovers->LLEmployeeNo=$LLEmployeeNo;
          if($insuranceProductCode!="ODOnly"){
    	     $addOnCovers->CpaYear= (int)$PA_OWNER;
          }
       //$addOnCovers->IsTPPDDiscount="YES";
          if($plnTypeAddon!=''){
               $addOnCovers->planType = $plnTypeAddon;
           } 
          $proposalDetails->AddOnCovers =$addOnCovers;
       
        
          $customerDetails= new \stdClass();
        
        if($options['vehicle']['policyHolder']=="IND"){ 
            $Gender = isset($options['customer']['gender'])?strtoupper($options['customer']['gender']):"MALE";
            $ownerDOB    =  explode("-",$options['customer']['dob']);
            $customerDetails->Title=$options['customer']['salutation'];//($Gender=="MALE")?"Mr":"Ms";
            $customerDetails->Gender= $Gender;
            $customerDetails->FirstName=$options['customer']['first_name'];
            $customerDetails->MiddleName="";
            $customerDetails->LastName= $options['customer']['last_name'];
            $customerDetails->DateOfBirth= $ownerDOB[2]."-".$ownerDOB[1]."-".$ownerDOB[0];  
            $customerDetails->GstInNo= "";
            
        }else{
              $customerDetails->Title="M/S";
              $customerDetails->OrganizationName=$options['customer']['company'];
              $customerDetails->OrganizationContactPersonName=$options['customer']['first_name']." ".$options['customer']['last_name'];
              $customerDetails->GstInNo= $options['customer']['gstin'];
        }
       
        $customerDetails->EmailAddress=$options['customer']['email'];
        $customerDetails->MobileNumber= (int)$options['customer']['mobile'];
        $customerDetails->PanCard= "";
       
        $customerDetails->PospCode= "";
        $customerDetails->IsCustomerAuthenticated= "YES";
        $customerDetails->UidNo= "";
        $customerDetails->AuthentificationType= "OTP";
        $customerDetails->LGCode= "";
        $customerDetails->CorrespondenceAddress1= $options['address']['addressLine'];
        $customerDetails->CorrespondenceAddress2= $options['address']['addressLine'];
         $customerDetails->CorrespondenceAddress3= "";
        $customerDetails->CorrespondenceAddressCitycode= (int)$city->hdfcErgoCode;
        $customerDetails->CorrespondenceAddressCityName= strtoupper($city->name);
        $customerDetails->CorrespondenceAddressStateCode= (int)$state->hdfcErgoCode;
        $customerDetails->CorrespondenceAddressStateName=strtoupper($state->name);
        $customerDetails->CorrespondenceAddressPincode= (int)$options['address']['pincode'];
        //if(($preInfo->isBreakIn) || ($preInfo->prePolicyType=="ThirdParty" && $zeroDep=="NO")){
                $customerDetails->InspectionMethod = "SELF";
        	    $customerDetails->InspectionStateCode="";//(int)$state->hdfcErgoCode;
        	    $customerDetails->InspectionCityCode="";//(int)$city->hdfcErgoCode;
        	    $customerDetails->InspectionLocationCode=0;//143;
	         // $customerDetails->IsGoGreen=1;
        //  }
        if($insuranceProductCode=="ODOnly"){
            $policyStartDate= isset($options['TP']['TPpolicyStartDate'])?explode('-',$options['TP']['TPpolicyStartDate']):null;
            $policyTPEndDate= isset($options['TP']['TPpolicyEndDate'])?explode('-',$options['TP']['TPpolicyEndDate']):null;
            $preInsurerCode = DB::table('previous_insurer')->where('id', $options['TP']['TPInsurer'])->value('hdfcErgo');
            $customerDetails->TPExisitingInsurerCode=$preInsurerCode;
            $customerDetails->TPExisitingPolicyNumber=$options['TP']['TP_policyno'];
            $customerDetails->TPExistingStartDate=$policyStartDate[2]."-".$policyStartDate[1]."-".$policyStartDate[0];
            $customerDetails->TPExistingEndDate=$policyTPEndDate[2]."-".$policyTPEndDate[1]."-".$policyTPEndDate[0];
        }
        
       $request->ProposalDetails =$proposalDetails; 
       $request->CustomerDetails =$customerDetails; 
         
          if($city->hdfcErgoCode!=""){
        
        
        
            $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.car.mKey'),'SecretToken'=>config('motor.HDFCERGO.car.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.car.proposalGeneration'),
                ['body' => json_encode(
                    $request
                )]
            );
           $result = $clientResp->getBody()->getContents();
           //print_r($result);
           $response = json_decode($result);
           if($response->Status==200){
                $txId = $response->Data->TransactionNo;
                if($txId>0 && $preInfo->businessType!='USED'){
                    $cust = isset($options['customer']['first_name'])?$options['customer']['first_name']." ".$options['customer']['last_name']:$options['customer']['company'];
                    $QDATA = ['customer_name'=>$cust,'token'=>$txId,'reqCreate'=>json_encode($request),'respCreate'=>$result,'req'=>json_encode($request),'resp'=>($result)];
                    DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update($QDATA);
                   // DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update(['token'=>$txId,'reqCreate'=>json_encode($request),'respCreate'=>$result,'req'=>json_encode($request),'resp'=>($result)]);
                   return ['status'=>true,'isBreakIn'=>false,'message'=>'Proposal Created successfully'];
                }else{
                    $this->GetBreakinDetails($response->Data->BreakinId,$response->Data->QuoteNo);
                    $breakInJson =  new \stdClass(); 
                    $breakInJson->BreakinId =  $response->Data->BreakinId;
                    $breakInJson->QuoteId =  $response->Data->QuoteNo;
                    $breakInJson->inspectionStatus = 'Pending';
                    //$breakInJson->BreakinId =  $jData->BreakinId;
                     $cust = isset($options['customer']['first_name'])?$options['customer']['first_name']." ".$options['customer']['last_name']:$options['customer']['company'];
                    $QDATA = ['customer_name'=>$cust,'reqCreate'=>json_encode($request),'respCreate'=>$result,'isBreakInCase'=>'YES','breakInJson'=>json_encode($breakInJson),'token'=>$txId,'req'=>json_encode($request),'resp'=>($result)];
                    DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update($QDATA);
                    //DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update(['reqCreate'=>json_encode($request),'respCreate'=>$result,'isBreakInCase'=>'YES','breakInJson'=>json_encode($breakInJson),'token'=>$txId,'req'=>json_encode($request),'resp'=>($result)]);
                   return ['status'=>true,'isBreakIn'=>true,'message'=>'Payment will be done after inspection']; 
                }
           }else if($response->Status==500){
                DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update(['req'=>json_encode($request),'resp'=>($result)]);
                return ['status'=>false,'message'=>$response->Message];
           }else if($response->Status==400){
               // $rsp = json_decode($response);
                $msgs = $response->Message;
                //print_r($msgs);
                $msg = current($msgs);
                 DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update(['reqCreate'=>json_encode($request),'respCreate'=>$result,'req'=>json_encode($request),'resp'=>($result)]);
                return ['status'=>false,'message'=>$msg];
           }else {
                 return ['status'=>false,'message'=>'Sorry we are unable to process your request.'];
           }
          }else{
              return ['status'=>false,'message'=>'City code for '.$city->name.' is not mapped with our portal'];
          }
    }
    
    function  GetBreakinDetails($breakInId,$quoteNo){
            $request =  new \stdClass(); 
            $request->BreakinId = $breakInId;
            $request->QuoteNo =$quoteNo; 
            $request->AgentCode =config('motor.HDFCERGO.car.agentCode');//"FWC17723"; 
            // echo json_encode($request);
           
            $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.car.mKey'),'SecretToken'=>config('motor.HDFCERGO.car.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.car.breakinDetails'),
                ['body' => json_encode(
                    $request
                )]
            );
           
           $result = $clientResp->getBody()->getContents();
          // print_r($result);die;
           $response = json_decode($result);
          
           if($response->Status==200){
               if($response->Data->BreakInStatus=="Recommended"){
                     return ['status'=>true,'BreakInStatus'=>'Approved','message'=>$response->Data->Remarks]; 
               }else if($response->Data->BreakInStatus=="Inspection Request Initiated"){
                     return ['status'=>true,'BreakInStatus'=>'Initiated','message'=>"Inspection Request Initiated for your vehicle number ".$response->Data->RegistrationNumber]; 
               }else if($response->Data->BreakInStatus=="Breakin Id Generated"){
                     return ['status'=>true,'BreakInStatus'=>'Pending','message'=>"Inspection is not Initiated for your vehicle number ".$response->Data->RegistrationNumber]; 
               }else{
                     return ['status'=>true,'BreakInStatus'=>'Pending','message'=>"Inspection is under process for your vehicle number ".$response->Data->RegistrationNumber]; 
               }
                
            }else{
               return ['status'=>true,'BreakInStatus'=>'Pending','message'=>"Inspection Request Initiated for your vehicle"]; 
               
           }
    }
    
    function  GetPostInspectionDetails($breakInId,$quoteNo){
            $request =  new \stdClass(); 
            if($breakInId!=""){
              $request->BreakinId = $breakInId;
            }
            $request->QuoteNo =$quoteNo; 
            $request->AgentCode =config('motor.HDFCERGO.car.agentCode');//"FWC17723"; 
            // echo json_encode($request);
            
            
            $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.car.mKey'),'SecretToken'=>config('motor.HDFCERGO.car.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.car.postInspectionDetails'),
                ['body' => json_encode(
                    $request
                )]
            );
           
           $result = $clientResp->getBody()->getContents();
           $response = json_decode($result);
           if($response->Status==200){
                return ['status'=>true,'message'=>"",'data'=>$response->Data]; 
            }else{
               return ['status'=>false,'message'=>$response->Message->Inspection]; 
               
           }
           //print_r($result);die;
    }
    
    function GetPostInspectionCalculatePremium($enQId){
        $enQ = DB::table('app_quote')->where('enquiry_id', $enQId)->first();
        $params = json_decode(json_encode($enQ->params_request));
        $jData = json_decode($enQ->json_data);
        $breakIn =  json_decode($enQ->breakInJson,true);
        $request = $this->fnQuoteRequest(json_decode($params,true));
        $brkIninfo = $this->GetPostInspectionDetails("",$breakIn['QuoteId']);
        $request->PreviousInsurerId = $brkIninfo['data']->ProposalDetail->PreviousInsurerId;
        $request->PreviousPolicyEndDate = $brkIninfo['data']->ProposalDetail->PreviousPolicyEndDate;
        $request->UniqueRequestID = $jData->enq;
        $request->QuoteNo =  $breakIn['QuoteId'];
        
            
            $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.car.mKey'),'SecretToken'=>config('motor.HDFCERGO.car.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.car.postInspectionCalcultePremium'),
                ['body' => json_encode(
                    $request
                )]
            );
           
           $result = $clientResp->getBody()->getContents();
           // print_r($result);die;
           $response = json_decode($result);
            if(isset($response->Status) && $response->Status==200 ){
               $json_data = $this->getJsonData($result,json_decode($params,true));
               $json_data->enq = $response->UniqueRequestID;
               DB::table('app_quote')->where('enquiry_id',$enQId)->update(['json_data'=>json_encode($json_data)]);
                return ['status'=>true,'message'=>"Success"]; 
            }else if($response->Status==400){
                $msgs = $response->Message;
                $msg = current($msgs);
                return ['status'=>false,'message'=>$msg];
           }else{
                 return ['status'=>false,'message'=>"Sometning went wrong , please try again later."]; 
            }
    }
    
    function GetPostinspectionCreateProposal($enquiry_id){ 
         $enQ = DB::table('app_quote')->where('enquiry_id', $enquiry_id)->first();
         $jData = json_decode($enQ->json_data);
         $params = json_decode($enQ->params_request);
         $options =json_decode(json_decode(json_encode($enQ->params_request)),true);
         
         $preInfo = $this->GetPreviousPolicyData($options,"Proposal");
         $insuranceProductCode =  $this->productCode($enQ->policyType); 
         
         $breakIn =  json_decode($enQ->breakInJson,true);
         $brkIninfo = $this->GetPostInspectionDetails("",$breakIn['QuoteId']);
         
         
          $subcovr = $params->subcovers;
          $optionValues  = $params->coverValues;
          $idv = $enQ->idv;//isset($params->vehicle->idv->value)?$params->vehicle->idv->value:0;
         
            if((isset($subcovr->isPA_OwnerDriverCover) && $subcovr->isPA_OwnerDriverCover=='true')){ 
                            if($params->planType=="TP" && $preInfo->businessType=="NEW"){
                                  $PA_OWNER =3;
                                }else{ 
                                     $paCoverVal = isset($optionValues->PA_OwnerDriverCoverval)?$optionValues->PA_OwnerDriverCoverval:1;
                                     $PA_OWNER =$paCoverVal;
                                }
                            
                        }else{
                            $PA_OWNER =0;
                        }
                        
                        if((isset($subcovr->isPA_UNPassCover) && $subcovr->isPA_UNPassCover=='true')){
                            $paCoverVal = isset($optionValues->PA_UNPassCoverval)?$optionValues->PA_UNPassCoverval:10000;
                            $PA_UNPassSumInsured =$paCoverVal;
                            $PA_UNPass = "YES";
                            $PAUnnamedPassengerNo =1;
                        }else{
                            $PA_UNPassSumInsured =0;
                            $PA_UNPass = "NO";
                            $PAUnnamedPassengerNo=0;
                        }
                        
                        
                        $isPAUNPaidDriver = (isset($subcovr->isPA_UNDriverCover) && $subcovr->isPA_UNDriverCover=='true')?'YES':'NO';
                        $PAPaidDriverSumInsured = ($isPAUNPaidDriver=='YES')?10000:0;
                        
                        $LL_PaidDriver = (isset($subcovr->isLL_PaidDriverCover) && $subcovr->isLL_PaidDriverCover=='true')?'YES':'NO';
                        $LLPaidDriverNo = ($LL_PaidDriver=='YES')?1:0;
                          
                        
                         $LL_EmpCover = (isset($subcovr->isLL_EmpCover) && $subcovr->isLL_EmpCover=='true')?'YES':'NO';
                         $LLEmployeeNo = ($LL_EmpCover=='YES')?1:0;
                        
                        $zeroDep = (isset($subcovr->isPartDepProCover) && $subcovr->isPartDepProCover=='true')?'YES':'NO';
                        $isEng_GearBoxProCover = (isset($subcovr->isEng_GearBoxProCover) && $subcovr->isEng_GearBoxProCover=='true')?'YES':'NO';
                        $isBreakDownAsCover = (isset($subcovr->isBreakDownAsCover) && $subcovr->isBreakDownAsCover=='true')?'YES':'NO';
                        
                        $isConsCover = (isset($subcovr->isConsumableCover) && $subcovr->isConsumableCover=='true')?'YES':'NO';
                        $isRtiCover = (isset($subcovr->isRetInvCover) && $subcovr->isRetInvCover=='true')?'YES':'NO';
                        $isKeyLockProCover = (isset($subcovr->isKeyLockProCover) && $subcovr->isKeyLockProCover=='true')?'YES':'NO';
                        $isPersonalBelongCover = (isset($subcovr->isPersonalBelongCover) && $subcovr->isPersonalBelongCover=='true')?'YES':'NO';
                        $isTyreProtect = (isset($subcovr->isTyreProCover) && $subcovr->isTyreProCover=='true')?'YES':'NO';
                        
                        $isCngCover = (isset($subcovr->isCngKitCover) && $subcovr->isCngKitCover=='true')?'YES':'NO';
                        if($isCngCover=='YES'){
                            $selectedFuleTyp = "CNG";
                            $cngIdv = isset($optionValues->cngCoverVal)?$optionValues->cngCoverVal:10;
                        }else{
                            $cngIdv =0;  
                            $selectedFuleTyp = "";
                        }
                        
                        $isElecCover = (isset($subcovr->isElecAccCover) && $subcovr->isElecAccCover=='true')?'YES':'NO';
                        if($isElecCover=='YES'){
                            $elecIdv = isset($optionValues->elecCoverVal)?$optionValues->elecCoverVal:10;
                        }else{
                            $elecIdv =0;  
                        }
                        
                        $isNonElecCover = (isset($subcovr->isNonElecAccCover) && $subcovr->isNonElecAccCover=='true')?'YES':'NO';
                        if($isNonElecCover=='YES'){
                            $nonElecIdv = isset($optionValues->nonElecCoverVal)?$optionValues->nonElecCoverVal:10;
                        }else{
                            $nonElecIdv =0;  
                        }
       
        
        
       
              if(isset($options['vehicle']['vehicleNumber'])){
                  $vNo  = $options['vehicle']['vehicleNumber'];
                  $vehicleNo = substr($vNo, 0,2)."-".substr($vNo, 2,2)."-".substr($vNo, 4,2)."-".substr($vNo, 6,4);
               }else{
                  $vNo = $options['vehicle']['rtoCode'];
                  $vehicleNo = substr($vNo, 0,1)."-".substr($vNo, 2,3);
               }
            $vehicleNo = ($preInfo->businessType=="NEW")?"NEW":$vehicleNo;
         
         
        
        
        $policyHolder =($options['vehicle']['policyHolder']=='IND')?"INDIVIDUAL":"Corporate";
        //$rto_master=DB::table('rto_master')->where('region_code',strtoupper($options['vehicle']['rtoCode']))->first();
        $rto_master=DB::table('rtoMaster')->select('rtoCode as rtoCode','hdfcErgoCodeCar')
                                           ->where('rtoCode',strtoupper($options['vehicle']['rtoCode']))->first();
        //print_r($rto_master);die;
        $makeCode=DB::table('vehicle_make_car')->where('id',$options['vehicle']['brand']['id'])->value('hdfcErgo_makeCode');
        $modelCode=DB::table('vehicle_variant_car')->where('id',$options['vehicle']['varient']['id'])->value('hdfcErgo_code');
        $regDate = $options['vehicle']['regYear']."-".$options['vehicle']['regMonth']."-".$options['vehicle']['regDate'];
        
        $cityID = explode('-',$options['address']['city'])[0];
        $stateID = explode('-',$options['address']['state'])[0];
        
        $state =  DB::table('states')->where('id',$stateID)->first();
        $city  =  DB::table('cities')->where('id',$cityID)->first();
        
        
        $FinancierCode = isset($options['vehicle']['hypothecationAgency'])?DB::table('financiers')->where('id', $options['vehicle']['hypothecationAgency'])->value('hdfcErgoCode'):"";
        $request =  new \stdClass();
       
        $request->UniqueRequestID = $jData->enq;
        $proposalDetails = new \stdClass();
       
       $configurationParam = new \stdClass();
       $configurationParam->AgentCode = config('motor.HDFCERGO.car.agentCode');//"FWC17723";//"A000000101";
       $proposalDetails->ConfigurationParam = $configurationParam;
       if($options['planType']=="TP" && $preInfo->businessType=="NEW"){
          $proposalDetails->PremiumYear =3;
       }else{
          $proposalDetails->PremiumYear =$enQ->termYear; 
       }
       $proposalDetails->TypeOfBusiness =$preInfo->businessType;
       $proposalDetails->CustomerType = $policyHolder;
       $proposalDetails->RtoLocationCode = (int)$rto_master->hdfcErgoCodeCar;
       $proposalDetails->VehicleModelCode = (int)$modelCode;
       $proposalDetails->VehicleMakeCode = (int)$makeCode;
       $proposalDetails->RequiredIdv = (int)$idv;
       if($preInfo->isPreviousInsurerKnown==true){
            $proposalDetails->PreviousPolicyEndDate =$brkIninfo['data']->ProposalDetail->PreviousPolicyEndDate; //$preInfo->expDate;
            $proposalDetails->PreviousPolicyType = $preInfo->prePolicyType;
            $proposalDetails->IsPreviousClaim =$brkIninfo['data']->VehicleDetail->PreviousClaimTaken;
          // $proposalDetails->PreviousClaimTaken = $brkIninfo['data']->VehicleDetail->PreviousClaimTaken;
           $proposalDetails->PreviousNCBDiscountPercentage =(int)$preInfo->ncbPercent;
           $proposalDetails->PreviousInsurerCode=(int)$brkIninfo['data']->ProposalDetail->PreviousInsurerId;;
           $proposalDetails->PreviousInsurerId = $brkIninfo['data']->ProposalDetail->PreviousInsurerId;
           $proposalDetails->PreviousPolicyNumber=$preInfo->prePolicyNo;
       }
       $proposalDetails->PurchaseRegistrationDate = $regDate;
       
       $proposalDetails->YearofManufacture = (int)$options['vehicle']['regYear'];
       
       $proposalDetails->FinancierCode = (int)$FinancierCode;
       $proposalDetails->RegistrationNo = $vehicleNo;
       $proposalDetails->EngineNo =  ($options['vehicle']['engineNumber'])?$options['vehicle']['engineNumber']:null;
       $proposalDetails->ChassisNo = ($options['vehicle']['chassisNumber'])?$options['vehicle']['chassisNumber']:null;
       $proposalDetails->NetPremiumAmount = (int)$jData->net;
       $proposalDetails->TotalPremiumAmount =(int)$jData->gross;
       $proposalDetails->TaxAmount = (int)$jData->tax;
       $isNom = (isset($subcovr->isPA_OwnerDriverCover) && $subcovr->isPA_OwnerDriverCover=='true')?true:false;
       $nomineeRelation = ['BROTHER'=>'Sibling','HUSBAND'=>'Spouse','GRAND_FATHER'=>'','GRAND_MOTHER'=>'','FATHER_IN_LAW'=>'','MOTHER_IN_LAW'=>'Mother','MOTHER'=>'Mother','SISTER'=>'Sibling','SON'=>'Son','DAUGHTER'=>'Daughter','FATHER'=>'Father','SPOUSE'=>'Spouse'];
        if($options['vehicle']['policyHolder']=="IND" && $isNom){ 
            $proposalDetails->PAOwnerDriverNomineeName = ($isNom)?$options['nominee']['name']:"";
            if($isNom){
              $nDob = Carbon::createFromFormat('d-m-Y', $options['nominee']['dob'])->format('Y-m-d');
           }
          $proposalDetails->PAOwnerDriverNomineeAge = ($isNom)?$this->calulateAge($nDob):"";
          $proposalDetails->PAOwnerDriverNomineeRelationship = ($isNom)?$nomineeRelation[$options['nominee']['relation']]:"";
        }
       $proposalDetails->PolicyType = $insuranceProductCode;
       
             $plnTypeAddon = "";
            // if($isCashAllowCover=='YES'){
            //     $plnTypeAddon = !empty($plnTypeAddon)?$plnTypeAddon.',CASHALLOW':'CASHALLOW';
            // }
            // if($isEng_GearBoxProCover=='YES'){
            //     $plnTypeAddon = !empty($plnTypeAddon)?$plnTypeAddon.',ENGEBOX':'ENGEBOX';
            // }
       
       $addOnCovers = new \stdClass();
       $addOnCovers = new \stdClass();
                  
          $addOnCovers->IsZeroDepTakenLastYear=($zeroDep=='YES')?1:0;
          $addOnCovers->IsZeroDepCover=$zeroDep;
          
          $addOnCovers->IsLossOfUse="NO";
          $addOnCovers->IsEmergencyAssistanceCover=$isBreakDownAsCover;
          
          $addOnCovers->IsNoClaimBonusProtection="NO";
          
          $addOnCovers->IsEngineAndGearboxProtectorCover=$isEng_GearBoxProCover;
          $addOnCovers->IsCostOfConsumable=$isConsCover;
          $addOnCovers->IsReturntoInvoice=$isRtiCover;
          $addOnCovers->IsEmergencyAssistanceWiderCover=$isKeyLockProCover;
    	  $addOnCovers->IsTyreSecureCover=$isTyreProtect;
    	  
    	  
          
          $addOnCovers->NonelectricalAccessoriesIdv=$nonElecIdv;
          $addOnCovers->ElectricalAccessoriesIdv=$elecIdv;
          $addOnCovers->LpgCngKitIdv=$cngIdv;
    	  $addOnCovers->SelectedFuelType= $selectedFuleTyp;
    	  
          $addOnCovers->IsPAPaidDriver=$isPAUNPaidDriver;
          $addOnCovers->PAPaidDriverSumInsured=$PAPaidDriverSumInsured;
          
          $addOnCovers->IsPAUnnamedPassenger= $PA_UNPass;
          $addOnCovers->PAUnnamedPassengerNo=$PAUnnamedPassengerNo;
          $addOnCovers->PAPerUnnamedPassengerSumInsured=$PA_UNPassSumInsured;
          
          $addOnCovers->IsLegalLiabilityDriver=$LL_PaidDriver;
          $addOnCovers->LLPaidDriverNo=$LLPaidDriverNo;
          
          $addOnCovers->IsLLEmployee= $LL_EmpCover;
          $addOnCovers->LLEmployeeNo=$LLEmployeeNo;
          
    	  $addOnCovers->CpaYear= (int)$PA_OWNER;
       //$addOnCovers->IsTPPDDiscount="YES";
       if($plnTypeAddon!=''){
               $addOnCovers->planType = $plnTypeAddon;
        } 
        $proposalDetails->AddOnCovers =$addOnCovers;
       
        
        $customerDetails= new \stdClass();
        
        if($options['vehicle']['policyHolder']=="IND"){ 
            $Gender = isset($options['customer']['gender'])?strtoupper($options['customer']['gender']):"MALE";
             $ownerDOB    =  explode("-",$options['customer']['dob']);
            $customerDetails->Title=$options['customer']['salutation'];//($Gender=="MALE")?"Mr":"Ms";
            $customerDetails->Gender= $Gender;
            $customerDetails->FirstName=$options['customer']['first_name'];
            $customerDetails->MiddleName="";
            $customerDetails->LastName= $options['customer']['last_name'];
            $customerDetails->DateOfBirth= $ownerDOB[2]."-".$ownerDOB[1]."-".$ownerDOB[0];  
            $customerDetails->GstInNo= "";
            
        }else{
              $customerDetails->Title="M/S";
              $customerDetails->OrganizationName=$options['customer']['company'];
              $customerDetails->OrganizationContactPersonName=$options['customer']['first_name']." ".$options['customer']['last_name'];
              $customerDetails->GstInNo= $options['customer']['gstin'];
        }
       
     
      
        
        $customerDetails->EmailAddress=$options['customer']['email'];
        $customerDetails->MobileNumber= (int)$options['customer']['mobile'];
        $customerDetails->PanCard= "";
       
        $customerDetails->PospCode= "";
        $customerDetails->IsCustomerAuthenticated= "YES";
        $customerDetails->UidNo= "";
        $customerDetails->AuthentificationType= "OTP";
        $customerDetails->LGCode= "";
        $customerDetails->CorrespondenceAddress1= $options['address']['addressLine'];
        $customerDetails->CorrespondenceAddress2= $options['address']['addressLine'];
         $customerDetails->CorrespondenceAddress3= "";
        $customerDetails->CorrespondenceAddressCitycode= (int)$city->hdfcErgoCode;
        $customerDetails->CorrespondenceAddressCityName= strtoupper($city->name);
        $customerDetails->CorrespondenceAddressStateCode= (int)$state->hdfcErgoCode;
        $customerDetails->CorrespondenceAddressStateName=strtoupper($state->name);
        $customerDetails->CorrespondenceAddressPincode= (int)$options['address']['pincode'];
        if($preInfo->businessType=='USED'){
                $customerDetails->InspectionMethod = "SELF";
        	    $customerDetails->InspectionStateCode="";//(int)$state->hdfcErgoCode;
        	    $customerDetails->InspectionCityCode="";//(int)$city->hdfcErgoCode;
        	    $customerDetails->InspectionLocationCode=0;//143;
	         // $customerDetails->IsGoGreen=1;
          }
       $breakIn =  json_decode($enQ->breakInJson,true); 
       $proposalDetails->QuoteNo =  $breakIn['QuoteId'];
       $request->ProposalDetails =$proposalDetails; 
       $request->CustomerDetails =$customerDetails; 
       
        
        $request->UniqueRequestID = $jData->enq;
       
         // $header = ["accept: */*","Content-Type:application/json","MerchantKey:FINSERV","SecretToken:KxP8dEbeAWC+Ic7O7gFu9A=="];
         // $auth['header'] = $header;
         // $auth['url'] = "https://uatcp.hdfcergo.com/TWOnline/ChannelPartner/SaveTransaction";
          if($city->hdfcErgoCode!=""){
        //  $result = $this->curlPost(json_encode($request),$auth);
         // echo json_encode($request);
        //   die;
        
        
            
             $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.car.mKey'),'SecretToken'=>config('motor.HDFCERGO.car.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.car.postInspectionProposalGeneration'),
                ['body' => json_encode(
                    $request
                )]
            );
           
           $result = $clientResp->getBody()->getContents();
           //print_r($result);die;
           $response = json_decode($result);
           if($response->Status==200){
                   $txId = $response->Data->TransactionNo;
                   DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update(['token'=>$txId,'req'=>json_encode($request),'resp'=>($result)]);
                   return ['status'=>true,'isBreakIn'=>false,'message'=>'Proposal Created successfully'];

           }else if($response->Status==500){
                DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update(['req'=>json_encode($request),'resp'=>($result)]);
                return ['status'=>false,'message'=>$response->Message];
           }else if($response->Status==400){
                //$rsp = json_decode($response);
                 $msgs = $response->Message;
                //print_r($msgs);
                 $msg = current($msgs);
                 DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update(['req'=>json_encode($request),'resp'=>($result)]);
                 return ['status'=>false,'message'=>$msg];
           }else {
                return ['status'=>false,'message'=>'Sorry we are unable to process your request.'];
           }
          }else{
               return ['status'=>false,'message'=>'City code for '.$city->name.' is not mapped with our portal'];
          }
    }
    
    function policyGeneration($enquiry_id){
        $enQ = DB::table('app_quote')->where('enquiry_id', $enquiry_id)->first();
        $jData = json_decode($enQ->json_data);
        
        $request =  new \stdClass(); 
        $request->UniqueRequestID = $jData->enq;
        $request->TransactionNo =$enQ->token; 
        $request->AgentCode =config('motor.HDFCERGO.car.agentCode');//"FWC17723"; 
        
            // $header = ["accept: */*","Content-Type:application/json","MerchantKey:FINSERV","SecretToken:KxP8dEbeAWC+Ic7O7gFu9A=="];
            // $auth['header'] = $header;
            // $auth['url'] = "https://uatcp.hdfcergo.com/TWOnline/ChannelPartner/PolicyGeneration";
            // $result = $this->curlPost(json_encode($request),$auth);
            
            
            
            $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.car.mKey'),'SecretToken'=>config('motor.HDFCERGO.car.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.car.policyGeneration'),
                ['body' => json_encode(
                    $request
                )]
            );
           
           $result = $clientResp->getBody()->getContents();
           $response = json_decode($result);
           //print_r($result);
           $response = json_decode($result);
           if($response->Status==200){
                $PolicyNumber = $response->Data->PolicyNumber;
                //DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update(['token'=>$txId]);
                return ['status'=>true,'message'=>'Policy Generated successfully','data'=>$PolicyNumber];
           }else if($response->Status==500){
                return ['status'=>false,'message'=>$response->Message];
           }else {
                 return ['status'=>false,'message'=>'Internal error while get policy copy'];
           }
    } 
    
    function GetPDF($policyno){
        //$enQ = DB::table('policy_saled')->where('policy_no', $policyno)->first();
        
        $request =  new \stdClass(); 
        //$request->UniqueRequestID = $jData->enq;
        $request->PolicyNo =$policyno; 
        $request->AgentCd =config('motor.HDFCERGO.car.agentCode');//"FWC17723"; 
        
            // $header = ["accept: */*","Content-Type:application/json","MerchantKey:FINSERV","SecretToken:KxP8dEbeAWC+Ic7O7gFu9A=="];
            // $auth['header'] = $header;
            // $auth['url'] = "https://uatcp.hdfcergo.com/CPDownload/api/DownloadPolicy/PolicyDetails";
            // $result = $this->curlPost(json_encode($request),$auth);
          
            
            $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.car.mKey'),'SecretToken'=>config('motor.HDFCERGO.car.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.car.policyDownload'),
                ['body' => json_encode(
                    $request
                )]
            );
           
           $result = $clientResp->getBody()->getContents();
           // print_r($result);
           $response = json_decode($result);
          if($response->status==200){
                //$PolicyNumber = $response->Data->PolicyNumber;
                $fileName = "HDFCERGO_".$policyno.".pdf";
                $filePath1 = base64_decode($response->pdfbytes);
                $file1 = getcwd()."/public/assets/customers/policy/pdf/".$fileName;
                file_put_contents($file1, $filePath1);
                return  ['status'=>true,'filename'=>$fileName];
          }else if($response->status==500){
                return ['status'=>false,'message'=>$response->ErrMsg];
          }else {
                 return ['status'=>false,'message'=>'Internal error while policy copy'];
          }
    } 
    
   
    
   
    
}