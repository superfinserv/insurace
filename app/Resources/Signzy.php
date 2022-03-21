<?php
namespace App\Resources;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Auth;


class Signzy {
    
    public function __construct(){}
    
    function GetSignzyAuth(){
             $resp = new \stdClass(); 
             $resp->status = false;
             $resp->token = "";
             $resp->id = "";
            try{ 
                 $_request = new \stdClass(); 
                 $_request->username = "Superfinserv_Test";
                 $_request->password = "P2LoVjhgOcOECVVjlbh";
                
               $client = new Client([
                    'headers' => [ 'Content-Type' => 'application/json']
                ]);
                
                $clientResp = $client->post('https://preproduction.signzy.tech/api/v2/patrons/login',
                    ['body' => json_encode($_request)]
                );
                $result = $clientResp->getBody()->getContents();
                $authData = json_decode($result);
                if(isset($authData->id)){
                      $resp->status = true;
                      $resp->token = $authData->id;
                      $resp->id =$authData->userId;
                }else{
                      $resp->status = false;
                }
                return $resp;
            }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $resp->status = false;
                return $resp;
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $resp->status = false;
                return $resp;
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $resp->status = false;
                return $resp;
            }
    }
    
    function GetVehicleDetails($vehicleNumber){
        
            try{
                $auth = $this->GetSignzyAuth();
                $_request = new \stdClass(); 
                $_request->task = "detailedSearch";
                
                $essentials =  new \stdClass(); 
                $essentials->vehicleNumber = $vehicleNumber;
                $_request->essentials = $essentials;
                
               $client = new Client([
                    'headers' => [ 'Content-Type' => 'application/json','Authorization'=>$auth->token]
                ]);
                
                $clientResp = $client->post('https://preproduction.signzy.tech/api/v2/patrons/'.$auth->id.'/vehicleregistrations',
                    ['body' => json_encode($_request)]
                );
                $result = $clientResp->getBody()->getContents();
                return json_decode($result);
            }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString);
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString); 
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString);
            }
    }
    
    function FetchPanDetails($panNumber){
        
            try{
                $_request = new \stdClass(); 
                $_request->task = "fetch";
                
                $essentials =  new \stdClass(); 
                $essentials->number = $panNumber;
                $_request->essentials = $essentials;
                
               $client = new Client([
                    'headers' => [ 'Content-Type' => 'application/json','Authorization'=>"NXFDvNFtkGiXvxZIe5SLQiUeFG38rDf227O1XeHKfARFK68a5PWXTGg7EjsO0aav"]
                ]);
                
                $clientResp = $client->post('https://preproduction.signzy.tech/api/v2/patrons/621f6be1dfc52fe36b9aac76/panv2',
                    ['body' => json_encode($_request)]
                );
                $result = $clientResp->getBody()->getContents();
                return json_decode($result);
            }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString);
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString); 
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString);
            }
    }
    
    function CreateDigiLockerUrl(){ //Digilocker Create Url
        
            try{
                $_request = new \stdClass(); 
                $_request->task = "url";
                
                $essentials =  new \stdClass(); 
                
                $essentials->signup = false;
                $essentials->redirectUrl=  "https://pos.superfinserv.co.in/register";
                $essentials->redirectTime=  "5";
                $essentials->callbackUrl=  "https://pos.superfinserv.co.in";
                $_request->essentials = $essentials;
                
               $client = new Client([
                    'headers' => [ 'Content-Type' => 'application/json','Authorization'=>"NXFDvNFtkGiXvxZIe5SLQiUeFG38rDf227O1XeHKfARFK68a5PWXTGg7EjsO0aav"]
                ]);
                
                $clientResp = $client->post('https://preproduction.signzy.tech/api/v2/patrons/621f6be1dfc52fe36b9aac76/digilockers',
                    ['body' => json_encode($_request)]
                );
                $result = $clientResp->getBody()->getContents();
                return json_decode($result);
            }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString);
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString); 
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString);
            }
    }
    
    function GetEadhaarDetails($requestId){
        
            try{
                $_request = new \stdClass(); 
                $_request->task = "getEadhaar";
                
                $essentials =  new \stdClass(); 
                $essentials->requestId = $requestId;
                $_request->essentials = $essentials;
                
               $client = new Client([
                    'headers' => [ 'Content-Type' => 'application/json','Authorization'=>"NXFDvNFtkGiXvxZIe5SLQiUeFG38rDf227O1XeHKfARFK68a5PWXTGg7EjsO0aav"]
                ]);
                
                $clientResp = $client->post('https://preproduction.signzy.tech/api/v2/patrons/621f6be1dfc52fe36b9aac76/digilockers',
                    ['body' => json_encode($_request)]
                );
                $result = $clientResp->getBody()->getContents();
                return json_decode($result);
            }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString);
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString); 
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString);
            }
    }
    
    function GetDigiLockerUserDetails($requestId){
        
            try{
                $_request = new \stdClass(); 
                $_request->task = "getDetails";
                
                $essentials =  new \stdClass(); 
                $essentials->requestId = $requestId;
                $_request->essentials = $essentials;
                
               $client = new Client([
                    'headers' => [ 'Content-Type' => 'application/json','Authorization'=>"NXFDvNFtkGiXvxZIe5SLQiUeFG38rDf227O1XeHKfARFK68a5PWXTGg7EjsO0aav"]
                ]);
                
                $clientResp = $client->post('https://preproduction.signzy.tech/api/v2/patrons/621f6be1dfc52fe36b9aac76/digilockers',
                    ['body' => json_encode($_request)]
                );
                $result = $clientResp->getBody()->getContents();
                return json_decode($result);
            }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString);
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString); 
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString);
            }
    }
    
    function pullDocuments($docTyp,$IdNumber,$name,$requestId){
          try{
                $_request = new \stdClass(); 
                $_request->task = "pullDocuments";
                
                 $essentials =  new \stdClass(); 
                 $essentials->requestId = $requestId;
                 $essentials->docType= $docTyp;//"PANCR";
                 $essentials->name = $name;//"Praveen Patidar";
                 $essentials->panNumber =$IdNumber;
                 $_request->essentials = $essentials;
                
               $client = new Client([
                    'headers' => [ 'Content-Type' => 'application/json','Authorization'=>"NXFDvNFtkGiXvxZIe5SLQiUeFG38rDf227O1XeHKfARFK68a5PWXTGg7EjsO0aav"]
                ]);
                
                $clientResp = $client->post('https://preproduction.signzy.tech/api/v2/patrons/621f6be1dfc52fe36b9aac76/digilockers',
                    ['body' => json_encode($_request)]
                );
                $result = $clientResp->getBody()->getContents();
                $resp =  json_decode($result);
                if(isset($resp->id)){
                      $pdfUrl = $resp->result->pdf;
                      $content = file_get_contents($pdfUrl,true);
                      $fileName = "pan-".uniqid().'.pdf';
                      $storagePath = getcwd()."/public/assets/agents/pan_card/".$fileName;
                      file_put_contents($storagePath, $content);
                     return ['status'=>true,'filename'=>$fileName,'path'=>public_path('assets/agents/pan_card/'.$fileName)];
                }else{
                    return ['status'=>false,'filename'=>"",'path'=>""];
                }
            }catch (ConnectException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return ['status'=>false,'filename'=>"",'path'=>""];
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return ['status'=>false,'filename'=>"",'path'=>""];
            }catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return ['status'=>false,'filename'=>"",'path'=>""];
            }
    }
    
    function SaveUserAdharPhoto($userType,$photoUrl){
          $content = file_get_contents($photoUrl,true);
          $fileName = "user-image-".uniqid().'.png';
          $storagePath = getcwd()."/public/assets/agents/profile/".$fileName;
          file_put_contents($storagePath, $content);
          return ['status'=>true,'filename'=>$fileName,'path'=>public_path('assets/agents/profile/'.$fileName)];
    }
    
}