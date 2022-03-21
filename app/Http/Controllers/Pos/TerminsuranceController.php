<?php
namespace App\Http\Controllers\Pos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use App\Model\Agents;
use Illuminate\Support\Facades\Auth;

class TerminsuranceController extends Controller{

    public function __construct() {  $this->middleware('auth');}
  
    public function index(){
        $template = ['title' => 'Term-Insurance',"subtitle"=>"Term-Insurance",'scripts'=>[asset('site_assets/pospJs/otp.js')]];  
        return View::make('term.term_insurance')->with($template);
    }

    public function termDetail(){

       

        $template = ['title' => 'Term Detail',"subtitle"=>"Term Detail"];  

         return View::make('term.term_detail')->with($template);

       

    }

    public function genderSelect(){
        return redirect("/term-insurance/plan-list");
        

        $template = ['title' => 'Gender Type',"subtitle"=>"Gender Type",'scripts'=>[asset('site_assets/pospJs/otp.js')]];  

        // return View::make('term.gender_type')->with($template);

       

    }

    public function usersDetails(){

          $states = DB::table('states_list')->get()->toArray();

         $city = DB::table('cities_list')->get()->toArray();

        

        $template = ['title' => 'users Details',"subtitle"=>"users Details",'scripts'=>[asset('site_assets/pospJs/otp.js')],'city'=>$city,'states'=>$states];  

         return View::make('term.term_users_details')->with($template);

       

    }

    public function do_skome(){



        $template = ['title' => 'do skome',"subtitle"=>"do skome",'scripts'=>[asset('site_assets/pospJs/otp.js')]];  

         return View::make('term.do_skome')->with($template);

       

    }

    public function term_income(){

        $template = ['title' => 'your income',"subtitle"=>"your income",'scripts'=>[asset('site_assets/pospJs/otp.js')]];  

         return View::make('term.term_income')->with($template);

       

    }
    
    public function plan_list(){
        $template = ['title' => 'Protection- Insurance',"subtitle"=>"Your Plan",'scripts'=>[asset('site_assets/pospJs/term-insurance.js')]];  
         return View::make('quotePages.protection.plan_list')->with($template);
    }
    
    public function hdfc_data_link(){ 
        $curl = curl_init();
              $id = Auth::user()->id;
              $agent=DB::table('agents')->where('id', $id)->first(); 
             
              if($agent->hdfc_id!=""){
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://salesdiary.hdfclife.com/TEBTParPortal/integrate.do?_actionid=ext.userid.validate&userid='.$agent->hdfc_id.'&channel=Broca&subchannel=SuperSolutions',
                    CURLOPT_RETURNTRANSFER => true,
                   // CURLOPT_POST => true,
                   // CURLOPT_POSTFIELDS => $postData,
                    CURLOPT_FOLLOWLOCATION => true
                    ));
                    
                    $output = curl_exec($curl);
                    //print_r($output);
                    $token = trim($output);
                    if($token!=""){
                       return response()->json(['status'=>'success','message'=>'Reiview data get successfully','data'=>['token'=>$token,'uid'=>$agent->hdfc_id]]);
                    }else{
                        return response()->json(['status'=>'error','message'=>'unknown user access']);
                    }
                    curl_close($curl);
              }else{
                  return response()->json(['status'=>'error','message'=>'unknown user access']); 
              }
                    
                    // OLD  https://muat.hdfclife.com/TEBTParPortal/integrate.do?_actionid=ext.userid.validate
                    
                    
//                     https://salesdiary.hdfclife.com/TEBTParPortal/integrate.do?_actionid=ext.userid.validate&userid=XXXXX&channel=Broca&subchannel=SuperSolutions


// https://salesdiary.hdfclife.com/TEBTParPortal/integrate.do?_actionid=ext.tebt.launch&userid=XXXXX&partnerintegration=Y&hdfcsecuritytoken=
// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx&subchannel=SuperSolutions
                    
                    // $curl2 = curl_init();
                    // $postData1 = array("userid"=>"SAS001","partnerintegration"=>"Y","hdfcsecuritytoken"=>$output,"subchannel"=>"Super Solutions","securitycode"=>"4233GHksdwetrio");
                    // curl_setopt_array($curl2, array(
                    // CURLOPT_URL => 'https://muat.hdfclife.com/TEBTParPortal/integrate.do?_actionid=ext.tebt.launch',
                    // CURLOPT_RETURNTRANSFER => true,
                    // CURLOPT_POST => true,
                    // CURLOPT_POSTFIELDS => $postData1,
                    // CURLOPT_FOLLOWLOCATION => true
                    // ));
                    
                    // $output1 = curl_exec($curl2);
                    // echo $output1;
                    
    }
 

 

}

