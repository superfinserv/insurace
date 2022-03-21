<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use File;
use Auth;
use App\Model\Agents;
class CommanController extends Controller
{
    public function __construct() { 
      $this->middleware('auth');
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
    
    public function logout(Request $request) {
         Auth::logout();
         return redirect('/login');
    }
    


    
    public function getBrandsByCategory(Request $request){
        $brands = DB::table('brands')->select(DB::raw("id as id,brand as value"))->whereRaw("find_in_set('".$request->type."',type)")->get();
        return response()->json(['status'=>'success','message'=>'Brands get successfully','data'=>$brands]);
    }
    
    public function getBranchesByRegion(Request $request){
        $Branches = DB::table('branches')->select(DB::raw("id as id,name as value"))->where('region_id',$request->region_id)->get();
        return response()->json(['status'=>'success','message'=>'Branches get successfully','data'=>$Branches]);
    }
    
  
    
    function checkTranningCertificateStatus($id){
        $data = Agents::find($id);
        if($data->life_ins_cert!="" && $data->general_ins_cert!=""){
            $TEMP = getMailSmsInfo($id,'TRANNING_CRTIFICATE');
            sendNotification($TEMP);
            userLog(['user_id'=>$id,'type'=>"POSP",'action'=>"TRANNING_CRTIFICATE",'message'=>"Life & Genral insurance certificate has been uploaded.",'created_at'=>date('Y-m-d H:i:s')]);
         }    
    }
    
    public function agentuploadFiles(Request $request){
         if($request->id){
            if(!empty($request->file('agentImage'))) {
                $data = Agents::find($request->id);
                $oldfile = $data->profile;
                $fileName = uniqid().$request->id.'.'.request()->agentImage->getClientOriginalExtension();
                $request->agentImage->move("public/assets/agents/profile/", $fileName);
                $data->profile=$fileName;
                    if($data->save()){ 
                        if($oldfile!='' && $oldfile!="avatar.png"){
                            $image_path = "public/assets/agents/profile/".$oldfile;
                            if(File::exists($image_path)) { File::delete($image_path); }
                        }
                       return response()->json(['status'=>'success','filename'=>$fileName,'message'=>'Profile image has been uploaded successfully']);
                    }else {
                     return response()->json(['status'=>'error','message'=>'Something went wrong while upload']);
                    }
            }else if(!empty($request->file('new_educational_cert'))) {
                $data = Agents::find($request->id);
                $oldfile = $data->education_certificate;
                $fileName = uniqid().$request->id.'.'.request()->new_educational_cert->getClientOriginalExtension();
                $request->new_educational_cert->move("public/assets/agents/education_certificate/", $fileName);
                $data->education_certificate=$fileName;
                    if($data->save()){ 
                        if($oldfile!=''){
                            $image_path = "public/assets/agents/education_certificate/".$oldfile;
                            if(File::exists($image_path)) { File::delete($image_path); }
                          
                        }
                       return response()->json(['status'=>'success','filename'=>$fileName,'message'=>'Certificate uploaded successfully']);
                    }else {
                     return response()->json(['status'=>'error','message'=>'Something went wrong while upload']);
                    }
            }else  if(!empty($request->file('new_passbook_statement'))) {
                $data = Agents::find($request->id);
                $oldfile = $data->passbook_statement;
                $fileName = uniqid().$request->id.'.'.request()->new_passbook_statement->getClientOriginalExtension();
                $request->new_passbook_statement->move("public/assets/agents/passbook_statement/", $fileName);
                $data->passbook_statement=$fileName;
                    if($data->save()){ 
                        if($oldfile!=''){
                            $image_path = "public/assets/agents/passbook_statement/".$oldfile;
                            if(File::exists($image_path)) { File::delete($image_path); }
                          
                        }
                       return response()->json(['status'=>'success','filename'=>$fileName,'message'=>'Passbook/Statement uploaded successfully']);
                    }else {
                     return response()->json(['status'=>'error','message'=>'Something went wrong while upload']);
                    }
            }else  if(!empty($request->file('new_pan_card'))) {
                $data = Agents::find($request->id);
                $oldfile = $data->pan_card;
                $fileName = uniqid().$request->id.'.'.request()->new_pan_card->getClientOriginalExtension();
                $request->new_pan_card->move("public/assets/agents/pan_card/", $fileName);
                $data->pan_card=$fileName;
                    if($data->save()){ 
                        if($oldfile!=''){
                            $image_path = "public/assets/agents/pan_card/".$oldfile;
                            if(File::exists($image_path)) { File::delete($image_path); }
                          
                        }
                       return response()->json(['status'=>'success','filename'=>$fileName,'message'=>'Pan card copy uploaded successfully']);
                    }else {
                     return response()->json(['status'=>'error','message'=>'Something went wrong while upload']);
                    }
            }else  if(!empty($request->file('new_adhaar_card'))) {
                $data = Agents::find($request->id);
                $oldfile = $data->adhaar_card;
                $fileName = uniqid().$request->id.'.'.request()->new_adhaar_card->getClientOriginalExtension();
                $request->new_adhaar_card->move("public/assets/agents/adhaar_card/", $fileName);
                $data->adhaar_card=$fileName;
                    if($data->save()){ 
                        if($oldfile!=''){
                            $image_path = "public/assets/agents/adhaar_card/".$oldfile;
                            if(File::exists($image_path)) { File::delete($image_path); }
                          
                        }
                       return response()->json(['status'=>'success','filename'=>$fileName,'message'=>'Address proof-1 card copy uploaded successfully']);
                    }else {
                     return response()->json(['status'=>'error','message'=>'Something went wrong while upload']);
                    }
            }else  if(!empty($request->file('new_adhaar_card_back'))) {
                $data = Agents::find($request->id);
                $oldfile = $data->adhaar_card_back;
                $fileName = uniqid().$request->id.'.'.request()->new_adhaar_card_back->getClientOriginalExtension();
                $request->new_adhaar_card_back->move("public/assets/agents/adhaar_card/", $fileName);
                $data->adhaar_card_back=$fileName;
                    if($data->save()){ 
                        if($oldfile!=''){
                            $image_path = "public/assets/agents/adhaar_card/".$oldfile;
                            if(File::exists($image_path)) { File::delete($image_path); }
                          
                        }
                       return response()->json(['status'=>'success','filename'=>$fileName,'message'=>'Address proof-2 card copy uploaded successfully']);
                    }else {
                     return response()->json(['status'=>'error','message'=>'Something went wrong while upload']);
                    }
            }else  if(!empty($request->file('newVideo'))) {
                $data = Agents::find($request->id);
                $oldfile = $data->videoFile;
                $fileName = uniqid().$request->id.'.'.request()->newVideo->getClientOriginalExtension();
                $request->newVideo->move("public/assets/agents/profile/", $fileName);
                $data->videoFile=$fileName;
                $data->isProceedSign=1;
                    if($data->save()){ 
                        if($oldfile!=''){
                            $image_path = "public/assets/agents/profile/".$oldfile;
                            if(File::exists($image_path)) { File::delete($image_path); }
                          
                        }
                       return response()->json(['status'=>'success','filename'=>$fileName,'message'=>'Identity video uploaded successfully. Redirecting please wait...']);
                    }else {
                     return response()->json(['status'=>'error','message'=>'Something went wrong while upload']);
                    }
            }else if(!empty($request->file('new_life_ins_cert'))) {
                $data = Agents::find($request->id);
                $oldfile = $data->life_ins_cert;
                $fileName = uniqid().$request->id.'.'.request()->new_life_ins_cert->getClientOriginalExtension();
                $request->new_life_ins_cert->move("public/assets/agents/tranning_certificates/", $fileName);
                $data->life_ins_cert=$fileName;
                    if($data->save()){ 
                        $this->checkTranningCertificateStatus($request->id);
                        if($oldfile!=''){
                            $image_path = "public/assets/agents/tranning_certificates/".$oldfile;
                            if(File::exists($image_path)) { File::delete($image_path); }
                        }
                       return response()->json(['status'=>'success','filename'=>$fileName,'message'=>'Certificate uploaded successfully']);
                    }else {
                     return response()->json(['status'=>'error','message'=>'Something went wrong while upload']);
                    }
            }else if(!empty($request->file('new_general_ins_cert'))) {
                $data = Agents::find($request->id);
                $oldfile = $data->general_ins_cert;
                $fileName = uniqid().$request->id.'.'.request()->new_general_ins_cert->getClientOriginalExtension();
                $request->new_general_ins_cert->move("public/assets/agents/tranning_certificates/", $fileName);
                $data->general_ins_cert=$fileName;
                    if($data->save()){ 
                        $this->checkTranningCertificateStatus($request->id);
                        if($oldfile!=''){
                            $image_path = "public/assets/agents/tranning_certificates/".$oldfile;
                            if(File::exists($image_path)) { File::delete($image_path); }
                        }
                       return response()->json(['status'=>'success','filename'=>$fileName,'message'=>'Certificate uploaded successfully']);
                    }else {
                     return response()->json(['status'=>'error','message'=>'Something went wrong while upload']);
                    }
            }else{
              return response()->json(['status'=>'error','message'=>'Please select file']);
             }
        }else{
         return response()->json(['status'=>'error','message'=>'unknown user access']);
        }
    }
    
    public function agentRemoveFiles(Request $request){
        if($request->id){
             if (isset($request->filename) && $request->filename!=""){
                 if($request->filename=="education_certificate"){
                    $user = Agents::find($request->id); 
                    $oldfile = $user->education_certificate;
                    if($oldfile!=''){
                        $user->education_certificate=NULL;
                        $image_path = "public/assets/agents/education_certificate/".$oldfile;
                         if(File::exists($image_path)) { File::delete($image_path); }
                         if($user->save()){ 
                              return response()->json(['status'=>'success','message'=>'Certificate deleted successfully']);
                         }else{
                            return response()->json(['status'=>'error','message'=>'Something went wrong while delete']);
                         }
                     }else{
                          return response()->json(['status'=>'success','message'=>'File deleted']);
                     }
                 }else if($request->filename=="passbook_statement"){
                    $user = Agents::find($request->id); 
                    $oldfile = $user->passbook_statement;
                    if($oldfile!=''){
                        $user->passbook_statement=NULL;
                        $image_path = "public/assets/agents/passbook_statement/".$oldfile;
                         if(File::exists($image_path)) { File::delete($image_path); }
                         if($user->save()){ 
                              return response()->json(['status'=>'success','message'=>'Passbook Statement deleted successfully']);
                         }else{
                            return response()->json(['status'=>'error','message'=>'Something went wrong while delete']);
                         }
                     }else{
                          return response()->json(['status'=>'success','message'=>'File deleted']);
                     }
                 }else if($request->filename=="pan_card"){
                    $user = Agents::find($request->id); 
                    $oldfile = $user->pan_card;
                    if($oldfile!=''){
                        $user->pan_card=NULL;
                        $image_path = "public/assets/agents/pan_card/".$oldfile;
                         if(File::exists($image_path)) { File::delete($image_path); }
                         if($user->save()){ 
                              return response()->json(['status'=>'success','message'=>'Pan card copy deleted successfully']);
                         }else{
                            return response()->json(['status'=>'error','message'=>'Something went wrong while delete Pan card copy']);
                         }
                     }else{
                          return response()->json(['status'=>'success','message'=>'File deleted']);
                     }
                 }else if($request->filename=="adhaar_card"){
                    $user = Agents::find($request->id); 
                    $oldfile = $user->adhaar_card;
                    if($oldfile!=''){
                        $user->adhaar_card=NULL;
                        $image_path = "public/assets/agents/adhaar_card/".$oldfile;
                         if(File::exists($image_path)) { File::delete($image_path); }
                         if($user->save()){ 
                              return response()->json(['status'=>'success','message'=>'Address Proof-1 copy deleted successfully']);
                         }else{
                            return response()->json(['status'=>'error','message'=>'Something went wrong while delete Address Proof-1']);
                         }
                     }else{
                          return response()->json(['status'=>'success','message'=>'File deleted']);
                     }
                 }else if($request->filename=="adhaar_card_back"){
                    $user = Agents::find($request->id); 
                    $oldfile = $user->adhaar_card_back;
                    if($oldfile!=''){ 
                        $user->adhaar_card_back=NULL;
                        $image_path = "public/assets/agents/adhaar_card/".$oldfile;
                         if(File::exists($image_path)) { File::delete($image_path); }
                         if($user->save()){ 
                              return response()->json(['status'=>'success','message'=>'Address Proof-2 copy deleted successfully']);
                         }else{
                            return response()->json(['status'=>'error','message'=>'Something went wrong while delete Address Proof-2']);
                         }
                     }else{
                          return response()->json(['status'=>'success','message'=>'File deleted']);
                     }
                 }else if($request->filename=="identity_video"){
                    $user = Agents::find($request->id); 
                    $oldfile = $user->videoFile;
                    if($oldfile!=''){
                        $user->videoFile=NULL;
                        $image_path = "public/assets/agents/profile/".$oldfile;
                         if(File::exists($image_path)) { File::delete($image_path); }
                         if($user->save()){ 
                              return response()->json(['status'=>'success','message'=>'Identity video deleted successfully.Redirecting please wait...']);
                         }else{
                            return response()->json(['status'=>'error','message'=>'Something went wrong while delete Identity video']);
                         }
                     }else{
                          return response()->json(['status'=>'success','message'=>'File deleted']);
                     }
                 }else if($request->filename=="life_ins_cert"){
                    $user = Agents::find($request->id); 
                    $oldfile = $user->life_ins_cert;
                    if($oldfile!=''){
                        $user->life_ins_cert=NULL;
                        $image_path = "public/assets/agents/tranning_certificates/".$oldfile;
                         if(File::exists($image_path)) { File::delete($image_path); }
                         if($user->save()){ 
                              return response()->json(['status'=>'success','message'=>'Certificate deleted successfully.Redirecting please wait...']);
                         }else{
                            return response()->json(['status'=>'error','message'=>'Something went wrong while delete Certificate']);
                         }
                     }else{
                          return response()->json(['status'=>'success','message'=>'File deleted']);
                     }
                 }else if($request->filename=="general_ins_cert"){
                    $user = Agents::find($request->id); 
                    $oldfile = $user->general_ins_cert;
                    if($oldfile!=''){
                        $user->general_ins_cert=NULL;
                        $image_path = "public/assets/agents/tranning_certificates/".$oldfile;
                         if(File::exists($image_path)) { File::delete($image_path); }
                         if($user->save()){ 
                              return response()->json(['status'=>'success','message'=>'Certificate deleted successfully.Redirecting please wait...']);
                         }else{
                            return response()->json(['status'=>'error','message'=>'Something went wrong while delete Certificate']);
                         }
                     }else{
                          return response()->json(['status'=>'success','message'=>'File deleted']);
                     }
                 }else{
                     return response()->json(['status'=>'error','message'=>'Unknown file action request']);
                 }
                 
             }else{
                 return response()->json(['status'=>'error','message'=>'Filename parameter missing']);
             }
        }else{
            return response()->json(['status'=>'error','message'=>'unknown user access']);
        }
   
    }
    
    public function getFileDownloads(Request $request){
         if($request->type =='test-certificate'){
             $filepath =public_path()."/assets/agents/pdf/certificate/";
             $headers = array('Content-Type: application/pdf');
         }else if($request->type=="policy-file"){
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
         }else{
             $filepath =public_path()."/assets/no-file/nnn.pdf";
         }
        
        if(File::exists($filepath.$request->file)) {
          return Response::download($filepath.$request->file,$request->file);
        }else{
            Redirect::back();
        }
    }
    

}