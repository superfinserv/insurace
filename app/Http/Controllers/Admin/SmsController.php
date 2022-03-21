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

class SmsController   extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }


    public function index(){
         $template = ['title' => 'Supersolutions :: Notifications',"subtitle"=>"List sms Templates",
                     'scripts'=>[asset('admi/js/page/sms-template.js')]];
        return View::make('admin.notification.sms.templates')->with($template);
    }
    
    public function getSmsTempdatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'subject',4=>'status'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $subject = ($request->input('columns.0.search.value'))?:"";
         $body = ($request->input('columns.1.search.value'))?:"";
           
        $query = DB::table('sms_templates');
        $query->select('*')
              ->when($subject, function ($query, $subject) {
                    return $query->where('title','like', '%'.$subject.'%');
                })
              ->when($body, function ($query, $body) {
                    return $query->where('body','like', '%'.$body.'%');
                });
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('sms_templates')->count();
        $result=[];$i=($start+1);
         foreach($brands as $each){
                 $eachData=array();
                
                $eachData['sno']        = $i;
                $eachData['title']    = $each->title;
                $eachData['body']       = "<code>".$each->body."</code>";// '<a data-subject="'.$each->title.'" class="view-body" href="#" id="'.$each->id.'">View Mail Body</a>';
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
                     'scripts'=>[asset('admi/js/page/sms-template.js')]];
         if(isset($request->id) && $request->param=='edit'){
            $template['temp'] =      DB::table('sms_templates')->where('id',$request->id)->first();
         }
          return View::make('admin.notification.sms._create_edit_template')->with($template);
    }
    
    public function  saveTemplate(Request $request){
        $array['title']= $request->title;
        $array['body']= $request->msg_body;
        $array['sender_phone']= "care@supersolutions.in";
        if(isset($request->temp_id)){
            DB::table("sms_templates")->where(['id'=>$request->temp_id])->update($array);
            $msg = "Updated";
        }else{
            DB::table('sms_templates')->insertGetId($array);
            $msg = "Created";
        }
        return Response::json(['status'=>'success','param'=>$msg,'message'=>'Sms Template '.$msg.' successfully.']);
    }
    
    function getSmsBody(Request $request){
        if($request->id!=""){
            $template['id'] = $request->id;
            $count = DB::table('sms_templates')->where('id',$request->id)->count();
            if($count){ $template['temp'] =  DB::table("sms_templates")->where(['id'=>$request->id])->first();}
            $template['count']  = $count;
            return View::make('admin.notification.sms.smsbody')->with($template);
         }else{echo "Invalid Access";}
    }
    
   
   
   
    
    
}
 

