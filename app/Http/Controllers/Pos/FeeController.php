<?php 
namespace App\Http\Controllers\Pos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use File;
use Illuminate\Support\Facades\Hash;
use App\Model\Agents;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\User;
//use App\Utils\AppUtil;
use Illuminate\Support\Facades\Mail;
use App\Resources\Posp;
class FeeController extends Controller{
     
   public function __construct(Posp $posp) { 
        $this->Posp = $posp; 
        //$this->middleware('auth');
       
   }
    
    /* Payment Handleing methods */
  
    
    public function payment_process(Request $request){
         $id = Auth::guard('agents')->user()->id;
        //   $TEMP = getMailSmsInfo(Auth::guard('agents')->user()->id,'POSP_FEE_PAID');
        //   sendNotification($TEMP);
         $data= $this->Posp->profileCompleteData($id);
         $agent=Agents::select('*')->where('id', $id)->get()->toArray();
         $topBanks=DB::table('rozar_netBank')->where('status', 1)->where('is_top',1)->get();
         $otherBanks=DB::table('rozar_netBank')->where('status', 1)->get();
         //$_fee = intval((float)get_site_settings('posp_application_fee'));
         $fee = intval((float)get_site_settings('posp_application_fee'));
         $tax = intval(($fee*18)/100);
         $total =  $fee+$tax;
         //$fee = $_fee+61;
         $template = ['title' => 'profile',"subtitle"=>"profile",'fee'=>$total,
                     'scripts'=>[asset('js/creditCardValidator.js'),asset('page_js/pospJs/payment.js')],
                     'agent'=>$agent,'data'=>$data,'otherBanks'=>$otherBanks,'topBanks'=>$topBanks];
      
        return View::make('pos.feepayments.payment')->with($template);
    }
     
    public  function initOrder(Request $request){
         
        $orderNo=uniqid().date('Ymdhis');
        $username='rzp_live_TCKGzAhT4oF1F4';
        $password='LvlAjd1woF5HJEE5EAbXZj7n';
        $URL='https://api.razorpay.com/v1/orders';
        $amt =$request->amount;
        $amount = round($amt*100);
        $params["amount"]=$amount; $params["currency"]="INR"; $params["receipt"]="Receipt-".$orderNo; $params["payment_capture"]=1;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$URL);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
        $result=curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
        curl_close ($ch);
        $data =  json_decode($result);
       
        if(isset($data->id) && $data->id!=""){
          echo json_encode(["status"=>"success","data"=>$data]);
        }else{
          echo json_encode(["status"=>"error","data"=>$data]);
        }
    }
    
    public function loadPaymentInfo(){
      $data['secret'] = get_site_settings('rozar_secret');
      $data['key'] = get_site_settings('rozar_key');
      $fee = intval((float)get_site_settings('posp_application_fee'));
      $tax = intval(($fee*18)/100);
      $total =  $fee+$tax;
      $data['fee'] = $total;//intval((float)get_site_settings('posp_application_fee'));
      $data['logo'] = get_site_settings('site_logo');
      
      return response()->json(['status'=>'success','data'=>$data]);
    }
   
    public function createPayment(Request $request){
         if(Auth::guard('agents')->user()->id!=""){ 
                 $agentId = Auth::guard('agents')->user()->id;
           
                        
                    fatch_payment_info($request->paymentId);
                    
                    $username=(get_site_settings('rozar_secret'))?get_site_settings('rozar_secret'):'rzp_live_TCKGzAhT4oF1F4';
                    $password=(get_site_settings('rozar_key'))?get_site_settings('rozar_key'):'LvlAjd1woF5HJEE5EAbXZj7n';
                    $URL='https://api.razorpay.com/v1/payments/'.$request->paymentId.'/capture';
                    $amount = round($request->respData['amount']/100);
                    $params["amount"]=$amount;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$URL);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
                    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
                    curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
                    $result=curl_exec ($ch);
                    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
                    curl_close ($ch);
                  $user = Agents::find($agentId); 
                  $user->payment_status =1;
                  $user->save();
                 // $pospID  = $this->genratePOSPId(Auth::guard('agents')->user()->id);
                  $pospID  = genratePOSPId(Auth::guard('agents')->user()->id);
                  
                  
                  $invoice_no = str_replace("/","",$pospID);//date('siHdmY').$agentId;
                  
                  $actual = ($request->respData['amount']/100);
                  $amt  = number_format((float)$actual, 2, '.', '');
                  $id = DB::table('agent_payments')->insertGetId(['mode'=>$request->mode,'agent_id'=>$agentId,'invoice_no'=>$invoice_no,'status'=>1,'transaction_date'=>date('Y-m-d H:i:s'),
                                                             'transaction_id'=>$request->paymentId,'total_amount'=>$amt]); 
                  
                  
                  $TEMP = getMailSmsInfo(Auth::guard('agents')->user()->id,'POSP_FEE_PAID');
                  sendNotification($TEMP);
                  userLog(['user_id'=>$agentId,'type'=>"POSP",'action'=>"FEE",'message'=>"Paid Fee of ".$actual,'created_at'=>date('Y-m-d H:i:s')]);
                   
                  return response()->json(['status'=>'success','message'=>'Application fee paid successfully','data'=>['payid'=>$id]]);
             
             
          }else{
            return response()->json(['status'=>'error','message'=>'User session is expired, login and try again!']);
          }
    }
    
    //  private function genratePOSPId($agentID){
    //         $agInfo = DB::table('agents')->where('id',$agentID)->first();
    //         if($agInfo->cert_serial!="" && $agInfo->cert_serial>0){
    //              DB::table('agents')->where('id', $agentID)->update(['cert_serial' =>0]);
    //         }
    //         $serial = DB::table('agents')->max('cert_serial');
    //         $num = $serial+1; 
    //         $v = 10000+$num;
    //         $pospID  = (get_site_settings('pospID_prefix')!="")?get_site_settings('pospID_prefix').$v:"SS/POSP/A".$v;
    //          DB::table('agents')
    //             ->where('id', $agentID)
    //             ->update(['cert_serial' => $num,'posp_ID'=>$pospID]);
    //         return $pospID;
    //     }
    
    public function pay_success(Request $request){
         $agentId = Auth::guard('agents')->user()->id;
         $info=DB::table('agent_payments')->where('agent_id',$agentId)->orderBy('id', 'desc')->limit(1)->first();
         $template = ['title' => 'Application fee',"subtitle"=>"success",'info'=>$info];
         return View::make('pos.feepayments.success')->with($template);
    }
    
    public function taxInvoice(Request $request){
         $TEMP = getMailSmsInfo(Auth::guard('agents')->user()->id,'POSP_FEE_PAID');
         sendNotification($TEMP);
    //         $filename = "Invoice-".Auth::guard('agents')->user()->id;
    //         $path = dirname(getcwd(),1)."/insassets/agents/pdf/taxinvoice";
    //         if(!File::exists($path)) {
    //             File::makeDirectory($path, $mode = 0755, true, true);
    //         } 
       
    //         $logo = "https://insurance.supersolutions.in/img/site_logo/logo_5.png";
    //         $arrContextOptions=array(
    //                         "ssl"=>array(
    //                             "verify_peer"=>false,
    //                             "verify_peer_name"=>false,
    //                         ),
    //                     );
    //         $type = pathinfo($logo, PATHINFO_EXTENSION);
    //         $avatarData = file_get_contents($logo, false, stream_context_create($arrContextOptions));
    //         $avatarBase64Data = base64_encode($avatarData);
    //         $data['logo'] = 'data:image/' . $type . ';base64,' . $avatarBase64Data;
            
    //      $user =  Auth::user();
    //      $data['user'] = $user;
    //      $data['user_city'] = ($user->city!="" && $user->city>0)?DB::table('cities_list')->where('id', $user->city)->value('name'):"";
    //      $data['user_state'] = ($user->state!="" && $user->state>0)?DB::table('states_list')->where('id', $user->state)->value('name'):"";
         
    //      PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
    //      $pdf = PDF::loadView('feepayments.taxinvoice',$data);
       
      
    //     // return $pdf->stream();
    //     //  $headers =[
    //     //             'Content-Description' => 'File Transfer',
    //     //             'Content-Type' => 'application/pdf',
    //     //         ];
    //      //$pdf->save($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        
    //     //return $pdf->download($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
    //   // return Response::download($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        
    //     $data["body"]="";
    //     Mail::send('templates.mail_freame', $data, function($message)use($data,$pdf) {
    //                 $message->to('praveen.patidar10@gmail.com', "Praveen Patidar")
    //                 ->subject('Test Attach')
    //                 ->attachData($pdf->output(), "invoice.pdf");
    //                 $message->from("care@supersolutions.in",'Supersolutions');
    //                 });
        
        //  $agentId = Auth::guard('agents')->user()->id;
        //  $info=DB::table('agent_payments')->where('agent_id',$agentId)->orderBy('id', 'desc')->limit(1)->first();
        //  $template = ['title' => 'Application fee',"subtitle"=>"success",'info'=>$info];
        //  return View::make('pos.feepayments.taxinvoice')->with($template);
    }
    
    public function pay_fail(Request $request){
         $agentId = Auth::guard('agents')->user()->id;
         if($agentId){
           $template = ['title' => 'Application fee',"subtitle"=>"fail"];
         return View::make('pos.feepayments.error')->with($template);
         }else{
             return redirect('/');
         }
    }
     
 }