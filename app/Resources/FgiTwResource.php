<?php
namespace App\Resources;
use Nathanmac\Utilities\Parser\Parser;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Carbon\Carbon;

class FgiTwResource extends AppResource{ 
    
 
    
    public function __construct(){
      
    }
    
     public function getJsonData($options,$data){
            //$resp = $temp->response;
            //$data = json_decode($response);
            
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
            
           
             //print_r($data);
            $addons = []; $totalgrossAmt = 0;$totalnetAmt = 0;$totalTax=0;
            $contracts = $data->Policy->NewDataSet->Table1;
            foreach($contracts as $cover){
               
                if($cover->Code=="Gross Premium" && $cover->Type=='TP'){
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
            $obj->net   =  trim($totalnetAmt);
            $obj->tax   =  trim($totalTax);
            $obj->idv   =  $data->Policy->VehicleIDV;
            $obj->discount=  $discount;
            
            //customer
            $customer = new \stdClass(); 
            $customer->name ="";
            $customer->mobile ="";
            $customer->email ="";
            $customer->dob ="";
            
            $obj->customer = $customer;
            
            $supplier = new \stdClass(); 
            $supplier->id =6;
            $supplier->name ="Future Generali Insurance";
            $supplier->short ="FGI_M";
            $supplier->logo ="https://general.futuregenerali.in/img/logo.png";
            $obj->supplier = $supplier;
            
            //vehicle
            $RTO = substr($options['carnumber'],0,4);
            $vehicle = new \stdClass(); 
            $vehicle->make =$options['brand']['name'];
            $vehicle->model =$options['model']['name'];
            $vehicle->varient =$options['varient']['name'];
            $vehicle->code = "";
            $vehicle->rto =$RTO;
            $vehicle->rto_no = $options['carnumber'];
            $vehicle->reg_date = $options['regMonth']."-".$options['regYear'];
            $vehicle->chassis_no = '';
            $vehicle->engin_no = '';
            $vehicle->idv =$data->Policy->VehicleIDV;
            $vehicle->minIdv =$data->Policy->VehicleIDV;
            $vehicle->maxIdv =$data->Policy->VehicleIDV;
            $obj->vehicle = $vehicle;
            
            return $obj;
    }
    
     function fnQuoteRequest($params){
         $chars = date('Ymd').time();
         $uid = str_shuffle(substr(str_shuffle($chars), 0, 10));
         
         $make=($params['vehicle']['brand']['name'])?trim($params['vehicle']['brand']['name']):null;
         $model = ($params['vehicle']['model']['name'])?$params['vehicle']['model']['name']:null;
         $varient = ($params['vehicle']['varient']['name'])?$params['vehicle']['varient']['name']:null;
         $regionCode = $params['vehicle']['rtoCode'];
         
        //  $rto_master=DB::table('rto_master')->select('pincode_masters.*','rto_master.registered_state_name as _state','rto_master.registered_city_name as _city')
        // ->join('pincode_masters','pincode_masters.dist', '=','rto_master.registered_city_name')
        // ->where('rto_master.region_code',strtoupper($regionCode))
        // ->orWhere('rto_master.registered_city_name', 'like',"CONCAT(pincode_masters.dist, '%')")->first();
        
         $rto_master=DB::table('rtoMaster')->select('rtoMaster.rtoCode as rtoCode','cities.name as cityName','cities.id as cityId','states.name as stateName',
                                                    'states.id as stateId')
                                                ->where('rtoCode',strtoupper($params['vehicle']['rtoCode']))
                                                ->leftJoin('cities', 'cities.id', '=', 'rtoMaster.city_id')
                                                ->leftJoin('states', 'states.id', '=', 'cities.state_id')->first();
         $pincode = DB::table('pincode_masters')->where('city_id',$rto_master->cityId)->first();
         $var = DB::table('vehicle_variant_tw')->where('id',$params['vehicle']['varient']['id'])->first();
    
         $pincode =  "302020";//isset($pincode->pincode)?$pincode->pincode:'';
         $_city   =  "JAIPUR";//isset($rto_master->_city)?strtoupper($rto_master->_city):'';
         $_state  =  "RAJASTHAN";//isset($rto_master->_state)?strtoupper($rto_master->_state):'';
         $fuel = "P";
         switch (strtolower($var->fuel_type)) {
            case "petrol":$fuel =  "P";break;
            case "diesel":$fuel =  "D";break;
            case "cng": $fuel =  "C";break;
            default:$fuel =  "P";
        }
        $period = $this->timePeriod('d/m/Y',3);
        $ncb = isset($params['previousInsurance']['ncb'])?$params['previousInsurance']['ncb']:"ZERO";
        $ncbArray = ['ZERO'=>0,'TWENTY'=>20,'TWENTY_FIVE'=>25,'THIRTY_FIVE'=>35,'FORTY_FIVE'=>45,'FIFTY'=>50,'FIFTY_FIVE'=>55,'SIXTY_FIVE'=>65];
        $hasMadePreClaim  = (isset($params['previousInsurance']['hasPreClaim']) && $params['previousInsurance']['hasPreClaim']=='yes')?'Y':'N';
       
            $ROOT = "<Root>
	<Uid>".$uid."</Uid>
	<VendorCode>webagg</VendorCode>
	<VendorUserId>webagg</VendorUserId>
	<PolicyHeader>
		<PolicyStartDate>".$period->startDate."</PolicyStartDate> <PolicyEndDate>".$period->endDate."</PolicyEndDate>
		<AgentCode>60001464</AgentCode>
		<BranchCode>10</BranchCode>
		<MajorClass>MOT</MajorClass>
		<ContractType>F13</ContractType>
		<METHOD>ENQ</METHOD>
		<PolicyIssueType>I</PolicyIssueType>
		<PolicyNo>
		</PolicyNo>
		<ClientID>
		</ClientID>
		<ReceiptNo>
		</ReceiptNo>
	</PolicyHeader>
	<POS_MISP>
		<Type></Type>
		<PanNo></PanNo>
	</POS_MISP>
	<Client>
		<ClientType>I</ClientType>
		<CreationType>C</CreationType>
		<Salutation></Salutation>
		<FirstName></FirstName>
		<LastName></LastName>
		<DOB></DOB>
		<Gender></Gender>
		<MaritalStatus></MaritalStatus>
		<Occupation>SVCM</Occupation>
		<PANNo>
		</PANNo>
		<GSTIN>
		</GSTIN>
		<AadharNo>
		</AadharNo>
		<CKYCNo>
		</CKYCNo>
		<EIANo>
		</EIANo>
		<Address1>
			<AddrLine1></AddrLine1>
			<AddrLine2></AddrLine2>
			<AddrLine3></AddrLine3>
			<Landmark>
			</Landmark>
			<Pincode>".$pincode."</Pincode>
			<City>".$_city."</City>
			<State>".$_state."</State>
			<Country>IND</Country>
			<AddressType>R</AddressType>
			<HomeTelNo>
			</HomeTelNo>
			<OfficeTelNo>
			</OfficeTelNo>
			<FAXNO>
			</FAXNO>
			<MobileNo>7697735557</MobileNo>
			<EmailAddr></EmailAddr>
		</Address1>
		<Address2>
			<AddrLine1>
			</AddrLine1>
			<AddrLine2>
			</AddrLine2>
			<AddrLine3>
			</AddrLine3>
			<Landmark>
			</Landmark>
			<Pincode>".$pincode."</Pincode>
			<City>".$_city."</City>
			<State>".$_state."</State>
			<Country>IND</Country>
			<AddressType></AddressType>
			<HomeTelNo>
			</HomeTelNo>
			<OfficeTelNo>
			</OfficeTelNo>
			<FAXNO>
			</FAXNO>
			<MobileNo>7697735557</MobileNo>
			<EmailAddr>
			</EmailAddr>
		</Address2>
	<VIPFlag>N</VIPFlag>
	<VIPCategory>
</VIPCategory>
	</Client>
	<Receipt>
		<UniqueTranKey></UniqueTranKey>
		<CheckType>
		</CheckType>
		<BSBCode>
		</BSBCode>
		<TransactionDate></TransactionDate>
		<ReceiptType></ReceiptType>
		<Amount></Amount>
		<TCSAmount>
		</TCSAmount>
		<TranRefNo></TranRefNo>
		<TranRefNoDate></TranRefNoDate>
	</Receipt>
	<Risk>
		<RiskType>F13</RiskType>
		<Zone>Zone A</Zone>
		<Cover>CO</Cover>
		<Vehicle>
			<TypeOfVehicle>O</TypeOfVehicle>
			<VehicleClass>FTW</VehicleClass>
			<RTOCode>".$regionCode."</RTOCode>
			<Make>".strtoupper($make)."</Make>
			<ModelCode>".$var->fgi_code."</ModelCode>
			<RegistrationNo>{{RegistrationNo}}</RegistrationNo>
			<RegistrationDate>30/07/2020</RegistrationDate>
			<ManufacturingYear>2019</ManufacturingYear>
			<FuelType>".$fuel."</FuelType>
			<CNGOrLPG>
				<InbuiltKit></InbuiltKit>
				<IVDOfCNGOrLPG></IVDOfCNGOrLPG>
			</CNGOrLPG>
			<BodyType>SOLO</BodyType>
			<EngineNo>GAN111111</EngineNo>
			<ChassiNo>000000000000GAN111111</ChassiNo>
			<CubicCapacity>102</CubicCapacity>
			<SeatingCapacity>".$var->seating_capacity."</SeatingCapacity>
			<IDV>{{IDV}}</IDV>
			<GrossWeigh></GrossWeigh>
			<CarriageCapacityFlag></CarriageCapacityFlag>
			<ValidPUC>Y</ValidPUC>
			<TrailerTowedBy></TrailerTowedBy>
			<TrailerRegNo></TrailerRegNo>
			<NoOfTrailer></NoOfTrailer>
			<TrailerValLimPaxIDVDays></TrailerValLimPaxIDVDays>
		<TrailerChassisNo>
</TrailerChassisNo>
		<TrailerMfgYear>
</TrailerMfgYear>
		<SchoolBusFlag>
</SchoolBusFlag>
		</Vehicle>
		<InterestParty>
			<Code></Code>
			<BankName></BankName>
		</InterestParty>
		<AdditionalBenefit>
			<Discount>0.00000</Discount>
			<ElectricalAccessoriesValues></ElectricalAccessoriesValues>
			<NonElectricalAccessoriesValues></NonElectricalAccessoriesValues>
			<FibreGlassTank>
			</FibreGlassTank>
			<GeographicalArea>
			</GeographicalArea>
			<PACoverForUnnamedPassengers>{{isPA_UNPassCover}}</PACoverForUnnamedPassengers>
			<LegalLiabilitytoPaidDriver>{{isLL_PaidDriverCover}}</LegalLiabilitytoPaidDriver>
			<LegalLiabilityForOtherEmployees>{{isLL_EmpCover}}</LegalLiabilityForOtherEmployees>
			<LegalLiabilityForNonFarePayingPassengers>
			</LegalLiabilityForNonFarePayingPassengers>
			<UseForHandicap></UseForHandicap>
			<AntiThiefDevice></AntiThiefDevice>
			<NCB>0</NCB>
			<RestrictedTPPD></RestrictedTPPD>
			<PrivateCommercialUsage></PrivateCommercialUsage>
			<CPAYear>3</CPAYear>
			<CPADisc></CPADisc>
			<IMT23></IMT23>
			<CPAReq>N</CPAReq>
			<CPA>
				<CPANomName></CPANomName>
				<CPANomAge></CPANomAge>
				<CPANomAgeDet></CPANomAgeDet>
				<CPANomPerc></CPANomPerc>
				<CPARelation></CPARelation>
				<CPAAppointeeName>
				</CPAAppointeeName>
				<CPAAppointeRel>
				</CPAAppointeRel>
			</CPA>
			<NPAReq>N</NPAReq>
			<NPA>
				<NPAName>
				</NPAName>
				<NPALimit>
				</NPALimit>
				<NPANomName>
				</NPANomName>
				<NPANomAge>
				</NPANomAge>
				<NPANomAgeDet>
				</NPANomAgeDet>
				<NPARel>
				</NPARel>
				<NPAAppinteeName>
				</NPAAppinteeName>
				<NPAAppinteeRel>
				</NPAAppinteeRel>
			</NPA>
		<ZNCBRSRCV>
</ZNCBRSRCV>
		<ZNOFEMPLY>
</ZNOFEMPLY>
		<ZLMTPERPD>
</ZLMTPERPD>
		<ZADDLPAPD>
</ZADDLPAPD>
		<ZTPPER>
</ZTPPER>
		<ZCMPTPPA>
</ZCMPTPPA>
		<ZLMTTPPD>
</ZLMTTPPD>
		<ZPREMISE>
</ZPREMISE>
		<ZVINTAGE>
</ZVINTAGE>
		<XCESSLAB>
</XCESSLAB>
		<XCESCDE>
</XCESCDE>
		<ZSCARSI>
</ZSCARSI>
		<ZSCARIND>
</ZSCARIND>
		<ZAANO>
</ZAANO>
		<ZEMBASSY>
</ZEMBASSY>
		<ZSPECRAL>
</ZSPECRAL>
		<ZRALTRAIL>
</ZRALTRAIL>
		<ZDRVTTN>
</ZDRVTTN>
		<EXPDTE>
</EXPDTE>
		<ZOVRTFLG>
</ZOVRTFLG>
		<ZIMT44ID>
</ZIMT44ID>
		<ZPAPDPRM>
</ZPAPDPRM>
		<ZNOPPM>
</ZNOPPM>
		<ZIMT34ID>
</ZIMT34ID>
		</AdditionalBenefit>
		<AddonReq>{{HAS_ADDONS}}</AddonReq>
		
			{{ADDONS}}
		
		<PreviousTPInsDtls>
			<PreviousInsurer>
			</PreviousInsurer>
			<TPPolicyNumber>
			</TPPolicyNumber>
			<TPPolicyEffdate>
			</TPPolicyEffdate>
			<TPPolicyExpiryDate>
			</TPPolicyExpiryDate>
		</PreviousTPInsDtls>
		<PreviousInsDtls>
			<UsedCar>N</UsedCar>
			<UsedCarList>
				<PurchaseDate>
				</PurchaseDate>
				<InspectionRptNo>
				</InspectionRptNo>
				<InspectionDt>
				</InspectionDt>
			</UsedCarList>
			<RollOver>N</RollOver>
			<RollOverList>
				<PolicyNo></PolicyNo>
				<InsuredName></InsuredName>
				<PreviousPolExpDt></PreviousPolExpDt>
				<ClientCode></ClientCode>
				<Address1>".$_city."</Address1>
				<Address2>".$_city."</Address2>
				<Address3>".$_city."</Address3>
				<Address4>".$_city."</Address4>
				<Address5>".$_state."</Address5>
				
				<PinCode>".$pincode."</PinCode>
		
				<InspectionRptNo>
				</InspectionRptNo>
				<InspectionDt>
				</InspectionDt>
				<NCBDeclartion>".$hasMadePreClaim."</NCBDeclartion>  
				<ClaimInExpiringPolicy>".$hasMadePreClaim."</ClaimInExpiringPolicy>
				<NCBInExpiringPolicy>".$ncbArray[$ncb]."</NCBInExpiringPolicy>
			<PreviousPolStartDt>
</PreviousPolStartDt>
			<TypeOfDoc>
</TypeOfDoc>
			<NoOfClaims>
</NoOfClaims>
			</RollOverList>
			<NewVehicle>Y</NewVehicle>
			<NewVehicleList>
				<InspectionRptNo>
				</InspectionRptNo>
				<InspectionDt>
				</InspectionDt>
			</NewVehicleList>
		</PreviousInsDtls>
	<ZLLOTFLG>
</ZLLOTFLG>
	<GARAGE>
</GARAGE>
	<ZREFRA>
</ZREFRA>
	<ZREFRB>
</ZREFRB>
	<ZIDVBODY>
</ZIDVBODY>
	<COVERNT>
</COVERNT>
	<CNTISS>
</CNTISS>
	<ZCVNTIME>
</ZCVNTIME>
	<AddressSeqNo>
</AddressSeqNo>
	</Risk>
</Root>
";
 return $ROOT;
              
    }
    
     function getQuickQuote($deviceToken,$options){
        $XML =  $this->fnQuoteRequest($options);
        
        $RegNo = isset($params['carnumber'])?$params['carnumber']:"";
        $XML = str_replace("{{RegistrationNo}}",$RegNo,$XML);
        $idv = "0";$XML = str_replace("{{IDV}}",$idv,$XML);
        $isPA_UNPassCover = "";$XML = str_replace("{{isPA_UNPassCover}}",$isPA_UNPassCover,$XML);
        $isLL_PaidDriverCover = "";$XML = str_replace("{{isLL_PaidDriverCover}}",$isLL_PaidDriverCover,$XML);
        $LL_Emp = "";$XML = str_replace("{{isLL_EmpCover}}",$LL_Emp,$XML);
        
        $hasAddons = "N";$XML = str_replace("{{HAS_ADDONS}}",$hasAddons,$XML);
        $XML = str_replace("{{ADDONS}}","<Addon><CoverCode></CoverCode></Addon>",$XML);	
       // $ADDONS = "";$XML = str_replace("{{ADDONS}}",$ADDONS,$XML);
        	
       		
        $url = 'http://fglpg001.futuregenerali.in/BO/Service.svc?wsdl';
        //echo $XML;die;
        try {
            $factory = new Factory();
            $client = $factory->create(new Client(), $url); 
            $result = $client->call('CreatePolicy', [["Product"=>"Motor","XML"=>$XML]]);
            $xml   = simplexml_load_string($result->CreatePolicyResult, 'SimpleXMLElement', LIBXML_NOCDATA);
            $array = json_decode(json_encode((array)$xml), TRUE);
            print_r($array);die;
              
            if(isset($array['Policy'])){
                  $policy = $array['Policy'];
                  $response  = json_decode(json_encode($array));
                if($policy['Status']=="Successful"){
                    $json_data = $this->getJsonData($options,$response);
                    $enq = "QT-FW-".time().mt_rand();
                    $plan['supplier_id'] = 6;
                    $plan['supplier']    = "FGI_M";
                    $plan['title']       = "Car Insurance";
                    $plan['discount']    = 0;
                    $plan['grossamount'] = $json_data->gross;
                    $plan['netamount']   = $json_data->net;
                    $plan['supp_name']   = "Future Generali Insurance";
                    $plan['supp_logo']   = "https://general.futuregenerali.in/img/logo.png";
                    $plan['id']          = $enq;
                    $plan['idv']         = $policy['VehicleIDV'];
                      
                      $quoteData = ['quote_id'=>$enq,'type'=>'CAR','title'=>"Future Generali Insurance",
                                    'device'=>$deviceToken,'provider'=>'FGI_M',
                                    'min_idv'=>$policy['VehicleIDV'],
                                    'max_idv'=>$policy['VehicleIDV'],
                                    'idv'    =>$policy['VehicleIDV'],
                                    'call_type'=>"QUOTE",
                                    'response'=>json_encode($response),'json_quote'=>json_encode($result),'json_data'=>json_encode($json_data),
                                    'req'=>$XML,'resp'=>json_encode($array)];
                    $quoteID = DB::table('app_temp_quote')->insertGetId($quoteData);
                    if($quoteID){
                      return ['status'=>true,'plans'=>$plan];
                    }else{
                         return ['status'=>false,'plans'=>[]];
                    }
                }else{ //Fail
                    return ['status'=>false,'plans'=>[]];
                }
            }else{
               return ['status'=>false,'plans'=>[]];
            }
        }catch(Exception $e) {
              //echo $e->getMessage();
             return ['status'=>false,'plans'=>[]];
        }
    }
    
     function getRecalulateQuote($deviceToken,$customer,$params){
        //print_r($params);
        $XML =  $this->fnQuoteRequest($params);
        $options = $params['subcovers'];
        $_quoteData = DB::table('app_temp_quote')->where(['provider'=>"FGI_M",'type'=>'CAR','device'=>$deviceToken])->orderBy('id','desc')->first();
        //print_r($_quoteData);
        
        
        $RegNo = isset($params['carnumber'])?$params['carnumber']:"";
        $XML = str_replace("{{RegistrationNo}}",$RegNo,$XML);
        
        $idv = isset($params['idv']['value'])?$params['idv']['value']:"876124";
        $XML = str_replace("{{IDV}}",$idv,$XML);
        
        $PA_UNNAMED_PASS = (isset($options['isPA_UNPassCover']) && $options['isPA_UNPassCover']==1)?$options['PA_UNPassCoverval']:'';
        $XML = str_replace("{{isPA_UNPassCover}}",$PA_UNNAMED_PASS,$XML);
        
        $LL_PaidDriver = (isset($options['isLL_PaidDriverCover']) && $options['isLL_PaidDriverCover']==1)?"Y":"";
        $XML = str_replace("{{isLL_PaidDriverCover}}",$LL_PaidDriver,$XML);
        
        $LL_Emp = (isset($options['isLL_EmpCover']) && $options['isLL_EmpCover']==1)?"Y":"";
        $XML = str_replace("{{isLL_EmpCover}}",$LL_Emp,$XML);
        $ADDONS="";
        $ADDONS .= (isset($options['isTyreProCover']) && $options['isTyreProCover']==1)?"<Addon><CoverCode>00001</CoverCode></Addon>":"";
        $ADDONS .= (isset($options['isRetInvCover']) && $options['isRetInvCover']==1)?"<Addon><CoverCode>00006</CoverCode></Addon>":"";
        $ADDONS .= (isset($options['isEng_GearBoxProCover']) && $options['isEng_GearBoxProCover']==1)?"<Addon><CoverCode>ENGPR</CoverCode></Addon>":"";
        $ADDONS .= (isset($options['isPartDepProCover']) && $options['isPartDepProCover']==1)?"<Addon><CoverCode>PLAN1</CoverCode></Addon>":"";
        $hasAddons = ($ADDONS!="")?"Y":"N";
        $XML = str_replace("{{HAS_ADDONS}}",$hasAddons,$XML);
        if($hasAddons=="Y"){
             $XML = str_replace("{{ADDONS}}",$ADDONS,$XML);
        }else{
          $XML = str_replace("{{ADDONS}}","<Addon><CoverCode></CoverCode></Addon>",$XML);	
        }
         //echo $XML;
        
        $url = 'http://fglpg001.futuregenerali.in/BO/Service.svc?wsdl';
        try {
            $factory = new Factory();
            $client = $factory->create(new Client(), $url); 
            $result = $client->call('CreatePolicy', [["Product"=>"Motor","XML"=>$XML]]);
           
            $xml   = simplexml_load_string($result->CreatePolicyResult, 'SimpleXMLElement', LIBXML_NOCDATA);
            $array = json_decode(json_encode((array)$xml), TRUE);
            //print_r($array);
            if(isset($array['Policy'])){
                  $policy = $array['Policy'];  
                  $response  = json_decode(json_encode($array));
                if($policy['Status']=="Successful"){
                    $json_data = $this->getJsonData($params,$response);
                    //$enq = "QT-FW-".time().mt_rand();
                    $plan['supplier_id'] = 6;
                    $plan['supplier']    = "FGI_M";
                    $plan['title']       = "Car Insurance";
                    $plan['grossamount'] = $json_data->gross;
                    $plan['netamount']   = $json_data->net;
                     $plan['discount']    = 0;
                    $plan['supp_name']   = "Future Generali Insurance";
                    $plan['supp_logo']   = "https://general.futuregenerali.in/img/logo.png";
                    $plan['id']          = $_quoteData->quote_id;
                    $plan['idv']         = $policy['VehicleIDV'];
                      
                      $quoteData = ['type'=>'CAR','title'=>"Future Generali Insurance",
                                    'device'=>$deviceToken,'provider'=>'FGI_M',
                                    'min_idv'=>$policy['VehicleIDV'],
                                    'max_idv'=>$policy['VehicleIDV'],
                                    'idv'    =>$policy['VehicleIDV'],
                                    'call_type'=>"QUOTE",
                                     'response'=>json_encode($response),'json_quote'=>json_encode($result),'json_data'=>json_encode($json_data),
                                    'req'=>$XML,'resp'=>json_encode($array)];
                    //$quoteID = DB::table('app_temp_quote')->insertGetId($quoteData);
                    $quoteID = DB::table('app_temp_quote')->where('quote_id',$_quoteData->quote_id)->update($quoteData);
                    return ['status'=>true,'plans'=>$plan];
                }else{ //Fail
                    return ['status'=>false,'plans'=>[]];
                }
            }else{
               return ['status'=>false,'plans'=>[]];
            }
        }catch(Exception $e) {
              //echo $e->getMessage();
             return ['status'=>false,'plans'=>[]];
        }
    }
    
    function Generatehash256($message) {
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
    
   
    
}