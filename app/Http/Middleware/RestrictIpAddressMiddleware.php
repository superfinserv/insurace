<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use View;

class RestrictIpAddressMiddleware
{
    // Blocked IP addresses
   // public $allowedIp = ['157.34.189.100','27.58.123.244'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $host = request()->getHttpHost();
        //  if($host=="superfinserv.co.in" || $host=="admin.superfinserv.co.in" || $host=="pos.superfinserv.co.in"){
        //     $result = $this->ipGet();
        //     if($result->status){
        //       if (!in_array($request->ip(), $result->allowedIp)) {
                
        //          if ($request->expectsJson()) { 
        //              return response()->json(['status'=>'error','message' => "Your IP:".$request->ip()." is not allowed to access this site."]);
        //          }else{
        //              return response()->view('show_not_allow'); 
        //          }
                 
        //         } 
        //     }else{
        //       if ($request->expectsJson()) { 
        //              return response()->json(['status'=>'error','message' => "Your IP:".$request->ip()." is not allowed to access this site."]);
        //          }else{
        //              return response()->view('show_not_allow'); 
        //          }
        //     }
        // }
        return $next($request);
    } 
    
    
    function  ipGet(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.superfinserv.in/get-allowed-ip',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response);
        return  $data;
        
    }
}