<?php
namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use Auth;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginAuth extends Controller
{
    public function __construct() {
        
        $this->middleware('guest:customers', ['except' => ['index', 'logout']]);
    }
   
       
    public function index(){
      
     // if(Auth::guard('customers')){ return redirect('profile');}
        
        $template = ['title' => 'Sign In',"subtitle"=>"Sign In",'scripts'=>[asset('page_js/login.js')]];  
        return View::make('web.home.signIn')->with($template);
    }
    
    
   
    public function otp_modal(Request $request){
        //$this->middleware('guest:customers')->except('logout');
        //print_r(Auth::guard('customers')->user());
        $html =  View::make("web.otp_model")->with(['msg'=>$request->msg,'mobile'=>$request->mobileno])->render();
        return $html; 
    
    }
    
    public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }
    
    public function attamptLogin($id){
           //$this->middleware('guest')->except('logout');
            $this->middleware('guest:customers')->except('logout');
            //$this->middleware('guest:blogger')->except('logout');
             //if(Auth::guard('customers')->attempt(['mobile' => $cust->mobile,'password'=>$cust->mobile],1)) {
            return (Auth::guard('customers')->loginUsingId($id,true))?true:false;
    }
    
    function generateuniqueToken($mobile){
        $length = 20;
        $str = date('YmdHis').'1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$mobile;
        return substr(str_shuffle($str), 0, $length);
    }
    
    
    // public function sendotp(Request $request){
        
        
    //     $mobile = $request->mobile;
    //     $hasVerified = DB::table('customers')->where('mobile',$mobile)->where('status',1)->count();
    //     if($hasVerified){
    //          $data = DB::table('customers')->where('mobile',$mobile)->first();
    //           if($data->uniqueToken==""){  
    //               $arr['uniqueToken'] = $this->generateuniqueToken($mobile);
    //               DB::table('customers')->where('mobile',$mobile)->update($arr);
    //           }
    //          $isAuth = $this->attamptLogin($data->id);
             
    //              $url  = $this->getReturnUrl($request->insurance_type);
    //              $leadData=["lead_id"=>0,"customer_id"=>$data->id,"mobile"=>$mobile];
    //              return json_encode(array('statusCode'=>200,'param'=>"VERIFIED","_url"=>$url,"lead"=>$leadData,'msg'=>'User is already verified.'));
             
    //     }else{
    //       $otp = $this->otpToMobile($mobile);
    //       $isExist = DB::table('customers')->where('mobile',$mobile)->count();
    //       if($isExist){
    //           $cust = DB::table('customers')->where('mobile',$mobile)->first();
    //           $arr = ['last_otp' =>md5($otp),'last_search'=>$request->insurance_type];
    //           if($cust->uniqueToken==""){  $arr['uniqueToken'] = $this->generateuniqueToken($mobile);}
    //           DB::table('customers')->where('mobile',$mobile)->update($arr);
    //       }else{
              
    //           DB::table('customers')->insertGetId(['mobile'=>$mobile,'status'=>0,'uniqueToken'=>$this->generateuniqueToken($mobile),
    //                                               'last_otp' =>md5($otp),'last_search'=>$request->insurance_type]);
    //       }
    //       return json_encode(array('statusCode'=>200,'param'=>"OTP_SENT",'msg'=>'OTP sent successfully'.$otp));
    //     }
        
       
    // }
    
    public function sendotp(Request $request){
         $validator = Validator::make($request->all(), ['mobile' => 'required|digits:10'],['mobile.required'=>'Enter valid mobile number.']);
            if($validator->fails()){
                        return response()->json(['status'=>'error','message'=> $validator->errors()->first()]);
            }else{
        
        
        
                if($request->mobile!=""){
                     $mobile = $request->mobile;
              
                     $otp = $this->otpToMobile($mobile);
                     $isExist = DB::table('customers')->where('mobile',$mobile)->count();
                  if($isExist){
                      $cust = DB::table('customers')->where('mobile',$mobile)->first();
                      $arr = ['last_otp' =>md5($otp),'last_search'=>$request->insurance_type];
                      if($cust->uniqueToken==""){  $arr['uniqueToken'] = $this->generateuniqueToken($mobile);}
                      DB::table('customers')->where('mobile',$mobile)->update($arr);
                  }else{
                      
                      DB::table('customers')->insertGetId(['mobile'=>$mobile,'status'=>0,'uniqueToken'=>$this->generateuniqueToken($mobile),
                                                          'last_otp' =>md5($otp),'last_search'=>$request->insurance_type]);
                  }
                  return json_encode(array('statusCode'=>200,'param'=>"OTP_SENT",'msg'=>'OTP sent successfully'));
                }else{
                    return json_encode(array('statusCode'=>400,'param'=>"OTP_SENT",'msg'=>'Mobile number is required'));
                }
        }
        
       
    }
    
    public function resendotp(Request $request){
         $validator = Validator::make($request->all(), ['mobile' => 'required|digits:10'],['mobile.required'=>'Enter valid mobile number.']);
            if($validator->fails()){
                return response()->json(['statusCode'=>400,'message'=> $validator->errors()->first()]);
            }else{
                 $otp = $this->otpToMobile($request->mobile);
                 DB::table('customers')->where('mobile',$request->mobile)->update(['last_otp' =>md5($otp),'status'=>0]);
                 return json_encode(array('statusCode'=>200,'param'=>"OTP_SENT",'msg'=>'OTP resent successfully'));
            }
    }
    
    private function otpToMobile($mobile){
          $otp = $this->generateOTP();
          $message = ($otp." is the OTP to access Super Finserv Portal. OTP valid for 5 mins. Pls do not share it with anyone.");
          $xml_data ='<?xml version="1.0"?>
                     <smslist>
	                     <sms>
                            <user>superfin</user>
                        	<password>6402ddab36XX</password>
                        	<message>'.$message.'</message>
                        	<mobiles>'.$mobile.'</mobiles>
                        	<senderid>SUPERS</senderid>
                        </sms>
                    </smslist>';
                    
                    

            	$ch = curl_init('http://sms.smsmenow.in/sendsms.jsp');
            	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            	curl_setopt($ch, CURLOPT_POST, 1);
            	curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
            	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
            	curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
            	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            	$output = curl_exec($ch);
            	curl_close($ch);
            //	print_r($output); die;
            	return $otp;
            
    }
    
    
    
    public function verifyOtp(Request $request){
         $mobile = $request->mobile;
         $isExist = DB::table('customers')->where('mobile',$mobile)->count();
         if($isExist){
             $customer = DB::table('customers')->where('mobile',$mobile)->first();
             $insurance_type=$customer->last_search;
             $otp = $request->codeBox1.$request->codeBox2.$request->codeBox3.$request->codeBox4;
            if($otp==''){
                return json_encode(array('statusCode'=>300,'msg'=>"Please enter valid OTP."));
            }else{
                   if(md5($otp) == $customer->last_otp){
                        DB::table('customers')->where('id',$customer->id)->update(['status'=>1]);
                        $enQ = md5(uniqid(rand(), true));
                        \Cookie::queue(\Cookie::forever('X-enQ',$enQ));
                        DB::table('app_enQ')->insert(['enquiry_id'=>$enQ,'quoteID'=>"",'customer_id'=> $customer->id,'mobile'=>$mobile,'ip_address' =>$request->ip(),'enQFor'=>$insurance_type]);
                        $isAuth = $this->attamptLogin($customer->id);
                        $url = $this->getReturnUrl($insurance_type);
                        return json_encode(array('statusCode'=>200,'msg'=>'sucess','url'=>$url));
                   }else{
                        return json_encode(array('statusCode'=>400,'msg'=>"You have entered invalid OTP."));
                }
            }
        }else{
            return json_encode(array('statusCode'=>400,'msg'=>"Please enter valid OTP."));
        }
    }
    
    function setLogEvent(Request $request){
        if(\Cookie::has('X-enQ')){
          $cookies =    \Cookie::get('X-enQ');
          $eventData =  json_encode($request->eventInfo);
          DB::table('app_enQ')->where('enquiry_id',$cookies)->update(['params'=>$eventData]);
           return json_encode(['status'=>true]);
        }else{
          return json_encode(['status'=>false]);  
        }
    }
    
    private function getReturnUrl($insurance_type){
        $url = "";
        
       if($insurance_type=="1-crore-health-insurance"){$url='1-crore-health-insurance/health-profile';}
        if($insurance_type=="term-insurance"){$url='term-insurance'.'/gender';}
        if($insurance_type=="investment-plan"){$url='investment-plan'.'/cover-amount';}
        if($insurance_type=="ulip-plan"){$url='ulip-plan'.'/cover-amount';}
        if($insurance_type=="child-plan"){$url='child-plan'.'/userinfo';}
        if($insurance_type=="health-insurance"){$url='health-insurance'.'/health-profile';}
        if($insurance_type=="accidental-insurance"){$url='accidental-insurance/'.'users-info/';}
        if($insurance_type=="cancer-insurance"){$url='cancer-insurance'.'/gender';}
        if($insurance_type=="critical"){$url='critical'.'/userinfo';}
        if($insurance_type=="car-insurance"){$url='car-insurance'.'/registration-number/';}
        if($insurance_type=="bus-insurance"){$url='bus-insurance'.'/bus-number/';}
        if($insurance_type=="tractor-insurance"){$url='tractor-insurance'.'/tractor-number/';}
        if($insurance_type=="taxi-insurance"){$url='taxi-insurance'.'/taxi-number/';}
        if($insurance_type=="goods-insurance"){$url='goods-insurance'.'/goods-number/';}
        if($insurance_type=="twowheeler-insurance"){$url='twowheeler-insurance'.'/registration-number/';}
        if($insurance_type=="travel-insurance"){$url='travel-insurance'.'/travel-booking-date/';}
        if($insurance_type=="mobile"){$url='mobile'.'/userinfo/';}
        if($insurance_type=="shop"){$url='shop'.'/userinfo/';}
        return $url;
    }
    
    function logout(){
         Auth::guard('customers')->logout();
        return redirect('/sign-in');
    }
    // function profile(){
    //     Auth::guard('customers')->logout();
    //     return redirect('/sign-in');
    // }
    public function getCheckEmail(Request $request) {
        if($request) {
            $isExist = Customers::where('email', $request->email)->count();
            echo ($isExist)?'false':'true';
        }

    }
     public function customerDetails(Request $request) 
    {
        if($request) {
             $id = Auth::user()->id;
             $Cust = Customers::find($id);
             $Cust->name=$request->name;
             $Cust->email=$request->email;
             $Cust->city=$request->city;
             $Cust->pincode=$request->pincode;
            if($Cust->save())
            {  
                return json_encode(array('statusCode'=>200,'msg'=>'sucess'));
            } 
            else { 
                return json_encode(array('statusCode'=>400,'msg'=>"User details not updated"));
             }
    


        }

    }
}
