<?php

namespace App\Http\Controllers\Pos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Model\Agents;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Utils\Notifications;
use App\Utils\Posp;
class AuthController extends Controller{
    public function __construct() { 
         $this->notify = new Notifications; 
         $this->posp   =  new Posp;
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:agents')->except('logout');
     }

    public function index() {
     // if(Auth::user()){ return redirect('profile'); }
        $city = DB::table('cities')->get();
        $stateList = DB::table('states')->get();
        $template = ['title' => 'Sign Up',"subtitle"=>"Sign Up",'scripts'=>[asset('page_js/pospJs/posp-auth.js')],'city'=>$city,'statelist'=>$stateList];  
        return View::make('pos.front.sign_up')->with($template);
    }
    
    public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }
    
    
    
    public function sendotp(Request $request){
        $mobile = $request->mobile;
        $isExist = DB::table('agents')->where('mobile',$mobile)->count();
        if($isExist){
            return json_encode(array('status'=>'error','msg'=>"+91-".$mobile." is already registered with us."));
        }else{
            $hasAuth = DB::table('agent_register_auth')->where('mobile',$mobile)->count();
            $otp = $this->generateOTP();
            if($hasAuth){
                DB::table('agent_register_auth')->where('mobile',$mobile)->update(['otp'=>$otp]);
            }else{
                DB::table('agent_register_auth')->insertGetId(['mobile'=>$mobile,'otp'=>$otp]);
            }
            
           $rsp = $this->otpProcess($mobile,$otp);
           //print_r($rsp);
           return json_encode(array('status'=>'success','msg'=>'OTP sent successfully'));
        }
        //$this->otpProcess($mobile,$otp);
    }
    
    private function otpProcess($mobile,$otp){
          //$otp = $this->generateOTP();
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
            	//print_r($output);
            	curl_close($ch);
            	return $otp;
        //  $message = rawurlencode($otp." is the OTP to access Supersolutions Portal. OTP valid for 5 mins. Pls do not share it with anyone.");
        //   $url="http://www.wizhcomm.co.in/wems/sendsms?username=supersoltxn&password=soltxn987&to=".$mobile."&message=".$message;
        //  $curl = curl_init();
        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => $url,
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => "",
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 30,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => "GET",
        //   CURLOPT_HTTPHEADER => array(
        //     "cache-control: no-cache",
        //     "postman-token: 6feff630-630f-36f7-0161-cff1fdcc77bb"
        //   ),
        // ));
        
        // $response = curl_exec($curl);
        
        // $err = curl_error($curl);
        // curl_close($curl);
        // return $response;
    }
    
    public function verifyOtp(Request $request){
        $auth = DB::table('agent_register_auth')->where('mobile',$request->mobile)->first();
        $otp = $request->codeBox1.$request->codeBox2.$request->codeBox3.$request->codeBox4;
        if($otp==''){
            return json_encode(array('status'=>'error','msg'=>"Please provide OTP to verify Mobile Number!."));
        }else{
            if($otp == $auth->otp){
              return json_encode(array('status'=>"success",'msg'=>'Mobile Number verified Successfully!'));
            }else{
                return json_encode(array('status'=>'error','msg'=>"Invalid OTP provided!"));
            }
        }
    }
    
    public function getCheckEmail(Request $request) {
        if($request) {
            $user = Agents::where('email', $request->email)->get();
            if($user->count())
            {  echo 'false';} else { echo 'true'; }
    
        }

    }
    
    public function getCheckMobile(Request $request) {
        if($request) {
            $user = Agents::where('mobile', $request->mobile)->get();
            if($user->count())
            {  echo 'false';} else { echo 'true'; }
    


        }

    }
    
    public function getCheckMobileno(Request $request) {
        if($request) {
            $user = Agents::where('mobile', $request->mobile)->get();
            if($user->count()){  echo 'true';} else { echo 'false'; }
        }

    }
    
    public function register(Request $request){
        if($request) {
            $city = "";
            $isExist = DB::table('agents')->where('mobile',$request->mobile)->count();
            if($isExist){
                return json_encode(array('status'=>'error','msg'=>"Mobile Number already registered."));
            }else{
                if($request->city!=""){ $ctArr = explode('-',$request->city); $city =$ctArr[0];}
                        $Posp = new Agents;
                        $Posp->mobile=$request->mobile;
                        $Posp->state=$request->stateID;
                        $Posp->city=$city;
                        $Posp->name=ucwords(strtolower($request->name));
                        $Posp->email=strtolower($request->email);
                        $Posp->pincode=$request->pincode;
                        $Posp->account_holder_name = ucwords(strtolower($request->name));
                        $Posp->password=Hash::make($request->password);
                        $Posp->application_no = $this->posp->GenerateApplicationId('POSP');
                    if($Posp->save()) {  
                        DB::table('agent_register_auth')->where('mobile',$request->mobile)->delete();
                        $users=Agents::find($Posp->id);
                        $arr = ['agent_id'=>$Posp->id];
                        DB::table("agent_bussness_info")->insertGetId($arr);
                        $TEMP = $this->notify->getMailSmsInfo($Posp->id,'POSP_REGISTER');
                        $this->notify->sendNotification($TEMP);
                        //userLog(['user_id'=>$Posp->id,'type'=>"POSP",'action'=>"POSP_REGISTER",'message'=>"Registered",'created_at'=>date('Y-m-d H:i:s')]);
                        //Auth::login($users, true);
                        if(Auth::guard('agents')->attempt(['mobile' =>$request->mobile,'password'=>$request->password],1)) { 
                        //if(Auth::guard('agents')->login($users,1)) { 
                               return json_encode(array('status'=>'success','msg'=>'You are successfully registered!'));
                        }else{
                             return json_encode(array('status'=>'error','msg'=>"Somthing went wrong while register."));
                        }
                    }else { 
                        return json_encode(array('status'=>'error','msg'=>"Somthing went wrong while register."));
                    }
            }
        }

    }
    
   
        
    public function sign_in(){
       //if(Auth::guard('agents')){return redirect('profile');}
         
        $template = ['title' => 'Super Finserv',"subtitle"=>"Sign-in",
                     'scripts'=>[asset('page_js/pospJs/user-auth.js')]];  
         return View::make('pos.front.sign_in')->with($template);
    }
    
    public function authAgent(Request $request){ 
         $agent = DB::table('agents')->where('mobile', $request->mobile)->count();
         if($agent){ 
               $users = DB::table('agents')->select('*')->where('mobile', $request->mobile)->first();
               //print_r($users);
              $password=($request->password);
              //echo $users->password;
            if(Hash::check($password, $users->password)){
                 // Auth::login($users, true);
               if(Auth::guard('agents')->attempt(['mobile' =>$request->mobile,'password'=>$request->password],1)) { 
                   return json_encode(array('statusCode'=>200,'msg'=>"Login Succesfully"));
               }else{
                   return json_encode(array('statusCode'=>400,'msg'=>"Invalid login credential.")); 
               }
              }else{
                     return json_encode(array('statusCode'=>400,'msg'=>"Invalid password provided."));
                   
              }
        }else{
            return json_encode(array('statusCode'=>401,'msg'=>"+91-".$request->mobile.' is not registered'));
        }
       
    }
   
    public function logout(){
        Auth::guard('agents')->logout();
        return redirect('/sign-in');
     }
     
    public function forgotPassword(){
       if(Auth::user()){  return redirect('profile');}
       $template = ['title' => 'Forgot password',"subtitle"=>"Forgot password", 'scripts'=>[asset('page_js/pospJs/user-auth.js')]];  
       return View::make('pos.front.forgot-password')->with($template);
    }
    
    public function password_reset_email(Request $request){
        $users = Agents::select('*')->where('mobile', $request->mobile)->first();
        $chars1 = hash('sha256', mt_rand() . microtime() .    uniqid());
        $chars2 = hash('sha256', uniqid()  . mt_rand()   . microtime());
        $chars3 = hash('sha256', mt_rand() . uniqid()    . microtime());
        $token =  str_shuffle(substr(str_shuffle($chars1.$request->mobile), 0, 10))."s".str_shuffle(substr(str_shuffle($chars2), 0, 10))."s".str_shuffle(substr(str_shuffle($chars3), 0, 10));
        DB::table('reset_password')->where(['user_id'=>$users->id,'type'=>'POSP'])->update(['is_expired'=>'YES']);
        $start = date('Y-m-d H:i:s');
        $expiry =  date('Y-m-d H:i:s',strtotime('+10 minutes',strtotime($start)));
        $refID = DB::table('reset_password')->insertGetId(['user_id'=>$users->id,'type'=>'POSP','token'=>$token,'created_at'=>$start,'expire_at'=>$expiry]);
        if($refID) { 
             $TEMP = getMailSmsInfo($users->id,'POSP_FORGOT_PASSWORD');
             sendNotification($TEMP);
             return json_encode(array('statusCode'=>200,'msg'=>'Success'));
        }else{ 
            return json_encode(array('statusCode'=>400,'msg'=>"Something went wrong while send email. Try again!"));
        }
       
      
    }
    
    // public function password_reset_email(Request $request){
    //     $users = Agents::select('*')->where('mobile', $request->mobile)->first();
    //     $to_name =$users->name; $to_email =$users->email;$mobile=$request->mobile;
    //     $chars1 = hash('sha256', mt_rand() . microtime() .    uniqid());
    //     $chars2 = hash('sha256', uniqid()  . mt_rand()   . microtime());
    //     $chars3 = hash('sha256', mt_rand() . uniqid()    . microtime());
    //     $token =  str_shuffle(substr(str_shuffle($chars1.$request->mobile), 0, 10))."s".str_shuffle(substr(str_shuffle($chars2), 0, 10))."s".str_shuffle(substr(str_shuffle($chars3), 0, 10));
    //     //$token=urlencode(base64_encode($request->mobile));
    //     $data = array('name'=>$to_name,'token'=>$token,'mobile'=>$mobile, "to_email" => $to_email);
    //     Mail::send('front.reset_password_mail', $data, function($message) use ($to_name, $to_email) {
    //       $message->to($to_email, $to_name)
    //       ->subject('Reset Password');
    //       $message->from('noreply@supersolutions.in','Super Solutions');
    //     });
    //     DB::table('reset_password')->where(['user_id'=>$users->id,'type'=>'POSP'])->update(['is_expired'=>'YES']);
    //     $start = date('Y-m-d H:i:s');
    //     $expiry =  date('Y-m-d H:i:s',strtotime('+10 minutes',strtotime($start)));
    //     $refID = DB::table('reset_password')->insertGetId(['user_id'=>$users->id,'type'=>'POSP','token'=>$token,'created_at'=>$start,'expire_at'=>$expiry]);
    //     if($refID) {  
    //         return json_encode(array('statusCode'=>200,'msg'=>'Success'));
    //     }else{ 
    //         return json_encode(array('statusCode'=>400,'msg'=>"User details not updated"));
    //     }
      
    // }
    
    public function resetPassword(Request $request){
        if(Auth::user()){return redirect('profile');}
        $token=$request->token;
        $resetCount = DB::table('reset_password')->where(['token'=>$token,'type'=>'POSP','is_expired'=>'NO'])->count();
        $users =[];
        if($resetCount>0){
            $reset = DB::table('reset_password')->where(['token'=>$token,'type'=>'POSP','is_expired'=>'NO'])->orderBy('id', 'desc')->first();
            $users = Agents::select('*')->where('id', $reset->user_id)->first();
            //print_r($reset);
            $created_date = date('Y-m-d H:i:s',strtotime($reset->created_at));
            $currentDateTime = date('Y-m-d H:i:s');$eventdata=date_create($created_date);
            $currentdata=date_create($currentDateTime);$diffrent= date_diff($eventdata ,$currentdata);
            $day   = $diffrent->format('%d'); $h   = $diffrent->format('%h');$m   = $diffrent->format('%i'); $minuts = (($day*24)*60)+($h*60)+$m;
            if($minuts <= 10 && $reset->is_expired=='NO' && $resetCount>0){ $page = 'pos.front.resetPassword';}else{ $page = 'pos.front.expiredpasswordResetLink'; }
        }else{
            $page = 'pos.front.expiredpasswordResetLink';
        }
        $template = ['title' => 'Reset password',"subtitle"=>"Reset password",'scripts'=>[asset('page_js/pospJs/user-auth.js')],'token'=>$token];  
        return View::make($page)->with($template);
    }
    
    public function updatePassword(Request $request){
            $resetCount = DB::table('reset_password')->where(['token'=>$request->id,'type'=>'POSP','is_expired'=>'NO'])->count();
            if($resetCount>0){
                $reset = DB::table('reset_password')->where(['token'=>$request->id,'type'=>'POSP','is_expired'=>'NO'])->orderBy('id', 'desc')->first();
                $Agent = Agents::find($reset->user_id);
                $Agent->password=Hash::make($request->password);
                     
               if($Agent->save()){
                    $TEMP = getMailSmsInfo($reset->user_id,'POSP_RESET_PASSWORD');
                    sendNotification($TEMP);
                    DB::table('reset_password')->where(['user_id'=>$reset->user_id,'type'=>'POSP'])->update(['is_expired'=>'YES']);
                    return json_encode(array('status'=>'success','message'=>'Your Password reset successfully!'));
                }else { 
                    return json_encode(array('status'=>'error','message'=>"Something went wrong while reset password."));
               }
         }else{
           return json_encode(array('status'=>'error','message'=>"Password reset link has been expired!"));  
         }

    }
 
}
