<?php
namespace App\Resources;
use Nathanmac\Utilities\Parser\Parser;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
//use App\Resources\Services;
use Auth;


class DigitBikeResource extends AppResource{ 
   
    
    public function __construct(){
       $this->policyholder=['IND'=>'INDIVIDUAL','COR'=>'COMPANY'];
    }
    
    public function productCode($plan){
    
            switch ($plan) {
              case "COM":
                return "20201";
                break;
              case "TP":
                return "20202";
                break;
              case "SAOD":
                return "20203";
                break;
              default:
                return "20201";
            }
    }
    
    function getJsonData($response){
            //$resp = $temp->response;
            $data = json_decode($response);
            
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
            
           
            
            $addons = [];
            foreach($data->contract->coverages as $cover){
               
                if($cover->coverCode=="THIRD_PARTY"){
                     foreach($cover->subCovers as $sub){
                         if($sub->selection){
                              $tp->selection = true;
                              $tp->grossAmt  = trim(str_replace('INR', '', $sub->netPremium));
                              $tp->netAmt    = trim(str_replace('INR', '', $sub->netPremium));
                         }
                     }
                }
                
                if($cover->coverCode=="OWN_DAMAGE"){
                     if($cover->selection){
                         $od->selection = true;
                         $od->grossAmt = trim(str_replace('INR', '', $cover->netPremium));
                         $od->netAmt   = trim(str_replace('INR', '', $cover->netPremium));
                         
                         
                         foreach($cover->subCovers as $sub_od){
                          
                           if($sub_od->selection=='true' && ($sub_od->coverAvailability=='MANDATORY' || $sub_od->coverAvailability=='AVAILABLE') && ($sub_od->name=="CNG Kit - IMT 25" || $sub_od->name=="Electrical Accessories - IMT 24" || $sub_od->name=="Non Electrical Accessories - IMT 24")){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = $sub_od->name;
                               $eachAddon->code    = $sub_od->coverCode;
                               $eachAddon->insured = $sub_od->value->insuredValue; 
                               $eachAddon->grossAmt= trim(str_replace('INR', '',$sub_od->netPremium));
                               $eachAddon->netAmt  = trim(str_replace('INR', '',$sub_od->netPremium));
                               array_push($addons,$eachAddon);
                           }
                         }
                     }
                }
                
                if($cover->coverCode=="PA_OWNER"){
                    if($cover->selection ==true ){
                       foreach($cover->subCovers as $sub){
                           if($sub->selection==true && $sub->componentNumber=="10028"){ //$sub->coverAvailability=='MANDATORY'
                             $pa_od->selection = true;
                             $pa_od->grossAmt = trim(str_replace('INR', '', $sub->netPremium));
                             $pa_od->netAmt   = trim(str_replace('INR', '', $sub->netPremium));
                            }  
                       }
                        
                    }
                    
                }
                
                // if($cover->coverCode=="PA_OWNER"){
                //     foreach($cover->subCovers as $sub){
                //         if($sub->selection==true){ //$sub->coverAvailability=='MANDATORY'
                //          $pa_od->selection = true;
                //          $pa_od->grossAmt = trim(str_replace('INR', '', $sub->netPremium));
                //          $pa_od->netAmt   = trim(str_replace('INR', '', $sub->netPremium));
                //         }  
                //     }
                // }
                
                if($cover->coverCode=="PA_UNNAMED"){
                    if($cover->selection){
                      foreach($cover->subCovers as $sub){
                        
                        // cover for passangers
                        if($sub->name=="PA cover for Unnamed Passenger - IMT 16"){
                             $_sub1 = 0;
                             $pa_un_pass->insuredValue = $sub->value->insuredValue;
                             foreach($sub->subCovers as $_sub){
                                 if($sub->selection=='true' && $_sub->name=="Number of Unnamed Passenger"){
                                    $pa_un_pass->selection =true;
                                    $pa_un_pass->insured = $_sub->value->insuredValue; 
                                    $pa_un_pass->grossAmt =  trim(str_replace('INR', '', $sub->netPremium));
                                    $pa_un_pass->netAmt =  trim(str_replace('INR', '', $sub->netPremium));
                                 }
                                 
                                 $_sub1++;
                                if ($_sub1 == 0) break; 
                             }
                        }// end PA cover for Unnamed Passenger - IMT 16
                        
                        // cover for passangers
                        if($sub->name=="PA cover for Paid Driver - IMT 17"){
                             $_sub2 = 0;
                             $pa_paid_driver->insuredValue = $sub->value->insuredValue;
                             foreach($sub->subCovers as $_sub_){
                                 if($sub->selection=='true' && $_sub_->name=="Number of Paid Driver"){
                                    $pa_paid_driver->selection =true;
                                    $pa_paid_driver->insured = $_sub_->value->insuredValue; 
                                    $pa_paid_driver->grossAmt =  trim(str_replace('INR', '', $sub->netPremium));
                                    $pa_paid_driver->netAmt = trim(str_replace('INR', '', $sub->netPremium));
                                 }
                                 
                                 $_sub2++;
                                if ($_sub2 == 0) break; 
                             }
                        } // end PA cover for Paid Driver - IMT 17
                        
                      }
                    }
                }// End PA_UNNAMED
                
                if($cover->coverCode=="LEGAL_LIABILITY"){
                    if($cover->selection){
                     foreach($cover->subCovers as $sub){
                        // cover for passangers
                        if($sub->name=="Legal Liability to Unnamed passenger" && $sub->selection=='true'){
                            $ll_un_pass->selection =true;
                            $ll_un_pass->insured = $sub->value->insuredValue; 
                            $ll_un_pass->grossAmt =  trim(str_replace('INR', '', $sub->netPremium));
                            $ll_un_pass->netAmt =  trim(str_replace('INR', '', $sub->netPremium));
                   
                        }
                        
                        // cover for ll Emp
                        if($sub->name=="Legal Liability to Employees - IMT 29" && $sub->selection=='true'){
                            $ll_emp->selection =true;
                            $ll_emp->insured  = $sub->value->insuredValue; 
                            $ll_emp->grossAmt =  trim(str_replace('INR', '', $sub->netPremium));
                            $ll_emp->netAmt   =  trim(str_replace('INR', '', $sub->netPremium));
                        }
                        
                        // cover for ll Paid Driver
                        if($sub->name=="Legal Liability to Paid Driver - IMT 28" && $sub->selection=='true'){
                            $ll_paid_driver->selection =true;
                            $ll_paid_driver->insured  = $sub->value->insuredValue; 
                            $ll_paid_driver->grossAmt =  trim(str_replace('INR', '', $sub->netPremium));
                            $ll_paid_driver->netAmt   =  trim(str_replace('INR', '', $sub->netPremium));
                        }
                      }
                    }
                }
                
                
                if($cover->coverCode=="ADDONS"){
                    if($cover->selection){
                        foreach($cover->subCovers as $subCover){
                            if(($subCover->selection) && $subCover->coverAvailability=="AVAILABLE"){
                                $eachAddon =   new \stdClass();
                                $eachAddon->title = $subCover->name;
                                $eachAddon->code  = $subCover->coverCode;
                                $eachAddon->grossAmt  = trim(str_replace('INR', '',$subCover->netPremium));
                                $eachAddon->netAmt  = trim(str_replace('INR', '',$subCover->netPremium));
                                 array_push($addons,$eachAddon);
                                 
                            }
                        }
                    }
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
            $discounts = [];$totalDis =0;$newNcb = "";
            if(isset($data->discounts->otherDiscounts)){
                 foreach($data->discounts->otherDiscounts as $dis){
                     $amt = trim(str_replace('INR', '',$dis->discountAmount));
                     if($amt>0 && $dis->discountType!="SPECIAL_DISCOUNT"){
                         $eachDis =   new \stdClass();
                         $eachDis->type   = $dis->discountType;
                         $eachDis->amount = $amt;
                         $eachDis->percent = $dis->discountPercent;
                         array_push($discounts,$eachDis);
                         $totalDis+= $amt;
                         
                         if($dis->discountType=="NCB_DISCOUNT"){
                             $newNcb = $dis->discountPercent;
                         }
                     }
                 }
             }
            // if(isset($data->specialDiscountAmount)){ 
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
            $obj->gross =  trim(str_replace('INR', '', $data->grossPremium));
            $obj->net   =  trim(str_replace('INR', '', $data->netPremium));
            $obj->tax   =  trim(str_replace('INR', '', $data->serviceTax->totalTax));
            
            $obj->discount=  $discount;
            
            //customer
            // $customer = new \stdClass(); 
            // $customer->name ="";
            // $customer->mobile ="";
            // $customer->email ="";
            // $customer->dob ="";
            
            // $obj->customer = $customer;
            
            // $supplier = new \stdClass(); 
            // $supplier->id =5;
            // $supplier->name ="Digit General Insurance";
            // $supplier->short ="DIGIT";
            // $supplier->logo ="https://www.godigit.com/content/dam/godigit/images/logo.svg";
            // $obj->supplier = $supplier;
            
            //vehicle
            // $RTO = substr($data->vehicle->licensePlateNumber,0,4);
             $vehicle = new \stdClass(); 
               $vehicle->newNCB = $newNcb;
            // $vehicle->make =$data->vehicle->make;
            // $vehicle->model =$data->vehicle->model;
            // $vehicle->varient =$data->vehicle->varient;
            // $vehicle->code = $data->vehicle->vehicleMaincode;
            // $vehicle->rto =$RTO;
            // $vehicle->rto_no = $data->vehicle->licensePlateNumber;
            // $vehicle->reg_date = $data->vehicle->registrationDate;
            // $vehicle->chassis_no = '';
            // $vehicle->engin_no = '';
              $vehicle->idv =$data->vehicle->vehicleIDV->idv;
            // $vehicle->minIdv =$data->vehicle->vehicleIDV->minimumIdv;
            // $vehicle->maxIdv =$data->vehicle->vehicleIDV->maximumIdv;
             $obj->vehicle = $vehicle;
            //$obj->policyNumber  = "";
            //$obj->applicationId = "";
            //$obj->hypothecationAgency="";
            return $obj;
    }
    
    function fnQuoteRequest($params){
      
        $chars = time().'A1B2C3D4E5F6G7H8I9J0K9L8BUYPOLICYM7N6O5P4Q3R2S1T123456789UVWXYZ'.date('Ymd');
        $enquiryId = 'SF'.str_shuffle(substr(str_shuffle($chars), 0, 13));
        
         $licensePlateNumber = "";$pinCode ="";$vehicleMaincode="";
         $regionCode = $params['vehicle']['rtoCode'];
         $insuranceProductCode = $this->productCode($params['planType']);
         $subInsuranceProductCode = "PB";
         $isVehicleNew = ($params['vehicle']['isBrandNew']=="true")?true:false;
         $policyHolder =($params['vehicle']['policyHolder']=='IND')?"INDIVIDUAL":"COMPANY";
         $prePolicyType = null; 
         $prePolicyProvider =null;
         $hasMadePreClaim =null;
         $ncb = "ZERO";
         $period = $this->timePeriod('Y-m-d',1);
         
         $isNcbTransfer = null;
         $policyNumber  = null;
         if($params['vehicle']['isBrandNew']=='false'){ // For vehicle->isBrandNew==='false'
             if($params['vehicle']['hasvehicleNumber']=="true"){
                $licensePlateNumber =$params['vehicle']['vehicleNumber'];
             }else{
                $licensePlateNumber=$params['vehicle']['rtoCode'];
             }
              
              $isPreviousInsurerKnown = true;
                if(isset($params['previousInsurance']['isExp']) && $params['previousInsurance']['isExp']!=""){ 
                    
                         if($params['previousInsurance']['isExp']=="Not Expired"){ //Not Expired 
                              $prePolicyExpDate =date('Y-m-d', strtotime('+10 days'));
                              $hasMadePreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?true:false;
                              $ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                              $prePolicyType    = isset($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):null;
                              $prePolicyProvider = DB::table('previous_insurer')->where('type', 'GENERAL')->inRandomOrder()->limit(1)->value('digit_code');
                              
                         }else if($params['previousInsurance']['isExp']=="Expired"){ //Expired
                         
                              if(isset($params['previousInsurance']['exp'])){
                                  if($params['previousInsurance']['exp']=="+90"){ 
                                     // $period = $this->timePeriod('Y-m-d',1,Date('Y-m-d', strtotime('+1 days')));
                                      
                                      $prePolicyExpDate = date('Y-m-d', strtotime('-100 days'));
                                      $hasMadePreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?true:false;
                                      $ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                      $prePolicyType    = isset($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):null;
                                      $prePolicyProvider = DB::table('previous_insurer')->where('type', 'GENERAL')->inRandomOrder()->limit(1)->value('digit_code');
                                      
                                  }else if($params['previousInsurance']['exp']=="45-90"){ 
                                     // $period = $this->timePeriod('Y-m-d',1,Date('Y-m-d', strtotime('+1 days')));
                                      
                                      $prePolicyExpDate = date('Y-m-d', strtotime('-60 days'));
                                      $hasMadePreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?true:false;
                                      $ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                      $prePolicyType    = isset($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):null;
                                      $prePolicyProvider = DB::table('previous_insurer')->where('type', 'GENERAL')->inRandomOrder()->limit(1)->value('digit_code');
                                      
                                  }else if($params['previousInsurance']['exp']=="-45"){
                                     // $period = $this->timePeriod('Y-m-d',1,Date('Y-m-d', strtotime('+1 days')));
                                      $prePolicyExpDate = date('Y-m-d', strtotime('-25 days'));
                                      $hasMadePreClaim = ($params['previousInsurance']['hasPreClaim']=='yes')?true:false;
                                      $ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
                                      $prePolicyType    = isset($params['previousInsurance']['policyType'])?$this->productCode($params['previousInsurance']['policyType']):null;
                                      $prePolicyProvider = DB::table('previous_insurer')->where('type', 'GENERAL')->inRandomOrder()->limit(1)->value('digit_code');
                                      
                                  }else if($params['previousInsurance']['exp']=="0"){
                                      $prePolicyExpDate = date('Y-m-d', strtotime('-90 days'));
                                      $isPreviousInsurerKnown = false;
                                      $period = $this->timePeriod('Y-m-d',1,Date('Y-m-d', strtotime('+1 days')));
                                  }else{
                                    $prePolicyExpDate = date('Y-m-d', strtotime('+1 days')); 
                                  }
                              }else{
                                $prePolicyExpDate = date('Y-m-d', strtotime('+1 days'));   
                              }
                          }
                  
                  
                }else{ 
                     $prePolicyExpDate =date('Y-m-d', strtotime('+10 days'));
                }
          
         }else{ // For vehicle->isBrandNew==='true'
              $isPreviousInsurerKnown = true;
              $hasMadePreClaim = false;
              $subInsuranceProductCode= ($params['planType']=="TP")?"50":"51";
              $licensePlateNumber  = $params['vehicle']['rtoCode'];
              $prePolicyExpDate = date('Y-m-d', strtotime('+10 days'));
              $isNcbTransfer = (isset($params['previousInsurance']['isNcbTransfer']) && $params['previousInsurance']['isNcbTransfer']=="Yes")?true:null;
              $policyNumber  = (isset($params['previousInsurance']['policyNo']))?$params['previousInsurance']['policyNo']:null; 
              $ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
              $prePolicyProvider = DB::table('previous_insurer')->where('id', $params['previousInsurance']['insurer'])->value('digit_code'); 
         }
        
       
        //  $rto_master=DB::table('rto_master')->select('pincode_masters.*')
        //                   ->join('pincode_masters','pincode_masters.dist', '=','rto_master.registered_city_name')
        //                  ->where('rto_master.region_code',strtoupper($regionCode))
        //                  ->orWhere('rto_master.registered_city_name', 'like',"CONCAT(pincode_masters.dist, '%')")->first();
                         
        $rto_master=DB::table('rtoMaster')->select('rtoMaster.rtoCode as rtoCode','rtoMaster.hdfcErgoCodeTw as hdfcErgoCodeTw','cities.id as cityId',
                                                   'cities.hdfcErgoCode as cityCode')
                                ->where('rtoCode',strtoupper($regionCode))
                                ->leftJoin('cities', 'cities.id', '=', 'rtoMaster.city_id')
                                ->leftJoin('pincode_masters', 'pincode_masters.city_id', '=', 'cities.id')->first();
                               // print_r($rto_master);die;
        
         $vehicleMain=DB::table('vehicle_variant_tw')->where('id',$params['vehicle']['varient']['id'])->first();
         $registrationDate=$params['vehicle']['regYear'].'-'.$params['vehicle']['regMonth'].'-'.date('d');
         $manufactureDate=isset($vehicleMain->price_year)?$vehicleMain->price_year."-".date('m-d'):$params['regYear'].'-'.$params['regMonth'].'-'.date('d');
        
         
        
        $request =[ "enquiryId"=> $enquiryId,
                    "pinCode"=> isset($rto_master->pincode)?$rto_master->pincode:null,
                    "vehicle"=>[
                        "isVehicleNew"=>$isVehicleNew,
                        "vehicleMaincode"=> $vehicleMain->digit_code,
                        "licensePlateNumber"=>$licensePlateNumber,
                          
                         "registrationAuthority"=>$regionCode,
                      
                        "vehicleIdentificationNumber"=>null,
                        "engineNumber"=> null,
                        "manufactureDate"=> $registrationDate,
                        "registrationDate"=> $registrationDate,
                        'vehicleIDV' =>['idv'=>5000,'defaultIdv' =>5000,'maximumIdv' => 0, 'minimumIdv' => 0],
                        'bodyType' =>null,'bodyColour' => null,
                        'vehicleType' =>$vehicleMain->vehicle_type, //MotorBike
                        'usageType' => null,'permitType' =>null, 
                        'trailers' =>null,'odometerReading' => null,'annualMileage' =>null,
                        'batteryNumber' =>null, 'chargerNumber' => null,
                        'make'    =>($params['vehicle']['brand']['name'])?trim($params['vehicle']['brand']['name']):null,
                        'model'   =>($params['vehicle']['model']['name'])?trim($params['vehicle']['model']['name']):null,
                        'varient' =>($params['vehicle']['varient']['name'])?trim($params['vehicle']['varient']['name']):null,
                    ],
                    "previousInsurer"=>[ "isPreviousInsurerKnown"=>$isPreviousInsurerKnown,"previousInsurerCode"=> $prePolicyProvider,"previousPolicyNumber"=> null,
                                         "previousPolicyExpiryDate"=>$prePolicyExpDate,"isClaimInLastYear"=> $hasMadePreClaim,"previousPolicyType"=>$prePolicyType,
                                         "previousNoClaimBonus"=> $ncb        
                    ],
                  'contract' => [
                     'insuranceProductCode' => $insuranceProductCode,
                     'subInsuranceProductCode' => $subInsuranceProductCode,
                     'productUniqueIndentifier' => null,'startDate' => $period->startDate,'endDate' => $period->endDate,
                     'policyTerm' => 1 ,'policyNumber' => $policyNumber,'externalPolicyNumber' =>null,
                     'coverages' =>null,'policyHolderType' => $policyHolder,'currentNoClaimBonus' => $ncb,
                     'isNCBTransfer' => $isNcbTransfer,'purchaseDate'=> null,
                     'quotationDate' => null,'agentCode' => null,
                     'isRenewalAvailable' =>null,
                     
                    ]
                ];
              if($insuranceProductCode=='20203'){
                  
                    $pp = isset($params['TP']['prePolicyType'])?str_replace("-","",$params['TP']['prePolicyType']):"";
                    $policyStartDate= isset($params['TP']['TPpolicyStartDate'])?explode('-',$params['TP']['TPpolicyStartDate']):null;
                    $policyTPEndDate= isset($params['TP']['TPpolicyEndDate'])?explode('-',$params['TP']['TPpolicyEndDate']):null;
                    $request['previousInsurer']['originalPreviousPolicyType'] =$pp;   
                    $request['previousInsurer']['currentThirdPartyPolicy']    = ["isCurrentThirdPartyPolicyActive"=>null,
                                                                                  "currentThirdPartyPolicyInsurerCode"=>DB::table('previous_insurer')->where('id', $params['previousInsurance']['insurer'])->value('digit_code'),
                                                                                  "currentThirdPartyPolicyNumber"=>$params['previousInsurance']['policyNo'],
                                                                                  "currentThirdPartyPolicyStartDateTime"=>$policyStartDate[2]."-".$policyStartDate[1]."-".$policyStartDate[0],
                                                                                  "currentThirdPartyPolicyExpiryDateTime"=>$policyTPEndDate[2]."-".$policyTPEndDate[1]."-".$policyTPEndDate[0]
                                                                                 ];
            }
             $this->QuoteRequest = $request;
            // return $request;
    }
    
    function getQuickQuote($deviceToken,$options){
         try {
           $req = $this->fnQuoteRequest($options);
           
             $basicAuth = base64_encode(config('motor.DIGIT.tw.username').":".config('motor.DIGIT.tw.password'));
             $client = new Client([
                'headers' => ["accept"=> "*/*", 'Content-Type' => 'application/json','Authorization'=>"Basic ".$basicAuth]
            ]);
            //echo  config('motor.DIGIT.tw.QuickQuote');die;
            $clientResp = $client->post(config('motor.DIGIT.tw.QuickQuote'),
                ['body' => json_encode($this->QuoteRequest)]
            );
            $result = $clientResp->getBody()->getContents();
           
         // print_r($result);die;
           
           $response = json_decode($result);
           $returnData =[];
           
            DB::table('app_temp_quote')->where(['type'=>'BIKE','device'=>$deviceToken,'provider'=>'DIGIT'])->delete();
          if(isset($response->error->errorCode) && $response->error->errorCode==0 ){
                  
                  $json_data = $this->getJsonData($result);
                  $partner = DB::table('our_partners')->where('shortName','DIGIT')->value('name');
                  $plan['title'] = $partner;
                  $plan['grossamount'] = $json_data->gross;
                  $plan['netamount']   = $json_data->net;
                  $plan['discount']    = $json_data->discount->total;
                  $plan['id'] =$response->enquiryId;
                  $plan['addons'] =  $json_data;
                  $plan['idv'] = number_format(str_replace('INR','',$response->vehicle->vehicleIDV->idv));
                  $quoteData = ['quote_id'=>$response->enquiryId,
                                'type'=>'BIKE',
                                'title'=>$partner,
                                'device'=>$deviceToken,
                                'provider'=>'DIGIT',
                                'policyType'=>$options['planType'],
                                'min_idv'=>isset($response->vehicle->vehicleIDV->minimumIdv)?str_replace(',','',str_replace('INR','',$response->vehicle->vehicleIDV->minimumIdv)):0,
                                'max_idv'=>isset($response->vehicle->vehicleIDV->maximumIdv)?str_replace(',','',str_replace('INR','',$response->vehicle->vehicleIDV->maximumIdv)):0,
                                'idv'    =>str_replace(',','',str_replace('INR','',$response->vehicle->vehicleIDV->idv)),
                                'call_type'=>"QUOTE",
                                'reqQuote'=>json_encode($this->QuoteRequest),
                                'respQuote'=>$result,
                                'reqRecalculate'=>$result,
                                'respRecalculate'=>$result,
                                'netAmt'=>str_replace(',','',str_replace('INR','',$response->netPremium)),
                                'taxAmt'=>str_replace(',','',str_replace('INR','',$response->serviceTax->totalTax)),
                                'grossAmt'=>str_replace(',','',str_replace('INR','',$response->grossPremium)),
                                'json_data'=>json_encode($json_data),
                                'req'=>json_encode($this->QuoteRequest),
                                'resp'=>($result)];
                  
                  $quoteID = DB::table('app_temp_quote')->insertGetId($quoteData);
               return ['status'=>true,'plans'=>$plan];
            }else{
               return ['status'=>false,'plans'=>[], "message"=>"Digit has ".$response->error->validationMessages[0]];
            }
         }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
              
                return ['status' => false,'plans'=>[], 'message' => $jsonRes->error->message];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $resp = json_decode($responseBodyAsString);
                   if(isset($resp->error->validationMessages[0])){
                        $msg = isset($resp->error->validationMessages[0])?($resp->error->validationMessages[0]):'Internal server error';
                        return ['status'=>false,'plans'=>[],"message"=>$msg];
                   }else{
                        return ['status'=>false,'plans'=>[],"message"=>"Internal server error"];
                   }
               //  print_r($responseBodyAsString);die;
              //  return ['status' => false,'plans'=>[], 'message' => 'Something went wrong'];
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return ['status' =>false, 'plans'=>[],'message' => $jsonRes->error->message];
            }

    }
    
    function getAddonsSelection($cover,$params,$REQUEST){
        $options  = $params['subcovers'];
        $optionValues  = $params['coverValues'];
       // print_r($options);
        $coverages = $REQUEST->contract->coverages;
         if($cover=='20201' || $cover=='20202'){ // COM || TP
             
              if($cover!="20202" && in_array(strtoupper($params['vehicle']['brand']['name']), ['TVS','SUZUKI', 'YAMAHA', 'HONDA']) ){ //TP
                $ODSEARCH = "OWN_DAMAGE";
                $newOD = array_filter($coverages, function ($var) use ($ODSEARCH) {
                    return ($var->coverType== $ODSEARCH);
                 });
                 $keyValOD = array_key_first($newOD);
                 //$REQUEST->contract->coverages[$keyValOD]->discount->userSpecialDiscountPercent=40;
              }
             
               //PA OWNER DRIVER COVER
                $PA_OWNER = $options['isPA_OwnerDriverCover'];
                $SEARCH = "PA_OWNER";
                $new = array_filter($coverages, function ($var) use ($SEARCH) {
                    return ($var->coverType== $SEARCH);
                 });
                 $keyVal = array_key_first($new);
            if((isset($options['isPA_OwnerDriverCover']) && $options['isPA_OwnerDriverCover']=='true')){
                 if(isset($REQUEST->contract->coverages[$keyVal]->subCovers)){
                     $subCovers_PA = $REQUEST->contract->coverages[$keyVal]->subCovers;
                     //$stringPA = "Personal Accident";
                     $stringPA ="10028";
                     $RESP_PA = array_filter($subCovers_PA, function ($var) use ($stringPA) {
                                return ($var->componentNumber== $stringPA);
                       });
                       $keysPA = array_key_first($RESP_PA);
                       $REQUEST->contract->coverages[$keyVal]->subCovers[$keysPA]->selection=true;
                       //$has_PA_OWNER = $PA_OWNER;
                       
                       
                       if($params['vehicle']['isBrandNew']=="true"){
                           //echo $optionValues['PA_OwnerDriverCoverval'];
                              $stringPATerm ="48081";
                             $RESP_PATrm = array_filter($subCovers_PA, function ($var) use ($stringPATerm) {
                                        return ($var->componentNumber== $stringPATerm);
                               });
                               $keysPATrm = array_key_first($RESP_PATrm);
                               $REQUEST->contract->coverages[$keyVal]->subCovers[$keysPATrm]->selection=true;
                               $REQUEST->contract->coverages[$keyVal]->subCovers[$keysPATrm]->value->insuredValue=(int)$optionValues['PA_OwnerDriverCoverval'];
                               $REQUEST->contract->coverages[$keyVal]->subCovers[$keysPA]->value->insuredValue=1500000;
                       }
                       
                 }
                // print_r($REQUEST->contract->coverages[$keyVal]);
                 
                 $REQUEST->contract->coverages[$keyVal]->selection=true;
            }else{
               // echo "FALSE";
                 $REQUEST->contract->coverages[$keyVal]->selection=false;
            }
           // print_r($REQUEST->contract->coverages[$keyVal]);
           // echo json_encode($REQUEST->contract->coverages[$keyVal]);
                  
                 // PA UNNAMED COVER
                 $PA_UNNAMED_PASS = (isset($options['isPA_UNPassCover']) && $options['isPA_UNPassCover']=='true')?true:false;
                 $PA_UNNAMED_DRIVER = (isset($options['isPA_UNDriverCover']) && $options['isPA_UNDriverCover']=='true')?true:false;
                 
                 $SEARCHPU = "PA_UNNAMED";
                 $newPU = array_filter($coverages, function ($var) use ($SEARCHPU) {
                         return ($var->coverType== $SEARCHPU);
                  });
                 $keyValPU = array_key_first($newPU);
                 //$REQUEST->contract->coverages[$keyValPU]->selection=$PA_UNNAMED;
                 $has_PA_UNNAMED = false;
                 if(isset($REQUEST->contract->coverages[$keyValPU]->subCovers)){
                       $subCovers_PU = $REQUEST->contract->coverages[$keyValPU]->subCovers;
                       // PA PAID DRIVER
                           $str1 = "PA cover for Paid Driver - IMT 17";
                           $resp1 = array_filter($subCovers_PU, function ($var) use ($str1) {
                                return ($var->name== $str1);
                            });
                           $keys1 = array_key_first($resp1);
                           if($PA_UNNAMED_DRIVER){
                               $REQUEST->contract->coverages[$keyValPU]->subCovers[$keys1]->selection=$PA_UNNAMED_DRIVER;
                               $has_PA_UNNAMED = true;
                           }else{
                               $REQUEST->contract->coverages[$keyValPU]->subCovers[$keys1]->selection=false;
                           }
                       
                        // PA UNNAMED PASSANGER
                           $str2 = "PA cover for Unnamed Passenger - IMT 16";
                           $resp2 = array_filter($subCovers_PU, function ($var) use ($str2) {
                                return ($var->name== $str2);
                            });
                           $keys2 = array_key_first($resp2);
                           if($PA_UNNAMED_PASS){  
                               $REQUEST->contract->coverages[$keyValPU]->subCovers[$keys2]->selection=$PA_UNNAMED_PASS;
                               $REQUEST->contract->coverages[$keyValPU]->subCovers[$keys2]->value->insuredValue=(int)$optionValues['PA_UNPassCoverval'];
                               
                               $has_PA_UNNAMED = true;
                           }else{
                               $REQUEST->contract->coverages[$keyValPU]->subCovers[$keys2]->selection=false;
                           }
                       
                      
                 }
                  $REQUEST->contract->coverages[$keyValPU]->selection=$has_PA_UNNAMED;
                 // PA UNNAMED COVER END HERE....
                 
                 
                 /* LEGAL_LIABILITY */
                   $LL_PaidDriver = (isset($options['isLL_PaidDriverCover']) && $options['isLL_PaidDriverCover']=='true')?true:false;
                   $LL_UNPass = (isset($options['isLL_UNPassCover']) && $options['isLL_UNPassCover']=='true')?true:false;
                   $LL_Emp = (isset($options['isLL_EmpCover']) && $options['isLL_EmpCover']=='true')?true:false;
                   
                   $SEARCHLL = "LEGAL_LIABILITY";
                   $newLL = array_filter($coverages, function ($var) use ($SEARCHLL) {
                        return ($var->coverType== $SEARCHLL);
                    });
                   $keyValLL = array_key_first($newLL);
                  // $REQUEST->contract->coverages[$keyValLL]->selection=$LEGAL_LIABILITY;
                   $has_LL = false;
                       
                   if(isset($REQUEST->contract->coverages[$keyValLL]->subCovers)){
                       $subCovers_LL = $REQUEST->contract->coverages[$keyValLL]->subCovers;
                        // LL PAID DRIVER
                           $str = "Legal Liability to Paid Driver - IMT 28";
                           $resp = array_filter($subCovers_LL, function ($var) use ($str) {
                                return ($var->name== $str);
                            });
                           $keys = array_key_first($resp);
                      if($LL_PaidDriver){
                           $REQUEST->contract->coverages[$keyValLL]->subCovers[$keys]->selection=$LL_PaidDriver;
                           $has_LL = true;
                       }else{
                           $REQUEST->contract->coverages[$keyValLL]->subCovers[$keys]->selection=false; 
                       }
                       
                      // LL UNNAMED PASSANGER
                           $str1 = "Legal Liability to Unnamed passenger";
                           $resp1 = array_filter($subCovers_LL, function ($var) use ($str1) {
                                return ($var->name== $str1);
                            });
                           $keys1 = array_key_first($resp1);
                        if($LL_UNPass){ 
                           $REQUEST->contract->coverages[$keyValLL]->subCovers[$keys1]->selection=$LL_UNPass;
                           $has_LL = true;
                         }else{
                             $REQUEST->contract->coverages[$keyValLL]->subCovers[$keys1]->selection=false;
                         }
                       
                        // LL Employees
                           $str2 = "Legal Liability to Employees - IMT 29";
                           $resp2 = array_filter($subCovers_LL, function ($var) use ($str2) {
                                return ($var->name== $str2);
                            });
                           $keys2 = array_key_first($resp2);
                         if($LL_Emp){
                           $REQUEST->contract->coverages[$keyValLL]->subCovers[$keys2]->selection=$LL_Emp;
                           $has_LL = true;
                         }else{
                           $REQUEST->contract->coverages[$keyValLL]->subCovers[$keys2]->selection=false;  
                         }
                       
                       
                   }
                   $REQUEST->contract->coverages[$keyValLL]->selection=$has_LL;
                   /*LEGAL_LIABILITY end here*/
           }
         if($cover=="20201" || $cover=="20203"){ 
             
            /* ADDEDONS ALL COVERS */
            //  if((isset($options['isBreakDownAsCover']) && $options['isBreakDownAsCover']=='true') || (isset($options['isTyreProCover']) && $options['isTyreProCover']=='true') || 
            //   (isset($options['isPartDepProCover']) && $options['isPartDepProCover']=='true') || (isset($options['isConsumableCover']) && $options['isConsumableCover']=='true') ||
            //   (isset($options['isEng_GearBoxProCover']) && $options['isEng_GearBoxProCover']=='true') || (isset($options['isRetInvCover']) && $options['isRetInvCover']=='true') || 
            //   (isset($options['isRimProCover']) && $options['isRimProCover']=='true')){
                   //echo  'addons';
                   $ADDONS = true;
                   $SEARCHADD = "ADDONS";
                   $newAD = array_filter($coverages, function ($var) use ($SEARCHADD) {
                        return ($var->coverType== $SEARCHADD);
                    });
                   $keyValAD = array_key_first($newAD);
                   $REQUEST->contract->coverages[$keyValAD]->selection=$ADDONS;
                   
                   $subCovers_ADDONS = $REQUEST->contract->coverages[$keyValAD]->subCovers;
                   foreach($subCovers_ADDONS as $k => $val){
                    
                    
                      if($val->name=="Road Side Assistance"){
                           
                         if((isset($options['isBreakDownAsCover']) && $options['isBreakDownAsCover']=='true')){
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=true;
                         }else{
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=false; 
                         }  
                       } //Breakdown Assistance
                       
                       if($val->name=="Tyre Protect"){
                         if((isset($options['isTyreProCover']) && $options['isTyreProCover']=='true')){
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=true;
                         }else{
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=false; 
                         }  
                       } //Tyre Protect
                       
                       
                       
                       
                       if($val->name=="Parts Depreciation Protect"){
                         //echo  "Parts Depreciation Protect";
                           $subCovers_ZeroDep = $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->subCovers;
                           $hasZeroDep = false;
                           
                         if(isset($options['isPartDepProCover']) && $options['isPartDepProCover']=='true'){
                              $hasZeroDep = true;
                              $subCovers_ZeroDep[0]->selection=false;
                              $subCovers_ZeroDep[1]->selection=false;
                              $subCovers_ZeroDep[2]->selection=false;
                              $subCovers_ZeroDep[2]->selection=true;
                            //  foreach($subCovers_ZeroDep as $zpKey=>$zpcover){
                            //   if($zpcover->name=='Cover Unlimited Claims'){ //'Cover Unlimited Claims' //$optionValues['partDepCoverval']
                            //       $subCovers_ZeroDep[$zpKey]->selection=true;
                            //   }else{
                            //       $subCovers_ZeroDep[$zpKey]->selection=false; 
                            //   }
                            //  }
                            
                         }else{
                             
                             foreach($subCovers_ZeroDep as $zpKey=>$zpcover){
                               //if($zpcover->name==$options['partDepCoverval']){
                                   $subCovers_ZeroDep[$zpKey]->selection=false;
                            //   }else{
                            //       $subCovers_ZeroDep[$zpKey]->selection=false; 
                            //   }
                             }
                            $hasZeroDep = false;
                         }  
                         $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=$hasZeroDep; 
                         //print_r($REQUEST->contract->coverages[$keyValAD]->subCovers[$k]);
                       } //Parts Depreciation Protect
                       
                       if($val->name=="Consumable cover"){
                         if((isset($options['isConsumableCover']) && $options['isConsumableCover']=='true')){
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=true;
                         }else{
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=false; 
                         }  
                       } //Consumable cover
                       
                       if($val->name=="Engine and Gear Box Protect"){
                         if((isset($options['isEng_GearBoxProCover']) && $options['isEng_GearBoxProCover']=='true')){
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=true;
                         }else{
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=false; 
                         }  
                       }//Engine and Gear Box Protect
                       
                       if($val->name=="Return to Invoice"){
                         if((isset($options['isRetInvCover']) && $options['isRetInvCover']=='true')){
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=true;
                         }else{
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=false; 
                         }  
                       }//Return to Invoice
                       
                       if($val->name=="Rim Protect Cover"){
                         if((isset($options['isRimProCover']) && $options['isRimProCover']=='true')){
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=true;
                         }else{
                            $REQUEST->contract->coverages[$keyValAD]->subCovers[$k]->selection=false; 
                         }  
                       }//Rim Protect Cover
                            
                   }// addon sub cover foreach
               //}// if any true
           /* ADDEDONS ALL COVERS end */  
           
           /* OWN DAMAGE Accessories  */
                  //isCngKitCover isElecAccCover isNonElecAccCover
                  $CNGKIT = (isset($options['isCngKitCover']) && $options['isCngKitCover']=='true')?true:false;
                  $ELEC_ACC = (isset($options['isElecAccCover']) && $options['isElecAccCover']=='true')?true:false;
                  $NON_ELEC_ACC = (isset($options['isNonElecAccCover']) && $options['isNonElecAccCover']=='true')?true:false;
                  
                   $SEARCHOD = "OWN_DAMAGE";
                   $newOD = array_filter($coverages, function ($var) use ($SEARCHOD) {
                        return ($var->coverType== $SEARCHOD);
                    });
                   $keyValOD = array_key_first($newOD);
                   
                   if(isset($REQUEST->contract->coverages[$keyValOD]->subCovers)){
                       $subCovers_OD = $REQUEST->contract->coverages[$keyValOD]->subCovers;
                       
                       // CNG KIT
                       $str = "CNG Kit - IMT 25";
                       $resp = array_filter($subCovers_OD, function ($var) use ($str) {
                            return ($var->name== $str);
                        });
                       $keycng = array_key_first($resp);
                       $REQUEST->contract->coverages[$keyValOD]->subCovers[$keycng]->selection=$CNGKIT;
                       
                       // ELECTRICAL ACCE
                       $str = "Electrical Accessories - IMT 24";
                       $resp = array_filter($subCovers_OD, function ($var) use ($str) {
                            return ($var->name== $str && $var->coverAvailability=='AVAILABLE');
                        });
                       $keyele = array_key_first($resp);
                       $REQUEST->contract->coverages[$keyValOD]->subCovers[$keyele]->selection=$ELEC_ACC;
                       if((isset($options['isElecAccCoverVal']) && $options['isElecAccCover']=='true')){
                            $REQUEST->contract->coverages[$keyValOD]->subCovers[$keyele]->value->insuredValue=$options['isElecAccCoverVal'];
                       }
                        // NON ELECTRICAL ACCE
                       $str_n = "Non Electrical Accessories - IMT 24";
                       $resp_n = array_filter($subCovers_OD, function ($var) use ($str) {
                            return ($var->name== $str && $var->coverAvailability=='AVAILABLE');
                        });
                       $keynonele = array_key_first($resp_n);
                       $REQUEST->contract->coverages[$keyValOD]->subCovers[$keynonele]->selection=$NON_ELEC_ACC;
                       if((isset($options['isNonElecAccCoverVal']) && $options['isNonElecAccCover']=='true')){
                            $REQUEST->contract->coverages[$keyValOD]->subCovers[$keynonele]->value->insuredValue=$options['isNonElecAccCoverVal'];
                       }
                   }
                   /* OWN DAMAGE Accessories */
         }
        
        return $REQUEST;
    }
    
    function getRecalulateQuote($deviceToken,$options){
        
        $quoteData = DB::table('app_temp_quote')->where(['provider'=>"DIGIT","type"=>"BIKE",'device'=>$deviceToken])->orderBy('id','desc')->first();
        $REQUEST = json_decode($quoteData->respQuote);
        $insuranceProductCode = $this->productCode($options['planType']);
        $_REQUEST = $this->getAddonsSelection($insuranceProductCode,$options,$REQUEST);
        $_REQUEST->contract->insuranceProductCode = $insuranceProductCode;
         if(isset($options['vehicle']['idv']['value'])){ $_REQUEST->vehicle->vehicleIDV->idv = $options['vehicle']['idv']['value'];}
       // $header = ["accept: */*","Content-Type:application/json","Authorization:Basic ".base64_encode("$this->username:$this->password")];
       // $auth = ['header'=> $header,'url' => $this->recalculateQuote];
        //$result = $this->curlPost(json_encode($_REQUEST),$auth);
            $basicAuth = base64_encode(config('motor.DIGIT.tw.username').":".config('motor.DIGIT.tw.password'));
             $client = new Client([
                'headers' => ["accept"=> "*/*",  'Content-Type' => 'application/json','Authorization'=>"Basic ".$basicAuth,]
            ]);
            
            $clientResp = $client->post(config('motor.DIGIT.tw.recQuote'),
                ['body' => json_encode(
                    $_REQUEST
                )]
            );
            $result = $clientResp->getBody()->getContents();
        
        $response = json_decode($result);
        //print_r(json_encode($_REQUEST));
      
        if(isset($response->error->errorCode) && $response->error->errorCode==0 ){
          $json_data = $this->getJsonData($result);
          $partner = DB::table('our_partners')->where('shortName','DIGIT')->value('name');
          $plan['title'] = $partner;
          $plan['grossamount'] = $json_data->gross;
          $plan['netamount']   = $json_data->net;
          $plan['discount']    = $json_data->discount->total;
          $plan['addons'] =  $json_data;
          $plan['id'] =$response->enquiryId;
          $plan['idv'] = number_format(str_replace('INR','',$response->vehicle->vehicleIDV->idv));
          $_quoteData = ['quote_id'=>$response->enquiryId,'type'=>'BIKE','title'=>$partner,
                        'device'=>$deviceToken,'provider'=>'DIGIT','policyType'=>$options['planType'],
                        'min_idv'=>isset($response->vehicle->vehicleIDV->minimumIdv)?str_replace(',','',str_replace('INR','',$response->vehicle->vehicleIDV->minimumIdv)):0,
                        'max_idv'=>isset($response->vehicle->vehicleIDV->maximumIdv)?str_replace(',','',str_replace('INR','',$response->vehicle->vehicleIDV->maximumIdv)):0,
                        'idv'    =>str_replace(',','',str_replace('INR','',$response->vehicle->vehicleIDV->idv)),
                        'call_type'=>"QUOTE",
                        'reqRecalculate'=>json_encode($_REQUEST),
                        'respRecalculate'=>$result,
                        'netAmt'=>str_replace(',','',str_replace('INR','',$response->netPremium)),
                        'taxAmt'=>str_replace(',','',str_replace('INR','',$response->serviceTax->totalTax)),
                        'grossAmt'=>str_replace(',','',str_replace('INR','',$response->grossPremium)),
                        'json_data'=>json_encode($json_data),
                        //'json_quote'=>($result),
                        'req'=>json_encode($_REQUEST),'resp'=>($result)];
               $quoteID = DB::table('app_temp_quote')->where('quote_id',$quoteData->quote_id)->update($_quoteData);
               return ['status'=>true,'plans'=>$plan];
        }else{ return ['status'=>false,'plans'=>[]]; }
           
           
    }
    
    function getSingleRecalulateQuote($quoteID,$deviceToken,$options){
        $quoteData = DB::table('app_temp_quote')->where(['provider'=>"DIGIT",'type'=>"BIKE",'quote_id'=>$quoteID])->orderBy('id','desc')->first();
        $REQUEST = json_decode($quoteData->respRecalculate);
        $insuranceProductCode = $this->productCode($options['planType']);
        $_REQUEST = $this->getAddonsSelection($insuranceProductCode,$options,$REQUEST);
        $_REQUEST->contract->insuranceProductCode = $insuranceProductCode;
        if(isset($options['vehicle']['idv']['value'])){ $_REQUEST->vehicle->vehicleIDV->idv = $options['vehicle']['idv']['value'];}
       // $header = ["accept: */*","Content-Type:application/json","Authorization:Basic ".base64_encode("$this->username:$this->password")];
        //$auth = ['header'=> $header,'url' => $this->recalculateQuote];
        //$result = $this->curlPost(json_encode($_REQUEST),$auth);
        $basicAuth = base64_encode(config('motor.DIGIT.tw.username').":".config('motor.DIGIT.tw.password'));
             $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','Authorization'=>"Basic ".$basicAuth,]
            ]);
            
            $clientResp = $client->post(config('motor.DIGIT.tw.recQuote'),
                ['body' => json_encode(
                    $_REQUEST
                )]
            );
            $result = $clientResp->getBody()->getContents();
        $response = json_decode($result);
           
        if(isset($response->error->errorCode) && $response->error->errorCode==0 ){
          $json_data = $this->getJsonData($result);
          $partner = DB::table('our_partners')->where('shortName','DIGIT')->value('name');
          $plan['title'] = $partner;
          $plan['grossamount'] = $json_data->gross;
          $plan['netamount']   = $json_data->net;
          $plan['discount']    = $json_data->discount->total;
          $plan['id'] =$response->enquiryId;
          $plan['idv'] = number_format(str_replace('INR','',$response->vehicle->vehicleIDV->idv));
          $_quoteData = ['quote_id'=>$response->enquiryId,'type'=>'BIKE','title'=>"Digit General Insurance",
                        'device'=>$deviceToken,'provider'=>'DIGIT',
                        'min_idv'=>isset($response->vehicle->vehicleIDV->minimumIdv)?str_replace(',','',str_replace('INR','',$response->vehicle->vehicleIDV->minimumIdv)):0,
                        'max_idv'=>isset($response->vehicle->vehicleIDV->maximumIdv)?str_replace(',','',str_replace('INR','',$response->vehicle->vehicleIDV->maximumIdv)):0,
                        'idv'    =>str_replace(',','',str_replace('INR','',$response->vehicle->vehicleIDV->idv)),
                        'call_type'=>"QUOTE",
                        'reqRecalculate'=>json_encode($_REQUEST),
                        'respRecalculate'=>$result,
                        'netAmt'=>str_replace(',','',str_replace('INR','',$response->netPremium)),
                        'taxAmt'=>str_replace(',','',str_replace('INR','',$response->serviceTax->totalTax)),
                        'grossAmt'=>str_replace(',','',str_replace('INR','',$response->grossPremium)),
                        'json_data'=>json_encode($json_data),
                        //'json_quote'=>($result),
                        'req'=>json_encode($options),'resp'=>($result)];
           $quoteID = DB::table('app_temp_quote')->where('quote_id',$quoteData->quote_id)->update($_quoteData);
           return ['status'=>true,'quote_id'=>$response->enquiryId];
        }else{
           return ['status'=>false,'quote_id'=>$quoteData->quote_id];
        }
           
           
    }
     
    function createQuote($enquiry_id,$options){
      
      if(isset($options->vehicle->vehicleNumber)){
         $vehicleNo  = $options->vehicle->vehicleNumber;
      }else{
         $vehicleNo = $options->vehicle->rtoCode;
      }
      
      $cityID = explode('-',$options->address->city)[0];
       $stateID = explode('-',$options->address->state)[0];
     
     $state =  DB::table('states')->where('id',$stateID)->first();
     $city  =  DB::table('cities')->where('id',$cityID)->first();
     
     $quoteData = DB::table('app_quote')->where('enquiry_id', $enquiry_id)->first();
     $insuranceProductCode = $this->productCode($options->planType);
     $REQUEST = json_decode($quoteData->respRecalculate);//$this->getAddonsSelection($insuranceProductCode,$options,json_decode($quoteData->json_recalculate));
   //print_r($quoteData->json_recalculate);
         $REQUEST->vehicle->licensePlateNumber = $vehicleNo;
         $REQUEST->vehicle->vehicleIdentificationNumber = ($options->vehicle->chassisNumber)?$options->vehicle->chassisNumber:null;
         $REQUEST->vehicle->engineNumber = ($options->vehicle->engineNumber)?$options->vehicle->engineNumber:null;
         $REQUEST->pinCode= $options->address->pincode;
         $REQUEST->vehicle->bodyType = null; 
          $hypothecation = new \stdClass(); 
       $motorQuestions = new \stdClass(); 
       if(!empty($options->vehicle->hypothecationAgency)){
       //   $hypothecation->isHypothecation = true; 
       //   $hypothecation->hypothecationAgency=$options->vehicle->hypothecationAgency;
       //   $hypothecation->hypothecationCIty=$addressCity[1];
          
          $motorQuestions->furtherAgreement="";
          $motorQuestions->selfInspection=false;
          $motorQuestions->financer=$options->vehicle->hypothecationAgency;
       }else{
           // $hypothecation->isHypothecation = false;
           // $hypothecation->hypothecationAgency="";
           // $hypothecation->hypothecationCIty="";
           
          $motorQuestions->furtherAgreement="";
          $motorQuestions->selfInspection=false;
          $motorQuestions->financer="";
       }
       $REQUEST->motorQuestions=$motorQuestions;
       //$REQUEST->vehicle->hypothecation = $hypothecation;
         
         if($options->vehicle->policyHolder=='IND'){
               $ownerDOB    =  explode("-",$options->customer->dob);
               $personArr = [
                    [
                       "addresses"=> [
                           [ "addressType"=> "PRIMARY_RESIDENCE","flatNumber"=> "", "streetNumber"=>$options->address->addressLineOne, "street"=> $options->address->addressLineTwo,
                             "district"=> "", "state"=> $state->stateCode, "city"=> $city->name, "country"=> "IN",  
                             "pincode"=> $options->address->pincode
                           ],
                       ],
                       "communications"=> [
                           ["isPrefferedCommunication"=> true,"communicationType"=> "EMAIL","communicationId"=>$options->customer->email ],
                           ["isPrefferedCommunication"=> true, "communicationType"=> "MOBILE","communicationId"=> $options->customer->mobile ]
                       ],
                       "identificationDocuments"=> [],
                       "isPolicyHolder"=> true,
                       "isPayer"=> true,
                       "isVehicleOwner"=> true,
                       "partyId"=> "",
                       "personType"=>"INDIVIDUAL",
                       "firstName"=> $options->customer->first_name,
                       "middleName"=> $options->customer->middle_name,
                       "lastName"=> $options->customer->last_name,
                       "dateOfBirth"=>$ownerDOB[2]."-".$ownerDOB[1]."-".$ownerDOB[0],
                       "gender"=>strtoupper($options->customer->gender),
                       "relation"=> "",
                       "isDriver"=> true,
                       "isInsuredPerson"=> true
                  ]
               ];
               $nDOB = isset($options->nominee->dob)?explode('-',$options->nominee->dob):null;
                if($nDOB!=""){
               $nominee = ['personType'=>"INDIVIDUAL", 
                               'partyId'=>"",
                               'addresses'=>[],
                               'communications'=>[],
                               'identificationDocuments'=> [],
                               'isPolicyHolder'=>true,
                               'isPayer'=>false,
                               'isVehicleOwner'=>true,
                               'title'=>null,
                               'firstName'=>explode(' ',$options->nominee->name)[0],
                               'middleName'=> "",
                               'lastName'=>explode(' ',$options->nominee->name)[1],
                               'dateOfBirth'=>($nDOB!=null)?$nDOB[2].'-'.$nDOB[1].'-'.$nDOB[0]:null,
                               'gender'=> null,
                               'relation'=>$options->nominee->relation,
                               'isDriver'=>true,
                               'isInsuredPerson'=>true
                           ];
                }else{$nominee = null;}
             }else{
                 $personArr= [
                   [
                     "personType"=>"COMPANY",
                     "partyId"=> "",
                      "addresses"=> [
                               [ "addressType"=> "PRIMARY_RESIDENCE","flatNumber"=> "", "streetNumber"=> "", "street"=> $options->address->addressLine,
                                 "district"=> "", "state"=> $state->stateCode, "city"=> $city->name, "country"=> "IN",  
                                 "pincode"=> $options->address->pincode
                               ],
                           ],
                           "communications"=> [
                               ["isPrefferedCommunication"=> true,"communicationType"=> "EMAIL","communicationId"=>$options->customer->email ],
                               ["isPrefferedCommunication"=> true, "communicationType"=> "MOBILE","communicationId"=> $options->customer->mobile ]
                           ],
                          "identificationDocuments"=> [[
                               "documentId"=>"",
                               "documentType"=>"GST",
                               "identificationDocumentId"=>$options->customer->gstin
                           ]],
                     "isPolicyHolder"=> true,
                     "isPayer"=>null,
                     "isVehicleOwner"=> true,
                     "companyName"=> $options->customer->company
                   ]
                 ];   
                  $nominee = null;
             }
       
             if($options->vehicle->isBrandNew!='true'){
               $prePolicyProvider = (isset($options->previousInsurance->insurer) && $options->previousInsurance->insurer!="0")
                                    ?DB::table('previous_insurer')->where('id', $options->previousInsurance->insurer)->value('digit_code')
                                    :null;
                                    
               
               $policyExp = isset($options->previousInsurance->expDate)?explode('-',$options->previousInsurance->expDate):null;
               $REQUEST->previousInsurer->previousInsurerCode = $prePolicyProvider;
               $REQUEST->previousInsurer->previousPolicyNumber= $options->previousInsurance->policyNo;
               $REQUEST->previousInsurer->previousPolicyExpiryDate=is_null($policyExp)?null:$policyExp[2].'-'.$policyExp[1].'-'.$policyExp[0];
             }
         $REQUEST->persons=$personArr;
         $REQUEST->nominee=$nominee;
         
         //if(isset(Auth::guard('agents')->user()->id)){
         if($quoteData->agent_id>0){
            $posp =  DB::table('agents')->where('id',$quoteData->agent_id)->first();
            $_state =  DB::table('states')->where('id',$posp->state)->value('name');
            $_city  =  DB::table('cities')->where('id',$posp->city)->value('name');
           $pospInfo = new \stdClass();
           $pospInfo->isPOSP =  true;
           $pospInfo->pospName =  $posp->name;
           $pospInfo->pospUniqueNumber =  $posp->posp_ID;
           $pospInfo->pospLocation =  $_city.", ".$_state;
           $pospInfo->pospPanNumber =  $posp->pan_card_number;
           $pospInfo->pospAadhaarNumber =  "";
           $pospInfo->pospContactNumber =  $posp->mobile;
           $REQUEST->pospInfo = $pospInfo;
          
       }
         $cust = isset($options->customer->first_name)?$options->customer->first_name." ".$options->customer->middle_name." ".$options->customer->last_name:$options->customer->company;
          
       try{  
              
            $basicAuth = base64_encode(config('motor.DIGIT.tw.username').":".config('motor.DIGIT.tw.password'));
            $client = new Client([
               'headers' => ["accept"=> "*/*",  'Content-Type' => 'application/json','Authorization'=>"Basic ".$basicAuth,]
           ]);
           
           $clientResp = $client->post(config('motor.DIGIT.tw.CreateQuote'),
               ['body' => json_encode(
                   $REQUEST
               )]
           );
           $result = $clientResp->getBody()->getContents();
        
        
        //  print_r($result);
          $response = json_decode($result);
         if(isset($response->error->errorCode) && $response->error->errorCode==0 ){
              $jsonData = $this->getJsonData($result);
              $jsonData->enq = $enquiry_id;
              $jsonData->policyNumber  = $response->contract->policyNumber;
              $jsonData->applicationId = $response->applicationId;
              //$jsonData->hypothecationAgency =$options->customer->hypothecationAgency;
             $quoteData = ['customer_name'=>$cust,
                            'startDate'=>isset($response->contract->startDate)?$response->contract->startDate:NULL,
                            'endDate'=>isset($response->contract->endDate)?$response->contract->endDate:NULL,
                            'proposalNumber'=>$response->contract->policyNumber,
                            'reqCreate'=>json_encode($REQUEST),
                            'respCreate'=>$result,
                            'json_data'=>json_encode($jsonData),
                            'netAmt'=>str_replace(',','',str_replace('INR','',$response->netPremium)),
                            'taxAmt'=>str_replace(',','',str_replace('INR','',$response->serviceTax->totalTax)),
                            'grossAmt'=>str_replace(',','',str_replace('INR','',$response->grossPremium)),
                            'req'=>json_encode($REQUEST), 'resp'=>$result ];
              DB::table('app_quote')->where('enquiry_id', $enquiry_id)->update($quoteData);
              return ['status'=>true,'data'=>$enquiry_id];
          }else{
               $quoteData = ['customer_name'=>$cust,
                             'reqCreate'=>json_encode($REQUEST),
                            'respCreate'=>$result,
                            ];
              DB::table('app_quote')->where('enquiry_id', $enquiry_id)->update($quoteData);
              return ['status'=>false,'data'=>$enquiry_id ,"message"=>current($response->error->validationMessages)];
          }
       }catch (ConnectException $e) {
               $response = $e->getResponse();
               $responseBodyAsString = $response->getBody()->getContents();
               return ['status'=>false,'plans'=>[],"message"=>"Internal server error"];
           }catch (RequestException $e) {
               $response = $e->getResponse();
               $responseBodyAsString = $response->getBody()->getContents();
               $resp = json_decode($responseBodyAsString);
                $quoteData = ['customer_name'=>$cust,
                             'reqCreate'=>json_encode($REQUEST),
                             'respCreate'=>$responseBodyAsString,
                            ];
                DB::table('app_quote')->where('enquiry_id', $enquiry_id)->update($quoteData);
               if(isset($resp->error->validationMessages[0])){
                    $msg = isset($resp->error->validationMessages[0])?($resp->error->validationMessages[0]):'Internal server error';
                    return ['status'=>false,'plans'=>[],"message"=>$msg];
               }else{
                    return ['status'=>false,'plans'=>[],"message"=>"Internal server error"];
               }
           }catch (ClientException $e) {
               $response = $e->getResponse();
               $responseBodyAsString = $response->getBody()->getContents();
                return ['status'=>false,'plans'=>[],"message"=>"Internal server error"];
           }
    }
     
    function getPaymentInfo($applicationID,$enq){
      
      if($applicationID!=""){
          $REQUEST=["applicationId"=>$applicationID,"cancelReturnUrl"=>url('policy/cancel/'.$enq),
                    "successReturnUrl"=>config('custom.site_url').'/moter-insurance/insured-success/bike/'.$enq];
         try{           
           $client = new Client(['headers' => ["accept"=> "*/*",  'Content-Type' => 'application/json','Authorization'=>config('motor.DIGIT.tw.paymentKey')] ]);
            
            $clientResp = $client->post(config('motor.DIGIT.tw.payment'),
                ['body' => json_encode( $REQUEST )]
            );
            $result = $clientResp->getBody()->getContents();
            $res = json_decode($result);
         
            if(isset($res->timestamp) || isset($res->message)){ 
                $msg = json_decode(json_decode(json_encode($res->message)));
                return ['status'=>false,'message'=>$msg->responseBody->errorMessage];
            }else{
                return ['status'=>true,'message'=>"Payment link generated successfully",'data'=>$result]; 
            }
            
            
      }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
              
                return ['status' => false,'message' => $jsonRes->error->message];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $resp = json_decode($responseBodyAsString);
               //  print_r($responseBodyAsString);die;
                  if(isset($resp->timestamp) || isset($resp->message)){ 
                        $msg = json_decode(json_decode(json_encode($resp->message)));
                        return ['status'=>false,'message'=>$resp->message];
                    }else if(isset($resp->error->validationMessages[0])){
                        $msg = isset($resp->error->validationMessages[0])?($resp->error->validationMessages[0]):'Internal server error';
                        return ['status'=>false,"message"=>$msg];
                   }else{
                        return ['status'=>false,"message"=>"Internal server error"];
                   }
                
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return ['status' =>false, 'message' => $jsonRes->error->message];
            }
        }else{
          return ['status'=>false,'message'=>"Application ID is required to create policy."];
        }
     }
     
     function GetPDF($policyno,$applicationId){
        $REQUEST = ['policyId'=>$applicationId];
        $result = new \stdClass();
         //echo json_encode( $REQUEST );
         try {
        $client = new Client(['headers' => ["accept"=> "*/*",  'Content-Type' => 'application/json','Authorization'=>config('motor.DIGIT.car.paymentKey')] ]);
            
        $clientResp = $client->post(config('motor.DIGIT.car.generatePolicy'),
            ['body' => json_encode( $REQUEST )]
        );
        $response = $clientResp->getBody()->getContents();
        $resp = json_decode($response);
        
        // print_r($resp);
        
        
             if(isset($resp->schedulePath)){
                 if($resp->schedulePath!=null){
                      $filePath = $resp->schedulePath;
                      $ff = file_get_contents($filePath,true);
                      $file = getcwd()."/public/assets/customers/policy/pdf/Digit_car_".$policyno.".pdf";
                      file_put_contents($file, $ff);
                      $result->status =true;$result->filename = "Digit_car_".$policyno.".pdf";$result->message="Policy Generated successfully";
                 }else{
                    $result->status =false;$result->filename ="";$result->message="schedulePathNotSet"; 
                 }
             }else if(isset($resp->errorMessage)){
                $error =  json_decode($resp->errorMessage);
                $result->status =false;$result->filename ="";$result->message=$error->errorMessage;
             }else{
                $result->status =false;$result->filename ="";$result->message="NoErrorMessage";
             }
         }catch (ConnectException $e) {
               $result->status =false;$result->filename ="";$result->message="ConnectException";
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                print_r($responseBodyAsString);
               $result->status =false;$result->filename ="";$result->message=$jsonRes->message;
            }catch (ClientException $e) {
                $result->status =false;$result->filename ="";$result->message="ClientException";
            }catch (ServerException $e) {
                $result->status =false;$result->filename ="";$result->message="ServerException";
            }
     //$result->status =false;$result->filename ="";
     return $result;
     }
    
   
    
}