<?php
namespace App\Http\Controllers\Pos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class CommonController extends Controller
{
    public function __construct() { 

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
    public function getvehicleModals(Request $request){
        $models=DB::table('vehicle_modal')->select(DB::raw("id,LOWER(TRIM(modal)) as value"))->where(['make_id'=>$request->brandId,'status'=>'ACTIVE'])->orderBy('serial_no','ASC')->get();
        return response()->json(['status'=>'success','message'=>'modals get successfully','data'=>$models]);
    }
    public function getvehiclevariant(Request $request){
        $variants=DB::table('vehicle_variant')->select(DB::raw("CONCAT(id,'-',fuel_type) AS id,TRIM(variant) as value"))->where(['modal_id'=>$request->modaltId])->get();
        return response()->json(['status'=>'success','message'=>'modals get successfully','data'=>$variants]);
    }
    
    
    function termsConditionsModel(Request $request){
        $temp['type'] = $request->type;
        $temp['supplier'] = $request->supplier;
        return View::make('quotePages.common.terms_conditions_model')->with($temp);
    }
    
    function load_TP_details_Modal(Request $request){
        $temp['previous_insurer'] = DB::table('previous_insurer')->where(['status'=>'ACTIVE','type'=>'GENERAL'])->get();
        $temp['type'] = $request->type;
        return View::make('quotePages.common.moter_tp_details')->with($temp);
    }
    
    
    function loadidvModal(Request $request){
          $data = DB::table('app_temp_quote')
                     ->select(DB::raw('MIN(min_idv) as minval,MAX(max_idv) as maxval'))
                     ->where(['device'=>Auth::user()->posp_ID,'type'=>$request->type])->first();
        //print_r($data);
         $temp['typ'] = $request->type;
         $temp['idv'] = $data;//['min'=> $data->minval,'max'=>$data->maxval];
         return View::make('pos.quotePages.common.idv_modal')->with($temp);
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
         return View::make('pos.quotePages.common.moter_premium_breakup')->with($temp);
    }
    
     function getminMaxassValue(Request $request){
        $data = DB::table('app_temp_quote')
                     ->select(DB::raw('MIN(min_idv) as minval,MAX(max_idv) as maxval'))
                     ->where(['device'=>Auth::user()->posp_ID,'type'=>$request->type])->first();
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
                $url = 'https://supersolutions.in/'.(strtolower($data->type)."-insurance/policy/payments/".$request->enquiryID."?target=".$encrypted);
                $html = '<div class="input-group">
                              <input value='.$url.' type="text" class="form-control" readonly id="input-payment-link" aria-describedby="copyClipboard" style="border: 1px dashed;">
                              <div class="input-group-append">
                                <span class="input-group-text" id="copyClipboard"><i style="font-size: 18px;" class="fa fa-copy"></i></span>
                              </div>
                            </div>';
                $html .='<p style="margin-top: 4px;font-size: 13px;text-align:right"><a href="#" id="sendPaymentLink" data-url="'.$url.'"><i style="font-size: 13px;" class="fa fa-paper-plane"></i> Send Payment Link</a></p>';
                return response()->json(['status'=>true,'message'=>'invalid request.','data'=>$html]); 
            }else{
              return response()->json(['status'=>false,'message'=>'invalid request.']); 
            }
        }else{
           return response()->json(['status'=>false,'message'=>'invalid request.']); 
        }
    }
    
    
    
    public function getFileDownloads(Request $request){
         if($request->type =='test-certificate'){
             $filepath ="/insurance/agents/pdf/certificate/";
         }else if($request->type=="policy-file"){
             $filepath ="/insurance/customers/policy/pdf/";
         }else if($request->type=="traning-material"){
             $filepath ="/insurance/agents/doc/";
         }
        
        return Response::download( dirname(getcwd(),1).$filepath.$request->file,$request->file);
         
    }
}