<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use File;
use Auth;
use Illuminate\Support\Facades\Hash;
//use App\Utils\AppUtil;
class UsersController extends Controller{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }    


    public function index(){
        $regions = DB::table('regions')->get();
        $roles = DB::table('roles')->get();
        $template = ['title' => 'Users',"subtitle"=>"Users List",'roles'=>$roles,'regions'=>$regions,
                     'scripts'=>[asset('admin/js/page/users.js')]];
        if(true){                
           return View::make('admin.users.users')->with($template);
        }else{
           return View::make('admin.404')->with($template);
        }
    }
    
    public function getUsersdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'users.id', 1 =>'users.name',2=>'users.mobile' ,'3'=>'users.email','4'=>'roles.role','5'=>'branches.name','6'=>'regions.name'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
         
         $searchTerm = ($request->input('columns.0.search.value'))?:"";
         $roleName   = ($request->input('columns.1.search.value'))?:"";
         $regionName = ($request->input('columns.2.search.value'))?:"";
         $BranchName = ($request->input('columns.3.search.value'))?:"";
        
        $query = DB::table("users")
               ->leftJoin('roles', 'roles.id', '=', 'users.role')
               ->leftJoin('branches', 'branches.id', '=', 'users.branch_id')
               ->leftJoin('regions', 'regions.id', '=', 'branches.region_id')
               ->select('users.*',DB::raw('roles.role as role_name,branches.name as branch_name,regions.name as region_name'))
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('users.name','LIKE', "%{$searchTerm}%")->orWhere('users.email', 'LIKE', "%{$searchTerm}%")->orWhere('users.mobile', 'LIKE', "%{$searchTerm}%");
                })
                ->when($roleName, function ($query, $roleName) {
                    return $query->where('roles.id','=', $roleName);
                })
                ->when($regionName, function ($query, $regionName) {
                    return $query->where('regions.id','=',$regionName);
                })
                ->when($BranchName, function ($query, $BranchName) {
                    return $query->where('branches.id','=',$BranchName);
                });
            
        $totalFiltered = $query->count();
        $users = $query->orderBy('users.is_default', 'DESC')->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table("users")->count();
        $result=[];$i=1;
         foreach($users as $each){
                 $eachData=array();
                 $vf= ($each->status==1)?"<span class='text-success'>verified</span>":"<span class='text-danger'>unverified</span>";
                 $eachData['userID']     = "<strong>".$i."</strong>";
                 $eachData['name']       = ($each->name)?$each->name:"-";
                 $eachData['mobile']     = ($each->mobile)?"+91 ".$each->mobile:"-";
                 $eachData['email']      = ($each->email)?$each->email:"-";
                 $eachData['role']       = ($each->is_default)?"<span class='text-success'>SUPER ADMIN</span>":(($each->role_name)?$each->role_name:"<span class='text-danger'>Not available</span>");
                 $eachData['branch']     = ($each->is_default)?"<span class='text-success'>ALL BRANCH</span>":(($each->branch_name)?$each->branch_name:"<span class='text-danger'>Not available</span>");
                 $eachData['region']     = ($each->is_default)?"<span class='text-success'>ALL REGION</span>":(($each->region_name)?$each->region_name:"<span class='text-danger'>Not available</span>");
                 $eachData['status']     = "<a class='user-vf' href='#' data-id='".$each->id."'>".$vf."</a>";
                 $btnReset = '<a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Reset Password"  href="#" data-id="'.$each->id.'"  class="btn btn-dark reset-password" ><i class="icon ion-key"></i></a>';
                 $btnEdit  = '<a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Update Details"  href="'.url('users/manage/edit/'.$each->id).'" class="btn btn-primary"><i class="icon ion-compose"></i></a>';
                 $btn = ($each->is_default)?"":$btnReset.$btnEdit;
                 $eachData['action']    ='<div class="btn-group" role="group" aria-label="Action Buttons" data-id="'.$each->id.'" data-name="'.$each->name.'" >
                      '.$btn.'
                     </div>';
               //<a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="View Details"  href="'.url('users/view/details/'.$each->id).'" class="btn btn-info "><i class="icon ion-eye"></i></a>
                     
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
   
   public function updateStatus(Request $request){
       $user =  DB::table('users')->where('id',$request->id)->first();
       if($user->is_default){
           return Response::json(array('status'=>'error','message'=>"Can't update to this user"));
       }else{
        if($request->st==1){ $st=0;$msg = "User marked unverified successfully.";}
        else{ $st=1;$msg = "User marked verified successfully.";}
       
        DB::table('users')->where('id',$request->id)->update(['status'=>$st]);
        return Response::json(array('status'=>'success','message'=>$msg,'userstatus'=>$st));
      }
   }
   
    public function viewUser(Request $request){
        
        $template = ['title' => 'Users',"subtitle"=>"Users List",'scripts'=>[asset('admin/js/page/users.js')]];
        $user =      DB::table('users')->where('id',$request->id)->first();
        if(!$user->is_default){
            $branch =  ($user->branch_id>0)?DB::table('branches')->where('id',$user->branch_id)->first():'-';
            $template['branch'] = ($user->branch_id>0)?$branch->name:'-';
            $template['region'] = ($user->branch_id>0)?DB::table('regions')->where('id',$branch->region_id)->value('name'):'-';
            $template['role'] = ($user->role>0)?DB::table('roles')->where('id',$user->role)->value('role'):'-';
            $rInfo = getRoleInfo($user->role);
            if($rInfo->success && $rInfo->code=='SP'){
                $template['posps']  = DB::table('agents')->where('mapped_sp',$user->id)->get();
            }
            
        }else{
           $template['role'] = 'SUPER ADMIN';
           $template['branch'] = "ALL Branch";
           $template['region'] = "ALL Region";
        }
        
        
        $template['state']  = ($user->state>0)?DB::table('states_list')->where('id',$user->state)->value('name'):'-';
        $template['city']   = ($user->city >0)?DB::table('cities_list')->where('id', $user->city)->value('name'):'-';
        $template['user']=$user;
        if(true){                
           return View::make('admin.users.view_user')->with($template);
        }else{
           return View::make('admin.404')->with($template);
        }
    }
   
    public function register_edit_User(Request $request){
        $regions = DB::table('regions')->get();
        $roles = DB::table('roles')->get();
        $states = DB::table('states_list')->select('*')->where('country_id',101)->get(); 
        
        $template = ['title' => 'Users',"subtitle"=>($request->param=='register')?"Add new user":"Edit user",'states'=>$states,'roles'=>$roles,'regions'=>$regions,
                     'scripts'=>[asset('admin/js/page/users.js')]];
        if(isset($request->id) && $request->param=='edit'){
          $template['user'] =      DB::table('users')->where('id',$request->id)->first();
          $template['branch'] =    DB::table('branches')->where('id',$template['user']->branch_id)->first();
          $template['branches'] =  DB::table('branches')->where('id',$template['branch']->id)->get();
          $template['cities'] =    DB::table('cities_list')->where('state_id',$template['user']->state)->get();
        }
        if(1){                
          return View::make('admin.users.user_add_edit')->with($template);
       }else{
        return View::make('admin.404')->with($template);
      }
    }
    
    // private function genratePOSPId($agentId){
    //         $agInfo = DB::table('agents')->where('id',$agentId)->first();
    //         if($agInfo->cert_serial!="" && $agInfo->cert_serial>0){
    //              DB::table('agents')->where('id', $agentId)->update(['cert_serial' =>0]);
    //         }
    //         $serial = DB::table('agents')->max('cert_serial');
    //         $num = $serial+1; 
    //         $v = 10000+$num;
    //         $pospID  = "SS/POS/A".$v;
    //          DB::table('agents')
    //             ->where('id', $agentId)
    //             ->update(['cert_serial' => $num,'posp_ID'=>$pospID]);
    //         return $pospID;
    // }
    
    public function savenewInfo(Request $request){
         $data['name'] = ucwords(strtolower($request->user_name));
         $data['email'] = strtolower($request->user_email);
         $data['mobile'] = $request->mobile_no;
         $data['address'] = strtolower($request->address);
         //$data['region_id'] = $request->region;
         $data['branch_id'] = $request->branch;
         $data['role'] = $request->role;
         $data['city'] = explode('-',$request->city)[0];
         $data['state'] = $request->state;
         $data['pincode'] = $request->pincode;
         $data['alternate_mobile'] = $request->alternate_mobile;
         $data['marital_status'] = isset($request->marital_status)?$request->marital_status:"Single";
         $data['gender'] = isset($request->gender)?$request->gender:"Male";
         if(isset($request->user_id)){
           DB::table('users')->where('id',$request->user_id)->update($data);
           $id = $request->user_id;
           $param= "updated";
         }else{
          $data['password']=Hash::make($request->user_pass);
          $data['uniqueToken']=date('Ymdhis');
          $id = DB::table('users')->insertGetId($data);
          $param= "register";
          //$this->genratePOSPId($id);
          $TEMP = getMailSmsInfoUser($id,'USER_REGISTER');
                  sendNotification($TEMP);
         }
          if($id){
              return Response::json(array('status'=>'success','message'=>"User {$param} successfully",'param'=>$param));
          }else{
              return Response::json(array('status'=>'error','message'=>"Someting went wrong while {$param}",'param'=>$param));
          }
        
    }
    
    public function resetPasswordModel(Request $request){
         if($request->id!=""){
            $template['userId'] = $request->id;
            return View::make('admin.users.model_reset_password')->with($template);
         }else{echo "Invalid Access";}
     }
     
    public function updatePassword(Request $request){
            DB::table('users')->where('id',$request->id)->update(['password'=>Hash::make($request->userPass)]);
            $is = true;
            if($is){
              return Response::json(['status'=>'success' ,'message'=>'Password reset successfully']);
           }else{
              return Response::json(['status'=>'error','message'=>'Somthing went wrong while reset password!']);
            }
     }
   
}
 

