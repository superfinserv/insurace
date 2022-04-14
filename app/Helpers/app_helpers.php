<?php 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
// use PDF;
 use File;
 use Config;

 if (!function_exists('getAssets')) {
 function getAssets($str){
          return  asset($str);
  }
}

 

if (!function_exists('getCurretFinancialYear')) {
    function getCurretFinancialYear($month){
        if($month > 3){
            $y = date('Y');
            $pt = date('Y', strtotime('+1 year'));
            //$fy = $y."-04-01".":".$pt."-03-31";
            $fy = $y."-".$pt;
        }else{
            $y = date('Y', strtotime('-1 year'));
            $pt = date('Y');
           // $fy = $y."-04-01".":".$pt."-03-31";
            $fy = $y."-".$pt;
        }
        return $fy;
    }
}

if (!function_exists('updateCustomConfig')){
 function updateCustomConfig(){
         $settings  = DB::table('site_settings')->pluck('value','key_name')->toArray();
         $content = var_export($settings, true);
         File::put(config_path('custom.php'), "<?php\n return $content ;");
         return true;
    }
}

 if (!function_exists('setMoneyFormat')) {
 function setMoneyFormat($digit){
     setlocale(LC_MONETARY,"en_IN");
     return money_format(" %n", $digit);
  }
}




if (!function_exists('get_site_settings')) {
    function get_site_settings($options=""){
       if($options!=""){
           $data = DB::table("site_settings")->where(['key_name'=>$options])->first();
           if($data->inputType=='file'){
                return  asset($data->upload_path.$data->value);
           }else{
                return  $data->value;
           }
          
       }
    }
}

if (!function_exists('genratePOSPId')) {
 function genratePOSPId($agentId){
            $agInfo = DB::table('agents')->where('id',$agentId)->first();
            if($agInfo->cert_serial!="" && $agInfo->cert_serial>0){
                 DB::table('agents')->where('id', $agentId)->update(['cert_serial' =>0]);
            }
            $serial = DB::table('agents')->max('cert_serial');
            $num = $serial+1; 
            $v = 10000+$num;
            
            $pospID  = (config('custom.pospID_prefix')!="")?config('custom.pospID_prefix').$v:"SS/POSP/A".$v;
            //$pospID  = (get_site_settings('pospID_prefix')!="")?get_site_settings('pospID_prefix').$v:"SS/POSP/A".$v;
             DB::table('agents')
                ->where('id', $agentId)
                ->update(['cert_serial' => $num,'posp_ID'=>$pospID]);
            return $pospID;
    }
}

if (!function_exists('createFormatDate')) {
function createFormatDate($date, $format, $newformat) { 
        $tz = 'Asia/Kolkata';
        return Carbon::createFromFormat($format, $date,$tz)->format($newformat);
       
    }
}

// if (!function_exists('clean_str')) {
// function clean_str($string) {
//         $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
//         $string = str_replace('-', '', $string); 
//         return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
//     }
// }

if (!function_exists('getRandomStr')) {
    function getRandomStr($len){
           $length = ($len!="" && $len>0)?$len:10;
           $data = time().'1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz'.date('YmdHis');
           return strtoupper(substr(str_shuffle($data), 0, $length));
       }
    }
    
if (!function_exists('userLog')) {
         function userLog($arr){
                 $id = DB::table('logs')->insertGetId($arr); 
                 if($id){ return true;}else{ return false;}
          }
   }
   
if (!function_exists('_createCustomer')) {
         function _createCustomer($arr){
             $id =0;
             $is = DB::table('customers')->where('mobile',$arr['mobile'])->count(); 
             if($is){
                 $mobb = $arr['mobile'];
                 //unset($arr['mobile']);
                 DB::table('customers')->where('mobile',$mobb)->update($arr); 
                 $id = DB::table('customers')->where('mobile',$mobb)->value('id'); 
             }else{
                  $id = DB::table('customers')->insertGetId($arr); 
             }
               return $id;
          }
    }


if (!function_exists('getTimeAgo')) {
 function getTimeAgo($ptime) {
        $estimate_time = time() - $ptime;
        if ($estimate_time < 1) {
            return 'Just now';
        }

        $condition = array(
            12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($condition as $secs => $str) {
            $d = $estimate_time / $secs;

            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }
    }
} 

if (!function_exists('send_pushnotification')) {
    function send_pushnotification($agentId,$body,$data){
        $agent = DB::table("agents")->where(['id'=>$agentId])->first();
        if($agent->device_token!=""){
                $content = array("en" =>$body['content']);
                $heading = array("en" =>$body['title']);
        		
        		$fields = array(
        			'app_id' => "9ee32c5c-9040-451c-8be8-87272f637a72",
        			'include_player_ids' => array($agent->device_token),
        			'data' =>["tag" =>$data['tag'],"page"=>$data['page']],
        			//'message_icon'=>'https://supersolutions.in/insassets/icons/24x24.png',
        			"headings_color"=>"#e54b4d",
        			'contents' => $content,
                    'headings' => $heading
        		);
        		
        		$fields = json_encode($fields);
        		$ch = curl_init();
        		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        		curl_setopt($ch, CURLOPT_HEADER, FALSE);
        		curl_setopt($ch, CURLOPT_POST, TRUE);
        		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        		$response = curl_exec($ch);
        		curl_close($ch);
        		
        		//print_r($response);
            }
    }
}

if(!function_exists('sendPolicytoCustomer')) {
 function sendPolicytoCustomer($policy_no){
    $policy= DB::table('policy_saled')->where('policy_no',$policy_no)->first();
    $params= json_decode($policy->params);
    $pdf = customerPolicyData($policy_no);
    $attach = [$pdf['name']=>$pdf['row']];
    $setting = DB::table("notification_template_settings")->where(['type'=>'CUSTOMER','action'=>'CUSTOMER_POLICY_SUCCESS'])->first(); 
    $emailTemp = DB::table("email_templates")->where(['id'=>$setting->email_template])->first();
    $nameArr = explode(" ",$policy->customer_name);
    $findArr = ["#FIRST_NAME#","#LAST_NAME#","#NAME#","#MOBILE","#EMAIL#","#AADHAR#","#POSP_ID#","#BANK_NAME#","#ACCOUNT_NO#"];
    $rplcArr = [$nameArr[0],$nameArr[1],$policy->customer_name,$policy->mobile_no,$params->selfEmail,"","",""];
    $body = str_replace($findArr,$rplcArr,$emailTemp->body);
    $body=(html_entity_decode($body,ENT_QUOTES));
    $to_name = $policy->customer_name; $to_email = $params->selfEmail;$subject = $emailTemp->subject;
    $sender = $emailTemp->sender_email;
    $data = array('body'=>$body,'subject'=>$emailTemp->subject);
                     Mail::send('pos.templates.mail_freame', $data, function($message) use ($sender,$to_name, $to_email,$subject,$attach) {
                      $message->to($to_email, $to_name)
                              ->subject($subject);
                             foreach($attach as $key=>$raw){
                                $message->attachData($raw,$key);
                              }
                      
                      $message->from($sender,'Super Finserv');
                    });
}
 }

if(!function_exists('sendNotification')) {
     function sendNotification($info){
         //print_r($info->sms);
         if(isset($info->email)){
             if($info->email->status){ 
                   $to_name = $info->email->receiverName; $to_email = $info->email->receiverEmail;$subject = $info->email->subject;
                   $sender = $info->email->senderEmail;
                   $attach  = $info->email->attach;
                   $cc= $info->email->cc;
                   $data = array('body'=>$info->email->body,'subject'=>$info->email->subject);
                    Mail::send('pos.templates.mail_freame', $data, function($message) use ($sender,$to_name, $to_email,$subject,$attach,$cc) {
                      $message->to($to_email, $to_name)
                              ->subject($subject);
                      if($attach->status){
                          if($attach->isRaw){
                              foreach($attach->attachments as $key=>$raw){
                                  
                                $message->attachData($raw,$key);
                              }
                              
                          }else{
                              foreach($attach->attachments as $key=>$path){
                                $message->attach($path,['as' => $key]);
                              }
                          }
                      } 
                      if($cc->status){
                          $message->cc($cc->email, $cc->name);
                      }
                      
                      $message->from($sender,'Super Finserv');
                    });
             }
         } //email end here
         
         if(isset($info->sms)){
                $message = ($info->sms->body);
                  $xml_data ='<?xml version="1.0"?>
                             <smslist>
        	                     <sms>
                                    <user>superfin</user>
                                	<password>6402ddab36XX</password>
                                	<message>'.$message.'</message>
                                	<mobiles>'.$info->sms->receiverPhone.'</mobiles>
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
                    	//print_r($output);
         }
         
         
     }
}

if(!function_exists('getMailSmsInfo')) {
     function getMailSmsInfo($agentId,$action){
       $is = DB::table("notification_template_settings")->where(['type'=>'POSP','action'=>$action])->count(); 
       $response = new \stdClass(); 
       if($is){
           $agent = DB::table("agents")->where(['id'=>$agentId])->first();
           $setting = DB::table("notification_template_settings")->where(['type'=>'POSP','action'=>$action])->first();  
           if($setting->email_status=='ACTIVE' && ($setting->email_template!="" && $setting->email_template>0)){
               $emailResp = new \stdClass(); 
               $emailTemp = DB::table("email_templates")->where(['id'=>$setting->email_template])->first();
               
               $nameArr = explode(" ",$agent->name);
               $findArr = ["#FIRST_NAME#","#LAST_NAME#","#NAME#","#MOBILE","#EMAIL#","#AADHAR#","#POSP_ID#","#BANK_NAME#","#ACCOUNT_NO#"];
               $rplcArr = [$nameArr[0],$nameArr[1],$agent->name,$agent->mobile,$agent->email,$agent->adhaar_card_number,$agent->bank_name,$agent->account_number];
               $body = str_replace($findArr,$rplcArr,$emailTemp->body);
               
               $attach = new \stdClass();
               $attach->status = false;
               $attach->isRaw = false;
               $attach->attachments = [];
               
               if($action =="POSP_REGISTER"){
                   
                   $find_PR = ["#LINK#"];$rplc_PR = ["https://pos.superfinserv.co.in/profile"];
                   $body = str_replace($find_PR,$rplc_PR,$body);
               }
               if($action == "POSP_FORGOT_PASSWORD"){
                   $reset = DB::table('reset_password')->where(['user_id'=>$agent->id,'type'=>'POSP','is_expired'=>'NO'])->orderBy('id', 'DESC')->first();
                   $link = url('password/reset/'.$reset->token);
                   $find_PFP = ["#LINK#"];$rplc_PFP = [$link];
                   $body = str_replace($find_PFP,$rplc_PFP,$body);
               }
               if($action == "POSP_FEE_PAID"){
                   
                     $pdf = taxInvoice($agentId);
                     $attach->status = true;
                     $attach->isRaw = true;
                     $attach->attachments = [$pdf['name']=>$pdf['row']];
            
               }
               if($action == "POSP_VERIFIED"){
                   
                     $pdf = pospVerifiedData($agentId);
                     $attach->status = true;
                     $attach->isRaw = true;
                     $attach->attachments = [$pdf['name']=>$pdf['row']];
            
               }
               if($action == "TRANNING_CRD"){
                  $findArr = ["#TRANNING_USERNAME#","#TRANNING_PASSWORD#"];
                  $crd = json_decode($agent->tranning_crd);
                  $rplcArr = [$crd->username,$crd->pass];
                  $body = str_replace($findArr,$rplcArr,$body);
               }
               
               
               if($action == "CERTIFICATION_COMPLETE"){
                   $cert = DB::table('certification')->where('agent_id', $agent->id)->orderBy('id', 'desc')->first();
                   $cert_path = public_path('assets/agents/pdf/certificate/'.$cert->file);
                   
                   $arr =[];        
                   if($cert->file!="" && File::exists($cert_path)){
                      $attach->status = true;
                      $arr[$cert->file] = $cert_path;
                      $attach->attachments = $arr;//[$cert_path];
                   }
               }
               
               if($action == "TRANNING_CRTIFICATE"){
                    $arr = [];
                    $life_ins_cert    = public_path('assets/agents/pdf/tranning_certificates/'.$agent->life_ins_cert);
                    $general_ins_cert = public_path('assets/agents/pdf/tranning_certificates/'.$agent->general_ins_cert);
                    if($agent->life_ins_cert!="" && File::exists($life_ins_cert)){ $arr[$agent->life_ins_cert]=$life_ins_cert;}
                    if($agent->general_ins_cert!="" && File::exists($general_ins_cert)){ $arr[$agent->general_ins_cert]=$general_ins_cert;}
                   
                    if(!empty($arr)){ $attach->status = true; $attach->attachments = $arr;}
                }
               //$subject = str_replace($findArr,$rplcArr,$emailTemp->subject);
                $cc = new \stdClass();
                $cc->status = false;
                $cc->name = false;
                $cc->email = false;
                if($agent->mapped_sp!=""){
                   $sp =  DB::table("users")->where(['id'=>$agent->mapped_sp])->first();
                   $cc->status = true;
                   $cc->name = $sp->name;
                   $cc->email = $sp->email;
                }
               
               $emailResp->status = true;
               $emailResp->subject = $emailTemp->subject;
               $emailResp->body=(html_entity_decode($body,ENT_QUOTES));
               $emailResp->senderEmail=$emailTemp->sender_email;
               $emailResp->receiverEmail=$agent->email;
               $emailResp->receiverName=$agent->name;
               $emailResp->attach=$attach;
               $emailResp->cc = $cc;
               $response->email = $emailResp;
               
           } // EMAIL Params
           if($setting->sms_status=='ACTIVE' && ($setting->sms_template!="" && $setting->sms_template>0)){
                $smsResp = new \stdClass(); 
                $smsTemp = DB::table("sms_templates")->where(['id'=>$setting->sms_template])->first();
                
               $nameArr = explode(" ",$agent->name);
               $findArr = ["#FIRST_NAME#","#LAST_NAME#","#NAME#","#MOBILE","#EMAIL#","#AADHAR#","#POSP_ID#","#BANK_NAME#","#ACCOUNT_NO#"];
               $rplcArr = [$nameArr[0],$nameArr[1],$agent->name,$agent->mobile,$agent->email,$agent->adhaar_card_number,$agent->bank_name,$agent->account_number];
               $body = str_replace($findArr,$rplcArr,$smsTemp->body);
               
               $smsResp->status = true;
               $smsResp->body=$body;
               $smsResp->senderPhone=$smsTemp->sender_phone;
               $smsResp->receiverPhone=$agent->mobile;
               
               $response->sms = $smsResp;
                
           } // SMS Params
           $response->status = true;$response->message = "Success!"; 
       }else{
          $response->status = false;$response->message = "Can't perfrom action."; 
       }
       return $response;
     }
}


if(!function_exists('taxInvoice')){
     function taxInvoice($agentID){
            $user = DB::table('agents')->where('id',$agentID)->first();
            $pay = DB::table('agent_payments')->where('agent_id', $agentID)->first();
            $filename = "Invoice-".str_replace("/","",$user->posp_ID).".pdf";
          
            // $path = dirname(getcwd(),1)."/insassets/agents/pdf/taxinvoice";
            // if(!File::exists($path)) {
            //     File::makeDirectory($path, $mode = 0755, true, true);
            // } 
       
            $logo = get_site_settings('site_logo');//"https://insurance.supersolutions.in/logo/logo_5.png";
            $arrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $type = pathinfo($logo, PATHINFO_EXTENSION);
            $avatarData = file_get_contents($logo, false, stream_context_create($arrContextOptions));
            $avatarBase64Data = base64_encode($avatarData);
            $data['logo'] = 'data:image/' . $type . ';base64,' . $avatarBase64Data;
            
            
            //SIGN
            $sign = public_path('site_assets/logo/tax-sign.png');//"https://insurance.supersolutions.in/logo/logo_5.png";
            $SarrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $Stype = pathinfo($sign, PATHINFO_EXTENSION);
            $SavatarData = file_get_contents($sign, false, stream_context_create($SarrContextOptions));
            $SavatarBase64Data = base64_encode($SavatarData);
            $data['sign'] = 'data:image/' . $Stype . ';base64,' . $SavatarBase64Data;
            
            
            
              $fee_amount = intval((float)get_site_settings('posp_application_fee'));
              $tax1 = intval(($fee_amount*9)/100);
              $tax2 = intval(($fee_amount*9)/100);
              $tax = intval(($fee_amount*18)/100);
              $total =  $fee_amount+$tax;
               
               if($user->state!="" && $user->state==33){
                   $cgst = round($tax1);//round(($fee_amount*9)/100);
                   $sgst = round($tax2);//round(($fee_amount*9)/100);
                   $data['cgst']='₹'.number_format((float)$cgst, 2, '.', '').'/-';
                   $data['sgst']='₹'.number_format((float)$sgst, 2, '.', '').'/-';
                   $data['igst']='₹00.00/-';
                   $data['total'] = '₹'.number_format((float)($fee_amount+$cgst+$sgst), 2, '.', '');
                   $data['payble'] = number_format((float)($fee_amount+$cgst+$sgst), 2, '.', '');
               }else{
                   $igst = round($tax);
                   $data['cgst']='₹00.00/-';
                   $data['sgst']='₹00.00/-';
                   $data['igst']='₹'.number_format((float)$igst, 2, '.', '').'/-';
                   $data['total'] = '₹'.number_format((float)($fee_amount+$igst), 2, '.', '');
                   $data['payble'] = number_format((float)($fee_amount+$igst), 2, '.', '');
               }
         $data['fee_payment'] = '₹'.number_format((float)($fee_amount), 2, '.', '');
         $data['user'] = $user;
         $data['user_city'] = ($user->city!="" && $user->city>0)?DB::table('cities_list')->where('id', $user->city)->value('name'):"";
         $data['user_state'] = ($user->state!="" && $user->state>0)?DB::table('states_list')->where('id', $user->state)->value('name'):"";
         $data['pay'] = $pay;
         PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
         $pdf = PDF::loadView('pos.feepayments.taxinvoice',$data);
        
        // return $pdf->stream();
        // $headers =[
                //     'Content-Description' => 'File Transfer',
                //     'Content-Type' => 'application/pdf',
                // ];
         //$pdf->save('public/assets'.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        
       // return $pdf->download('public/assets'.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
       // return Response::download($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        $pData = ['row'=>$pdf->output(),'name'=>$filename];
        return  $pData;
        
        // $data["body"]="";
        // Mail::send('templates.mail_freame', $data, function($message)use($data,$pdf) {
        //             $message->to('praveen.patidar10@gmail.com', "Praveen Patidar")
        //             ->subject('Test Attach')
        //             ->attachData($pdf->output(), "invoice.pdf");
        //             $message->from("care@supersolutions.in",'Supersolutions');
        //             });
        
    }
}

if(!function_exists('pospVerifiedData')){
    function pospVerifiedData($id){
        $user = DB::table('agents')->where('id',$id)->first();
       // $filename = str_replace("/","_",$user->posp_ID).uniqid();
        $filename = "SF-".str_replace("/","",$user->posp_ID).".pdf";
        // $path = "public/assets/agents/pdf/certificate";
        // if(!File::exists($path)) {
        //     File::makeDirectory($path, $mode = 0755, true, true);
        // } 
       
            $logo = get_site_settings('site_logo');
            $arrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $type = pathinfo($logo, PATHINFO_EXTENSION);
            $avatarData = file_get_contents($logo, false, stream_context_create($arrContextOptions));
            $avatarBase64Data = base64_encode($avatarData);
            $data['logo'] = 'data:image/' . $type . ';base64,' . $avatarBase64Data;
            
            $profile = "public/assets/agents/profile/".$user->profile;
            $arrContextOptions1=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $type1 = pathinfo($profile, PATHINFO_EXTENSION);
            $avatarData1 = file_get_contents($profile, false, stream_context_create($arrContextOptions1));
            $avatarBase64Data1 = base64_encode($avatarData1);
            $data['profile'] = 'data:image/' . $type1 . ';base64,' . $avatarBase64Data1;
         $data['user'] = $user;
         $data['user_city'] = ($user->city!="" && $user->city>0)?DB::table('cities_list')->where('id',  $user->city)->value('name'):"";
         $data['user_state'] = ($user->state!="" && $user->state>0)?DB::table('states_list')->where('id',  $user->state)->value('name'):"";
         
         PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
         $pdf = PDF::loadView('admin.agents.posp_details_pdf',$data);
       
         $pData = ['row'=>$pdf->output(),'name'=>$filename];
         return  $pData;
    }
}

if(!function_exists('customerPolicyData')){
    function customerPolicyData($policy_no){
        $policy= DB::table('policy_saled')->where('policy_no',$policy_no)->first();
        $filename = "Document-".$policy_no.".pdf";
         
       
            $logo = get_site_settings('site_logo');
            $arrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $type = pathinfo($logo, PATHINFO_EXTENSION);
            $avatarData = file_get_contents($logo, false, stream_context_create($arrContextOptions));
            $avatarBase64Data = base64_encode($avatarData);
            $data['logo'] = 'data:image/' . $type . ';base64,' . $avatarBase64Data;
           
         $data['sale'] = $policy;
         
         PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
         $pdf = PDF::loadView('insurance.customer_filled_details_pdf',$data);
        // return $pdf->stream();
          $pData = ['row'=>$pdf->output(),'name'=>$filename];
         return  $pData;
    }
}

if(!function_exists('fatch_payment_info')) {
     function fatch_payment_info($paymentId=""){
            if($paymentId!=""){
                $username=(get_site_settings('rozar_key'))?get_site_settings('rozar_key'):'LvlAjd1woF5HJEE5EAbXZj7n';
                $password=(get_site_settings('rozar_secret'))?get_site_settings('rozar_secret'):'rzp_live_TCKGzAhT4oF1F4';
                $URL='https://api.razorpay.com/v1/payments/'.$paymentId;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$URL);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
                curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
                //curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
                $result=curl_exec ($ch);
                $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
                curl_close ($ch);
                $response = (json_decode($result));
                if(!isset($response->error)){
                    //print_r($response);
                    $mode = strtoupper($response->method);
                    $_PAY['vpa'] = $response->vpa;
                    $_PAY['card_id'] = $response->card_id;
                    $_PAY['bank'] = $response->bank;
                    $_PAY['wallet'] = $response->wallet;
                    $_PAY['mode'] = $mode;
                    $_PAY['note'] = $response->description;
                    $_PAY['response'] =$result;
                    DB::table("agent_payments")->where('transaction_id',$paymentId)->update($_PAY);
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
    }
}

if(!function_exists('convertToIndianCurrency')){
    function convertToIndianCurrency($number) {
    $no = round($number);
    $decimal = round($number - ($no = floor($number)), 2) * 100;    
    $digits_length = strlen($no);    
    $i = 0;
    $str = array();
    $words = array(
        0 => '',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
        } else {
            $str [] = null;
        }  
    }
    
    $Rupees = implode(' ', array_reverse($str));
    $paise = ($decimal) ? "And " . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10])." Paise "  : '';
    return ($Rupees ? $Rupees : '') . $paise . " Only";
}
}

