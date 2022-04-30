<?php
namespace App\Partners\Care;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Auth;
use Carbon\Carbon;


class CareClassic{
    
    
     function getAgeBand($params){
        $maxAge = 0 ;$minAge=0;
        foreach($params->members as $key=>$data){
              $age = (int)$data->age;
                 if($minAge==0){$minAge =   $data->age;}
                 else if($data->age<$minAge){ $minAge =  intval($age);}
                 
                if($maxAge==0){$maxAge =  intval($data->age);}  
                else if($data->age>$maxAge){ $maxAge =  intval($age);}
        }
        
           $ageBand=[];$i=1;
           foreach($params->members as $key=>$data){ 
                $age = (int)$data->age;
                $ageBand[$i] = $age;
                // if($age>=18 && $age<=24){ $ageBand[$i] = "24";}
                // if($age>=25 && $age<=35){ $ageBand[$i] = "35";}
                // if($age>=36 && $age<=40){ $ageBand[$i] = "40";}
                // if($age>=41 && $age<=45){ $ageBand[$i] = "45";}
                // if($age>=46 && $age<=50){ $ageBand[$i] = "50";}
                // if($age>=51 && $age<=55){ $ageBand[$i] = "55";}
                // if($age>=56 && $age<=60){ $ageBand[$i] = "60";}
                // if($age>=61 && $age<=65){ $ageBand[$i] = "65";}
                // if($age>=66 && $age<=70){ $ageBand[$i] = "70";}
                // if($age>=71 && $age<=75){ $ageBand[$i] = "75";}
                // if($age>75){ $ageBand[$i] = "75";}
                $i++;
          } 
          //print_r($ageBand);
           return $ageBand;
        
    }
    
    function calculatePremium($params,$authToken,$sumInsured,$devicetoken,$pTyp){
           $policyType = ($pTyp=="FL")?"Floater":"Individual";
           $abacusId = "1439";
            $request = new \stdClass(); 
            $request->partnerId = "54";
            $request->abacusId = $abacusId;
            
            $postedField  =  new \stdClass();
            
            $postedField->field_1 = ($params->total_adult+$params->total_child);
            $postedField->field_10 =$params->total_child;
            $postedField->customerType = "New";
            $postedField->field_4 = "1 Year";
            $postedField->field_PA_SI = "50";
            $postedField->outPutField = "field_8";
            $postedField->field_UA = "0";
            $postedField->field_OPD = "0";
           
            $postedField->field_EDC = "0";
            $postedField->field_PA ="0";
            $postedField->field_CS = "0";
            $postedField->field_9=$policyType;
            
            $postedField->field_HC ="1";
            $postedField->field_54 = $params->address->pincode;
            $postedField->field_2 = $sumInsured;
            
            
            $ageBands = $this->getAgeBand($params);
               foreach($ageBands as $k=>$_ageStr){
                 if($k==1){
                     $postedField->field_3 = $_ageStr;
                 }else{
                    $newMem = 'newMem_'.$k;
                   $postedField->$newMem = $_ageStr;
                 }
               }
          
          
           $request->postedField = $postedField;
            
            $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','Authorization'=>"Bearer ".$authToken]
            ]);
            
            $clientResp = $client->post(config('mediclaim.CARE.QuickQuote'),
                ['body' => json_encode($request)]
            );
            $result = $clientResp->getBody()->getContents();
            // print_r($result);die;
            $res = json_decode($result);
            
             if(isset($res->status) && isset($res->responseMsg) && $res->responseMsg=="OK"){
                        $amount = clean_str($res->data->grandTotal->selectedValue);//$this->clean_str($res->data->outputFields[0]->premium);
                        $product = "CARECLASSIC";
                        $features=DB::table('plans')->join('plans_features', 'plans.id', '=', 'plans_features.plan_id')
                                           ->join('plan_key_features', 'plan_key_features.key_features', '=', 'plans_features.features')
                                           ->select('plans_features.features as _key','plans_features.val as _val','plan_key_features.description as _desc')
                                          ->where(['supplier'=>'CARE','plan_val'=>'CARE-NCB_SUPER'])->get();
                        $partner = DB::table('our_partners')->where('shortName','CARE')->first();                  
                     
                      
                      $title = "Care Classic";
                      $plan = array();
                      $quoteID ="CARECLASSIC".time().mt_rand();
                      $plan['title'] = $title;
                       $plan['supplier']="CARE";
                      $plan['sumInsured'] = $sumInsured;
                      $plan['features'] = $features;
                      $plan['amount']   = $amount;
                      $plan['supp_name']=$partner->name;
                      $plan['supp_logo']=asset('assets/partners/'.$partner->logo_image);
                      $plan['id']=$quoteID;
                      $quoteData = ['short_sumInsured'=>$sumInsured,'long_sumInsured'=>$sumInsured*100000,'premiumAmount'=>$amount,
                                    'type'=>'HEALTH','policyType'=>$pTyp,'code'=>$abacusId,'product'=>$product,'title'=>$title,'device'=>$devicetoken,
                                    'provider'=>'CARE','call_type'=>"QUOTE",
                                     'reqQuote'=>json_encode($request),
                                    'respQuote'=>$result
                                   // 'response'=>($result),'json_quote'=>($result)
                                    ];
                      $quoteData['quote_id']=$quoteID;
                      $quoteData['req']= json_encode($request);
                      $quoteData['resp']= $result;
                      DB::table('app_temp_quote')->insertGetId($quoteData);
                return ['status'=>true,'data'=>$plan];
            }else{
                return ['status'=>false,'data'=>[]];
            }
            
    }
    
    //updateQuickQuote
    function recalculatePremium($enqId,$authToken,$termYear,$sum,$addOn){
        $abacusId = "1439";
        $enqData = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqId)->first();
        $params = json_decode($enqData->params_request);
        $jd = json_decode($enqData->json_data);
        $child = $params->total_child;
        $adult = $params->total_adult;
        $addons = [];$EDC="0";$UA="0";$OPD="0";$OPDSI="0";$CARESHILED="0";$SMARTSELECT=0;$NCBSUPER=0;$RoomRent=0;$HC=0;
        if(isset($addOn) && $addOn!=""){
           $addons = explode(",",$addOn);
           //$HC = "1";//Compulsary for care classic
          // $UA  = in_array("UAR",$addons)?"1":"0";
          
          // $CARESHILED = in_array("CARESHILED1104", $addons)?"1":"0";
          // $NCBSUPER = in_array("CAREWITHNCB", $addons)?"1":"0";
          // $SMARTSELECT = in_array("SMARTCA", $addons)?"1":"0";
          // $RoomRent = in_array("RRMCA", $addons)?"1":"0";
          $OPD = in_array("OPDCC1122", $addons)?"1":"0";
          if(in_array("OPDCC-3000", $addons)){
             $OPDSI = "3000";
          }else if(in_array("OPDCC-5000", $addons)){
             $OPDSI = "5000";
          }else if(in_array("OPDCC-10000", $addons)){
             $OPDSI = "10000";
          }
          
        }
        
       // if($addOn!=""){ $addOn = $addOn.',AHCCC1126';}else{$addOn = 'AHCCC1126';}
        
        
        $maxAge = 0 ;$minAge=0;
        $policyType = ($enqData->policyType=="FL")?"Floater":"Individual";
       
            $request = new \stdClass(); 
            $request->partnerId = "54";
            $request->abacusId = $abacusId;
            
            $postedField  =  new \stdClass();
            
            $postedField->field_1  = ($adult+$child);
            $postedField->field_10 = $child;
            $postedField->field_2  = $sum;
            $postedField->customerType = "New";
            $postedField->field_PA_SI = "50"; 
            $postedField->outPutField ="field_8";
            $postedField->field_UA  = $UA;
            $postedField->field_OPD = $OPD;
             $postedField->field_OPD_SI =$OPDSI;
            $postedField->field_EDC = $EDC;
            $postedField->field_CS  = $CARESHILED;
            $postedField->field_NCB = $NCBSUPER;
            $postedField->field_SS  = $SMARTSELECT;
            $postedField->field_HC  = "1";//$HC;
            $postedField->field_34  = $RoomRent;
            $postedField->field_9=$policyType;
            //$postedField->field_35 = $AIR_AMBULACE;
            $postedField->field_PA ="0";
            
            $ageBands = $this->getAgeBand($params);
            foreach($ageBands as $k=>$_ageStr){
                 if($k==1){
                     $postedField->field_3 = $_ageStr;
                 }else{
                    $newMem = 'newMem_'.$k;
                   $postedField->$newMem = $_ageStr;
                 }
               }
               
               
            $postedField->field_54 = $params->address->pincode;
            $request->postedField = $postedField;
            $reqQuote="";$respQuote="";
            $jsonAmtArr = [];
            for($Y=1;$Y<=3;$Y++){
                $request->postedField->field_4 = $Y." Year";
               
                $client = new Client([
                  'headers' => [ 'Content-Type' => 'application/json','Authorization'=>"Bearer ".$authToken]
                ]);
               $clientResp = $client->post(config('mediclaim.CARE.QuickQuote'),
                  ['body' => json_encode($request)]
                );
               $result = $clientResp->getBody()->getContents();
               $res = (json_decode($result));
               
               if($termYear==$Y){
                   $reqQuote = json_encode($request);
                   $respQuote = $result;
               }
              if(isset($res->status) && isset($res->responseMsg) && $res->responseMsg=="OK"){ 
                      $amount =$jd->amount;$basePremium=0;
                      
                        $amount = str_replace(",","",$res->data->outputFields[0]->premium);
                        $basePremium = str_replace(",","",$res->data->outputFields[0]->basePremium);
                    
                    
                        $addonAmt=0;$Addons=[];
                        foreach($res->data->extraFields as $extr){
                            // if($extr->fieldName=="field_EDC" && $extr->selectedValue==1){ //Everyday Care
                            //      $_thisAmt = floatval(str_replace(",","",$extr->dataValues));
                            //      $_Amt = $_thisAmt+ceil(($_thisAmt*18)/100);
                            //      $addonAmt = $addonAmt+$_Amt;
                            //      $Addons[]=['title'=>'Everyday Care','premium'=>$_Amt];
                            // }
                            // if($extr->fieldName=="field_CS" && $extr->selectedValue=="1"){ //Care shield
                            //       $_thisAmt = floatval(str_replace(",","",$extr->dataValues));
                            //      $_Amt = $_thisAmt+ceil(($_thisAmt*18)/100);
                            //      $addonAmt = $addonAmt+$_Amt;
                            //      $Addons[]=['title'=>'Care Shield','premium'=>$_Amt];
                                 
                            // }
                            // if($extr->fieldName=="field_UA" && $extr->selectedValue==1){ 
                            //      $_thisAmt = floatval(str_replace(",","",$extr->dataValues));
                            //      $_Amt = $_thisAmt+ceil(($_thisAmt*18)/100);
                            //      $addonAmt = $addonAmt+$_Amt;
                            //     $Addons[]=['title'=>'Unlimited Recharge','premium'=>$_Amt];
                            // }
                            if($extr->fieldName=="field_HC" && $extr->selectedValue=='checked'){ //Health Check-up
                                 $_thisAmt = floatval(str_replace(",","",$extr->dataValues));
                                 $_Amt = $_thisAmt+ceil(($_thisAmt*18)/100);
                                 $addonAmt = $addonAmt+$_Amt;
                                // $Addons[]=['title'=>'Health Check-up','premium'=>$_Amt];
                                 $Addons[]=['title'=>'Health Check-up','premium'=>"0.00"];
                            }
                            if($extr->fieldName=="field_OPD" && $extr->selectedValue==1){ //OPD Care
                                 $_thisAmt = floatval(str_replace(",","",$extr->dataValues));
                                 $_Amt = $_thisAmt+ceil(($_thisAmt*18)/100);
                                 $addonAmt = $addonAmt+$_Amt;
                                 $Addons[]=['title'=>'OPD Care (₹'.$OPDSI.')','premium'=>$_Amt];
                            }
                        }
                        //$res->data->grandTotal->selectedValue
                 $addonAmount = number_format((float)$addonAmt, 2, '.', '');
                 $amount = number_format((float)$amount, 2, '.', '');
                 $actualPrice = ($amount*100)/(118);
                 
                 $totalamount = $amount+$addonAmount; // for calculation purouse only
                 
                 
                 $Total_Premium =str_replace(",","",$res->data->grandTotal->selectedValue);
                 $totalActualPrice = ($Total_Premium*100)/(118);
                 $totalTax = $Total_Premium - $totalActualPrice;//ceil(($basePremium*18)/100);
                 $jsonAmtArr[$Y]=['Addons'=>$Addons,'Addons_Total'=>$addonAmount,'Base_Premium'=>$actualPrice,'Total_Premium'=>$Total_Premium,'Total_Tax'=>$totalTax];
              
                  
              }
            }// Year loop 1-2-3
         
            $product = "CARECLASSIC";
            $title = "Care - Classic";
            $quoteData = ["params_request->addOn" =>$addOn,
                          'amounts'=>json_encode($jsonAmtArr),
                          "premiumAmount"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                          "json_data->amount"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                          "json_data->quotation"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                          "json_data->sumInsured"=>$sum,
                          'termYear'=>$termYear,
                          'product'=>$product,
                          "title"=>$title,
                          'reqQuote'=>$reqQuote,
                          'respQuote'=>$respQuote,
                          'sumInsured->shortAmt'=>$sum,
                          'sumInsured->longAmt'=>($sum*100000)];
            DB::table('app_quote')->where('enquiry_id', $enqId)->update($quoteData);
          
       
    }
    
    function createPolicy($enq){
        $enqData = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enq)->first();
        $termYear = $enqData->termYear;
        $params = json_decode($enqData->params_request); 
        
        $jsonData = json_decode($enqData->json_data);
        $child = $params->total_child;
        $adult = $params->total_adult;
        $policyType = ($enqData->policyType=="FL")?"Floater":"Individual";//"FAMILYFLOATER";
        
        
        $_state = explode("-",$params->address->state);
        $_city = explode("-",$params->address->city);
        $IdentitydocArr = ["PAN_CARD"=>"PAN","PASSPORT"=>"PASSPORT"];
        
        $nomineeRelationArr= ['BROTHER'=>'BROTHER','FATHER'=>'FATHER','MOTHER'=>'MOTHER','SPOUSE'=>'SPSE','SISTER'=>'SISTER','SON'=>'SON','DAUGHTER'=>'DAUGHTER','WIFE'=>'WIFE','HUSBAND'=>'HUSBAND'];
        
        $request = new \stdClass(); 

        $intPolicyDataIO = new \stdClass();
        
        $policy = new \stdClass();
        $policy->businessTypeCd="NEWBUSINESS";
        $policy->baseProductId='10001111';
        $policy->baseAgentId=config('mediclaim.CARE.agentId');//"20008325";
       // $policy->coverType=$policyType;
        $policy->coverType="FAMILYFLOATER";// FAMILYFLOATER Fixed for care classic
        
        $policyAdditionalFieldsDOList = new \stdClass();
        $policyAdditionalFieldsDOList->fieldAgree = "YES";
        $policyAdditionalFieldsDOList->fieldAlerts = "YES";
        $policyAdditionalFieldsDOList->fieldTc = "YES";
        $policyAdditionalFieldsDOList->field1 = "Partner_superfinserv";
        $policyAdditionalFieldsDOList->field10 =  isset($params->nomineename)?$params->nomineename:"";
        $policyAdditionalFieldsDOList->field12 = $nomineeRelationArr[$params->nomineerelation];
        
        if(isset(Auth::guard('agents')->user()->id)){
            //$policyAdditionalFieldsDOList->field1 = Auth::guard('agents')->user()->name;
            $policyAdditionalFieldsDOList->field2 = Auth::guard('agents')->user()->mobile;
            $policyAdditionalFieldsDOList->field3 = Auth::guard('agents')->user()->pan_card_number;
        }
       
        $policy->policyAdditionalFieldsDOList = [ $policyAdditionalFieldsDOList ];
        $users =[];$_partyDOListARR=[];
        
        /* PROPOSER  DO LIST*/
         $PRPR_guid = str_shuffle(substr(str_shuffle(time().date('Ymd').time()), 0, 13))."-".str_shuffle(substr(str_shuffle(time().date('Ymd').time()), 0, 12));
         $PRPR_partyDOList = new \stdClass();
            $PRPR_partyDOList->guid = $PRPR_guid;
            $PRPR_partyDOList->firstName=$params->selfFname;
            $PRPR_partyDOList->lastName =$params->selfLname;
            $PRPR_partyDOList->roleCd = "PROPOSER";
            $PRPR_partyDOList->birthDt  =$params->selfdd."/".$params->selfmm."/".$params->selfyy;
            $PRPR_partyDOList->genderCd = $params->gender;
            $PRPR_partyDOList->titleCd=($params->gender=="MALE")?"MR":"MS";
            $PRPR_partyDOList->relationCd ="SELF";
            
            
            $PRPR_paramnentAdd = new \stdClass();
            $PRPR_paramnentAdd->addressLine1Lang1 = $params->address->house_no;
            $PRPR_paramnentAdd->addressLine2Lang1 = $params->address->street;
            $PRPR_paramnentAdd->addressTypeCd = "PERMANENT";
            $PRPR_paramnentAdd->areaCd = strtoupper($_city[1]);
            $PRPR_paramnentAdd->cityCd = strtoupper($_city[1]);
            $PRPR_paramnentAdd->stateCd = strtoupper($_state[1]);
            $PRPR_paramnentAdd->pinCode = $params->address->pincode;
            $PRPR_paramnentAdd->countryCd = "IND";
            
            $PRPR_communicationAdd = new \stdClass();
            $PRPR_communicationAdd->addressLine1Lang1 = $params->address->house_no;
            $PRPR_communicationAdd->addressLine2Lang1 = $params->address->street;
            $PRPR_communicationAdd->addressTypeCd = "COMMUNICATION";
            $PRPR_communicationAdd->areaCd =  strtoupper($_city[1]);
            $PRPR_communicationAdd->cityCd =  strtoupper($_city[1]);
            $PRPR_communicationAdd->stateCd = strtoupper($_state[1]);
            $PRPR_communicationAdd->pinCode = $params->address->pincode;
            $PRPR_communicationAdd->countryCd = "IND";
            
            $PRPR_partyDOList->partyAddressDOList=[$PRPR_paramnentAdd,$PRPR_communicationAdd];
            
            $PRPR_partyContactDOList = new \stdClass();
            $PRPR_partyContactDOList->contactTypeCd = "MOBILE";
            $PRPR_partyContactDOList->contactNum = $params->selfMobile;
            $PRPR_partyContactDOList->stdCode = "+91";
            
            $PRPR_partyDOList->partyContactDOList = [$PRPR_partyContactDOList];
            
            $PRPR_partyEmailDOList = new \stdClass();
            $PRPR_partyEmailDOList->emailTypeCd = "PERSONAL";
            $PRPR_partyEmailDOList->emailAddress = $params->selfEmail;
            
            $PRPR_partyDOList->partyEmailDOList = [$PRPR_partyEmailDOList];
            
            $PRPR_partyIdentityDOList = new \stdClass();
           
            $PRPR_partyIdentityDOList->identityTypeCd = $IdentitydocArr[$params->document->documentType];
            $PRPR_partyIdentityDOList->identityNum = $params->document->documentId;
            $PRPR_partyDOList->partyIdentityDOList = [$PRPR_partyIdentityDOList];
            $PRPR_partyDOList->partyQuestionDOList = [];
            array_push($_partyDOListARR,$PRPR_partyDOList);
        
        $members = $params->members;
        foreach($members as $each){
            $guid = str_shuffle(substr(str_shuffle(time().date('Ymd').time()), 0, 13))."-".str_shuffle(substr(str_shuffle(time().date('Ymd').time()), 0, 12));
            $relationCd ="SELF"; $titleCd ="MR"; 
                 if($each->type=="self"){     $relationCd = "SELF";   $titleCd = ($params->gender=="MALE")?"MR":"MS"; $gender=$params->gender; }
            else if($each->type=="daughter"){ $relationCd = "UDTR";   $titleCd = "MS";$gender="FEMALE";}
            else if($each->type=="son"){      $relationCd = "SONM";   $titleCd = "MR";$gender="MALE";}
            else if($each->type=="wife"){     $relationCd = "SPSE";   $titleCd = "MS";$gender="FEMALE";}
            else if($each->type=="husband"){  $relationCd = "SPSE";   $titleCd = "MR";$gender="MALE";}
            else if($each->type=="father"){   $relationCd = "FATH"; $titleCd = "MR";$gender="MALE";}
            else if($each->type=="mother"){   $relationCd = "MOTH"; $titleCd = "MS";$gender="FEMALE";}
            
            $partyDOList = new \stdClass();
            $partyDOList->guid = ($each->type=="self")?$PRPR_guid:$guid;
            $partyDOList->firstName=($each->type=="self")?$params->selfFname:$each->fname; 
            $partyDOList->lastName =($each->type=="self")?$params->selfLname:$each->lname;//"Spouse";
            $partyDOList->roleCd = "PRIMARY";
            $partyDOList->birthDt  = ($each->type=="self")?$params->selfdd."/".$params->selfmm."/".$params->selfyy:$each->dd."/".$each->mm."/".$each->yy;
            $partyDOList->genderCd   = $gender;
            $partyDOList->titleCd    = $titleCd;
            $partyDOList->relationCd = $relationCd;
            $heightInch = ($each->type=="self")?(($params->selfFeet*12)+$params->selfInch):(($each->feet*12)+$each->inch);
            $heightCm =  round($heightInch*2.54);
            $partyDOList->height = $heightCm; 
            $partyDOList->weight = ($each->type=="self")?$params->selfWeight:$each->weight;
            
            // $_state = explode("-",$params->address->state);
            // $_city = explode("-",$params->address->city);
            $paramnentAdd = new \stdClass();
            $paramnentAdd->addressLine1Lang1 = $params->address->house_no;
            $paramnentAdd->addressLine2Lang1 = $params->address->street;
            $paramnentAdd->addressTypeCd = "PERMANENT";
            $paramnentAdd->areaCd = strtoupper($_city[1]);
            $paramnentAdd->cityCd = strtoupper($_city[1]);
            $paramnentAdd->stateCd = strtoupper($_state[1]);
            $paramnentAdd->pinCode = $params->address->pincode;
            $paramnentAdd->countryCd = "IND";
            
            $communicationAdd = new \stdClass();
            $communicationAdd->addressLine1Lang1 = $params->address->house_no;
            $communicationAdd->addressLine2Lang1 = $params->address->street;
            $communicationAdd->addressTypeCd = "COMMUNICATION";
            $communicationAdd->areaCd = strtoupper($_city[1]);
            $communicationAdd->cityCd = strtoupper($_city[1]);
            $communicationAdd->stateCd = strtoupper($_state[1]);
            $communicationAdd->pinCode = $params->address->pincode;
            $communicationAdd->countryCd = "IND";
            
            $partyDOList->partyAddressDOList=[$paramnentAdd,$communicationAdd];
            
            $partyContactDOList = new \stdClass();
            $partyContactDOList->contactTypeCd = "MOBILE";
            $partyContactDOList->contactNum = $params->selfMobile;
            $partyContactDOList->stdCode = "+91";
            
            $partyDOList->partyContactDOList = [$partyContactDOList];
            
            $partyEmailDOList = new \stdClass();
            $partyEmailDOList->emailTypeCd = "PERSONAL";
            $partyEmailDOList->emailAddress = $params->selfEmail;
            
            $partyDOList->partyEmailDOList = [$partyEmailDOList];
            
            $partyIdentityDOList = new \stdClass();
            $partyIdentityDOList->identityTypeCd =  $IdentitydocArr[$params->document->documentType];
            $partyIdentityDOList->identityNum = $params->document->documentId;
            
            $partyDOList->partyIdentityDOList = [$partyIdentityDOList];
            $QueARR = [];
           
            if(isset($each->medical)){
                    //print_r($each->medical);
                        $que_ =   new \stdClass();
                        $que_->questionSetCd = "yesNoExist";
                        $que_->questionCd = "pedYesNo";
                        $que_->response = "YES";
                        array_push($QueARR,$que_);
                  
                    foreach($each->medical as $q){
                        $Q =  DB::table('medical_questions')->where('id', $q->queId)->first();
                        
                        $Hasque =   new \stdClass();
                        $Hasque->questionSetCd = $Q->setcode;
                        $Hasque->questionCd = $Q->code;
                        $Hasque->response = "YES";
                        array_push($QueARR,$Hasque);
                        
                        $questionCd = "";$response = "";
                        //print_r($q);
                         if($q->hasChildQuestions=='true'){ 
                               //print_r($q->childQuestions);
                                $ch = $q->childQuestions[0];
                                $childSet =   DB::table('medical_questions')->where(['supplier'=>'CARE','parentId'=>$ch->parentId,'id'=>$ch->Qid])->first();
                                $questionCd = $childSet->code;
                               // print_r($ch->answer);
                                $_que =   new \stdClass();
                                 if($childSet->inputType=='date'){
                                       $resppp =  explode("/",$ch->answer);
                                       $_que->response = isset($resppp[1])?$resppp[1]."/".$resppp[2]:"";
                                  }else{
                                      $_que->response =$ch->answer;
                                   }
                                
                                $_que->questionSetCd = $Q->setcode;
                                $_que->questionCd = $questionCd;
                                
                                array_push($QueARR,$_que);
                         }
                        
                    }
                    
                    
            }
            
            $partyDOList->partyQuestionDOList = $QueARR;//[$que1,$que2,$que3,$que4,$que5,$que6,$que7,$que8,$que9];
            array_push($_partyDOListARR,$partyDOList);
        }
        
       // die;
       
        $policy->partyDOList = $_partyDOListARR;$addOns="";$OPDSI="0";
         if(isset($params->addOn) && $params->addOn!=""){
                $addons =  explode(",",$params->addOn);
                if(in_array("OPDCC1122",$addons)){
                    $itHas3 = array_search('OPDCC-3000', $addons);
                    if($itHas3){unset($addons[$itHas3]); $OPDSI ="3000";}
                    
                    $itHas5 = array_search('OPDCC-5000', $addons);
                    if($itHas5){unset($addons[$itHas5]); $OPDSI ="5000";}
                    
                    $itHas10 = array_search('OPDCC-10000', $addons);
                    if($itHas10){unset($addons[$itHas10]); $OPDSI ="10000";}
                }
                
              $addonsImp =  implode(",",$addons); 
              if($OPDSI!="0"){
                 $addonsImp =  str_replace("OPDCC1122","OPDCC1122-".$OPDSI,$addonsImp);
              }
              
              $policy->addOns = str_contains($addonsImp, 'AHCCC1126')?$addonsImp:"AHCCC1126,".$addonsImp;
              //$policy->addOns = $addonsImp;   
         }else{
             $policy->addOns = "AHCCC1126";
         }
        
        // if(isset($params->addOn) && $params->addOn!=""){ 
        //     $addOns = ($addOns!="")?$addOns.",".$params->addOn:$params->addOn; 
        // }
        // if($addOns!=""){$policy->addOns = $addOns;}
        
        
        $pT =  ($policyType=="Individual")?"IND":"FL";
        
        $SICode = ["5"=>"005","7"=>"006","10"=>"007","15"=>"008"];
        $_sumInsured = json_decode($enqData->sumInsured);
        $shortSum = $_sumInsured->shortAmt;
        $sumInsured = $SICode[$shortSum];
        $policy->sumInsured = $sumInsured;
        $policy->term = $termYear;
        $policy->isPremiumCalculation = "YES";
        
        $intPolicyDataIO->policy = $policy;
        $request->intPolicyDataIO = $intPolicyDataIO;
        
          //echo  config('mediclaim.CARE.createPolicy');die;
         
                // $client = new Client([
                //   'headers' => [ 'Content-Type' => 'application/json',"AppId"=>"554940","signature"=>"VLwAATi/myXGqlG9C14DVIKsLgFjEUAZIizPSIbVdJw=","timeStamp"=>"1545391069685"]
                // ]);
             //   Array ( [Content-Type] => application/json [AppId] => 516215 [signature] => JsnNW921WJDN51CUaadctSNkGDWlXo/28TrIKuKUIhc= [timeStamp] => 1568801564676 ) 
                // $clientResp = $client->post('https://apiuat.religarehealthinsurance.com/relinterfacerestful/religare/restful/createPolicy',
                //     ['body' => json_encode($request)]
                //  );
                // print_r([ 'Content-Type' => 'application/json',"AppId"=>config('mediclaim.CARE.AppId'),"signature"=>config('mediclaim.CARE.signature'),"timeStamp"=>config('mediclaim.CARE.timestamp')]);die;
                 $client = new Client([
                  'headers' => [ 'Content-Type' => 'application/json',"AppId"=>config('mediclaim.CARE.AppId'),"signature"=>config('mediclaim.CARE.signature'),"timeStamp"=>config('mediclaim.CARE.timestamp')]
                ]);
                $clientResp = $client->post(config('mediclaim.CARE.createPolicy'),
                    ['body' => json_encode($request)]
                 );
                $response = $clientResp->getBody()->getContents();
         
         
        //print_r(json_encode($request));die;
         $output = json_decode($response);
          if(isset($output->responseData->status)){
              if($output->responseData->status==1){
                  //$sumInsured = str_replace(' ', '', str_replace('Lakhs', '', $output->intPolicyDataIO->policy->sumInsuredValue)); 
                  $premium = str_replace(' ', '', str_replace(',', '', $output->intPolicyDataIO->policy->premium));
                  //echo $premium; 
                  $amt = str_replace(' ', '', str_replace(',', '', $output->intPolicyDataIO->policy->premium)); 
                  $Querydata = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enq)->first();
                  $dataParam = json_decode($Querydata->json_data);
                  $dataParam->proposalNum = $output->intPolicyDataIO->policy->proposalNum;
                  $dataParam->quotation = $amt;//$output->intPolicyDataIO->policy->quotationPremium;
                  $dataParam->amount = $premium;//$output->intPolicyDataIO->policy->premium;
                  $dataParam->sumInsured = $shortSum;//$sumInsured;//$output->intPolicyDataIO->policy->sumInsuredValue;
                  DB::table('app_quote')->where('type','HEALTH')
                                        ->where('enquiry_id',$enq)
                                        ->update(['proposalNumber'=>$output->intPolicyDataIO->policy->proposalNum,
                                                  'premiumAmount'=>$premium,
                                                  'json_data'=>json_encode($dataParam),
                                                 // "json_create"=>json_encode($request),
                                                  //"json_resp"=>$response
                                                   'reqCreate'=>json_encode($request),
                                                    'respCreate'=>$response,
                                                    'req'=>json_encode($request), 'resp'=>$response
                                                  ]);
                  $data=['enq'=>$enq,
                          'amount'=> $premium,
                          'proposalNum'=>$output->intPolicyDataIO->policy->proposalNum,
                          'quotationPremium'=>$premium//$output->intPolicyDataIO->policy->quotationPremium
                          ];
                          
                           
                  $result = ['status'=>'success','data'=>$data];
              }else{
                    DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enq)->update(['reqCreate'=>json_encode($request),'respCreate'=>$response]);
                  if(isset($output->intPolicyDataIO->errorLists)){
                      $errorlist = $output->intPolicyDataIO->errorLists;
                      $result = ['status'=>'error','message'=>$errorlist[0]->errDescription,'data'=>[]]; 
                  }else if(isset($output->responseData->message)){
                      $result = ['status'=>'error','message'=>$output->responseData->message,'data'=>[]];
                  }else{
                      $result = ['status'=>'error','message'=>"Something went wrong, try again!",'data'=>[]];
                  }
                  
             
            }
          }else{
              $result = ['status'=>'error','message'=>"Connection failed try again.",'data'=>[]];
          }
          
           return $result;
        
        
        
    }
}