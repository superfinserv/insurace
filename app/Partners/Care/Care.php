<?php
namespace App\Partners\Care;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Auth;


use App\Partners\Care\CareBasic;
use App\Partners\Care\CareSmart;
use App\Partners\Care\CareClassic;
use App\Partners\Care\CareAdvantage;

class Care {
    protected $classic;
    protected $basic;
    
    public function __construct(){
         $this->classic = new CareClassic;
         $this->basic = new CareBasic;
         $this->smart = new CareSmart;
         $this->adv   = new CareAdvantage;
    }
    
    function CareAuth(){
          $request =['api_key'=>config('mediclaim.CARE.ApiKey'),'auth_secret'=>config('mediclaim.CARE.Authsecret')];
          $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json']
            ]);
            
            $clientResp = $client->post(config('mediclaim.CARE.AuthUrl'),
                ['body' => json_encode($request)]
            );
         
          $response = $clientResp->getBody()->getContents();
          $result = json_decode($response);
          $res = ["status"=>$result->status,'token'=>isset($result->data->accessToken)?$result->data->accessToken:""];
          $token = isset($result->data->accessToken)?$result->data->accessToken:"";
          return $token;
        
    }
    
    function getQuickPlans($range,$params,$devicetoken,$policytyp,$pln){
         
           $authToken=$this->CareAuth();//Authentication
          
           $child = $params['total_child'];
           $adult = $params['total_adult'];
          
           $rangeARR =[];
          
          if($range['start']==2){  $rangeARR = ['3'];}
          if(isset(Auth::guard('agents')->user()->posp_ID)){
              if($range['start']==4){ $rangeARR = ['5'];}
          }else{
            if($range['start']==4){  $rangeARR = ['5','7'];}
            if($range['start']==10){ $rangeARR = ['10','15'];}
            if($range['start']==16){ $rangeARR = ['20','25'];}
            if($range['start']==26){ $rangeARR = ['30','40','50','60','75','100'];}
          }
          
          
          $_plans =[];$count=0;
          
          foreach($rangeARR as $sumInsured){
              // 
                if(isset(Auth::guard('customers')->user()->id) &&  in_array($sumInsured, ['5','7','10','15'])  && (($adult+$child)>1) && (($adult+$child)<=5) && ($child<=3) && $policytyp=="FL"){
                    $careClassic = $this->classic->calculatePremium(json_decode(json_encode($params)),$authToken,$sumInsured,$devicetoken,$policytyp);
                    if($careClassic['status']){$count++; $_plans[] =$careClassic['data'];}
                }
                
                if($sumInsured<76){
                  $careBasic = $this->basic->calculatePremium(json_decode(json_encode($params)),$authToken,$sumInsured,$devicetoken,$policytyp);
                  if($careBasic['status']){$count++; $_plans[] =$careBasic['data'];}
                }
                if($sumInsured<41){
                   $careSmart = $this->smart->calculatePremium(json_decode(json_encode($params)),$authToken,$sumInsured,$devicetoken,$policytyp);
                   if($careSmart['status']){$count++; $_plans[] =$careSmart['data'];}
                }
                
               if(in_array($sumInsured, ['25','50','100']) && (($policytyp=="FL") || (($adult+$child)==1 && $policytyp=="IN"))){
                $careAdv = $this->adv->calculatePremium(json_decode(json_encode($params)),$authToken,$sumInsured,$devicetoken,$policytyp);
                if($careAdv['status']){$count++; $_plans[] =$careAdv['data'];}
               }
                 
            }//foreach Range
           
         if($count>0){   
              $result['status'] ="success";
              $result['count'] =$count;
              $result['plans'] =$_plans;
         }else{
            $result['status'] ="error";
            $result['count'] =$count;
            $result['plans'] =[]; 
         }
         return $result; 
                
     }
     
    function recalculateQuickPlan($enqId,$termYear,$sum,$addOn){
          $authToken=$this->CareAuth();//Authentication
          $enQ = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqId)->first();
          if($enQ->product=="CARECLASSIC"){
               $careClassic = $this->classic->recalculatePremium($enqId,$authToken,$termYear,$sum,$addOn);
          }else if($enQ->product=="CARESMART"){
               $careBasic = $this->smart->recalculatePremium($enqId,$authToken,$termYear,$sum,$addOn);
          }else if($enQ->product=="CAREADVANTAGE"){
               $careBasic = $this->adv->recalculatePremium($enqId,$authToken,$termYear,$sum,$addOn);
          }else{
               $careBasic = $this->basic->recalculatePremium($enqId,$authToken,$termYear,$sum,$addOn);
          }
    }
    
    function createProposal($enqId){
          $enQ = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$enqId)->first();
          if($enQ->product=="CARECLASSIC"){
              $careClassic = $this->classic->createPolicy($enqId);
              return $careClassic;
          }else if($enQ->product=="CARESMART"){
               $careSmart = $this->smart->createPolicy($enqId);
               return  $careSmart;
          }else if($enQ->product=="CAREADVANTAGE"){
               $careSmart = $this->adv->createPolicy($enqId);
               return  $careSmart;
          }else{
              $careBasic = $this->basic->createPolicy($enqId);
              return  $careBasic;
          }
    }
    
    
     //savePDF
    function savePDF($enquiryID,$policyNumber){
          $req =   new \stdClass();
          $inner =   new \stdClass();
          $inner->policyNum =$policyNumber;
          $inner->ltype ="POLSCHD";
          $req->intFaveoGetPolicyPDFIO = $inner;
        
          
            
                
         
        
           try{
               
               $client = new Client([
                  'headers' => [ 'Content-Type' => 'application/json',"agentId"=>config('mediclaim.CARE.agentId'),"AppId"=>config('mediclaim.CARE.AppId'),
                                 "signature"=>config('mediclaim.CARE.signature'),"timeStamp"=>config('mediclaim.CARE.timestamp')]
                ]);
                $clientResp = $client->post(config('mediclaim.CARE.pdf'),
                    ['body' => json_encode($req)]
                 );     
                 
                  $response = $clientResp->getBody()->getContents();
                  $output = json_decode($response);
              //print_r($output);die;
                  if(isset($output->responseData->status) && $output->responseData->status==1){
                      $decoded = base64_decode($output->intFaveoGetPolicyPDFIO->dataPDF);
                      //$file = dirname(getcwd())."/public_html/insurance/customers/policy/pdf/Religare_".$policyNumber.".pdf";
                      $file = getcwd()."/public/assets/customers/policy/pdf/CareHealth_".$policyNumber.".pdf";
                      file_put_contents($file, $decoded);
                      $filename = "CareHealth_".$policyNumber.".pdf";
                      $result = ['status'=>'success','filename'=>$filename];
                  }else{
                      $result = ['status'=>'error','filename'=>"",'message'=>$output->intFaveoGetPolicyPDFIO->policyPDFStatus];
                  }
                return $result;  
           } catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
              
                return ['status' => false,'filename'=>"", 'message' => $jsonRes->error->message];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
               // print_r($responseBodyAsString);die;
                return ['status' => false,'filename'=>"" ,'message' => $responseBodyAsString];
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $jsonRes = json_decode($responseBodyAsString);
                return ['status' =>false,'filename'=>"", 'message' => $jsonRes->error->message];
            }
           
    
}

   // Get Status
     function GetPolicyStatus($enquiryID,$proposalNumber){
        
          $req =   new \stdClass();
          $inner =   new \stdClass();
          $inner->proposalNum =$proposalNumber;
          $req->intGetPolicyStatusIO = $inner;
        
                $client = new Client([
                  'headers' => [ 'Content-Type' => 'application/json',"AppId"=>config('mediclaim.CARE.AppId'),"signature"=>config('mediclaim.CARE.signature'),"timeStamp"=>config('mediclaim.CARE.timestamp')]
                ]);
                $clientResp = $client->post(config('mediclaim.CARE.policyStatus'),
                    ['body' => json_encode($request)]
                 );  
                 
          $response = $clientResp->getBody()->getContents();
          $output = json_decode($response);
         
          
          try{
              
                  if(isset($output->responseData->status) && $output->responseData->status==1){
                      $result = ['status'=>'success','message'=>$output->intGetPolicyStatusIO->policyStatus];
                  }else{
                      $result = ['status'=>'error','Message'=>$output->responseData->message];
                  }
          }catch(Exception $e) {
                  $result = ['status'=>'error','filename'=>"",'message'=>$e->getMessage()];
          }
           return $result;
           
    }
}