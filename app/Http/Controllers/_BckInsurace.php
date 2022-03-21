<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Resources\ManipalResource;
use App\Resources\CareResource;
use App\Resources\FgiResource;
use App\Resources\DigitResource;
use App\Resources\FgiCarResource;
use App\Resources\DigitCarResource;

    
class BckInsurace extends Controller{
    
    public function __construct(ManipalResource $ManipalResource,
                                CareResource $CareResource,
                                FgiResource $FgiResource,
                                DigitResource $DigitResource,
                                FgiCarResource $FgiCarResource,
                                DigitCarResource $DigitCarResource) { 
       $this->ManipalResource = $ManipalResource;
       $this->CareResource = $CareResource;
       $this->FgiResource = $FgiResource;
       $this->DigitResource = $DigitResource;
       
       $this->FgiCarResource = $FgiCarResource;
       $this->DigitCarResource = $DigitCarResource;
   }
    
    public function getMonths(Request $request){
        $months  = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec'];
        $arr=[];
        if(isset($request->year)){
            if($request->year==date('Y')){
                for($m=01;$m<=date('m');$m++){
                    
                    $m = ($m<10)?"0".$m:$m;
                     array_push($arr,['key'=>$m,'value'=>$months[$m]]); 
                }
                return response()->json($arr);
            }else{
               foreach($months as $key=>$value){
                 array_push($arr,['key'=>$key,'value'=>$value]); 
               } 
               return response()->json($arr);
            }
        }else{
             foreach($months as $key=>$value){
               array_push($arr,['key'=>$key,'value'=>$value]); 
             }
             return response()->json($arr);
        }
    }
    
    public function getCities(Request $request){
        $cities = DB::table('cities_list')->select(DB::raw("CONCAT(id,'-',name) AS id,name as value"))->where('state_id',$request->state_id)->get();
        return response()->json(['status'=>'success','message'=>'Cities get successfully','data'=>$cities]);
    }
    
    public function getCityPincode(Request $request){
         $pincode = DB::table('pincode_masters')->select('pincode')->where('taluk','=',$request->city)->orderBy('pincode','asc')->value('pincode');
         return response()->json(['status'=>'success','message'=>'pincode get successfully','pincode'=>$pincode]);
     }
    
    function termsConditionsModel(Request $request){
        $temp['type'] = $request->type;
        $temp['supplier'] = $request->supplier;
        return View::make('insurance.terms_conditions_model')->with($temp);
    }
    
    function loadidvModal(Request $request){
         $data = DB::table('app_temp_quote')
                     ->select(DB::raw('MIN(min_idv) as minval,MAX(max_idv) as maxval'))
                     ->where(['device'=>$request->device,'type'=>$request->type])->first();
        //print_r($data);
         $temp['typ'] = $request->type;
         $temp['idv'] = $data;//['min'=> $data->minval,'max'=>$data->maxval];
         return View::make('insurance.idv_modal')->with($temp);
    }
    
    function load_TP_details_Modal(Request $request){
        $temp['previous_insurer'] = DB::table('previous_insurer')->where(['status'=>'ACTIVE','type'=>'GENERAL'])->get();
        $temp['type'] = $request->type;
        return View::make('insurance.moter_tp_details')->with($temp);
    }
    
    function moterPremiumBreakupModal(Request $request){
         $refId =  $request->refId;
         $typ   =  $request->typ;
         if($typ=='quote'){
             $info =   DB::table('app_temp_quote')->where('quote_id',$refId)->first();
             $temp['info'] =$info; 
             $temp['data']  = json_decode($info->json_data);
         }else{
             $info =   DB::table('app_quote')->where('enquiry_id',$refId)->first();
             $temp['info'] =$info;
             $temp['data']  = json_decode($info->json_data);
         }
         return View::make('insurance.moter_premium_breakup')->with($temp);
    }
    
    function getminMaxassValue(Request $request){
        $data = DB::table('app_temp_quote')
                     ->select(DB::raw('MIN(min_idv) as minval,MAX(max_idv) as maxval'))
                     ->where(['device'=>$request->device,'type'=>$request->type])->first();
         $elemin = round(($data->minval*0.01)/100);
         $elemax =  round(($data->minval*15)/100);
         
         $nelemin =  round(($data->minval*0.01)/100);
         $nelemax =  round(($data->minval*10)/100);
         
         $resp = ['electrical'=>['min'=>$elemin,'max'=>$elemax],'nonelectrical'=>['min'=>$nelemin,'max'=>$nelemax]];
         
             return response()->json($resp);
    }
    
    function genratePaymentLink(Request $request){
        if($request->enquiryID){
            $count = DB::table('app_quote')->where('enquiry_id',$request->enquiryID)->count();
            if($count){
                $data = DB::table('app_quote')->where('enquiry_id',$request->enquiryID)->first();
                $encrypted = Crypt::encryptString($data->id);
                $url = url(strtolower($data->type)."-insurance/policy/payments/".$request->enquiryID."?target=".$encrypted);
                $html = '<div class="input-group mb-3">
                              <input value='.$url.' type="text" class="form-control" readonly id="input-payment-link" aria-describedby="copyClipboard" style="border: 1px dashed;">
                              <div class="input-group-append">
                                <span class="input-group-text" id="copyClipboard"><i style="font-size: 18px;" class="fa fa-copy"></i></span>
                              </div>
                            </div>';
                return response()->json(['status'=>true,'message'=>'invalid request.','data'=>$html]); 
            }else{
              return response()->json(['status'=>false,'message'=>'invalid request.']); 
            }
        }else{
           return response()->json(['status'=>false,'message'=>'invalid request.']); 
        }
    }
    
    //https://insurance.supersolutions.in/health-insurance/insured-success/digit_health?policyNumber=D400428382&transactionNumber=12_DT-DI17513D80CC0D-1
    function healthtransactionupdate(Request $request){
         $this->loaderPage();
         @csrf;
         //echo $request->enquiryID;
        if($request->enquiryID!=""){
            if(strtolower($request->enquiryID)=="digit_health"){
                //12_DT-DI6916F4B77A77-1  D400295607  3f8c5c6015fb05270ccce6a00afc38ea
                //12_DT-DI17AC44B37B69-1
                if(isset($_REQUEST['transactionNumber'])){ 
                    $tr = $this->DigitResource->getTransactionDeatils($_REQUEST['transactionNumber']);
                    if($tr->status){
                         $isExist = DB::table('policy_saled')->where('type','HEALTH')->where('enquiry_id',$tr->enq)->count();
                         $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$tr->enq)->first();
                         $json_data = json_decode($data->json_data);
                         $saledData = ['type'=>'HEALTH','provider'=>$data->provider,
                                      'json_data'=>$data->json_data,'mobile_no'=>"",'getway_response'=>json_encode($_REQUEST),
                                      "customer_id"=>$data->customer_id,'params'=>$data->params_request,
                                      ];
                         $saledData['transaction_no'] =$_REQUEST['transactionNumber'];
                         $saledData['policy_no'] =$tr->policyno;
                         
                         $saledData['sp_id'] =0;
                         $saledData['mobile_no'] =$data->customer_mobile;
                         $saledData['agent_id'] =$data->agent_id;
                        
                         $saledData['payment_status'] = "Completed";
                         $saledData['policy_status'] = "Completed";
                         $saledData['amount'] = $json_data->amount;
                        $pdfData = $this->DigitResource->GetPDF($tr->policyno);
                        $saledData['filename'] = ($pdfData->status)?$pdfData->filename:"";
                        if(!$isExist){
                            $saledData['enquiry_id'] =$tr->enq;
                            $refID = DB::table('policy_saled')->insertGetId($saledData);
                         }else{
                            $refID = DB::table('policy_saled')->where(['enquiry_id'=>$tr->enq])->update($saledData);
                         }
                          DB::table('app_quote')->where('enquiry_id', '=', $tr->enq)->delete();
                          return redirect('insurance/policy/success/'.$data->provider.'/'.$tr->enq);
                    }else{
                      echo $tr->message; 
                    }
                }else{
                    echo "Error! Invalid transaction Number"; 
                }
            }else if(strtolower($request->enquiryID)=='hdfcergo_health'){
                if(isset($_REQUEST['Msg']) && $_REQUEST['Msg']=='Successfull'){ 
                     $data =  DB::table('app_quote')->where(['type'=>'HEALTH','token'=>$_REQUEST['ProposalNo']])->first();
                     $isExist = DB::table('policy_saled')->where('type','HEALTH')->where('enquiry_id',$data->enquiry_id)->count();
                     $json_data = json_decode($data->json_data);
                     $saledData = ['type'=>'HEALTH','provider'=>$data->provider,
                                  'json_data'=>$data->json_data,'mobile_no'=>"",'getway_response'=>json_encode($_REQUEST),
                                  "customer_id"=>$data->customer_id,'params'=>$data->params_request,
                                  ];
                     $saledData['transaction_no'] =$_REQUEST['ProposalNo'];
                     $saledData['policy_no'] =$_REQUEST['PolicyNo'];
                     
                     $saledData['sp_id'] =0;
                     $saledData['mobile_no'] =$data->customer_mobile;
                     $saledData['agent_id'] =$data->agent_id;
                    
                     $saledData['payment_status'] = "Completed";
                     $saledData['policy_status'] = "Completed";
                     $saledData['amount'] = $json_data->amount;
                    //$pdfData = $this->DigitResource->GetPDF($_REQUEST['PolicyNo']);
                    // $saledData['filename'] = ($pdfData->status)?$pdfData->filename:"";
                        if(!$isExist){
                            $saledData['enquiry_id'] =$data->enquiry_id;
                            $refID = DB::table('policy_saled')->insertGetId($saledData);
                         }else{
                            $refID = DB::table('policy_saled')->where(['enquiry_id'=>$data->enquiry_id])->update($saledData);
                            
                         }
                           DB::table('app_quote')->where('enquiry_id', '=', $data->enquiry_id)->update(['status'=>'SOLD']);
                           return redirect('policy/success/'.$data->provider.'/'.$data->enquiry_id);
                }else{
                    echo "Invalid Proposal number";
                }
            }else{
                
             $isExist = DB::table('policy_saled')->where('type','HEALTH')->where('enquiry_id',$request->enquiryID)->count();
             $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$request->enquiryID)->first();
             $saledData = ['type'=>'HEALTH','provider'=>$data->provider,
                          'json_data'=>$data->json_data,'mobile_no'=>"",'getway_response'=>json_encode($_REQUEST),
                          "customer_id"=>$data->agent_id,'params'=>$data->params_request,
                          ];
             if($data->provider=="CARE"){
                 $json_data = json_decode($data->json_data);
                 $saledData['transaction_no'] =$_POST['transactionRefNum'];
                 $saledData['policy_no'] =$_POST['policyNumber'];
                 $saledData['payment_status'] = "Completed";
                 $saledData['policy_status'] = "Completed";
                 $saledData['amount'] = $json_data->amount;
                 $saledData['sp_id'] =0;
                 $saledData['mobile_no'] =$data->customer_mobile;
                 $saledData['agent_id'] =$data->agent_id;
                 $resp = $this->CareResource->savePDF($request->enquiryID,$_POST['policyNumber']);
                 $saledData['filename'] =($resp['status']=='success')?$resp['filename']:"";
             }else if($data->provider=="MANIPAL_CIGNA"){
                 
                  //print_r($_REQUEST);
                 $saledData['transaction_no'] =$_POST['txnid'];
                 $saledData['policy_no'] = $_POST['udf4'];
                 $saledData['amount'] = $_POST['amount'];
                 
                 $saledData['sp_id'] =0;
                 $saledData['mobile_no'] =$data->customer_mobile;
                 $saledData['agent_id'] =$data->agent_id;
                 
                 $saledData['payment_status'] = "Completed";
                 $saledData['policy_status'] = "Completed";
                 $jsonData = json_decode($data->json_data);
                 $quoteId = $jsonData->id;
                 try {
                      $saveProposal = $this->ManipalResource->saveProposal($request->enquiryID,$data,$quoteId,$_POST['udf4'],$_POST['txnid'],$_POST['amount']);
                      if($saveProposal['status']){
                         $pdfResp = $this->ManipalResource->GetPDF($_POST['udf4'],$data);
                         $saledData['filename'] =($pdfResp['status'])?$pdfResp['filename']:"";
                      }
                }catch(Exception $e) {
                  //echo $e->getMessage();
                }
                 
             }else if($data->provider=="FGI_H"){
                 // print_r($_REQUEST);
                // print_r($data);
                 //WS_P_ID=TP067009&TID=SS5F6921F72182095&PGID=403993715520661181&Premium=11226.00&Response=Success
                 //WS_P_ID=TP0000078421&TID=SS1719C610D3522DC&PGID=&Premium=11226.00&Response=Bounced
                // Array ( [WS_P_ID] => TP0000078735 [TID] => SSE2031BF5C618962 [PGID] => 403993715522367757 [Premium] => 11891.00 [Response] => Success ) 
                 //Array ( [status] => 1 [policyNo] => HTO-61-20-7248977-00-000 [ClientId] => 40249545 [receiptNo] => Z2111543 [resp] => Array ( [Client] => Array ( [Status] => Successful [ClientId] => 40249545 [ErrorMessage] => Array ( ) ) 
                // [Receipt] => Array ( [Status] => Successful [ReceiptNo] => Z2111543 [ErrorMessage] => Array ( ) ) [Policy] => Array ( [Status] => Successful [PolicyNo] => HTO-61-20-7248977-00-000 [Message] => Policy Synced Successfully ) [Application] => Array ( [WinNo] => Array ( ) [ApplicationNo] => Array ( ) ) ) )
                 if($request->input('Response')=="Success"){
                      $saledData['transaction_no'] =$request->input('WS_P_ID');
                      $saledData['payment_status'] = "Completed";
                      $saledData['amount'] = $request->input('Premium');
                      $policyData = $this->FgiResource->policyIssuance($request->enquiryID,$request->input('Premium'),$request->input('WS_P_ID'),$request->input('TID'),$request->input('PGID'));
                      //echo "<br/><hr/><br/>";
                      //print_r($policyData);
                      //echo "<br/>";
                      if($policyData['status']){
                          $saledData['policy_no'] = $policyData['policyNo'];
                          $saledData['extra_params'] = json_encode($policyData['resp']);
                          $fileData = $this->FgiResource->savePolicyPDF($policyData['policyNo']);
                          $saledData['filename'] = ($fileData['status'])?$fileData['filename']:"";
                          $saledData['filename'] ="";
                          $saledData['policy_status'] = "Completed";
                      }else{
                          $saledData['policy_status'] = "Pending";
                          $saledData['extra_params'] = json_encode($policyData['resp']);
                      }
                 }
                  
             }

             if(!$isExist){
                      $saledData['enquiry_id'] =$request->enquiryID;
                      $refID = DB::table('policy_saled')->insertGetId($saledData);
             }else{
                      $refID = DB::table('policy_saled')->where(['enquiry_id'=>$request->enquiryID])->update($saledData);
             }
             DB::table('app_quote')->where('enquiry_id', '=', $request->enquiryID)->update(['status'=>'SOLD']);
             return redirect('policy/success/'.$data->provider.'/'.$request->enquiryID);
          }
        }else{
            echo "Something went Wrong!";
        }
       //return redirect('health-insurance/policy/success/'.$data->provider.'/'.$request->enquiryID);
    }
    
    function moterTransactionUpdate(Request $request){
         $this->loaderPage();
        if($request->enquiryID!=""){
             $isExist = DB::table('policy_saled')->where('type',strtoupper($request->type))->where('enquiry_id',$request->enquiryID)->count();
             $info =    DB::table('app_quote')->where('enquiry_id',$request->enquiryID)->where('type',strtoupper($request->type))->first();
             $json = json_decode($info->json_data);
        
          $saledData = [
                         'type'=>strtoupper($request->type),'provider'=>$info->provider,
                         'json_data'=>$info->json_data,
                         'mobile_no'=>$info->customer_mobile,
                         "customer_id"=>$info->agent_id,
                         'params'=>$info->params_request,
                         'sp_id' =>0
                       ];
             if($info->provider=="DIGIT_M"){
                 $saledData['getway_response']= json_encode(["transactionNumber"=>$request->input('transactionNumber')]);
                 $saledData['transaction_no'] = $request->input('transactionNumber');
                 $saledData['policy_no'] = $json->contract->policyNumber;
                 $saledData['amount'] = $json->amount;
                 $fileData = $this->DigitResource->GetPDF($json->contract->policyNumber);
                 $saledData['filename'] =($fileData->status)?$fileData->filename:"";
                 $saledData['payment_status'] = "Completed";
                 $saledData['policy_status']  = "Completed";
             }else if($info->provider=="FGI_M"){
                //print_r($data);
                 //WS_P_ID=TP067009&TID=SS5F6921F72182095&PGID=403993715520661181&Premium=11226.00&Response=Success
                 if($request->input('Response')=="Success"){
                      $saledData['transaction_no'] =$request->input('WS_P_ID');
                      $saledData['payment_status'] = "Completed";
                      $saledData['amount'] = $request->input('Premium');
                      $_policyData = $this->FgiCarResource->policyIssuance($request->enquiryID,$request->input('Premium'),$request->input('WS_P_ID'),$request->input('TID'),$request->input('PGID'));
                      if($_policyData['status']){
                            $array =  $_policyData['data'];
                            echo "<br/><hr/><br/>";
                            print_r($array['Policy']);
                            if($array['Policy']['Status']!="Fail"){
                                 $saledData['policy_no']=  $array['Policy']['PolicyNo'];
                                 $saledData['policy_status']= 'Completed';
                             }else{
                                 $saledData['policy_no']=  isset($array['Policy']['PolicyNo'])?$array['Policy']['PolicyNo']:'';
                                 $saledData['policy_status'] = "Pending";
                             }
                            //  if($array['Receipt']['Status']!="Fail"){
                            //      $resp['Receipt']['ReceiptNo']=  $array['Receipt']['ReceiptNo'];
                            //      $resp['Receipt']['status']= $array['Receipt']['Status'];
                            //  }else{
                            //      $resp['Receipt']['policyNo']=  isset($array['Receipt']['ReceiptNo'])?$array['Receipt']['ReceiptNo']:'';
                            //      $resp['Receipt']['status']= $array['Receipt']['Status'];
                            //  }
                            //  if($array['Client']['Status']!="Fail"){
                            //      $resp['Client']['ClientId']=  $array['Client']['ClientId'];
                            //      $resp['Client']['status']= $array['Client']['Status'];
                            //  }else{
                            //      $resp['Client']['policyNo']=  isset($array['Client']['ClientId'])?$array['Client']['ClientId']:'';
                            //      $resp['Client']['status']= $array['Client']['Status'];
                            //  }
                          
                          
                          
                          
                         // $saledData['policy_no'] = $policyData['policyNo'];
                          $saledData['extra_params'] = json_encode($_policyData['data']);
                        //   $fileData = $this->FgiCarResource->savePolicyPDF($saledData['policy_no']);
                        //   $saledData['filename'] =($fileData['status'])?$fileData['filename']:"";
                         // $saledData['policy_status'] = "Completed";
                      }else{
                          $saledData['policy_status'] = "Pending";
                          $saledData['extra_params'] = json_encode($policyData['data']);
                      }
                 }
             }
             
             if(!$isExist){
                  $saledData['enquiry_id'] =$request->enquiryID;
                  $refID = DB::table('policy_saled')->insertGetId($saledData);
             }else{
                  $refID = DB::table('policy_saled')->where(['enquiry_id'=>$request->enquiryID])->update($saledData);
              }
              //DB::table('app_quote')->where('enquiry_id', '=', $request->enquiryID)->delete();
              DB::table('app_quote')->where('enquiry_id', '=', $request->enquiryID)->update(['status'=>'SOLD']);
             // return redirect('policy/success/'.$info->provider.'/'.$request->enquiryID);
              //return redirect('insurance/policy/success/'.$info->provider.'/'.$request->enquiryID);
        }else{
            echo "Something went Wrong!";
        }
    }
    
    function successPage(Request $request){
        //  $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$request->enquiryID)->first();
        //  $pdfResp = $this->ManipalResource->GetPDF("3250006559",$data);
          //$resp = $this->CareResource->savePDF($request->enquiryID,"10436128");
        //   $fileData = $this->FgiCarResource->savePolicyPDF('V0093940');
        //   print_r($fileData);
        //   $fileData = $this->FgiResource->savePolicyPDF("HTO-61-20-7248979-00-000");
         $data = DB::table('policy_saled')->where('enquiry_id',$request->enquiryID)->first();
         $template = ['title' => 'Payment',"subtitle"=>"success",'policyno'=>$data->policy_no,'trno'=>$data->transaction_no,'filename'=>$data->filename ,'scripts'=>[asset('page_js/success-page.js')]];
         return View::make('insurance.success')->with($template);
         
    }
    
    function cancelPage(Request $request){
        $template = ['title' => 'Payment',"subtitle"=>"failed"];
        return View::make('cancel')->with($template);
    }
    
    public function getDownload(Request $request){
        $file = "https://supersolutions.in/insurance/customers/policy/pdf/".$request->file;
        $headers = array('Content-Type: application/pdf');
        return Response::download(getcwd()."/public/assets/customers/policy/pdf/".$request->file,$request->file);
     }
     
    function  loaderPage(){
         echo '<style>.lds-spinner {
              color: official;
              display: inline-block;
              position: relative;
              left: 47%;
              width: 80px;
              height: 80px;
            }
            .lds-spinner div {
              transform-origin: 40px 40px;
              animation: lds-spinner 1.2s linear infinite;
            }
            .lds-spinner div:after {
              content: " ";
              display: block;
              position: absolute;
              top: 3px;
              left: 37px;
              width: 6px;
              height: 18px;
              border-radius: 20%;
              background: #AC0F0B;
            }
            .lds-spinner div:nth-child(1) {
              transform: rotate(0deg);
              animation-delay: -1.1s;
            }
            .lds-spinner div:nth-child(2) {
              transform: rotate(30deg);
              animation-delay: -1s;
            }
            .lds-spinner div:nth-child(3) {
              transform: rotate(60deg);
              animation-delay: -0.9s;
            }
            .lds-spinner div:nth-child(4) {
              transform: rotate(90deg);
              animation-delay: -0.8s;
            }
            .lds-spinner div:nth-child(5) {
              transform: rotate(120deg);
              animation-delay: -0.7s;
            }
            .lds-spinner div:nth-child(6) {
              transform: rotate(150deg);
              animation-delay: -0.6s;
            }
            .lds-spinner div:nth-child(7) {
              transform: rotate(180deg);
              animation-delay: -0.5s;
            }
            .lds-spinner div:nth-child(8) {
              transform: rotate(210deg);
              animation-delay: -0.4s;
            }
            .lds-spinner div:nth-child(9) {
              transform: rotate(240deg);
              animation-delay: -0.3s;
            }
            .lds-spinner div:nth-child(10) {
              transform: rotate(270deg);
              animation-delay: -0.2s;
            }
            .lds-spinner div:nth-child(11) {
              transform: rotate(300deg);
              animation-delay: -0.1s;
            }
            .lds-spinner div:nth-child(12) {
              transform: rotate(330deg);
              animation-delay: 0s;
            }
            @keyframes lds-spinner {
              0% {
                opacity: 1;
              }
              100% {
                opacity: 0;
              }
            }</style>';
         echo '<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
         echo '<p style="text-align:center;color:#AC0F0B">Transaction is being updating ,please wait....</p>';
       /// $this->savePolicyPDF_Digit("D400265600","bus");
     }
    
    
    
   
}