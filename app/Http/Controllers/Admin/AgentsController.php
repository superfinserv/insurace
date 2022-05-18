<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use App\Model\Agents;
use App\Model\Categories;
use Carbon\Carbon;
use PDF;
use File;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Utils\Posp;
use App\Utils\TaxInvoice;
use App\Exports\PospExport;
use Maatwebsite\Excel\Facades\Excel;

class AgentsController extends Controller{
     public function __construct() { 
          $this->posp = new Posp;
          $this->taxinvoice = new TaxInvoice;
          $this->middleware('auth');
     }  


public function exportExcel()   {  
        return Excel::download(new PospExport, 'List-POSP-('.date('Y-m-d H:i:s A').').xlsx');  
    }
     
     public function hdfc_data_link(Request $request){ 
        $curl = curl_init();
            //   $id = Auth::user()->id;
            //   $agent=DB::table('agents')->where('id', $id)->first(); 
             
              if($request->ssoID!=""){
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://salesdiary.hdfclife.com/TEBTParPortal/integrate.do?_actionid=ext.userid.validate&userid='.$request->ssoID.'&channel=Broca&subchannel=SuperSolutions',
                    CURLOPT_RETURNTRANSFER => true,
                   // CURLOPT_POST => true,
                   // CURLOPT_POSTFIELDS => $postData,
                    CURLOPT_FOLLOWLOCATION => true
                    ));
                    
                    $output = curl_exec($curl);
                   // print_r($output);
                    $token = trim($output);
                    if($token!=""){
                       return response()->json(['status'=>'success','message'=>'Review data get successfully','data'=>['token'=>$token,'uid'=>$request->ssoID]]);
                    }else{
                        return response()->json(['status'=>'error','message'=>'unknown user access']);
                    }
                    curl_close($curl);
              }else{
                  return response()->json(['status'=>'error','message'=>'unknown user access']); 
              }
                    
                    
    }


     public function index(){
        $template = ['title' => 'POSP',"subtitle"=>"POSP List",
                     'scripts'=>[asset('admin/js/page/agents.js')]];
        if(true){  
         // echo  $this->posp->GenerateApplicationId();
        //send_pushnotification(4,"Register","Your Registration has been completed.");
        return View::make('admin.agents.agents')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
    public function trashList(){
        $template = ['title' => 'POSP',"subtitle"=>"POSP trash List",
                     'scripts'=>[asset('admin/js/page/agents.js')]];
        if(true){                
        return View::make('admin.agents.agents_trash')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
      public function applicationsList(){
        
        $template = ['title' => 'POSP',"subtitle"=>"POSP List",
                     'scripts'=>[asset('admin/js/page/agent-applications.js')]];
     if(true){   
       return View::make('admin.agents.agent_applications')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
    public function paymentsList(){
        $template = ['title' => 'POSP PAYMENTS',"subtitle"=>"PAYMENTS List",
                     'scripts'=>[asset('admin/js/page/agent-list-payments.js')]];
        if(true){   
        //send_pushnotification(4,"Register","Your Registration has been completed.");
        return View::make('admin.agents.payment-list')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
    
    function taxInvoiceDownload(Request $request){
            $agentID = $request->agentID;
            $user = DB::table('agents')->where('id',$agentID)->first();
            $pay = DB::table('agent_payments')->where('agent_id', $agentID)->first();
            $filename = "Invoice-".$pay->invoice_no;
            $pdf = $this->taxinvoice->DownloadInvoicePdf($agentID);
            $path = "public/assets/agents/pdf/taxinvoice";
           
            // $headers =[
            //         'Content-Description' => 'File Transfer',
            //         'Content-Type' => 'application/pdf',
            //       ];
        
         $pdf->save($path.'/'.$filename.'.pdf',$filename.'.pdf');
         return response()->download($path.'/'.$filename.'.pdf', $filename.'.pdf')->deleteFileAfterSend(true);
    }
    
     public function registerAgent(){
        $states = DB::table('states')->select('*')->get(); 
        $template = ['title' => 'Agents',"subtitle"=>"Add new Agent",'states'=>$states,
                     'scripts'=>[asset('admin/js/page/agents.js')]];
        if(true){                
        return View::make('admin.agents.agent_add')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
  
     public function savenewInfo(Request $request){
         $data['name'] = ucwords(strtolower($request->agent_name));
         $data['email'] = strtolower($request->email);
         $data['userType'] = isset($request->userType)?$request->userType:"POSP";
         $data['mobile'] = $request->mobile_no;
         $data['address'] = strtolower($request->address);
         $data['city'] = $request->city;
         $data['state'] = $request->state;
         $data['pincode'] = $request->pincode;
         $data['alternate_mobile'] = $request->alternate_mobile;
         $data['marital_status'] = isset($request->marital_status)?$request->marital_status:"Single";
         $data['sex'] = isset($request->gender)?$request->gender:"Male";
         $data['password']=Hash::make($request->agent_pass);
         $data['application_no'] = $this->posp->GenerateApplicationId($data['userType']);
         $id = DB::table('agents')->insertGetId($data);
          if($id){
             if($data['userType']=='SP'){
                 $this->posp->GeneratePospId($id);
             }
             $TEMP = getMailSmsInfo($id,'POSP_REGISTER');
             sendNotification($TEMP);
             return Response::json(array('status'=>'success','message'=>"Agents registered successfully"));
          }else{
              return Response::json(array('status'=>'error','message'=>"Someting went wrong while register"));
          }
    }
    
     public function editPersonal(Request $request){
        $info = $this->posp->profileCompleteData($request->id);
        $states = DB::table('states')->select('*')->get(); 
        $agentData = Agents::select('*')->where('id',$request->id)->first(); 
        $template = ['title' => 'Agents',"subtitle"=>"Personal Informations",'info'=>$info,'agentData'=>$agentData,'states'=>$states,
                     'scripts'=>[asset('admin/js/page/agents-personal.js')]];
       if(true){                
        return View::make('admin.agents.agent_personal')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
     public function personalInfoupdate(Request $request){
         $data = Agents::find($request->_agent);
         $data->name = $request->agent_name;
         $data->email = $request->email;
         $data->mobile = $request->mobile_no;
         $data->address = $request->address;
         $data->city = $request->city;
         $data->state = $request->state;
         $data->alternate_mobile = $request->alternate_mobile;
         $data->marital_status = isset($request->marital_status)?$request->marital_status:"Single";
         $data->sex = isset($request->gender)?$request->gender:"Male";
          if($data->save()){
              return Response::json(array('status'=>'success','message'=>"Agents information update successfully"));
          }else{
              return Response::json(array('status'=>'error','message'=>"Agents information update successfully"));
          }
    }
    
     public function editEducational(Request $request){
        $info = $this->posp->profileCompleteData($request->id);
        $agentData = Agents::select('*')->where('id',$request->id)->first(); 
        $template = ['title' => 'Agents',"subtitle"=>"Educational Informations",'info'=>$info,'agentData'=>$agentData,
                     'scripts'=>[asset('admin/js/page/agent-educational.js')]];
       if(true){                
        return View::make('admin.agents.agent_educational')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
     public function educationalInfoupdate(Request $request){
         $data = Agents::find($request->_agent);
         $data->educational_qualification = $request->qualification;
          if($data->save()){
              return Response::json(array('status'=>'success','message'=>"Qualification update successfully"));
          }else{
              return Response::json(array('status'=>'error','message'=>"Something went wrong while update Qualification"));
          }
     }
    
     public function editBank(Request $request){
        $banklist = DB::table('banklist')->select('*')->get(); 
        $agentData = Agents::select('*')->where('id',$request->id)->first(); 
        $template = ['title' => 'Agents',"subtitle"=>"Bank Informations",'agentData'=>$agentData,"banks"=>$banklist,
                     'scripts'=>[asset('admin/js/page/agent-bank.js')]];
       if(true){                
        return View::make('admin.agents.agent_bank')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
     public function bankInfoupdate(Request $request){
         $data = Agents::find($request->_agent);
         $data->bank_name = $request->bank_name;
         $data->account_holder_name = $request->ac_holder;
         $data->account_number = $request->ac_no;
         $data->ifsc_code = $request->ifsc_code;
          if($data->save()){
              return Response::json(array('status'=>'success','message'=>"Bank Information update successfully"));
          }else{
              return Response::json(array('status'=>'error','message'=>"Something went wrong while update Bank Information"));
          }
    }
    
     public function editDocument(Request $request){
        $agentData = Agents::select('*')->where('id',$request->id)->first(); 
        $template = ['title' => 'Agents',"subtitle"=>"Required Documents",'agentData'=>$agentData,
                     'scripts'=>[asset('admin/js/page/agent-document.js')]];
       if(true){                
        return View::make('admin.agents.agent_document')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
     public function documentInfoupdate(Request $request){
         $data = Agents::find($request->_agent);
         $data->pan_card_number = $request->pan_card_no;
         $data->adhaar_card_number = $request->address_proff;
          if($data->save()){
              return Response::json(array('status'=>'success','message'=>"Document Information update successfully"));
          }else{
              return Response::json(array('status'=>'error','message'=>"Something went wrong while update Document Information"));
          }
    }
    
     public function editIdentity(Request $request){
        $profileStatus = $this->posp->profileCompleteData($request->id);
        $agentData = Agents::select('*')->where('id',$request->id)->first(); 
        $template = ['title' => 'Agents',"subtitle"=>"Identity Informations",'agentData'=>$agentData,'profile'=>$profileStatus,
                     'scripts'=>[asset('admin/js/page/agent-identity.js')]];
       if(true){                
        return View::make('admin.agents.agent_identity')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
     public function editPayment(Request $request){
        $agentData = Agents::select('*')->where('id',$request->id)->first(); 
        $template = ['title' => 'Agents',"subtitle"=>"Payment Informations",'agentData'=>$agentData,'scripts'=>[asset('admin/js/page/agent-payment.js')]];
       if(true){                
        return View::make('admin.agents.agent_payment')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
     public function modalupdatePayment(Request $request){
         if($request->id!=""){
            $template['agentId'] = $request->id;
            $count = DB::table('agent_payments')->where('agent_id',$request->id)->count();
            if($count){ $template['pay'] = DB::table('agent_payments')->where('agent_id',$request->id)->first();}
            $template['count']  = $count;
            return View::make('admin.agents.model_payment_update')->with($template);
         }else{echo "Invalid Access";}
     }
     
     public function updatePayInfo(Request $request){
         $data['transaction_id'] = $request->transactionID;
         $data['transaction_date'] = $request->transactionDate;
         $data['mode'] = $request->transactionMode;
         $data['note'] = $request->transactionNote;
         $data['status'] = 1;
         $agntID = $request->agentID;
         $count = DB::table('agent_payments')->where('agent_id',$agntID)->count();
         if($count>0){
            $pay = DB::table('agent_payments')->where('agent_id',$agntID)->first();
            $data['total_amount'] =399.00;
            userLog(['user_id'=>$agntID,'type'=>"POSP",'action'=>"FEE_PAID",'message'=>"Tranning fee paid of 399.00",'created_at'=>date('Y-m-d H:i:s')]);
            DB::table('agent_payments')->where('id', $pay->id)->update($data);
            echo json_encode(['status'=>'success','message'=>"Payment updated successfully!"]);
         }else{
           $data['agent_id'] = $agntID;
           $data['total_amount'] =399.00;
            $id = DB::table('agent_payments')->insertGetId($data); 
            if($id){
              DB::table('agents')->where('id', $agntID)->update(['payment_status'=>1]);
              //$this->genratePOSPId($agntID);
              genratePOSPId($agntID);
              echo json_encode(['status'=>'success','message'=>"Payment updated successfully!"]);
            }else{
                echo json_encode(['status'=>'error','message'=>"Something went wrong while update!"]); 
            }
           
         }
     }
    
     public function editotherInformations(Request $request){
        $agentData = Agents::select('*')->where('id',$request->id)->first(); 
         $sps = DB::table('users')->where('role',3)->get();
         
        $template = ['title' => 'Agents',"subtitle"=>"Training Details",'agentData'=>$agentData,'sps'=>$sps,
                     'scripts'=>[asset('admin/js/page/agent-otherinfo.js')]];
        if($agentData->mapped_sp!=""){
          $template['mappedsp']=DB::table('users')->where('id',$agentData->mapped_sp)->first();
        }
       if(true){                
        return View::make('admin.agents.agent_otherInfo')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
     }
     
     public function activitylogInformations(Request $request){
        $agentData = Agents::select('*')->where('id',$request->id)->first(); 
        $logs = DB::table('logs')->where('user_id',$request->id)->where('type',"POSP")->get();
         
        $template = ['title' => 'Agents',"subtitle"=>"Activity Log",'agentData'=>$agentData,'logs'=>$logs];
       
       if(true){                
        return View::make('admin.agents.agent_activitylog')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
     }
     
    
    //  public function otherInfoupdate(Request $request){
    //      $data = Agents::find($request->_agent);
    //      $spVal = $data->mapped_sp;
    //      if(isset($request->sp_id)){       $data->mapped_sp = $request->sp_id; $message="Specified Person updated successfully";}
    //      else if(isset($request->hdfc_id)){  $data->hdfc_id = $request->hdfc_id; $message="HDFC ID updated successfully";}
         
    //      if(isset($request->sp_id)){ 
    //          $sp = DB::table('users')->where('id',$request->sp_id)->first();
    //          if($spVal==""){
    //             userLog(['user_id'=>$request->_agent,'type'=>"POSP",'action'=>"SP_ASSIGNED",'message'=>$sp->name." has been assigned as Relationship Manager.",'created_at'=>date('Y-m-d H:i:s')]);
    //          }else if($spVal!=$request->sp_id){
    //              userLog(['user_id'=>$request->_agent,'type'=>"POSP",'action'=>"SP_ASSIGNED",'message'=>$sp->name." has been re-assigned as Relationship Manager.",'created_at'=>date('Y-m-d H:i:s')]); 
    //          }    
             
    //       }
         
    //       if($data->save()){
    //           return Response::json(array('status'=>'success','message'=>$message));
    //       }else{
    //           return Response::json(array('status'=>'error','message'=>"Something went wrong while information"));
    //       }
    // }
    
     public function sendTranningcrd(Request $request){
         $agent = Agents::find($request->_agent);
         $to_name = $agent->name;
         $to_email = $agent->email;
         $Arr = ['username'=>$request->username,'pass'=>$request->pass,'sent_at'=>date('Y-m-d H:i:s')];
         $agent->tranning_crd = json_encode($Arr);
         if($agent->save()){
              $TEMP = getMailSmsInfo($request->_agent,'TRANNING_CRD');
              sendNotification($TEMP);
              userLog(['user_id'=>$request->_agent,'type'=>"POSP",'action'=>"TRANNING_CRD",'message'=>"Traning Credintials sent",'created_at'=>date('Y-m-d H:i:s')]);
              return Response::json(array('status'=>'success','message'=>"Training credentials successfully sent to `".$to_email."`"));
         }else{
             return Response::json(array('status'=>'error','message'=>"Something went wrong while information"));
         }
    }
    
    public function editSPmapping(Request $request){
        $agentData = Agents::select('*')->where('id',$request->id)->first(); 
        $sps = DB::table('users')->where('role',2)->get();
        $template = ['title' => 'Agents',"subtitle"=>"SP Mapping",'agentData'=>$agentData,'sps'=>$sps,
                     'scripts'=>[asset('admin/js/page/agent-otherinfo.js')]];
       if(true){                
        return View::make('admin.agents.agent_spmap')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
     }

    
     public function agentinfo(Request $request) {
        $info = $this->posp->profileCompleteData($request->id);
        $agentData = Agents::select('agents.*','states.name as state_name','cities.name as city_name')
                        ->leftJoin('states', 'states.id', '=', 'agents.state')
                        ->leftJoin('cities', 'cities.id', '=', 'agents.city')->where('agents.id',$request->id)->first(); 
        $template = ['title' => 'Agents',"subtitle"=>"Agents Details-[".$agentData->name."]",'info'=>$info,'agentData'=>$agentData,
                     'scripts'=>[asset('admin/js/page/agents.js')]];
        if(true){                
           return View::make('admin.agents.agent_info')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
    
     public function resetPasswordModel(Request $request){
         if($request->id!=""){
            $template['agentId'] = $request->id;
            return View::make('admin.agents.model_reset_password')->with($template);
         }else{echo "Invalid Access";}
     }
     
     public function updatePassword(Request $request){
           $agent = Agents::find($request->agentID);
           $agent->password =Hash::make($request->agentPass);
           if($agent->save()){
              return Response::json(['status'=>'success' ,'message'=>'Password reset successfully']);
           }else{
              return Response::json(['status'=>'error','message'=>'Somthing went wrong while reset password!']);
            }
     }
   
     public function certificates(Request $request){
        $agentData = Agents::select('*')->where('id',$request->id)->first(); 
        $certificates = DB::table('certification')->where('agent_id',$request->id)->orderBy('id','DESC')->get(); 
        $template = ['title' => 'Agents',"subtitle"=>"Certifications",'agentData'=>$agentData,'certificates'=>$certificates,
                     'scripts'=>[asset('admin/js/page/agent-certificate.js')]];
       if(true){                
        return View::make('admin.agents.agent_certificates')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      } 
    }
    
    public function ManagePospStatus(Request $request){
        $Posp =  Agents::find($request->id);
        if($request->param=='applicationStatus'){
            $Posp->application_status = $request->status;
            if($request->status=='Approved'){
                if($Posp->posp_ID!=""){
                  $pospID  = $this->posp->GeneratePospId($request->id);// will generate after Approved
                }  
                 $TEMP = getMailSmsInfo($request->id,'POSP_APP_APPROVED');
                 sendNotification($TEMP);
            }
            $Posp->save();
            return Response::json(['status'=>'success','message'=>'Application status '.$request->status.' successfully.']);
        }else if($request->param=='testStatus'){
             $Posp->is_tranning_complete = $request->status;
             $Posp->isTestAllow = $request->status;
             $Posp->save();
             userLog(['user_id'=>$request->id,'type'=>"POSP",'action'=>"TEST",'message'=>"Allow Certification test marked as ".$request->status,'created_at'=>date('Y-m-d H:i:s')]);
            return Response::json(['status'=>'success','message'=>'Information updated successfully.']);
        }else if($request->param=='trashStatus'){
             $Posp->is_trashed = $request->status;
             $Posp->save();
             userLog(['user_id'=>$request->id,'type'=>"POSP",'action'=>"TEST",'message'=>"Allow Certification test marked as ".$request->status,'created_at'=>date('Y-m-d H:i:s')]);
            return Response::json(['status'=>'success','message'=>'Information updated successfully.']);
        }else{
           return Response::json(['status'=>'error','message'=>'Something went wrong']);
        }
    }
   
    //  public function allowTest(Request $request){
    //   $Cust = Agents::find($request->id);
    //   $Cust->isTestAllow = $request->isTestAllow;
    //   $param = ($request->isTestAllow)?"allowed":"not allowed";
    //   userLog(['user_id'=>$request->id,'type'=>"POSP",'action'=>"TEST",'message'=>"Certification test marked as ".$param,'created_at'=>date('Y-m-d H:i:s')]);
    //   if($Cust->save()){
    //       return Response::json(array('status'=>'success'));
    //   }else{
    //       return Response::json(array('status'=>'error'));
    //   }
    //}
  
    //  public function updateVerificationStatus(Request $request){
    //       $agent = Agents::find($request->id);
    //       $agent->isVerified = $request->isVerified;
          
    //       if($agent->save()){
    //           $param = ($request->isVerified)?"verified":"not verified";
    //           if($request->isVerified){
    //           $TEMP = getMailSmsInfo($request->id,'POSP_VERIFIED');
    //             sendNotification($TEMP);
    //           }
    //         userLog(['user_id'=>$request->id,'type'=>"POSP",'action'=>"POSP_VERIFIED",'message'=>"Posp account marked as ".$param,'created_at'=>date('Y-m-d H:i:s')]);
    //         return Response::json(array('status'=>'success'));
    //       }else{
    //           return Response::json(array('status'=>'error'));
    //       }
    //   }
      
    //  public function trashStatus(Request $request){
    //       $agent = Agents::find($request->id);
    //       $param= $request->param;
    //       if($param=='move'){
    //           $agent->is_trashed = 'YES';
    //           $message = "Agent moved to trash successfully";
    //       }else if($param=='undo'){
    //           $agent->is_trashed = 'NO';
    //           $message = "Agent undo from trash successfully";
    //       }
    //       if($agent->save()){
    //           return Response::json(['status'=>'success','message'=>$message]);
    //       }else{
    //           return Response::json(['status'=>'error','message'=>"Something went wrong while process!"]);
    //       }
    //   }
    
     public function tranningCompletestatus(Request $request){
      $agent = Agents::find($request->id);
      $trstatus = $agent->is_tranning_complete;
      $testStatus = $agent->isTestAllow;
      if($st=='checked'){
          DB::table('agents')->where('id',$request->id)->update(['is_tranning_complete'=>'YES']);
          return Response::json(array('status'=>'success','message'=>'Marked agent tranning completed successfully. Please upload certificates'));
      }else if($st=="unchecked"){
         if($testStatus==1){
            return Response::json(array('status'=>'error','message'=>'Please First Disable Test Allow status.'));
         }else{
            if($trstatus=='YES'){
               if($agent->life_ins_cert=="" && $agent->general_ins_cert==""){
                       
                    DB::table('agents')->where('id',$request->id)->update(['is_tranning_complete'=>'NO','life_ins_cert'=>NULL,"general_ins_cert"=>NULL]);
                   return Response::json(array('status'=>'success','message'=>'Marked successfully agent as under tranning.'));
               }else{
                    return Response::json(array('status'=>'error','message'=>'Please First Remove uploded certificates.'));
               }  
            }else{
                 DB::table('agents')->where('id',$request->id)->update(['is_tranning_complete'=>'NO','life_ins_cert'=>NULL,"general_ins_cert"=>NULL]);
                 return Response::json(array('status'=>'success','message'=>'Marked successfully agent as under tranning.'));
            }
         } 
      }else{
          return Response::json(array('status'=>'error','message'=>'Unknown status found..'));
      }
    }
    
    
}
 

