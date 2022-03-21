<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use File;
use Auth;
//use App\Utils\AppUtil;

class EmailController  extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }


    public function index(){
         $template = ['title' => 'Supersolutions :: Notifications',"subtitle"=>"List Email Templates",
                     'scripts'=>[asset('admin/js/page/email-template.js')]];
        return View::make('admin.notification.email.templates')->with($template);
    }
    
    public function getEmailTempdatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'subject',4=>'status'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $subject = ($request->input('columns.0.search.value'))?:"";
         $body = ($request->input('columns.1.search.value'))?:"";
           
        $query = DB::table('email_templates');
        $query->select('*')
              ->when($subject, function ($query, $subject) {
                    return $query->where('subject','like', '%'.$subject.'%');
                })
              ->when($body, function ($query, $body) {
                    return $query->where('body','like', '%'.$body.'%');
                });
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('email_templates')->count();
        $result=[];$i=($start+1);
         foreach($brands as $each){
                 $eachData=array();
                
                $eachData['sno']        = $i;
                $eachData['subject_line']    = $each->subject;
                $eachData['mail_body']       = '<a data-subject="'.$each->subject.'" class="view-body" href="#" id="'.$each->id.'">View Mail Body</a>';
                 $eachData['status'] =($each->status)?'<div class="btn-status"  data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-success pd-y-3 pd-x-10 tx-white tx-11 ">Active</span> </div>'
                                                    :'<div class="btn-status"  data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-danger pd-y-3 pd-x-10 tx-white tx-11">Inactive</span> </div>';
                $buttons ='<div class="btn-group" role="group" >
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Update Template"  href="'.url('/notification/templates/email/edit/'.$each->id).'" class="btn btn-primary"><i class="icon ion-compose"></i></a>
                      </div>';
                $eachData['action']          = $buttons;  
             
                $result[] = $eachData; 
              
             $i++; 
         }
         $json_data = array(
           "draw"            => intval($request->input('draw')),  
           "recordsTotal"    => intval($totalRecords),  
           "recordsFiltered" => intval($totalFiltered),  
           "data"            => $result   
           );
        echo json_encode($json_data); 
   }
   
    public function create_edit_template(Request $request){
         $template = ['title' => 'Notofications',"subtitle"=>($request->param=='create')?"Add new Template":"Edit Template",
                     'scripts'=>[asset('admin/js/page/email-template.js')]];
         if(isset($request->id) && $request->param=='edit'){
            $template['temp'] =      DB::table('email_templates')->where('id',$request->id)->first();
         }
          return View::make('admin.notification.email._create_edit_template')->with($template);
    }
    
    public function  saveTemplate(Request $request){
       // print_r($_POST);
        $array['subject']= $request->subject_line;
        $array['body']= htmlentities($_POST['editor1']);
        $array['sender_email']= "care@supersolutions.in";
        //print_r($array);
        if(isset($request->temp_id)){
            DB::table("email_templates")->where(['id'=>$request->temp_id])->update($array);
            $msg = "Updated";
        }else{
            DB::table('email_templates')->insertGetId($array);
            $msg = "Created";
        }
        return Response::json(['status'=>'success','param'=>$msg,'message'=>'Template '.$msg.' successfully.']);
    }
    
    function getEmailBody(Request $request){
        if($request->id!=""){
            $template['id'] = $request->id;
            $count = DB::table('email_templates')->where('id',$request->id)->count();
            if($count){ $template['temp'] =  DB::table("email_templates")->where(['id'=>$request->id])->first();}
            $template['count']  = $count;
            return View::make('admin.notification.email.mailbody')->with($template);
         }else{echo "Invalid Access";}
    }
    
   
   
   
    public function statusUpdate(Request $request){
      $is = DB::table('regions')->where('id',$request->id)->update(['status'=>$request->status]);
      if(1){
          return Response::json(['status'=>'success','message'=>'status updated successfully']);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
  
    
    
}
 

