<?php 
namespace App\Partners\HdfcErgo;
use Nathanmac\Utilities\Parser\Parser;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Carbon\Carbon;

class OptimaSecure{
     function calculatePremium($params,$sum,$sumInsured,$devicetoken,$pTyp){
          $persons = [];
         foreach($params->members as $key=>$data){
                if($data->type=="self")     {      $relationCd = "Self";     $roleCd ="PRIMARY";$gender=($params->gender=='MALE')?"Male":"Female"; }
                else if($data->type=="daughter"){  $relationCd = "Daughter"; $roleCd ="PRIMARY";$gender="Female";}
                else if($data->type=="son")     {  $relationCd = "Son";      $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="wife")    {  $relationCd = "Wife";     $roleCd ="PRIMARY";$gender="Female";}
                else if($data->type=="husband") {  $relationCd = "Husband";  $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="father")  {  $relationCd = "Father";   $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="mother")  {  $relationCd = "Mother";   $roleCd ="PRIMARY";$gender="Female";}
                    
                $person = [
                         "InsuredRelation"=> $relationCd,
                         "InsuredAge"=> (int)$data->age,
                         ];
                  array_push($persons,$person);
                }
                
            
            $child = $params->total_child;
            $adult = $params->total_adult;
           
             $totalMem = $child+$adult;
             if($totalMem>1){
                 $policyType = ($pTyp=="FL")?"Family":"Individual";
             }else{
                 $policyType = "Individual";
                 $pTyp  = "IN";
             }
            $chars  = time().'A1B2C3D4E5F6G7H8I9J0K9L8BUYPO'.time().'LICYM7N6O5P4Q3R2S1T123456789UVWXYZ'.date('Ymd');
            $enquiryId = str_shuffle(substr(str_shuffle($chars), 0, 15));
            $sumInsured =($sum*100000);
            $request =  new \stdClass();
            $configurationParam = new \stdClass();
            $configurationParam->AgentCode = config('mediclaim.HDFCERGO.OptimaSecure.agentCode');
            $request->ConfigurationParam = $configurationParam;
            $request->PlanName= "OptimaSecure";
            $request->PlanType=$policyType;
            $request->PinCode=(int)$params->address->pincode;
            $request->PolicyTenure= 1;
            $request->SumInsured=$sumInsured;
            $request->Deductible= 0;
            $request->IsLoyaltyDiscountOpted=false;
            
            $InsuredDetail = new \stdClass();
            $request->InsuredDetail = $persons;
          // echo json_encode($request);die;
            try {     
                   $client = new Client([
                     'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('mediclaim.HDFCERGO.OptimaSecure.mKey'),'SecretToken'=>config('mediclaim.HDFCERGO.OptimaSecure.secretToken')]
                  ]);
           
                    $clientResp = $client->post(config('mediclaim.HDFCERGO.OptimaSecure.calculatePremium'),
                        ['body' => json_encode($request)]
                    );
                     $response = $clientResp->getBody()->getContents();
                     $resp = json_decode($response);
                   //  print_r($resp);die;
                     $product = "OPTIMA_SECURE";
                     if(isset($resp->Status) && $resp->Status==200 ){
                        $Data = $resp->Data;
                         
                        $features = DB::table('plans_features')
                          ->select('plan_key_features.features as _key','plans_features.val as _val','plan_key_features.description as _desc')
                          ->leftJoin('plans','plans.id','plans_features.plan_id')
                          ->leftJoin('plan_key_features','plan_key_features.code','plans_features.featuresKey')
                          ->where('plans.product','=',$product)
                          ->where('plans.supplier','=','HDFCERGO')->limit(5)->get();
                          
                          
                         
                         
                        $partner = DB::table('our_partners')->select('our_partners.*','plans.plan_name as planTitle')
                                                  ->leftJoin('plans','plans.supplier','our_partners.shortName')
                                                  ->where('plans.product',$product)->where('our_partners.shortName','=','HDFCERGO')->first();
                           
                           
                          $PremiumDetails  =$Data->PremiumDetails[0];
                          $amount =    $PremiumDetails->TotalFinalPremium;   
                          $plan['supplier']="HDFCERGO";
                          $plan['sumInsured'] = $sum;
                          $plan['features'] = $features;
                          $plan['title']    = $partner->planTitle;
                          $plan['amount']   = $amount;//str_replace(" ","",str_replace("INR","",$resp->premium->basePremiumWithTax));
                          $plan['supp_name']=$partner->name;
                          $plan['supp_logo']=asset('assets/partners/'.$partner->logo_image);
                          $plan['id']=$Data->QuoteNo;
                          
                          $quoteData = ['short_sumInsured'=>$sum,'long_sumInsured'=>$sumInsured,'premiumAmount'=>$amount,
                                        'quote_id'=>$Data->QuoteNo,'type'=>'HEALTH','policyType'=>$pTyp,
                                        'code'=>"OptimaSecure",'product'=>$product,'title'=>$partner->planTitle,
                                        'device'=>$devicetoken,'provider'=>'HDFCERGO',
                                        'call_type'=>"QUOTE",
                                        'reqQuote'=>json_encode($request),
                                        'respQuote'=>$response,
                                        'netAmt'=>$PremiumDetails->GrossPremium,
                                        'taxAmt'=>$PremiumDetails->TaxAmount,
                                        'grossAmt'=>$PremiumDetails->TotalFinalPremium,
                                        'req'=>json_encode($request),'resp'=>($response)];
                          DB::table('app_temp_quote')->insertGetId($quoteData);
                         return ['status'=>true,'data'=>$plan];
                      }else{
                         return ['status'=>false,'data'=>[]];
                      }
                }catch (ConnectException $e) {
                    return ['status'=>false,'Exception'=>'ConnectException','data'=>[]];
                }catch (RequestException $e) {
                    //print_r($e->getResponse());die;
                     return ['status'=>false,'Exception'=>'RequestException','data'=>[]];
                }catch (ClientException $e) {
                     return ['status'=>false,'Exception'=>'ClientException','data'=>[]];
                }
         
     } 
     
     
    function recalculatePremium($enqId,$termYear,$sum,$addOn){
        
        $enqData = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqId)->first();
        $params = json_decode($enqData->params_request);
        $jd = json_decode($enqData->json_data);
        $SI = json_decode($enqData->sumInsured);
        if($sum==$SI->shortAmt){
                    $respQuote = json_decode($enqData->respQuote);
                    $Data = $respQuote->Data;
                    $PremiumDetails  =$Data->PremiumDetails;
                    $jsonAmtArr = [];
                    foreach($PremiumDetails as $each){
                        if($each->Deductible==0.0 && ($each->Tenure==1 || $each->Tenure==2 || $each->Tenure==3) ){
                             $jsonAmtArr[$each->Tenure]=['quoteNo'=>$Data->QuoteNo,'quoteId'=>$each->quoteId,'Discount'=>$each->TotalDiscount,'Addons'=>[],'Addons_Total'=>0.00,
                                                        'Base_Premium'=>$each->GrossPremium,
                                                        'Total_Premium'=>$each->TotalFinalPremium,
                                                        'Total_Tax'=>$each->TaxAmount];
                        }
                    }
                    
                    
                       $quoteData = ["params_request->addOn" =>"",
                                        'amounts'=>json_encode($jsonAmtArr),
                                        "premiumAmount"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                                        "json_data->amount"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                                        "json_data->quotation"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                                        "json_data->sumInsured"=>$sum,
                                        "json_data->code"=>"OptimaSecure",
                                        'termYear'=>$termYear,
                                        'sumInsured->shortAmt'=>$sum,
                                        'sumInsured->longAmt'=>($sum*100000),
                                        'netAmt'=>$jsonAmtArr[$termYear]['Base_Premium'],
                                        'taxAmt'=>$jsonAmtArr[$termYear]['Total_Tax'],
                                        'grossAmt'=>$jsonAmtArr[$termYear]['Total_Premium'],
                                        'reqRecalculate'=>$enqData->reqQuote,
                                        'respRecalculate'=>$enqData->respQuote,
                                        'req'=>$enqData->reqQuote,
                                        'resp'=>$enqData->respQuote];
                       DB::table('app_quote')->where('enquiry_id', $enqId)->update($quoteData);
        }else{ //if End for if sum is same as pre selected.
            
        
        
          $persons = [];
         foreach($params->members as $key=>$data){
                if($data->type=="self")     {      $relationCd = "Self";     $roleCd ="PRIMARY";$gender=($params->gender=='MALE')?"Male":"Female"; }
                else if($data->type=="daughter"){  $relationCd = "Daughter"; $roleCd ="PRIMARY";$gender="Female";}
                else if($data->type=="son")     {  $relationCd = "Son";      $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="wife")    {  $relationCd = "Wife";     $roleCd ="PRIMARY";$gender="Female";}
                else if($data->type=="husband") {  $relationCd = "Husband";  $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="father")  {  $relationCd = "Father";   $roleCd ="PRIMARY";$gender="Male";}
                else if($data->type=="mother")  {  $relationCd = "Mother";   $roleCd ="PRIMARY";$gender="Female";}
                    
                $person = [
                         "InsuredRelation"=> $relationCd,
                         "InsuredAge"=> (int)$data->age,
                         ];
                  array_push($persons,$person);
                }
                
            
            $child = $params->total_child;
            $adult = $params->total_adult;
           
             $totalMem = $child+$adult;
             if($totalMem>1){
                 $policyType = ($enqData->policyType=="FL")?"Family":"Individual";
             }else{
                 $policyType = "Individual";
                 $pTyp  = "IN";
             }
            $chars  = time().'A1B2C3D4E5F6G7H8I9J0K9L8BUYPO'.time().'LICYM7N6O5P4Q3R2S1T123456789UVWXYZ'.date('Ymd');
            $enquiryId = str_shuffle(substr(str_shuffle($chars), 0, 15));
            $sumInsured =($sum*100000);
            $request =  new \stdClass();
            $configurationParam = new \stdClass();
            $configurationParam->AgentCode = config('mediclaim.HDFCERGO.OptimaSecure.agentCode');
            $request->ConfigurationParam = $configurationParam;
            $request->PlanName= "OptimaSecure";
            $request->PlanType=$policyType;
            $request->PinCode=(int)$params->address->pincode;
            $request->PolicyTenure= 1;
            $request->SumInsured=$sumInsured;
            $request->Deductible= 0;
            $request->IsLoyaltyDiscountOpted=false;
            
            $InsuredDetail = new \stdClass();
            $request->InsuredDetail = $persons;
            $jsonAmtArr = [];$REQARR= [];$RESPARR= [];
            $reqQuote = "";
            $respQuote = "";
             
              
                
                  $client = new Client([
                     'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('mediclaim.HDFCERGO.OptimaSecure.mKey'),'SecretToken'=>config('mediclaim.HDFCERGO.OptimaSecure.secretToken')]
                  ]);
           
                    $clientResp = $client->post(config('mediclaim.HDFCERGO.OptimaSecure.calculatePremium'),
                        ['body' => json_encode($request)]
                    );
                     $response = $clientResp->getBody()->getContents();
                     $resp = json_decode($response);
                     
                     
                    
                     if(isset($resp->Status) && $resp->Status==200 ){
                         $Data = $resp->Data;
                         $PremiumDetails  =$Data->PremiumDetails;
                         
                         foreach($PremiumDetails as $each){
                            if($each->Deductible==0.0 && ($each->Tenure==1 || $each->Tenure==2 || $each->Tenure==3) ){
                                 $jsonAmtArr[$each->Tenure]=['quoteNo'=>$Data->QuoteNo,'quoteId'=>$each->quoteId,'Discount'=>$each->TotalDiscount,'Addons'=>[],'Addons_Total'=>0.00,
                                                            'Base_Premium'=>$each->GrossPremium,
                                                            'Total_Premium'=>$each->TotalFinalPremium,
                                                            'Total_Tax'=>$each->TaxAmount];
                            }
                        }
                      }
            
            $quoteData = ["params_request->addOn" =>"",
                            'amounts'=>json_encode($jsonAmtArr),
                            //"zone"=>$zoneCd,
                            "code"=>"OptimaSecure",
                            "premiumAmount"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                            "json_data->amount"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                            "json_data->quotation"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                            "json_data->sumInsured"=>$sum,
                            "json_data->code"=>'OptimaSecure',
                            'termYear'=>$termYear,
                            'sumInsured->shortAmt'=>$sum,
                            'sumInsured->longAmt'=>($sum*100000),
                            'reqQuote'=>json_encode($request),
                            'respQuote'=>$response,
                            'netAmt'=>$jsonAmtArr[$termYear]['Base_Premium'],
                            'taxAmt'=>$jsonAmtArr[$termYear]['Total_Tax'],
                            'grossAmt'=>$jsonAmtArr[$termYear]['Total_Premium'],
                            'reqRecalculate'=>json_encode($request),
                            'respRecalculate'=>$response,
                            'req'=>json_encode($request),
                            'resp'=>$response];
              DB::table('app_quote')->where('enquiry_id', $enqId)->update($quoteData);
             
                   
               
        }
     } 
     
    function createPolicy($enq){
            $enqData = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enq)->first();
            $termYear = $enqData->termYear;
            $params = json_decode($enqData->params_request);
            $json_data = json_decode($enqData->json_data);
            $Amts = json_decode($enqData->amounts);
            $amt =  $Amts->$termYear;
            $SI = json_decode($enqData->sumInsured);
            $sumInsured =  $SI->longAmt;
            $child = $params->total_child;
            $adult = $params->total_adult;
           
             $totalMem = $child+$adult;
             if($totalMem>1){
                 $policyType = ($pTyp=="FL")?"Family":"Individual";
             }else{
                 $policyType = "Individual";
                 $pTyp  = "IN";
             }
            
            
            $request =  new \stdClass();
            $configurationParam = new \stdClass();
            $configurationParam->AgentCode = config('mediclaim.HDFCERGO.OptimaSecure.agentCode');
            $request->ConfigurationParam = $configurationParam;
            $request->PlanName= "OptimaSecure";
            $request->PlanType=$policyType;
            $request->PinCode=(int)$params->address->pincode;
            $request->PolicyTenure= $termYear;
            $request->SumInsured=$sumInsured;
            $request->Deductible= 0;
            $request->IsLoyaltyDiscountOpted=false;
            $request->QuoteNo = $amt->quoteNo;
            
            $PremiumDetails =  new \stdClass();
                
            $PremiumDetails->quoteId = $amt->quoteId;
            $PremiumDetails->BasePremium= ($amt->Base_Premium+$amt->Discount);
            $PremiumDetails->TaxPercentage=18.0;
            $PremiumDetails->TaxAmount= $amt->Total_Tax;
            $PremiumDetails->TotalDiscount= $amt->Discount;
            $PremiumDetails->TotalFinalPremium= $amt->Total_Premium;
            $PremiumDetails->GrossPremium= $amt->Base_Premium;
            
            $request->PremiumDetails = $PremiumDetails;
            
            $persons = [];
            foreach($params->members as $key=>$data){
                if($data->type=="self")     {      $relationCd = "Self";    
                                                   $Salutation =($params->gender=='MALE')?'Mr.':(($params->selfMstatus=="Married")?"Mrs.":"Ms.");
                                                   $gender=($params->gender=='Male')?"Male":"Female";
                                            }
                else if($data->type=="daughter"){  $relationCd = "Daughter"; $Salutation ="Ms.";$gender="Female";}
                else if($data->type=="son")     {  $relationCd = "Son";      $Salutation ="Mr.";$gender="Male";}
                else if($data->type=="wife")    {  $relationCd = "Wife";     $Salutation ="Mrs.";$gender="Female";}
                else if($data->type=="husband") {  $relationCd = "Husband";  $Salutation ="Mr.";$gender="Male";}
                else if($data->type=="father")  {  $relationCd = "Father";   $Salutation ="Mr.";$gender="Male";}
                else if($data->type=="mother")  {  $relationCd = "Mother";   $Salutation ="Mr.";$gender="Female";}
                 $FullName =  ($data->type=="self")?$params->selfFname." ".$params->selfLname:$data->fname." ".$data->lname;
                 $DateofBirth = ($data->type=="self")?$params->selfyy."-".$params->selfmm."-".$params->selfdd:$data->yy."-".$data->mm."-".$data->dd;
                 $HeightInFt = ($data->type=="self")?$params->selfFeet:$data->feet;
                 $HeightInInc = ($data->type=="self")?$params->selfInch:$data->inch;
                 $Weight = ($data->type=="self")?$params->selfWeight:$data->weight;
                 $Medi =[];
                 if(isset($data->medical) && $params->hasMedical=="YES"){ 
                     
                      foreach($data->medical as $q){ 
                          $Que =  new \stdClass();
                          $Q =  DB::table('medical_questions')->where('id', $q->queId)->first();
                          $Que->QuestionId =$Q->code;
                          $Que->QuestionText =$Q->title;
                          $ch = $q->childQuestions[0];
                          //$chQ =  DB::table('medical_questions')->where('id', $ch->Qid)->first();
                          $ANS = explode("@@",$ch->answer);
                          $opt =[
                                    "OptionId"=>$ANS[0],
                                    "OptionText"=> $ANS[1],
                                   // "ExactDiagnosis"=>"High Blood Pressure",
                                   // "ConsultationDate"=> "2020-03-29",
                                   // "DiagnosisDate"=> "2020-03-29",
                                   // "CurrentStatus"=> "Cured",
                                   // "LineOfManagement"=> "Medical Management",
                                    //"TreatmentDetails"=> "Medical Checkup"
                                 ];
                          $options =[];
                          array_push($options,$opt);
                          $Que->Options = $options;
                          
                         array_push($Medi,$Que);
                      }
                 }
                 
                 $person = [
                        "Relation"=> $relationCd,
                        "FullName"=> $FullName,
                        "HeightInFt"=> $HeightInFt,
                        "HeightInInc"=> $HeightInInc,
                        "Weight"=> $Weight,
                        "Gender"=> $gender,
                        "Salutation"=> $Salutation,
                        "DateofBirth"=> $DateofBirth,
                        "MedicalQuestionDetails"=> $Medi
                        ];
                  array_push($persons,$person);
                }
                
            $request->InsureDetail = $persons;
             
            $ProposerDetails =  new \stdClass();
            $_Salutation =($params->gender=='MALE')?'Mr.':(($params->selfMstatus=="Married")?"Mrs.":"Ms.");
            $ProposerDetails->Salutation=$_Salutation;
            $ProposerDetails->FullName= $params->selfFname." ".$params->selfLname;
            $ProposerDetails->DateofBirth= $params->selfyy."-".$params->selfmm."-".$params->selfdd;
            $ProposerDetails->MaritalStatus= $params->selfMstatus;
            $ProposerDetails->Email= $params->selfEmail;
            $ProposerDetails->MobileNo= $params->selfMobile;
            $ProposerDetails->AlternateMobileNo="";
            
            $cityID = explode('-',$params->address->city)[0];
            $stateID = explode('-',$params->address->state)[0];
            $state =  DB::table('states')->where('id',$stateID)->first();
            $city  =  DB::table('cities')->where('id',$cityID)->first();
            
            $ProposerDetails->PinCode= $params->address->pincode;
            $ProposerDetails->StateName= strtoupper($state->name);
            $ProposerDetails->CityName= strtoupper($city->name);
            $ProposerDetails->Address1=  $params->address->house_no;
            $ProposerDetails->Address2=  $params->address->street;
            $ProposerDetails->Address3= null;
            $ProposerDetails->CityId=$city->hdfcErgoCode;
            $ProposerDetails->StateId=$state->hdfcErgoCode;
            $ProposerDetails->PanCard= $params->document->documentId;
            $ProposerDetails->GstInNo= null;
            $request->ProposerDetails = $ProposerDetails;
            
            if($params->nomineerelation=="SPOUSE"){
                 $RelationWithProposer = ($params->gender=='MALE')?"Wife":"Husband";
            }else{
               $RelationWithProposer = ucfirst(strtolower(str_replace('_','-',$params->nomineerelation)));
            }
            $NomineeDetails =  new \stdClass();
            $nDob  = $params->nomineeyy."-".$params->nomineemm."-".$params->nomineedd;
            $NomineeDoB = Carbon::createFromFormat('Y-m-d', $nDob)->format('Y-m-d');
            $NomineeAge = calulateAge($NomineeDoB);
            $NomineeDetails->FullName =  $params->nomineename;
            $NomineeDetails->Age= $NomineeAge;
            $NomineeDetails->RelationWithProposer= $RelationWithProposer;//"Son"
            $NomineeDetails->AddressSameAsProposer= true;
            $NomineeDetails->Address1= $params->address->house_no;
            $NomineeDetails->Address2= $params->address->street;
            $NomineeDetails->Address3= null;
            $NomineeDetails->PinCode= $params->address->pincode;
            $NomineeDetails->StateName=strtoupper($state->name);
            $NomineeDetails->CityName= strtoupper($city->name);
            $NomineeDetails->CityId=$city->hdfcErgoCode;
            $NomineeDetails->StateId=$state->hdfcErgoCode;
            $NomineeDetails->AddressSameAsApointee= false;
            
            $ApointeeDetails =  new \stdClass();
            $RelationWithNominee = "";
            if($NomineeAge<18 && ($params->nomineerelation=="SON" || $params->nomineerelation=="DAUGHTER")){
                $NomineeDetails->AddressSameAsApointee= true;
                $RelationWithNominee = ($params->gender=='MALE')?"Father":"Mother"; 
            }else if($NomineeAge<18 && ($params->nomineerelation=="BROTHER" || $params->nomineerelation=="SISTER")){ 
                $NomineeDetails->AddressSameAsApointee= true;
                $RelationWithNominee = ($params->gender=='MALE')?"Brother":"Sister";
            }else if($params->nomineerelation=="SPOUSE"){
                 $RelationWithNominee = ($params->gender=='MALE')?"Wife":"Husband";
            }else{
                $RelationWithNominee = null;
            }
                $ApointeeDetails->FullName= $params->selfFname." ".$params->selfLname;
                $ApointeeDetails->RelationWithNominee =  $RelationWithNominee;//"Mother";
                $ApointeeDetails->AddressSameAsProposer=  false;
                  
            $ApointeeDetails->Address1= $params->address->house_no;
            $ApointeeDetails->Address2= $params->address->street;
            $ApointeeDetails->Address3= null;
            $ApointeeDetails->PinCode= $params->address->pincode;
            $ApointeeDetails->StateName=strtoupper($state->name);
            $ApointeeDetails->CityName= strtoupper($city->name);
            $ApointeeDetails->CityId=$city->hdfcErgoCode;
            $ApointeeDetails->StateId=$state->hdfcErgoCode;
            
            $NomineeDetails->ApointeeDetails = $ApointeeDetails;
            
            $request->NomineeDetails = $NomineeDetails;
            
            
             $client = new Client([
              'headers' => [ 'Content-Type' => 'application/json',
                             'MerchantKey'=>config('mediclaim.HDFCERGO.OptimaSecure.mKey'),
                             'SecretToken'=>config('mediclaim.HDFCERGO.OptimaSecure.secretToken')
                           ]
             ]);
   
             $clientResp = $client->post(config('mediclaim.HDFCERGO.OptimaSecure.proposalService'),
                ['body' => json_encode($request)]
             );
             $response = $clientResp->getBody()->getContents();
             $resp = json_decode($response);
           //  print_r($response);
             if(isset($resp->Status) && $resp->Status==200 ){ 
                    $data=['enq'=>$enq,
                              'amount'=> $amt->Total_Premium,
                              'proposalNum'=> $amt->quoteNo,
                              'quotationPremium'=>$amt->Total_Premium
                              ];
                              
                      DB::table('app_quote')->where('type','HEALTH')
                                            ->where('enquiry_id',$enq)
                                            ->update(['token'=>$resp->Data->PaymentTransactionNo,
                                                      'proposalNumber'=>$amt->quoteNo,
                                                      'premiumAmount'=>$amt->Total_Premium,
                                                      'reqCreate'=>json_encode($request),
                                                      'respCreate'=>$response,
                                                      'json_data->enq'=>$resp->UniqueRequestID,
                                                      'req'=>json_encode($request), 'resp'=>$response,
                                                      'netAmt'=>number_format((float)$amt->Base_Premium, 2, '.', ''),
                                                      'taxAmt'=>number_format((float)$amt->Total_Tax, 2, '.', ''),
                                                      'grossAmt'=>number_format((float)$amt->Total_Premium, 2, '.', ''),
                                                      ]);
                    return ['status'=>'success','message'=>'Proposal created successfully','data'=>$data];
             }else if($resp->Status==406){
                  $DT = $resp->Data;
                  $msg = current($DT);
                  $data=['enq'=>$enq,
                              'amount'=> $amt->Total_Premium,
                              'proposalNum'=> $amt->quoteNo,
                              'quotationPremium'=>$amt->Total_Premium
                              ];
                  return ['status'=>'success','message'=>'Proposal created successfully','data'=>$data];
                 // return ['status'=>'error','message'=>$msg->Message,'data'=>[]];
             }else{
                 return ['status'=>'error','message'=>$output->responseData->message,'data'=>[]];
             }
             
             
    }
    
    function policyGen($enquiry_id){
        $enQ = DB::table('app_quote')->where('enquiry_id', $enquiry_id)->first();
        $jData = json_decode($enQ->json_data);
        
        $request =  new \stdClass(); 
        $request->AgentCode =config('mediclaim.HDFCERGO.OptimaSecure.agentCode');
        $request->ProductCode= "OS";
        $request->TransactionNo =$enQ->token; 
        $request->PaymentStatus= "SUCCESSFUL";
        $request->UniqueRequestID = $jData->enq;
          
           $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>config('mediclaim.HDFCERGO.OptimaSecure.mKey'),'SecretToken'=>config('mediclaim.HDFCERGO.OptimaSecure.secretToken')]
            ]);
            
            $clientResp = $client->post(config('mediclaim.HDFCERGO.OptimaSecure.policyGeneration'),
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
                $status = ($response->Data->PaymentStatus=="UPD")?true:true;
                $msg = "Policy Generated successfully";
                return ['status'=>$status,'message'=>$msg,'PolicyNumber'=>$PolicyNumber];
           }else if($response->Status==500){
                return ['status'=>false,'message'=>$response->Message];
           }else {
                 return ['status'=>false,'message'=>'Internal error while create proposal'];
           }
    } 
}