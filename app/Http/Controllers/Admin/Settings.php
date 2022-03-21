<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Auth;


class Settings extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }


    public function index(){
         $data = DB::table("site_settings")->get();
         $ips = DB::table("uat_allowed_ip")->get();
         $template = ['title' => 'Supers Finserv :: Settings',"subtitle"=>" Settings",'data'=>$data,'ips'=>$ips,
                     'scripts'=>[asset('admin/js/page/site-settings.js?v=1.1')]];
       
        return View::make('admin.pages.site_settings')->with($template);
    }
    public function portalSettings(){
         $results = DB::table("site_settings")->where('settingType','Portal')->orderBy('sNo','ASC')->get();
         $template = ['title' => 'Supers Finserv :: Portal Settings',"subtitle"=>"Portal Settings",'results'=>$results];
         $template['scripts']= [asset('admin/js/page/site-settings.js')];
         return View::make('admin.pages.portal-settings')->with($template);
    }
    
     public function socialSettings(){
         $results = DB::table("site_settings")->where('settingType','Social')->orderBy('sNo','ASC')->get();
         $template = ['title' => 'Supers Finserv :: Social Settings',"subtitle"=>"Social Settings",'results'=>$results];
         $template['scripts']= [asset('admin/js/page/site-settings.js')];
         return View::make('admin.pages.social-settings')->with($template);
    }
    
    public function pospSettings(){
         $results = DB::table("site_settings")->where('settingType','Posp')->orderBy('sNo','ASC')->get();
         $template = ['title' => 'Supers Finserv :: Social Settings',"subtitle"=>"Posp Settings",'results'=>$results];
         $template['scripts']= [asset('admin/js/page/site-settings.js')];
         return View::make('admin.pages.posp-settings')->with($template);
    }
    
     public function pgSettings(){
         $results = DB::table("site_settings")->where('settingType','PG')->orderBy('sNo','ASC')->get();
         $template = ['title' => 'Supers Finserv :: Payment Settings',"subtitle"=>"Payment Gatway Settings",'results'=>$results];
         $template['scripts']= [asset('admin/js/page/site-settings.js')];
         return View::make('admin.pages.pg-settings')->with($template);
    }
    
     public function updateSiteSettings(Request $request){
         $allRequests =  $request->all();
         foreach($allRequests as $KEY=>$value){
            //  Config::set($KEY, $value);
            DB::table("site_settings")->where(['key_name'=>$KEY])->update(['value'=>$value,'updated_on'=>date('Y-m-d H:i:s')]);
         }
         updateCustomConfig();
          
         return Response::json(['status'=>'success','message'=>'Settings updated successfully']);  
   }
    
    
    
    
    // public function updateSiteSettings(Request $request){
    //     $path ="";
    //     if($request->type=='file'){
    //         $row = DB::table("site_settings")->where(['key_name'=>$request->key])->first();
    //         if($row->value!=''){
    //             $image_path = $row->upload_path.$row->value;
    //             if(File::exists($image_path)) { File::delete($image_path); }
    //         }
    //         $fileName = $request->key.'.'.request()->uploadFile->getClientOriginalExtension();
    //         $request->uploadFile->move($row->upload_path, $fileName);
    //         $path = asset($row->upload_path."/".$fileName);
    //         updateCustomConfig($request->key,$fileName);
    //         DB::table("site_settings")->where(['key_name'=>$request->key])->update(['value'=>$fileName,'updated_on'=>date('Y-m-d H:i:s')]);
    //     }else{
    //         //$this->setEnv(strtoupper($request->key),$request->value);
    //         updateCustomConfig($request->key,$request->value);
    //         DB::table("site_settings")->where(['key_name'=>$request->key])->update(['value'=>$request->value,'updated_on'=>date('Y-m-d H:i:s')]);
    //     }
        
           
        
    //      return Response::json(['status'=>'success','path'=>$path,'updateOn'=>'Updated on '.createFormatDate(date('Y-m-d H:i:s'),'Y-m-d H:i:s','d/m/Y  \a\t g:ia'),'message'=>'Site settings updated successfully']);
    // }
    
    //settings/delete-ip
    // public function removeIP(Request $request){ 
    //     if($request->id){ 
    //         DB::table("uat_allowed_ip")->where('id',$request->id)->delete();
    //         return Response::json(['status'=>'success','message'=>'IP address deleted successfully']);
    //     }else{
    //          return Response::json(['status'=>'error','message'=>'Access Denied']);
    //     }
    // }
    // public function addNewIP(Request $request){
    //     if($request->ip_address!=""){ 
    //         $query = DB::table("uat_allowed_ip")->where('ip_address',$request->ip_address);
    //         if($query->count()){
    //             return Response::json(['status'=>'error','message'=>'IP address already added.']);
    //         }else{
    //             $id = DB::table('uat_allowed_ip')->insertGetId(['ip_address'=>$request->ip_address]);  
    //           return Response::json(['status'=>'success','data'=>['id'=>$id,'ip'=>$request->ip_address],'message'=>'IP address added successfully']); 
    //         }
            
    //     }else{
    //          return Response::json(['status'=>'error','message'=>'Please fill required field']);
    //     }
    // }
    
    
    
    
}
 

