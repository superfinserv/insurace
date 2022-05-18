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
use App\Resources\Razorpay;
use Illuminate\Support\Facades\Mail;
use App\Utils\Posp;
use App\Utils\Notifications;
class FeeController extends Controller{
     
   public function __construct() { 
        $this->posp = new Posp; 
        $this->razorpay  = new Razorpay;
        $this->notify =  new Notifications;
   }
    
    /* Payment Handleing methods */
  
    
    public function payment_process(Request $request){
         $id = Auth::guard('agents')->user()->id;
          
         $data= $this->posp->profileCompleteData($id);
         $agent=Agents::select('*')->where('id', $id)->first();
         
         $template = ['title' => 'profile',"subtitle"=>"profile",
                     'scripts'=>[asset('js/creditCardValidator.js'),'https://checkout.razorpay.com/v1/checkout.js',asset('page_js/pospJs/payment.js')],
                     'agent'=>$agent,'data'=>$data];
              
              $totalAmount = $fee['totalAmount'] = (float)(config('custom.posp_application_fee'));
              $totalActualPrice = $fee['totalActualPrice'] = number_format((float)(($totalAmount*100)/(118)), 2, '.', '');
              $tax1 = number_format((float)(($totalActualPrice*9)/100), 2, '.', '');//intval(($totalActualPrice*9)/100);
              $tax2 = number_format((float)(($totalActualPrice*9)/100), 2, '.', '');//intval(($totalActualPrice*9)/100);
              $tax = number_format((float)(($totalActualPrice*18)/100), 2, '.', '');//intval(($totalActualPrice*18)/100);
    
               
               if($agent->state!="" && $agent->state==25){
                   $cgst = ($tax1);//round(($fee_amount*9)/100);
                   $sgst = ($tax2);//round(($fee_amount*9)/100);
                   $fee['cgst']=number_format((float)$cgst, 2, '.', '');
                   $fee['sgst']=number_format((float)$sgst, 2, '.', '');
                   $fee['igst']=00.00;
                   $fee['total'] = number_format((float)($totalAmount), 2, '.', '');
                   $fee['payble'] =number_format((float)($totalAmount), 2, '.', '');
               }else{
                   $igst = ($tax);
                   $fee['cgst']=00.00;
                   $fee['sgst']=00.00;
                   $fee['igst']=number_format((float)$igst, 2, '.', '');
                   $fee['total'] = number_format((float)($totalAmount), 2, '.', '');
                   $fee['payble'] = number_format((float)($totalAmount), 2, '.', '');
               }
        $template['fee'] =$fee;
        return View::make('pos.feepayments.payment')->with($template);
    }
     
    // public  function initOrder(Request $request){
         
    //     $orderNo=uniqid().date('Ymdhis');
    //     $username='rzp_live_TCKGzAhT4oF1F4';
    //     $password='LvlAjd1woF5HJEE5EAbXZj7n';
    //     $URL='https://api.razorpay.com/v1/orders';
    //     $amt =$request->amount;
    //     $amount = round($amt*100);
    //     $params["amount"]=$amount; $params["currency"]="INR"; $params["receipt"]="Receipt-".$orderNo; $params["payment_capture"]=1;
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL,$URL);
    //     curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    //     curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    //     curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    //     curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
    //     $result=curl_exec ($ch);
    //     $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
    //     curl_close ($ch);
    //     $data =  json_decode($result);
       
    //     if(isset($data->id) && $data->id!=""){
    //       echo json_encode(["status"=>"success","data"=>$data]);
    //     }else{
    //       echo json_encode(["status"=>"error","data"=>$data]);
    //     }
    // }
    
    public function loadPaymentInfo(){
      //$data['secret'] = config('custom.rozar_secret');
      $data['key'] = config('custom.rozar_key');
      $fee = intval((float)config('custom.posp_application_fee'));
      //$tax = intval(($fee*18)/100);
     // $total =  $fee+$tax;
      $data['fee'] = $fee;//intval((float)get_site_settings('posp_application_fee'));
      $data['logo'] = config('custom.site_logo');
      $data['siteName'] = config('custom.site_name');
      $data['siteAddress'] = config('custom.contact_address');
       $id = Auth::guard('agents')->user()->id;
       $data['agent']=Agents::select('*')->where('id', $id)->first();
      
      return response()->json(['status'=>'success','data'=>$data]);
    }
   
    public function createPayment(Request $request){
         if(Auth::guard('agents')->user()->id!=""){ 
                  $agentId = Auth::guard('agents')->user()->id;
                  $fetcRes = $this->razorpay->FatchPaymentInfo($request->paymentId);
                      if($fetcRes['status']){
                            //$pospID  = $this->posp->GeneratePospId(Auth::guard('agents')->user()->id);// will generate after Approved
                            $applicationNo  = Auth::guard('agents')->user()->application_no;
                            $invoice_no = str_replace("/","",$applicationNo);//"INV-".$applicationNo;
                          
                            $response  =  $fetcRes['data']; 
                            $actual = ($response['amount']/100);
                            $amt  = number_format((float)$actual, 2, '.', '');
                            
                            $mode = strtoupper($response['method']);
                            $_PAY['vpa'] = $response['vpa'];
                            $_PAY['card_id'] = $response['card_id'];
                            $_PAY['bank'] = $response['bank'];
                            $_PAY['wallet'] = $response['wallet'];
                            $_PAY['mode'] = $mode;
                            $_PAY['note'] = $response['description'];
                            $_PAY['response'] =json_encode($response);
                            $_PAY['agent_id']=$agentId;
                            $_PAY['invoice_no']=$invoice_no;
                            $_PAY['status']=1;
                            $_PAY['transaction_date']=date('Y-m-d H:i:s');
                            $_PAY['transaction_id']=$request->paymentId;
                            $_PAY['total_amount']=$amt;
                            DB::table("agent_payments")->insertGetId($_PAY);
                            
                         //$amount = round($request->amount/100);
                         $captureRes = $this->razorpay->CapturePayment($request->paymentId,$response['amount']);    
                      }
                    
                  $user = Agents::find($agentId); 
                  $user->payment_status ='Paid';
                  $user->save();
                 
                 
                  $TEMP = $this->notify->getMailSmsInfo(Auth::guard('agents')->user()->id,'POSP_FEE_PAID');
                  $this->notify->sendNotification($TEMP);
                  //userLog(['user_id'=>$agentId,'type'=>"POSP",'action'=>"FEE",'message'=>"Fee Paid successfully",'created_at'=>date('Y-m-d H:i:s')]);
                   
                  return response()->json(['status'=>'success','message'=>'Application fee of paid successfully','data'=>['payid'=>0]]);
             
             
          }else{
            return response()->json(['status'=>'error','message'=>'User session is expired, login and try again!']);
          }
    }
    
    public function pay_success(Request $request){
         $agentId = Auth::guard('agents')->user()->id;
         $info=DB::table('agent_payments')->where('agent_id',$agentId)->orderBy('id', 'desc')->limit(1)->first();
         $template = ['title' => 'Application fee',"subtitle"=>"success",'info'=>$info];
         return View::make('pos.feepayments.success')->with($template);
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