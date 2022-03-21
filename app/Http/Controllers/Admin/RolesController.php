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

class RolesController  extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }


    public function index(){
      $template = ['title' => 'Supersolutions :: Roles',"subtitle"=>"Add & View Roles",
                     'scripts'=>[asset('admin/js/page/roles.js')]];
        return View::make('admin.roles.roles')->with($template);
    }
    
    public function getRoledatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'role'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
         $roleName = ($request->input('columns.0.search.value'))?:"";
        
        $query = DB::table('roles');
        $query->select('*')
              ->when($roleName, function ($query, $roleName) {
                    return $query->where('role','like', '%'.$roleName.'%');
                });
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('roles')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                 $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['role']        = $each->role;
                $eachData['status'] =($each->status)?'<div style="cursor:pointer;" class="d-flex justify-content-between align-items-center  btn-status" data-name="'.$each->role.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-success pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Active</span> </div>'
                                                    :'<div style="cursor:pointer;" class="d-flex justify-content-between align-items-center  btn-status" data-name="'.$each->role.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-danger pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Inactive</span> </div>';
              
              //if($this->appUtil->hasPermission('cat_2')){ 
                $eachData['action']          = '-';//$buttons;  
             // }else{
              //  $eachData['action']="";
              //}
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
   
    public function statusUpdate(Request $request){
      $is = DB::table('roles')->where('id',$request->id)->update(['status'=>$request->status]);
      if(1){
          return Response::json(['status'=>'success','message'=>'status updated successfully']);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
    public function roleSave(Request $request){
      $data['role']=$request->roleName;
      $id = DB::table('roles')->insertGetId($data);
        if($id){
               $modules=DB::table('module')->get();
                foreach ($modules as $value) {
                     DB::table('permissions')->insertGetId(['role_id'=>$id,'module_id'=>$value->id]);
                }
           return Response::json(array('status'=>'success','message'=>" Role `".$request->roleName."` is created successfully"));
        }else{
           return Response::json(array('status'=>'error','message'=>"Something went wrong while creating role."));
        }
  } 

}
 

