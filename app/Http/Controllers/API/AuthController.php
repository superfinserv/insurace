<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Agents; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class AuthController extends Controller {
     public $successStatus = 200;
     /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(Request $request){ 
         $agent = Agents::select('*')->where('mobile', $request->mobile)->count();
         if($agent){ 
               $users = Agents::select('*')->where('mobile', $request->mobile)->first();
               $password=($request->password);
               if(Hash::check($password, $users->password)){
                  Auth::login($users, true);
           
                     return response()->json(['status'=>'success','message'=>'Login Succesfully',
                                     'token'=>$users->createToken('MyApp')->accessToken,
                                      'data'=>['id'=>Auth::user()->id,'name'=>Auth::user()->name,'mobile'=>Auth::user()->mobile,'email'=>Auth::user()->email]],
                                      $this->successStatus); 
              }else{
                   return response()->json(['status'=>'error','message'=>"Invalid login credential.",'data'=>""]); 
              }
        }else{
           return response()->json(['status'=>'error','message'=>"+91-".$request->mobile.' is not registered','data'=>""]); 
        }
       
    }
    
    public function initRegister(Request $request){ 
        
        $mobile = $request->mobile;
        $isExist = Agents::where('mobile',$mobile)->count();
        if($isExist){
            return json_encode(array('status'=>'error','message'=>"+91-".$mobile." is already registered with us."));
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
            return response()->json(['status'=>'success','message'=>'OTP sent to +91 '.$request->mobile,'data'=>['mobile'=>$mobile]], $this->successStatus);
        }
         
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
        
    }
    
    public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }
    
    public function forgotPassword(Request $request){
        $agent = User::select('*')->where('mobile', $request->mobile)->count();
        if($agent){ 
                $users = User::select('*')->where('mobile', $request->mobile)->first();
                $to_name =$users->name;
                $to_email =$users->email;
                $mobile=$request->mobile;
                $token=urlencode(base64_encode($request->mobile));
                $data = array('name'=>$to_name,'token'=>$token,'mobile'=>$mobile, "to_email" => $to_email);
                Mail::send('agent.reset_password_mail', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                ->subject('Reset Password');
                $message->from('business.redbox@gmail.com','noreply@inseconds.in');
                });
                 $Cust = User::find($users->id);
                 $Cust->reset_time=date('m/d/Y H:i:s', time());
                 $Cust->password="";
                 if($Cust->save()){  
                      return response()->json(['status'=>'success','message'=>"we sent email to ".$to_email]); 
                 }else { 
                    return response()->json(['status'=>'error','message'=>"Error occur while send email",'data'=>""]); 
                 }
        }else{
           return response()->json(['status'=>'error','message'=>"+91-".$request->mobile.' is not registered','data'=>""]); 
        }
    }
    
    public function verifyOtp(Request $request){
        
         try{
            $validator = Validator::make($request->all(), [
                'otp' => 'required|integer|digits:4',
                'mobile' => 'required|integer|digits:10',
            ],['otp.required'=>'The OTP is required.',
               'otp.integer'=>'OTP must be valid digits.',
               'mobile.required'=>'Mobile No is required.',
               'mobile.integer'=>'Mobile No must be valid digits.']);
    
    
            if($validator->fails()){ 
                 return response()->json(['status'=>'error','message'=> $validator->errors()->first()],400);
            }else{
                
              $authCnt = DB::table('agent_register_auth')->where('mobile',$request->mobile)->count();
                if($authCnt){
                  if($request->otp==$auth->otp){
                     return response()->json(['status'=>'success','message'=>'Mobile Number verified Successfully!','data'=>['mobile'=> $request->mobile]], $this->successStatus);
                  }else{
                      return response()->json(['status'=>'error','message'=>'OTP does not match!','data'=>['mobile'=> $request->mobile]], $this->successStatus);
                  }
                }else{
                  return response()->json(['status'=>'error','message'=>'Something went wrong.','data'=>['mobile'=> $request->mobile]], 400);
                 }
       
            }
            
         }catch (Throwable $e) { 
             return response()->json(['status' =>'error','message'=>'Internal server error.'], 500);
         }
              
        
         
    }
    
     public function sendOTP(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'mobile' => 'required|integer|digits:10',
            ],['mobile.required'=>'Mobile No is required.',
               'mobile.integer'=>'Mobile No must be valid digits.']);
    
    
            if($validator->fails()){ 
                 return response()->json(['status'=>'error','message'=> $validator->errors()->first()],400);
            }else{
                $isExist = DB::table('agents')->where('mobile',$request->mobile)->count();
                if($isExist){
                    return json_encode(array('status'=>'error','msg'=>"+91-".$request->mobile." is already registered with us."));
                }else{
                    $hasAuth = DB::table('agent_register_auth')->where('mobile',$request->mobile)->count();
                    $otp = $this->generateOTP();
                    if($hasAuth){
                        DB::table('agent_register_auth')->where('mobile',$request->mobile)->update(['otp'=>$otp]);
                    }else{
                        DB::table('agent_register_auth')->insertGetId(['mobile'=>$request->mobile,'otp'=>$otp]);
                    }
                    $rsp = $this->otpProcess($mobile,$otp);  
                   return response()->json(['status'=>'success','message'=>"OTP Re-send to +91-".$request->mobile,'data'=>['mobile'=>$request->mobile]]);  
                }
            }
        }catch (Throwable $e) { 
             return response()->json(['status' =>'error','message'=>'Internal server error.'], 500);
         }
           
    }
    
    
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) { 
     if($request) {
           $validator = Validator::make($request->all(), [ 
                'name' => 'required', 
                'email' => 'required|email', 
                'city' => 'required',
                'state' => 'required',
                'address' => 'required',
                'pincode' => 'required',
                'mobile' => 'required|integer|digits:10', 
            ]);
            if ($validator->fails()) { 
                      return response()->json(['status'=>'error','message'=>$validator->errors(),'data'=>""], $this->successStatus);            
            } else{
                $isExist = Agents::where('mobile',$request->mobile)->count();
                if($isExist){
                    return json_encode(array('status'=>'error','msg'=>"Mobile Number already registered."));
                }else{
                        $Posp = new Agents;
                        $Posp->mobile=$request->mobile;
                        $Posp->state=$request->state;
                        $Posp->city=$request->city;
                        $Posp->name=ucwords(strtolower($request->name));
                        $Posp->email=strtolower($request->email);
                        $Posp->pincode=$request->pincode;
                        $Posp->account_holder_name = ucwords(strtolower($request->name));
                        $Posp->password=Hash::make($request->password);
                        
                        if($Posp->save()) {  
                            DB::table('agent_register_auth')->where('mobile',$request->mobile)->delete();
                            $users=Agents::find($Posp->id);
                            $arr = ['agent_id'=>$Posp->id];
                            DB::table("agent_bussness_info")->insertGetId($arr);
                            $TEMP = getMailSmsInfo($Posp->id,'POSP_REGISTER');
                            sendNotification($TEMP);
                            userLog(['user_id'=>$Posp->id,'type'=>"POSP",'action'=>"POSP_REGISTER",'message'=>"Registered",'created_at'=>date('Y-m-d H:i:s')]);
                            Auth::login($Posp, true);
           
                            return response()->json(['status'=>'success','message'=>'Register Succesfully',
                                                 'token'=>$users->createToken('MyApp')->accessToken,
                                                 'data'=>['id'=>Auth::user()->id,'name'=>Auth::user()->name,'mobile'=>Auth::user()->mobile,'email'=>Auth::user()->email]],
                                                  $this->successStatus); 
                        }else{
                             return response()->json(['status'=>'error','message'=>'Somthing went wrong while register.'],500);
                        }
                }
        }
    }
}
  
}