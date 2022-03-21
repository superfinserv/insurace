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

class Notifications  extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }


    public function index(){
         $email_temp = DB::table('email_templates')->get();
         $sms_temp= DB::table('sms_templates')->get();
         $table = DB::table('notification_template_settings')->get();
         $template = ['title' => 'Supersolutions :: Notifications',"subtitle"=>"Template Settings",'settings'=>$table,'sms_templates' =>$sms_temp,'email_templates'=>$email_temp,
                     'scripts'=>[asset('admin/js/page/notification-template-settings.js')]];
        return View::make('admin.notification.notification_template_settings')->with($template);
    }
    
  
    public function updateSettings(Request $request){
      $array = [$request->typ=>$request->val];
      $a = DB::table('notification_template_settings')->where('id',$request->id)->update($array);
      if($a){
           $row = DB::table('notification_template_settings')->where('id',$request->id)->first();
          $msg = "";
          if($request->typ=="email_template"){ $msg ="Email template";}
          else if($request->typ=="email_template"){ $msg ="Email template";}
          else if($request->typ=="sms_template"){ $msg ="SMS template";}
          else if($request->typ=="email_status"){ $msg ="Email status";}
          else if($request->typ=="sms_status"){ $msg ="SMS status";}
          return Response::json(['status'=>'success','message'=>$msg.' updated successfully for '.$row->title]);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
  
    
    
}
 

