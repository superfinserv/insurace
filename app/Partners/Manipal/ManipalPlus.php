<?php
namespace App\Partners\Manipal;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Auth;
use Carbon\Carbon;


class ManipalPlus{

     function calculatePremium($params,$sum,$sumInsured,$devicetoken,$policytyp){ 
         
                $productId = 'RPLS06SBSF';
                $productPlanOptionCd = $policytyp.'-PLS'.$sum.'-HMB2K';
                $_state = explode("-",$params['state']);
                $_city = explode("-",$params['city']);
                $pincode = $params['address']['pincode'];
                $zoneCd = DB::table('zone_mapping')->where('pincode',$pincode)->value('manipal_zone');
                 $child = $params['total_child'];
                $adult = $params['total_adult'];
                    
                $totalMem = $child+$adult;
                if($totalMem>1){$policyType = ($policytyp=="FL")?"FAMILYFLOATER":"INDIVIDUAL";$pT = $policytyp;}
                else{ $policyType = "INDIVIDUAL";$pT = "IN";}
                
                $quotationProductInsuredBenefitDOList[] = [ "benefitTypeCd"=>"","benefitId"=>"","amount"=>0,"productId"=>""];
                
                $quotationProductInsuredDOList=[];
                foreach($params['members'] as $key=>$data){ 
                     if($data['type']=="self")     { $relationCd = "SELF";   $roleCd="PRIMARY"; $gender=$params['gender']; }
                     else if($data['type']=="daughter"){  $relationCd = "UDTR";   $roleCd ="PRIMARY";$gender="FEMALE";}
                     else if($data['type']=="son")     {  $relationCd = "SON";    $roleCd ="PRIMARY";$gender="MALE";}
                     else if($data['type']=="wife")    {  $relationCd = "WIFE";   $roleCd ="PRIMARY";$gender="FEMALE";}
                     else if($data['type']=="husband") {  $relationCd = "HUSBAND";$roleCd ="PRIMARY";$gender="MALE";}
                     else if($data['type']=="father")  {  $relationCd = "FATH";   $roleCd ="PRIMARY";$gender="MALE";}
                     else if($data['type']=="mother")  {  $relationCd = "MOTH";   $roleCd ="PRIMARY";$gender="FEMALE";}
                        $dob= $data['dd']."/".$data['mm']."/".$data['yy'];
                        $quotationProductInsuredDOList[]=[
                                "issueAge"=> ($data['age']!="3-12")?(int)$data['age']:0,
                                "genderCd"=> $gender,
                                "insuredTypeCd"=> $roleCd,
                                "cityCd"=> $_city[1],
                                "mobileNum"=> 9999999999,
                                "emailAddress"=> "wesupport@superfinserv.com",
                                "dob"=> $dob,
                                "zoneCd"=> $zoneCd,
                                "smokerStatusCd"=> "",
                                "chewTobaccoCd"=> "",
                                "consumeAlcoholCd"=> "",
                                "relationCd"=> $relationCd,
                                "modalPremium"=> 0,
                                "extraPremium"=> 0,
                                "discount"=> 0,
                               
                                "productPlanOptionCd"=>$productPlanOptionCd,
                                "height"=> 155,
                                "weight"=> 55,
                                "sumInsured"=>$sumInsured,
                                "refGuid"=> "",
                                "ppmcFl"=> "",
                                "uwFl"=> "",
                                "ppmcSetName"=> "",
                                "customerId"=> "",
                               // "annualIncome"=> "UPTO50K",
    							"astpLoadingPerc"=>0,
    							"quotationProductInsuredBenefitDOList"=>$quotationProductInsuredBenefitDOList];
                 }
                
               $quotationProductBenefitDOList[]=["benefitTypeCd"=> "","benefitId"=> "","amount"=> 0,"productId"=>""];
               $quotationProductChargeDOList[]=["chargeClassCd"=> "","chargeAmount"=> 0,"chargePercentage"=> 0];
			   $quotationProductAddOnDOList[]=["productPlanOptionCd"=>"","productId"=>""];
			   $quotationProductDOList[] = [
                    "productId"=> $productId,
                    "productVersion"=> 1,
                    "productPlanOptionCd"=> $productPlanOptionCd,
                    "zoneCd"=> $zoneCd,
                    "productTypeCd"=> "SUBPLAN",
                    "payoutOption"=> "",
                    "reducingBalanceSI"=> "",
                    "paymentFrequencyCd"=> "SINGLE",
                    "astpLoadingPerc"=> 0,
                    "quotationProductBenefitDOList"=>$quotationProductBenefitDOList,
                    "quotationProductInsuredDOList"=>$quotationProductInsuredDOList,
                    "quotationProductChargeDOList"=>$quotationProductChargeDOList,
                    "quotationProductAddOnDOList"=>$quotationProductAddOnDOList
                    ];
                    
               $quotationChargeDOList  =  new \stdClass();
               $quotationChargeDOList->chargeClassCd="";
               $quotationChangeDOList  =  new \stdClass();
               $quotationChangeDOList->alterationType = "";
               $listofquotationTO[]= ["quoteId" => "","channelId"=>"325",
                                       "productId"=>$productId,
                                      "parentProductId"=> "NULL","parentProductVersion"=> 1,"noOfAdults"=>(int)$adult,"noOfKids"=>(int)$child,
                                      "tenure"=> 1,"productPlanOptionCd"=> $productPlanOptionCd,
                                      "policyType"=> $policyType,
                                      "saveFl"=> "YES","quoteTypeCd"=> "INITIAL","quotationDt"=> date('d/m/Y'),"agentId"=> "1000015-01",
                                      "campaignCd"=> "DEFCMP03","productFamilyCd"=> "","policyNum"=> "","inwardTypeCd"=> "NEWBUSINESS",
                                      "inwardSubTypeCd"=> "PROPOSALDOCUMENT","ppmcFl"=> "","uwFl"=> "","caseType"=> "","sezUnit"=> "",
                                      "stateCd"=> "", "srNum"=> "","migrationFlag"=> "","astpFlag"=>"NO",
                                      "quotationProductDOList"=>$quotationProductDOList,
                                      "quotationChargeDOList"=>[$quotationChargeDOList],
                                      "quotationChangeDOList"=>[$quotationChangeDOList]];
              
              $Request = ["listofquotationTO"=>$listofquotationTO];
            
           
              
           $client = new Client([
                'headers' => [ 'Content-Type'=>'application/json',"app_key"=>config('mediclaim.MANIPAL.appKey'),"app_id"=>config('mediclaim.MANIPAL.appIdQuote')]
            ]);
            
            $clientResp = $client->post(config('mediclaim.MANIPAL.QuickQuote'),
                ['body' => json_encode($Request)]
            );
            $response = $clientResp->getBody()->getContents();   
            //print_r($result);
            $result=json_decode($response);
             if(isset($result->errorList[0]->errProcessStatusCd)){
                 $_result =  ['status'=>false,'data'=>[]];
             }else if(isset($result->listofquotationTO[0]->quoteId)){
              
                  $quoteId  = $result->listofquotationTO[0]->quoteId;
                
                 
                  $features=DB::table('plans')->join('plans_features', 'plans.id', '=', 'plans_features.plan_id')
                                                    ->join('plan_key_features', 'plan_key_features.key_features', '=', 'plans_features.features')
                                           ->select('plans_features.features as _key','plans_features.val as _val','plan_key_features.description as _desc')
                                           ->where(['supplier'=>'MANIPAL_CIGNA','plan_val'=>'MANIPAL_CIGNA-PROHEALTH_PLUS'])->get();
                      
                      
                      $amount  = $result->listofquotationTO[0]->totPremium;
                      //$plan['supplier_id']=17; 
                      $plan['supplier']="MANIPAL_CIGNA";
                      $plan['sumInsured'] = $sum;
                      $plan['features'] = $features;
                      $plan['title']    ="Pro Health Plus";
                      $plan['amount']   = $amount;//$result->listofquotationTO[0]->totPremium
                      $plan['supp_name']="ManipalCigna Health Insurance";
                      $plan['supp_logo']="https://health.policybazaar.com/insurer-logo/ManipalCigna.webp";
                      $plan['id']=$quoteId;
                      
                      $quoteData = ['short_sumInsured'=>$sum,'long_sumInsured'=>$sumInsured,'premiumAmount'=>$amount,
                                    'quote_id'=>$quoteId,'type'=>'HEALTH','policyType'=>$policytyp,
                                    'code'=>$productPlanOptionCd,'product'=>$productId,'title'=>"ProHealth-Plus",
                                    'device'=>$devicetoken,'provider'=>'MANIPAL_CIGNA',
                                    'call_type'=>"QUOTE",'response'=>($response),
                                    'json_quote'=>($response),'req'=>json_encode($Request),'resp'=>($response)];
                      DB::table('app_temp_quote')->insertGetId($quoteData);
                 
                return  ['status'=>true,'data'=>$plan];
          }else{
           return  ['status'=>false,'data'=>[]]; 
          }
     }
     
     function recalculatePremium($enqId,$termYear,$sum,$_zone,$addOn){ 
          
         $enqData = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqId)->first();
         $params = json_decode($enqData->params_request);
         $jd = json_decode($enqData->json_data);
        
        $child = $params->total_child;
        $adult = $params->total_adult;
        
        
        
        $_state = explode("-",$params->address->state);
        $_city = explode("-",$params->address->city);
        $pincode = $params->address->pincode;
        if(!empty($_zone)){
             $zoneCd =$_zone;
        }else{
             $zoneCd = DB::table('zone_mapping')->where('pincode',$params->address->pincode)->value('manipal_zone');
        }
        
        $totalMem = $child+$adult;
         $policyType = ($enqData->policyType=="FL")?"FAMILYFLOATER":"INDIVIDUAL";
        $pT = $enqData->policyType;
         
         $productId = 'RPLS06SBSF';
         $productPlanOptionCd = $enqData->policyType.'-PLS'.$sum.'-HMB2K';
        
        
        $quotationProductInsuredBenefitDOList[] = [ "benefitTypeCd"=>"","benefitId"=>"","amount"=>0,"productId"=>""];
                
        $quotationProductInsuredDOList=[];
        foreach($params->members as $key=>$data){ 
             if($data->type=="self")     { $relationCd = "SELF";   $roleCd="PRIMARY"; $gender=$params->gender; }
             else if($data->type=="daughter"){  $relationCd = "UDTR";   $roleCd ="PRIMARY";$gender="FEMALE";}
             else if($data->type=="son")     {  $relationCd = "SON";    $roleCd ="PRIMARY";$gender="MALE";}
             else if($data->type=="wife")    {  $relationCd = "WIFE";   $roleCd ="PRIMARY";$gender="FEMALE";}
             else if($data->type=="husband") {  $relationCd = "HUSBAND";$roleCd ="PRIMARY";$gender="MALE";}
             else if($data->type=="father")  {  $relationCd = "FATH";   $roleCd ="PRIMARY";$gender="MALE";}
             else if($data->type=="mother")  {  $relationCd = "MOTH";   $roleCd ="PRIMARY";$gender="FEMALE";}
                $dob= $data->dd."/".$data->mm."/".$data->yy;
                $quotationProductInsuredDOList[]=[
                        "issueAge"=> ($data->age!="3-12")?(int)$data->age:0,
                        "genderCd"=> $gender,
                        "insuredTypeCd"=> $roleCd,
                        "cityCd"=> $_city[1],
                        "mobileNum"=> 9999999999,
                        "emailAddress"=> "bankbazaar@bankbazaar.com",
                        "dob"=> $dob,
                        "zoneCd"=> $zoneCd,
                        "smokerStatusCd"=> "",
                        "chewTobaccoCd"=> "",
                        "consumeAlcoholCd"=> "",
                        "relationCd"=> $relationCd,
                        "modalPremium"=> 0,
                        "extraPremium"=> 0,
                        "discount"=> 0,
                        "productPlanOptionCd"=>$productPlanOptionCd,// $pT.'-PLS'.$sum.'-HMB2K',
                        "height"=> 155,
                        "weight"=> 55,
                        "sumInsured"=>($sum*100000),// $sumInsured,
                        "refGuid"=> "",
                        "ppmcFl"=> "",
                        "uwFl"=> "",
                        "ppmcSetName"=> "",
                        "customerId"=> "",
                       //"annualIncome"=> "UPTO50K",
						"astpLoadingPerc"=>0,
						"quotationProductInsuredBenefitDOList"=>$quotationProductInsuredBenefitDOList];
         }
        
            
               $quotationProductBenefitDOList[]=["benefitTypeCd"=> "","benefitId"=> "","amount"=> 0,"productId"=>""];
               $quotationProductChargeDOList[]=["chargeClassCd"=> "","chargeAmount"=> 0,"chargePercentage"=> 0];
			   //$quotationProductAddOnDOList[]=["productPlanOptionCd"=>"IN-OPCBB-25","productId"=>"OPCBB04"];
			   if(isset($addOn) && $addOn!=""){
                   $addons = explode(",",$addOn);
                   foreach($addons as $adn){
    			     $quotationProductAddOnDOList[]=["productPlanOptionCd"=>"","productId"=>$adn];
                   }
			   }else{
			      $quotationProductAddOnDOList[]=["productPlanOptionCd"=>"","productId"=>""]; 
			   }
			   $quotationProductDOList[] = [
                    "productId"=> $productId,//"RPLS06SBSF",
                    "productVersion"=> 1,
                    "productPlanOptionCd"=>$productPlanOptionCd,//$pT.'-PLS'.$sum.'-HMB2K',
                    "zoneCd"=> $zoneCd,
                    "productTypeCd"=> "SUBPLAN",
                    "payoutOption"=> "",
                    "reducingBalanceSI"=> "",
                    "paymentFrequencyCd"=> "SINGLE",
                    "astpLoadingPerc"=> 0,
                    "quotationProductBenefitDOList"=>$quotationProductBenefitDOList,
                    "quotationProductInsuredDOList"=>$quotationProductInsuredDOList,
                    "quotationProductChargeDOList"=>$quotationProductChargeDOList,
                    "quotationProductAddOnDOList"=>$quotationProductAddOnDOList
                    ];
                    
               $quotationChargeDOList  =  new \stdClass();
               $quotationChargeDOList->chargeClassCd="";
               $quotationChangeDOList  =  new \stdClass();
               $quotationChangeDOList->alterationType = "";
               $listofquotationTO[]= ["quoteId" => "","channelId"=>"325",
                                       "productId"=>$productId,//"RPLS06SBSF",
                                      "parentProductId"=> "NULL","parentProductVersion"=> 1,"noOfAdults"=>(int)$adult,"noOfKids"=>(int)$child,
                                      "tenure"=> 1,"productPlanOptionCd"=>$productPlanOptionCd,// $pT.'-PLS'.$sum.'-HMB2K',
                                      "policyType"=> $policyType,
                                      "saveFl"=> "YES","quoteTypeCd"=> "INITIAL","quotationDt"=> date('d/m/Y'),"agentId"=> "1000015-01",
                                      "campaignCd"=> "DEFCMP03","productFamilyCd"=> "","policyNum"=> "","inwardTypeCd"=> "NEWBUSINESS",
                                      "inwardSubTypeCd"=> "PROPOSALDOCUMENT","ppmcFl"=> "","uwFl"=> "","caseType"=> "","sezUnit"=> "",
                                      "stateCd"=> "", "srNum"=> "","migrationFlag"=> "","astpFlag"=>"NO",
                                      "quotationProductDOList"=>$quotationProductDOList,
                                      "quotationChargeDOList"=>[$quotationChargeDOList],
                                      "quotationChangeDOList"=>[$quotationChangeDOList]];
              
            $Request = ["listofquotationTO"=>$listofquotationTO];
            
        
        $adName = ['OPCBB06'=>'ProHealth-Cumulative Bonus Booster','OPHDCB03'=>'Hospital Daily Cash Benefit'];
        $jsonAmtArr = [];$REQARR= [];$RESPARR= [];
        $reqQuote = "";
        $respQuote = "";
        for($Y=1;$Y<=3;$Y++){
              $Request['listofquotationTO'][0]['tenure'] = $Y;
              $REQARR[$Y] = $Request;
           
          
            $client = new Client([
                'headers' => [ 'Content-Type'=>'application/json',"app_key"=>config('mediclaim.MANIPAL.appKey'),"app_id"=>config('mediclaim.MANIPAL.appIdQuote')]
            ]);
            
            $clientResp = $client->post(config('mediclaim.MANIPAL.QuickQuote'),
                ['body' => json_encode($Request)]
            );
            
            
              $response = $clientResp->getBody()->getContents(); 
              //echo  $response;
              $result=json_decode($response);
              $RESPARR[$Y] = $response;
              
               if($termYear==$Y){ $reqQuote = json_encode($Request);  $respQuote = $response;} // Get Current TermYear Requset/Response
            if(isset($result->errorList[0]->errProcessStatusCd)){
              $_result =  ['status'=>false,'data'=>[]];
            }else if(isset($result->listofquotationTO[0]->quoteId)){
                
                $quoteId  = $result->listofquotationTO[0]->quoteId;
                $Total_Premium  = $result->listofquotationTO[0]->totPremium;
                $basePremium =$result->listofquotationTO[0]->quotationProductDOList[0]->basePremium;
                $discount =isset($result->listofquotationTO[0]->quotationProductDOList[0]->discount)?$result->listofquotationTO[0]->quotationProductDOList[0]->discount:0.00;
                $basePremium = $basePremium-$discount;
                $Addons=[];$Addons_Total=0.00;
                if(isset($result->listofquotationTO[0]->quotationProductDOList[0]->quotationProductAddOnDOList)){
                    $allAddons = $result->listofquotationTO[0]->quotationProductDOList[0]->quotationProductAddOnDOList;
                    foreach($allAddons as $ad){
                      $Addons[]=['title'=>$adName[$ad->productId],'premium'=>$ad->basePremium,'code'=>$ad->productId]; 
                      $Addons_Total = $Addons_Total+$ad->basePremium;
                    }
                }
                
                $totalTax=ceil(($basePremium*18)/100);
                
                $jsonAmtArr[$Y]=['quoteId'=>$quoteId,'Discount'=>$discount,'Addons'=>$Addons,'Addons_Total'=>$Addons_Total,'Base_Premium'=>$basePremium,'Total_Premium'=>$Total_Premium,'Total_Tax'=>$totalTax];
            }
        }
         //print_r($jsonAmtArr);
            $quoteData = ["params_request->addOn" =>$addOn,
                            'amounts'=>json_encode($jsonAmtArr),
                            "zone"=>$zoneCd,
                            "premiumAmount"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                            "json_data->amount"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                            "json_data->quotation"=>number_format((float)$jsonAmtArr[$termYear]['Total_Premium'], 2, '.', ''),
                            "json_data->sumInsured"=>$sum,
                            'termYear'=>$termYear,
                            'sumInsured->shortAmt'=>$sum,
                            'sumInsured->longAmt'=>($sum*100000),
                            'reqQuote'=>$reqQuote,
                            'respQuote'=>$respQuote,
                            'req'=>json_encode($REQARR),
                            'resp'=>json_encode($RESPARR)];
               DB::table('app_quote')->where('enquiry_id', $enqId)->update($quoteData);
     }
     
       function validateProposal($enqID){
            $Querydata = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqID)->first();
            $dataParam = json_decode($Querydata->json_data);
            $sumData = json_decode($Querydata->sumInsured);
            $sum = $sumData->shortAmt;
            
            $termYear = $Querydata->termYear;
           
            $_amts = json_decode($Querydata->amounts);
            
            $quoteId = $_amts->$termYear->quoteId;
            $quoteAmt = $_amts->$termYear->Total_Premium;
            $params = json_decode($Querydata->params_request);
            $child = $params->total_child;
            $adult = $params->total_adult;
            $pt = ($Querydata->policyType=='IN')?'INDIVIDUAL':"FAMILYFLOATER";
            
            $_state = explode("-",$params->address->state);
            $_city = explode("-",$params->address->city); 
            $pincode = $params->address->pincode;
            $zoneCd = $Querydata->zone;//$this->getZone($pincode);                                                                                                                                                                        
            $addressLine1 = $params->address->house_no;
            $addressLine2 = $params->address->street;
            $districtCd   = $_city[1];
            $stateCd      = $_state[1];
            $cityCd       = $_city[1];
            $pinCode      = $params->address->pincode;
            
            $mobile = $params->selfMobile;
            $email = $params->selfEmail;
            
            $nominee_name = isset($params->nomineename)?explode(" ",$params->nomineename):"NA NA";
            $nomineeTitle = ($params->nomineerelation=="MOTHER" || $params->nomineerelation=="DAUGHTER" || $params->nomineerelation=="GRANT_MOTHER" || $params->nomineerelation=="MOTHER_IN_LAW" || $params->nomineerelation=="SISTER" || $params->nomineerelation=="SPOUSE")?"MRS":"MR";
            $members  = $params->members;
            
            $docTypeArr = ['PAN_CARD'=>"PAN"];
            $period = timePeriod('d/m/Y',$termYear);
            
            
           
          
            $Document = $this->policyDocumentDOList_obj();
         
            $ProductDOList =  $this->policyProductDOList_obj();//Globel
            
            $_partyDOList =[];$_RoleDOList = [];$_ProductInsuredDOList =[];$_Document=[];$_refGuid=1;$i=0;$WSPolicyAdditionalMedicalDtlsDOLst=[];
            
            
            //Role For Proposer
            $PROPOSER_refGuid = "PRO00099";
            $proser_policyPartyRoleDOList = $this->policyPartyRoleDOList_obj(); 
            $proser_policyPartyRoleDOList["roleCd"]= "PROPOSER";
            $proser_policyPartyRoleDOList["refGuid"]= $params->plan.$PROPOSER_refGuid;
            $proser_policyPartyRoleDOList["partyId"]= $params->plan.$PROPOSER_refGuid;
            $_RoleDOList[]=$proser_policyPartyRoleDOList;
            
            //Party Do list for Proposer
            $PROPOSER_partyDOList =$this->partyDOList_obj();
            $PROPOSER_partyDOList['partyId']  = $params->plan.$PROPOSER_refGuid;
            $PROPOSER_partyDOList['partyGuid']  = $params->plan.$PROPOSER_refGuid;
            $PROPOSER_partyDOList['firstName1'] = $params->selfFname;;
            $PROPOSER_partyDOList['lastName1'] = $params->selfLname;;
            $PROPOSER_partyDOList['birthDt'] = $params->selfdd."/".$params->selfmm."/".$params->selfyy;;
            $PROPOSER_partyDOList['genderCd'] = $params->gender;
            $PROPOSER_partyDOList['maritalStatusCd'] = strtoupper($params->selfMstatus);;
            $PROPOSER_partyDOList['titleCd'] = ($params->gender=="MALE")?"MR":"MRS";
            $PROPOSER_partyDOList['roleCd'] = "PROPOSER";
            $PROPOSER_partyDOList['nomineeTitleCd']   = $nomineeTitle;
            $PROPOSER_partyDOList['nomineeFirstName'] = $nominee_name[0];
            $PROPOSER_partyDOList['nomineeLastName'] = $nominee_name[1];
            $PROPOSER_partyDOList['zoneCd'] = $zoneCd;
            $PROPOSER_partyDOList['partyAddressDOList'][0]['addressLine1Lang1'] = $PROPOSER_partyDOList['partyAddressDOList'][1]['addressLine1Lang1'] = $addressLine1;
            $PROPOSER_partyDOList['partyAddressDOList'][0]['addressLine2Lang1'] = $PROPOSER_partyDOList['partyAddressDOList'][1]['addressLine2Lang1']= $addressLine2;
            $PROPOSER_partyDOList['partyAddressDOList'][0]['stateCd'] = $PROPOSER_partyDOList['partyAddressDOList'][1]['stateCd'] = $stateCd;
            $PROPOSER_partyDOList['partyAddressDOList'][0]['cityCd'] = $PROPOSER_partyDOList['partyAddressDOList'][1]['cityCd'] = $cityCd;
            $PROPOSER_partyDOList['partyAddressDOList'][0]['pinCode'] =$PROPOSER_partyDOList['partyAddressDOList'][1]['pinCode'] = $pinCode;
            $PROPOSER_partyDOList['partyAddressDOList'][0]['postalZone'] = $PROPOSER_partyDOList['partyAddressDOList'][1]['postalZone'] = $zoneCd;
            $PROPOSER_partyDOList['partyIdentityDOList'][0]['identityTypeCd'] = $docTypeArr[$params->document->documentType];
            $PROPOSER_partyDOList['partyIdentityDOList'][0]['identityNum'] = $params->document->documentId;
            $PROPOSER_partyDOList['partyContactDOList'][0]['contactNum'] = intval($params->selfMobile);
            $PROPOSER_partyDOList['partyEmailDOList'][0]['emailAddress'] = $params->selfEmail;
            $PROPOSER_partyDOList['partyEducationDOList'][0]['educationLevelCd']='HSC'; 
            $PROPOSER_partyDOList['partyRelationDOList'][0]['relatedToPartyId'] = $params->plan.$PROPOSER_refGuid;
            $PROPOSER_partyDOList['partyRelationDOList'][0]['relationCd'] = "SELF";
            $_partyDOList[] = $PROPOSER_partyDOList;
            
            
            
            
            foreach($members as $member){ 
                   $_QuestionSet =[];
                   $chrList = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                   $chrRepeatMin = 1; $chrRepeatMax = 10; $chrRandomLength = 10;
                   $str = substr(str_shuffle(str_repeat($chrList, mt_rand($chrRepeatMin,$chrRepeatMax))), 1, $chrRandomLength);
                   //$InsuredDOList = "";$RoleDOList=""; $partyList = "";
                   $weight  = ($member->type=="self")?$params->selfWeight:$member->weight;
                   $height  = ($member->type=="self")?(($params->selfFeet*12)+($params->selfInch)):(($member->feet*12)+($member->inch));
                   $Fname   = ($member->type=="self")?$params->selfFname:$member->fname;
                   $Lname   = ($member->type=="self")?$params->selfLname:$member->lname;
                   $birthDt = ($member->type=="self")?$params->selfdd."/".$params->selfmm."/".$params->selfyy:$member->dd."/".$member->mm."/".$member->yy;
                   $genderCd= ($member->type=="self")?$params->gender:$member->gender;
                   $roleCd  = "PRIMARY";//($member->type=="self")?"PROPOSER":"PRIMARY";
                   $marital = ($member->type=="self")?strtoupper($params->selfMstatus)
                                                     :((in_array($member->type,["wife","husband","father","mother"]))?"MARRIED":"SINGLE");
                   $titleCd = ($member->type=="self" && $params->gender=="MALE")?"MR"
                                                                                :(($member->type=="self" && $params->gender=="FEMALE")?"MRS"
                                                                                                                                      :((in_array($member->type,["wife","mother","daughter"])?"MRS"
                                                                                                                                                                                             :"MR")));
                     
                    if($member->type=="self"){ $relationCd = "SELF";}
                    else if($member->type=="daughter"){  $relationCd = "UDTR"; }
                    else if($member->type=="son")     {  $relationCd = "SON";}
                    else if($member->type=="wife")    {  $relationCd = "WIFE"; }
                    else if($member->type=="husband") {  $relationCd = "HUSBAND";}
                    else if($member->type=="father")  {  $relationCd = "FATH";}
                    else if($member->type=="mother")  {  $relationCd = "MOTH";} 
                    $refGuid = $_refGuid;//($member->type=="self")?$PROPOSER_refGuid:$_refGuid;
                    $Document['partyId'] = $params->plan.$refGuid;
                    $_Document[] = $Document;
                    
                    // Product Insured DOList 
                    $ProductInsuredDOList =  $this->policyProductInsuredDOList_obj();
                    $ProductInsuredDOList['refGuid']=$params->plan.$refGuid;
                    $ProductInsuredDOList['partyId']=$params->plan.$refGuid;
                    $ProductInsuredDOList['weight']=floatval($weight);
                    $ProductInsuredDOList['height']=round($height*2.54);
                    $ProductInsuredDOList['zoneCd']= $zoneCd;
                    
                    $ProductInsuredDOList['productPlanOptionCd']=$Querydata->code;
                    $ProductInsuredDOList['baseSumAssured']=floatval($sum*100000);
                    $ProductInsuredDOList['sumInsured']=($sum*100000);
                    
                    
                    //Questtion Set
                    $QuestionSet = $this->policyQuestionSetDOList_obj();
                    $lvl802 =  ['Lvl02_O802_01','Lvl02_O802_02','Lvl02_O802_03','Lvl02_O802_04','Lvl02_O802_05','Lvl02_O802_06','Lvl02_O802_07','Lvl02_O802_08','Lvl02_O802_09','Lvl02_O802_10','Lvl02_O802_11','Lvl02_O802_12','Lvl02_O802_13','Lvl02_O802_14'];
                    $arrNotIn =[];$hasMedicle =false;
                    if(isset($member->medical)){
                     $hasMedicle = true;
                        foreach($member->medical as $mediSet){
                                array_push($arrNotIn,$mediSet->queId);
                                $_set =   DB::table('medical_questions')->where(['supplier'=>'MANIPAL_CIGNA','id'=>$mediSet->queId])->first();
                                $Q['policyQuestionSetSeq'] = null;
                                $Q['questionCd'] = $_set->code;
                                $Q['dataElementCd'] =$_set->code;
                                $Q['policyQuestionResponseDOList'] = [['policyQuestionSeq'=>null,'responseValue'=> 'YES','rowGuid'=>$params->plan.$refGuid]];
                                $QuestionSet['questionSetCd'] =$_set->code;
                                $QuestionSet['policySeq'] = null;
                                $QuestionSet['policyProductSeq'] =null; 
                                $QuestionSet['policyProductInsuredseq'] =null;
                                $QuestionSet['partyGuid'] = $params->plan.$refGuid;
                                $QuestionSet['policyQuestionDOList'] =[$Q];
                                $_QuestionSet[]=$QuestionSet;
                                
                                if(in_array($_set->code,$lvl802)){
                                    
                                      if($mediSet->hasChildQuestions==true){
                                        $additionalMedi = ["partyGuid"=>$params->plan.$refGuid,'adMedComments'=>""];
                                        foreach($mediSet->childQuestions as $ch){
                                           $childSet =   DB::table('medical_questions')->where(['supplier'=>'MANIPAL_CIGNA','parentId'=>$ch->parentId,'id'=>$ch->Qid])->first();
                                          // print_r($childSet);
                                           $additionalMedi['questionSetCd'] = $childSet->code;
                                           $ansswer = $ch->answer;
                                          if($childSet->setparam=="illness"){
                                               $ansswer = $_set->title;
                                           }
                                           $additionalMedi[$childSet->setparam] = $ansswer; 
                                           
                                        }
                                       $WSPolicyAdditionalMedicalDtlsDOLst[] = $additionalMedi;
                                      }
                                    
                                }
                        }
                    }
                    
                    $QSet =   DB::table('medical_questions')
                                   ->where(['supplier'=>'MANIPAL_CIGNA','parentId'=>0])
                                   ->when($arrNotIn, function ($query, $arrNotIn) { 
                                               return  $query->whereNotIn('id',$arrNotIn);
                                         })->get();
            
                    foreach($QSet as $_otherSet){
                               $Q['policyQuestionSetSeq'] = null;
                                $Q['questionCd'] = $_otherSet->code;
                                $Q['dataElementCd'] =$_otherSet->code;
                                $Q['policyQuestionResponseDOList'] = [['policyQuestionSeq'=>null,'responseValue'=> 'NO','rowGuid'=>$params->plan.$refGuid]];
                                $QuestionSet['questionSetCd'] =$_otherSet->code;
                                $QuestionSet['policySeq'] = null;
                                $QuestionSet['policyProductSeq'] =null; 
                                $QuestionSet['policyProductInsuredseq'] =null;
                                $QuestionSet['partyGuid'] = $params->plan.$refGuid;
                                $QuestionSet['policyQuestionDOList'] =[$Q];
                                $_QuestionSet[]=$QuestionSet;
                    }
                    
                    $ProductInsuredDOList['policyQuestionSetDOList']=$_QuestionSet;
                    $_ProductInsuredDOList[] = $ProductInsuredDOList;
                    
                   $partyDOList = $this->partyDOList_obj();
                   $partyDOList['partyId']  = $params->plan.$refGuid;
                   $partyDOList['partyGuid']  = $params->plan.$refGuid;
                   $partyDOList['relationCd'] = $relationCd;
                   $partyDOList['firstName1'] = $Fname;
                   $partyDOList['lastName1'] = $Lname;
                   $partyDOList['birthDt'] = $birthDt;
                   $partyDOList['genderCd'] = $genderCd;
                   $partyDOList['maritalStatusCd'] = $marital;
                   $partyDOList['titleCd'] = $titleCd;
                   $partyDOList['roleCd'] = $roleCd;
                   $partyDOList['nomineeTitleCd']   = $nomineeTitle;
                   $partyDOList['nomineeFirstName'] = $nominee_name[0];
                   $partyDOList['nomineeLastName'] = $nominee_name[1];
                   $partyDOList['zoneCd'] = $zoneCd;
                   
                    $partyDOList['partyAddressDOList'][0]['addressLine1Lang1'] = $partyDOList['partyAddressDOList'][1]['addressLine1Lang1'] = $addressLine1;
                    $partyDOList['partyAddressDOList'][0]['addressLine2Lang1'] = $partyDOList['partyAddressDOList'][1]['addressLine2Lang1']= $addressLine2;
                   // $partyDOList['partyAddressDOList'][0]['districtCd'] = $partyDOList['partyAddressDOList'][1]['districtCd'] = $stateCd;//$districtCd;
                    $partyDOList['partyAddressDOList'][0]['stateCd'] = $partyDOList['partyAddressDOList'][1]['stateCd'] = $stateCd;
                    $partyDOList['partyAddressDOList'][0]['cityCd'] = $partyDOList['partyAddressDOList'][1]['cityCd'] = $cityCd;
                    $partyDOList['partyAddressDOList'][0]['pinCode'] =$partyDOList['partyAddressDOList'][1]['pinCode'] = $pinCode;
                    $partyDOList['partyAddressDOList'][0]['postalZone'] = $partyDOList['partyAddressDOList'][1]['postalZone'] = $zoneCd;
                
                    $partyDOList['partyIdentityDOList'][0]['identityTypeCd'] = $docTypeArr[$params->document->documentType];
                    $partyDOList['partyIdentityDOList'][0]['identityNum'] = $params->document->documentId;
                    
                    $partyDOList['partyContactDOList'][0]['contactNum'] = intval($mobile);
                    $partyDOList['partyEmailDOList'][0]['emailAddress'] = $email;
                    $partyDOList['partyEducationDOList'][0]['educationLevelCd']='HSC'; 
                    
                    $partyDOList['partyRelationDOList'][0]['relatedToPartyId'] = $params->plan.$refGuid;
                    $partyDOList['partyRelationDOList'][0]['relationCd'] = $relationCd;
                    $_partyDOList[] = $partyDOList;
                    
                   //Role for insured
                   $partyRoleDOList = $this->policyPartyRoleDOList_obj(); 
                   $partyRoleDOList['refGuid']  =$params->plan.$refGuid;//"00".$str.$refGuid;
                   $partyRoleDOList['partyId']  =$params->plan.$refGuid;//"00".$str.$refGuid;
                   $partyRoleDOList['roleCd']   =$roleCd;
                   $partyRoleDOList['age']  = intval($member->age);
                   $_RoleDOList[]=$partyRoleDOList;
                  
                   
                 $_refGuid++; $i++;  
             }//members foreach;
            //echo  $params->addOn;
            $ProductDOList['productPlanOptionCd'] = $dataParam->code; 
            $ProductDOList['coverTypeCd'] = $pt; 
            $ProductDOList['baseSumAssured']  = floatval($sum*100000);
            $ProductDOList['policyProductInsuredDOList']  = $_ProductInsuredDOList;
            $ProductDOList['productId'] = $dataParam->product;
            $ProductDOList['productTerm'] = $termYear;
            if(isset($params->addOn) && $params->addOn!=""){
                $adddonns = explode(',',$params->addOn);
                $policyProductAddOnsDOList =[];
                foreach($adddonns as $addd){
                   $policyProductAddOnsDOList[]   = ['productSeq'=>null,'productId'=>$addd,'productFamilyCd'=>'','baseSumAssured'=>null,'baseAnnualPremium'=>null,
                                                     'modalPremium'=>null,'productPlanOptionCd'=>'','benefitStructureOptionCd'=>'','extraPremium'=>null,'discount'=>null,
                                                     'productName'=>'','deleteFl'=>'','refGuid'=>''];
                }
                
                $ProductDOList['policyProductAddOnsDOList'] = $policyProductAddOnsDOList;
            }
           // print_r($ProductDOList['policyProductAddOnsDOList']);
            $req['policySeq'] =null;//date('YmdHis');//$dataParam->applicationID;
            $req['policyNum'] =$dataParam->applicationID;
            $req['applicationID'] =$dataParam->applicationID;//$req['proposalNum'] =$dataParam->applicationID;
            $req['applicationRefNum'] ='';//date('dmY').$dataParam->applicationID;
            $req['proposalSignedDt'] =date('d/m/Y');
            $req['proposalRejectDt'] ='';
            $req['proposalReceivedDt'] =date('d/m/Y');
            $req['proposalEntryDt'] =date('d/m/Y');
            //$req['proposalNum']="";
            $req['baseAgentId'] ='1000015-01';//'1600099-01';
            $req['parentAgencyId'] ='';
            $req['servicingBranchId'] ='';
            $req['channelId'] ='325';
            $req['shgName'] ='';
            $req['baseProductId'] =$dataParam->product;
            $req['baseProductVersion'] =1;
            $req['baseProductTypeCd'] ='SUBPLAN';
            $req['baseProductFamilyCd'] ='HEALTHREVISED';
            $req['policyInsuredCatgCd'] ='';
            $req['groupCd'] ='';
            $req['schemeCd'] ='';
            $req['policyIssueDt'] ='';
            $req['policyMaturityDt'] ="";//$period->endDate;//'18/08/2023';
            $req['policyCommencementDt'] =null;//date('d/m/Y');
            $req['riskCommencementDt'] ='';
            $req['policyDispatchDt'] ='';
            $req['firstPremiumReceiptDt'] ='';
            $req['statusCd'] ='';
            $req['totSumAssured'] =null;
            $req['totAnnualPremium'] =null;
            $req['totModalPremium'] =0;//floatval($dataParam->quotation);
            $req['totalRiderPremium'] =null;
            $req['totExtraPremium'] =null;
            $req['totTax'] =null;
            $req['totCharge'] =null;
            $req['totDiscount'] =null;
            $req['signatureCd'] ='';
            $req['signatureInVernacularFl'] ='';
            $req['agentSignatureFl'] ='';
            $req['witnessSignatureFl'] ='';
            $req['statusDt'] ='';
            $req['stageCd'] ='';
            $req['stageLevel'] ='';
            $req['processStatusCd'] ='PENDING';
            $req['applicationMode'] ='';
            $req['quotationRefNum'] ='';
            $req['imageName'] ='';
            $req['accountNum'] ='';
            $req['missingInfoCd'] ='';
            $req['branchCd'] ='033';
            $req['parentBranchCd'] ='';
            $req['uwDecisionCd'] ='';
            $req['dispatchDt'] ='';
            $req['dispatchModeCd'] ='';
            $req['courierName'] ='';
            $req['courierRecvDt'] ='';
            $req['consignmentNum'] ='';
            $req['reason'] ='';
            $req['uwDecisionValue'] ='';
            $req['deferPeriodUnit'] ='';
            $req['remarks'] ='';
            $req['purposeOfInsuranceCd'] ='';
            $req['intimationSourceCd'] ='PORTAL';
            $req['batchDispatchDt'] ='';
            $req['batchReceivedDt'] ='';
            $req['batchCourierRefNum'] ='';
            $req['batchId'] ='';
            $req['counterOfferDecisionCd'] ='';
            $req['counterOfferReasonCd'] ='';
            $req['counterOfferAcceptDt'] ='';
            $req['counterOfferRemarks'] ='';
            $req['iteration'] =null;
            $req['subStageCd'] ='';
            $req['policyStatusCd'] ='';
            $req['leadGenerationCd'] ='';
            $req['statCd'] ='';
            $req['productPlanOptionCd'] =$Querydata->code;//$dataParam->code;//'IN-PRT5.5-HMB500';
            $req['leadGeneratorRemarks'] ='';
            $req['medicalStatusCd'] ='';
            $req['lastModifiedDt'] ='';
            $req['workFlow'] ='';
            $req['productTerm'] =(int)$termYear;
            $req['productTermUnitCd'] ='YEARS';
            $req['monitoringStaffId'] ='';
            $req['subChannelId'] ='';
            $req['monitoringOfficeId'] ='';
            $req['monitoringLocationId'] ='';
            $req['paymentTypeCd'] ='';//CREDITCARD
            $req['paymentFrequencyCd'] ='';
            $req['numberOfAdult'] =($adult>0)?intval($adult):null;;
            $req['numberOfChildren'] =($child>0)?intval($child):null;;
            $req['ageBand1Count'] =null;
            $req['ageBand2Count'] =null;
            $req['ageBand3Count'] =null;
            $req['maxTripPeriod'] =null;
            $req['travelGeographyCd'] ='';
            $req['ageGroupOfEldestMember'] = '';
            $req['sumInsured'] =strval($sum*100000);//'550000';
            $req['coverType'] =$pt;//'INDIVIDUAL';
            $req['quoteAmount'] =floatval($quoteAmt);//'18289.32';
            $req['lastPaymentDt'] ='';
            $req['nextPremiumDueDt'] ='';
            $req['alterationEffectiveDt'] ='';
            $req['oldPremium'] =null;
            $req['serviceTax'] =null;
            $req['eduCess'] =null;
            $req['endorsementEffectiveDt'] ='';
            $req['noOfAdultDependents'] =null;
            $req['noOfChildDependents'] =null;
            $req['noOfSRAdultDependents'] =null;
            $req['noOfLives'] =null;
            $req['masterPolicySeq'] =null;
            $req['quoteId'] =$quoteId;//'SSQ'.date('dmYHis');//'Q119531405';
            $req['inwardTypeCd'] ='NEWBUSINESS';
            $req['inwardSubTypeCd'] ='PROPOSALDOCUMENT';
            $req['receivedFrom'] ='ONLINE';
            $req['zoneCd'] =$zoneCd;
            $req['planId'] ="RPLS06";//$dataParam->product;
            $req['higherEduCess'] =null;
            $req['uwReqFl'] ='NO';
            $req['ppmcFl'] ='NO';
            $req['isManualFl'] ='';
            $req['policyExpiryDt'] =$period->endDate;//'18/08/2023';
            $req['workflowInwardNum'] ='';
            $req['contents'] ='';
            $req['modalPremium'] =null;
            $req['initialPremium'] =null;
            $req['caseType'] ='';
            $req['previousPolicyExpiryDt'] ='';
            $req['renewalNoticeSentFl'] ='';
            $req['renewalDate'] ='';
            $req['renewalYear'] =null;
            $req['cummulativeBonusAmt'] =null;
            $req['prevCummulativeBonus'] =null;
            $req['actualCummulativeBonus'] =null;
            $req['cummulativeBonusPerc'] =null;
            $req['claims'] ='';
            $req['renewalDueStatus'] ='';
            $req['totUWLoadingAmount'] =null;
            $req['renewalFl'] ='';
            $req['portOutFl'] ='';
            $req['retentionFl'] ='';
            $req['premiumToBeCollected'] =null;
            $req['premiumSuspenseAmount'] =null;
            $req['uwLoadingPerc'] =null;
            $req['totUWLoadingInclOfTaxes'] =null;
            $req['totPremiumBeforeTaxes'] =null;
            $req['pointsOnPremiumPaid'] =null;
            $req['totalRewardPoints'] =null;
            $req['pointsFromWellnessPrograms'] =null;
            $req['agencyId'] ='';
            $req['subagencyId'] ='';
            $req['employeeCd'] ='';
            $req['partnerBranchId'] ='';
            $req['refCodeA'] ='';
            $req['refCodeB'] ='';
            $req['refCodeC'] ='';
            $req['gst'] =null;
            $req['gstCess'] =null;
            $req['uwLoadGST'] =null;
            $req['uwLoadGSTCess'] =null;
            $req['utilizeHMBForPremium'] ='';
            $req['hmbUtilizedTowardPremium'] =null;
            $req['splitPolicyDO'] =[['splitCustomerId'=>"",'splitPolicyNum'=>"" ]];
            
            $req['migrationFlag'] ='';
            $req['splitType'] ='';
            $req['splitPolicy'] ='';
            
             
             $req['policyPortabilityDO'] =[$this->policyPortabilityDO_obj()];
             $req['policyProductDOList'] =[$ProductDOList];//[$this->policyProductDOList_obj()];
             $req['policyPaymentDOList'] =[['paymentMethodCd'=>'','paymentInstructionTypeCd'=>'','partyFinAccountSeq'=>null,'partyFinAccRefGuid'=>'','payerPartyId'=>'','payerPartyRefGuid'=>'',]];
             $req['policyAgentDOList'] =[['agentId'=>'1000015-01','primaryAgentFl'=>'','yearFrom'=>null,'yearTo'=>null,'commPercent'=>null,'prodnPercent'=>null,]];
             $req['policyPartyRoleDOList'] =$_RoleDOList;//$this->policyPartyRoleDOList_obj();
             $req['partyDOList'] =$_partyDOList;//[$this->partyDOList_obj()];
             $req['inwardDOList'] =[];
             $req['policyDocumentDOList'] =$_Document;//[$this->policyDocumentDOList_obj(),$this->policyDocumentDOList_obj()];
             $req['policyQuestionSetDOList'] =$this->QpolicyQuestionSetDOList_obj($params->plan);//[$this->policyQuestionSetDOList_obj()];
             $req['policyAdditionalFieldsDOList']  = [$this->policyAdditionalFieldsDOList_obj()];
             $req['policyPortabilityMemberDOList'] = [$this->policyPortabilityMemberDOList_obj()];
             $req['policyPortabilityMemberClaimDOList'] =[   
                                                            [
                                                            'clientId'=> '',
                                                            'previousClaimNum'=>'',
                                                            'visitDt'=>'',
                                                            'hospitalId'=>'',
                                                            'otherHospital'=>'',
                                                            'amountPaid'=>null,
                                                            'paymentDt'=>'',
                                                            'claimOutstandingFl'=>'',
                                                            'coPayments'=>null,
                                                            'claimReason'=>'',
                                                           ]
                                                        ];
             $req['WSPolicyAdditionalMedicalDtlsDOList'] = $this->WSPolicyAdditionalMedicalDtlsDOList($WSPolicyAdditionalMedicalDtlsDOLst);
             $req['WSPolicyPreviousInsuranceDtlsDOList'] =[
                                                             [
                                                                'partyGuid'=>'',
                                                                'policyNum'=>'',
                                                                'fromDt'=>'',
                                                                'toDt'=>'',
                                                                'baseSumAssured'=>null,
                                                                'claimNum'=>'',
                                                                'claimAmount'=>null,
                                                                'ailment'=>'',
                                                               // 'sumassured'=>null,
                                                                'bonusPercentage'=>null,
                                                                'bonusAmount'=>null,
                                                                'insurerName'=>'',
                                                                'typeOfPolicy'=>'',
                                                                'portabilityFl'=>'',
                                                                'prevAddOnRidersTakenFlag'=>'',
                                                                'propCBConvToEnhSIFlag'=>'',
                                                                'portReasonCd'=>'', 
                                                                'prevPolDeclinedFlag'=>'',
                                                            ]
                                                         ];
             $req['policyChangeDOList'] =[['alterationType'=>'','policyChangeDetailTOList'=>[['refGuid'=>null,'customerId'=>null]]]];
             $req['policyMandateDOList'] =[$this->policyMandateDOList_obj()];
              if(isset(Auth::guard('agents')->user()->id)){
                   
                     $req['subIntermediaryName'] =Auth::guard('agents')->user()->name;;
                     $req['subIntermediaryPAN'] =Auth::guard('agents')->user()->pan_card_number;
                }else{
                     $req['subIntermediaryName'] ='';
                     $req['subIntermediaryPAN'] ='';
                }
           
            $req['others'] ='';
            $req['classificationCd'] ='';
            $req['modalLoadingPremium'] =null;
            $listofPolicyTO[]  = $req;
            $REQUEST = ["listofPolicyTO"=>$listofPolicyTO];
           // print_r(json_encode($REQUEST));die;
            try{
                $client = new Client([
                    'headers' => [ 'Action-Type'=>'VALIDATE','Content-Type'=>'application/json',"app_key"=>config('mediclaim.MANIPAL.appKey'),"app_id"=>config('mediclaim.MANIPAL.appIdValidate')]
                ]);
                
                $clientResp = $client->post(config('mediclaim.MANIPAL.validateProposal'),
                    ['body' => json_encode($REQUEST)]
                );
                
              //print_r(json_encode($REQUEST));die;
                $response = $clientResp->getBody()->getContents();   
                $result=json_decode($response);
               // print_r($response);
                //$result=json_decode($response);
                      
                DB::table('app_quote')->where('enquiry_id', $enqID)->update(['reqCreate'=>json_encode($REQUEST),'respCreate'=>$response]);
                if($result->errorList==null || $result->errorList==""){
                    return ['status'=>true,'message'=>"Success",'data'=>[]]; 
                }else{
                   $errorList = $result->errorList;
                   if($errorList[0]->errDescription!=null){
                       return ['status'=>false,'message'=>$errorList[0]->errDescription,'data'=>[]];  
                   }else{
                      return ['status'=>false,'message'=>$errorList[0]->errActualMessage,'data'=>[]];   
                   }
                   
                }
            
        }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                //DB::table('app_quote')->where('enquiry_id', $enqId)->update(['reqCreate'=>json_encode($REQUEST),'respCreate'=>$response]);
                $resp = json_decode($responseBodyAsString);
               //print_r($resp);
                return ['status'=>false,'message'=>"ConnectException",'data'=>[]];  
               // return ['status'=>false,'plans'=>[],"message"=>"Sorry we are unable to process your request."];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $resp = json_decode($responseBodyAsString);
                //print_r($responseBodyAsString);die;
                return ['status'=>false,'message'=>"Request Exception",'data'=>[]];  
               
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $resp = json_decode($responseBodyAsString);
                //print_r($resp);
                return ['status'=>false,'message'=>"ClientException error",'data'=>[]];  
                // return ['status'=>false,'plans'=>[],"message"=>"Internal server error"];
            }
            
           
    }
    
     function WSPolicyAdditionalMedicalDtlsDOList($res){
           $elem = [];
            if(count($res)>0){ 
                foreach($res as $ech){
                    
                   $elem[]= $_this =   [
                                    'partyGuid'=>$ech['partyGuid'],
                                    'illness'=>isset($ech['illness'])?$ech['illness']:'No illness',
                                    'exactDiagnosis'=>$ech['exactDiagnosis'],
                                    'diagnosisDt'=>'',
                                    'treatment'=>'',
                                    'curedFl'=>'',
                                    'natureOfHazardousOccupation'=> '',
                                    'natureOfHazardousOccupation1'=>'',
                                    'natureOfHazardousOccupation2'=>'',
                                    'detailsOfPastClaimAmount'=>'',
                                    'diseaseForClaimMade'=>'',
                                    'customerId'=>null,
                                    'sufferingFlag'=>'',
                                    'complicationReccurenceFlag'=>'',
                                    'histopathbiopsyFlag'=>'',
                                    'lastConsultDt'=>$ech['lastConsultDt'],
                                    'treatmentCd'=>$ech['treatmentCd'],
                                    'currentStatusVal'=>$ech['currentStatusVal'],
                                    'questionSetCd'=>$ech['questionSetCd'],
                                    'Comments'=>'',
                                    'yrOfDiagnosis'=>$ech['yrOfDiagnosis'],
                                ];
               }
               
            }else{
                $elem[] =   [
                            'partyGuid'=>'',
                            'illness'=>'',
                            'exactDiagnosis'=>'',
                            'diagnosisDt'=>'',
                            'treatment'=>'',
                            'curedFl'=>'',
                            'natureOfHazardousOccupation'=> '',
                            'natureOfHazardousOccupation1'=>'',
                            'natureOfHazardousOccupation2'=>'',
                            'detailsOfPastClaimAmount'=>'',
                            'diseaseForClaimMade'=>'',
                            'customerId'=>null,
                            'sufferingFlag'=>'',
                            'complicationReccurenceFlag'=>'',
                            'histopathbiopsyFlag'=>'',
                            'lastConsultDt'=>'',
                            'treatmentCd'=>'',
                            'currentStatusVal'=>'',
                            'questionSetCd'=>'',
                            'Comments'=>'',
                            'yrOfDiagnosis'=>null,
                           ];
            }
            return $elem; 
    }
    
    function policyMandateDOList_obj(){
        $elem['policyNum'] = '';//'PROTOP0500004';
        $elem['statusCd'] ='';
        $elem['recurringPaymentMethod'] = '';
        $elem['nachRegistration'] ='';
        $elem['nachStatus'] = '';
        $elem['rejectionReason'] ='';
        $elem['maxAmt'] =null;
        $elem['frequency'] ='';
        $elem['debitType'] ='';
        $elem['uniqueId'] = '';//'100909622';
        $elem['cardTokenId'] = '';//'187e7c0a4a0de95de1cb';
        $elem['userCredential'] = '';//'jB4VxW:91644783';
        $elem['expiryDt'] ='';
        $elem['paymentFrequencyCd'] ='';
        $elem['decisionCd'] ='';
        $elem['entrySourceCd'] ='';
        $elem['processStatusCd'] ='';
        $elem['mandateVersion'] ='';
        $elem['mandateCreatedDt'] ='';
        $elem['inwardTypeCd'] ='';
        $elem['changeTypeCd'] ='';
        $elem['renewalYear'] =0;
        $elem['accountNum'] ='';
        $elem['registrationStatusCd'] ='';
        $elem['batchStatusCd'] ='';
        $elem['batchUpdatedDt'] ='';
        $elem['fileName'] ='';
        $elem['umrNumber'] ='';
        $elem['registrationDate'] ='';
        $elem['initialRejectReason'] ='';
        $elem['processedOnWithURMN'] ='';
        $elem['stageCd'] ='';
        $elem['payerPartyId'] ='';
        $elem['merchantId'] ='';//'PA';
        $elem['policyMandateDetailsDOList'] =[['accountTypeCd'=>null,'accountHolderName'=>null,'accountNum'=>null,'ifscCd'=>null,
                                               'micrNum'=>null,'bankName'=>null,'bankBranch'=>null,'city'=>null,'statusCd'=>null,
                                               'branchCd'=>null,'relationCd'=>null]];
        return $elem; 
    }
    
    function policyPortabilityMemberDOList_obj(){
        $elem['clientId'] ='';
        $elem['memberAttachmentDt'] ='';
        $elem['expPolicyCumulativeBonus']=null;
        $elem['expPolicySA']=null;
        $elem['total']=null;
        $elem['memberPresentOnPolicy']='';
        $elem['policyPortabilityDO']=$this->policyPortabilityDO_obj();
        $elem['policyPortabilityMemberClaimDOList']=[[
                                                        'clientId'=> '',
                                                        'previousClaimNum'=>'',
                                                        'visitDt'=>'',
                                                        'hospitalId'=>'',
                                                        'otherHospital'=>'',
                                                        'amountPaid'=>null,
                                                        'paymentDt'=>'',
                                                        'claimOutstandingFl'=>'',
                                                        'coPayments'=>null,
                                                        'claimReason'=>'',
                                                   ]];
          return $elem; 
    }
    
    function policyAdditionalFieldsDOList_obj(){
        //$elem['appointeeage'] = null;
        $elem['AllInsIndNatResFlag'] = 'YES';
        $elem['IsNomSameAsCgFlag'] = 'NO';
        $elem['SubsAlertOnWA'] = 'NO';
        $elem['HniFlag'] = 'NO';
        $elem['BankForElectronicTrfrFlag'] ='NO';
        $elem['BankCancCheqForRefundFlag'] ='NO';
        $elem['BankAcctNonExistFlag'] ='NO';
        $elem['AstpFlag'] ='NO';
        $elem['availPolicy'] =''; 
        $elem['applPayRecd'] =''; 
        $elem['businessTypeCd'] = '2';
        $elem['nomineeTitleCd'] = 'MRS';
        $elem['nomineeFirstName1'] ='ANJALEE';
        $elem['nomineeLastName'] = '';
        $elem['nomineeRelationCd'] = 'WI';
        $elem['nomineeBirthDt'] = '';
        $elem['businessSourceCd'] = 'GOHEALTH';
        $elem['receiverId'] ='';
        $elem['receiverName'] =''; 
        $elem['verifierId'] ='';
        $elem['verifierName'] =''; 
        $elem['qcId'] ='';
        $elem['qcName'] ='';
        $elem['callCentreId'] ='';
        $elem['challanNum'] ='';
        $elem['challanDt'] ='';
        $elem['challanAmount'] =null;
        $elem['campaignCd'] ='';
        $elem['transactionTypeCd'] ='';
        $elem['ifscCd'] ='';
        $elem['micrNum'] ='';
        $elem['bankName'] ='';
        $elem['branchName'] ='';
        $elem['cityCd'] = 'Mumbai';
        $elem['accountNum'] ='';
        $elem['availSoftCopy'] ='';
        $elem['emiOptionCd'] ='';
        $elem['cardNum'] ='';
        $elem['cardExpiryDt'] ='';
        $elem['cardTypeCd'] ='';
        $elem['accountName'] =null;
        $elem['grnNum'] =''; 
        $elem['grnDt'] ='';
        $elem['grnAmount'] =null;
        $elem['autoRenewalOptionFl'] ='';
        $elem['emiFrequencyCd'] ='';
        $elem['addInfoStatusCd'] ='';
        $elem['addInfoDecisionCd'] ='';
        $elem['ppmcStatusCd'] ='';
        $elem['ppmcDecisionCd'] =''; 
        $elem['receiptId'] ='';
        $elem['fileCreation'] =''; 
        $elem['markForCancellation'] ='';
        $elem['uploadStatus'] ='';
        $elem['previousPolicyNum'] ='';
        $elem['previousPolicyExpiryDt'] ='';
        $elem['splitPolicyNum1'] =''; 
        $elem['splitPolicyNum2'] =''; 
        $elem['changeInPolHolReason'] =''; 
        $elem['changeInPolHolOther'] =''; 
        $elem['delInsuredReason'] ='';
        $elem['delInsuredOther'] ='';
        $elem['appointeeName'] ='';
        $elem['appointeeRelation'] ='';
        $elem['eiaPolicyDoc'] ='';
        $elem['eiaNumExists'] ='NO';
        $elem['eiaNum'] ='';
        $elem['eiaPreferRepo'] ='';
        $elem['gstAvail'] ='';
        $elem['sezUnit'] ='';
        $elem['nomineeAge'] =40;
        $elem['isEmployerPayorFl'] ='';
        $elem['employeeId'] =null;
        $elem['initialPaymentUnit'] =null;
        return $elem;
    }
    
    function policyPartyRoleDOList_obj(){
        $arr=[
            'roleCd'=> 'PROPOSER',
            'partyId'=> '',
            'age'=>null,
            'percentage'=>null,
            'nomineeTypeCd'=>'',
            'nomineeCatgCd'=>'',
            'irrevocableFl'=>'',
            'assignmentTypeCd'=>'',
            'effectiveFromDt'=>'',
            'effectiveToDt'=>'',
            'remark'=>'',
            'refGuid'=> '',
            'customerId'=>'',
        ];
        return $arr;
        //return [$arr,$arr];
    }
    
    function policyPortabilityDO_obj(){
        $elem['expPolicyEndDt'] ='';
        $elem['expDtForExtendedPolicy'] ='';
        $elem['expPolicyNum'] ='';
        $elem['expPolicyTerm'] =null;
        $elem['periodLapsed'] =null;
        $elem['expPolicyStartDt'] ='';
        $elem['expPolicyTypeCd'] ='';
        $elem['expProductId'] ='';
        $elem['expPolicyPlanName'] ='';
        $elem['expPolicyBusinessTypeCd'] ='';
        $elem['registrationOfTPA'] ='';
        $elem['expPolicyInsurerName'] ='';
        $elem['discountInPremium'] =null;
        $elem['loadingInPremium'] =null;
        $elem['firstExpPolicyNum'] ='';
        $elem['firstExpPolicyStartDt'] ='';
        $elem['sameAsExpPolicyFl'] ='';
        $elem['sentDt'] ='';
        $elem['receivedDt'] ='';
        $elem['isClaimedFl'] ='';
        $elem['portabilityFromOtherInsurer']= '';
         return  $elem;
    }
    
    function policyQuestionSetDOList_obj(){
        
                    $Q['policyQuestionSetSeq'] = null;
                    $Q['questionCd'] = 'Lvl02_Q801';
                    $Q['dataElementCd'] ='Lvl02_Q801';
                    $Q['policyQuestionResponseDOList'] = [['policyQuestionSeq'=>null,'responseValue'=> 'NO','rowGuid'=> '']];
                  
            $elem['questionSetCd'] = 'Lvl02_Q801';
            $elem['policySeq'] = null;
            $elem['policyProductSeq'] =null; 
            $elem['policyProductInsuredseq'] =null;
            $elem['partyGuid'] = '0062X0000106xGdQAI';
            $elem['policyQuestionDOList'] =[$Q];

         return $elem; 
    }
    
    function QpolicyQuestionSetDOList_obj($plan){
        
        //             $Q['policyQuestionSetSeq'] = null;
        //             $Q['questionCd'] = 'Consent4';
        //             $Q['dataElementCd'] ='Consent4';
        //             $Q['policyQuestionResponseDOList'] = [['policyQuestionSeq'=>null,'responseValue'=> 'NO','rowGuid'=> '']];
                  
        //     $elem['questionSetCd'] = 'Consent4';
        //     $elem['policySeq'] = null;
        //     $elem['policyProductSeq'] =null; 
        //     $elem['policyProductInsuredseq'] =null;
        //     $elem['partyGuid'] = '0062X0000106xGdQAI';
        //     $elem['policyQuestionDOList'] =[$Q];

        //  return $elem; 
         $aRR = ['Consent4','Consent3','Consent2','Consent1'];
         
         $ELM = [];
         foreach($aRR as $R){
            $Q['policyQuestionSetSeq'] = null;
                    $Q['questionCd'] = $R;
                    $Q['dataElementCd'] =$R;
                    $Q['policyQuestionResponseDOList'] = [['policyQuestionSeq'=>null,'responseValue'=> 'YES','rowGuid'=> '']];
                  
            $elem['questionSetCd'] = $R;
            $elem['policySeq'] = null;
            $elem['policyProductSeq'] =null; 
            $elem['policyProductInsuredseq'] =null;
            $elem['partyGuid'] = $plan.'1';
            $elem['policyQuestionDOList'] =[$Q];
            
            $ELM[] = $elem;
         }
         
         return $ELM;
         
    }
    
    function policyProductInsuredDOList_obj(){
            //ProductDOList obj
            $elem['policyProductSeq'] =null;
            $elem['partyId'] = "0062X0000106xGdQ";
            $elem['issueAge'] =null;
            $elem['uwClassCd'] ='';
            $elem['insuredSequenceTypeCd'] ='';
            $elem['refGuid'] = '0062X0000106xGdQ';
            $elem['decisionCd'] ='';
            $elem['decisionValue'] ='';
            $elem['unit'] ='';
            $elem['reason'] ='';
            $elem['customerId'] ='';
            $elem['score'] =null;
            $elem['weight'] ='';
            $elem['scoreWeight'] =null;
            $elem['prevInsurerClientId'] ='';
            $elem['nonStandardAgeProof'] ='';
            $elem['zoneCd'] = 'ZONE3';
            $elem['level'] ='';
            $elem['loadingPerc'] =null;
            $elem['grpEmp'] ='';
            $elem['maritalStatusCd'] ='';
            $elem['occupationCd'] ='01';
            $elem['annualGrossIncome'] =null;//"10-15L";
            $elem['height'] = '162';
            $elem['bmi'] =null;
            $elem['cityCd'] ='';
            $elem['annualIncome'] =null;
            $elem['uwReqFl'] = 'NO';
            $elem['ppmcFl'] = 'NO';
            $elem['productPlanOptionCd'] = '';
            $elem['baseSumAssured'] = '5500';
            $elem['natureOfJob'] ='';
            $elem['smokerStatusCd'] ='';
            $elem['chewTobaccoCd'] = '';//'NO';
            $elem['consumeAlcoholCd'] ='';
            $elem['insuredCategoryCd'] ='';
            $elem['riskClass'] ='';
            $elem['ppmcTestSet'] ='';
            $elem['modalPremium'] =null;
            $elem['extraPremium'] =null;
            $elem['discount'] =null;
            $elem['sumInsured'] ='5500';
            $elem['cummulativeBonusAmt'] =null;
            $elem['cummulativeBonusPerc'] =null;
            $elem['prevCummulativeBonus'] =null;
            $elem['actualCummulativeBonus'] =null;
            $elem['uwLoadingPerc'] =null;
            $elem['uwLoadingAmount'] =null;
            $elem['pointsFromWellnessPrograms'] =null;
            $elem['isInsuredAddressDifferent'] ='';
            $elem['splitFlag'] ='';
            $elem['remarks'] ='';
            $elem['policyQuestionSetDOList']=[$this->policyQuestionSetDOList_obj()];
            $elem['policyPortabilityMemberDOList']=[
                                                        [
                                                         'clientId'=>'',
                                                         'memberAttachmentDt'=>'',
                                                         'expPolicyCumulativeBonus'=>null,
                                                         'expPolicySA'=> null,
                                                         'total'=>null,
                                                         'memberPresentOnPolicy'=>'',
                                                         'policyPortabilityDO'=>[   
                                                                                   'expPolicyEndDt'=>'',
                                                                                    'expDtForExtendedPolicy'=>'',
                                                                                    'expPolicyNum'=>'',
                                                                                    'expPolicyTerm'=>null,
                                                                                    'periodLapsed'=>null,
                                                                                    'expPolicyStartDt'=>'',
                                                                                    'expPolicyTypeCd'=>'',
                                                                                    'expProductId'=>'',
                                                                                    'expPolicyPlanName'=>'',
                                                                                    'expPolicyBusinessTypeCd'=>'',
                                                                                    'registrationOfTPA'=>'',
                                                                                    'expPolicyInsurerName'=>'',
                                                                                    'discountInPremium'=>null,
                                                                                    'loadingInPremium'=>null,
                                                                                    'firstExpPolicyNum'=>'',
                                                                                    'firstExpPolicyStartDt'=>'',
                                                                                    'sameAsExpPolicyFl'=>'',
                                                                                    'sentDt'=>'',
                                                                                    'receivedDt'=>'',
                                                                                    'isClaimedFl'=>'',
                                                                                    'portabilityFromOtherInsurer'=>''
                                                                                 ],
                                                         'policyPortabilityMemberClaimDOList'=>[
                                                                                                    [
                                                                                                        'clientId'=>'',
                                                                                                        'previousClaimNum'=>'',
                                                                                                        'visitDt'=>'',
                                                                                                        'hospitalId'=>'',
                                                                                                        'otherHospital'=>'',
                                                                                                        'amountPaid'=>null,
                                                                                                        'paymentDt'=>'',
                                                                                                        'claimOutstandingFl'=>'', 
                                                                                                        'coPayments'=> null,
                                                                                                        'claimReason'=>''
                                                                                                     ]
                                                                                                 ]
                                                        ],
                                                   ];
            $elem['policyProductInsuredBenefitTO']=[['benefitTypeCd'=>'','benefitId'=>'','amount'=>null,'productId'=>'']];
            $elem['policyProductInsuredPortabilityTO']=[['partyGuid'=>'', 'refGuid'=>'','portedSI'=>null,'siWaived1Yr'=>null,'siWaived2Yr'=>null,'siWaived3Yr'=>null,'siWaived4Yr'=>null,'appliedBy'=>'']];
            return $elem; 
    }
    
    function policyProductDOList_obj(){
        $elem['productSeq'] =null;
        $elem['productId'] ='RPRT03SB02';
        $elem['productVersion'] =null;
        $elem['productTypeCd'] ='SUBPLAN';
        $elem['productFamilyCd'] ='HEALTHREVISED';
        $elem['productSetSeq'] =null;
        $elem['baseSumAssured'] ='550000';
        $elem['baseAnnualPremium'] =null;
        $elem['modalPremium'] =null;
        $elem['extraPremium'] =null;
        $elem['discount'] =null;
        $elem['paidUpValue'] =null;
        $elem['productTerm'] =1;
        $elem['productTermUnitCd'] ='YEARS';
        $elem['premiumPayingTerm'] =null;
        $elem['premiumPayingTermUnitCd'] ='';
        $elem['combinedEntryAge'] =null;
        $elem['riskCommencementDt'] ='';
        $elem['productCommencementDt'] ='';
        $elem['nonForfeitureOptionCd'] ='';
        $elem['loanLendersName'] ='';
        $elem['loanAccNo'] ='';
        $elem['loanAmount'] =null;
        $elem['loanTerm'] =null;
        $elem['loanTermUnitCd'] ='';
        $elem['loanEffectiveDt'] ='';
        $elem['interestRate'] =null;
        $elem['interestRestFrequencyCd'] ='';
        $elem['interestRateTypeCd'] ='';
        $elem['interestCapitalsnFreqCd'] ='';
        $elem['defermentPeriod'] =null;
        $elem['defermentPeriodUnitCd'] ='';
        $elem['repaymentPeriod'] =null;
        $elem['repaymentPeriodUnitCd'] ='';
        $elem['servicingInterestPeriod'] =null;
        $elem['servicingInterestPeriodUnitCd'] ='';
        $elem['premiumFinancingOptionCd'] ='';
        $elem['splitPercentage'] =null;
        $elem['serviceTax'] =null;
        $elem['computedmodalPremium'] =null;
        $elem['coverContinuanceOptionCd'] ='';
        $elem['portfolioModelCd'] ='';
        $elem['multiplier'] =null;
        $elem['vestingAge'] =null;
        $elem['benefitStructureOptionCd'] ='';
        $elem['singleLifeAllowed'] ='';
        $elem['riderType'] ='';
        $elem['saIndexationCd'] ='';
        $elem['premiumIndexationCd'] ='';
        $elem['fixedPrmIndexationVal'] =null;
        $elem['fixedSAIndexationVal'] =null;
        $elem['paymentTypeCd'] ='';
        $elem['paymentFrequencyCd'] ='SINGLE';
        $elem['payoutFrequencyCd'] ='';
        $elem['productPlanOptionCd'] ='IN-PLS5.5-HMB2K';
        $elem['systTransferOptionCd'] ='';
        $elem['coverTypeCd'] ='INDIVIDUAL';
        $elem['tripTypeCd'] ='';
        $elem['maxTripPeriod'] =null;
        $elem['travelGeographyCd'] ='';
        $elem['visitPurposeCd'] ='';
        $elem['voluntaryDedAmt'] =null;
        $elem['zoneCd'] ='ZONE3';
        $elem['productName'] ='';
        $elem['payoutOption'] ='';
        $elem['reducingBalanceSI'] ='';
        $elem['recurringPremPayMethod'] ='';
        $elem['deleteFl'] ='';
        $elem['refGuid'] ='';
        $elem['policyProductInsuredDOList']='';//[$this->policyProductInsuredDOList_obj()];// remain array; 
        $elem['policyProductAddOnsDOList']= [['productSeq'=>null,'productId'=>'','productFamilyCd'=>'','baseSumAssured'=>null,'baseAnnualPremium'=>null,
                                            'modalPremium'=>null,'productPlanOptionCd'=>'','benefitStructureOptionCd'=>'','extraPremium'=>null,'discount'=>null,
                                            'productName'=>'','deleteFl'=>'','refGuid'=>'']];
        $elem['policyProductChargeDOList']=[['policyProductSeq'=>null,'chargeClassCd'=>'','chargeEventCd'=>'','chargeWithPremiumFl'=>'','chargeBasisCd'=>'',
                                            'recoverMechanismCd'=>'','chargeAmount'=>null,'chargePercentage'=>null,
                                            'actualAmount'=>null,'relationCd'=>'','minimumAmount'=>null,'maximumAmount'=>null]];
        $elem['policyProductDiscountDOList'] =[['policyProductSeq'=>null, 'discountId'=>'', 'discountAmount'=>null, 'parameterTypeCd'=>'',
                                               'discountBasisTypeCd'=>'','productId'=>'','description'=>'', 'deleteFl'=>'', 'refGuid'=>'']];
        
        return $elem;
    }
    
    function policyDocumentDOList_obj(){
        $elem['docCategoryCd'] = '';
        $elem['documentCd'] = '';
        $elem['partyId'] = ""; 
        $elem['policyProductSeq'] =null;
        $elem['isSubStandardFl'] = '';
        $elem['receivedStatusCd'] = '';
        $elem['remarks'] = '';
        $elem['receivedDt'] = '';
        $elem['requestor'] ='';
        $elem['imageURL'] = '';
        $elem['docRequestedDt'] ='';
        $elem['questionSetCd'] = '';
        $elem['receivedUser'] = '';
        $elem['partyRefGuid'] = '';
        $elem['docCategoryTypeCd'] ='';
        $elem['customerId'] = '';
        $elem['score'] =null;
        $elem['weight'] =null;
        $elem['scoreWeight'] =null;
        $elem['currentStatus'] ='';
        $elem['uploadDt'] = '';
        $elem['auditTrail'] = '';
        $elem['medicalTestDt'] ='';
        $elem['reportUploadDt'] = '';
        return $elem;
    }
    
    function partyDOList_obj(){
        $elem['partyId'] =null;
        $elem['partyTypeCd'] ="";
        $elem['customerId'] ="";
        $elem['firstName1'] ="";
        $elem['firstName2'] ="";
        $elem['middleName1'] ="";
        $elem['middleName2'] ="";
        $elem['lastName1'] ="";
        $elem['lastName2'] ="";
        $elem['roleCd'] ='PROPOSER';
        $elem['corporateName1'] ="";
        $elem['corporateName2'] ="";
        $elem['fatherFirstName1'] ="";
        $elem['fatherFirstName2'] ="";
        $elem['fatherMiddleName1'] ="";
        $elem['fatherMiddleName2'] ="";
        $elem['fatherLastName1'] ="";
        $elem['fatherLastName2'] ="";
        $elem['birthDt'] ='';
        $elem['placeOfBirth'] ="";
        $elem['genderCd'] =null;
        $elem['maritalStatusCd'] =null;
        $elem['contactPerson'] ="";
        $elem['contactDesignation'] ="";
        $elem['identityTypeCd'] =null;
        $elem['identityNum'] =null;
        $elem['citizenshipCd'] ='IND';
        $elem['otherCitizenship'] =null;
        $elem['nonResidentFl'] ='';
        $elem['age'] =null;
        $elem['titleCd'] ='MR';
        $elem['preferredComnLangCd'] ='';
        $elem['pepCd'] =null;
        $elem['politicalDet'] ='';
        $elem['annualIncome'] =null;
        $elem['duplicateCheckDoneFl'] =null;
        $elem['convictionDetailsFl'] =null;
        $elem['criminalDetails'] =null;
        $elem['maidenName'] =null;
        $elem['totalSAR'] =null;
        $elem['intimationSourceCd'] =null;
        $elem['baseProductFamilyCd'] =null;
        $elem['policyExist'] ='';
        $elem['partyModified'] =null;
        $elem['accountName'] ='';
        $elem['acceptOrDeclined'] =null;
        $elem['marriageDt'] =null;
        $elem['noOfChildren'] =null;
        $elem['noOfYearOfStay'] =null;
        $elem['nomineeTitleCd'] =null;
        $elem['nomineeFirstName'] =null;
        $elem['nomineeLastName'] =null;
        $elem['nomineePANNum'] ="";
        $elem['spouseTitleCd'] ="";
        $elem['spouseFirstName'] ="";
        $elem['spouseLastName'] ="";
        $elem['spouseRelationCd'] ="";
        $elem['spouseQualificationCd'] ="";
        $elem['spouseOccupationCd'] ="";
        $elem['workLocation'] ="";
        $elem['langKnown'] ="";
        $elem['prefAddress'] ="";
        $elem['prevInsurerClientId'] ="";
        $elem['isGroupEmployeeFl'] ="";
        $elem['nonStandardAgeProof'] ="";
        $elem['pinCode'] ="";
        $elem['pepFlag'] ='NO';
        $elem['zoneCd'] =null;
        $elem['level'] ="";
        $elem['loadingPerc'] =null;
        $elem['grpEmp'] ="";
        $elem['partyGuid'] ='';
        $elem['partyIdentityDOList']= [['primaryFl'=>null,'identityTypeCd'=>"",'identityNum'=>"",'issuingAuthority'=>null,'issueDt'=>null,'expiryDt'=>null]]; 
        $elem['partyEducationDOList'] = [['educationLevelCd'=>"",'qualificationCd'=>null ]];   
       
        //address COMMUNICATION;
        $addressc['addressTypeCd'] ='COMMUNICATION'; 
        $addressc['addressLine1Lang1'] ="";
        $addressc['addressLine1Lang2'] ="";
        $addressc['addressLine2Lang1'] ="";
        $addressc['addressLine2Lang2'] ="";
        $addressc['addressLine3Lang1'] ="";
        $addressc['addressLine3Lang2'] ="";
        $addressc['addressLine4'] ="";
        $addressc['villageCd'] = "";
        $addressc['countryCd'] = "IND";
        $addressc['talukaCd'] ="";
        $addressc['districtCd'] = "";
        $addressc['stateCd'] = "Maharashtra";
        $addressc['cityCd'] = "Mumbai";
        $addressc['pinCode'] ="400068";
        $addressc['areaCd'] ="";
        $addressc['postalZone'] ="ZONE3";
        
        //address PERMANENT;
        $addressp['addressTypeCd'] ='PERMANENT'; 
        $addressp['addressLine1Lang1'] = "";
        $addressp['addressLine1Lang2'] = "";
        $addressp['addressLine2Lang1'] ="";
        $addressp['addressLine2Lang2'] = "";
        $addressp['addressLine3Lang1'] = "";
        $addressp['addressLine3Lang2'] = "";
        $addressp['addressLine4'] = "";
        $addressp['villageCd'] = "";
        $addressp['countryCd'] = "IND";
        $addressp['talukaCd'] ="";
        $addressp['districtCd'] ="";
        $addressp['stateCd'] = "Maharashtra";
        $addressp['cityCd'] ="Mumbai";
        $addressp['pinCode'] = "400068";
        $addressp['areaCd'] = "";
        $addressp['postalZone'] = "ZONE3";
                    
        $elem['partyAddressDOList'] =[$addressc,$addressp];
        $elem['partyContactDOList'] =[['partyAddressSeq'=>null,'priority'=>null,'contactTypeCd'=>"MOBILE",'contactNum'=> null,'extensionNum'=>null,'stdCode'=>"+91"]];
        $elem['partyEmailDOList'] = [['preferredFl'=>null,'emailTypeCd'=>"PERSONAL",'emailAddress'=>null]];
        $elem['partyEmploymentDOList']=[['currentEmployerFl'=>"",'employmentStatusCd'=>"",'employerName'=>"", 'yearsWithJob'=>null, 'annualIncome'=>1000000,
                                         'annualGrossIncome'=>"10-15L", 'industryCd'=>"",'occupationCd'=>"01",'effectiveFromDt'=>"",'effectiveToDt'=> "",
                                         'natureOfDuty'=>"",'otherDetails'=>"",'employerAddress'=>"", 'monthsWithJob'=>null, 'jobDescription'=>""]];
        $elem['partyOccupationDOList'] = [['occupationCd'=>"01",'otherOccupation'=>null,'natureOfDuty'=>"",'occupationClass'=>"",'natureOfJobOthers'=>"" ]];
        $elem['partyRelationDOList'] = [['relationCd'=> "SELF",'relationTypeCd'=>null,'relatedToPartyId'=>null]];
        $elem['partyFinancialAccountDOList'] = [['accountCategoryCd'=>"",'accountTypeCd'=>"",'bankCd'=>"",
                                                 'sortCd'=>"",'branchCd'=>"", 'bankName'=>"",'branchName'=>"",
                                                 'accountNum'=>"",'ledgerFolioNum'=>"", 'accountHolderName'=>"", 
                                                 'cardTypeCd'=>"",'cardExpiryDt'=>"", 'ifscCd'=>"",'state'=>"",
                                                 'city'=>"",'micrNum'=>""]];
        return  $elem;
    }
    
    function inwardDoList_obj($period,$praposalNum,$txnid,$amount){
               $elem["receiptId"]= "";
               $elem["payerTypeCd"]= "CLIENT";
               $elem["inwardDt"]= $period->startDate;//"08/09/2020";
               $elem["insurerBankCd"]= "DAUTSCHEBANK";
               $elem["agentId"]= "1000015-01";
               $elem["payerPartyId"]= "0062X0000106xGdQAI";
               $elem["receiptBranchId"]= "110060418433";
               $elem["parentBranchId"]= "";
               $elem["depositDt"]= $period->startDate;//"08/09/2020";
               $elem["remarks"]= "";
               $elem["inwardStatusCd"]= "";
               $elem["inwardStatusDt"]= "";
               $elem["inwardStatusReasonCd"]= "";
               $elem["receiptReferenceNum"]= "";
               $elem["entrySourceCd"]= "";
               $elem["inwardDecisionCd"]= "";
               $elem["intimationSourceCd"]= "";
               $elem["correctionReceipt"]= "";
               $elem["cancelledReceiptReferenceNum"]= "";
               $elem["isChqRepresentation"]= "";
               $elem["processStatusCd"]= "";
               $elem["inwardStageCd"]= "";
               $elem["autoManualFlag"]= "";
               $elem["workflowInwardNum"]= "";
               $elem["inwardTypeCd"]= "NEWBUSINESS";
               $elem["inwardSubTypeCd"]= "PROPOSALDOCUMENT";
               $elem["cancellationTypeCd"]= "";
               $elem["srNum"]= null;
               $elem["refundType"]= "";
               $elem["transactionReferenceNum"]= null;
               $elem["source"]= "";
               $elem['inwardDetailsDOList']=[
                                             ["tempInwDetlSSeq"=> null,"paymentMethodCd"=> "CREDITCARD","paymentSubTypeCd"=> "",
                                               "inwardNum"=> $txnid,"instrumentDt"=> $period->startDate,//"08/09/2020",
                                               "inwardAmount"=> $amount,
                                               "bankCd"=> "CC","bankBranch"=> "","midCd"=> "141806","tidCd"=> "","authCode"=> "",
                                               "paymentFrequencyCd"=> "SINGLE","cardTypeCd"=> "","instrumentExpiryDt"=> "",
                                               "accountName"=> "","depositStatusCd"=> "","micrNum"=> "","bankName"=> "","issuingBank"=> "",
                                               "instrumentStatusCd"=> "","instrumentStatusDt"=> "","instrumentStatusReasonCd"=> "",
                                               "clearing"=> "","ifscCd"=> "","instrumentPickUpDt"=> "","transactionMode"=> "","accountNum"=> "",
                                               "transactionId"=> "","bankTransactionId"=> "","merchantId"=> "","payeeTypeCd"=> "",
                                               "inwardDenoDOList"=>[["denominationCd"=>"","denoCount"=>null,"denoAmt"=>null]],
                                               
                                               ]];
                                               
               $elem['inwardPolicyDOList']=[["policyNum"=> $praposalNum,//"73310940870",
                                             "acctTypeCd"=> "PROPOSAL",
                                             "appAmount"=> $amount,
                                             "productFamilyCd"=>"HEALTHREVISED",
                                             "acctSubTypeCd"=> "",
                                             "srNum"=>null,
                                             "payeeTypeCd"=>"",
                                             "refundType"=> "",
                                             "refundAmount"=> null]];
                     
                     return $elem;
    }
    
     function saveProposal($enqID,$quoteId,$proposalNum,$txnid,$amount){ 
            $Querydata = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqID)->first();
           $termYear = $Querydata->termYear;
           $period = timePeriod('d/m/Y',$termYear);
           $object = json_decode($Querydata->reqCreate);
           $REQUEST = json_decode(json_encode($object), true);
           $REQUEST['listofPolicyTO'][0]['inwardDOList'] =[$this->inwardDoList_obj($period,$proposalNum,$txnid,$amount)];
           
            try{
                $client = new Client([
                'headers' => ['Content-Type'=>'application/json',"app_key"=>config('mediclaim.MANIPAL.appKey'),"app_id"=>config('mediclaim.MANIPAL.appIdSave')]
            ]);
            
            $clientResp = $client->post(config('mediclaim.MANIPAL.saveProposal'),
                ['body' => json_encode($REQUEST)]
            );
                
              
                $response = $clientResp->getBody()->getContents();   
                $result=json_decode($response);
               
                DB::table('app_quote')->where('enquiry_id', $enqID)->update(['reqSaveGenPolicy'=>json_encode($REQUEST),'respSaveGenPolicy'=>$response]);
                if($result->errorList==null || $result->errorList==""){
                     $receiptId = isset($result->listofPolicyTO[0]->inwardDOList[0]->receiptId)?$result->listofPolicyTO[0]->inwardDOList[0]->receiptId:"";
                       DB::table('app_quote')->where('enquiry_id',$enqID)->update(
                         ['json_data->receiptId'=>$receiptId,
                         'startDate'=>Carbon::createFromFormat('d/m/Y', $period->startDate)->format('Y-m-d'),
                         'endDate'=>Carbon::createFromFormat('d/m/Y', $period->endDate)->format('Y-m-d')]
                         );
                    return ['status'=>true,'message'=>"Success",'data'=>['receiptId'=>$receiptId]]; 
                }else{
                   $errorList = $result->errorList;
                   if($errorList[0]->errDescription!=null){
                       return ['status'=>false,'message'=>$errorList[0]->errDescription,'data'=>[]];  
                   }else{
                      return ['status'=>false,'message'=>$errorList[0]->errActualMessage,'data'=>[]];   
                   }
                   
                }
            
        }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                //DB::table('app_quote')->where('enquiry_id', $enqId)->update(['reqCreate'=>json_encode($REQUEST),'respCreate'=>$response]);
                $resp = json_decode($responseBodyAsString);
               //print_r($resp);
                return ['status'=>false,'message'=>"ConnectException",'data'=>[]];  
               // return ['status'=>false,'plans'=>[],"message"=>"Sorry we are unable to process your request."];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $resp = json_decode($responseBodyAsString);
                //print_r($responseBodyAsString);die;
                return ['status'=>false,'message'=>"Request Exception",'data'=>[]];  
               
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $resp = json_decode($responseBodyAsString);
                //print_r($resp);
                return ['status'=>false,'message'=>"ClientException error",'data'=>[]];  
                // return ['status'=>false,'plans'=>[],"message"=>"Internal server error"];
            }
            
           
    }
    
    
    
    function _____saveProposal($enqID,$quoteId,$proposalNum,$txnid,$amount){
            $Querydata = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqID)->first();
            
            $sumData = json_decode($Querydata->sumInsured);
            $sum = $sumData->shortAmt;
            
            $dataParam = json_decode($Querydata->json_data);
            $params = json_decode($Querydata->params_request);
            
            
            $termYear = $Querydata->termYear;
            
            $_amts = json_decode($Querydata->amounts);
            
            $quoteId = $_amts->$termYear->quoteId;
            $quoteAmt = $_amts->$termYear->Total_Premium;
            
            
            $child = $params->total_child;
            $adult = $params->total_adult;
            $pt = ($Querydata->policyType=='IN')?'INDIVIDUAL':"FAMILYFLOATER";
            
            $_state = explode("-",$params->address->state);
            $_city = explode("-",$params->address->city); 
            $pincode = $params->address->pincode;
            $zoneCd = $Querydata->zone;//$this->getZone($pincode);                                                                                                                                                                        
            $addressLine1 = $params->address->house_no;
            $addressLine2 = $params->address->street;
            $districtCd   = $_city[1];
            $stateCd      = $_state[1];
            $cityCd       = $_city[1];
            $pinCode      = $params->address->pincode;
            
            $mobile = $params->selfMobile;
            $email = $params->selfEmail;
            
            $nominee_name = isset($params->nomineename)?explode(" ",$params->nomineename):"NA NA";
            $nomineeTitle = ($params->nomineerelation=="MOTHER" || $params->nomineerelation=="DAUGHTER" || $params->nomineerelation=="GRANT_MOTHER" || $params->nomineerelation=="MOTHER_IN_LAW" || $params->nomineerelation=="SISTER" || $params->nomineerelation=="SPOUSE")?"MRS":"MR";
            $members  = $params->members;
            
            $docTypeArr = ['PAN_CARD'=>"PAN"];
            $period = timePeriod('d/m/Y',$termYear);
            $partyDOList =$this->partyDOList_obj();
            $partyRoleDOList = $this->policyPartyRoleDOList_obj(); 
            $ProductInsuredDOList =  $this->policyProductInsuredDOList_obj();
            $QuestionSet = $this->policyQuestionSetDOList_obj();
            $Document = $this->policyDocumentDOList_obj();
           // print_r($QuestionSet);
            $ProductDOList =  $this->policyProductDOList_obj();
            $_partyDOList =[];$_RoleDOList = [];$_ProductInsuredDOList =[];$_Document=[];$refGuid=1;$i=0;$WSPolicyAdditionalMedicalDtlsDOLst=[];
            foreach($members as $member){ 
                   $_QuestionSet =[];
                   $chrList = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                   $chrRepeatMin = 1; $chrRepeatMax = 10; $chrRandomLength = 10;
                   $str = substr(str_shuffle(str_repeat($chrList, mt_rand($chrRepeatMin,$chrRepeatMax))), 1, $chrRandomLength);
                   //$InsuredDOList = "";$RoleDOList=""; $partyList = "";
                   $weight  = ($member->type=="self")?$params->selfWeight:$member->weight;
                   $height  = ($member->type=="self")?(($params->selfFeet*12)+($params->selfInch)):(($member->feet*12)+($member->inch));
                   $Fname   = ($member->type=="self")?$params->selfFname:$member->fname;
                   $Lname   = ($member->type=="self")?$params->selfLname:$member->lname;
                   $birthDt = ($member->type=="self")?$params->selfdd."/".$params->selfmm."/".$params->selfyy:$member->dd."/".$member->mm."/".$member->yy;
                   $genderCd= ($member->type=="self")?$params->gender:$member->gender;
                   $roleCd  = ($member->type=="self")?"PROPOSER":"PRIMARY";
                   $marital = ($member->type=="self")?strtoupper($params->selfMstatus)
                                                     :((in_array($member->type,["wife","husband","father","mother"]))?"MARRIED":"SINGLE");
                   $titleCd = ($member->type=="self" && $params->gender=="MALE")?"MR"
                                                                                :(($member->type=="self" && $params->gender=="FEMALE")?"MRS"
                                                                                                                                      :((in_array($member->type,["wife","mother","daughter"])?"MRS"
                                                                                                                                                                                             :"MR")));
                     
                    if($member->type=="self"){ $relationCd = "SELF";}
                    else if($member->type=="daughter"){  $relationCd = "UDTR"; }
                    else if($member->type=="son")     {  $relationCd = "SON";}
                    else if($member->type=="wife")    {  $relationCd = "WIFE"; }
                    else if($member->type=="husband") {  $relationCd = "HUSBAND";}
                    else if($member->type=="father")  {  $relationCd = "FATH";}
                    else if($member->type=="mother")  {  $relationCd = "MOTH";} 
                    
                    $Document['partyId'] = $params->plan.$refGuid;
                    $_Document[] = $Document;
                    
                    
                    $ProductInsuredDOList['refGuid']=$params->plan.$refGuid;//"00".$str.$refGuid;
                    $ProductInsuredDOList['partyId']=$params->plan.$refGuid;//"00".$str.$refGuid;
                    $ProductInsuredDOList['weight']=floatval($weight);
                    $ProductInsuredDOList['height']=round($height*2.54);
                    $ProductInsuredDOList['zoneCd']= $zoneCd;
                    
                    $ProductInsuredDOList['productPlanOptionCd']=$dataParam->code;
                    $ProductInsuredDOList['baseSumAssured']=floatval($sum*100000);
                    $ProductInsuredDOList['sumInsured']=($sum*100000);
                    
                    
                    $lvl802 =  ['Lvl02_O802_01','Lvl02_O802_02','Lvl02_O802_03','Lvl02_O802_04','Lvl02_O802_05','Lvl02_O802_06','Lvl02_O802_07','Lvl02_O802_08','Lvl02_O802_09','Lvl02_O802_10','Lvl02_O802_11','Lvl02_O802_12','Lvl02_O802_13','Lvl02_O802_14'];
                    $arrNotIn =[];$hasMedicle =false;
                    if(isset($member->medical)){
                     $hasMedicle = true;
                    foreach($member->medical as $mediSet){
                                array_push($arrNotIn,$mediSet->queId);
                                $_set =   DB::table('medical_questions')->where(['supplier'=>'MANIPAL_CIGNA','id'=>$mediSet->queId])->first();
                                $Q['policyQuestionSetSeq'] = null;
                                $Q['questionCd'] = $_set->code;
                                $Q['dataElementCd'] =$_set->code;
                                $Q['policyQuestionResponseDOList'] = [['policyQuestionSeq'=>null,'responseValue'=> 'YES','rowGuid'=>$params->plan.$refGuid]];
                                $QuestionSet['questionSetCd'] =$_set->code;
                                $QuestionSet['policySeq'] = null;
                                $QuestionSet['policyProductSeq'] =null; 
                                $QuestionSet['policyProductInsuredseq'] =null;
                                $QuestionSet['partyGuid'] = $params->plan.$refGuid;
                                $QuestionSet['policyQuestionDOList'] =[$Q];
                                $_QuestionSet[]=$QuestionSet;
                                
                                if(in_array($_set->code,$lvl802)){
                                    
                                      if($mediSet->hasChildQuestions==true){
                                        $additionalMedi = ["partyGuid"=>$params->plan.$refGuid,'adMedComments'=>""];
                                        foreach($mediSet->childQuestions as $ch){
                                           $childSet =   DB::table('medical_questions')->where(['supplier'=>'MANIPAL_CIGNA','parentId'=>$ch->parentId,'id'=>$ch->Qid])->first();
                                          // print_r($childSet);
                                           $additionalMedi['questionSetCd'] = $childSet->code;
                                           $ansswer = $ch->answer;
                                          if($childSet->setparam=="illness"){
                                               $ansswer = $_set->title;
                                           }
                                           $additionalMedi[$childSet->setparam] = $ansswer; 
                                           
                                        }
                                        
                                       // print_r($additionalMedi);die;
                                        $WSPolicyAdditionalMedicalDtlsDOLst[] = $additionalMedi;
                                      }
                                    
                                }
                    }
                    }
                    
                    $QSet =   DB::table('medical_questions')
                                   ->where(['supplier'=>'MANIPAL_CIGNA','parentId'=>0])
                                   ->when($arrNotIn, function ($query, $arrNotIn) { 
                                               return  $query->whereNotIn('id',$arrNotIn);
                                         })->get();
                                   //->whereNotIn('id',$arrNotIn)->get();
                    foreach($QSet as $_otherSet){
                               $Q['policyQuestionSetSeq'] = null;
                                $Q['questionCd'] = $_otherSet->code;
                                $Q['dataElementCd'] =$_otherSet->code;
                                $Q['policyQuestionResponseDOList'] = [['policyQuestionSeq'=>null,'responseValue'=> 'NO','rowGuid'=>$params->plan.$refGuid]];
                                $QuestionSet['questionSetCd'] =$_otherSet->code;
                                $QuestionSet['policySeq'] = null;
                                $QuestionSet['policyProductSeq'] =null; 
                                $QuestionSet['policyProductInsuredseq'] =null;
                                $QuestionSet['partyGuid'] = $params->plan.$refGuid;
                                $QuestionSet['policyQuestionDOList'] =[$Q];
                                $_QuestionSet[]=$QuestionSet;
                    }
                    
                    
                    //$_QuestionSet[]=$QuestionSet;
                    $ProductInsuredDOList['policyQuestionSetDOList']=$_QuestionSet;
                    $_ProductInsuredDOList[] = $ProductInsuredDOList;
                    
                   
                   $partyDOList['partyId']  = $params->plan.$refGuid;//"00".$str.$refGuid;
                   $partyDOList['partyGuid']  = $params->plan.$refGuid;//"00".$str.$refGuid;
                   //$partyDOList['relationCd'] = $relationCd;
                   $partyDOList['firstName1'] = $Fname;
                   $partyDOList['lastName1'] = $Lname;
                   $partyDOList['birthDt'] = $birthDt;
                   $partyDOList['genderCd'] = $genderCd;
                   $partyDOList['maritalStatusCd'] = $marital;
                   $partyDOList['titleCd'] = $titleCd;
                   $partyDOList['roleCd'] = $roleCd;
                   $partyDOList['nomineeTitleCd']   = $nomineeTitle;
                   $partyDOList['nomineeFirstName'] = $nominee_name[0];
                   $partyDOList['nomineeLastName'] = $nominee_name[1];
                   $partyDOList['zoneCd'] = $zoneCd;
                   
                    $partyDOList['partyAddressDOList'][0]['addressLine1Lang1'] = $partyDOList['partyAddressDOList'][1]['addressLine1Lang1'] = $addressLine1;
                    $partyDOList['partyAddressDOList'][0]['addressLine2Lang1'] = $partyDOList['partyAddressDOList'][1]['addressLine2Lang1']= $addressLine2;
                   // $partyDOList['partyAddressDOList'][0]['districtCd'] = $partyDOList['partyAddressDOList'][1]['districtCd'] = $stateCd;//$districtCd;
                    $partyDOList['partyAddressDOList'][0]['stateCd'] = $partyDOList['partyAddressDOList'][1]['stateCd'] = $stateCd;
                    $partyDOList['partyAddressDOList'][0]['cityCd'] = $partyDOList['partyAddressDOList'][1]['cityCd'] = $cityCd;
                    $partyDOList['partyAddressDOList'][0]['pinCode'] =$partyDOList['partyAddressDOList'][1]['pinCode'] = $pinCode;
                    $partyDOList['partyAddressDOList'][0]['postalZone'] = $partyDOList['partyAddressDOList'][1]['postalZone'] = $zoneCd;
                
                    $partyDOList['partyIdentityDOList'][0]['identityTypeCd'] = $docTypeArr[$params->document->documentType];
                    $partyDOList['partyIdentityDOList'][0]['identityNum'] = $params->document->documentId;
                    
                    $partyDOList['partyContactDOList'][0]['contactNum'] = intval($mobile);
                    $partyDOList['partyEmailDOList'][0]['emailAddress'] = $email;
                    $partyDOList['partyEducationDOList'][0]['educationLevelCd']='HSC'; 
                    
                    $partyDOList['partyRelationDOList'][0]['relatedToPartyId'] = $params->plan.$refGuid;
                    $partyDOList['partyRelationDOList'][0]['relationCd'] = $relationCd;
                    $_partyDOList[] = $partyDOList;
                   
                   $partyRoleDOList['refGuid']  =$params->plan.$refGuid;//"00".$str.$refGuid;
                   $partyRoleDOList['partyId']  =$params->plan.$refGuid;//"00".$str.$refGuid;
                   $partyRoleDOList['roleCd']   =$roleCd;
                   $partyRoleDOList['age']  = intval($member->age);
                   $_RoleDOList[]=$partyRoleDOList;
                   if($roleCd=='PROPOSER'){ 
                     $partyRoleDOList['refGuid']  =$params->plan.$refGuid;//"00".$str.$refGuid;
                     $partyRoleDOList['partyId']  =$params->plan.$refGuid;//"00".$str.$refGuid;
                     $partyRoleDOList['roleCd']   ="PRIMARY";
                     $partyRoleDOList['age']  = intval($member->age);
                     $_RoleDOList[]=$partyRoleDOList;
                   }
                   
                 $refGuid++; $i++;  
             }//members foreach;
            
            $ProductDOList['productPlanOptionCd'] = $dataParam->code; 
            $ProductDOList['coverTypeCd'] = $pt; 
            $ProductDOList['baseSumAssured']  = floatval($sum*100000);
            $ProductDOList['policyProductInsuredDOList']  = $_ProductInsuredDOList;
            $ProductDOList['productId'] = $dataParam->product;
            
            if(isset($params->addOn) && $params->addOn!=""){
                $adddonns = explode(',',$params->addOn);
                $policyProductAddOnsDOList =[];
                foreach($adddonns as $addd){
                   $policyProductAddOnsDOList[]   = ['productSeq'=>null,'productId'=>$addd,'productFamilyCd'=>'','baseSumAssured'=>null,'baseAnnualPremium'=>null,
                                            'modalPremium'=>null,'productPlanOptionCd'=>'','benefitStructureOptionCd'=>'','extraPremium'=>null,'discount'=>null,
                                            'productName'=>'','deleteFl'=>'','refGuid'=>''];
                }
                
                $ProductDOList['policyProductAddOnsDOList'] = $policyProductAddOnsDOList;
            }
            
            $req['policySeq'] =null;//date('YmdHis');//$dataParam->applicationID;
            $req['policyNum'] =$dataParam->applicationID;
            $req['applicationID'] =$dataParam->applicationID;//$req['proposalNum'] =$dataParam->applicationID;
            $req['applicationRefNum'] ='';//date('dmY').$dataParam->applicationID;
            $req['proposalSignedDt'] =date('d/m/Y');
            $req['proposalRejectDt'] ='';
            $req['proposalReceivedDt'] =date('d/m/Y');
            $req['proposalEntryDt'] =date('d/m/Y');
            //$req['proposalNum']="";
            $req['baseAgentId'] ='1000015-01';//'1600099-01';
            $req['parentAgencyId'] ='';
            $req['servicingBranchId'] ='';
            $req['channelId'] ='325';
            $req['shgName'] ='';
            $req['baseProductId'] =$dataParam->product;
            $req['baseProductVersion'] =1;
            $req['baseProductTypeCd'] ='SUBPLAN';
            $req['baseProductFamilyCd'] ='HEALTHREVISED';
            $req['policyInsuredCatgCd'] ='';
            $req['groupCd'] ='';
            $req['schemeCd'] ='';
            $req['policyIssueDt'] ='';
            $req['policyMaturityDt'] ="";//$period->endDate;//'18/08/2023';
            $req['policyCommencementDt'] =null;//date('d/m/Y');
            $req['riskCommencementDt'] ='';
            $req['policyDispatchDt'] ='';
            $req['firstPremiumReceiptDt'] ='';
            $req['statusCd'] ='';
            $req['totSumAssured'] =null;
            $req['totAnnualPremium'] =null;
            $req['totModalPremium'] =0;//floatval($dataParam->quotation);
            $req['totalRiderPremium'] =null;
            $req['totExtraPremium'] =null;
            $req['totTax'] =null;
            $req['totCharge'] =null;
            $req['totDiscount'] =null;
            $req['signatureCd'] ='';
            $req['signatureInVernacularFl'] ='';
            $req['agentSignatureFl'] ='';
            $req['witnessSignatureFl'] ='';
            $req['statusDt'] ='';
            $req['stageCd'] ='';
            $req['stageLevel'] ='';
            $req['processStatusCd'] ='PENDING';
            $req['applicationMode'] ='';
            $req['quotationRefNum'] ='';
            $req['imageName'] ='';
            $req['accountNum'] ='';
            $req['missingInfoCd'] ='';
            $req['branchCd'] ='033';
            $req['parentBranchCd'] ='';
            $req['uwDecisionCd'] ='';
            $req['dispatchDt'] ='';
            $req['dispatchModeCd'] ='';
            $req['courierName'] ='';
            $req['courierRecvDt'] ='';
            $req['consignmentNum'] ='';
            $req['reason'] ='';
            $req['uwDecisionValue'] ='';
            $req['deferPeriodUnit'] ='';
            $req['remarks'] ='';
            $req['purposeOfInsuranceCd'] ='';
            $req['intimationSourceCd'] ='PORTAL';
            $req['batchDispatchDt'] ='';
            $req['batchReceivedDt'] ='';
            $req['batchCourierRefNum'] ='';
            $req['batchId'] ='';
            $req['counterOfferDecisionCd'] ='';
            $req['counterOfferReasonCd'] ='';
            $req['counterOfferAcceptDt'] ='';
            $req['counterOfferRemarks'] ='';
            $req['iteration'] =null;
            $req['subStageCd'] ='';
            $req['policyStatusCd'] ='';
            $req['leadGenerationCd'] ='';
            $req['statCd'] ='';
            $req['productPlanOptionCd'] =$dataParam->code;//'IN-PLS5.5-HMB2K';
            $req['leadGeneratorRemarks'] ='';
            $req['medicalStatusCd'] ='';
            $req['lastModifiedDt'] ='';
            $req['workFlow'] ='';
            $req['productTerm'] =(int)$termYear;
            $req['productTermUnitCd'] ='YEARS';
            $req['monitoringStaffId'] ='';
            $req['subChannelId'] ='';
            $req['monitoringOfficeId'] ='';
            $req['monitoringLocationId'] ='';
            $req['paymentTypeCd'] ='';//CREDITCARD
            $req['paymentFrequencyCd'] ='';
            $req['numberOfAdult'] =($adult>0)?intval($adult):null;;
            $req['numberOfChildren'] =($child>0)?intval($child):null;;
            $req['ageBand1Count'] =null;
            $req['ageBand2Count'] =null;
            $req['ageBand3Count'] =null;
            $req['maxTripPeriod'] =null;
            $req['travelGeographyCd'] ='';
            $req['ageGroupOfEldestMember'] = '';
            $req['sumInsured'] =strval($sum*100000);//'550000';
            $req['coverType'] =$pt;//'INDIVIDUAL';
            $req['quoteAmount'] =floatval($quoteAmt);//'18289.32';
            $req['lastPaymentDt'] ='';
            $req['nextPremiumDueDt'] ='';
            $req['alterationEffectiveDt'] ='';
            $req['oldPremium'] =null;
            $req['serviceTax'] =null;
            $req['eduCess'] =null;
            $req['endorsementEffectiveDt'] ='';
            $req['noOfAdultDependents'] =null;
            $req['noOfChildDependents'] =null;
            $req['noOfSRAdultDependents'] =null;
            $req['noOfLives'] =null;
            $req['masterPolicySeq'] =null;
            $req['quoteId'] =$quoteId;//'SSQ'.date('dmYHis');//'Q119531405';
            $req['inwardTypeCd'] ='NEWBUSINESS';
            $req['inwardSubTypeCd'] ='PROPOSALDOCUMENT';
            $req['receivedFrom'] ='ONLINE';
            $req['zoneCd'] =$zoneCd;
            $req['planId'] ="RPRT04";//$dataParam->product;
            $req['higherEduCess'] =null;
            $req['uwReqFl'] ='NO';
            $req['ppmcFl'] ='NO';
            $req['isManualFl'] ='';
            $req['policyExpiryDt'] =$period->endDate;//'18/08/2023';
            $req['workflowInwardNum'] ='';
            $req['contents'] ='';
            $req['modalPremium'] =null;
            $req['initialPremium'] =null;
            $req['caseType'] ='';
            $req['previousPolicyExpiryDt'] ='';
            $req['renewalNoticeSentFl'] ='';
            $req['renewalDate'] ='';
            $req['renewalYear'] =null;
            $req['cummulativeBonusAmt'] =null;
            $req['prevCummulativeBonus'] =null;
            $req['actualCummulativeBonus'] =null;
            $req['cummulativeBonusPerc'] =null;
            $req['claims'] ='';
            $req['renewalDueStatus'] ='';
            $req['totUWLoadingAmount'] =null;
            $req['renewalFl'] ='';
            $req['portOutFl'] ='';
            $req['retentionFl'] ='';
            $req['premiumToBeCollected'] =null;
            $req['premiumSuspenseAmount'] =null;
            $req['uwLoadingPerc'] =null;
            $req['totUWLoadingInclOfTaxes'] =null;
            $req['totPremiumBeforeTaxes'] =null;
            $req['pointsOnPremiumPaid'] =null;
            $req['totalRewardPoints'] =null;
            $req['pointsFromWellnessPrograms'] =null;
            $req['agencyId'] ='';
            $req['subagencyId'] ='';
            $req['employeeCd'] ='';
            $req['partnerBranchId'] ='';
            $req['refCodeA'] ='';
            $req['refCodeB'] ='';
            $req['refCodeC'] ='';
            $req['gst'] =null;
            $req['gstCess'] =null;
            $req['uwLoadGST'] =null;
            $req['uwLoadGSTCess'] =null;
            $req['utilizeHMBForPremium'] ='';
            $req['hmbUtilizedTowardPremium'] =null;
            $req['splitPolicyDO'] =[['splitCustomerId'=>"",'splitPolicyNum'=>"" ]];
            
            $req['migrationFlag'] ='';
            $req['splitType'] ='';
            $req['splitPolicy'] ='';
            
             
             $req['policyPortabilityDO'] =[$this->policyPortabilityDO_obj()];
             $req['policyProductDOList'] =[$ProductDOList];//[$this->policyProductDOList_obj()];
             $req['policyPaymentDOList'] =[['paymentMethodCd'=>'','paymentInstructionTypeCd'=>'','partyFinAccountSeq'=>null,'partyFinAccRefGuid'=>'','payerPartyId'=>'','payerPartyRefGuid'=>'',]];
             $req['policyAgentDOList'] =[['agentId'=>'1000015-01','primaryAgentFl'=>'','yearFrom'=>null,'yearTo'=>null,'commPercent'=>null,'prodnPercent'=>null,]];
             $req['policyPartyRoleDOList'] =$_RoleDOList;//$this->policyPartyRoleDOList_obj();
             $req['partyDOList'] =$_partyDOList;//[$this->partyDOList_obj()];
             $req['inwardDOList'] =[$this->inwardDoList_obj($period,$proposalNum,$txnid,$amount)];
             $req['policyDocumentDOList'] =$_Document;//[$this->policyDocumentDOList_obj(),$this->policyDocumentDOList_obj()];
             $req['policyQuestionSetDOList'] =$this->QpolicyQuestionSetDOList_obj($params->plan);//[$this->policyQuestionSetDOList_obj()];
             $req['policyAdditionalFieldsDOList']  = [$this->policyAdditionalFieldsDOList_obj()];
             $req['policyPortabilityMemberDOList'] = [$this->policyPortabilityMemberDOList_obj()];
             $req['policyPortabilityMemberClaimDOList'] =[   
                                                            [
                                                            'clientId'=> '',
                                                            'previousClaimNum'=>'',
                                                            'visitDt'=>'',
                                                            'hospitalId'=>'',
                                                            'otherHospital'=>'',
                                                            'amountPaid'=>null,
                                                            'paymentDt'=>'',
                                                            'claimOutstandingFl'=>'',
                                                            'coPayments'=>null,
                                                            'claimReason'=>'',
                                                           ]
                                                        ];
             $req['WSPolicyAdditionalMedicalDtlsDOList'] = $this->WSPolicyAdditionalMedicalDtlsDOList($WSPolicyAdditionalMedicalDtlsDOLst);
           
             $req['WSPolicyPreviousInsuranceDtlsDOList'] =[
                                                             [
                                                                'partyGuid'=>'',
                                                                'policyNum'=>'',
                                                                'fromDt'=>'',
                                                                'toDt'=>'',
                                                                'baseSumAssured'=>null,
                                                                'claimNum'=>'',
                                                                'claimAmount'=>null,
                                                                'ailment'=>'',
                                                               // 'sumassured'=>null,
                                                                'bonusPercentage'=>null,
                                                                'bonusAmount'=>null,
                                                                'insurerName'=>'',
                                                                'typeOfPolicy'=>'',
                                                                'portabilityFl'=>'',
                                                                'prevAddOnRidersTakenFlag'=>'',
                                                                'propCBConvToEnhSIFlag'=>'',
                                                                'portReasonCd'=>'', 
                                                                'prevPolDeclinedFlag'=>'',
                                                            ]
                                                         ];
             $req['policyChangeDOList'] =[['alterationType'=>'','policyChangeDetailTOList'=>[['refGuid'=>null,'customerId'=>null]]]];
             $req['policyMandateDOList'] =[$this->policyMandateDOList_obj()];
            
            if(isset(Auth::guard('agents')->user()->id)){
                   
                     $req['subIntermediaryName'] =Auth::guard('agents')->user()->name;;
                     $req['subIntermediaryPAN'] =Auth::guard('agents')->user()->pan_card_number;
                }else{
                     $req['subIntermediaryName'] ='';
                     $req['subIntermediaryPAN'] ='';
                }
            $req['others'] ='';
            $req['classificationCd'] ='';
            $req['modalLoadingPremium'] =null;
            $listofPolicyTO[]  = $req;
            $REQUEST = ["listofPolicyTO"=>$listofPolicyTO];
            
         
             $client = new Client([
                'headers' => ['Content-Type'=>'application/json',"app_key"=>config('mediclaim.MANIPAL.appKey'),"app_id"=>config('mediclaim.MANIPAL.appIdSave')]
            ]);
            
            $clientResp = $client->post(config('mediclaim.MANIPAL.saveProposal'),
                ['body' => json_encode($REQUEST)]
            );
            
            $response = $clientResp->getBody()->getContents();   
            $result=json_decode($response);
            
            if(empty($result->errorList)){
                $receiptId = isset($result->listofPolicyTO[0]->inwardDOList[0]->receiptId)?$result->listofPolicyTO[0]->inwardDOList[0]->receiptId:"";
                DB::table('app_quote')->where('enquiry_id',$enqID)->update(['json_data->receiptId'=>$receiptId]);
                return ['status'=>true, 'message'=>"save proposal successfully!",'data'=>['receiptId'=>$receiptId]];
                
            }else{
              return ['status'=>false, 'message'=>$result->errorList[0]->errDescription]; 
            }
            
    }
    
    
    
}