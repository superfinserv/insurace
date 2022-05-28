<?php 
namespace App\Partners\HdfcErgo;
use Nathanmac\Utilities\Parser\Parser;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
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
            $params = json_decode($enqData->params_request);
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
            $request->QuoteNo = '34122052731714';
            
            $PremiumDetails =  new \stdClass();
                
            $PremiumDetails->quoteId = "quote-28";
            $PremiumDetails->BasePremium= 67800.0;
            $PremiumDetails->TaxPercentage=18.0;
            $PremiumDetails->TaxAmount= 7208.0;
            $PremiumDetails->TotalDiscount= 27755.6;
            $PremiumDetails->TotalFinalPremium= 47252.0;
            $PremiumDetails->GrossPremium= 40044.39;
            
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
                $person = [
                        "Relation"=> $relationCd,
                        "FullName"=> $FullName,
                        "HeightInFt"=> $HeightInFt,
                        "HeightInInc"=> $HeightInInc,
                        "Weight"=> $Weight,
                        "Gender"=> $gender,
                        "Salutation"=> $Salutation,
                        "DateofBirth"=> $DateofBirth,
                        "MedicalQuestionDetails"=> []
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
            
            
            $NomineeDetails =  new \stdClass();
        
            $NomineeDetails->FullName =  $params->nomineename;
            $NomineeDetails->Age= 20;
            $NomineeDetails->RelationWithProposer= ucfirst(strtolower($params->nomineerelation));//"Son"
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
    
    }
}