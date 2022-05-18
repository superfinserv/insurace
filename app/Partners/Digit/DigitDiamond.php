<?php
namespace App\Partners\Digit;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Auth;
use Carbon\Carbon;


class DigitDiamond{ 
      
     function getZone($pincode){
         $haspincode = DB::table('zone_mapping')->where('pincode',$pincode)->count();
         if($haspincode){
           $zone = DB::table('zone_mapping')->where('pincode',$pincode)->first();
           $z =  $zone->digit_zone;
         }else{
            $zone = "A";
         }
         return $z;
    }
    
     function calculatePremium($params,$sum,$sumInsured,$devicetoken,$pTyp){
         $zone =  $this->getZone($params->address->pincode);  $persons = [];
         foreach($params->members as $key=>$data){
                if($data->type=="self")     {      $relationCd = "SELF";     $roleCd ="PRIMARY";$gender=($params->gender=='MALE')?"Male":"Female"; }
                else if($data->type=="daughter"){  $relationCd = "DAUGHTER"; $roleCd ="PRIMARY";$gender="Female";}
                else if($data->type=="son")     {  $relationCd = "SON";      $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="wife")    {  $relationCd = "SPOUSE";     $roleCd ="PRIMARY";$gender="Female";}
                else if($data->type=="husband") {  $relationCd = "HUSBAND";  $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="father")  {  $relationCd = "FATHER";   $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="mother")  {  $relationCd = "MOTHER";   $roleCd ="PRIMARY";$gender="Female";}
                    
                $person = [
                         "age"=> $data->age,
                         "addresses"=> [["pincode"=> $params->address->pincode,"zone"=>$zone]],
                         "relationship"=> $relationCd,
                         "coverages"=> [
                            [
                              "coverType"=> "48717",
                              "sumInsuredAmount"=> $sumInsured
                            ],
                            [
                              "coverType"=> "48718",
                              "sumInsuredAmount"=> $sumInsured
                            ]
                          ]
                         ];
                  array_push($persons,$person);
                }
                
            
            $child = $params->total_child;
            $adult = $params->total_adult;
            $policyStartDate = date('Y-m-d');
            $_policyEndDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($policyStartDate)) . " +1 year")); 
            $policyEndDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($_policyEndDate)) . " -1 day")); 
             $totalMem = $child+$adult;
             if($totalMem>1){
                 $policyType = ($pTyp=="FL")?"FLOATER":"NONFLOATER";
             }else{
                 $policyType = "NONFLOATER";
                 $pTyp  = "IN";
             }
            $chars  = time().'A1B2C3D4E5F6G7H8I9J0K9L8BUYPO'.time().'LICYM7N6O5P4Q3R2S1T123456789UVWXYZ'.date('Ymd');
            $enquiryId = str_shuffle(substr(str_shuffle($chars), 0, 15));
            $request = ["enquiryId"=> 'SF'.$enquiryId,
                        "partnerName"=> "AGENT",
                        "contract"=>[
                                    "subInsuranceProductCode"=> "HLCP",
                                    "nonAbsProductCode"=> "DDO01",
                                    "policyType"=> $policyType,
                                    "startDate"=> $policyStartDate,
                                    "expiryDate"=> $policyEndDate,
                                    "zone"=> $zone,
                                    "policyPeriod"=> 1,
                                    "sumInsured"=> $sumInsured
                                ],
                          "persons"=> $persons  
                 ];
            try {     
                   $client = new Client([
                        'headers' => ['Accept' => '*/*', 'Content-Type' => 'application/json','Authorization'=>config('mediclaim.DIGIT.ApiKey')]
                    ]);
                    
                    $clientResp = $client->post(config('mediclaim.DIGIT.QuickQuote'),
                        ['body' => json_encode($request)]
                    );
                     $response = $clientResp->getBody()->getContents();
                     $resp = json_decode($response);
                      if(isset($resp->error) && isset($resp->error->errorCode) && $resp->error->errorCode==200 && $resp->error->errorMessage =='Success'){
                       $features=DB::table('plans')->join('plans_features', 'plans.id', '=', 'plans_features.plan_id')
                                                        ->join('plan_key_features', 'plan_key_features.key_features', '=', 'plans_features.features')
                                               ->select('plans_features.features as _key','plans_features.val as _val','plan_key_features.description as _desc')
                                               ->where(['supplier'=>'DIGIT','plan_val'=>'DIGIT-DIAMOND'])->get();
                         $amount  = str_replace(" ","",str_replace("INR","",$resp->premium->basePremiumWithTax));
                          $partner = DB::table('our_partners')->where('shortName','DIGIT')->first();          
                          $plan['supplier']="DIGIT";
                          $plan['sumInsured'] = $sum;
                          $plan['features'] = $features;
                          $plan['title']    = "Digit Diamond Health Care";
                          $plan['amount']   = $amount;//str_replace(" ","",str_replace("INR","",$resp->premium->basePremiumWithTax));
                          $plan['supp_name']=$partner->name;
                          $plan['supp_logo']=asset('assets/partners/'.$partner->logo_image);
                          $plan['id']=$resp->enquiryId;
                          
                          $quoteData = ['short_sumInsured'=>$sum,'long_sumInsured'=>$sumInsured,'premiumAmount'=>$amount,
                                        'quote_id'=>$resp->enquiryId,'type'=>'HEALTH','policyType'=>$pTyp,
                                        'code'=>"DDO01",'product'=>'HLCP','title'=>"Digit Diamond Health Care",
                                        'device'=>$devicetoken,'provider'=>'DIGIT',
                                        'call_type'=>"QUOTE",
                                        'reqQuote'=>json_encode($request),
                                        'respQuote'=>$response,
                                        'netAmt'=>str_replace(',','',str_replace('INR','',$resp->premium->netPremium)),
                                        'taxAmt'=>str_replace(',','',str_replace('INR','',$resp->premium->totalTax)),
                                        'grossAmt'=>str_replace(',','',str_replace('INR','',$resp->premium->grossPremium)),
                                        'req'=>json_encode($request),'resp'=>($response)];
                          DB::table('app_temp_quote')->insertGetId($quoteData);
                         return ['status'=>true,'data'=>$plan];
                      }else{
                         return ['status'=>false,'data'=>[]];
                      }
                }catch (ConnectException $e) {
                    return ['status'=>false,'data'=>[]];
                }catch (RequestException $e) {
                     return ['status'=>false,'data'=>[]];
                }catch (ClientException $e) {
                     return ['status'=>false,'data'=>[]];
                }
         
     }
     
      function recalculatePremium($enqId,$termYear,$sum,$_zone,$addOn){ 
        
        $enqData = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqId)->first();
        $params = json_decode($enqData->params_request);
        $jd = json_decode($enqData->json_data);
         
        $child = $params->total_child;
        $adult = $params->total_adult;
        $sumInsured =($sum*100000);
        $policyStartDate = date('Y-m-d');
        $_policyEndDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($policyStartDate)) . " +".$termYear." year")); 
        $policyEndDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($_policyEndDate)) . " -1 day")); 
        $actualZone = $this->getZone($params->address->pincode);
        $zone = !empty($_zone)?$_zone:$this->getZone($params->address->pincode);
        
        $totalMem = $child+$adult;
         if($totalMem>1){
             $policyType = ($enqData->policyType=="FL")?"FLOATER":"NONFLOATER";
         }else{
             $policyType = "NONFLOATER";$policytyp  = "IN";
         }
        
        
        $paramsMember = json_decode(json_encode($params->members), true);
       // $maxAge = $this->eldestMemberAge($paramsMember)->maxAge;
        $persons = [];
        foreach($params->members as $key=>$data){
                if($data->type=="self")     {      $relationCd = "SELF";     $roleCd ="PRIMARY";$gender=($params->gender=='MALE')?"Male":"Female"; }
                else if($data->type=="daughter"){  $relationCd = "DAUGHTER"; $roleCd ="PRIMARY";$gender="Female";}
                else if($data->type=="son")     {  $relationCd = "SON";      $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="wife")    {  $relationCd = "SPOUSE";   $roleCd ="PRIMARY";$gender="Female";}
                else if($data->type=="husband") {  $relationCd = "SPOUSE";   $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="father")  {  $relationCd = "FATHER";   $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="mother")  {  $relationCd = "MOTHER";   $roleCd ="PRIMARY";$gender="Female";}
                    
                $person = [
                         "age"=> $data->age,
                         "addresses"=> [["pincode"=> $params->address->pincode,"zone"=>$zone]],
                          "relationship"=> $relationCd,
                          "coverages"=> [
                            [
                              "coverType"=> "48717",
                              "sumInsuredAmount"=> $sumInsured
                            ],
                            [
                              "coverType"=> "48718",
                              "sumInsuredAmount"=> $sumInsured
                            ]
                          ]
                         ];
                  array_push($persons,$person);
                }
            $chars  = time().'A1B2C3D4E5F6G7H8I9J0K9L8BUYPO'.time().'LICYM7N6O5P4Q3R2S1T123456789UVWXYZ'.date('Ymd');
            $enquiryId = str_shuffle(substr(str_shuffle($chars), 0, 15));
            $request = ["enquiryId"=> 'SF'.$enquiryId,
                        "partnerName"=> "AGENT",
                        "contract"=>[
                                    "subInsuranceProductCode"=> "HLCP",
                                    "nonAbsProductCode"=> "DDO01",
                                    "policyType"=> $policyType,
                                    "startDate"=> $policyStartDate,
                                    "expiryDate"=> $policyEndDate,
                                    "zone"=> $zone,
                                    "policyPeriod"=> $termYear,
                                    "sumInsured"=> $sumInsured
                                ],
                          "persons"=> $persons  
                 ];
             if(isset($addOn) && $addOn!=""){ 
                 if($addOn!="None"){
                     $Maternity = ($addOn=='Maternity_25000')?"25000":"50000";
                     $request['addon']['Maternity'] = $Maternity;
                     $request['addon']['Maternity WP'] = "2";
                     $request['addon']['Maternity SI'] = "100";
                }
             }
             
             if($enqData->actualZone!=$zone){
                 $request['addon']['Zone Upgrade'] = $zone;
             }
           // $request['contract']['subInsuranceProductCode'] = $enqData->product;
           // $request['contract']['nonAbsProductCode'] = $enqData->code;
            $jsonAmtArr = [];
            
            //for($Y=1;$Y<=1;$Y++){
              $Y =1;
                $request['contract']['policyPeriod'] = $Y;
               // echo json_encode($request);
                   $client = new Client([
                        'headers' => ['Accept' => '*/*', 'Content-Type' => 'application/json','Authorization'=>config('mediclaim.DIGIT.ApiKey')]
                    ]);
                    
                    $clientResp = $client->post(config('mediclaim.DIGIT.QuickQuote'),
                        ['body' => json_encode($request)]
                    );
                     $response = $clientResp->getBody()->getContents();
                     $resp = json_decode($response);
               //echo $response;
                if(isset($resp->error) && isset($resp->error->errorCode) && $resp->error->errorCode==200 && $resp->error->errorMessage =='Success'){
                      $amount  = str_replace(" ","",str_replace("INR","",$resp->premium->basePremiumWithTax));
                      $basePremium  = str_replace(" ","",str_replace("INR","",$resp->premium->basePremium));
                      $totalTax  = str_replace(" ","",str_replace("INR","",$resp->premium->totalTax));
                      $Addons=[];$addonAmt=0;
                      if(isset($addOn) && $addOn!=""){ 
                          if($addOn!="None"){
                                 $title = ($addOn=='Maternity_25000')?"Maternity and New Born Baby Cover (₹25000)":"Maternity and New Born Baby Cover (₹50000)";
                                 $addonAmt =0.00;// $addonAmt+$_Amt;
                                 $Addons[]=['title'=>$title,'premium'=>0.00];
                            }
                      }
                      $jsonAmtArr[$Y]=['Addons'=>$Addons,'Addons_Total'=>$addonAmt,'Base_Premium'=>$basePremium,'Total_Premium'=>$amount,'Total_Tax'=>$totalTax];
                      
                      
                      $quoteData = ["params_request->addOn" =>$addOn,
                          "premiumAmount"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                          "json_data->amount"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                          "json_data->zone"=>$zone,
                          'amounts'=>json_encode($jsonAmtArr),
                          'termYear'=>$termYear,
                          'zone'=>$zone,
                           'reqQuote'=>json_encode($request),
                          'respQuote'=>$response,
                          'reqRecalculate'=>json_encode($request),
                          'respRecalculate'=>$response,
                          'netAmt'=>str_replace(',','',str_replace('INR','',$resp->premium->netPremium)),
                          'taxAmt'=>str_replace(',','',str_replace('INR','',$resp->premium->totalTax)),
                          'grossAmt'=>str_replace(',','',str_replace('INR','',$resp->premium->grossPremium)),
                          'sumInsured->shortAmt'=>$sum,
                          'sumInsured->longAmt'=>$sumInsured];
                        DB::table('app_quote')->where('enquiry_id', $enqData->enquiry_id)->update($quoteData);
                       // return ['status'=>true,'message'=>'success'];
                }
            //}
             
            
           //return true;
    }
    
    function setCreatePolicyParams($enq){
        $enqData = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enq)->first();
        $termYear = $enqData->termYear;
        $policyStartDate = date('Y-m-d');
        $_policyEndDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($policyStartDate)) . " +".$termYear." year")); 
        $policyEndDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($_policyEndDate)) . " -1 day")); 
       // {{setMoneyFormat($amts->$termYear->Base_Premium)}}
        $params = json_decode($enqData->params_request);
        $jsonData = json_decode($enqData->json_data);
        $child = $params->total_child;
        $adult = $params->total_adult;
        
        $SUM = json_decode($enqData->sumInsured);
        $replace = array("Lakhs", "INR", "Lakh", " ");
        $sumInsured = str_replace($replace, "", $SUM->shortAmt);
        
        $nominee_name = isset($params->nomineename)?explode(" ",$params->nomineename):"NA NA";
        $nomineeGender = ($params->nomineerelation=="MOTHER" || $params->nomineerelation=="DAUGHTER" || $params->nomineerelation=="GRANT_MOTHER" || $params->nomineerelation=="MOTHER_IN_LAW" || $params->nomineerelation=="SISTER" || $params->nomineerelation=="SPOUSE")?"FEMALE":"MALE";
        $zone = $enqData->zone;
        $members = $params->members;
        $personsArr= [];
        foreach($members as $each){
             $guid = "ss".str_shuffle(substr(str_shuffle(time().date('Ymd').time()), 0, 10));
             if($each->type=="self"){         $Mstatus = ($params->selfMstatus=="Married")?"V":"L";    $relationCd = "SELF";   $titleCd = ($params->gender=="MALE")?"Mr":"Ms"; $gender=$params->gender; }
            else if($each->type=="daughter"){ $Mstatus = "L"; $relationCd = "DAUGHTER";   $titleCd = "Ms";$gender="FEMALE"; }
            else if($each->type=="son"){      $Mstatus = "L"; $relationCd = "SON";    $titleCd = "Mr";$gender="MALE";}
            else if($each->type=="wife"){     $Mstatus = "V"; $relationCd = "SPOUSE";   $titleCd = "Ms";$gender="FEMALE";}
            else if($each->type=="husband"){  $Mstatus = "V"; $relationCd = "HUSBAND";$titleCd = "Mr";$gender="MALE";}
            else if($each->type=="father"){   $Mstatus = "V"; $relationCd = "FATHER"; $titleCd = "Mr";$gender="MALE";}
            else if($each->type=="mother"){   $Mstatus = "V"; $relationCd = "MOTHER"; $titleCd = "Ms";$gender="FEMALE";}
            
          
                    $_person = new \stdClass();
                    $_person->personType="NATURALPERSON";
                    $_person->uniqueIdentifier = null;// "NA";//$guid;
                    
                    $addresses  = new \stdClass();
                    $addresses->flatNumber =  null;
                    $addresses->streetNumber = null;
                    $addresses->street =  $params->address->house_no." ".$params->address->street;
                    $addresses->pincode = $params->address->pincode;
                    $addresses->zone = $zone;
                    $_person->addresses = [$addresses];
                    
                    $comm_email  = new \stdClass();
                    $comm_email->communicationType = "EMAIL";
                    $comm_email->communicationId = $params->selfEmail;
                    $comm_email->isPrefferedCommunication = true;
                    
                    $comm_mob  = new \stdClass();
                    $comm_mob->communicationType = "MOBILE";
                    $comm_mob->communicationId = $params->selfMobile;
                    $comm_mob->isPrefferedCommunication = true;
                    
                    $_person->communications = [$comm_email,$comm_mob];
                    
                    $identificationDocuments = new \stdClass();
                    $identificationDocuments->documentType = $params->document->documentType;
                    $identificationDocuments->documentId   = $params->document->documentId;
                    $identificationDocuments->issueDate    = $params->document->documentyy."-".$params->document->documentmm."-".$params->document->documentdd;
                    $_person->identificationDocuments = [$identificationDocuments];
                    
                    $_person->isPrimaryInsuredPerson = ($each->type=="self")?true:false;
                    
                    if($each->type=="self"){
                        $nominee = new \stdClass();
                        $nominee->firstName= $nominee_name[0];
                        $nominee->middleName = null;
                        $nominee->lastName =  $nominee_name[1];
                        $nominee->dateOfbirth=isset($params->nomineeyy)?$params->nomineeyy."-".$params->nomineemm."-".$params->nomineedd:null;
                        $nominee->profession= null;
                        $nominee->gender= $nomineeGender;
                        $nominee->relationship= ($each->type=="self")?$params->nomineerelation:$each->relation;//isset($params->nomineerelation)?$params->nomineerelation:null;//"FATHER";
                        $_person->nominee = $nominee;
                    }else{
                        $r="";
                        if($params->gender=="MALE"){
                            if($each->type=="wife"){ $r="HUSBAND"; }
                            if($each->type=="husband"){ $r="WIFE"; }
                            else if($each->type=="son" || $each->type=="daughter"){  $r="FATHER"; }
                            else if($each->type=="father" || $each->type=="mother"){  $r="SON"; }
                        }else{
                            if($each->type=="wife"){ $r="HUSBAND"; }
                            if($each->type=="husband"){ $r="WIFE"; }
                            else if($each->type=="son" || $each->type=="daughter"){  $r="MOTHER"; }
                            else if($each->type=="father" || $each->type=="mother"){  $r="SON"; } 
                        }
                        $nominee = new \stdClass();
                        $nominee->firstName= $params->selfFname;
                        $nominee->middleName = null;
                        $nominee->lastName =  $params->selfLname;
                        $nominee->dateOfbirth=$params->selfyy."-".$params->selfmm."-".$params->selfdd;
                        $nominee->profession= null;
                        $nominee->gender= $params->gender;
                        $nominee->relationship= $r;
                        $_person->nominee = $nominee;
                    }
                    $_person->firstName  =  ($each->type=="self")?$params->selfFname:$each->fname;
                    $_person->middleName =  null;
                    $_person->lastName   =  ($each->type=="self")?$params->selfLname:$each->lname;
                    $_person->dateOfbirth=  ($each->type=="self")?$params->selfyy."-".$params->selfmm."-".$params->selfdd:$each->yy."-".$each->mm."-".$each->dd;
                    $_person->profession=  null;
                    $_person->gender=  $gender;
                    $_person->relationship= $relationCd;
                    $_person->maritalStatus =  $Mstatus;
                    
                    $height = ($each->type=="self")?(($params->selfFeet*12)+$params->selfInch):(($each->feet*12)+$each->inch);
                    $weight = ($each->type=="self")?$params->selfWeight:$each->weight;
                    //echo "Inch->".$height."</br>";
                    $cm = round($height*2.54);
                  //  echo "Cm->".$cm."</br>";
                   
                    $physicalCharacteristics = new \stdClass();
                    $physicalCharacteristics->height= "$cm";
                    $physicalCharacteristics->weight= "$weight";
                    
                    $SUMSTRING = ($sumInsured*100000);
                    $_person->physicalCharacteristics =  $physicalCharacteristics;
                    
                    $coverages1 = new \stdClass();
                    $coverages1->coverType = "48717";
                    $coverages1->sumInsuredAmount = "$SUMSTRING";
                    
                    $coverages2 = new \stdClass();
                    $coverages2->coverType = "48718";
                    $coverages2->sumInsuredAmount = "$SUMSTRING";
                    $_person->coverages = [$coverages1,$coverages2];
                    
                    $medical = new \stdClass();
                    
                    $QueARR = [];
           
                          if(isset($each->medical)){
                             if(!empty($each->medical)){
                                  foreach($each->medical as $q){
                                      $Q =  DB::table('medical_questions')->where('id', $q->queId)->first();
                                      $medicalQuestions = new \stdClass();
                                      if($Q->isBoolean=='YES'){
                                          $answerType ="BOOLEAN";
                                      }else if($Q->isText=='YES'){
                                           $answerType ="DOMAIN";
                                      }else{
                                           $answerType ="DOMAIN";
                                      }
                                      $medicalQuestions->questionCode=$Q->code;
                                      $medicalQuestions->answerType=$answerType;
                                      $medicalQuestions->isApplicable= true;
                                      $medicalQuestions->detailAnswer= "TRUE";
                                      $subQueARR=[];
                                      if($q->hasChildQuestions && !empty($q->childQuestions)){
                                         
                                          foreach($q->childQuestions as $chQ){ 
                                               $subQuestions = new \stdClass();
                                               $subQ =  DB::table('medical_questions')->where('id', $chQ->Qid)->first();
                                               if($subQ->isBoolean=='YES'){
                                                  $_answerType ="BOOLEAN";
                                                  $answer = ($chQ->answer=='YES')?'TRUE':'FALSE';
                                               }else if($subQ->isText=='YES'){
                                                   $_answerType ="DOMAIN";
                                                    $answer = $chQ->answer;
                                               }else{
                                                   $_answerType ="TEXT_DESCRIPTION";
                                                    $answer = $chQ->answer;
                                               }
                                               $subQuestions->questionCode= $subQ->code;
                                               $subQuestions->answerType= $_answerType;
                                               $subQuestions->isApplicable= true;
                                               $subQuestions->detailAnswer = $answer;
                                               array_push($subQueARR,$subQuestions); 
                                          }
                                      }
                                     $medicalQuestions->subQuestions = $subQueARR;
                                     array_push($QueARR,$medicalQuestions);
                                  }
                             }
                          }
                $medical->medicalQuestions =$QueARR;
                $_person->medical = $medical;
            
             array_push($personsArr,$_person);
        }
        
        //$period = $this->timePeriod('Y-m-d',1);
         
        $request  = new \stdClass();
        $chars  = time().date('Ymd').time();
        $request->enquiryId = str_shuffle(substr(str_shuffle($chars), 0, 15));
        $request->partnerName =  "AGENT";
        
        $payment = new \stdClass();
        $payment->paymentType =  "ONLINE";
        $payment->paymentDate =  date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('Y-m-d')))));
        
        $request->payment = $payment;
        
        $contract = new \stdClass();
        $contract->policyType =($enqData->policyType=="FL")?"FLOATER":"NONFLOATER";
        $contract->imd = "1000295";
        $contract->startDate = $policyStartDate;//date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('Y-m-d')))));
        
        $contract->policyNumber = null;
        $contract->subInsuranceProductCode = $jsonData->product;//"HRO03";
        $contract->nonAbsProductCode= $jsonData->code;//"HRO03";
        $contract->policyPeriod = $termYear;
        $contract->zone =$zone;
        $request->contract = $contract;
        //$request->zone =$zone;
        if(isset(Auth::guard('agents')->user()->id)){
            $_cityName  = DB::table('cities_list')->where('id',Auth::guard('agents')->user()->city)->value('name');
            $_stateName = DB::table('states_list')->where('id',Auth::guard('agents')->user()->state)->value('name');
            $pospInfo = new \stdClass();
            $pospInfo->isPOSP =  true;
            $pospInfo->pospName =  Auth::guard('agents')->user()->name;
            $pospInfo->pospUniqueNumber =  Auth::guard('agents')->user()->posp_ID;
            $pospInfo->pospLocation =   $_cityName.", ".$_stateName;
            $pospInfo->pospPanNumber =  Auth::guard('agents')->user()->pan_card_number;
            $pospInfo->pospAadhaarNumber =  "";
            $pospInfo->pospContactNumber =  Auth::guard('agents')->user()->mobile;
            $request->pospInfo = $pospInfo;
        }
        
        $request->persons = $personsArr;//[$_person];
        if(isset($params->addOn) && $params->addOn!=""){
               
            if($params->addOn!="None"){
                 $Maternity = ($params->addOn=='Maternity_25000')?"25000":"50000";
                 $request->addon['Maternity'] = $Maternity;
                 $request->addon['Maternity WP'] = "2";
                 $request->addon['Maternity SI'] = "100";
            }
        }
        if($enqData->actualZone!=$zone){
                 $request->addon['Zone Upgrade'] = $zone;
             }
        $Ccoverages1 = new \stdClass();
        $Ccoverages1->coverType = "48745";
        $Ccoverages1->sumInsuredAmount = "$SUMSTRING";
        
        $Ccoverages2 = new \stdClass();
        $Ccoverages2->coverType = "48737";
        $Ccoverages2->sumInsuredAmount ="$SUMSTRING";
        $request->contractCoverages = [$Ccoverages1,$Ccoverages2];
        
        return $request;
    }
    
    function createPolicy($enq){
            $request = $this->setCreatePolicyParams($enq);
            $enqData = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enq)->first();
            $params = json_decode($enqData->params_request);
            $json = json_decode($enqData->json_data);
           // echo json_encode($request);
            
                   $client = new Client([
                        'headers' => ['Accept' => '*/*', 'Content-Type' => 'application/json','Authorization'=>config('mediclaim.DIGIT.ApiKey')]
                    ]);
                    
                    $clientResp = $client->post(config('mediclaim.DIGIT.CreateQuote'),
                        ['body' => json_encode($request)]
                    );
                     $response = $clientResp->getBody()->getContents();
                     $resp = json_decode($response);
             
             if(isset($resp->error->errorCode)){
                if(($resp->error->errorCode==200) && (isset($resp->paymentLink))){
                      $amt  = str_replace("INR","",$resp->premium->basePremiumWithTax);//$this->clean_str(str_replace("INR","",$resp->premium->basePremiumWithTax));
                      $amt  = number_format((float)$amt, 2, '.', '');  
                      $data=['enq'=>$enq,'proposalNum'=>$resp->policyNumber,'quotationPremium'=>$amt];
                      $json->proposalNum = $resp->policyNumber;
                      $json->paymentLink = $resp->paymentLink;
                      $json->amount = $amt;
                      $json->zone = $enqData->zone;
                      $period = timePeriod('Y-m-d',$request->contract->policyPeriod,$request->contract->startDate);
                      DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enq)
                                            ->update([ 'proposalNumber'=>$resp->policyNumber,
                                                       'reqCreate'=>json_encode($request),
                                                       'respCreate'=>$response,
                                                        'startDate'=>$request->contract->startDate,
                                                       'endDate'=>$period->endDate,
                                                       'premiumAmount'=>$amt,
                                                        'netAmt'=>str_replace(',','',str_replace('INR','',$resp->premium->netPremium)),
                                                        'taxAmt'=>str_replace(',','',str_replace('INR','',$resp->premium->totalTax)),
                                                        'grossAmt'=>str_replace(',','',str_replace('INR','',$resp->premium->grossPremium)),
                                                       'token'=>$resp->policyNumber,
                                                       'json_data'=>json_encode($json)]);
                      $result = ['status'=>'success','message'=>"Policy number generated",'data'=>$data];
                }else{
                     DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enq)
                                            ->update([ 'reqCreate'=>json_encode($request),
                                                       'respCreate'=>$response,
                                                       ]);
                    $result = ['status'=>'error','message'=>$resp->error->errorMessage,'data'=>[]];
                }
             }else{
                 DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enq)
                                            ->update([ 'reqCreate'=>json_encode($request),
                                                       'respCreate'=>$response,
                                                       ]);
                $result = ['status'=>'error','message'=>"Somethig went wrong, try again",'data'=>[]]; 
             }
          return $result;
    }
} 