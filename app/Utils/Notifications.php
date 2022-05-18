<?php
namespace App\Utils;
use Illuminate\Support\Facades\DB;
use App\Model\Agents;
use Auth;
use File as Fileuse;
use Response;
use Illuminate\Support\Facades\Mail;
use App\Utils\TaxInvoice;
use App\Utils\Posp;

class Notifications {
    
      public function __construct(){
            $this->taxinvoice =  new TaxInvoice;
            $this->posp = new Posp; 
      }
    
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
                   
                     $pdf = $this->taxinvoice->GenerateInvoicePdf($agentId);
                     $attach->status = true;
                     $attach->isRaw = true;
                     $attach->attachments = [$pdf['name']=>$pdf['row']];
            
               }
               if($action == "POSP_VERIFIED"){
                   
                     $pdf = $this->posp->pospVerifiedData($agentId);
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