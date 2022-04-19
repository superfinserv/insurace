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

use App\Partners\Care\Care;
use App\Partners\Manipal\Manipal;
use App\Partners\Digit\DigitHealth;
    
class Insurance extends Controller{
    public $uniqueToken;
    public function __construct() { 
       $this->DigitBikeResource  = new DigitBikeResource;
       $this->DigitCarResource =   new DigitCarResource;
       $this->HdfcErgoTwResource =  new HdfcErgoTwResource;
       $this->HdfcErgoCarResource =  new HdfcErgoCarResource;
       $this->FgiTw =  new FgiTwResource;
        
       $this->Care =   new Care;
       $this->Manipal  =  new Manipal;
       $this->DigitHealth  =  new DigitHealth;
   }
   
  
    function policyfilledData(Request $request){
        $policy_no=$request->no;
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
         return $pdf->stream();
    }
     
    function getPolicyDoc(Request $request){
        $sale=DB::table('policy_saled')->where('id', $request->id)->first();
        $json = json_decode($sale->json_data);
        if($sale->provider=="DIGIT" && ($sale->type=="BIKE" || $sale->type=="CAR")){
                if(isset($json->applicationId)){
                       $applicationId = $json->applicationId;
                   }else{
                      $tmp = DB::table("app_quote")->where('enquiry_id',$sale->enquiry_id)->first(); 
                      $json = json_decode($tmp->json_create);
                      $applicationId = $json->applicationId;
                   }
                $resp = $this->DigitCarResource->GetPDF($sale->policy_no,$applicationId);
                if($resp->status){
                  DB::table('policy_saled')->where('id', $request->id)->update(['filename'=>$resp->filename]);
                  return response()->json(['status'=>'success',
                                           'message'=>$resp->message,
                                           "provider"=>$sale->provider,
                                           "type"=>$sale->type,
                                           'data'=>['fileName'=>$resp->filename,'path'=>url('get/download/file/policy-file/'.$resp->filename)]]); 
                }else{
                  return response()->json(['status'=>'error','fileName'=>"",'message'=>$resp->message]); 
                }
        }else if($sale->provider=="HDFCERGO" && ($sale->type=="BIKE" || $sale->type=="CAR")){
             $resp = ($sale->type=="BIKE")?$this->HdfcErgoTwResource->GetPDF($sale->policy_no):$this->HdfcErgoCarResource->GetPDF($sale->policy_no);
             if($resp['status']){
                DB::table('policy_saled')->where('policy_no', $sale->policy_no)->update(['filename'=>$resp['filename']]);
                 return response()->json(['status'=>'success',
                                             'message'=>"Policy Get Successfully",
                                             "provider"=>$sale->provider,
                                             "type"=>$sale->type,
                                             'data'=>['fileName'=>$resp['filename'],'path'=>url('get/download/file/policy-file/'.$resp['filename'])]]); 
             }else{
                return response()->json(['status'=>'error','fileName'=>"",'message'=>$resp['message']]);  
             }
        }else if($sale->provider=="FGI" && ($sale->type=="BIKE" || $sale->type=="CAR")){
             $resp = $this->FgiTw->GetPDF($sale->policy_no);
             if($resp['status']){
                DB::table('policy_saled')->where('policy_no', $sale->policy_no)->update(['filename'=>$resp['filename']]);
                 return response()->json(['status'=>'success',
                                             'message'=>"Policy Get Successfully",
                                             "provider"=>$sale->provider,
                                             "type"=>$sale->type,
                                             'data'=>['fileName'=>$resp['filename'],'path'=>url('get/download/file/policy-file/'.$resp['filename'])]]); 
             }else{
                return response()->json(['status'=>'error','fileName'=>"",'message'=>$resp['message']]);  
             }
        }else if($sale->provider=="DIGIT" && $sale->type=="HEALTH"){
            $resp  = $this->DigitHealth->GetPDF($sale->policy_no);
             if($resp->status){
                 DB::table('policy_saled')->where(['id'=>$request->id])->update(['filename'=>$resp->filename]);
                  return response()->json(['status'=>'success',
                                           'message'=>"Policy Get Successfully",
                                           "provider"=>$sale->provider,
                                           "type"=>$sale->type,
                                           'data'=>['fileName'=>$resp->filename,
                                                    'path'=>url('get/download/file/policy-file/'.$resp->filename),
                                                    'proposal'=>$resp->proposal,
                                                    'pathProposal'=>url('get/download/file/policy-file/'.$resp->proposal),
                                                    'ecard'=>$resp->ecard,
                                                    'pathEcard'=>url('get/download/file/policy-file/'.$resp->ecard)
                                                  ]
                                          ]); 
                }else{
                  return response()->json(['status'=>'error','fileName'=>"","message"=>"Your policy is not generated yet, try again later."]); 
                }
        }else if($sale->provider=="CARE"){
              
               $resp = $this->Care->savePDF($sale->enquiry_id,$sale->policy_no);
                if($resp['status']=='success'){
                    DB::table('policy_saled')->where(['id'=>$request->id])->update(['filename'=>$resp['filename']]);
                    return response()->json(['status'=>'success',
                                             'message'=>"Policy Get Successfully",
                                             "provider"=>$sale->provider,
                                             "type"=>$sale->type,
                                             'data'=>['fileName'=>$resp['filename'],'path'=>url('get/download/file/policy-file/'.$resp['filename'])]]); 
                }else{
                  return response()->json(['status'=>'error','fileName'=>$resp['filename'],"message"=>$resp['message']]); 
                }
        }else if($sale->provider=="MANIPAL_CIGNA"){
                if($request->opt=="Policy"){
                    $resp = $this->Manipal->GetPDF($sale->policy_no,$sale,true); //$request->opt opt :  policy ecard proposal receipt
                    if($resp['status']=='success'){
                        DB::table('policy_saled')->where(['id'=>$request->id])->update(['filename'=>$resp['filename']]);
                        return response()->json(['status'=>'success',
                                                 'message'=>"Policy Get Successfully",
                                                 "provider"=>$sale->provider,
                                                 "type"=>$sale->type,
                                                 'data'=>['fileName'=>$resp['filename'],'path'=>url('get/download/file/policy-file/'.$resp['filename'])]]); 
                    }else{
                      return response()->json(['status'=>'error','fileName'=>$resp['filename'],'message'=>$resp['message']]); 
                    }
                }else{
                     $resp = $this->Manipal->GetReceipt($sale->policy_no,$sale,true); //$request->opt opt :  policy ecard proposal receipt
                     if($resp['status']=='success'){
                        DB::table('policy_saled')->where(['id'=>$request->id])->update(['receipt'=>$resp['receipt']]);
                        return response()->json(['status'=>'success',
                                                 'message'=>"Receipt Get Successfully",
                                                 "provider"=>$sale->provider,
                                                 "type"=>$sale->type,
                                                 'data'=>['receipt'=>$resp['receipt'],'receiptPath'=>url('get/download/file/policy-file/'.$resp['receipt'])]]); 
                    }else{
                      return response()->json(['status'=>'error','receipt'=>$resp['receipt'],'message'=>$resp['message']]); 
                    }
                }
        }
    }
    
    function getPolicyStatus(Request $request){
        $enQ = DB::table('app_quote')->where('enquiry_id', $request->enq)->first();
        if($enQ->provider=='CARE'){
            $res =   $this->Care->GetPolicyStatus($enQ->enquiry_id,$enQ->proposalNumber);
            return response()->json($res); 
        }else if($enQ->provider=='HDFCERGO'){
            $res =  ($enQ->type=='BIKE')?$this->HdfcErgoTwResource->policyGeneration($enQ->enquiry_id):$this->HdfcErgoCarResource->policyGeneration($enQ->enquiry_id);
            if($res['status']){
                $res['status'] =  'success';
                $Pdata = ['policy_no'=>$res['data'],'policy_status'=>'Completed'];
                DB::table('policy_saled')->where(['enquiry_id'=>$enQ->enquiry_id])->update($Pdata);
                return response()->json($res); 
            }else{
                $res['status'] =  'error';
                return response()->json($res); 
            }
             
        }
    }
    
     
    
    
    
   
}