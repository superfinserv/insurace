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
use File;
use Auth;
use PDF;
use App\Utils\Certificate;
class CertificateController extends Controller{
    
     public function __construct() { 
        $this->certificate = new Certificate;
        $this->middleware('auth');
     }


    public function startTest(Request $request){
         if($request->id!=""){
            $template['agentId'] = $request->id;
            return View::make('admin.agents.model_test')->with($template);
         }else{echo "Invalid Access";}
     }
     
    public function getQuestion(Request $request){
            $count = $request->count;
            $whereNotIn = $request->isDone;
            $when = ($count>1)?true:false;
            $que = DB::table('questions')
                        ->when($when, function ($query, $whereNotIn) {
                            return $query ->whereNotIn('id', [$whereNotIn]);
                          })
                        ->inRandomOrder()->first(); 
            $ans = DB::table('answers')->select('id','ans_en as text')->where('que_id',$que->id)->get();
            $data=['queId'=>$que->id,'question'=>$que->question_en,'answers'=>$ans,'count'=>$count];
            return View::make('admin.agents.test_question')->with($data);
     }
     
    public function submitTest(Request $request){
          if($request->id){
            if($request->testData){
                      $each = 5;$total = 20*5; $marks =0;
                      $testData = $request->testData;
                       $reqMarks = get_site_settings('cert_required_marks');
                     
                      $cid = DB::table('certification')->insertGetId( ['agent_id' => $request->id,'required_marks'=>$reqMarks,'obtained_marks'=>0, 'percentage' =>0]);
                      
                      foreach ($testData as $value) {
                            $mark=0;$st=0;
                            if($value['ansid']){
                              $ans= DB::table('answers')->where('id', $value['ansid'])->first();
                              if($ans->status==1){ $mark = $each; $st = $ans->status; }
                             }
                             
                            $arr = [ 'certification_id'=>$cid, 'q_id'=>$value['queId'],  'ans_id'=>$value['ansid'], 'marks'=>$mark,'status'=>$st];
                            DB::table("certification_results")->insert($arr);
                            $marks = $marks + $mark;
                      }
                      
                      $p = round(($marks/$total)*100);
                      DB::table('certification')
                        ->where('id', $cid)
                        ->update(['obtained_marks' => $marks,'percentage'=>$p]);
                        if($p>=$reqMarks){
                           //$pospID = $this->genratePOSPId($request->id);
                            
                           $agInfo = DB::table('agents')->where('id',$request->id)->first();
                           $this->certificate->GeneratePdf($agInfo->posp_ID,$cid); 
                           $TEMP = getMailSmsInfo($request->id,'CERTIFICATION_COMPLETE');
                           sendNotification($TEMP);
                           userLog(['user_id'=>$request->id,'type'=>"POSP",'action'=>"CERTIFICATION_COMPLETE",'message'=>"Certification completed(".$p."%)",'created_at'=>date('Y-m-d H:i:s')]);
                        }
                    return response()->json(['status'=>'success','message'=>'Test submitted successfully','data'=>['id'=>$cid]]);
            }else{
               return response()->json(['status'=>'error','message'=>'Test data is missing']);
            }
          }else{
            return response()->json(['status'=>'error','message'=>'unknown user access']);
          }
    }
    
    public function regenerate_certificate(Request $request){
        if($request->id!=""){
          $isExist = DB::table('agents')->where('id',$request->id)->count();  
          if($isExist>0){
           $agInfo = DB::table('agents')->where('id',$request->id)->first(); 
           $cert = DB::table('certification')->where('agent_id',$request->id)->orderBy('id', 'desc')->first();
          ///print_r($cert);
           $cert_path = "public/assets/agents/pdf/certificate/".$cert->file;
           if(File::exists($cert_path)) { File::delete($cert_path); }
            $this->certificate->GeneratePdf($agInfo->posp_ID,$cert->id);
           $newcert = DB::table('certification')->where('agent_id',$request->id)->orderBy('id', 'desc')->first();
            return response()->json(['status'=>'success','message'=>'Certificate Re-generated Successfully!','path'=>url('/get/download/file/test-certificate/'.$newcert->file)]);
          }else{
            return response()->json(['status'=>'error','message'=>'unknown POSP found!']); 
          }
        }else{
            return response()->json(['status'=>'error','message'=>'unknown POSP found!']); 
        }
    }
    
     // for testting purpose
     public function direct_certificateGenrate(){
        $id = 17;
        $pospID = "SS/POS/A10017";
       // $certification= DB::table('certification')->where('id', $id)->first();
       // $data = ['certification'=>$certification];
        $user = Agents::find($id); 
        $filename = str_replace("/","_",$pospID).uniqid();
        //$filename =$certification->agent_id.uniqid();
        //$path = public_path()."/pdf/certificate";
        $path = "public/assets/agents/pdf/certificate";
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0755, true, true);
        } 
       
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
            
             $profile = "public/assets/agents/profile/".$user->profile;
            $arrContextOptions1=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $type1 = pathinfo($profile, PATHINFO_EXTENSION);
            $avatarData1 = file_get_contents($profile, false, stream_context_create($arrContextOptions1));
            $avatarBase64Data1 = base64_encode($avatarData1);
            $data['profile'] = 'data:image/' . $type1 . ';base64,' . $avatarBase64Data1;
         $data['user'] = $user;
         $data['user_city'] = ($user->city!="" && $user->city>0)?DB::table('cities_list')->where('id',  $user->city)->value('name'):"";
         $data['user_state'] = ($user->state!="" && $user->state>0)?DB::table('states_list')->where('id',  $user->state)->value('name'):"";
         
         PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
         $pdf = PDF::loadView('admin.agents.posp_details_pdf',$data);
       
         $pData = ['row'=>$pdf->output(),'name'=>$filename];
         return  $pData;
         
        // return $pdf->stream();
        //  $headers =[
        //             'Content-Description' => 'File Transfer',
        //             'Content-Type' => 'application/pdf',
        //         ];
        //  $pdf->save($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        // //   DB::table('certification')
        // //                 ->where('id', $id)
        // //              ->update(['file' => $filename.'.pdf']);
        //  //return $pdf->download($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        // return Response::download($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
    }
}