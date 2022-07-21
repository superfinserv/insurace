<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ErrorException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Response;
use View;
use Session; 
use Auth;
//use Redirect;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
//use PDF;
use Carbon\Carbon;

use App\Resources\DigitCarResource;
use App\Resources\DigitBikeResource;
use App\Resources\HdfcErgoTwResource;
use App\Resources\HdfcErgoCarResource;
use App\Resources\FgiTwResource;
use PDF as Filepdf;

use App\Partners\Care\Care;
use App\Partners\Manipal\Manipal;
use App\Partners\Digit\DigitHealth;
use App\Utils\PolicyMail;
use App\Utils\OrcCalculate;
use App\Utils\Posp;
class TestController extends Controller{
    public $uniqueToken;
    public function __construct() { 
       $this->DigitBikeResource  = new DigitBikeResource;
       $this->DigitCarResource =   new DigitCarResource;
       $this->HdfcErgoTwResource =  new HdfcErgoTwResource;
       $this->HdfcErgoCarResource =  new HdfcErgoCarResource;
       $this->FgiTw =  new FgiTwResource;
        
       $this->Care =   new Care;
       $this->Manipal  =  new Manipal;
       $this->DigitHealth  =  new DigitHealth;
       
       $this->policymail = new PolicyMail;
       $this->orc =  new OrcCalculate;
       $this->posp  = new Posp;
   }
     
     function testPartnerBug(Request $request){
         header('Content-Type: application/json');
        // $this->HdfcErgoTwResource->bugReport();
        $this->HdfcErgoCarResource->bugReport();
        die;
        $results = DB::table('agents')->where('status','Inforce')->where('posp_ID','SF/POSP/A10005')->first();
         //foreach($results as $each){
             if($results->status=='Inforce'){ 
                 $res = $this->posp->createPOSPcode($results);
             }
             
         //}
        die;
        $resp = new \stdClass(); 
             $resp->status = false;$resp->code = ""; $resp->message = "";
        $row = DB::table('agents')->where('id',13)->first();  
        $VC_UNIQUE_CODE =$row->posp_ID;
        $xml_post_string = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                <soap:Body>
                                    <MapPospPortal xmlns="http://tempuri.org/">
                                        <objposp>
                                            <DAT_END_DATE>23/08/2024</DAT_END_DATE>
                                            <NUM_MOBILE_NO>'.$row->mobile.'</NUM_MOBILE_NO>
                                            <VC_ADHAAR_CARD>'.$row->adhaar_card_number.'</VC_ADHAAR_CARD>
                                            <VC_BRANCH_CODE>1000</VC_BRANCH_CODE>
                                            <VC_EMAILID>'.$row->email.'</VC_EMAILID>
                                            <VC_INTERMEDIARY_CODE>201249941609</VC_INTERMEDIARY_CODE>
                                            <VC_LANDLINE>8918154084</VC_LANDLINE>
                                            <VC_LOCATION>Mumbai</VC_LOCATION>
                                            <VC_NAME>'.$row->name.'</VC_NAME>
                                            <VC_PAN_CARD>'.$row->pan_card_number.'</VC_PAN_CARD>
                                            <VC_REG_NO>'.$row->application_no.'</VC_REG_NO>
                                            <VC_STATE>Maharastra</VC_STATE>
                                            <VC_TYPE>'.$row->userType.'</VC_TYPE>
                                            <VC_UNIQUE_CODE>'.$VC_UNIQUE_CODE.'</VC_UNIQUE_CODE>
                                        </objposp>
                                    </MapPospPortal>
                                </soap:Body>
                            </soap:Envelope>';
             
            $url = 'http://202.191.196.210/UAT/OnlineProducts/PospCreation/PospService.asmx';  // WSDL web service url for request method/function
             
             
            $client = new Client([
                'headers' => ["charset"=> "utf-8", 'Content-Type' => 'text/xml',]
             ]);
             $clientResp = $client->post($url,
                ['body' => $xml_post_string]
             );
            $result = $clientResp->getBody()->getContents();
            
             $xmmll =  $result;
                        $doc = new \DOMDocument();
                        $doc->preserveWhiteSpace = true;
                        $doc->loadXML($xmmll);
                        $doc->save('pospxml.xml');
                    
                        $xmlfile  = file_get_contents('pospxml.xml');
                        $parseObj = str_replace($doc->lastChild->prefix.':',"",$xmlfile);
                        $ob       = simplexml_load_string($parseObj);
                        $data     = json_decode(json_encode($ob), true);
                    
                   print_r($data);
                  if(isset($data['Body']['MapPospPortalResponse']['MapPospPortalResult'])){
                      if($data['Body']['MapPospPortalResponse']['MapPospPortalResult']=="SUCCESS"){
                             $resp->status = true;
                             $resp->code = $VC_UNIQUE_CODE;
                             $resp->message = "Posp unique code created successfully.";
                      }else{
                         $resp->message = $xml_post_string;//$data['Body']['MapPospPortalResponse']['MapPospPortalResult']; 
                      }
                  }else{
                      $resp->message = "Internal error";
                  }
                //  return $resp;
             echo '<pre>', htmlentities($xml_post_string), '</pre>';
    }
    
    
     public function testany(Request $request){
        
        $filename = "QUOTE.pdf";
         
           $enQ=$request->param;
            $policy= DB::table('app_quote')->where('enquiry_id',$enQ)->first();
            $logo = public_path('/site_assets/logo/site_logo.png');//.config('custom.site_logo'));
            $arrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $type = pathinfo($logo, PATHINFO_EXTENSION);
            $avatarData = file_get_contents($logo, false, stream_context_create($arrContextOptions));
            $avatarBase64Data = base64_encode($avatarData);
            $data['logo'] = 'data:image/' . $type . ';base64,' . $avatarBase64Data;
            
            $partner = DB::table('our_partners')->where('shortName',$policy->provider)->first();
            $partnerlogo = public_path('/assets/partners/HDFC-Ergo-logo.png');//public_path('/ assets/partners/'.$partner->logo);//.config('custom.site_logo'));
          
            $type1 = pathinfo($partnerlogo, PATHINFO_EXTENSION);
            $avatarData1 = file_get_contents($partnerlogo, false, stream_context_create($arrContextOptions));
            $avatarBase64Data1 = base64_encode($avatarData1);
            $data['partnerlogo'] = 'data:image/' . $type1 . ';base64,' . $avatarBase64Data1;
          
           // $data['quote'] = $policy;
         
         Filepdf::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
         $pdf = Filepdf::loadView('insurance.partnerQuote',$data);
         return $pdf->download('Quote.pdf');
    
               //$sql= DB::table('cities_list')->where('state_id',38)->get();
               //foreach($sql as $ct){
                  // DB::table('cities')->insertGetId(['name'=>$ct->name,'state_id'=>31]);
              // }
          
                //  $sql= DB::table('policy_saled')->select('sp_id','agent_id','policy_no','date')
                //               ->whereMonth('date', 05)->whereYear('date', 2022);
               
                     
                //       $Sales = $sql->get();
                //          foreach($Sales as $each){
                //              print_r($each);
                //              echo "<br/><hr/><br/>";
                //              $amts = $this->orc->calculateAndSave($each->policy_no);
                //          }
                         
                       // $agents = DB::table('agents')->where('status', 'Inforce')->get();
                        // foreach($agents as $posp){
                        //     $SUM = 0;$ID = $posp->id;
                        //     if($posp->userType=="SP"){
                        //          // SELECT sum(if(pospId = spId,(pospDst+spDst),0)) as Amount1, sum(if(pospId != spId,(spDst),0)) as Amount2 FROM `policy_payouts`  WHERE (pospId = 19 && spId =19) OR  (pospId != 19 && spId =19)
                        //          $sm = DB::table('policy_payouts')->select(DB::raw('sum(if(pospId = spId,(pospDst+spDst),0)) as Amount1, sum(if(pospId != spId,(spDst),0)) as Amount2'))
                        //                     ->where(function($query) use ($ID){
                        //                          $query->where('pospId', '=', $ID);
                        //                          $query->where('spId', '=', $ID);
                        //                      })
                        //                      ->orWhere(function($query) use ($ID){
                        //                          $query->where('pospId', '!=', $ID);
                        //                          $query->where('spId', '=', $ID);
                        //                      })->first();
                                             
                        //         $Amt1 = ($sm->Amount1)?$sm->Amount1:0;
                        //         $Amt2 = ($sm->Amount2)?$sm->Amount2:0;
                        //         $SUM = ($Amt1 + $Amt2);
                        //     }else{
                        //          $SUM = DB::table('policy_payouts')->where('pospId',$posp->id)->sum('pospDst');
                        //     }
                            
                        //     $ps = explode('/',$posp->posp_ID);
                        //     $ppiArr = ['invoiceNo'=>'INV'.date('Ym').$ps[2],
                        //               'spId'=>($posp->userType=="SP")?$posp->id:0,
                        //               'pospId'=>($posp->userType=="POSP")?$posp->id:0,
                        //               'invoiceDate'=>date('Y-m-d H:i:s'),
                        //               'totalAmount'=>$SUM,
                        //               'invMonth'=>'05', 
                        //               'invYear'=>'2022'];
                        //     DB::table('policy_payout_invoice')->insertGetId($ppiArr); 
                        //  }
                         
            $plllannsn =  DB::table('temp_plan_key_features')->get();
               die;       
          foreach($plllannsn as $rr){
                  $INSERT = [];
                  $INSERT[]=['featuresKey'=>$rr->key_code,'val'=>$rr->DIGIT_SILVER,'plan_id'=>3];
                  $INSERT[] =['featuresKey'=>$rr->key_code,'val'=>$rr->DIGIT_GOLD,'plan_id'=>2];
                  $INSERT[] =['featuresKey'=>$rr->key_code,'val'=>$rr->DIGIT_DIAMOND,'plan_id'=>1];
                  $INSERT[] = ['featuresKey'=>$rr->key_code,'val'=>$rr->OptimaSecure,'plan_id'=>5];
                  $INSERT[] =['featuresKey'=>$rr->key_code,'val'=>$rr->CARE,'plan_id'=>6];
                  $INSERT[]=['featuresKey'=>$rr->key_code,'val'=>$rr->CAREADVANTAGE,'plan_id'=>17];
                  $INSERT[]=['featuresKey'=>$rr->key_code,'val'=>$rr->RPRT06SBSF,'plan_id'=>10];
                  $INSERT[]=['featuresKey'=>$rr->key_code,'val'=>$rr->RPLS06SBSF,'plan_id'=>9];
                  DB::table('plans_features')->insert($INSERT);
                  echo "<br/><hr/><br/>";
              }
         
        //  $Sales = DB::table('policy_saled')
        //               ->where('MailStatus', 'No')
        //               ->get();
        //  foreach($Sales as $each){
        //       $this->policymail->calculateAndSendMail($each->policy_no);
        //       //Log::channel('cronlog')->info($each->policy_no.'- Commision Calculate');
        //  }
        
         //  $path =  public_path('/site_assets/financers.json');
        //   $content = json_decode(file_get_contents($path), true);
        
        // $results =  $content['Data'];
         // foreach($results as $res){ 
            // print_r($res);
            // DB::table('financiers')->insertGetId(['name'=>$res['Name'],'hdfcErgoCode'=>$res['Value']]);
             	 
       //  }
        
        
        // $temp_vehicles_car_hdfcMap  = DB::table("temp_vehicles_car_hdfcMap")->get();
        //   foreach($temp_vehicles_car_hdfcMap as $row){
        //       DB::table("vehicle_variant_car")->where('digit_code',$row->digit_code)->update(['hdfcErgo_code'=>$row->hdfcErgo_code]);  
        //   }
        //   $path =  public_path('/js/hdfc-car-model.json');
        //   $content = json_decode(file_get_contents($path), true);
        
        //   $results =  $content['data'];
        //   foreach($results as $res){
        //      if(DB::table('temp_hdfc_car_model')->where('ModelId', $res['ModelId'])->doesntExist()){
        //         DB::table('temp_hdfc_car_model')->insertGetId(['MakeId'=>$res['MakeId'],'ModelId'=>$res['ModelId'],'ModelName'=>$res['ModelName'],
        //                                                       'VariantName'=>$res['VariantName'],'FuelType'=>$res['FuelType'], 
        //                                                       'CubicCapacity'=> $res['CubicCapacity']]);
        //           print_r($res);
        //           echo "</br></hr></br>";
        //     }
             
        //   }
        
        
    //   $data = getMailSmsInfo(6,"POSP_FEE_PAID");
    //   print_r($data);
       // sendNotification($data);
        //  $template = ['title' => 'TEST-ANY',"subtitle"=>"TEST",'body'=>$data->email->body];  
        //   return View::make('emailTemplate.frame')->with($template);
        
        //  $states = DB::table("states")->get();
        //  foreach($states as $st){
        //      $isExist = DB::table("pincode_master12")->where('State',$st->name)->count();
        //  }
        
        //   $cities = DB::table("cities")->get();
        //      foreach($cities as $ct){
        //          $isExist = DB::table("cities")->where('id',$ct->id)->update(['name'=>ucfirst(strtolower($ct->name))]);
        //      }
        
        
       //  $pinmasters  = DB::table("pincode_masters")->get();
        //  foreach($pinmasters as $row){
        //         $cnt = DB::table("cities")->where('name',ucfirst(strtolower($row->District)))->count();
        //         if($cnt){
        //             $ct = DB::table("cities")->where('name',ucfirst(strtolower($row->District)))->first();
        //              DB::table("pincode_masters")->where('id',$row->id)->update(['city_id'=>$ct->id]);
        //         }
        //      $isExist = DB::table("cities")->where('state_id',$row->state_id)->where('name',$row->District)->count();
        //      $cityID =0;
        //      if($isExist){
        //         $cityID =  DB::table("cities")->where('state_id',$row->state_id)->where('name',$row->District)->value('id');
        //      }else{
        //          $cityID = DB::table('cities')->insertGetId(['state_id' =>$row->state_id, 'name' =>$row->District]);
        //      }
             
        //      print_r($row);
        //      echo "</br></hr></br>";
         //}
        
        //  $rto_masters = DB::table("rto_master")->get();
        //  foreach($rto_masters as $row){
        //       DB::table("rtoMaster")->where('rtoCode',$row->region_code)->update(['hdfcErgoCodeTw'=>$row->hdfcErgoRtoCode]);
        //  }
        
        //  $path =  public_path('/site_assets/hdfcCity.json');
        //  $content = json_decode(file_get_contents($path), true);
        
        //  $results =  $content['results'];
        //  foreach($results as $res){
        //      if(DB::table('cities')->where('hdfcErgoCode', $res['CityId'])->doesntExist()) {
        //           DB::table('cities')->whereRaw('LOWER(name) = ?', [strtolower($res['CityName'])])->update(['hdfcErgoCode' => $res['CityId']]);
        //           print_r($res);
        //           echo "</br></hr></br>";
        //     }
             
        //  }
        
        //  $rtos = DB::table("rtoMaster")->where('city_id',0)->get();
        //  foreach($rtos as $res){
        //      DB::table("rtoMaster")->where('id',$res->id)->update(['rtoCode'=>trim($res->rtoCode)]);
            //  $strArr = explode(',',$res->text);
            //  $str = $strArr[0];
            //   $cnt  =DB::table('cities')->whereRaw('LOWER(name) = ?', [strtolower($str)])->count();
            //   if($cnt){
            //          $f=  DB::table('cities')->whereRaw('LOWER(name) = ?', [strtolower($str)])->first();
            //           DB::table("rtoMaster")->where('id',$res->id)->update(['city_id'=>$f->id]);
                   
                     
            //      }
                 
            // print_r($res);
            //echo "</br></hr></br>";
       //  }
       
       
        //  $path =  public_path('/js/hdfc-car-model.json');
        //  $content = json_decode(file_get_contents($path), true);
        
        //  $results =  $content['results'];
        //  foreach($results as $res){
        //      if(DB::table('temp_hdfc_city_code')->where('cityCode', $res['CityId'])->doesntExist()) {
        //          DB::table('temp_hdfc_city_code')->insertGetId(['cityCode' =>$res['CityId'],'CityName' =>$res['CityName']]);
        //           print_r($res);
        //           echo "</br></hr></br>";
        //     }
             
        //  }
        
        
    //   $temps = DB::table("temp_state_city_rto")->whereBetween('id', [783, 795])->get();
    //     foreach($temps as $res){
            
                //   print_r($res);
                //   echo "</br></hr></br>";
            
            // if(DB::table('rtoMaster')->where('rtoCode', $res->rto)->doesntExist()) {
            //       DB::table('rtoMaster')->insertGetId(['rtoCode'=>$res->rto,'text'=>$res->city,'city_id'=>$res->cityId,'hdfcErgoCodeTw' =>$res->rtoCodeTw,'hdfcErgoCodeCar' =>$res->rtoCodeCar]);
            // }
            // if(DB::table('cities')->where('name', ucfirst(strtolower($res->city)))->doesntExist()) {
            //      $cityId =  DB::table('cities')->insertGetId(['hdfcErgoCode' =>$res->cityCode,'name' =>ucfirst(strtolower($res->city))]);
            // }else{
            //     $cityId = DB::table('cities')->where('name', ucfirst(strtolower($res->city)))->value('id');
            // }
            // DB::table("temp_state_city_rto")->where('id',$res->id)->update(['cityId'=>$cityId]);
            
            // if(DB::table('rtoMaster')->where('rtoCode', $res->rto)->doesntExist()) {
            //       $text =  ucfirst(strtolower($res->city));
            //       DB::table('rtoMaster')->insertGetId(['rtoCode'=>$res->rto,'text'=>$text,'city_id'=>$res->cityId,'hdfcErgoCodeTw' =>$res->rtoCodeTw,'hdfcErgoCodeCar' =>$res->rtoCodeCar]);
            // }
           // DB::table("temp_state_city_rto")->where('id',$res->id)->update(['cityId'=>$cityId]);
           
            // if(DB::table('states')->where('hdfcErgoCode', ucfirst(strtolower($res->stateCode)))->doesntExist()) {
            //      $stateId =  DB::table('states')->insertGetId(['hdfcErgoCode' =>$res->stateCode,'name' =>ucfirst(strtolower($res->state))]);
            // }else{
            //      $stateId = DB::table('states')->where('hdfcErgoCode', $res->stateCode)->value('id');
            // }
            // DB::table("temp_state_city_rto")->where('id',$res->id)->update(['stateId'=>$stateId]);
            // DB::table("cities")->where('id',$res->cityId)->update(['state_id'=>$stateId]);
            
       // }
       
       
        // $temps = DB::table("medical_questions")->whereBetween('id', [58, 69])->get();
        // foreach($temps as $res){ 
        //     $childs = DB::table("medical_questions")->where('parentId', 57)->get();
        //     foreach($childs as $ch){
        //         $ch->parentId = $res->id;
        //         $array = json_decode(json_encode($ch), true);
        //         unset($array["id"]);
        //         DB::table('medical_questions')->insertGetId($array);
        //     }
        // }
        
    }

    
    
    
   
}