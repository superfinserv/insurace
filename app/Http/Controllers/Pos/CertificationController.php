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
//use App\User;
use App\Resources\Posp;
class CertificationController extends Controller{
    
   public function __construct(Posp $posp) { 
       // $this->appUtil = $appUtil; 
        $this->Posp = $posp;
       
   }
    
    
    /* Certification handling request */

    
    public function my_certification() {
         $id = Auth::guard('agents')->user()->id;
         $certification_count = DB::table('certification')->where('agent_id', $id)->count();
         $certification =[];
         if($certification_count){
             $certification = DB::table('certification')->where('agent_id', $id)->orderBy('id', 'desc')->first();
            
         }
         $agent=Agents::select('*')->where('id', $id)->get()->toArray();
        $template = ['title' => 'profile',"subtitle"=>"profile",
                     'scripts'=>[asset('page_js/pospJs/test-certification.js')],'agent'=>$agent,'certification'=>$certification,'certification_count'=>$certification_count];
      
        return View::make('pos.certification.my_certification')->with($template);
    } 
     
    public function isAllowtest(){
         $id = Auth::guard('agents')->user()->id;
         $agent=Agents::select('*')->where('id', $id)->first();
         $com =  $this->Posp->profileCompleteData($id);          
          if($com['iscomplete']==1){
              if($com['payment_status']==1){
                    if($agent->isVerified==1){
                        if($agent->isTestAllow==1){  return json_encode(array('status'=>"success","title"=>"Start Certification","msg"=>'Start Test'));}else{ return json_encode(array('status'=>"error","title"=>"Not allowed Certification","msg"=>'You can not start test!.Please contact administration to allow you certifications!.')); }
                    }else{ return json_encode(array('status'=>"error","title"=>"Profile not verified :","msg"=>'Your Profile is not verified to start certification.')); }
              }else{ return json_encode(array('status'=>"error","title"=>"Application Fee","msg"=>'Your Application Fee is pending')); }
          }else{
             return json_encode(array('status'=>"error","title"=>"Profile incomplete","msg"=>'Please complete your profile and verification to start certification.'));
          }
        
      
        
    }
     
    public function test_start(){
        $id = Auth::guard('agents')->user()->id;
        $agent=Agents::select('*')->where('id', $id)->first();
         $com =  $this->Posp->profileCompleteData($id);          
          if($com['iscomplete']==1){
            if($agent->isVerified==1){
                if($agent->isTestAllow==1){
                     $randomquestions = DB::table('questions')->inRandomOrder()->limit(1)->get();
                        foreach ($randomquestions as $value) {
                            $answers = DB::table('answers')->inRandomOrder()->where('que_id', $value->id)->get();
                        }
                        $template = ['title' => 'profile',"subtitle"=>"profile",
                                     'scripts'=>[asset('page_js/pospJs/test-certification.js')],'randomquestions'=>$randomquestions[0],'answers'=>$answers];
                      
                        return View::make('pos.certification.test_start')->with($template);
                }else{ return redirect('/profile'); }
            }else{return redirect('/profile');}
          }else{return redirect('/profile');}
        
    }
     
    public function questions(Request $request){
         $randomquestions = DB::table('questions')->whereNotIn('id', [$request->ids])->inRandomOrder()->limit(1)->get();
      
        foreach ($randomquestions as $value) {
           $answers = DB::table('answers')->inRandomOrder()->where('que_id', $value->id)->get();
        }
         
       return json_encode(array('statusCode'=>200,'msg'=>'sucess','randomquestions'=>$randomquestions[0],'answers'=>$answers));
        
    }
    
    public function submit_question(Request $request){ 
        $each = 5;$total = 20*5;
        $marks =0;
        $cid =  DB::table("certification")->insertGetId(
              ['created_at'=>date('Y-m-d H:i:s'),'total_marks'=>$total,'agent_id'=>Auth::guard('agents')->user()->id]
          );

        foreach ($request->cartPos as $value) {
            $mark=0;$st=0;
           if($value['answers_id']){
              $ans= DB::table('answers')->where('id', $value['answers_id'])->first();
              if($ans->status==1)
                $mark = $each;
                $st = $ans->status;
              }

               $arr = [ 'certification_id'=>$cid, 
                   'q_id'=>$value['question_id'],
                   'ans_id'=>$value['answers_id'],
                   'marks'=>$mark,
                  'status'=>$st];
               DB::table("certification_results")->insertGetId($arr);

              $marks = $marks + $mark;
            }
          $p = round(($marks/$total)*100);
          $reqMarks = get_site_settings('cert_required_marks');
          //$reqMarks = ($reqMarks!="" && $reqMarks>0)?$reqMarks:50;
          DB::table('certification')
            ->where('id', $cid)
            ->update(['obtained_marks' => $marks,'required_marks'=>$reqMarks,'percentage'=>round($p)]);
             if($p>=$reqMarks){
                 $agInfo = DB::table('agents')->where('id',Auth::guard('agents')->user()->id)->first();
                 $this->certificate_downloads($agInfo->posp_ID,$cid); 
                 userLog(['user_id'=>Auth::guard('agents')->user()->id,'type'=>"POSP",'action'=>"CERT_PASS",'message'=>"Certification completed with (".$p.")",'created_at'=>date('Y-m-d H:i:s')]);
                 $TEMP = getMailSmsInfo(Auth::guard('agents')->user()->id,'CERTIFICATION_COMPLETE');
                 sendNotification($TEMP);
                 
             }
          return response()->json(['statusCode'=>200,'msg'=>'sucess','certification_id'=>$cid]);  
        }
        
    

    public function exam_result(Request $request){
        $result= DB::table('certification')->where('id', $request->id)->first();
         $template = ['title' => 'profile',"subtitle"=>"profile",
                     'scripts'=>[asset('page_js/pospJs/profile.js')],'result'=>$result,'id'=>$request->id];
      
        return View::make('pos.certification.exam_result')->with($template);
    }
    
    public function exam_review(Request $request){
        //$result= DB::table('certification')->where('id', $request->id)->first();
        $certification = DB::table('certification')
            ->leftJoin('certification_results', 'certification_results.certification_id', '=', 'certification.id')
             ->leftJoin('questions', 'certification_results.q_id', '=', 'questions.id')
             ->where('certification.id', $request->id)
            ->get();
           
         $template = ['title' => 'profile',"subtitle"=>"profile",
                     'scripts'=>[asset('page_js/pospJs/profile.js')],'certification'=>$certification];
      
        return View::make('pos.certification.exam_review')->with($template);
    }
     
    public function certificate_downloads($pospID,$id){
       
        $certification= DB::table('certification')->where('id', $id)->first();
        $data = ['certification'=>$certification];
        $user = Agents::find($certification->agent_id); 
        
        $filename = "Certificate-".str_replace("/","-",$pospID).'-'.uniqid();
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
         $data['user_city'] = ($user->city!="" && $user->city>0)?DB::table('cities_list')->where('id', $user->city)->value('name'):"";
         $data['user_state'] = ($user->state!="" && $user->state>0)?DB::table('states_list')->where('id', $user->state)->value('name'):"";
         
         PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
         $pdf = PDF::loadView('pos.certification.certificate_format',$data);
       
      
         //return $pdf->stream();//For browser view.
         $headers =[
                    'Content-Description' => 'File Transfer',
                    'Content-Type' => 'application/pdf',
                ];
         $pdf->save($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
         DB::table('certification')
                        ->where('id', $id)
                     ->update(['file' => $filename.'.pdf']);
        return Response::download($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
    }
     
 }