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

class BranchesController  extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }


    public function index(){
       $regions = DB::table('regions')->get();
       $states = DB::table('states_list')->get();
       $template = ['title' => 'Supersolutions :: Branches',"subtitle"=>"Add & View Branch",'regions'=>$regions,'states'=>$states,
                     'scripts'=>[asset('admin/js/page/branches.js')]];
        return View::make('admin.branches.branches')->with($template);
    }
    
    public function getBranchdatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'name',2=>'code','3'=>'regions.name',4=>'cities_list.name',6=>'states_list.name',67=>'pincode'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $branchName = ($request->input('columns.0.search.value'))?:"";
         $regions = ($request->input('columns.1.search.value'))?:"";
         $stateName = ($request->input('columns.2.search.value'))?:"";
           
        $query = DB::table('branches')
                     ->join('regions', 'regions.id', '=', 'branches.region_id')
                     ->join('states_list', 'states_list.id', '=', 'branches.state_id')
                     ->join('cities_list', 'cities_list.id', '=', 'branches.city_id');
        $query->select('branches.*', DB::raw('states_list.name as state_name,cities_list.name as city_name,regions.name as region_name'))
              ->when($branchName, function ($query, $branchName) {
                    return $query->where('branches.name','like', '%'.$branchName.'%');
                })
                ->when($regions, function ($query, $regions) {
                    return $query->where('regions.name','like', '%'.$regions.'%');
                })
                ->when($stateName, function ($query, $stateName) {
                    return $query->where('states_list.name','like', '%'.$stateName.'%');
                });
              
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('branches')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                 $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['name']        = $each->name;
                $eachData['code']        = $each->code;
                $eachData['region']        = $each->region_name;
                $eachData['address']         = $each->address; 
                $eachData['city']         = $each->city_name;
                $eachData['state']         = $each->state_name;
                $eachData['pincode']         = $each->pincode;
                $eachData['status'] =($each->status)?'<div class="d-flex justify-content-between align-items-center  btn-status" data-name="'.$each->name.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-success pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Active</span> </div>'
                                                    :'<div class="d-flex justify-content-between align-items-center  btn-status" data-name="'.$each->name.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-danger pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Inactive</span> </div>';
              
                
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
      $is = DB::table('branches')->where('id',$request->id)->update(['status'=>$request->status]);
      if(1){
          return Response::json(['status'=>'success','message'=>'status updated successfully']);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
    public function branchSave(Request $request){
      $data['name']=$request->name;
      $data['code']=$request->code;
      $data['state_id']=$request->state;
      $data['city_id']= explode("-",$request->city)[0];
      $data['region_id']=$request->regionId;
      $data['address']=$request->address;
      $data['pincode']=$request->pincode;
     
      $id = DB::table('branches')->insertGetId($data);
        if($id){
           return Response::json(array('status'=>'success','message'=>" Branch `".$request->name."` is created successfully"));
        }else{
           return Response::json(array('status'=>'error','message'=>"Something went wrong while creating Branch."));
        }
  } 

}
 

