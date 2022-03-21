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

class RegionsController extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }


    public function index(){
       $template = ['title' => 'Supersolutions :: Regions',"subtitle"=>"ADD & VIEW Regions",
                     'scripts'=>[asset('admin/js/page/regions.js')]];
        return View::make('admin.regions.regions')->with($template);
    }
    
    public function getRegiondatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'name'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $regionsName = ($request->input('columns.0.search.value'))?:"";
         $regionsDesc = ($request->input('columns.1.search.value'))?:"";
           
        $query = DB::table('regions');
        $query->select('*')
              ->when($regionsName, function ($query, $regionsName) {
                    return $query->where('name','like', '%'.$regionsName.'%');
                })
              ->when($regionsDesc, function ($query, $regionsDesc) {
                    return $query->where('description','like', '%'.$regionsDesc.'%');
                });
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('regions')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                 $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['name']        = $each->name;
                $eachData['desc']         = $each->description;
                
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
      $is = DB::table('regions')->where('id',$request->id)->update(['status'=>$request->status]);
      if(1){
          return Response::json(['status'=>'success','message'=>'status updated successfully']);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
    public function regionSave(Request $request){
      $data['name']=$request->regionName;
      $data['description']=$request->regionDesc;
     $id = DB::table('regions')->insertGetId($data);
      if($id){
           return Response::json(array('status'=>'success','message'=>"Regions `".$request->regionName."` created successfully"));
        }else{
           return Response::json(array('status'=>'error','message'=>"Something went wrong while createing Region."));
        }
  } 

}
 

