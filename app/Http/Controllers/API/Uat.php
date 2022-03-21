<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use Auth;


class Uat extends Controller{
    
    public function getAllowedIp(Request $request){
        
        $count = DB::table("uat_allowed_ip")->select('ip_address')->where('status','Active')->count();
         if($count){
            $row = DB::table("uat_allowed_ip")->select(DB::raw('group_concat(ip_address) as ips'))->where('status','Active')->first();
            $array  = explode(',',$row->ips);
            return Response::json(['status'=>true,'allowedIp'=>$array]);  
         }else{
          return Response::json(['status'=>false,'allowedIp'=>[]]);   
         }
         
    }
       
}