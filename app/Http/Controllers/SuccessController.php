<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use Auth;
//use Redirect;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use PDF;

use App\Resources\DigitCarResource;
use App\Resources\DigitBikeResource;
use App\Resources\HdfcErgoTwResource;
use App\Resources\HdfcErgoCarResource;
use App\Resources\FgiTwResource;
use App\Resources\FgiCarResource;

use App\Partners\Care\Care;
use App\Partners\Manipal\Manipal;
use App\Partners\Digit\DigitHealth;
use App\Partners\HdfcErgo\HdfcErgoHealth;


class SuccessController extends Controller{
    public $uniqueToken;
    public function __construct() { 
       $this->DigitBikeResource  = new DigitBikeResource;
       $this->DigitCarResource =   new DigitCarResource;
       $this->HdfcErgoTwResource =  new HdfcErgoTwResource;
       $this->HdfcErgoCarResource =  new HdfcErgoCarResource;
       $this->FgiTw =  new FgiTwResource;
       $this->FgiCar =  new FgiCarResource;
       
       $this->Care =   new Care;
       $this->Manipal  =  new Manipal;
       $this->DigitHealth  =  new DigitHealth;
       $this->HdfcErgoHealth   = new HdfcErgoHealth;
       
   }
   
    
    function healthtransactionupdate(Request $request){
         $this->loaderPageNew();
         @csrf;
         //echo $request->enquiryID;
        if($request->enquiryID!=""){
            if(strtolower($request->enquiryID)=="digit_health"){
                if(isset($_REQUEST['transactionNumber'])){ 
                  $res  = $this->DigitHealth->updateTransactionData($_REQUEST);
                  if($res->status){
                     
                      DB::table('app_quote')->where('enquiry_id', '=', $res->enq)->update(['status'=>'SOLD']);
                      if($res->server=='AGENT_WEB'){
                              $url = config('custom.posp_site_url').'/policy/success/'.$res->provider.'/'.$res->enq;
                              return redirect($url);
                      }else{
                             return redirect('policy/success/'.$res->provider.'/'.$res->enq);
                      }
                  }else{
                     echo "<p style='text-align:center'>".$res->message."</p>";
                  }
                }else{
                     echo "<p style='text-align:center'>Transaction is not complete or Internal error.</p>";
                }
                
                
            }else if(strtolower($request->enquiryID)=='hdfcergo_health'){
                if(isset($_REQUEST['hdmsg'])){ 
                     $data =    DB::table('app_quote')
                               ->where('token',$_REQUEST['hdmsg'])
                               ->latest('id')->first();
                    
                     $saledData = ['type'=>'HEALTH','provider'=>$data->provider,'policyType'=>$data->policyType,
                                   'json_data'=>$data->json_data,'mobile_no'=>"",'getway_response'=>json_encode($_REQUEST),
                                    "customer_id"=>$data->customer_id,'params'=>$data->params_request,
                                  ];
                     $saledData['transaction_no'] =$_REQUEST['hdmsg'];
                     //$saledData['policy_no'] =$_REQUEST['PolicyNo'];
                     $saledData['startDate']=$data->startDate;
                     $saledData['endDate']=$data->endDate;
                     $saledData['sp_id'] =$data->sp_id;
                     $saledData['mobile_no'] =$data->customer_mobile;
                     $saledData['agent_id'] =$data->agent_id;
                     $saledData['payment_status'] = "Completed";
                     $saledData['policy_status'] = "Completed";
                     $saledData['amount'] = $data->grossAmt;
                     $saledData['netAmt']=$data->netAmt;
                     $saledData['taxAmt']=$data->taxAmt;
                     $saledData['grossAmt']=$data->grossAmt;
                     $saledData['server']=$data->server;
                     $pData = $this->HdfcErgoHealth->policyGeneration($data->enquiry_id);
                     if($pData['status']){
                         $saledData['policy_no']=$pData['PolicyNumber'];
                         $saledData['policy_status']="Pending";
                     }
                     $isExist = DB::table('policy_saled')->where('type','HEALTH')->where('enquiry_id',$data->enquiry_id)->count();
                     $json_data = json_decode($data->json_data);
                     if(!$isExist){
                        $saledData['enquiry_id'] =$data->enquiry_id;
                        $refID = DB::table('policy_saled')->insertGetId($saledData);
                     }else{
                        $refID = DB::table('policy_saled')->where(['enquiry_id'=>$data->enquiry_id])->update($saledData);
                     }
                      DB::table('app_quote')->where('enquiry_id', '=', $data->enquiry_id)->update(['status'=>'SOLD']);
                      if($data->server=='AGENT_WEB'){
                          $url = config('custom.posp_site_url').'/policy/success/'.$data->provider.'/'.$data->enquiryID;
                          return redirect($url);
                      }else{
                           return redirect('policy/success/'.$data->provider.'/'.$data->enquiry_id);
                      }
                }else{
                    echo "Invalid Proposal number";
                }
            }else{
                
             $isExist = DB::table('policy_saled')->where('type','HEALTH')->where('enquiry_id',$request->enquiryID)->count();
             $data = DB::table('app_quote')->where('type','HEALTH')->where('enquiry_id',$request->enquiryID)->first();
             $saledData = ['type'=>'HEALTH','provider'=>$data->provider,'policyType'=>$data->policyType,
                          'mobile_no'=>$data->customer_mobile,'customer_name' =>$data->customer_name,'getway_response'=>json_encode($_REQUEST),
                          "customer_id"=>$data->customer_id,'params'=>$data->params_request,'server'=>$data->server
                          ];
            $jsonData = json_decode($data->json_data);
             if($data->provider=="CARE"){
                 //print_r($_POST);
                 //Array ( [csrf] => null [policyNumber] => 10483768 [transactionRefNum] => 403993715523730916 [uwDecision] => INFORCE [errorFlag] => [errorMsg] => )
                 $json_data = json_decode($data->json_data);
                 $saledData['transaction_no'] =$_POST['transactionRefNum'];
                 $saledData['policy_no'] =$_POST['policyNumber'];
                 $saledData['payment_status'] = "Completed";
                 $saledData['policy_status'] = "Completed";//($_POST['uwDecision']=='INFORCE')?"Completed":"Pending";
                 $saledData['amount'] = $json_data->amount;
                 $saledData['startDate']=$data->startDate;
                 $saledData['endDate']=$data->endDate;
                 $premium = json_decode($data->amounts); 
                 $saledData['termYear'] = $data->termYear;
                 $saledData['sumInsured'] = $json_data->sumInsured;
                 $saledData['product_info'] = json_encode(['title'=>$data->title,'code'=>$data->code,'code'=>$data->code,'product'=>$data->product,'policyType'=>$data->policyType,'zone'=>$data->zone]);
                 $saledData['premium_info'] = json_encode($premium->{$data->termYear});
                 $saledData['netAmt']=$data->netAmt;
                 $saledData['taxAmt']=$data->taxAmt;
                 $saledData['grossAmt']=$data->grossAmt;
                 $saledData['sp_id'] =$data->sp_id;
                 $saledData['mobile_no'] =$data->customer_mobile;
                 $saledData['agent_id'] =$data->agent_id;
                 $saledData['reqQuote']=$data->reqQuote;
             	 $saledData['respQuote']=$data->respQuote;
            	 $saledData['reqRecalculate']=$data->reqRecalculate;
            	 $saledData['respRecalculate']=$data->respRecalculate;
            	 $saledData['reqCreate']=$data->reqCreate;
            	 $saledData['respCreate']=$data->respCreate;
                
                //  $saledData['filename'] =($resp['status']=='success')?$resp['filename']:"";
             }else if($data->provider=="MANIPAL_CIGNA"){
                 
                 //print_r($_POST);
                 $saledData['transaction_no'] =$_POST['txnid'];
               //  $saledData['policy_no'] = $_POST['udf4'];
                 $saledData['proposalNumber'] = $_POST['udf4'];
                 $saledData['amount'] = $_POST['amount'];
                  $saledData['netAmt']=$data->netAmt;
                 $saledData['taxAmt']=$data->taxAmt;
                 $saledData['grossAmt']=$data->grossAmt;
                 $saledData['sp_id'] =$data->sp_id;
                 $saledData['mobile_no'] =$data->customer_mobile;
                 $saledData['agent_id'] =$data->agent_id;
                
                 $saledData['payment_status'] = "Completed";
                 $saledData['policy_status'] = "Pending";
                
                 $SUM = json_decode($data->sumInsured);
                 $replace = array("Lakhs", "INR", "Lakh", " ");
                 $sumInsured = str_replace($replace, "", $SUM->shortAmt);
                 
                 $termYear = $data->termYear;
                // $Q['termYear']=$request->termYear;
                 //$_amts = json_decode($data->amounts);
                // $Q['amounts']=$_amts->$termYear;
                
                 $premium = json_decode($data->amounts); 
                 $saledData['termYear'] = $data->termYear;
                 $saledData['sumInsured'] = $sumInsured;//$json_data->sumInsured;
                 $saledData['product_info'] = json_encode(['title'=>$data->title,'code'=>$data->code,'code'=>$data->code,'product'=>$data->product,'policyType'=>$data->policyType,'zone'=>$data->zone]);
                 $saledData['premium_info'] = json_encode($premium->$termYear);
                 //$jsonData = json_decode($data->json_data);
                 $quoteId = $jsonData->id;
                 try {
                       $saveProposal = $this->Manipal->saveProposalData($request->enquiryID,$quoteId,$_POST['udf4'],$_POST['txnid'],$_POST['amount']);
                       if($saveProposal['status']){
                         $NewQuoteData = DB::table('app_quote')->where(['enquiry_id'=>$request->enquiryID])->first();
                         $saledData['startDate']=$NewQuoteData->startDate;
                         $saledData['endDate']=$NewQuoteData->endDate;
                         $saledData['reqQuote']=$NewQuoteData->reqQuote;
                     	 $saledData['respQuote']=$NewQuoteData->respQuote;
                    	 $saledData['reqRecalculate']=$NewQuoteData->reqRecalculate;
                    	 $saledData['respRecalculate']=$NewQuoteData->respRecalculate;
                    	 $saledData['reqCreate']=$NewQuoteData->reqCreate;
                    	 $saledData['respCreate']=$NewQuoteData->respCreate;
                         $saledData['reqSaveGenPolicy']=$NewQuoteData->reqSaveGenPolicy;
                         $saledData['respSaveGenPolicy']=$NewQuoteData->respSaveGenPolicy;
                         $jsonData->receiptId=$saveProposal['data']['receiptId'];
                       }
                }catch(Exception $e) {
                  //echo $e->getMessage();
                }
                 
             }

             if(!$isExist){
                      $saledData['json_data'] = json_encode($jsonData);
                      $saledData['enquiry_id'] =$request->enquiryID;
                      $refID = DB::table('policy_saled')->insertGetId($saledData);
             }else{
                $refID = DB::table('policy_saled')->where(['enquiry_id'=>$request->enquiryID])->update($saledData);
             }
             DB::table('app_quote')->where('enquiry_id', '=', $request->enquiryID)->update(['status'=>'SOLD']);
             //return redirect('policy/success/'.$data->provider.'/'.$request->enquiryID);
            // die;
             if($data->server=='AGENT_WEB'){
               $url = config('custom.posp_site_url').'/policy/success/'.$data->provider.'/'.$request->enquiryID;
                 return redirect($url);
              }else{
                  return redirect('policy/success/'.$data->provider.'/'.$request->enquiryID);
              }
          }
        }else{
            echo "Something went Wrong!";
        }
       //return redirect('health-insurance/policy/success/'.$data->provider.'/'.$request->enquiryID);
    }
    
    function moterTransactionUpdate(Request $request){
           
       //print_r($_REQUEST);die;
            $this->loaderPageNew();
            @csrf;
           if($request->type=='hdfcergo_motor'){
              
                $enQ =    DB::table('app_quote')
                               ->where('token',$_REQUEST['hdmsg'])
                               ->latest('id')->first();
               $enqID  =  $enQ->enquiry_id;             
               $pData =  ($enQ->type=='BIKE')?$this->HdfcErgoTwResource->policyGeneration($enQ->enquiry_id):$this->HdfcErgoCarResource->policyGeneration($enQ->enquiry_id);
            
                   $saledData = [
                         'type'=>strtoupper($enQ->type),'provider'=>$enQ->provider,'policyType'=>$enQ->policyType,
                         'json_data'=>$enQ->json_data,
                         'mobile_no'=>$enQ->customer_mobile,
                         'customer_name' =>$enQ->customer_name,
                         "customer_id"=>($enQ->customer_id)?$enQ->customer_id:0,
                         'agent_id'=>$enQ->agent_id,
                         'params'=>$enQ->params_request,
                         'sp_id' =>$enQ->sp_id,
                        'startDate'=>$enQ->startDate,
                         'endDate'=>$enQ->endDate,
                         'enquiry_id' =>$enQ->enquiry_id,
                         'transaction_no'=>$enQ->token,
                         'policy_no'=>($pData['status'])?$pData['data']:"",
                         'amount'=>$enQ->premiumAmount,
                         'netAmt'=>$enQ->netAmt,
                         'taxAmt'=>$enQ->taxAmt,
                         'grossAmt'=>$enQ->grossAmt,
                         
                        'payment_status' => "Completed",
                        'policy_status'  => ($pData['status'])?"Completed":"Pending",
                        'reqQuote'=>$enQ->reqQuote,
                    	'respQuote'=>$enQ->respQuote,
                    	'reqRecalculate'=>$enQ->reqRecalculate,
                    	'respRecalculate'=>$enQ->respRecalculate,
                    	'reqCreate'=>$enQ->reqCreate,
                    	'respCreate'=>$enQ->respCreate,
                    	'reqSaveGenPolicy'=>$enQ->reqSaveGenPolicy,
                    	'respSaveGenPolicy'=>$enQ->respSaveGenPolicy,
                       ];
                       
                       $saledData['server']=$enQ->server;
                       $isExist = DB::table('policy_saled')->where('enquiry_id',$enqID)->count();
                           if(!$isExist){
                              $refID = DB::table('policy_saled')->insertGetId($saledData);
                           }else{
                              $refID = DB::table('policy_saled')->where(['enquiry_id'=>$enQ->enquiry_id])->update($saledData);
                           }
                        DB::table('app_quote')->where('enquiry_id', '=', $enQ->enquiry_id)->update(['status'=>'SOLD']);
                       if($enQ->server=='AGENT_WEB'){
                          $url = config('custom.posp_site_url').'/policy/success/'.$enQ->provider.'/'.$enQ->enquiry_id;
                          return redirect($url);
                      }else{
                          return redirect('policy/success/'.$enQ->provider.'/'.$enQ->enquiry_id);
                      }
               
           }else if($request->enquiryID!=""){
             //  echo $request->type;
             $enqID  =  $request->enquiryID; 
             $isExist = DB::table('policy_saled')->where('enquiry_id',$request->enquiryID)->count();
             $info =    DB::table('app_quote')->where('enquiry_id',$request->enquiryID)->first();
             // print_r($info);die;
             $json = json_decode($info->json_data);
          
              $saledData = [
                         'type'=>strtoupper($request->type),'provider'=>$info->provider,'policyType'=>$info->policyType,
                         'json_data'=>$info->json_data,
                         'mobile_no'=>$info->customer_mobile,
                         'customer_name' =>$info->customer_name,
                         "customer_id"=>($info->customer_id)?$info->customer_id:0,
                         'agent_id'=>$info->agent_id,
                         'params'=>$info->params_request,
                         'sp_id' =>$info->sp_id,
                         'startDate'=>$info->startDate,
                         'endDate'=>$info->endDate,
                         'reqQuote'=>$info->reqQuote,
                     	 'respQuote'=>$info->respQuote,
                    	 'reqRecalculate'=>$info->reqRecalculate,
                    	 'respRecalculate'=>$info->respRecalculate,
                    	 'reqCreate'=>$info->reqCreate,
                    	 'respCreate'=>$info->respCreate,
                    	 'netAmt'=>$info->netAmt,
                         'taxAmt'=>$info->taxAmt,
                         'grossAmt'=>$info->grossAmt,
                       ];
              $saledData['server']=$info->server;
             if($info->provider=="DIGIT"){
                 $saledData['getway_response']= json_encode(["transactionNumber"=>$request->input('transactionNumber')]);
                 $saledData['transaction_no'] = $request->input('transactionNumber');
                 $saledData['policy_no'] = $json->policyNumber;
                 $saledData['amount'] = $json->gross;
                //  $fileData = $this->DigitCarResource->GetPDF($json->policyNumber,$json->applicationId);
                //  $saledData['filename'] =($fileData->status)?$fileData->filename:"";
                 $saledData['payment_status'] = "Completed";
                 $saledData['policy_status']  = "Completed";
             }else if($info->provider=="FGI"){
                $saledData['getway_response']= json_encode($_REQUEST);
                 //https://superfinserv.co.in/moter-insurance/insured-success/bike/48daf5f2cbeb879468ea38d346f226f9?WS_P_ID=TP0000096531&TID=1k450629W9&PGID=403993715525903340&Premium=1471.00&Response=Success
                // Array ( [WS_P_ID] => TP0000096531 [TID] => 1k450629W9 [PGID] => 403993715525903340 [Premium] => 1471.00 [Response] => Success ) 
                 if($request->input('Response')=="Success"){
                      $saledData['transaction_no'] =$request->input('WS_P_ID');
                      $saledData['payment_status'] = "Completed";
                      $saledData['amount'] = $request->input('Premium');
                      if($info->type =="BIKE"){
                          $pdata = $this->FgiTw->policyIssuance($request->enquiryID,$request->input('Premium'),$request->input('WS_P_ID'),$request->input('TID'),$request->input('PGID'));
                      }else{
                           $pdata = $this->FgiCar->policyIssuance($request->enquiryID,$request->input('Premium'),$request->input('WS_P_ID'),$request->input('TID'),$request->input('PGID'));
                      }
                   if($request->input('Response')=="Success"){   //print_r($pdata);die;
                      $saledData['policy_no'] = $pdata['data'];
                      $saledData['policy_status'] = "Completed";
                   }
                 }else{
                     if($info->server=='AGENT_WEB'){
                          $url = config('custom.posp_site_url').'/ policy/cancel/'.$request->enquiryID;
                          return redirect($url);
                      }else{
                          return redirect('policy/cancel/'.$request->enquiryID);
                      }
                    
                 }
                 
             }
             
              //print_r($saledData);die;
             if(!$isExist){
                  $saledData['enquiry_id'] =$request->enquiryID;
                  $refID = DB::table('policy_saled')->insertGetId($saledData);
             }else{
                  $refID = DB::table('policy_saled')->where(['enquiry_id'=>$request->enquiryID])->update($saledData);
              }
              DB::table('app_quote')->where('enquiry_id', '=', $request->enquiryID)->update(['status'=>'SOLD']);
              if($info->server=='AGENT_WEB'){
                  $url = config('custom.posp_site_url').'/policy/success/'.$info->provider.'/'.$request->enquiryID;
                  return redirect($url);
              }else{
                  return redirect('policy/success/'.$info->provider.'/'.$request->enquiryID);
              }
        }else{
            echo "Something went Wrong!";
        }
        
    }
    
    function successPage(Request $request){
        
          $data = DB::table('policy_saled')->where('enquiry_id',$request->enquiryID)->first();
          $insurer = DB::table('our_partners')->where('shortName',$data->provider)->value('name');
          $isAgent = ($data->agent_id>0)?true:false;
         
         //echo  date('Y-m-d H:i:s');
          $template = ['title' => 'Super Finserv',"subtitle"=>"Policy success",'isAgent'=>$isAgent,'data'=>$data,'insurer'=>$insurer,
                        'policyno'=>$data->policy_no,'trno'=>$data->transaction_no,
                        'filename'=>$data->filename ,'scripts'=>[asset('page_js/success-page.js')]];
                    
          return View::make('insurance.web_success')->with($template);
                    
         
    }
    
    function hdfcErgocancelPage(Request $request){
        if($request->enquiryID=='hdfcergo_motor' || $request->enquiryID=='hdfcergo_health'){
               $enQ =   DB::table('app_quote')
                                           ->where('token',$_REQUEST['hdmsg'])
                                           ->latest('id')->first();
               return redirect('policy/cancel/'.$enQ->enquiry_id);                            
        }
    }
    
    function cancelPage(Request $request){
           $template = ['title' => 'Payment',"subtitle"=>"failed"];
           $template['info'] =    DB::table('app_quote')->where('enquiry_id',$request->enquiryID)->first();
           return View::make('insurance.cancel')->with($template);
    }
    
    function  loaderPage(){
         
        echo '<html lang="en"><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Page Expired</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
          <style>
          
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            
        
          
          .lds-spinner {
              color: official;
              display: inline-block;
              position: relative;
              left: 47%;
              width: 80px;
              height: 80px;
              margin-top: 75px;
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
            }</style>
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
               <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
               <p style="text-align:center;color:#AC0F0B;font-weight:400">Transaction is being updating ,please wait....</p>
               <p style="text-align:center;color:#AC0F0B">Please do not hit refresh or back button or close this window.</p>
        </div>
     </body></html>';
          
       /// $this->savePolicyPDF_Digit("D400265600","bus");
     }
     
    function  loaderPageNew(){
         
        echo '<html lang="en"><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Transaction Updating</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
          
          
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            }
           
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            
        
          
          .fs-21px {
        font-size: 21px;
        line-height: 34px;
        color: #666666;
        font-weight: 300;
        padding-top: 10px;
        text-align: center;
      }
      
      .load-center {
        width: fit-content;
        height: 100px;
        position: absolute;
        right: 0;
        left: 0;
        top: 44%;
        margin: auto;
      }
      
      .loader-overlay {
        /* position: fixed;*/
        width: 100%;
        height: 60%;
        z-index: 50;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.8);
      }
      
      .card {
        /* filter: drop-shadow(0 0 4px rgba(0, 0, 0, 0.15)); */
        background-color: #ffffff;
      }
      
      .loading {
        display: inline-block;
      }
      
      .loading span {
        width: 2.049780380673499vw;
        height: 2.049780380673499vw;
        margin: 0 5px;
        border-radius: 50%;
        background-color: #da251c;
        display: inline-block;
        /* background: linear-gradient(90deg, #da251c , #08315f); */
        /* background-size: 400% 400%; */
      }
      
      .loading span:nth-child(1) {
        background-color: linear-gradient(90deg, #da251c, #08315f);
        animation: gradient 2s ease infinite;
        animation-delay: 0ms;
      }
      
      .loading span:nth-child(2) {
        background-color: linear-gradient(90deg, #da251c, #08315f);
        animation: wave 2s ease infinite;
        /* animation-delay: 100ms; */
      }
      
      .loading span:nth-child(3) {
        background-color: linear-gradient(90deg, #da251c, #08315f);
        animation: wave2 2s ease infinite;
        /* animation-delay: 100ms; */
      }
      
      .loading span:nth-child(4) {
        background-color: #08315f;
        /* animation:wave  1s ease infinite; */
        animation: wave3 2s ease infinite;
      }
      
      .loading span:nth-child(5) {
        background-color: #08315f;
        /* animation:wave  1s ease infinite; */
        animation: wave4 2s ease infinite;
        /* animation: gradient 15s ease infinite; */
      }
      
      @keyframes gradient {
        0% {
          transform: translateX(0px);
        }
      
        50% {
          transform: translateX(152px);
          background-color: #08315f;
        }
      
        100% {
          transform: translateX(0px);
        }
      }
      
      @keyframes wave {
        0% {
          transform: rotate(0deg) translate(0px) rotate(0deg);
        }
      
        20%,
        30%,
        40%,
        50%,
        60%,
        70%,
        80% {
          transform: rotate(-180deg) translateX(38px) rotate(-180deg);
        }
      
        90%,
        100% {
          transform: rotate(-360deg) translateX(0px) rotate(-360deg);
        }
      }
      
      @keyframes wave2 {
        0%,
        20% {
          transform: rotate(0deg) translate(0px) rotate(0deg);
        }
      
        30%,
        40%,
        50%,
        60%,
        70% {
          transform: rotate(-180deg) translateX(38px) rotate(-180deg);
        }
      
        80%,
        90%,
        100% {
          transform: rotate(-360deg) translateX(0px) rotate(-360deg);
        }
      }
      
      @keyframes wave3 {
        0%,
        20%,
        30% {
          transform: rotate(0deg) translate(0px) rotate(0deg);
        }
      
        40%,
        50%,
        60% {
          transform: rotate(-180deg) translateX(38px) rotate(-180deg);
        }
      
        70%,
        80%,
        90%,
        100% {
          transform: rotate(-360deg) translateX(0px) rotate(-360deg);
        }
      }
      
      @keyframes wave4 {
        0%,
        20%,
        30%,
        40% {
          transform: rotate(0deg) translate(0px) rotate(0deg);
        }
      
        50% {
          transform: rotate(-180deg) translateX(38px) rotate(-180deg);
        }
      
        60%,
        70%,
        80%,
        90%,
        100% {
          transform: rotate(-360deg) translateX(0px) rotate(-360deg);
        }
      }
      
      @media only screen and (max-width: 480px) {
        .loading span {
          width: 25px !important;
          height: 25px !important;
        }
      }
      
      @media only screen and (max-width: 380px) {
        .loading span {
          width: 20px !important;
          height: 20px !important;
        }
      
        @keyframes gradient {
          0% {
            transform: translateX(0px);
          }
      
          50% {
            transform: translateX(104px);
            background-color: #08315f;
          }
      
          100% {
            transform: translateX(0px);
          }
        }
      }
      
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
                <div id="loader">
                    <div class="container-fluid loader-overlay">
                        <div class="load-center">
                            <div class="d-inline-block loading"><span class="pr-1"></span><span class="pr-1"></span><span class="pr-1"></span><span class="pr-1"></span><span></span></div>
                            <div class="fs-21px text-center pt-4">Loading...</div>
                        </div>
                    </div>
                </div>
               <p style="text-align:center;color:#AC0F0B;font-weight: 400;">The transaction is being updated, please wait...</p>
               <p style="text-align:center;color:#AC0F0B">Please do not hit the refresh or back button or close this window.</p>
        </div>
     </body>
     </html>';
          
       /// $this->savePolicyPDF_Digit("D400265600","bus");
     }
     
 
    
    
    
   
}