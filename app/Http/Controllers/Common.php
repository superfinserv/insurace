<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Response;
use View;
use Session; 
use Auth;
use File;
use Carbon\Carbon;
use PDF;


class Common extends Controller{
    
    public function __construct(){}
    
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
        $cities = DB::table('cities')->select(DB::raw("CONCAT(id,'-',name) AS id,name as value"))->where('state_id',$request->state_id)->orderBy('name','asc')->get();
        return response()->json(['status'=>'success','message'=>'Cities get successfully','data'=>$cities]);
    }
    
    public function getCityStateByPincode(Request $request){
       $pin =  DB::table('pincode_masters')->select('state_id','city_id')->where('pincode',$request->pincode)->first();
        $data['pincode'] = $request->pincode;
       if(isset($pin->city_id)){
           $city = DB::table('cities')->where('id',$pin->city_id)->first(); 
           $data['city'] =$city->id."-".$city->name;
           
               $state  = DB::table('states')->where('id',$city->state_id)->first();
               $data['state'] = $state->id."-".$state->name; 
           
       }
       
       return response()->json(['status'=>'success','message'=>'Data get successfully','data'=>$data]);
    }
    
    public function getCityPincode(Request $request){
        //  $pincode = DB::table('pincode_masters')->select('pincode')->where('taluk','=',$request->city)->orderBy('pincode','asc')->value('pincode');
        //  return response()->json(['status'=>'success','message'=>'pincode get successfully','pincode'=>$pincode]);
        
        
        
      $searchTerm=  $request->term;
      // echo  $request->city;
      $ct = explode('-',$request->city)[0];
      $ctName = explode('-',$request->city)[1];
      $pincodes = DB::table('pincode_masters')->select('pincode')->where('District',"LIKE", "%".$ctName."%")
              ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('pincode',"LIKE", "%".$searchTerm."%");
                })
             ->groupBy('pincode')->orderBy('pincode','ASC')->get();
        $row_set = [];
        if(!$pincodes->isEmpty()){
            foreach($pincodes as $post)
            {
                
                $new_row['label']= $post->pincode;
	            $new_row['value']= $post->pincode;
                $row_set[] = $new_row; //build an array
            }
        }
        
        echo json_encode($row_set); 
    
     }
     
    function getValidatedPincode(Request $request){
        $isValid =  DB::table('pincode_masters')->where('city_id',$request->ct)->where('pincode',$request->pin)->count();
        if($isValid){
            return response()->json(['status'=>true,'message'=>'Valid pincode found.']);
        }else{
            return response()->json(['status'=>false,'message'=>'Invalid pincode for city.']);
        }
     }
     
    function termsConditionsModel(Request $request){
        $temp['type'] = $request->type;
        $temp['supplier'] = $request->supplier;
        return View::make('insurance.terms_conditions_model')->with($temp);
    }
     
    public function getFinanciers(Request $request){
         $searchTerm = isset($_GET['searchTerm'])?$_GET['searchTerm']:'';
         $ff = DB::table('financiers')->select(DB::raw("id,name as text"))
              ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('name',"LIKE", "%".$searchTerm."%");
                })
             ->orderBy('name','ASC')->limit(25)->get();
        return response()->json(['status'=>'success','message'=>'Financiers get successfully','data'=>$ff]);
    }
    
     public function getPlansByPartner(Request $request){
        $cities = DB::table('plans')->select(DB::raw("id,plan_name as value"))->where('supplier',$request->partner)->orderBy('plan_name','asc')->get();
        return response()->json(['status'=>'success','message'=>'Cities get successfully','data'=>$cities]);
    }
     
    public function getFileDownloads(Request $request){
         if($request->type =='test-certificate'){
             $filepath =public_path()."/assets/agents/pdf/certificate/";
             $headers = array('Content-Type: application/pdf');
         }else if($request->type=="policy-file" || $request->type=="policy-ecard" || $request->type=="policy-proposal" || $request->type=="policy-receipt"){
             $filepath =public_path()."/assets/customers/policy/pdf/";
         }else if($request->type=="passbook-statement"){
             $filepath =public_path()."/assets/agents/passbook_statement/";
         }else if($request->type=="education-certificate"){
             $filepath =public_path()."/assets/agents/education_certificate/";
         }else if($request->type=="pan-card"){
             $filepath =public_path()."/assets/agents/pan_card/";
         }else if($request->type=="adhaar-card"){
             $filepath =public_path()."/assets/agents/adhaar_card/";
         }else if($request->type=="traning-material"){
             $filepath =public_path()."/assets/agents/doc/";
         }else if($request->type=="policy-word"){
             $filepath =public_path()."/assets/partners/";
         }else if($request->type=="customer-uploaded-doc"){
             $filepath =public_path()."/assets/customers/pre-policy-doc/";
         }
     //    echo $filepath;
        if(File::exists($filepath.$request->file)) {
          
        //   $F = (explode(".",$request->file));
        //   if(isset($F[1])){
        //      return Response::download($filepath.$request->file,ucwords($request->type).'.'.$F[1]);
        //   }else{
              return Response::download($filepath.$request->file,$request->file);
          //}
        }
    }
   
   
   public function getEnquiryData(Request $request){
       if($request->enQ){
           $data = DB::table('app_quote')->where('enquiry_id', $request->enQ)->first();
            return response()->json(['status'=>'success','message'=>'Successfull','data'=>json_decode($data->params_request,true)]); 
       }else{
          return response()->json(['status'=>'error','message'=>'Error','data'=>[]]);  
       }
   }
   
 
   
   
   function getPolicyQuotePdf(Request $request){
            $enQId = $request->enQ;
            $enQ = DB::table('app_quote')->where('id',$enQId)->first();
            
            $filename = "Quote-".$enQId.".pdf";
        
             $logo = asset('site_assets/logo/'.config('custom.site_logo'));//get_site_settings('site_logo');//"https://insurance.supersolutions.in/logo/logo_5.png";
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
            
           PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
          $pdf = PDF::loadView('web.quote.quotePdf',$data);
        
           return $pdf->stream();
        //   $headers =[
        //             'Content-Description' => 'File Transfer',
        //             'Content-Type' => 'application/pdf',
        //         ];
        //  //$pdf->save('public/assets'.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        
        // return $pdf->download($filename.'.pdf',$filename.'.pdf',$headers);
   }
   
}