<?php
namespace App\Utils;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ErrorException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Artisaninweb\SoapWrapper\SoapWrapper;

use App\Model\Agents;
class Posp {
    
    public function __construct(){
        
    }
   
   
   function profileCompleteData($id){
             
               $complete=Agents::select('*')->where(function ($query) {
                                    $query->whereNotNull('name')
                                          ->whereNotNull('email')
                                          ->whereNotNull('mobile')
                                          ->whereNotNull('profile')
                                          ->whereNotNull('city')
                                          ->whereNotNull('pincode')
                                          ->whereNotNull('address')
                                          ->whereNotNull('state')
                                          ->whereNotNull('sex')
                                          ->whereNotNull('marital_status')
                                          ->whereNotNull('educational_qualification')
                                          ->whereNotNull('education_certificate')
                                          ->whereNotNull('bank_name')
                                          ->whereNotNull('account_holder_name')
                                          ->whereNotNull('account_number')
                                          ->whereNotNull('ifsc_code')
                                          ->whereNotNull('passbook_statement')
                                          ->whereNotNull('pan_card_number')
                                          ->whereNotNull('pan_card')
                                          ->whereNotNull('adhaar_card_number')
                                          ->whereNotNull('adhaar_card')
                                          ->whereNotNull('adhaar_card_back');
                                          
                                })->where('id', $id)
                            ->count();
                            
                $pData=Agents::select('*')->where(function ($query) {
                                    $query->whereNotNull('name')
                                          ->whereNotNull('email')
                                          ->whereNotNull('mobile')
                                          ->whereNotNull('profile')
                                          ->whereNotNull('city')
                                          ->whereNotNull('pincode')
                                          ->whereNotNull('address')
                                          ->whereNotNull('state')
                                          ->whereNotNull('sex')
                                          ->whereNotNull('marital_status');
                                          
                                })->where('id', $id)
                            ->count();
                            
                $eData=Agents::select('*')->where(function ($query) {
                                    $query->whereNotNull('educational_qualification')
                                          ->whereNotNull('education_certificate');
                                          
                                })->where('id', $id)
                            ->count();
                            
                $bData=Agents::select('*')->where(function ($query) {
                                    $query->whereNotNull('bank_name')
                                          ->whereNotNull('account_holder_name')
                                          ->whereNotNull('account_number')
                                          ->whereNotNull('ifsc_code')
                                          ->whereNotNull('passbook_statement');
                                          
                                })->where('id', $id)
                            ->count();
                            
                $dData=Agents::select('*')->where(function ($query) {
                                    $query->whereNotNull('pan_card_number')
                                          ->whereNotNull('pan_card')
                                          ->whereNotNull('adhaar_card_number')
                                          ->whereNotNull('adhaar_card')
                                          ->whereNotNull('adhaar_card_back');
                                          
                                })->where('id', $id)
                            ->count();
                            
             $rowdata=Agents::find($id);
             
             $maximumPoints = 100;
             $point_p = 0;$point_b = 0;$point_d = 0;$point_e = 0;$point = 0;
             $pInfo = 10; $bankInfo=20; $docInfo = 20;$eduInfo =50;$each=4.5454545455;
             
             $point += ($rowdata->name!=NULL && $rowdata->name!="")?$each:0;
             $point += ($rowdata->email!=NULL && $rowdata->email!="")?$each:0;
             $point += ($rowdata->mobile!=NULL && $rowdata->mobile!="")?$each:0;
             $point += ($rowdata->profile!=NULL && $rowdata->profile!="")?$each:0;
             $point += ($rowdata->city!=NULL && $rowdata->city!="")?$each:0;
             $point += ($rowdata->pincode!=NULL && $rowdata->pincode!="")?$each:0;
             $point += ($rowdata->address!=NULL && $rowdata->address!="")?$each:0;
             $point += ($rowdata->state!=NULL && $rowdata->state!="")?$each:0;
             $point += ($rowdata->sex!=NULL && $rowdata->sex!="")?$each:0;
             $point += ($rowdata->marital_status!=NULL && $rowdata->marital_status!="")?$each:0;
             
             $point += ($rowdata->bank_name!=NULL && $rowdata->bank_name!="")?$each:0;
             $point += ($rowdata->account_holder_name!=NULL && $rowdata->account_holder_name!="")?$each:0;
             $point += ($rowdata->account_number!=NULL && $rowdata->account_number!="")?$each:0;
             $point += ($rowdata->ifsc_code!=NULL && $rowdata->ifsc_code!="")?$each:0;
             $point += ($rowdata->passbook_statement!=NULL && $rowdata->passbook_statement!="")?$each:0;
             
             $point += ($rowdata->pan_card_number!=NULL && $rowdata->pan_card_number!="")?$each:0;
             $point += ($rowdata->pan_card!=NULL && $rowdata->pan_card!="")?$each:0;
             $point += ($rowdata->adhaar_card_number!=NULL && $rowdata->adhaar_card_number!="")?$each:0;
             $point += ($rowdata->adhaar_card!=NULL && $rowdata->adhaar_card!="")?$each:0;
             $point += ($rowdata->adhaar_card_back!=NULL && $rowdata->adhaar_card_back!="")?$each:0;
             
             $point += ($rowdata->educational_qualification!=NULL && $rowdata->educational_qualification!="")?$each:0;
             $point += ($rowdata->education_certificate!=NULL && $rowdata->education_certificate!="")?$each:0;
            
             $point_p += ($rowdata->name!=NULL && $rowdata->name!="")?$pInfo:0;
             $point_p += ($rowdata->email!=NULL && $rowdata->email!="")?$pInfo:0;
             $point_p += ($rowdata->mobile!=NULL && $rowdata->mobile!="")?$pInfo:0;
             $point_p += ($rowdata->profile!=NULL && $rowdata->profile!="")?$pInfo:0;
             $point_p += ($rowdata->city!=NULL && $rowdata->city!="")?$pInfo:0;
             $point_p += ($rowdata->pincode!=NULL && $rowdata->pincode!="")?$pInfo:0;
             $point_p += ($rowdata->address!=NULL && $rowdata->address!="")?$pInfo:0;
             $point_p += ($rowdata->state!=NULL && $rowdata->state!="")?$pInfo:0;
             $point_p += ($rowdata->sex!=NULL && $rowdata->sex!="")?$pInfo:0;
             $point_p += ($rowdata->marital_status!=NULL && $rowdata->marital_status!="")?$pInfo:0;
             
             $point_b += ($rowdata->bank_name!=NULL && $rowdata->bank_name!="")?$bankInfo:0;
             $point_b += ($rowdata->account_holder_name!=NULL && $rowdata->account_holder_name!="")?$bankInfo:0;
             $point_b += ($rowdata->account_number!=NULL && $rowdata->account_number!="")?$bankInfo:0;
             $point_b += ($rowdata->ifsc_code!=NULL && $rowdata->ifsc_code!="")?$bankInfo:0;
             $point_b += ($rowdata->passbook_statement!=NULL && $rowdata->passbook_statement!="")?$bankInfo:0;
             
             $point_d += ($rowdata->pan_card_number!=NULL && $rowdata->pan_card_number!="")?$docInfo:0;
             $point_d += ($rowdata->pan_card!=NULL && $rowdata->pan_card!="")?$docInfo:0;
             $point_d += ($rowdata->adhaar_card_number!=NULL && $rowdata->adhaar_card_number!="")?$docInfo:0;
             $point_d += ($rowdata->adhaar_card!=NULL && $rowdata->adhaar_card!="")?$docInfo:0;
             $point_d += ($rowdata->adhaar_card_back!=NULL && $rowdata->adhaar_card_back!="")?$docInfo:0;
             
             $point_e += ($rowdata->educational_qualification!=NULL && $rowdata->educational_qualification!="")?$eduInfo:0;
             $point_e += ($rowdata->education_certificate!=NULL && $rowdata->education_certificate!="")?$eduInfo:0;
             
             $personal = round(($point_p*100)/100);
             $bank = round(($point_b*100)/100);
             $document = round(($point_d*100)/100);
             $education = round(($point_e*100)/100);
             
             $percentage = round(($point*100)/100);
             
             $arr = ['iscomplete'=>$complete,'complete'=>$percentage,'count'=>$complete,
                     "ispersonal"=>$pData,"personal"=>$personal,
                     'isbank'=>$bData,'bank'=>$bank,
                     'isdocument'=>$dData, 'document'=>$document,
                     "iseducation"=>$eData, "education"=>$education,
                     "payment_status"=>$rowdata->payment_status,"isProceedSign"=>$rowdata->isProceedSign,
                     "isVerified"=>$rowdata->isVerified
                     ];
             
               return $arr;
             
    }
   
   function GeneratePospId($agentId){
            $agInfo = DB::table('agents')->where('id',$agentId)->first();
            if($agInfo->cert_serial!="" && $agInfo->cert_serial>0){
                DB::table('agents')->where('id', $agentId)->update(['cert_serial' =>0]);
            }
            if($agInfo->userType=="POSP"){
                    $serial = DB::table('agents')->where('userType','POSP')->max('cert_serial');
                    $num = $serial+1; 
                    $v = 10000+$num;
                    $pospID  = (config('custom.pospID_prefix')!="")?config('custom.pospID_prefix').$v:"SF/POSP/A".$v;
                     DB::table('agents')
                        ->where('id', $agentId)
                        ->update(['cert_serial' =>$num,'posp_ID'=>$pospID]);
                    return $pospID;
            }else{
                    $serial = DB::table('agents')->where('userType','SP')->max('cert_serial');
                    $num = $serial+1; 
                    $v = 10000+$num;
                    $spID  = "SF/SP/A".$v;
                     DB::table('agents')
                        ->where('id', $agentId)
                        ->update(['cert_serial' =>$num,'posp_ID'=>$spID]);
                    return $spID;   
            }
           
           
    }
    
    
    
   function GenerateApplicationId($userType){
           $number = DB::table('agents')->where('userType',$userType)->count();
           return 'SF/'.$userType.'/T'.str_pad($number+1, 6, 0, STR_PAD_LEFT);
        
            // $serial = DB::table('agents')->max('id');
            // $rand = mt_rand(10000, 99999); // better than rand()
            // $num = $serial+1; 
            // $number = "SF-POSP-".date('YmdHis').($rand+$num);
            // return $number;
    }
    
    function createPOSPcode($row){
             $resp = new \stdClass(); 
             $resp->status = false;$resp->code = ""; $resp->message = "";
             
        $VC_UNIQUE_CODE =$row->posp_ID;
        $xml_post_string = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                <soap:Body>
                                    <MapPospPortal xmlns="http://tempuri.org/">
                                        <objposp>
                                            <DAT_END_DATE>9/05/2022</DAT_END_DATE>
                                            <NUM_MOBILE_NO>'.$row->mobile.'</NUM_MOBILE_NO>
                                            <VC_ADHAAR_CARD>'.$row->adhaar_card_number.'</VC_ADHAAR_CARD>
                                            <VC_BRANCH_CODE>Mumbai</VC_BRANCH_CODE>
                                            <VC_EMAILID>'.$row->email.'</VC_EMAILID>
                                            <VC_INTERMEDIARY_CODE>202042688368</VC_INTERMEDIARY_CODE>
                                            <VC_LANDLINE>8918154084</VC_LANDLINE>
                                            <VC_LOCATION>Mumbai</VC_LOCATION>
                                            <VC_NAME>'.$row->name.'</VC_NAME>
                                            <VC_PAN_CARD>'.$row->pan_card_number.'</VC_PAN_CARD>
                                            <VC_REG_NO>'.$row->application_no.'</VC_REG_NO>
                                            <VC_STATE>Karnataka</VC_STATE>
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
                    
                  // print_r($data);
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
                  return $resp;
             //echo '<pre>', htmlentities($result), '</pre>';
            
    }
    
    
    function pospVerifiedData($id){
        $user = DB::table('agents')->where('id',$id)->first();
       // $filename = str_replace("/","_",$user->posp_ID).uniqid();
        $filename = "SF-".str_replace("/","",$user->posp_ID).".pdf";
        // $path = "public/assets/agents/pdf/certificate";
        // if(!File::exists($path)) {
        //     File::makeDirectory($path, $mode = 0755, true, true);
        // } 
       
            $logo = get_site_settings('site_logo');
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
            
            $profile = "public/assets/agents/profile/".$user->profile;
            $arrContextOptions1=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $type1 = pathinfo($profile, PATHINFO_EXTENSION);
            $avatarData1 = file_get_contents($profile, false, stream_context_create($arrContextOptions1));
            $avatarBase64Data1 = base64_encode($avatarData1);
            $data['profile'] = 'data:image/' . $type1 . ';base64,' . $avatarBase64Data1;
         $data['user'] = $user;
         $data['user_city'] = ($user->city!="" && $user->city>0)?DB::table('cities_list')->where('id',  $user->city)->value('name'):"";
         $data['user_state'] = ($user->state!="" && $user->state>0)?DB::table('states_list')->where('id',  $user->state)->value('name'):"";
         
         PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
         $pdf = PDF::loadView('utils.pdf.posp_details_pdf',$data);
       
         $pData = ['row'=>$pdf->output(),'name'=>$filename];
         return  $pData;
    }
    
}