<?php
namespace App\Partners;
//use Nathanmac\Utilities\Parser\Parser;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;

class Partners{ 
    function timePeriod($format,$tenure,$startDate=""){
        $policyStartDate = ($startDate=="")?date('Y-m-d'):$startDate;
        $_policyEndDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($policyStartDate)) . " +".$tenure." year")); 
        $policyEndDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($_policyEndDate)) . " -1 day"));

        $resp = new \stdClass(); 
        $resp->startDate = date_format(date_create($policyStartDate),$format);
        $resp->endDate   = date_format(date_create($policyEndDate),$format);
        
        return $resp;
    }
    // eldest Member Age
    
    
    
    function eldestMemberAge($members){
       $maxAge = 0 ;$minAge=0;
       foreach($members as $key=>$data){
              $age = (int)$data['age'];
                 if($minAge==0){$minAge =   $data['age'];}
                 else if($data['age']<$minAge){ $minAge =  intval($age);}
                 
                if($maxAge==0){$maxAge =  intval($data['age']);}
                else if($data['age']>$maxAge){ $maxAge =  intval($age);}
        }
        
        $resp = new \stdClass(); 
        $resp->maxAge = intval($maxAge);
        $resp->minAge = intval($minAge);
        return $resp;
    }
    
    //get age
    function calulateAge($dob){
        $dateOfBirth = date("Y-m-d", strtotime($dob));  
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        return $diff->format('%y');
    }
    // Call Curl Post Method....
    function curlPost($param,$auth){
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $auth['url'],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => ($param),
                    CURLOPT_HTTPHEADER => $auth['header'],
                ));
        
                $response = curl_exec($curl);
                // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                // print_r($httpcode);die;
                $err = curl_error($curl);
                curl_close($curl);
                return $response;
    }
    
    function curlGet($auth){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $auth['url'],
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => $auth['header'],
        //   CURLOPT_HTTPHEADER => array(
        //     "cache-control: no-cache",
        //     "postman-token: 6feff630-630f-36f7-0161-cff1fdcc77bb"
        //   ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $response;
    }
    
     function clean_str($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = str_replace('-', '', $string); 
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    
    
}