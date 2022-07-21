<?php
namespace App\Resources;
use Nathanmac\Utilities\Parser\Parser;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Carbon\Carbon;
use Auth;
class HdfcErgoTwResource extends AppResource{ 
    
 
    
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
                return "OwnDamage";
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
                    $pa_od->title = "PA(Personal Accident) Owner Driver (5 Year)";
                    $pa_od->selection = true;
                    $pa_od->grossAmt = $cover->CoverPremium;
                    $pa_od->netAmt   = $cover->CoverPremium;
               }else if($cover->CoverName=="PACoverOwnerDriver" && ($subcover['isPA_OwnerDriverCover']=="true" && $subcoverval['PA_OwnerDriverCoverval']==1)){
                   $pa_od->selection = true;
                   $pa_od->title = "PA(Personal Accident) Owner Driver (1 Year)";
                   $pa_od->grossAmt = $cover->CoverPremium;
                   $pa_od->netAmt   = $cover->CoverPremium;
                }else if($cover->CoverName=="PACoverOwnerDriver5Year" && ($subcover['isPA_OwnerDriverCover']=="true" &&  $subcoverval['PA_OwnerDriverCoverval']==5)){
                    $pa_od->title = "PA(Personal Accident) Owner Driver (5 Year)";
                    $pa_od->selection = true;
                    $pa_od->grossAmt = $cover->CoverPremium;
                    $pa_od->netAmt   = $cover->CoverPremium;
                }
                
                
                 if($cover->CoverName=='UnnamedPassenger' && $subcover['isPA_UNPassCover']=="true"){ 
                        $pa_un_pass->insuredValue  = $subcoverval['PA_UNPassCoverval'];
                        $pa_un_pass->selection = true;
                        $pa_un_pass->grossAmt = $cover->CoverPremium;
                        $pa_un_pass->netAmt   = $cover->CoverPremium;
                 }
                 if($cover->CoverName=='ZeroDepreciation' && $subcover['isPartDepProCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = 'Zero Depreciation cover';
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 if($cover->CoverName=='EmergencyAssistance' && $subcover['isBreakDownAsCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = 'Road Side Assistance';
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 if($cover->CoverName=='EngineProtection' && $subcover['isEng_GearBoxProCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = 'Engine Protect';
                               $eachAddon->code    = $cover->CoverName;
                               $eachAddon->insured = 1; 
                               $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                  if($cover->CoverName=='CashAllowance' && $subcover['isCashAllowCover']=="true"){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = 'Cash Allowance';
                               $eachAddon->code    = $cover->CoverName;
                                $eachAddon->grossAmt= $cover->CoverPremium;
                               $eachAddon->netAmt  = $cover->CoverPremium;
                               array_push($addons,$eachAddon);
                 }
                 
                 
                 
                 
        
                
                 if($cover->CoverName=="LLPaidDriver" && $subcover['isLL_PaidDriverCover']=="true" ){
                        $ll_paid_driver->selection =true;
                        $ll_paid_driver->insured  = 1; 
                        $ll_paid_driver->grossAmt =  $cover->CoverPremium;
                        $ll_paid_driver->netAmt   =   $cover->CoverPremium;
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
                         $eachDis->percent = $data->Data[0]->NewNcbDiscountPercentage*100;
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
            $vehicle->newNCB = isset($data->Data[0]->NewNcbDiscountPercentage)?($data->Data[0]->NewNcbDiscountPercentage*100):"";
            $vehicle->idv    =isset($data->Data[0]->VehicleIdv)?$data->Data[0]->VehicleIdv:0;
            $vehicle->minIdv =isset($data->Data[0]->VehicleIdvMin)?$data->Data[0]->VehicleIdvMin:0;
            $vehicle->maxIdv =isset($data->Data[0]->VehicleIdvMax)?$data->Data[0]->VehicleIdvMax:0;
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
                                         $res->expDate =date('Y-m-d', strtotime('+10 days'));
                                    }
                                   
                                }
                              //$res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                              //$res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
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
                                                 $res->expDate =date('Y-m-d', strtotime('-100 days'));
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
                                      // $res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                       //$res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                                       
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
                                      //$res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                     // $res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                                       $res->prePolicyType = !empty($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):"Comprehensive";
                                       if($res->prePolicyType=="ThirdParty"){
                                            $res->ncb = "ZERO";//isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                             $res->hasPreClaim = 'YES';//($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                                       }else{
                                             $res->ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                             $res->hasPreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?"YES":"NO";
                                       }
                                      $res->isPreviousInsurerKnown = true;
                                      $res->businessType   = "Rollover";
                             }else if($params['previousInsurance']['exp']=="0"){ 
                                      $res->expDate = "";
                                      $res->ncb = "ZERO";	
                                      $res->hasPreClaim="";
                                      $res->isPreviousInsurerKnown = false;
                                      $res->businessType   = "USED";
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
            if($params['previousInsurance']['policyType']=='TP'){
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
        
              $options = $params['subcovers'];
              $optionValues  = $params['coverValues'];
              $preInfo = $this->GetPreviousPolicyData($params,"Premium");
              
              if((isset($options['isPA_OwnerDriverCover']) && $options['isPA_OwnerDriverCover']=='true')){ 
                  if($params['planType']=="TP" && $preInfo->businessType=="NEW"){
                        $PA_OWNER =5;
                      }else{ 
                           $paCoverVal = isset($optionValues['PA_OwnerDriverCoverval'])?$optionValues['PA_OwnerDriverCoverval']:1;
                           $PA_OWNER =$paCoverVal;
                      }
                  
              }else{
                  $PA_OWNER =0;
              }
             
              if((isset($options['isPA_UNPassCover']) && $options['isPA_UNPassCover']=='true')){
                 $paCoverVal = isset($optionValues['PA_UNPassCoverval'])?$optionValues['PA_UNPassCoverval']:10000;
                 $PA_UNPass =$paCoverVal;
              }else{
                  $PA_UNPass =0;
              }
             
              $LL_PaidDriver = (isset($options['isLL_PaidDriverCover']) && $options['isLL_PaidDriverCover']=='true')?'YES':'NO';
            
              $zeroDep = (isset($options['isPartDepProCover']) && $options['isPartDepProCover']=='true')?'YES':'NO';
              $isEng_GearBoxProCover = (isset($options['isEng_GearBoxProCover']) && $options['isEng_GearBoxProCover']=='true')?'YES':'NO';
              $isBreakDownAsCover = (isset($options['isBreakDownAsCover']) && $options['isBreakDownAsCover']=='true')?'YES':'NO';
              $isCashAllowCover = (isset($options['isCashAllowCover']) && $options['isCashAllowCover']=='true')?'YES':'NO';
            
              $insuranceProductCode =  $this->productCode($params['planType']); 
              $isVehicleNew = $params['vehicle']['isBrandNew'];
              $policyHolder =($params['vehicle']['policyHolder']=='IND')?"INDIVIDUAL":"Corporate";//CORPORATE
              
              
               $rto_master=DB::table('rtoMaster')->select('rtoMaster.rtoCode as rtoCode','rtoMaster.hdfcErgoCodeTw as hdfcErgoCodeTw','cities.id as cityId',
                                                           'states.id as stateId','cities.hdfcErgoCode as cityCode','states.hdfcErgoCode as stateCode')
                                ->where('rtoCode',strtoupper($params['vehicle']['rtoCode']))
                                ->leftJoin('cities', 'cities.id', '=', 'rtoMaster.city_id')
                                ->leftJoin('states', 'states.id', '=', 'cities.state_id')->first();
              
              
              
            //  $rto_master=DB::table('rto_master')->where('region_code',strtoupper($params['vehicle']['rtoMaster']))->first();
              $makeCode=DB::table('vehicle_make_tw')->where('id',$params['vehicle']['brand']['id'])->value('hdfcErgo_makeCode');
              $modelCode=DB::table('vehicle_variant_tw')->where('id',$params['vehicle']['varient']['id'])->value('hdfcErgo_code');
              $regDate = $params['vehicle']['regYear']."-".$params['vehicle']['regMonth']."-".$params['vehicle']['regDate'];
          
              $rto_master=DB::table('rtoMaster')->select('rtoMaster.rtoCode as rtoCode','rtoMaster.hdfcErgoCodeTw as hdfcErgoCodeTw','cities.id as cityId',
                                                          'states.id as stateId','cities.hdfcErgoCode as cityCode','states.hdfcErgoCode as stateCode')
                                                ->where('rtoCode',strtoupper($params['vehicle']['rtoCode']))
                                                ->leftJoin('cities', 'cities.id', '=', 'rtoMaster.city_id')
                                                ->leftJoin('states', 'states.id', '=', 'cities.state_id')->first();
                                               // print_r($rto_master);die;
             
             
            
                $request =  new \stdClass();
                $configurationParam = new \stdClass();
                $configurationParam->AgentCode = config('motor.HDFCERGO.tw.agentCode');//"TWC17722";
                $request->ConfigurationParam = $configurationParam;
                $request->TypeOfBusiness = $preInfo->businessType;
                $request->PolicyType = $insuranceProductCode;
                $request->CustomerType = $policyHolder;
                $request->CustomerStateCode = (int)$rto_master->stateCode;
                $request->RtoLocationCode = (int)$rto_master->hdfcErgoCodeTw;
                $request->VehicleModelCode = (int)$modelCode;
                $request->VehicleMakeCode = (int)$makeCode;
                $request->RequiredIDV = 0;
                if($preInfo->isPreviousInsurerKnown){
                  $request->PreviousPolicyType = $preInfo->prePolicyType; 
                  $request->PreviousPolicyEndDate = $preInfo->expDate; 
                  $request->IsPreviousClaim = $preInfo->hasPreClaim;
                  $request->PreviousNCBDiscountPercentage = $preInfo->ncbPercent;
                  
                  
               }
               if($params['planType']=="SAOD"){
                     $TPEnd = explode('-',$params['TP']['TPpolicyEndDate']);
                     $request->TPEndDate = $TPEnd[2]."-".$TPEnd[1]."-".$TPEnd[0];
                   }
                
                $request->PurchaseRegistrationDate = $regDate;
                $request->PospCode = (isset(Auth::guard('agents')->user()->id))?Auth::guard('agents')->user()->hdfcErgoCode:"";
                
                $plnTypeAddon = "";
                if($isCashAllowCover=='YES'){
                    $plnTypeAddon = !empty($plnTypeAddon)?$plnTypeAddon.',CASHALLOW':'CASHALLOW';
                }
                if($isEng_GearBoxProCover=='YES'){
                    $plnTypeAddon = !empty($plnTypeAddon)?$plnTypeAddon.',ENGEBOX':'ENGEBOX';
                }
               
                $addOnCovers = new \stdClass();
                $addOnCovers->IsLegalLiabilityDriver= $LL_PaidDriver;
                $addOnCovers->UnnamedPassengerSumInsured =$PA_UNPass;
               // $addOnCovers->IsTPPDDiscount="YES";
                $addOnCovers->IsZeroDepCover= $zeroDep;
                $addOnCovers->IsEmergencyAssistanceCover= $isBreakDownAsCover;
                $addOnCovers->IsEngineAndGearboxProtectorCover= $isEng_GearBoxProCover;
                $addOnCovers->IsCashAllowanceCover =  $isCashAllowCover;
                $addOnCovers->CpaYear= $PA_OWNER;
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
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.tw.mKey'),'SecretToken'=>config('motor.HDFCERGO.tw.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.tw.calculatePremium'),['body' => json_encode( $request)] );
        //  echo json_encode( $request);die;
            $result = $clientResp->getBody()->getContents();
       // print_r($result);die;
            $response = json_decode($result);
           
           DB::table('app_temp_quote')->where(['type'=>'BIKE','device'=>$deviceToken,'provider'=>'HDFCERGO'])->delete();
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
                  $quoteData = ['quote_id'=>$response->UniqueRequestID,'type'=>'BIKE','title'=>$partner,'tenure'=>$response->Data[0]->PremiumYear,
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
                                'netAmt'=>str_replace(',','',str_replace('INR','',$response->Data[0]->NetPremiumAmount)),
                                'taxAmt'=>str_replace(',','',str_replace('INR','',$response->Data[0]->TaxAmount)),
                                'grossAmt'=>str_replace(',','',str_replace('INR','',$response->Data[0]->TotalPremiumAmount)),
                                'json_data'=>json_encode($json_data),
                                'req'=>json_encode($request),'resp'=>($result)];
              DB::table('app_temp_quote')->where(['type'=>'BIKE','device'=>$deviceToken,'provider'=>'HDFCERGO'])->delete();
              $quoteID = DB::table('app_temp_quote')->insertGetId($quoteData);
              return ['status'=>true,'plans'=>$plan];
            }else{
              return ['status'=>false,'plans'=>[],'message'=>'Sorry we are unable to process your request.'];
            }
         }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
              
                return ['status' => false,'plans'=>[], 'message' => 'Something went wrong'];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
               //  print_r($responseBodyAsString);die;
                return ['status' => false,'plans'=>[], 'message' => 'Something went wrong'];
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return ['status' =>false, 'plans'=>[],'message' => 'Something went wrong'];
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
          //  echo  json_encode($request);
          // $header = ["accept: */*","Content-Type:application/json","MerchantKey:FINSERV","SecretToken:KxP8dEbeAWC+Ic7O7gFu9A=="];
           //$auth['header'] = $header;
          // $auth['url'] = "https://uatcp.hdfcergo.com/TWOnline/ChannelPartner/CalculatePremium";
           //$result = $this->curlPost(json_encode($request),$auth);
           
            $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.tw.mKey'),'SecretToken'=>config('motor.HDFCERGO.tw.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.tw.calculatePremium'),
                ['body' => json_encode(
                    $request
                )]
            );
            $result = $clientResp->getBody()->getContents();
           //print_r($result); 
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
                  $_quoteData = ['quote_id'=>$response->UniqueRequestID,'type'=>'BIKE','title'=>$partner,
                                'device'=>$deviceToken,'provider'=>'HDFCERGO','policyType'=>$params['planType'],
                                'min_idv'=>isset($response->Data[0]->VehicleIdvMin)?$response->Data[0]->VehicleIdvMin:0,
                                'max_idv'=>isset($response->Data[0]->VehicleIdvMax)?$response->Data[0]->VehicleIdvMax:0,
                                'idv'    =>isset($response->Data[0]->VehicleIdv)?$response->Data[0]->VehicleIdv:0,
                                'call_type'=>"QUOTE",
                                 'reqRecalculate'=>json_encode($request),
                                 'respRecalculate'=>$result,
                                'netAmt'=>str_replace(',','',str_replace('INR','',$response->Data[0]->NetPremiumAmount)),
                                'taxAmt'=>str_replace(',','',str_replace('INR','',$response->Data[0]->TaxAmount)),
                                'grossAmt'=>str_replace(',','',str_replace('INR','',$response->Data[0]->TotalPremiumAmount)),
                                'json_data'=>json_encode($json_data),
                                'req'=>json_encode($request),'resp'=>($result)];
                                
              $quoteID = DB::table('app_temp_quote')->where('id',$quoteData->id)->update($_quoteData);
              return ['status'=>true,'plans'=>$plan];
            }else{
              return ['status'=>false,'plans'=>[]];
            }
         }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
              
                return ['status' => false,'plans'=>[], 'message' => 'Something went wrong'];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
               //  print_r($responseBodyAsString);die;
                return ['status' => false,'plans'=>[], 'message' => 'Something went wrong'];
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return ['status' =>false, 'plans'=>[],'message' => 'Something went wrong'];
            }

    }
    
    function createProposal($enquiry_id,$options){
         $enQ = DB::table('app_quote')->where('enquiry_id', $enquiry_id)->first();
         $jData = json_decode($enQ->json_data);
         $params = json_decode($enQ->params_request);
        // $preInfo = $this->GetPreviousPolicyData($options,"Proposal");
         $preInfo = $this->GetPreviousPolicyData(json_decode(json_decode(json_encode($enQ->params_request)),true),"Proposal");
         $insuranceProductCode =  $this->productCode($enQ->policyType); 
        
          $subcovr = $params->subcovers;
          $optionValues  = $params->coverValues;
          $idv = $enQ->idv;//isset($params->vehicle->idv->value)?$params->vehicle->idv->value:0;
         
            if((isset($subcovr->isPA_OwnerDriverCover) && $subcovr->isPA_OwnerDriverCover=='true')){
                if($params->planType=="TP" && $preInfo->businessType=="NEW"){
                        $PA_OWNER =5;
                      }else{ 
                         $paCoverVal = isset($optionValues->PA_OwnerDriverCoverval)?$optionValues->PA_OwnerDriverCoverval:1;
                         $PA_OWNER =$paCoverVal;
                      }
             }else{
                  $PA_OWNER =0;
             }
             
            
             
             if((isset($subcovr->isPA_UNPassCover) && $subcovr->isPA_UNPassCover=='true')){
                 $paCoverVal = isset($optionValues->PA_UNPassCoverval)?$optionValues->PA_UNPassCoverval:10000;
                 $PA_UNPass =$paCoverVal;
             }else{
                  $PA_UNPass =0;
             }
             
        $LL_PaidDriver = (isset($subcovr->isLL_PaidDriverCover) && $subcovr->isLL_PaidDriverCover=='true')?'YES':'NO';
       
        $zeroDep = (isset($subcovr->isPartDepProCover) && $subcovr->isPartDepProCover=='true')?'YES':'NO';
        $isEng_GearBoxProCover = (isset($subcovr->isEng_GearBoxProCover) && $subcovr->isEng_GearBoxProCover=='true')?'YES':'NO';
        $isBreakDownAsCover = (isset($subcovr->isBreakDownAsCover) && $subcovr->isBreakDownAsCover=='true')?'YES':'NO';
       	$isCashAllowCover = (isset($subcovr->isCashAllowCover) && $subcovr->isCashAllowCover=='true')?'YES':'NO';
       
       
        
        
       
              if(isset($params->vehicle->vehicleNumber)){
                  $vNo  = $params->vehicle->vehicleNumber;
                  $vehicleNo = substr($vNo, 0,2)."-".substr($vNo, 2,2)."-".substr($vNo, 4,2)."-".substr($vNo, 6,4);
               }else{
                  $vNo = $params->vehicle->rtoCode;
                  $vehicleNo = substr($vNo, 0,1)."-".substr($vNo, 2,3);
               }
            $vehicleNo = ($preInfo->businessType=="NEW")?"NEW":$vehicleNo;
         
         
        
        
        $policyHolder =($params->vehicle->policyHolder=='IND')?"INDIVIDUAL":"Corporate";
        //$rto_master=DB::table('rto_master')->where('region_code',strtoupper($params->vehicle->rtoCode))->first();
        $rto_master=DB::table('rtoMaster')->select('rtoCode as rtoCode','hdfcErgoCodeTw')
                                           ->where('rtoCode',strtoupper($params->vehicle->rtoCode))->first();
        //print_r($rto_master);die;
        $makeCode=DB::table('vehicle_make_tw')->where('id',$params->vehicle->brand->id)->value('hdfcErgo_makeCode');
        $modelCode=DB::table('vehicle_variant_tw')->where('id',$params->vehicle->varient->id)->value('hdfcErgo_code');
        $regDate = $params->vehicle->regYear."-".$params->vehicle->regMonth."-".$params->vehicle->regDate;
        
        $cityID = explode('-',$params->address->city)[0];
        $stateID = explode('-',$params->address->state)[0];
        
        $state =  DB::table('states')->where('id',$stateID)->first();
        $city  =  DB::table('cities')->where('id',$cityID)->first();
        
        
        $FinancierCode = isset($params->vehicle->hypothecationAgency)?DB::table('financiers')->where('id', $params->vehicle->hypothecationAgency)->value('hdfcErgoCode'):"";
        $request =  new \stdClass();
       
        $request->UniqueRequestID = $jData->enq;
        $proposalDetails = new \stdClass();
       
       $configurationParam = new \stdClass();
       $configurationParam->AgentCode = config('motor.HDFCERGO.tw.agentCode');//"TWC17722";
       $proposalDetails->ConfigurationParam = $configurationParam;
       if($params->planType=="TP" && $preInfo->businessType=="NEW"){
          $proposalDetails->PremiumYear =5;
       }else{
          $proposalDetails->PremiumYear =$enQ->termYear; 
       }
       $proposalDetails->TypeOfBusiness =$preInfo->businessType;;
       $proposalDetails->CustomerType = $policyHolder;
       $proposalDetails->RtoLocationCode = (int)$rto_master->hdfcErgoCodeTw;
       $proposalDetails->VehicleModelCode = (int)$modelCode;
       $proposalDetails->VehicleMakeCode = (int)$makeCode;
       $proposalDetails->RequiredIdv = (int)$idv;
       if($preInfo->isPreviousInsurerKnown===true){
           $proposalDetails->PreviousPolicyEndDate =$preInfo->expDate;
           $proposalDetails->PreviousPolicyType = $preInfo->prePolicyType;
           $proposalDetails->IsPreviousClaim =strtoupper($preInfo->hasPreClaim);
           $proposalDetails->PreviousNCBDiscountPercentage =(int)$preInfo->ncbPercent;
           $proposalDetails->PreviousInsurerCode=(int)$preInfo->preInsurerCode;
           $proposalDetails->PreviousPolicyNumber=$preInfo->prePolicyNo;
       }
       $proposalDetails->PurchaseRegistrationDate = $regDate;
       
       $proposalDetails->YearofManufacture = (int)$params->vehicle->regYear;
       
       $proposalDetails->FinancierCode = (int)$FinancierCode;
       $proposalDetails->RegistrationNo = $vehicleNo;
       $proposalDetails->EngineNo =  ($params->vehicle->engineNumber)?$params->vehicle->engineNumber:null;
       $proposalDetails->ChassisNo = ($params->vehicle->chassisNumber)?$params->vehicle->chassisNumber:null;
       $proposalDetails->NetPremiumAmount = (int)$enQ->netAmt;
       $proposalDetails->TotalPremiumAmount =(int)$enQ->grossAmt;
       $proposalDetails->TaxAmount = (int)$enQ->taxAmt;
       $isNom = (isset($subcovr->isPA_OwnerDriverCover) && $subcovr->isPA_OwnerDriverCover=='true')?true:false;
       $nomineeRelation = ['BROTHER'=>'Sibling','HUSBAND'=>'Spouse','GRAND_FATHER'=>'','GRAND_MOTHER'=>'','FATHER_IN_LAW'=>'','MOTHER_IN_LAW'=>'Mother','MOTHER'=>'Mother','SISTER'=>'Sibling','SON'=>'Son','DAUGHTER'=>'Daughter','FATHER'=>'Father','SPOUSE'=>'Spouse'];
        if($params->vehicle->policyHolder=="IND" && $isNom){ 
            $proposalDetails->PAOwnerDriverNomineeName = ($isNom)?$params->nominee->name:"";
            if($isNom){
              $nDob = Carbon::createFromFormat('d-m-Y', $params->nominee->dob)->format('Y-m-d');
           }
          $proposalDetails->PAOwnerDriverNomineeAge = ($isNom)?$this->calulateAge($nDob):"";
          $proposalDetails->PAOwnerDriverNomineeRelationship = ($isNom)?$nomineeRelation[$params->nominee->relation]:"";
        }
       $proposalDetails->PolicyType = $insuranceProductCode;
       
             $plnTypeAddon = "";
            if($isCashAllowCover=='YES'){
                $plnTypeAddon = !empty($plnTypeAddon)?$plnTypeAddon.',CASHALLOW':'CASHALLOW';
            }
            if($isEng_GearBoxProCover=='YES'){
                $plnTypeAddon = !empty($plnTypeAddon)?$plnTypeAddon.',ENGEBOX':'ENGEBOX';
            }
       
       $addOnCovers = new \stdClass();
       $addOnCovers->IsLegalLiabilityDriver=$LL_PaidDriver;
       $addOnCovers->UnnamedPassengerSumInsured= (int)$PA_UNPass;
       $addOnCovers->IsZeroDepCover=$zeroDep;
       $addOnCovers->IsEmergencyAssistanceCover=$isBreakDownAsCover;
       $addOnCovers->IsEngineAndGearboxProtectorCover= $isEng_GearBoxProCover;
       $addOnCovers->IsCashAllowanceCover =  $isCashAllowCover;
       $addOnCovers->CpaYear= $PA_OWNER;
       //$addOnCovers->IsTPPDDiscount="YES";
       if($plnTypeAddon!=''){
               $addOnCovers->planType = $plnTypeAddon;
        } 
        $proposalDetails->AddOnCovers =$addOnCovers;
       
       
        
        $customerDetails= new \stdClass();
        
        if($params->vehicle->policyHolder=="IND"){ 
            $Gender = isset($params->customer->gender)?strtoupper($params->customer->gender):"MALE";
             $ownerDOB    =  explode("-",$params->customer->dob);
            $customerDetails->Title=$params->customer->salutation;//($Gender=="MALE")?"Mr":"Ms";
            $customerDetails->Gender= $Gender;
            $customerDetails->FirstName=$params->customer->first_name;
            $customerDetails->MiddleName="";
            $customerDetails->LastName= $params->customer->last_name;
            $customerDetails->DateOfBirth= $ownerDOB[2]."-".$ownerDOB[1]."-".$ownerDOB[0];  
            $customerDetails->GstInNo= "";
            
        }else{
              $customerDetails->Title="M/S";
              $customerDetails->OrganizationName=$params->customer->company;
              $customerDetails->OrganizationContactPersonName=$params->customer->first_name." ".$params->customer->last_name;
              $customerDetails->GstInNo= $params->customer->gstin;
        }
       
     
      
        
        $customerDetails->EmailAddress=$params->customer->email;
        $customerDetails->MobileNumber= (int)$params->customer->mobile;
        $customerDetails->PanCard= "";
       
        $customerDetails->PospCode= (isset(Auth::guard('agents')->user()->id))?Auth::guard('agents')->user()->hdfcErgoCode:"";
        $customerDetails->IsCustomerAuthenticated= "YES";
        $customerDetails->UidNo= "";
        $customerDetails->AuthentificationType= "";
        $customerDetails->LGCode= "";
        $customerDetails->CorrespondenceAddress1= $params->address->addressLineOne;
        $customerDetails->CorrespondenceAddress2= $params->address->addressLineTwo;
        $customerDetails->CorrespondenceAddressCitycode= (int)$city->hdfcErgoCode;
        $customerDetails->CorrespondenceAddressCityName= strtoupper($city->name);
        $customerDetails->CorrespondenceAddressStateCode= (int)$state->hdfcErgoCode;
        $customerDetails->CorrespondenceAddressStateName=strtoupper($state->name);
        $customerDetails->CorrespondenceAddressPincode= (int)$params->address->pincode;
        
        if($insuranceProductCode=="OwnDamage"){
            $policyStartDate= isset($params->TP->TPpolicyStartDate)?explode('-',$params->TP->TPpolicyStartDate):null;
            $policyTPEndDate= isset($params->TP->TPpolicyEndDate)?explode('-',$params->TP->TPpolicyEndDate):null;
            $preInsurerCode = DB::table('previous_insurer')->where('id', $params->TP->TPInsurer)->value('hdfcErgo');
            $proposalDetails->ExistingInsurerId=$preInsurerCode;
            $proposalDetails->ExistingPolicyNumber=$params->TP->TP_policyno;
            $proposalDetails->ExistingPolicyStartDate=$policyStartDate[2]."-".$policyStartDate[1]."-".$policyStartDate[0];
            $proposalDetails->ExistingPolicyEndDate=$policyTPEndDate[2]."-".$policyTPEndDate[1]."-".$policyTPEndDate[0];
        }
        
       $request->ProposalDetails =$proposalDetails; 
       $request->CustomerDetails =$customerDetails; 
       // $header = ["accept: */*","Content-Type:application/json","MerchantKey:FINSERV","SecretToken:KxP8dEbeAWC+Ic7O7gFu9A=="];
       //   $auth['header = $header;
       //   $auth['url = "https://uatcp.hdfcergo.com/TWOnline/ChannelPartner/SaveTransaction";
          //  $result = $this->curlPost(json_encode($request),$auth);
          if($city->hdfcErgoCode!=""){
              
              
                $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.tw.mKey'),'SecretToken'=>config('motor.HDFCERGO.tw.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.tw.proposalGeneration'),
                ['body' => json_encode(
                    $request
                )]
            );
            $result = $clientResp->getBody()->getContents();
     
        //   echo json_encode($request);
        //   die;
        // print_r($result->Message);die;
           $response = json_decode($result);
         
           if($response->Status==200){
               $txId = $response->Data->TransactionNo;
                $cust = isset($params->customer->first_name)?$params->customer->first_name." ".$params->customer->last_name:$params->customer->company;
                $QDATA = ['customer_name'=>$cust,'token'=>$txId,'reqCreate'=>json_encode($request),'respCreate'=>$result,'req'=>json_encode($request),'resp'=>($result)];
                $QDATA['startDate'] = isset($response->Data->NewPolicyStartDate)?$response->Data->NewPolicyStartDate:NULL;
                $QDATA['endDate'] = isset($response->Data->NewPolicyEndDate)?$response->Data->NewPolicyEndDate:NULL;
                DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update($QDATA);
                return ['status'=>true,'message'=>'Proposal Created successfully'];
           }else if($response->Status==500){
                DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update(['reqCreate'=>json_encode($request),'respCreate'=>$result,'req'=>json_encode($request),'resp'=>($result)]);
                return ['status'=>false,'message'=>$response->Message];
           }else if($response->Status==400){
               $msg ="";
              if(is_object($response->Message)){
                 $msg =  current(($response->Message));
              }
               // $msg = $response->Message;
              //  print_r($msgs);
               // $msg = "";//current($msgs);
                 DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update(['reqCreate'=>json_encode($request),'respCreate'=>$result,'req'=>json_encode($request),'resp'=>($result)]);
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
        $request->AgentCode =config('motor.HDFCERGO.tw.agentCode');//"TWC17722";
        
          
           $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.tw.mKey'),'SecretToken'=>config('motor.HDFCERGO.tw.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.tw.policyGeneration'),
                ['body' => json_encode(
                    $request
                )]
            );
            $result = $clientResp->getBody()->getContents();
          
          // print_r($result);
           $response = json_decode($result);
           
            DB::table('app_quote')->where('enquiry_id', $enquiry_id)->update(['reqSaveGenPolicy'=>json_encode($request),'respSaveGenPolicy'=>$result]);
           if($response->Status==200){
                $PolicyNumber = $response->Data->PolicyNumber;
                $status = ($response->Data->PaymentStatus=="UPD")?false:true;
                $msg = ($response->Data->PaymentStatus=="UPD")?"Something went wrong while genrate policy":"Policy Generated successfully";
                //DB::table('app_quote')->where('enquiry_id',$enquiry_id)->update(['token'=>$txId]);
                return ['status'=>$status,'message'=>$msg,'data'=>$PolicyNumber];
           }else if($response->Status==500){
                return ['status'=>false,'message'=>$response->Message];
           }else {
                 return ['status'=>false,'message'=>'Internal error while create proposal'];
           }
    } 
    
    function GetPDF($policyno){
        //$enQ = DB::table('policy_saled')->where('policy_no', $policyno)->first();
        
        $request =  new \stdClass(); 
        //$request->UniqueRequestID = $jData->enq;
        $request->PolicyNo =$policyno; 
        $request->AgentCd =config('motor.HDFCERGO.tw.agentCode');//"TWC17722";
        
          //  $header = ["accept: */*","Content-Type:application/json","MerchantKey:FINSERV","SecretToken:KxP8dEbeAWC+Ic7O7gFu9A=="];
          //  $auth['header'] = $header;
          //  $auth['url'] = "https://uatcp.hdfcergo.com/CPDownload/api/DownloadPolicy/PolicyDetails";
            //$result = $this->curlPost(json_encode($request),$auth);
           // print_r($result);
           
           $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('motor.HDFCERGO.tw.mKey'),'SecretToken'=>config('motor.HDFCERGO.tw.secretToken')]
            ]);
            
            $clientResp = $client->post(config('motor.HDFCERGO.tw.policyDownload'),
                ['body' => json_encode(
                    $request
                )]
            );
            $result = $clientResp->getBody()->getContents();
          
                
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
                 return ['status'=>false,'message'=>'Internal error while generate policy copy'];
          }
    } 
    
   function bugReport(){
        $request =  new \stdClass(); 
        $request->MasterKey = "CITY";
        $request->PolicyType ="ALL"; 
        $request->AgentCode ="TWD22020";
        $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>"SUPER FINSERV PRIVATE LIMITED",'SecretToken'=>"7+aEy4DrMHumytddFoJbzg=="]
            ]);
            
            $clientResp = $client->post("https://chpa.heaggregator.com/CPTWOnline/ChannelPartner/GetMasterData",
                ['body' => json_encode(
                    $request
                )]
            );
            $result = $clientResp->getBody()->getContents();
            
        //   print_r($result);
           $response = json_decode($result);
           echo  json_encode($response,JSON_PRETTY_PRINT);
           //print_r($response);
    }
    
   
    
   
    
}