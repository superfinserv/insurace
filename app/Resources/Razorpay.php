<?php
namespace App\Resources;
use Razorpay\Api\Api;
use Auth;


class Razorpay {
    
    public function __construct(){}
    
     function FatchPaymentInfo($paymentId=""){
            if($paymentId!=""){
                $username=(config('custom.rozar_key'))?config('custom.rozar_key'):'LvlAjd1woF5HJEE5EAbXZj7n';
                $password=(config('custom.rozar_secret'))?config('custom.rozar_secret'):'rzp_live_TCKGzAhT4oF1F4';
                $URL='https://api.razorpay.com/v1/payments/'.$paymentId;
                
                $api = new Api($username, $password);
                $response = $api->payment->fetch($paymentId);
               
                //$result = json_decode(json_encode($result));
                 
                if(!isset($response->error)){
                    return ['status'=>true,'message'=>"Information Fetched Sucessfully",'data'=>$response];
                }else{
                   return ['status'=>false,'message'=>$response->error->description];
                }
            }else{
               return ['status'=>false,'message'=>"Invalid Payment ID"];
            }
    }
    
    
    function CapturePayment($paymentId="",$amount){
         try {
                $username=(config('custom.rozar_key'))?config('custom.rozar_key'):'LvlAjd1woF5HJEE5EAbXZj7n';
                $password=(config('custom.rozar_secret'))?config('custom.rozar_secret'):'rzp_live_TCKGzAhT4oF1F4';
                
                $api = new Api($username, $password);
               $response = $api->payment->fetch($paymentId)->capture(array('amount'=>$amount)); 
                return true;
            } catch (Exception $e) {
                return false;// $e->getMessage();
            }
    }
    
    
    
    
}