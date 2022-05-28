<?php
namespace App\Utils;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ErrorException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Auth;
use Carbon\Carbon;
class UserManager { 
    
    
    function createCustomer($customer){
        $customerID = 0;
        $isExist = DB::table('customers')->where('mobile',$customer['mobile'])->count(); 
        if($isExist){ 
            DB::table('customers')->where('mobile',$customer['mobile'])->update($customer); 
            $customerID = DB::table('customers')->where('mobile',$customer['mobile'])->value('id'); 
        }else{
            $customerID = DB::table('customers')->insertGetId($customer); 
        }
        return $customerID;
    }
    
    
    function GetPolicySoldBy(){
           $resp=  new \stdClass();
           $resp->sp_id = 0;
           $resp->agent_id = 0;
           $resp->customer_id = 0;
           $resp->customer_mobile = "";
           $resp->customer_name = "";
          if(isset(Auth::guard('agents')->user()->id)){
              
              $resp->agent_id  = Auth::guard('agents')->user()->id;
              if(Auth::guard('agents')->user()->userType=="POSP"){
                  $resp->sp_id  = (Auth::guard('agents')->user()->mapped_sp)?Auth::guard('agents')->user()->mapped_sp:0;
              }else{
                  $resp->sp_id  = Auth::guard('agents')->user()->id;
              }
              $resp->customer_mobile = Auth::guard('agents')->user()->mobile;
            }else{
              $isPOSP = DB::table('agents')->where('mobile',Auth::guard('customers')->user()->mobile)->count();
              if($isPOSP){
                 $agent = DB::table('agents')->where('mobile',Auth::guard('customers')->user()->mobile)->first();
                 if($agent->userType=="POSP"){ $resp->agent_id = $agent->id;$resp->sp_id = ($agent->mapped_sp)?$agent->mapped_sp:0;}
                 if($agent->userType=="SP"){   $resp->agent_id = $agent->id;$resp->sp_id = $agent->id;}
              }else{
                  $resp->customer_id = Auth::guard('customers')->user()->id;
                  $resp->customer_mobile = Auth::guard('customers')->user()->mobile;
              }
            }
            
            return $resp;
     }
}