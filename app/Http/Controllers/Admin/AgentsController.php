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
use App\Resources\Posp;

use App\Exports\PospExport;
use Maatwebsite\Excel\Facades\Excel;

class AgentsController extends Controller{
     public function __construct(Posp $posp) { 
          $this->Posp = $posp;
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
        //send_pushnotification(4,"Register","Your Registration has been completed.");
        return View::make('admin.agents.agents')->with($template);
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
           
            $actualPrice = ($fee_amount*100)/(118);
            $totalTax = $fee_amount - $actualPrice;
            
            
              
              //$tax1 = intval(($fee_amount*9)/100);
             // $tax2 = intval(($fee_amount*9)/100);
             // $tax = intval(($fee_amount*18)/100);
             // $total =  $fee_amount+$tax;
               
               if($user->state!="" && $user->state==25){
                   
                   $cgst = round($totalTax/2);//round(($fee_amount*9)/100);
                   $sgst = round($totalTax/2);//round(($fee_amount*9)/100);
                   $data['cgst']='₹'.number_format((float)$cgst, 2, '.', '').'/-';
                   $data['sgst']='₹'.number_format((float)$sgst, 2, '.', '').'/-';
                   $data['igst']='₹00.00/-';
                   $data['total'] = '₹'.number_format((float)($fee_amount), 2, '.', '');
                   $data['payble'] = number_format((float)($fee_amount), 2, '.', '');
               }else{
                   
                   $igst = round($totalTax);
                   $data['cgst']='₹00.00/-';
                   $data['sgst']='₹00.00/-';
                   $data['igst']='₹'.number_format((float)$igst, 2, '.', '').'/-';
                   $data['total'] = '₹'.number_format((float)($fee_amount), 2, '.', '');
                   $data['payble'] = number_format((float)($fee_amount), 2, '.', '');
               }
         $data['fee_payment'] = '₹'.number_format((float)($actualPrice), 2, '.', '');
         $data['user'] = $user;
         $data['user_city'] = ($user->city!="" && $user->city>0)?DB::table('cities')->where('id', $user->city)->value('name'):"";
         $data['user_state'] = ($user->state!="" && $user->state>0)?DB::table('states')->where('id', $user->state)->value('name'):"";
         $data['pay'] = $pay;
         PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
          $pdf = PDF::loadView('pos.feepayments.taxinvoice',$data);
        
        // return $pdf->stream();
        $headers =[
                    'Content-Description' => 'File Transfer',
                    'Content-Type' => 'application/pdf',
                ];
         //$pdf->save('public/assets'.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        
        return $pdf->download($filename.'.pdf',$filename.'.pdf',$headers);
       // return Response::download($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        // $pData = ['row'=>$pdf->output(),'name'=>$filename];
        // return  $pData;
        
        // $data["body"]="";
        // Mail::send('templates.mail_freame', $data, function($message)use($data,$pdf) {
        //             $message->to('praveen.patidar10@gmail.com', "Praveen Patidar")
        //             ->subject('Test Attach')
        //             ->attachData($pdf->output(), "invoice.pdf");
        //             $message->from("care@supersolutions.in",'Supersolutions');
        //             });
        
    }
    
    
     public function getPaymentsdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $searchTerm = ($request->input('columns.0.search.value'))?:"";
        $pospTerm = ($request->input('columns.1.search.value'))?:"";
        $transactionTerm = ($request->input('columns.2.search.value'))?:"";
        //$testTerm = ($request->input('columns.3.search.value'))?:"";
        
        $query = DB::table('agent_payments')->join('agents', 'agent_payments.agent_id', '=', 'agents.id'); 
        
        $query->select('agent_payments.*','agents.name as pospName','agents.posp_ID as pospId')
               ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('agents.name','LIKE', "%{$searchTerm}%")->orWhere('agents.email', 'LIKE', "%{$searchTerm}%")->orWhere('agents.mobile', 'LIKE', "%{$searchTerm}%");
                })
              ->when($pospTerm, function ($query, $pospTerm) {
                  return $query->where('agents.posp_ID', "LIKE","%{$pospTerm}%");
                })->when($transactionTerm, function ($query, $transactionTerm) {
                  return $query->where('agent_payments.transaction_id', "LIKE","%{$transactionTerm}%");
                });
              
              
        $totalFiltered = $query->count();
        $users = $query->orderBy("id", "DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('agent_payments')->count();
        $result=[];$i=($start+1);
         foreach($users as $each){
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['invoice']      = $each->invoice_no;
                $eachData['paymentId']    = $each->transaction_id;
                $eachData['pospName']     =  $each->pospName;
                $eachData['pospId']       = $each->pospId;
                $eachData['amount']       =  "₹".$each->total_amount;
                $eachData['date']         = $each->transaction_date;
                $eachData['action']='<a target="_blank" href="'.url('agent/get-tax-invoice/'.$each->agent_id).'">Download</a>';
              
                $result[] = $eachData; 
              
             $i++; 
         }
         $json_data = array(
           "draw"            => intval($request->input('draw')),  
           "recordsTotal"    => intval($totalRecords),  
           "recordsFiltered" => intval($totalFiltered),  
           "data"            => $result   
           );
        echo json_encode($json_data); 
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
    
    //  private function genratePOSPId($agentId){
            
            
    //         $agInfo = DB::table('agents')->where('id',$agentId)->first();
    //         if($agInfo->cert_serial!="" && $agInfo->cert_serial>0){
    //              DB::table('agents')->where('id', $agentId)->update(['cert_serial' =>0]);
    //         }
    //         $serial = DB::table('agents')->max('cert_serial');
    //         $num = $serial+1; 
    //         $v = 10000+$num;
    //         $pospID  = (get_site_settings('pospID_prefix')!="")?get_site_settings('pospID_prefix').$v:"SS/POSP/A".$v;
    //          DB::table('agents')
    //             ->where('id', $agentId)
    //             ->update(['cert_serial' => $num,'posp_ID'=>$pospID]);
    //         return $pospID;
    // }
    
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
          $id = DB::table('agents')->insertGetId($data);
          if($id){
             
              $TEMP = getMailSmsInfo($id,'POSP_REGISTER');
               sendNotification($TEMP);
               userLog(['user_id'=>$id,'type'=>"POSP",'action'=>"POSP_REGISTER",'message'=>"Registered",'created_at'=>date('Y-m-d H:i:s')]);
              return Response::json(array('status'=>'success','message'=>"Agents registered successfully"));
          }else{
              return Response::json(array('status'=>'error','message'=>"Someting went wrong while register"));
          }
    }
    
     public function editPersonal(Request $request){
        $info = $this->Posp->profileCompleteData($request->id);
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
        $info = $this->Posp->profileCompleteData($request->id);
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
        $profileStatus = $this->Posp->profileCompleteData($request->id);
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
     
    
     public function otherInfoupdate(Request $request){
         $data = Agents::find($request->_agent);
         $spVal = $data->mapped_sp;
         if(isset($request->sp_id)){       $data->mapped_sp = $request->sp_id; $message="Specified Person updated successfully";}
         else if(isset($request->hdfc_id)){  $data->hdfc_id = $request->hdfc_id; $message="HDFC ID updated successfully";}
         
         if(isset($request->sp_id)){ 
             $sp = DB::table('users')->where('id',$request->sp_id)->first();
             if($spVal==""){
                userLog(['user_id'=>$request->_agent,'type'=>"POSP",'action'=>"SP_ASSIGNED",'message'=>$sp->name." has been assigned as Relationship Manager.",'created_at'=>date('Y-m-d H:i:s')]);
             }else if($spVal!=$request->sp_id){
                 userLog(['user_id'=>$request->_agent,'type'=>"POSP",'action'=>"SP_ASSIGNED",'message'=>$sp->name." has been re-assigned as Relationship Manager.",'created_at'=>date('Y-m-d H:i:s')]); 
             }    
             
          }
         
          if($data->save()){
              return Response::json(array('status'=>'success','message'=>$message));
          }else{
              return Response::json(array('status'=>'error','message'=>"Something went wrong while information"));
          }
    }
    
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
             return Response::json(array('status'=>'success','message'=>"Tranning credentials successfully send to `".$to_email."`"));
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
        $info = $this->Posp->profileCompleteData($request->id);
        $agentData = Agents::select('*')->where('id',$request->id)->first(); 
        $template = ['title' => 'Agents',"subtitle"=>"Agents Details-[".$agentData->name."]",'info'=>$info,'agentData'=>$agentData,
                     'scripts'=>[asset('admin/js/page/agents.js')]];
        if(true){                
           return View::make('admin.agents.agent_info')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }
    
     public function getAgentsdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $searchTerm = ($request->input('columns.0.search.value'))?:"";
        $pospTerm = ($request->input('columns.1.search.value'))?:"";
        $statusTerm = ($request->input('columns.2.search.value'))?:"";
        $testTerm = ($request->input('columns.3.search.value'))?:"";
        
        $query = Agents::query(); 
        
        $query->select('*')->where('is_trashed','NO')
               ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('name','LIKE', "%{$searchTerm}%")->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$searchTerm}%");
                })
              ->when($pospTerm, function ($query, $pospTerm) {
                  return $query->where('posp_ID', "LIKE","%{$pospTerm}%");
                })
              ->when($statusTerm, function ($query, $statusTerm) {
                  if($statusTerm=='VERIFIED'){
                    return $query->where('isVerified', "=",1);
                  }else if($statusTerm=='UNDR_VRF'){
                     return $query->where(['isProceedSign'=>1,'isVerified'=>'0']);
                  }else if($statusTerm=='OTHR'){
                     return $query->where(['isProceedSign'=>0,'isVerified'=>'0']);
                  }
                 
                })
              ->when($testTerm, function ($query, $testTerm) {
                  if($testTerm=='ALLOWED'){
                     return $query->where('isTestAllow', "=",1);
                  }else if($testTerm=='BLOCKED'){
                     return $query->where(['isTestAllow'=>0,'is_tranning_complete'=>'YES']);
                  }else if($testTerm=='UNDR_TRN'){
                     return $query->where(['isTestAllow'=>0,'is_tranning_complete'=>'NO']);
                  }
              });
        $totalFiltered = $query->count();
        //$query->orderBy($order, $dir)
        $users = $query->orderBy("id", "DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  Agents::where('is_trashed','NO')->count();
        $result=[];$i=($start+1);
         foreach($users as $each){
               $profile = $this->Posp->profileCompleteData($each['id']);
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['name']         = ($each['name'])?ucwords(strtolower($each['name'])):"<span class='text-danger'>Not available</span>";
                 $eachData['mobile']      = $each['mobile'];
                 $eachData['email']      = ($each['email'])?strtolower($each['email']):"<span class='text-danger'>Not available</span>";
                 $eachData['code'] =($each['posp_ID']!="")?"<span class='text-success'>".$each['posp_ID']."</span>":"<span class='text-danger'>Pending</span>";
                $certification_count = DB::table('certification')->where('agent_id', $each['id'])->orderBy('id', 'desc')->count();
                if($certification_count){
                    $certification = DB::table('certification')->where('agent_id', $each['id'])->orderBy('id', 'desc')->first();
                    $certificate_link=url('/get/download/file/test-certificate/'.$certification->file);
                    $eachData['certificate_link']=(round($certification->obtained_marks)>=50)?'<a class="btn btn-sm btn-dark" href="'.$certificate_link.'" target="_blank" data-id="'.$certification->id.'"><i class="fa fa-download"></i> Download</a>':'<span class="text=danger">'.$certification_count.'- attempt</span>';
                }else{
                   $eachData['certificate_link'] ="<span class='text-warning'>Not attempted</span>";
                }
                $eachData['created_at']   = $each['created_at'];
                if($each['is_tranning_complete']=='YES'){
                  $eachData['isTestAllow'] =($each['isTestAllow'])?'<div style="cursor:pointer;" class="d-flex justify-content-between align-items-center  btn-testAllow" data-name="'.$each['name'].'" data-id="'.$each['id'].'" data-isTestAllow="'.$each['isTestAllow'].'"><span class="bg-success pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Allowed</span> </div>'
                                                                 :'<div style="cursor:pointer;" class="d-flex justify-content-between align-items-center  btn-testAllow" data-name="'.$each['name'].'" data-id="'.$each['id'].'" data-isTestAllow="'.$each['isTestAllow'].'"><span class="bg-danger pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Blocked</span> </div>';
                }else{
                     $eachData['isTestAllow'] = "<small class='text-warning'>Under Training</small>";
                }
                if($profile['iscomplete']==0 && $profile['payment_status']==0 && $profile['isProceedSign']==0 && $profile['isVerified']==0){
                    if($profile['complete']>50){$bg =" bg-success";}
                    else if($profile['complete']>30 && $profile['complete']<=50){$bg =" bg-warning";}
                    else{$bg =" bg-danger";}
                    
                    $status = '<div class="progress ht-15">
                                  <div class="progress-bar '.$bg.'" style="font-size:12px;width:'.$profile['complete'].'%" role="progressbar" aria-valuenow="'.$profile['complete'].'" aria-valuemin="0" aria-valuemax="100">'.$profile['complete'].'%</div>
                                </div>';
                     //$status =  "<small class='text-warning'>Incomplete Profile(".$profile['complete']."%)</small>";
                }else if($profile['iscomplete']==1 && $profile['payment_status']==0 && $profile['isProceedSign']==0 && $profile['isVerified']==0){
                     $status =  "<small class='text-warning'>Fee Pending</small>";
                }else if($profile['iscomplete']==1 && $profile['payment_status']==1 && $profile['isProceedSign']==1 && $profile['isVerified']==0){
                     $status =  "<small class='text-warning' style='font-size: 75%;'>Under verification</small>";
                }else if($profile['iscomplete']==1 && $profile['payment_status']==1 && $profile['isProceedSign']==1 && $profile['isVerified']==1){
                    $status =  "<span class='text-success'><i class='far fa-check-square tx-success mg-r-5'></i>verified</span>";
                }else{
                   $status =  "<small class=' text-danger'><i class='fas fa-times'></i> Not verified</small>";
                }
                $eachData['status'] = $status;
                
          $buttons ='<div class="btn-group" role="group" aria-label="Action Buttons" data-id="'.$each['id'].'" data-name="'.$each['name'].'" >
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Reset password"  href="#" data-id="'.$each['id'].'"  class="btn btn-dark reset-password" ><i class="icon ion-key"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Update details" target="_blank"  href="'.url('/agent/edit/personal/'.$each['id']).'" class="btn btn-primary"><i class="icon ion-gear-a"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="View details"  href="'.url('/agentinfo/'.$each['id']).'" class="btn btn-success"><i class="icon ion-clipboard"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Move to trash" data-id="'.$each['id'].'" data-name="'.$each['name'].'"  href="#" class="btn btn-danger btn-trash"><i class="icon ion-trash-a"></i></a>
                    </div>';
              if(true){ 
                $eachData['action']          = $buttons;  
              }else{
                $eachData['action']="";
              }
                $result[] = $eachData; 
              
             $i++; 
         }
         $json_data = array(
           "draw"            => intval($request->input('draw')),  
           "recordsTotal"    => intval($totalRecords),  
           "recordsFiltered" => intval($totalFiltered),  
           "data"            => $result   
           );
        echo json_encode($json_data); 
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
   
     public function allowTest(Request $request){
      $Cust = Agents::find($request->id);
      $Cust->isTestAllow = $request->isTestAllow;
      $param = ($request->isTestAllow)?"allowed":"not allowed";
       userLog(['user_id'=>$request->id,'type'=>"POSP",'action'=>"TEST",'message'=>"Certification test marked as ".$param,'created_at'=>date('Y-m-d H:i:s')]);
      if($Cust->save()){
          return Response::json(array('status'=>'success'));
      }else{
          return Response::json(array('status'=>'error'));
      }
    }
  
     public function updateVerificationStatus(Request $request){
          $agent = Agents::find($request->id);
          $agent->isVerified = $request->isVerified;
          
          if($agent->save()){
              $param = ($request->isVerified)?"verified":"not verified";
              if($request->isVerified){
               $TEMP = getMailSmsInfo($request->id,'POSP_VERIFIED');
               sendNotification($TEMP);
              }
            userLog(['user_id'=>$request->id,'type'=>"POSP",'action'=>"POSP_VERIFIED",'message'=>"Posp account marked as ".$param,'created_at'=>date('Y-m-d H:i:s')]);
            return Response::json(array('status'=>'success'));
          }else{
              return Response::json(array('status'=>'error'));
          }
      }
      
     public function trashStatus(Request $request){
          $agent = Agents::find($request->id);
          $param= $request->param;
          if($param=='move'){
              $agent->is_trashed = 'YES';
              $message = "Agent moved to trash successfully";
          }else if($param=='undo'){
              $agent->is_trashed = 'NO';
              $message = "Agent undo from trash successfully";
          }
          if($agent->save()){
              return Response::json(['status'=>'success','message'=>$message]);
          }else{
              return Response::json(['status'=>'error','message'=>"Something went wrong while process!"]);
          }
      }
    
     public function tranningCompletestatus(Request $request){
      $agent = Agents::find($request->id);
      $st = $request->st;
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
 

