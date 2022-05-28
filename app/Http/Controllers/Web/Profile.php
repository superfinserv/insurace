<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
class Profile extends Controller{
    public function __construct() { 
        
    }

 
    public function myPolicies(){
      
        $template = ['title' => 'Super Finserv',"subtitle"=>"My Policies",'scripts'=>[asset('/page_js/profile.js')]];  
        $template['isPOSP'] =  false;$template['isSP'] =  false;
        $isAgent = DB::table('agents')->where('mobile',Auth::guard('customers')->user()->mobile)->count();
              if($isAgent){
                 $agent = DB::table('agents')->where('mobile',Auth::guard('customers')->user()->mobile)->first();
                 if($agent->userType=="POSP"){ 
                      $template['polices'] = DB::table('policy_saled')->select('policy_saled.*','our_partners.name as partnerName')
                      ->leftJoin("our_partners", "our_partners.shortName", '=', "policy_saled.provider")
                      ->where('agent_id',$agent->id)->orderBy('id','DESC')->get();
                      $template['isPOSP'] =  true;
                 }else{
                      $template['polices'] = $template['polices'] = DB::table('policy_saled')->select('policy_saled.*','our_partners.name as partnerName')
                      ->leftJoin("our_partners", "our_partners.shortName", '=', "policy_saled.provider")->where('sp_id',$agent->id)->orderBy('id','DESC')->get();
                      $template['isSP'] =  true;
                 }
              }else{
                  $template['polices'] =$template['polices'] = DB::table('policy_saled')->select('policy_saled.*','our_partners.name as partnerName')
                      ->leftJoin("our_partners", "our_partners.shortName",'=',"policy_saled.provider")
                      ->where('customer_id',Auth::guard('customers')->user()->id)->orderBy('id','DESC')->get();
              }
        
         
         return View::make('web.profile.my_policies')->with($template);
    }
    
     public function myApplications(){
      
        $template = ['title' => 'Super Finserv',"subtitle"=>"My Applications",'scripts'=>[asset('/page_js/profile.js')]];  
        $template['isPOSP'] =  false;$template['isSP'] =  false;
        $isAgent = DB::table('agents')->where('mobile',Auth::guard('customers')->user()->mobile)->count();
              if($isAgent){
                 $agent = DB::table('agents')->where('mobile',Auth::guard('customers')->user()->mobile)->first();
                 if($agent->userType=="POSP"){ 
                      $template['polices'] = DB::table('app_quote')->select('app_quote.*','our_partners.name as partnerName')
                      ->leftJoin("our_partners", "our_partners.shortName", '=', "app_quote.provider")
                      ->where('agent_id',$agent->id)->where('app_quote.status','ENQ')->orderBy('app_quote.id','DESC')->get();
                      $template['isPOSP'] =  true;
                 }else{
                      $template['polices'] = $template['polices'] = DB::table('app_quote')->select('app_quote.*','our_partners.name as partnerName')
                      ->leftJoin("our_partners", "our_partners.shortName", '=', "app_quote.provider")->where('sp_id',$agent->id)->where('app_quote.status','ENQ')->orderBy('id','DESC')->get();
                      $template['isSP'] =  true;
                 }
              }else{
                  $template['polices'] =$template['polices'] = DB::table('app_quote')->select('app_quote.*','our_partners.name as partnerName')
                      ->leftJoin("our_partners", "our_partners.shortName",'=',"app_quote.provider")
                      ->where('customer_id',Auth::guard('customers')->user()->id)->where('app_quote.status','ENQ')->orderBy('app_quote.id','DESC')->get();
              }
        
         return View::make('web.profile.my_applications')->with($template);
    }
    
    function logout(){
         Auth::guard('customers')->logout();
        return redirect('/');
    }
    
  
}


